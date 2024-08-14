<?php 

namespace Botxbyte;
set_time_limit(300);

class DynamicArticlePublisherPublic {

    public function dynamic_article_publisher_register_custom_route() {
        register_rest_route('botxbyte/v1', '/dynamic-article-publish/', array(
            'methods' => 'POST',
            'callback' => array($this, 'publish_article'),
            'permission_callback' => function () {
                return current_user_can('publish_posts');
            }
        ));
        register_rest_route('botxbyte/v1', '/article-info/', array(
            'methods' => 'POST',
            'callback' => array($this, 'article_info'),
            'permission_callback' => function () {
                return current_user_can('publish_posts');
            }
        ));
    }

    public function publish_article($request) {
        $parameters = $request->get_json_params();
    
        // Initialize featured_media ID
        $featured_media_id = 0;
    
        // Check if featured_media_url is provided and process the image
        if (isset($parameters['featured_media_url']) && !empty($parameters['featured_media_url'])) {
            $featured_media_url = esc_url_raw($parameters['featured_media_url']);
    
            // Download the image from the URL
            $image = $this->download_image_from_url($featured_media_url);
    
            if (!is_wp_error($image)) {
                // Upload the image to the WordPress media library
                $featured_media_id = $this->upload_image_to_media_library($image);
            } else {
                return new \WP_REST_Response(
                    array(
                        'status' => 'error',
                        'message' => $image->get_error_message()
                    ),
                    422
                );
            }
    
            // Handle error if the image download or upload fails
            if (is_wp_error($featured_media_id) || $featured_media_id === 0) {
                return new \WP_REST_Response(
                    array(
                        'status' => 'error',
                        'message' => $featured_media_id->get_error_message()
                    ),
                    422
                );
            }
        }
        
        // Categories, tags, and authors
        $categories = $parameters['categories'];
        $category_ids = $this->get_or_create_terms($categories, 'category');
        $tags = $parameters['tags'];
        $tag_ids = $this->get_or_create_terms($tags, 'post_tag');
        $author_data = $parameters['author'];
        $author_id = $this->get_or_create_author($author_data);
        
        // Download and replace image URLs in the content
        if (isset($parameters['content'])) {
            $parameters['content'] = $this->download_and_replace_images($parameters['content']);
        }

        // Set default values if not provided
        $post_args = array(
            'post_title'    => isset($parameters['post_title']) ? sanitize_text_field($parameters['post_title']) : '',
            'post_content'  => isset($parameters['content']) ? $parameters['content'] : '',
            'post_status'   => isset($parameters['status']) ? sanitize_text_field($parameters['status']) : 'publish',
            'post_author'   => $author_id,
            'post_excerpt'  => isset($parameters['excerpt']) ? sanitize_text_field($parameters['excerpt']) : '',
            'post_date'     => isset($parameters['date']) ? sanitize_text_field($parameters['date']) : '',
            'post_type'     => 'post',
            'post_category' => $category_ids,
            'tags_input'    => $tags,
            'meta_input'    => array(),
        );
    
        // Add the featured_media ID if it exists
        if ($featured_media_id > 0) {
            $post_args['meta_input']['_thumbnail_id'] = $featured_media_id;
        }
    
        // Insert the post into the database
        $post_id = wp_insert_post($post_args);
    
        if ($post_id == 0 || is_wp_error($post_id)) {
            return new \WP_REST_Response(
                array(
                    'status' => 'error',
                    'message' => 'Failed to create post'
                ),
                422
            );
        }
    
        // Loop through all custom fields provided in the request and save them
        foreach ($parameters as $key => $value) {
            if (!in_array($key, ['post_title', 'content', 'status', 'author', 'excerpt', 'date', 'categories', 'tags', 'featured_media_url'])) {
                update_post_meta($post_id, sanitize_text_field($key), sanitize_text_field($value));
            }
        }
    
        return new \WP_REST_Response(array('status' => 'success', 'post_id' => $post_id), 200);
    }
    
