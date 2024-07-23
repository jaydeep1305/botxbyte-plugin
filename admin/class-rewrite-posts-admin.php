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
class RewritePostsAdmin {

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
		// Schedule Posts
		UtilityAdmin::update_option('rp_articles_range_mon');
		UtilityAdmin::update_option('rp_articles_range_tue');
		UtilityAdmin::update_option('rp_articles_range_wed');
		UtilityAdmin::update_option('rp_articles_range_thu');
		UtilityAdmin::update_option('rp_articles_range_fri');
		UtilityAdmin::update_option('rp_articles_range_sat');
		UtilityAdmin::update_option('rp_articles_range_sun');

		UtilityAdmin::update_option('rp_delay_mon');
		UtilityAdmin::update_option('rp_delay_tue');
		UtilityAdmin::update_option('rp_delay_wed');
		UtilityAdmin::update_option('rp_delay_thu');
		UtilityAdmin::update_option('rp_delay_fri');
		UtilityAdmin::update_option('rp_delay_sat');
		UtilityAdmin::update_option('rp_delay_sun');

		UtilityAdmin::update_option('rp_timing_mon');
		UtilityAdmin::update_option('rp_timing_tue');
		UtilityAdmin::update_option('rp_timing_wed');
		UtilityAdmin::update_option('rp_timing_thu');
		UtilityAdmin::update_option('rp_timing_fri');
		UtilityAdmin::update_option('rp_timing_sat');
		UtilityAdmin::update_option('rp_timing_sun');

		UtilityAdmin::update_option('rp_change_mon');
		UtilityAdmin::update_option('rp_change_tue');
		UtilityAdmin::update_option('rp_change_wed');
		UtilityAdmin::update_option('rp_change_thu');
		UtilityAdmin::update_option('rp_change_fri');
		UtilityAdmin::update_option('rp_change_sat');
		UtilityAdmin::update_option('rp_change_sun');

		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

    public function admin_page(){
		// Rephrasing 
        $rp_articles_range_mon = UtilityAdmin::get_option('rp_articles_range_mon');
        $rp_articles_range_tue = UtilityAdmin::get_option('rp_articles_range_tue');
        $rp_articles_range_wed = UtilityAdmin::get_option('rp_articles_range_wed');
        $rp_articles_range_thu = UtilityAdmin::get_option('rp_articles_range_thu');
        $rp_articles_range_fri = UtilityAdmin::get_option('rp_articles_range_fri');
        $rp_articles_range_sat = UtilityAdmin::get_option('rp_articles_range_sat');
        $rp_articles_range_sun = UtilityAdmin::get_option('rp_articles_range_sun');

        $rp_delay_mon = UtilityAdmin::get_option('rp_delay_mon');
        $rp_delay_tue = UtilityAdmin::get_option('rp_delay_tue');
        $rp_delay_wed = UtilityAdmin::get_option('rp_delay_wed');
        $rp_delay_thu = UtilityAdmin::get_option('rp_delay_thu');
        $rp_delay_fri = UtilityAdmin::get_option('rp_delay_fri');
        $rp_delay_sat = UtilityAdmin::get_option('rp_delay_sat');
        $rp_delay_sun = UtilityAdmin::get_option('rp_delay_sun');

        $rp_timing_mon = UtilityAdmin::get_option('rp_timing_mon');
        $rp_timing_tue = UtilityAdmin::get_option('rp_timing_tue');
        $rp_timing_wed = UtilityAdmin::get_option('rp_timing_wed');
        $rp_timing_thu = UtilityAdmin::get_option('rp_timing_thu');
        $rp_timing_fri = UtilityAdmin::get_option('rp_timing_fri');
        $rp_timing_sat = UtilityAdmin::get_option('rp_timing_sat');
        $rp_timing_sun = UtilityAdmin::get_option('rp_timing_sun');

        $rp_change_mon = UtilityAdmin::get_option('rp_change_mon');
        $rp_change_tue = UtilityAdmin::get_option('rp_change_tue');
        $rp_change_wed = UtilityAdmin::get_option('rp_change_wed');
        $rp_change_thu = UtilityAdmin::get_option('rp_change_thu');
        $rp_change_fri = UtilityAdmin::get_option('rp_change_fri');
        $rp_change_sat = UtilityAdmin::get_option('rp_change_sat');
        $rp_change_sun = UtilityAdmin::get_option('rp_change_sun');

		// Errors Check
		$errors_html = array();
		$ai_configuration_html = "";
		
		// Ai Configuration
        $rp_type = UtilityAdmin::get_option('rp_type') ?: 'Openai';
        if($rp_type == "Openai"){
            if(
                UtilityAdmin::get_option('rp_openai_key') !== "" or
                UtilityAdmin::get_option('rp_openai_model') !== ""
            ){
                $ai_configuration_html = "Connected";
            }
        }
        else{
            if(
                UtilityAdmin::get_option('rp_azure_api_version') !== "" or
                UtilityAdmin::get_option('rp_azure_api_base') !== "" or
                UtilityAdmin::get_option('rp_azure_api_key') !== "" or
                UtilityAdmin::get_option('rp_azure_api_engine') !== ""
            ){
                $ai_configuration_html = "Connected";
            }
        }
        if ($ai_configuration_html !== "Connected"){
            array_push($errors_html, $rp_type.' not set.');
        }

		// Rewrite Prompt 
		if(
			UtilityAdmin::get_option('rp_title_prompt') === "" and
			UtilityAdmin::get_option('rp_meta_description_prompt') === "" and
			UtilityAdmin::get_option('rp_content_prompt') === "" and
			UtilityAdmin::get_option('rp_system_prompt') === ""
		){
			array_push($errors_html, 'Prompts are not set.');
		}

		$page_variable = array();
        $page_variable['page_title'] = "Rewrite Posts";
        $page_variable['form_action'] = '';
        $page_variable['admin_page_path'] = 'partials/rewrite-posts-admin/admin_page.php';
        $page_variable['button'] = 'admin.php?page=botxbyte-rewrite-posts-logs';
		$page_variable['module'] = UtilityAdmin::get_option('rewrite_posts_status');
		$page_variable['module_ai'] = UtilityAdmin::get_option('ai_configuration_status');
        require_once('partials/templates/layout.php');
    }

