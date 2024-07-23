<?php
/**
 * The admin-specific functionality of the image converter plugin.
 *
 * This class defines all code necessary to run during the plugin's admin side,
 * including image conversion to WebP format upon upload, settings registration,
 * and the settings page rendering.
 *
 * @package    _Image_Converter
 * @subpackage _Image_Converter/admin
 */
namespace Botxbyte;
class ImageConverterAdmin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * Hooks into WordPress actions and filters to register settings and convert images upon upload.
	 */
	public function __construct() {
	}

	public function save(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		// Social Media Prompts
		UtilityAdmin::update_option('image_converter_enabled');

		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

	/**
	 * Converts uploaded images to WebP format if the image converter is enabled.
	 *
	 * @param array $metadata      Metadata for the attachment.
	 * @param int   $attachment_id Attachment ID.
	 * @return array Modified metadata with WebP image paths.
	 */
	public function convert_image_to_webp_on_upload($metadata, $attachment_id) {
		if (UtilityAdmin::get_option('image_converter_status') != 'true'){
			return $metadata;
		}
		
		$is_image_converter_enabled = UtilityAdmin::get_option('image_converter_enabled', '0');

		// Return original metadata if image converter is disabled
		if ($is_image_converter_enabled !== '1') {
			return $metadata;
		}

		$uploads_directory = wp_upload_dir();

		// Check if uploads directory is writable
		if (!is_writable($uploads_directory['basedir'])) {
			error_log('Image Converter Error: Uploads directory is not writable. Check permissions.');
			return $metadata;
		}

		// Check if Imagick extension is loaded
		if (!extension_loaded('imagick')) {
			return $metadata;
		}

		$original_image_path = $uploads_directory['basedir'] . '/' . $metadata['file'];
		$webp_image_path = $this->generate_webp_image_path($original_image_path);

		$this->convert_image_to_webp($original_image_path, $webp_image_path);

		// Replace original image with WebP version if it exists
		if (file_exists($webp_image_path)) {
			$this->replace_image_with_webp_version($webp_image_path, $original_image_path);
		}

		// Process thumbnails if available
		if (isset($metadata['sizes']) && is_array($metadata['sizes'])) {
			foreach ($metadata['sizes'] as $size => $sizeData) {
				$original_thumbnail_path = $uploads_directory['basedir'] . '/' . dirname($metadata['file']) . '/' . $sizeData['file'];
				$webp_thumbnail_path = $this->generate_webp_image_path($original_thumbnail_path);
				$this->convert_image_to_webp($original_thumbnail_path, $webp_thumbnail_path);

				// Replace original thumbnail with WebP version if it exists
				if (file_exists($webp_thumbnail_path)) {
					$this->replace_image_with_webp_version($webp_thumbnail_path, $original_thumbnail_path);
				}
			}
		}
		return $metadata;
	}

	/**
	 * Generates the file path for the WebP version of an image.
	 *
	 * @param string $source_path Path to the original image.
	 * @return string Path for the WebP version of the image.
	 */
	public function generate_webp_image_path($source_path) {
		$source_info = pathinfo($source_path);
		return $source_info['dirname'] . '/' . $source_info['filename'] . '.webp';
	}

	/**
	 * Converts an image to WebP format using the Imagick extension.
	 *
	 * @param string $source      Path to the source image.
	 * @param string $destination Path to save the WebP image.
	 */
	public function convert_image_to_webp($source, $destination) {
		try {
			$imagick = new \Imagick();
			$imagick->readImage($source);
			$imagick->setImageFormat('webp');
			$imagick->setOption('webp:method', '6');
			$imagick->setImageCompressionQuality(80); // Desired quality (0-100)
			$imagick->writeImage($destination);

			$imagick->clear();
			$imagick->destroy();
		} catch (\Exception $e) {
			error_log('Image conversion to WebP failed: ' . $e->getMessage());
		}
	}

	/**
	 * Replaces an old image file with a new one.
	 *
	 * @param string $old_path Path to the old image file.
	 * @param string $new_path Path to the new image file.
	 * @return bool True on success, false on failure.
	 */
	public function replace_image_with_webp_version($old_path, $new_path) {
		if (file_exists($old_path)) {
			return rename($old_path, $new_path);
		}
		return false;
	}

	/**
	 * Registers the settings for the image converter in the WordPress admin.
	 */
	public function register_image_converter_settings() {
		register_setting('image-converter-settings-group', 'image_converter_enabled');
	}

	/**
	 * Renders the settings page for the image converter plugin.
	 *
	 * This function checks for the Imagick extension, PHP version, and the availability of the rename function.
	 * It then displays the settings form allowing users to enable the image converter if all requirements are met.
	 * Additionally, it provides installation instructions for Imagick if it's not enabled.
	 */
	public function admin_page() {
		$is_imagick_enabled = extension_loaded('imagick');
		$current_php_version = phpversion();
		$php_major_version = intval(str_replace('.', '', substr($current_php_version, 0, 3))?? '');
		$is_rename_function_available = function_exists('rename');
		$is_image_converter_enabled = UtilityAdmin::get_option('image_converter_enabled');
		if($is_image_converter_enabled == 1){
			$is_image_converter_enabled = 'checked';
		}
		if (! $is_imagick_enabled){
			$is_image_converter_enabled = 0;
		}

		$page_variable = array();
        $page_variable['page_title'] = "Image Converter";
        $page_variable['form_action'] = 'options.php';
        $page_variable['admin_page_path'] = 'partials/image-converter-admin/admin_page.php';
		$page_variable['module'] = UtilityAdmin::get_option('image_converter_status');

        require_once('partials/templates/layout.php');
	}
}
