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
class PostDateChangeAdmin {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
    }

    
	// Post Date Change
	public function admin_page(){
        require_once(ABSPATH . 'wp-load.php');
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        if(isset($_GET['start_time']) && isset($_GET['end_time']) && isset($_GET['posts_limit']) && isset($_GET['posts_offset'])) {
            date_default_timezone_set('Asia/Kolkata');
            $startTime = strtotime($_GET['start_time']);
            $endTime = strtotime($_GET['end_time']);
            $limit = $_GET['posts_limit'];
            $offset = $_GET['posts_offset'];

            if(isset($_GET['post_urls'])) {
                $postUrls = $_GET['post_urls'];
                $postUrls = explode("\r\n", $postUrls);
                $postUrls = array_filter($postUrls);
                $postUrls = array_map('trim', $postUrls);

                // Extract slugs from URLs
                $postSlugs = array_map(function($url) {
                    $parts = explode("/", $url);
                    $parts = array_filter($parts);
                    $parts = array_values($parts);
                    return end($parts);
                }, $postUrls);

                // Fetch posts by slugs
                $posts = get_posts([
                    'posts_per_page' => $limit,
                    'offset' => $offset,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'suppress_filters' => true,
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'name__in' => $postSlugs,
                ]);

                echo "Filtered by Specific URLs<br/>";
            } else {
                $posts = get_posts([
                    'posts_per_page' => $limit,
                    'offset' => $offset,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'suppress_filters' => true,
                ]);
            }
            $changed_posts_data = array();
            foreach($posts as $post) {
                $postId = $post->ID;
                $postEditLink = get_edit_post_link($postId);
                $postTitle = $post->post_title;
                $randomTimestamp = mt_rand($startTime, $endTime);
                $newPostDate = date('Y-m-d H:i:s', $randomTimestamp);
                $changed_posts_data[] = array('postId' => $postId, 'postEditLink'=>$postEditLink, 'postTitle'=> $postTitle, 'newPostDate' => $newPostDate, 'oldPostDate' => $post->post_date);
                // echo $postId . " -- " . $newPostDate . "<br/>";

                $updateArgs = [
                    'ID' => $postId,
                    'post_date' => $newPostDate,
                    'post_date_gmt' => get_gmt_from_date($newPostDate),
                ];

                wp_update_post($updateArgs);

                $postModifiedGmt = get_gmt_from_date($newPostDate);
                global $wpdb;
                $wpdb->query("UPDATE `$wpdb->posts` SET `post_modified` = '" . $newPostDate . "', `post_modified_gmt` = '" . $postModifiedGmt . "' WHERE ID = " . $postId);
            }
            
        } 

		$form_action = 'admin.php?page=botxbyte-post-date-change-settings';
		// current timestamp
		$current_timestamp = time();
		// 2 day before timestamp
		$two_day_before_timestamp = $current_timestamp - (2 * 24 * 60 * 60);

        $page_variable = array();
        $page_variable['page_title'] = "Post Date Change";
        $page_variable['form_action'] = $form_action;
        $page_variable['admin_page_path'] = 'partials/post-date-change-admin/admin_page.php';
        
        require_once('partials/templates/layout.php');
	}

}