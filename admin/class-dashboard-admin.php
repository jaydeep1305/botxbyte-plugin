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
class Dashboard {
    /**
     * Namespace for the admin-specific functionality of the image converter plugin.
     */

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
    }

    public function admin_page(){
	    $errors_html = array();
        $message = "";
        $analytics_html = "Disconnected"; 
        $search_console_html = "Disconnected"; 
        $image_converter_html = "Disconnected"; 
        $draft_to_schedule_html = "Disconnected";
        $ai_configuration_html = "Disconnected";
        $rewrite_posts_html = "Disconnected";
        $social_media_html = "Disconnected";
        // Sitekit
        if (!class_exists('Google\Site_Kit\Plugin')){
            array_push($errors_html, 'Site Kit by Google is not active.');
        }
        else{
            $context = new \Google\Site_Kit\Context(ABSPATH);
            $options = new \Google\Site_Kit\Core\Storage\Options($context);
            $analytics = new \Google\Site_Kit\Modules\Analytics_4($context, $options);
            if (!$analytics->is_connected()){
                array_push($errors_html, 'Analytics module is not connected.');
            }else{
                $analytics_html = "Connected";
            }

            try {
                $params = array(
                    "startDate"=>"2024-05-15",
                    "endDate"=>"2024-07-09",
                    "url"=>"https://www.wikilistia.com/celebrity/mia-melano-biography/"
                );
    
                $context = new \Google\Site_Kit\Context(ABSPATH);
                $options = new \Google\Site_Kit\Core\Storage\Options($context);
                $search_console = new \Google\Site_Kit\Modules\Search_Console($context, $options);
                $response = $search_console->get_data('searchanalytics', $params);
                if(isset($response->errors)){ 
                    array_push($errors_html, 'Search Console module is not connected.');
                }else{
                    $search_console_html = "Connected";
                }
            } catch (\WP_Error $e) {
                array_push($errors_html, 'Search Console module is not connected.');
            }
        }

        // Imag converter
        $is_imagick_enabled = extension_loaded('imagick');
        $is_rename_function_available = function_exists('rename');
        $is_image_converter_enabled = UtilityAdmin::get_option('image_converter_enabled');
        if (!$is_imagick_enabled){
            array_push($errors_html, 'Imagick Extension is not enabled.');
        }
        if (!$is_rename_function_available){
            array_push($errors_html, 'Rename Function is not enabled.');
        }
        if($is_imagick_enabled && isset($is_image_converter_enabled) && $is_image_converter_enabled == 1){
            $image_converter_html = 'Connected';
        }else{
            array_push($errors_html, 'Image Converter is not Connected.');
        }

        // Draft to schedule
        if( 
            UtilityAdmin::get_option('sp_articles_range_mon') !== "" or 
            UtilityAdmin::get_option('sp_articles_range_mon') !== ""   or 
            UtilityAdmin::get_option('sp_articles_range_mon') !== ""   or 
            UtilityAdmin::get_option('sp_articles_range_mon') !== ""   or 
            UtilityAdmin::get_option('sp_articles_range_mon') !== ""   or 
            UtilityAdmin::get_option('sp_articles_range_mon') !== ""   or 
            UtilityAdmin::get_option('sp_articles_range_mon') !== ""  
        ){
            $draft_to_schedule_html = "Connected";
        }
        else{
            array_push($errors_html, 'Draft to Schedule Settings are not set.');
        }
        
        // Ai Configuration
        $rp_type = UtilityAdmin::get_option('rp_type') ?: 'Openai';
        if($rp_type == "Openai"){
            if(
                UtilityAdmin::get_option('rp_openai_key') !== "" or
                UtilityAdmin::get_option('rp_openai_model') !== ""
            ){
                $ai_configuration_html = "Connected";
            }
        }
        else{
            if(
                UtilityAdmin::get_option('rp_azure_api_version') !== "" or
                UtilityAdmin::get_option('rp_azure_api_base') !== "" or
                UtilityAdmin::get_option('rp_azure_api_key') !== "" or
                UtilityAdmin::get_option('rp_azure_api_engine') !== ""
            ){
                $ai_configuration_html = "Connected";
            }
        }
        if ($ai_configuration_html !== "Connected"){
            array_push($errors_html, $rp_type.' not set.');
        }

        // Rewrite Posts
        if ($ai_configuration_html === "Connected"){
            if(
                UtilityAdmin::get_option('rp_title_prompt') !== "" and
                UtilityAdmin::get_option('rp_meta_description_prompt') !== "" and
                UtilityAdmin::get_option('rp_content_prompt') !== "" and
                UtilityAdmin::get_option('rp_system_prompt') !== ""
            ){
                if( 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== "" or 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== ""   or 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== ""   or 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== ""   or 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== ""   or 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== ""   or 
                    UtilityAdmin::get_option('rp_articles_range_mon') !== ""  
                ){
                    $rewrite_posts_html = "Connected";
                }else{
                    array_push($errors_html, 'Rewrite Posts Settings are not set.');
                }
            }
            else{
                array_push($errors_html, 'Prompts are not set.');
            }
        }

        //Social Media
        $social_media_html = (UtilityAdmin::get_option('social_media_html') == 'working') ? 'Connected': 'Disconnected';

        // Status
        $analytics_status = (UtilityAdmin::get_option('analytics_status') == "true")?'checked':'';
        $search_console_status = (UtilityAdmin::get_option('search_console_status') == "true")?'checked':'';
        $image_converter_status = (UtilityAdmin::get_option('image_converter_status') == "true")?'checked':'';
        $draft_to_schedule_status = (UtilityAdmin::get_option('draft_to_schedule_status') == "true")?'checked':'';
        $ai_configuration_status = (UtilityAdmin::get_option('ai_configuration_status') == "true")?'checked':'';
        $rewrite_posts_status = (UtilityAdmin::get_option('rewrite_posts_status') == "true")?'checked':'';
        $social_media_status = (UtilityAdmin::get_option('social_media_status') == "true")?'checked':'';
        
        
        $page_variable = array();
        $page_variable['page_title'] = "Dashboard";
        $page_variable['admin_page_path'] = 'partials/dashboard/admin_page.php';
      
        require_once('partials/templates/layout.php');
    }

    public function save_status(){
        if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		// Schedule Posts
        if(isset($_POST['analytics_status'])){
            UtilityAdmin::update_option('analytics_status');
        }
        if(isset($_POST['search_console_status'])){
            UtilityAdmin::update_option('search_console_status');
        }
        if(isset($_POST['image_converter_status'])){
            UtilityAdmin::update_option('image_converter_status');
        }
        if(isset($_POST['draft_to_schedule_status'])){
            UtilityAdmin::update_option('draft_to_schedule_status');
        }
        if(isset($_POST['ai_configuration_status'])){
            UtilityAdmin::update_option('ai_configuration_status');
        }
        if(isset($_POST['rewrite_posts_status'])){
            UtilityAdmin::update_option('rewrite_posts_status');
        }
        if(isset($_POST['social_media_status'])){
            UtilityAdmin::update_option('social_media_status');
        }
		echo wp_json_encode(array('success'=>'yes'));
		exit();
    }
}