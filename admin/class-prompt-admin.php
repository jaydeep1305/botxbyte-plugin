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
class PromptAdmin {

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
		UtilityAdmin::update_option('social_fb_caption_prompt');
		UtilityAdmin::update_option('social_tw_caption_prompt');
		UtilityAdmin::update_option('social_pt_caption_prompt');
		UtilityAdmin::update_option('social_system_prompt');

		// Rewrite Prompts
		UtilityAdmin::update_option('rp_title_prompt');
		UtilityAdmin::update_option('rp_meta_description_prompt');
		UtilityAdmin::update_option('rp_content_prompt');
		UtilityAdmin::update_option('rp_system_prompt');

		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

    public function admin_page(){
		// Social Media Prompts
		$social_fb_caption_prompt = UtilityAdmin::get_option('social_fb_caption_prompt');
		$social_tw_caption_prompt = UtilityAdmin::get_option('social_tw_caption_prompt');
		$social_pt_caption_prompt = UtilityAdmin::get_option('social_pt_caption_prompt');
		$social_system_prompt = UtilityAdmin::get_option('social_system_prompt');
		
		// Rewrite Prompts
		$rp_title_prompt = UtilityAdmin::get_option('rp_title_prompt');
		$rp_meta_description_prompt = UtilityAdmin::get_option('rp_meta_description_prompt');
		$rp_content_prompt = UtilityAdmin::get_option('rp_content_prompt');
		$rp_system_prompt = UtilityAdmin::get_option('rp_system_prompt');

		$page_variable = array();
        $page_variable['page_title'] = "Prompts";
        $page_variable['form_action'] = '';
        $page_variable['admin_page_path'] = 'partials/prompt-admin/admin_page.php';
        
        require_once('partials/templates/layout.php');
    }
}