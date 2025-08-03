<?php
namespace Botxbyte;
class DraftScheduleAdmin {

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
		// Schedule Posts
		UtilityAdmin::update_option('sp_articles_range_mon');
		UtilityAdmin::update_option('sp_articles_range_tue');
		UtilityAdmin::update_option('sp_articles_range_wed');
		UtilityAdmin::update_option('sp_articles_range_thu');
		UtilityAdmin::update_option('sp_articles_range_fri');
		UtilityAdmin::update_option('sp_articles_range_sat');
		UtilityAdmin::update_option('sp_articles_range_sun');

		UtilityAdmin::update_option('sp_delay_mon');
		UtilityAdmin::update_option('sp_delay_tue');
		UtilityAdmin::update_option('sp_delay_wed');
		UtilityAdmin::update_option('sp_delay_thu');
		UtilityAdmin::update_option('sp_delay_fri');
		UtilityAdmin::update_option('sp_delay_sat');
		UtilityAdmin::update_option('sp_delay_sun');

		UtilityAdmin::update_option('sp_timing_mon');
		UtilityAdmin::update_option('sp_timing_tue');
		UtilityAdmin::update_option('sp_timing_wed');
		UtilityAdmin::update_option('sp_timing_thu');
		UtilityAdmin::update_option('sp_timing_fri');
		UtilityAdmin::update_option('sp_timing_sat');
		UtilityAdmin::update_option('sp_timing_sun');

		UtilityAdmin::update_option('sp_author_mon');
		UtilityAdmin::update_option('sp_author_tue');
		UtilityAdmin::update_option('sp_author_wed');
		UtilityAdmin::update_option('sp_author_thu');
		UtilityAdmin::update_option('sp_author_fri');
		UtilityAdmin::update_option('sp_author_sat');
		UtilityAdmin::update_option('sp_author_sun');


		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

    public function admin_page(){
		// Schedule Posts
		$sp_articles_range_mon = UtilityAdmin::get_option('sp_articles_range_mon');
		$sp_articles_range_tue = UtilityAdmin::get_option('sp_articles_range_tue');
		$sp_articles_range_wed = UtilityAdmin::get_option('sp_articles_range_wed');
		$sp_articles_range_thu = UtilityAdmin::get_option('sp_articles_range_thu');
		$sp_articles_range_fri = UtilityAdmin::get_option('sp_articles_range_fri');
		$sp_articles_range_sat = UtilityAdmin::get_option('sp_articles_range_sat');
		$sp_articles_range_sun = UtilityAdmin::get_option('sp_articles_range_sun');
		
		$sp_delay_mon = UtilityAdmin::get_option('sp_delay_mon');
		$sp_delay_tue = UtilityAdmin::get_option('sp_delay_tue');
		$sp_delay_wed = UtilityAdmin::get_option('sp_delay_wed');
		$sp_delay_thu = UtilityAdmin::get_option('sp_delay_thu');
		$sp_delay_fri = UtilityAdmin::get_option('sp_delay_fri');
		$sp_delay_sat = UtilityAdmin::get_option('sp_delay_sat');
		$sp_delay_sun = UtilityAdmin::get_option('sp_delay_sun');

		$sp_timing_mon = UtilityAdmin::get_option('sp_timing_mon');
		$sp_timing_tue = UtilityAdmin::get_option('sp_timing_tue');
		$sp_timing_wed = UtilityAdmin::get_option('sp_timing_wed');
		$sp_timing_thu = UtilityAdmin::get_option('sp_timing_thu');
		$sp_timing_fri = UtilityAdmin::get_option('sp_timing_fri');
		$sp_timing_sat = UtilityAdmin::get_option('sp_timing_sat');
		$sp_timing_sun = UtilityAdmin::get_option('sp_timing_sun');

		$sp_author_mon = UtilityAdmin::get_option('sp_author_mon');
		$sp_author_tue = UtilityAdmin::get_option('sp_author_tue');
		$sp_author_wed = UtilityAdmin::get_option('sp_author_wed');
		$sp_author_thu = UtilityAdmin::get_option('sp_author_thu');
		$sp_author_fri = UtilityAdmin::get_option('sp_author_fri');
		$sp_author_sat = UtilityAdmin::get_option('sp_author_sat');
		$sp_author_sun = UtilityAdmin::get_option('sp_author_sun');

		$all_users = get_users(array());

		$page_variable = array();
        $page_variable['page_title'] = "Draft to Schedule";
        $page_variable['form_action'] = "";
        $page_variable['admin_page_path'] = 'partials/draft-schedule-admin/admin_page.php';
        $page_variable['button'] = 'admin.php?page=botxbyte-schedule-posts-logs';
		$page_variable['module'] = UtilityAdmin::get_option('draft_to_schedule_status');
        require_once('partials/templates/layout.php');
    }

