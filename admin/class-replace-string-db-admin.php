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
class ReplaceStringDBAdmin {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
    }

    // Replace String Database
	public function admin_page(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
        $page_title = "Replace String in Database";
        $form_action = "admin.php?page=botxbyte-replace-string-db-settings";

        $page_variable = array();
        $page_variable['page_title'] = "Replace String in Database";
        $page_variable['form_action'] = $form_action;
        $page_variable['admin_page_path'] = 'partials/replace-string-db-admin/admin_page.php';
        
        require_once('partials/templates/layout.php');
	}

}