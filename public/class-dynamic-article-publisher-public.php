<?php
/**
 * Plugin Name: Dynamic Article Publisher
 * Description: A custom REST API endpoint for dynamically publishing articles with custom fields.
 * Version: 1.0
 * Author: Your Name
 */
namespace Botxbyte;

class DynamicArticlePublisherPublic {

    public function dynamic_article_publisher_register_custom_route() {
        register_rest_route('botxbyte/v1', '/dynamic-article-publish/', array(
            'methods' => 'POST',
            'callback' => array(new DynamicArticlePublisherPublic(), 'publish_article'),
            'permission_callback' => function () {
                return current_user_can('publish_posts');
            }
        ));
        register_rest_route('botxbyte/v1', '/article-info/', array(
            'methods' => 'POST',
            'callback' => array(new DynamicArticlePublisherPublic(), 'article_info'),
            'permission_callback' => function () {
                return current_user_can('publish_posts');
            }
        ));
    }

    public function publish_article($request) {
        $parameters = $request->get_json_params();

        $post_title = sanitize_text_field($parameters['post_title']);
        $content = sanitize_textarea_field($parameters['content']);

        $post_id = wp_insert_post(array(
            'post_title'    => $post_title,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'post',
        ));

        if ($post_id == 0 || is_wp_error($post_id)) {
            return new \WP_Error('post_creation_failed', 'Failed to create post', array('status' => 422));
        }

        // Loop through all other parameters and save them as custom fields.

        foreach ($parameters as $key => $value) {
            if (!in_array($key, ['post_title', 'content'])) {
                add_post_meta($post_id, $key, $value, true);
            }
        }

        return new \WP_REST_Response(array('status' => 'success', 'post_id' => $post_id), 200);
    }

    public function article_info($request) {
        $parameters = $request->get_json_params();

        $slug = sanitize_text_field($parameters['slug']);

        if (!$slug) {
            return new \WP_Error('post_info_failed', 'Failed to get slug', array('status' => 422));
        }

        $post = get_page_by_path($slug, OBJECT, 'post');

        if (!$post) {
            return new \WP_Error('post_info_failed', 'Failed to get post', array('status' => 422));
        }

        $post_id = $post->ID;
        $post_title = $post->post_title;
        $post_status = $post->post_status;
        $post_date = $post->post_date;
        $post_modified_date = $post->post_modified;
        $author_id = $post->post_author;
        $author_name = get_the_author_meta('display_name', $author_id);
        $author_info = [
            [
                'author_id' => $author_id,
                'name' => $author_name,
            ]
        ];

        $post_content = $post->post_content;

        // Word count
        $word_count = str_word_count(strip_tags($post_content));

        // Categories with name and ID
        $categories = get_the_category($post_id);
        $category_info = [];
        foreach ($categories as $category) {
            $category_info[] = ['name' => $category->name, 'cat_id' => $category->term_id];
        }

        // Tags info
        $tags = get_the_tags($post_id);
        $tags_info = [];
        foreach ($tags as $tag) {
            $tags_info[] = ['name' => $tag->name, 'tag_id' => $tag->term_id];
        }

        // Heading count
        preg_match_all('/<h[1-6][^>]*>.*?<\/h[1-6]>/', $post_content, $headings);
        $heading_count = count($headings[0]);

        // Image count
        preg_match_all('/<img[^>]+>/', $post_content, $images);
        $image_count = count($images[0]);

        // Internal link count
        $internal_link_count = 0;
        $external_link_count = 0;
        preg_match_all('/<a[^>]+href=["\']([^"\']+)["\'][^>]*>/', $post_content, $links);
        foreach ($links[1] as $link) {
            if ($link != null){
                if (strpos($link, home_url()) !== false) {
                    $internal_link_count++;
                } else {
                    $external_link_count++;
                }    
            }
        }

        return new \WP_REST_Response(
            [   
                'post_title' => $post_title,
                'post_status' => $post_status,
                'created_date' => $post_date,
                'modified_date' => $post_modified_date,
                'author_info' => $author_info,
                'word_count' => $word_count,
                'categories' => $category_info,
                'tags' => $tags_info,
                'heading_count' => $heading_count,
                'image_count' => $image_count,
                'internal_link_count' => $internal_link_count,
                'external_link_count' => $external_link_count,
                'status' => 'success'
            ], 200);
    }
}