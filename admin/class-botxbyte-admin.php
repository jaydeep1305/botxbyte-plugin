<?php

namespace Botxbyte;
include(plugin_dir_path( __DIR__ ) . '/vendor/autoload.php');

class Botxbyte_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

		//botxbyte_save_webhook_settings
		add_action( 'wp_ajax_save_status', array( new Dashboard(), 'save_status' ) );
		add_action( 'wp_ajax_nopriv_save_status', array( new Dashboard(), 'save_status' ) );

		add_action( 'wp_ajax_prompt_admin_save', array( new PromptAdmin(), 'save' ) );
		add_action( 'wp_ajax_nopriv_prompt_admin_save', array( new PromptAdmin(), 'save' ) );

		add_action( 'wp_ajax_ai_config_admin_save', array( new AIConfigAdmin(), 'save' ) );
		add_action( 'wp_ajax_nopriv_ai_config_admin_save', array( new AIConfigAdmin(), 'save' ) );

		add_action( 'wp_ajax_image_converter_admin_save', array( new ImageConverterAdmin(), 'save' ) );
		add_action( 'wp_ajax_nopriv_image_converter_admin_save', array( new ImageConverterAdmin(), 'save' ) );

		add_action( 'wp_ajax_draft_schedule_admin_save', array( new DraftScheduleAdmin(), 'save' ) );
		add_action( 'wp_ajax_nopriv_draft_schedule_admin_save', array( new DraftScheduleAdmin(), 'save' ) );

		add_action( 'wp_ajax_rewrite_posts_admin_save', array( new RewritePostsAdmin(), 'save' ) );
		add_action( 'wp_ajax_nopriv_rewrite_posts_admin_save', array( new RewritePostsAdmin(), 'save' ) );

		add_action( 'wp_ajax_social_media_admin_save', array( new SocialMediaAdmin(), 'save' ) );
		add_action( 'wp_ajax_nopriv_social_media_admin_save', array( new SocialMediaAdmin(), 'save' ) );

		add_action( 'wp_ajax_social_media_save_settings', array( new SocialMediaAdmin(), 'save_settings' ) );
		add_action( 'wp_ajax_nopriv_social_media_save_settings', array( new SocialMediaAdmin(), 'save_settings' ) );
				
		// Draft to schedule cron
		add_filter( 'cron_schedules', array( new DraftScheduleAdmin(),'crons_intervals' ) );
		add_action('sp_schedule_posts_task_hook', array( new DraftScheduleAdmin(),'draft_to_schedule' ) );

		add_filter( 'cron_schedules', array( new RewritePostsAdmin(),'crons_intervals' ) );
		add_action('rp_rewrite_posts_task_hook', array( new RewritePostsAdmin(), 'rewrite_posts' ) );

		add_action( "publish_post", array( new SocialMediaAdmin(), "post_published_trigger" ), 10, 3 );

		add_action('admin_init', array( new ImageConverterAdmin(), 'register_image_converter_settings' ) );
		add_filter('wp_generate_attachment_metadata', array( new ImageConverterAdmin(), 'convert_image_to_webp_on_upload' ), 10, 2);

	}

	// Logs
	function custom_log($message) {
		$log_file = plugin_dir_path( __DIR__ ) . 'debug.log';
		$current_time = date('Y-m-d H:i:s');
		$formatted_message = "[{$current_time}] {$message}\n";
		error_log($formatted_message, 3, $log_file);
	}
	

	// Botxbyte
	public function add_admin_page() {
		
		// Create the main menu page
		add_menu_page(
			'Botxbyte Settings',
			'Botxbyte',
			'manage_options',
			'botxbyte-dashboard',
			array( new Dashboard(), 'admin_page'),
			plugin_dir_url( __FILE__ ) . 'assets/custom-icon.svg?version='.$this->version
		);

		// Add the Image Converter as a submenu
		// hide this page in wordpress menu
		add_submenu_page(
			null, // Parent slug of the main menu page (null to hide from menu)
			'Image Converter Settings',
			'Image Converter',
			'manage_options',
			'botxbyte-image-converter-settings',
			array( new ImageConverterAdmin(), 'admin_page')
		);
		// Add the Image Converter as a submenu
		add_submenu_page(
			null,  // Parent slug of the main menu page
			'Post Date Change Settings',
			'Post Date Change',
			'manage_options',
			'botxbyte-post-date-change-settings',
			array( new PostDateChangeAdmin(), 'admin_page')
		);

		// Add the Replace String DB as a submenu
		add_submenu_page(
			null, // Parent slug of the main menu page
			'Replace String DB Settings',
			'Replace String DB',
			'manage_options',
			'botxbyte-replace-string-db-settings',
			array( new ReplaceStringDBAdmin(),'admin_page' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Prompts',
			'Prompts',
			'manage_options',
			'botxbyte-configure-webhook',
			array( new PromptAdmin(), 'admin_page' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'AI Config',
			'AI Config',
			'manage_options',
			'botxbyte-ai-config',
			array( new AIConfigAdmin(), 'admin_page' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Draft to Schedule',
			'Draft to Schedule',
			'manage_options',
			'botxbyte-schedule-posts',
			array( new DraftScheduleAdmin(), 'admin_page' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Draft to Schedule Logs',
			'Draft to Schedule Logs',
			'manage_options',
			'botxbyte-schedule-posts-logs',
			array( new DraftScheduleAdmin(), 'logs' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Rewrite Posts',
			'Rewrite Posts',
			'manage_options',
			'botxbyte-rewrite-posts',
			array( new RewritePostsAdmin(), 'admin_page' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Rewrite Logs',
			'Rewrite Logs',
			'manage_options',
			'botxbyte-rewrite-posts-logs',
			array( new RewritePostsAdmin(), 'logs' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Social Media',
			'Social Media',
			'manage_options',
			'botxbyte-social-media',
			array( new SocialMediaAdmin(), 'admin_page' )
		);

		add_submenu_page(
			null, // Parent slug of the main menu page
			'Social Media Logs',
			'Social Media Logs',
			'manage_options',
			'botxbyte-social-media-logs',
			array( new SocialMediaAdmin(), 'logs' )
		);

	}


	// Rewrite Post
	function rp_rewrite_posts_logs(){
		global $wpdb;
		$rp_logs = $wpdb->prefix .  PREFIX . 'rp_logs';

		$query = "SELECT * FROM " . $rp_logs ;
		$records = $wpdb->get_results($query); 

		require_once 'partials/wc-rewrite-posts-logs-admin-display.php';
	}


	// Botxbyte
	public function botxbyte_settings_page() {
		?>
		<div class="wrap">
			<h1>Botxbyte Settings</h1>
			
		</div>
		<?php
	}



	// Botxbyte
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook_suffix ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Botxbyte_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Botxbyte_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if($hook_suffix == 'admin_page_botxbyte-schedule-posts' || $hook_suffix == 'admin_page_botxbyte-rewrite-posts'){
			wp_enqueue_style( $this->plugin_name.'selecttwocss', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), $this->version, 'all' );
		}


		// wp_enqueue_style( $this->plugin_name.'-admin', plugin_dir_url( __FILE__ ) . 'css/botxbyte-admin.css', array(), $this->version, 'all' );

	}

	// Botxbyte
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Botxbyte_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Botxbyte_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if(	
			$hook_suffix == 'admin_page_botxbyte-schedule-posts' || 
			$hook_suffix == 'admin_page_botxbyte-rewrite-posts' || 
			$hook_suffix == 'admin_page_botxbyte-configure-webhook' ||
			$hook_suffix == 'admin_page_botxbyte-ai-config' ||
			$hook_suffix == 'admin_page_botxbyte-image-converter-settings' ||
			$hook_suffix == 'admin_page_botxbyte-social-media' ||
			$hook_suffix == 'toplevel_page_botxbyte-dashboard' 
		){
			wp_enqueue_script( $this->plugin_name.'selecttwojs', plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name.'sweetalertjs', plugin_dir_url( __FILE__ ) . 'js/sweetalert.js', array( 'jquery' ), $this->version, false );
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/botxbyte-admin.js', array( 'jquery' ), $this->version, true );

	}

}
