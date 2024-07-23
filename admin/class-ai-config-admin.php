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
class AIConfigAdmin {
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

    // Replace String Database
	public function save(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		// Social Media Prompts
		UtilityAdmin::update_option('rp_type');
		UtilityAdmin::update_option('rp_openai_key');
		UtilityAdmin::update_option('rp_openai_model');
		UtilityAdmin::update_option('rp_azure_api_version');
		UtilityAdmin::update_option('rp_azure_api_base');
		UtilityAdmin::update_option('rp_azure_api_key');
		UtilityAdmin::update_option('rp_azure_api_engine');

		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

    public function admin_page(){
		// AI Config
		$rp_type = UtilityAdmin::get_option('rp_type');
		if(empty($rp_type)){
			$rp_type = 'Openai';
		}
		$rp_openai_key = UtilityAdmin::get_option('rp_openai_key');
		$rp_openai_model = UtilityAdmin::get_option('rp_openai_model');

		$rp_azure_api_version = UtilityAdmin::get_option('rp_azure_api_version');
		$rp_azure_api_base = UtilityAdmin::get_option('rp_azure_api_base');
		$rp_azure_api_key = UtilityAdmin::get_option('rp_azure_api_key');
		$rp_azure_api_engine = UtilityAdmin::get_option('rp_azure_api_engine');

        $page_variable = array();
        $page_variable['page_title'] = "AI Configuration";
        $page_variable['form_action'] = "";
        $page_variable['admin_page_path'] = 'partials/ai-config-admin/admin_page.php';
		$page_variable['module'] = UtilityAdmin::get_option('ai_configuration_status');
        
        require_once('partials/templates/layout.php');
    }
}