<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.fiverr.com/razamutaher
 * @since      1.0.0
 *
 * @package    Botxbyte
 * @subpackage Botxbyte/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Botxbyte
 * @subpackage Botxbyte/includes
 * @author     Mutaher <razamutaher@gmail.com>
 */
namespace Botxbyte;
class Botxbyte_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$one_day_timestamp = wp_next_scheduled( 'sp_one_day' );
	    wp_unschedule_event( $one_day_timestamp, 'sp_schedule_posts_task_hook' );

		$fifteen_min_timestamp = wp_next_scheduled( 'rp_fifteen_min' );
	    wp_unschedule_event( $fifteen_min_timestamp, 'rp_rewrite_posts_task_hook' );

	}

}
