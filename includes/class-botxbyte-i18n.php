<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.fiverr.com/razamutaher
 * @since      1.0.0
 *
 * @package    Botxbyte
 * @subpackage Botxbyte/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Botxbyte
 * @subpackage Botxbyte/includes
 * @author     Mutaher <razamutaher@gmail.com>
 */
namespace Botxbyte;
class Botxbyte_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'botxbyte',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