    public function logs(){
		global $wpdb;
		$sp_logs = $wpdb->prefix . PREFIX . 'rp_logs';

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
        $page_variable['page_title'] = "Logs - Rewrite Post";
        $page_variable['form_action'] = "";
        $page_variable['admin_page_path'] = 'partials/rewrite-posts-admin/logs.php';
        
        require_once('partials/templates/layout.php');
	}

	public function crons_intervals( $schedules ) {
		$schedules['rp_fifteen_min'] = array(
			'interval' => 900,
			'display' => __('bxb rewrite post fifteen minutes')
		);
		
		return $schedules;
	}

	function insert_logs( $time, $post_id, $change_type, $old_value, $new_value) {
		global $wpdb;
		$rp_logs = $wpdb->prefix . PREFIX . 'rp_logs';

		$wpdb->insert($rp_logs, array(
			'timeofchange' => $time,
			'post_id' => $post_id,
			'change_type' => $change_type,
			'old_value' => $old_value,
			'new_value' => $new_value
		));
	}

	function rewrite_posts() {
		if (UtilityAdmin::get_option('rewrite_posts_status') != 'true' || UtilityAdmin::get_option('ai_configuration_status') != 'true'){
			$this->insert_logs(date('Y-m-d H:i:s',time()),'Module Disabled - AI or Rewrite', 'Module Disabled - AI or Rewrite','Module Disabled - AI or Rewrite', 'Module Disabled - AI or Rewrite' );
			return;
		}
		
		date_default_timezone_set('Asia/Kolkata');
		$day_today = date('D');

		$articles_range = '';
		$minimum_delay = '';
		$timing_range = '';
		$change = '';
		$articles_range = UtilityAdmin::get_option('rp_articles_range_'.strtolower($day_today));
		$articles_range = isset($articles_range) ? $articles_range : '';
		$minimum_delay = UtilityAdmin::get_option('rp_delay_'.strtolower($day_today));
		$minimum_delay = isset($minimum_delay) ? $minimum_delay : '';
		$timing_range = UtilityAdmin::get_option('rp_timing_'.strtolower($day_today));
		$timing_range = isset($timing_range) ? $timing_range : '';
		$change = UtilityAdmin::get_option('rp_change_'.strtolower($day_today));
		$change = isset($change) ? $change : '';
		if(empty($change)){
			$change = array();
		}

		$number_of_articles = 0;
		if(!empty($articles_range)){
			$articles_split = explode("-",$articles_range);
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

		$saved_day_name = UtilityAdmin::get_option('rp_work_day_name');
		$saved_day_name = isset($saved_day_name) ? $saved_day_name : '';

		$max_articles = UtilityAdmin::get_option('rp_work_day_max_articles');
		$max_articles = isset($max_articles) ? $max_articles : '';
		if(empty($max_articles)){
			$max_articles = 0;
		}

		
		if($saved_day_name != $day_today || $max_articles == 0){
			UtilityAdmin::update_option('rp_work_day_name', $day_today);
			UtilityAdmin::update_option('rp_work_day_max_articles', $number_of_articles);
			UtilityAdmin::update_option('rp_work_day_rewritten_articles', '0');
			UtilityAdmin::update_option('rp_work_day_last_publish_time', '0');
		}

		$max_articles = UtilityAdmin::get_option('rp_work_day_max_articles');
		$max_articles = isset($max_articles) ? $max_articles : '';
		if(empty($max_articles)){
			$max_articles = 0;
		}

		$rewritten_articles_today = UtilityAdmin::get_option('rp_work_day_rewritten_articles');
		$rewritten_articles_today = isset($rewritten_articles_today) ? $rewritten_articles_today : '';
		if(empty($rewritten_articles_today)){
			$rewritten_articles_today = 0;
		}

		$last_publish_time = UtilityAdmin::get_option('rp_work_day_last_publish_time');
		$last_publish_time = isset($last_publish_time) ? $last_publish_time : '';
		if(empty($last_publish_time)){
			$last_publish_time = 0;
		}

		$title_prompt = UtilityAdmin::get_option('rp_title_prompt');
		$meta_description_prompt = UtilityAdmin::get_option('rp_meta_description_prompt');
		$content_prompt = UtilityAdmin::get_option('rp_content_prompt');
		$system_prompt = UtilityAdmin::get_option('rp_system_prompt');
		$type = UtilityAdmin::get_option('rp_type');
		$openai_key = UtilityAdmin::get_option('rp_openai_key');
		$openai_model = UtilityAdmin::get_option('rp_openai_model');
		$azure_api_version = UtilityAdmin::get_option('rp_azure_api_version');
		$azure_api_base = UtilityAdmin::get_option('rp_azure_api_base');
		$azure_api_key = UtilityAdmin::get_option('rp_azure_api_key');
		$azure_engine = UtilityAdmin::get_option('rp_azure_api_engine');

		$change_type = '';
		if(!empty($change)){
			$random_index_change_type = rand(0, count($change)-1);
			$change_type = $change[$random_index_change_type];
		}
		
		if($max_articles > $rewritten_articles_today){
			$current_timestamp = time(); 
			if( ( $current_timestamp - (int)$last_publish_time ) >= ( ( (int)$delay_in_minutes) * 60 ) ) {
				if( $minimum_time <= $current_timestamp && $maximum_time >= $current_timestamp) {
					$args = array(
						'post_type' => 'post',
						'post_status' => array( 'publish' ),
						'orderby' => 'publish_date',
						'order' => 'ASC',
						'posts_per_page' => 1,
					);
					$query = new \WP_Query( $args );
					$all_posts = $query->get_posts();

					foreach($all_posts as $_post){
						$title = $_post->post_title;

						$meta_description = get_post_meta($_post->ID, 'rank_math_description', true);
						$meta_description = isset($meta_description) ? $meta_description : '';

						$content = $_post->post_content;
						$content_to_be_replaced = '';

						$matches = [];
						preg_match_all('/<p>(.*?)<\/p>/s', $content, $matches);

						if(isset($matches[0])){
							$all_html_p_tags = $matches[0];
							$random_index_p_tags = rand(0, count($all_html_p_tags)-1);
							if(isset($all_html_p_tags[$random_index_p_tags])){
								$content_to_be_replaced = $all_html_p_tags[$random_index_p_tags];
							}
						}

						$prompt = '';
						if($change_type == 'Title') {
							$prompt = $title_prompt .' '. $title;
						} else if($change_type == 'Meta Description') {
							$prompt = $meta_description_prompt .' '. $meta_description;
						} else if($change_type == 'Content') {
							$prompt = $content_prompt .' '. strip_tags($content_to_be_replaced);
						}

						if(!empty($prompt)){

							if($type == "Openai" && !empty($openai_model)){ 
								$apiUrl  = "https://api.openai.com/v1/chat/completions";

								$messages = array();
								$system_obj = new stdClass;
								$system_obj->role = "system";
								$system_obj->content = $system_prompt;
								array_push($messages, $system_obj);
								$user_obj = new stdClass;
								$user_obj->role = "user";
								$user_obj->content = $prompt;
								array_push($messages, $user_obj);
								
								$data = array(
									"model" => $openai_model,
									"messages" => $messages,
									'temperature' => 1,
									'max_tokens' => 500,
									'top_p' => 1,
									'frequency_penalty' => 0,
									'presence_penalty' => 0
								);

								$header = array();
								$header[] = "Content-Type: application/json";
								$header[] = 'Authorization: Bearer '.$openai_key;
								$ch = curl_init($apiUrl);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
								curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								$response = curl_exec($ch);
								$response = json_decode($response);

								if (property_exists($response, 'choices')){
									$choices_array = $response->choices;
									if(is_array($choices_array) && isset($choices_array[0])){
										if(is_object($choices_array[0]->message) && property_exists($choices_array[0],'message')){
											$messages_obj = $choices_array[0]->message;
											if(is_object($messages_obj) && property_exists($messages_obj,'content')){
												$content_txt = $messages_obj->content;

												$postdate = date('Y-m-d H:i:s',$current_timestamp);
												$postdate_gmt = gmdate('Y-m-d H:i:s',$current_timestamp);

												if($change_type == 'Title'){
													$post_arr = array(
														'ID' => $_post->ID,
														'post_date_gmt'  => $postdate_gmt,
														'post_date'  => $postdate,
														'post_title' => $content_txt
													);
													wp_update_post($post_arr);

													update_post_meta($_post->ID, 'rp_change_type', 'Title');
													update_post_meta($_post->ID, 'rp_changed_on', $postdate);
													update_post_meta($_post->ID, 'rp_old_title', $title);
													update_post_meta($_post->ID, 'rp_new_title', $content_txt);
													update_post_meta($_post->ID, 'rp_old_meta_desc', '');
													update_post_meta($_post->ID, 'rp_new_meta_desc', '');
													update_post_meta($_post->ID, 'rp_old_content', '');
													update_post_meta($_post->ID, 'rp_new_content', '');
												} else if ($change_type == 'Meta Description'){
													update_post_meta($_post->ID, 'rank_math_description', $content_txt);
													$post_arr = array(
														'ID' => $_post->ID,
														'post_date_gmt'  => $postdate_gmt,
														'post_date'  => $postdate
													);
													wp_update_post($post_arr);

													update_post_meta($_post->ID, 'rp_change_type', 'Meta Description');
													update_post_meta($_post->ID, 'rp_changed_on', $postdate);
													update_post_meta($_post->ID, 'rp_old_title', '');
													update_post_meta($_post->ID, 'rp_new_title', '');
													update_post_meta($_post->ID, 'rp_old_meta_desc', $meta_description);
													update_post_meta($_post->ID, 'rp_new_meta_desc', $content_txt);
													update_post_meta($_post->ID, 'rp_old_content', '');
													update_post_meta($_post->ID, 'rp_new_content', '');
												} else if($change_type == 'Content') {
													$new_content = str_replace(strip_tags($content_to_be_replaced), $content_txt, $content ?? '');
													$post_arr = array(
														'ID' => $_post->ID,
														'post_date_gmt'  => $postdate_gmt,
														'post_date'  => $postdate,
														'post_content' => $new_content
													);
													wp_update_post($post_arr);

													update_post_meta($_post->ID, 'rp_change_type', 'Content');
													update_post_meta($_post->ID, 'rp_changed_on', $postdate);
													update_post_meta($_post->ID, 'rp_old_title', '');
													update_post_meta($_post->ID, 'rp_new_title', '');
													update_post_meta($_post->ID, 'rp_old_meta_desc', '');
													update_post_meta($_post->ID, 'rp_new_meta_desc', '');
													update_post_meta($_post->ID, 'rp_old_content', strip_tags($content_to_be_replaced));
													update_post_meta($_post->ID, 'rp_new_content', $content_txt);
												}

												$rewritten_articles_today = $rewritten_articles_today + 1;
												UtilityAdmin::update_option('rp_work_day_rewritten_articles', $rewritten_articles_today);

												UtilityAdmin::update_option('rp_work_day_last_publish_time', $current_timestamp);
												
											}
										}		
									} 	
								}
							} else if ($type == "Azure" && !empty($azure_api_base) && !empty($azure_engine) && !empty($azure_api_version) && !empty($azure_api_key)) {

								$apiUrl = $azure_api_base."/openai/deployments/".$azure_engine."/chat/completions?api-version=".$azure_api_version;
								$messages = array();
								$system_obj = new \stdClass;
								$system_obj->role = "system";
								$system_obj->content = $system_prompt;
								array_push($messages, $system_obj);
								$user_obj = new \stdClass;
								$user_obj->role = "user";
								$user_obj->content = $prompt;
								array_push($messages, $user_obj);
								$data = array(
									"messages" => $messages,
								);
								print_r($azure_api_key);

								$header = array();
								$header[] = "Content-Type: application/json";
								$header[] = 'api-key: '.$azure_api_key;
								$ch = curl_init($apiUrl);
								curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
								curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								$response = curl_exec($ch);

								$response = json_decode($response);

								if (property_exists($response, 'choices')){
									$choices_array = $response->choices;
									if(is_array($choices_array) && isset($choices_array[0])){
										if(is_object($choices_array[0]->message) && property_exists($choices_array[0],'message')){
											$messages_obj = $choices_array[0]->message;
											if(is_object($messages_obj) && property_exists($messages_obj,'content')){
												$content_txt = $messages_obj->content;

												$postdate = date('Y-m-d H:i:s',$current_timestamp);
												$postdate_gmt = gmdate('Y-m-d H:i:s',$current_timestamp);

												if($change_type == 'Title'){
													$post_arr = array(
														'ID' => $_post->ID,
														'post_date_gmt'  => $postdate_gmt,
														'post_date'  => $postdate,
														'post_title' => $content_txt
													);
													wp_update_post($post_arr);

													$this->insert_logs($postdate, $_post->ID, 'Title', $title, $content_txt);

													update_post_meta($_post->ID, 'rp_change_type', 'Title');
													update_post_meta($_post->ID, 'rp_changed_on', $postdate);
													update_post_meta($_post->ID, 'rp_old_title', $title);
													update_post_meta($_post->ID, 'rp_new_title', $content_txt);
													update_post_meta($_post->ID, 'rp_old_meta_desc', '');
													update_post_meta($_post->ID, 'rp_new_meta_desc', '');
													update_post_meta($_post->ID, 'rp_old_content', '');
													update_post_meta($_post->ID, 'rp_new_content', '');
												} else if ($change_type == 'Meta Description'){
													update_post_meta($_post->ID, 'rank_math_description', $content_txt);
													$post_arr = array(
														'ID' => $_post->ID,
														'post_date_gmt'  => $postdate_gmt,
														'post_date'  => $postdate
													);
													wp_update_post($post_arr);

													$this->insert_logs($postdate, $_post->ID, 'Meta Description', $meta_description, $content_txt);

													update_post_meta($_post->ID, 'rp_change_type', 'Meta Description');
													update_post_meta($_post->ID, 'rp_changed_on', $postdate);
													update_post_meta($_post->ID, 'rp_old_title', '');
													update_post_meta($_post->ID, 'rp_new_title', '');
													update_post_meta($_post->ID, 'rp_old_meta_desc', $meta_description);
													update_post_meta($_post->ID, 'rp_new_meta_desc', $content_txt);
													update_post_meta($_post->ID, 'rp_old_content', '');
													update_post_meta($_post->ID, 'rp_new_content', '');
												} else if($change_type == 'Content') {
													$new_content = str_replace(strip_tags($content_to_be_replaced), $content_txt, $content ?? '');
													$post_arr = array(
														'ID' => $_post->ID,
														'post_date_gmt'  => $postdate_gmt,
														'post_date'  => $postdate,
														'post_content' => $new_content
													);
													wp_update_post($post_arr);

													$this->insert_logs($postdate, $_post->ID, 'Content', strip_tags($content_to_be_replaced), $content_txt);

													update_post_meta($_post->ID, 'rp_change_type', 'Content');
													update_post_meta($_post->ID, 'rp_changed_on', $postdate);
													update_post_meta($_post->ID, 'rp_old_title', '');
													update_post_meta($_post->ID, 'rp_new_title', '');
													update_post_meta($_post->ID, 'rp_old_meta_desc', '');
													update_post_meta($_post->ID, 'rp_new_meta_desc', '');
													update_post_meta($_post->ID, 'rp_old_content', strip_tags($content_to_be_replaced));
													update_post_meta($_post->ID, 'rp_new_content', $content_txt);
												}

												$rewritten_articles_today = $rewritten_articles_today + 1;
												UtilityAdmin::update_option('rp_work_day_rewritten_articles', $rewritten_articles_today);

												UtilityAdmin::update_option('rp_work_day_last_publish_time', $current_timestamp);
												
											}
										}		
									} 	
								}
							}
						}
					}
				}
			}
		}

	}

}