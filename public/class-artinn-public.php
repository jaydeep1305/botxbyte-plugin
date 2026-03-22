<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.fiverr.com/razamutaher
 * @since      1.0.0
 *
 * @package    Artinn
 * @subpackage Artinn/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Artinn
 * @subpackage Artinn/public
 * @author     Mutaher <razamutaher@gmail.com>
 */
namespace Artinn;
class Artinn_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


		add_action('rest_api_init', array(new \Artinn\DynamicArticlePublisherPublic(), 'dynamic_article_publisher_register_custom_route'));
		add_action('rest_api_init', array(new \Artinn\GoogleDataPublic(), 'google_data_register_custom_route'));
		
		// add_filter( 'determine_current_user', array(new \Artinn\BasicAuthPublic(), 'json_basic_auth_handler'), 20);
		// add_filter( 'rest_authentication_errors', array(new \Artinn\BasicAuthPublic(), 'json_basic_auth_error' ));
	}


	function custom_log($message) {
		$log_file = plugin_dir_path( __DIR__ ) . 'debug.log';
		$current_time = date('Y-m-d H:i:s');
		$formatted_message = "[{$current_time}] {$message}\n";
		error_log($formatted_message, 3, $log_file);
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Artinn_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Artinn_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/artinn-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Artinn_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Artinn_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/artinn-public.js', array( 'jquery' ), $this->version, false );

	}

}
