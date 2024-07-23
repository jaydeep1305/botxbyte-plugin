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
class SocialMediaAdmin {

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
		
		
		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

	public function save_settings(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		// Social Media Prompts
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		// Schedule Posts
		UtilityAdmin::update_option('social_media_html');
		UtilityAdmin::update_option('ifttt_url', 'https://maker.ifttt.com/trigger/'.str_replace(":","_",str_replace(".","_",$_SERVER['HTTP_HOST'] ?? '') ?? '').'/json/with/key/jy5W2pNU5B7rhWs5z7-fEEbhysVeuMGdVITm2obGJCx');
		echo wp_json_encode(array('success'=>'yes'));
		exit();
	}

    public function admin_page(){
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		// Rephrasing 
        $ifttt_url = UtilityAdmin::get_option('ifttt_url');
        
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
			UtilityAdmin::get_option('social_fb_caption_prompt') === "" and
			UtilityAdmin::get_option('social_tw_caption_prompt') === "" and
			UtilityAdmin::get_option('social_pt_caption_prompt') === "" and
			UtilityAdmin::get_option('social_system_prompt') === ""
		){
			array_push($errors_html, 'Prompts are not set.');
		}

		$page_variable = array();
        $page_variable['page_title'] = "Social Media";
        $page_variable['form_action'] = '';
        $page_variable['admin_page_path'] = 'partials/social-media-admin/admin_page.php';
        $page_variable['button'] = 'admin.php?page=botxbyte-social-media-logs';
		$page_variable['module'] = UtilityAdmin::get_option('social_media_status');
        require_once('partials/templates/layout.php');
    }

    public function logs(){
		global $wpdb;
		$social_logs = $wpdb->prefix . PREFIX . 'social_logs';

		$total_records = $wpdb->get_var("SELECT COUNT(*) FROM $social_logs");
		$records_per_page = 10;
		$total_pages = ceil($total_records / $records_per_page);

		$current_page_url = isset($_SERVER['REQUEST_URI']) ? esc_url($_SERVER['REQUEST_URI']) : '';
		$current_pagination = isset($_GET['pagination']) ? absint($_GET['pagination']) : 1;
		$offset = ($current_pagination - 1) * $records_per_page;

		$query = "SELECT * FROM $social_logs ORDER BY `id` DESC LIMIT $offset, $records_per_page ";
		$records = $wpdb->get_results($query); 

		// Pagination
		$total_pages = ceil($total_records / $records_per_page);
		$next_page = min($total_pages, $current_pagination + 1);
		$prev_page = max(1, $current_pagination - 1);
		$flag = true;

		$page_variable = array();
        $page_variable['page_title'] = "Logs - Social Media Post";
        $page_variable['form_action'] = "";
        $page_variable['admin_page_path'] = 'partials/social-media-admin/logs.php';
        
        require_once('partials/templates/layout.php');
	}

	function insert_logs( $time, $post_id, $status, $response) {
		global $wpdb;
		$rp_logs = $wpdb->prefix . PREFIX . 'social_logs';

		$wpdb->insert($rp_logs, array(
			'timeofchange' => $time,
			'post_id' => $post_id,
			'status' => $status,
			'response' => $response
		));
	}

	function ai_generation($prompt) {
		$result = '';

		$social_system_prompt = UtilityAdmin::get_option('social_system_prompt');
		$type = UtilityAdmin::get_option('rp_type');
		$openai_key = UtilityAdmin::get_option('rp_openai_key');
		$openai_model = UtilityAdmin::get_option('rp_openai_model');
		$azure_api_version = UtilityAdmin::get_option('rp_azure_api_version');
		$azure_api_base = UtilityAdmin::get_option('rp_azure_api_base');
		$azure_api_key = UtilityAdmin::get_option('rp_azure_api_key');
		$azure_engine = UtilityAdmin::get_option('rp_azure_api_engine');

		if(!empty($prompt)){
			if($type == "Openai" && !empty($openai_model)){ 
				$apiUrl  = "https://api.openai.com/v1/chat/completions";

				$messages = array();
				$system_obj = new \stdClass;
				$system_obj->role = "system";
				$system_obj->content = $social_system_prompt;
				array_push($messages, $system_obj);
				$user_obj = new \stdClass;
				$user_obj->role = "user";
				$user_obj->content = $prompt;
				array_push($messages, $user_obj);
				
				$data = array(
					"model" => $openai_model,
					"messages" => $messages,
					'temperature' => 1,
					'max_tokens' => 200,
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
								$result = $content_txt;
							}
						}		
					} 	
				}
			} else if ($type == "Azure" && !empty($azure_api_base) && !empty($azure_engine) && !empty($azure_api_version) && !empty($azure_api_key)) {
				$apiUrl = $azure_api_base."/openai/deployments/".$azure_engine."/chat/completions?api-version=".$azure_api_version;
				$messages = array();
				$system_obj = new \stdClass;
				$system_obj->role = "system";
				$system_obj->content = $social_system_prompt;
				array_push($messages, $system_obj);
				$user_obj = new \stdClass;
				$user_obj->role = "user";
				$user_obj->content = $prompt;
				array_push($messages, $user_obj);
				
				$data = array(
					"messages" => $messages,
				);

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
								$result = $content_txt;
							}
						}		
					} 	
				}
			}
		}

		return $result;

	}


	function post_published_trigger($post_id, $post, $update) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		if (UtilityAdmin::get_option('social_media_status') != 'true'){
			$this->insert_logs(date('Y-m-d H:i:s',time()), '', 'Fail', 'Module is Disabled.');
			return;
		}

		$ifttt_url = UtilityAdmin::get_option('ifttt_url');
		if($ifttt_url !== "") {
			try {
				$post_obj = new \stdClass();
				$post_obj->post_id = $post_id;
				$_post = get_post($post_id);
				$post_obj->post = get_post($post_id);
				$post_obj->post_meta = get_post_meta($post_id);
				$post_meta = $post_obj->post_meta;
				$post_obj->post_thumbnail = get_the_post_thumbnail_url($post_id);
				$post_obj->post_permalink = get_post_permalink($post_id);

				if(!(
						isset($post_meta['fb_caption']) && 
						isset($post_meta['tw_caption']) && 
						isset($post_meta['pt_caption'])
					)
				){

					$social_fb_caption_prompt = UtilityAdmin::get_option('social_fb_caption_prompt');
					$social_fb_caption_prompt = isset($social_fb_caption_prompt) ? $social_fb_caption_prompt : '';
	
					$social_tw_caption_prompt = UtilityAdmin::get_option('social_tw_caption_prompt');
					$social_tw_caption_prompt = isset($social_tw_caption_prompt) ? $social_tw_caption_prompt : '';
	
					$social_pt_caption_prompt = UtilityAdmin::get_option('social_pt_caption_prompt');
					$social_pt_caption_prompt = isset($social_pt_caption_prompt) ? $social_pt_caption_prompt : '';
					$post_title = $post_obj->post->post_title;

					$social_fb_caption_prompt = $this->ai_generation($social_fb_caption_prompt . ' ' . $post_title);
					$social_tw_caption_prompt = $this->ai_generation($social_tw_caption_prompt . ' ' . $post_title);
					$social_pt_caption_prompt = $this->ai_generation($social_pt_caption_prompt . ' ' . $post_title);

					update_post_meta($post_id, 'fb_caption', $social_fb_caption_prompt);
					update_post_meta($post_id, 'tw_caption', $social_tw_caption_prompt);
					update_post_meta($post_id, 'pt_caption', $social_pt_caption_prompt);
			
					$post_obj->fb_caption = $social_fb_caption_prompt;
					$post_obj->tw_caption = $social_tw_caption_prompt;
					$post_obj->pt_caption = $social_pt_caption_prompt;
				}
				else{
					
					$post_obj->fb_caption = $post_meta['fb_caption'][0];
					$post_obj->tw_caption = $post_meta['tw_caption'][0];
					$post_obj->pt_caption = $post_meta['pt_caption'][0];
				}

				$all_terms = get_the_terms($post_id,'category');
				$categories_object = new \stdClass();
				foreach($all_terms as $_terms){
					$term_name = $_terms->slug;
					$categories_object->$term_name = $_terms;
				}

				$taxonomies_object = new \stdClass();
				$taxonomies_object->category = $categories_object;
				$post_obj->taxonomies = $taxonomies_object;

				$header = array();
				$header[] = "Content-Type: application/json";
				$ch = curl_init($ifttt_url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($post_obj));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec($ch);
				$this->insert_logs(date('Y-m-d H:i:s',time()), $post_id, 'Success', $response);
			}
			catch (Exception $e) {
				$this->insert_logs(date('Y-m-d H:i:s',time()), '', 'Error', $e->getMessage());
			}
			// print_r($response);
		}else{
			$this->insert_logs(date('Y-m-d H:i:s',time()), '', 'Fail', 'IFTTT Url is not Set.');
		}

	}

}