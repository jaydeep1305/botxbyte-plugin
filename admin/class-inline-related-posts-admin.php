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
class InlineRelatedPostsAdmin {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
    }

    // Replace String Database
	public function save(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		// Social Media Prompts
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		UtilityAdmin::update_option('inline_related_posts');
		
		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

    public function admin_page(){
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		// Rephrasing 
        $inline_related_posts = UtilityAdmin::get_option('inline_related_posts');
        
		$all_categories = get_categories(array(
			'taxonomy'   => 'category', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
			'orderby'    => 'name',
			'parent'     => 0,
			'hide_empty' => 0, // change to 1 to hide categores not having a single post
		) );

		$page_variable = array();
        $page_variable['page_title'] = "Inline Related Posts";
        $page_variable['form_action'] = '';
        $page_variable['admin_page_path'] = 'partials/inline-related-posts-admin/admin_page.php';
		$page_variable['module'] = UtilityAdmin::get_option('inline_related_posts_status');
        require_once('partials/templates/layout.php');
    }
	
}