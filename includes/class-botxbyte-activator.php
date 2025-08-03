<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.fiverr.com/razamutaher
 * @since      1.0.0
 *
 * @package    Botxbyte
 * @subpackage Botxbyte/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Botxbyte
 * @subpackage Botxbyte/includes
 * @author     Mutaher <razamutaher@gmail.com>
 */
namespace Botxbyte;
class Botxbyte_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		date_default_timezone_set('Asia/Kolkata');
		$time_val = strtotime('01:00');
		if ( ! wp_next_scheduled( 'sp_schedule_posts_task_hook' ) ) {
			wp_schedule_event( $time_val, 'sp_one_day', 'sp_schedule_posts_task_hook' );
		}

		$time_val = time();
		if ( ! wp_next_scheduled( 'rp_rewrite_posts_task_hook' ) ) {
			wp_schedule_event( $time_val, 'rp_fifteen_min', 'rp_rewrite_posts_task_hook' );
		}

		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$rp_logs = $wpdb->prefix . PREFIX . 'rp_logs';
		$rp_logs_sql = "CREATE TABLE $rp_logs (
            id int(11) NOT NULL AUTO_INCREMENT,
            timeofchange varchar(50),
			post_id int(11),
			change_type varchar(50),
			old_value TEXT,
			new_value TEXT,
            PRIMARY KEY (id)
        ) $charset_collate;";

		$sp_logs = $wpdb->prefix . PREFIX .'sp_logs';
		$sp_logs_sql = "CREATE TABLE $sp_logs (
			id int(11) NOT NULL AUTO_INCREMENT,
			timeofchange varchar(50),
			post_id int(11),
			new_post_date varchar(50),
			author varchar(50),
			PRIMARY KEY (id)
		) $charset_collate;";

		$social_logs = $wpdb->prefix . PREFIX . 'social_logs';
		$social_logs_sql = "CREATE TABLE $social_logs (
			id int(11) NOT NULL AUTO_INCREMENT,
			timeofchange varchar(50),
			post_id int(11),
			status varchar(50),
			response TEXT,
			PRIMARY KEY (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $rp_logs_sql );
		dbDelta( $sp_logs_sql );
		dbDelta( $social_logs_sql );
	}

}