    /**
     * Downloads images from the content and replaces their URLs.
     */
    private function download_and_replace_images($content) {
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/', $content, $matches);

        foreach ($matches[1] as $image_url) {
            $image = $this->download_image_from_url($image_url);
            if (!is_wp_error($image)) {
                // Upload the image to the media library
                $attachment_id = $this->upload_image_to_media_library($image);
                if (!is_wp_error($attachment_id) && $attachment_id > 0) {
                    // Get the src, srcset, sizes, and other attributes
                    $src = wp_get_attachment_url($attachment_id);
                    $srcset = wp_get_attachment_image_srcset($attachment_id);
                    $sizes = wp_get_attachment_image_sizes($attachment_id);
                    $image_data = wp_get_attachment_image_src($attachment_id, 'full');
                    $width = $image_data[1];
                    $height = $image_data[2];

                    // Replace the original image tag with a WordPress formatted image tag
                    $new_image_tag = sprintf(
                        '<img decoding="async" class="alignnone size-full wp-image-%d" src="%s" alt="" width="%d" height="%d" srcset="%s" sizes="%s">',
                        $attachment_id,
                        esc_url($src),
                        esc_attr($width),
                        esc_attr($height),
                        esc_attr($srcset),
                        esc_attr($sizes)
                    );

                    // Store the original and new URLs
                    $image_urls[] = array(
                        'original_url' => $image_url,
                        'new_url'      => $src
                    );

                    // Replace the original img tag in the content with the new img tag
                    $content = str_replace($matches[0][array_search($image_url, $matches[1])], $new_image_tag, $content);
                }


            }
        }
        return $content;
    }
    private function download_image_from_url($url) {
        $response = wp_remote_get($url);
    
        if (is_wp_error($response)) {
            return $response;
        }
    
        $body = wp_remote_retrieve_body($response);
        $content_type = wp_remote_retrieve_header($response, 'content-type');
        $extension = '';
    
        switch ($content_type) {
            case 'image/jpeg':
                $extension = '.jpg';
                break;
            case 'image/png':
                $extension = '.png';
                break;
            case 'image/gif':
                $extension = '.gif';
                break;
            default:
                return new \WP_Error('invalid_image_type', 'Invalid image type', array('status' => 422));
        }
    
        $file_name = uniqid() . $extension;
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $file_name;
        if (file_put_contents($file_path, $body) === false) {
            return new \WP_Error('file_write_error', 'Failed to write file', array('status' => 422));
        }
    
        return array(
            'file_path' => $file_path,
            'file_name' => $file_name,
            'file_type' => $content_type,
        );
    }
    
    private function upload_image_to_media_library($image) {
        // Include required WordPress files for media handling
        if (!function_exists('media_handle_sideload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
        }
    
        // Set up the file array for WordPress media handling
        $file = array(
            'name'     => $image['file_name'],
            'type'     => $image['file_type'],
            'tmp_name' => $image['file_path'],
            'error'    => 0,
            'size'     => filesize($image['file_path']),
        );
    
        // Handle the file upload and sideload it into the media library
        $attachment_id = media_handle_sideload($file, 0);
    
        // Check for errors in the sideload process
        if (is_wp_error($attachment_id)) {
            @unlink($image['file_path']); // Remove the temporary file if an error occurs
            return $attachment_id;
        }
    
        // Return the attachment ID of the uploaded image
        return $attachment_id;
    }

    // Other methods for handling categories, tags, and authors...
    private function get_or_create_terms($terms, $taxonomy) {
        $term_ids = array();

        foreach ($terms as $term_name) {
            $term = get_term_by('name', $term_name, $taxonomy);

            if ($term) {
                $term_ids[] = $term->term_id;
            } else {
                $new_term = wp_insert_term($term_name, $taxonomy);
                if (!is_wp_error($new_term)) {
                    $term_ids[] = $new_term['term_id'];
                }
            }
        }
        return $term_ids;
    }

    private function get_or_create_author($author_data) {
        $username = sanitize_user($author_data['username']);
        $first_name = sanitize_text_field($author_data['first_name']);
        $last_name = sanitize_text_field($author_data['last_name']);

        if (username_exists($username)) {
            $user = get_user_by('login', $username);
            return $user->ID;
        } else {
            $user_id = wp_create_user($username, wp_generate_password(), "{$username}@botxbyte.com");

            if (!is_wp_error($user_id)) {
                wp_update_user(array(
                    'ID' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name
                ));
                return $user_id;
            } else {
                return null;
            }
        }
    }
}