	public function logs(){
		global $wpdb;
		$sp_logs = $wpdb->prefix . PREFIX . 'sp_logs';

		$total_records = $wpdb->get_var("SELECT COUNT(*) FROM $sp_logs");
		$records_per_page = 10;
		$total_pages = ceil($total_records / $records_per_page);

		$current_page_url = isset($_SERVER['REQUEST_URI']) ? esc_url($_SERVER['REQUEST_URI']) : '';
		$current_pagination = isset($_GET['pagination']) ? absint($_GET['pagination']) : 1;
		$offset = ($current_pagination - 1) * $records_per_page;

		$query = "SELECT * FROM $sp_logs ORDER BY `id` DESC LIMIT $offset, $records_per_page ";
		$records = $wpdb->get_results($query); 

		// Pagination
		$total_pages = ceil($total_records / $records_per_page);
		$next_page = min($total_pages, $current_pagination + 1);
		$prev_page = max(1, $current_pagination - 1);
		$flag = true;

		$page_variable = array();
        $page_variable['page_title'] = "Logs - Draft Schedule";
        $page_variable['form_action'] = "";
        $page_variable['admin_page_path'] = 'partials/draft-schedule-admin/logs.php';
        
        require_once('partials/templates/layout.php');
	}

	public function insert_logs( $time, $post_id, $new_post_date, $author) {
		global $wpdb;
		$sp_logs = $wpdb->prefix . PREFIX . 'sp_logs';

		$wpdb->insert($sp_logs, array(
			'timeofchange' => $time,
			'post_id' => $post_id,
			'new_post_date' => $new_post_date,
			'author' => $author
		));
	}

	public function crons_intervals( $schedules ) {
		$schedules['sp_one_day'] = array(
			'interval' => 86400,
			'display' => __('bxb schedule post once daily')
		);
		
		return $schedules;
	}

	public function draft_to_schedule() {
		if (UtilityAdmin::get_option('draft_to_schedule_status') != 'true'){
			$this->insert_logs(date('Y-m-d H:i:s',time()),'Module Disabled', 'Module Disabled','Module Disabled' );
			return;
		}
		
		date_default_timezone_set('Asia/Kolkata');
		$day_today = date('D');

		$articles_range = '';
		$minimum_delay = '';
		$timing_range = '';
		$authors = '';

		$articles_range = UtilityAdmin::get_option('sp_articles_range_'.strtolower($day_today));
		$articles_range = isset($articles_range) ? $articles_range : '';
		$minimum_delay = UtilityAdmin::get_option('sp_delay_'.strtolower($day_today));
		$minimum_delay = isset($minimum_delay) ? $minimum_delay : '';
		$timing_range = UtilityAdmin::get_option('sp_timing_'.strtolower($day_today));
		$timing_range = isset($timing_range) ? $timing_range : '';
		$authors = UtilityAdmin::get_option('sp_author_'.strtolower($day_today));
		$authors = isset($authors) ? $authors : '';
		if(empty($authors)){
			$authors = array();
		}
		
		$number_of_articles = 0;
		if(!empty($articles_range)){
			$articles_split = explode("-",$articles_range);
			if(empty($articles_split[1])){
				$articles_split[1] = $articles_split[0];
			}
			if(is_array($articles_split) && isset($articles_split[0]) && isset($articles_split[1])){
				$min_value = $articles_split[0];
				$max_value = $articles_split[1];
				if(is_numeric($min_value) && is_numeric($max_value)){
					$min_value = (int)$min_value;
					$max_value = (int)$max_value;
					$number_of_articles = rand($min_value, $max_value);
				}
			}
		}

		$delay_in_minutes = 1;
		if((!empty($minimum_delay)) && is_numeric($minimum_delay)){
			$delay_in_minutes = (int)$minimum_delay;
		}

		$minimum_time = time();
		$maximum_time = strtotime('23:59');
		if(!empty($timing_range)){
			$timing_split = explode("-",$timing_range);
			if(is_array($timing_split) && isset($timing_split[0]) && isset($timing_split[1])){
				$min_time_value = $timing_split[0];
				$max_time_value = $timing_split[1];
				$min_timestamp = strtotime($min_time_value);
				$max_timestamp = strtotime($max_time_value);
				if($min_timestamp) {
					$minimum_time = $min_timestamp;
				}
				if($max_timestamp) {
					$maximum_time = $max_timestamp;
				}
			}
		}

		$args = array(
			'post_type' => 'post',
			'post_status' => array( 'draft' ),
			'posts_per_page' => -1,
		);
		$query = new \WP_Query( $args );
		$all_posts = $query->get_posts();

		$counter = 0;

		foreach($all_posts as $_post){
			if($counter >= $number_of_articles){
				break;
			}
			$postdate = date('Y-m-d H:i:s',$minimum_time);
			$postdate_gmt = gmdate('Y-m-d H:i:s',$minimum_time);
			if(!empty($authors)){
				$random_index = rand(0, count($authors)-1);
				$author_val_randd = (int)$authors[$random_index];
				$post_arr = array(
					'ID' => $_post->ID,
					'post_date_gmt'  => $postdate_gmt,
					'post_date'  => $postdate,
					'edit_date' => true,
					'post_status' => 'future',
					'post_author' => $author_val_randd
				);

				$this->insert_logs(date('Y-m-d H:i:s',time()),$_post->ID, $postdate,$author_val_randd );
			} else {
				$post_arr = array(
					'ID' => $_post->ID,
					'post_date_gmt'  => $postdate_gmt,
					'post_date'  => $postdate,
					'edit_date' => true,
					'post_status' => 'future'
				);

				$this->insert_logs(date('Y-m-d H:i:s',time()),$_post->ID, $postdate,'Default' );
			}
			
			wp_update_post($post_arr);
			$minimum_time = $minimum_time + ($delay_in_minutes * 60);
			if($minimum_time > $maximum_time){
				break;
			}
			$counter++;

		}
	}

}
