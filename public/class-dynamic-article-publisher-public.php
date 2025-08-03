<?php 

namespace Botxbyte;
set_time_limit(300);
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Similarity\CosineSimilarity;
// use PHPInsight\Sentiment;

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
        register_rest_route('botxbyte/v1', '/article-info-list', array(
            'methods' => 'POST',
            'callback' => array($this, 'article_info_list'),
            'permission_callback' => function () {
                return current_user_can('publish_posts');
            }
        ));
        register_rest_route('botxbyte/v1', '/permalinks-info', array(
            'methods' => 'POST',
            'callback' => array($this, 'permalinks_info'),
            'permission_callback' => function () {
                return current_user_can('publish_posts');
            }
        ));
        register_rest_route('botxbyte/v1', '/update-permalinks', array(
            'methods' => 'POST',
            'callback' => array($this, 'update_permalinks'),
            'permission_callback' => function () {
                return current_user_can('manage_options');
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

    /**
     * Article Information
     */

    public function article_info($request) {
        // Get the parameters from the request
        $slug = $request->get_param('slug');
        $article_url = $request->get_param('article_url');
        $post_id = $request->get_param('post_id');
    
        // Determine which parameter to use for finding the post
        if (!empty($post_id)) {
            $post = get_post($post_id);
        } elseif (!empty($article_url)) {
            $post_id = url_to_postid($article_url);
            $post = get_post($post_id);
        } elseif (!empty($slug)) {
            $post = get_page_by_path($slug, OBJECT, 'post');
        } else {
            return new \WP_REST_Response(
                array(
                    'status' => 'error',
                    'message' => 'One of slug, article_url, or post_id is required'
                ),
                400
            );
        }
    
        if (!$post) {
            return new \WP_REST_Response(
                array(
                    'status' => 'error',
                    'message' => 'Article not found'
                ),
                404
            );
        }
    
        // Get post categories with term_id
        $categories = wp_get_post_categories($post->ID, array('fields' => 'all'));
        $category_data = array_map(function($cat) {
            return array(
                'term_id' => $cat->term_id,
                'name' => $cat->name,
                'slug' => $cat->slug
            );
        }, $categories);
    
        // Get post tags with term_id
        $tags = wp_get_post_tags($post->ID, array('fields' => 'all'));
        $tag_data = array_map(function($tag) {
            return array(
                'term_id' => $tag->term_id,
                'name' => $tag->name,
                'slug' => $tag->slug
            );
        }, $tags);
    
        // Get featured image
        $featured_image_id = get_post_thumbnail_id($post->ID);
        $featured_image_url = $featured_image_id ? wp_get_attachment_image_src($featured_image_id, 'full')[0] : null;
    
        // Get author information
        $author = get_userdata($post->post_author);
        $author_info = array(
            'id' => $author->ID,
            'name' => $author->display_name,
            'email' => $author->user_email
        );
    
        // Get custom fields
        $custom_fields = get_post_custom($post->ID);
        $meta_data = array();
        foreach ($custom_fields as $key => $value) {
            if (!in_array($key, ['_thumbnail_id', '_edit_lock', '_edit_last'])) {
                $meta_data[$key] = $value[0];
            }
        }
    
        // Content analysis
        $content = $post->post_content;
        $content_analysis = $this->analyze_content($post->ID, $content);
    
        // Prepare the response
        $response_data = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'content' => $content,
            'excerpt' => $post->post_excerpt,
            'status' => $post->post_status,
            'date' => $post->post_date,
            'modified_date' => $post->post_modified,
            'slug' => $post->post_name,
            'url' => get_permalink($post->ID),
            'author' => $author_info,
            'categories' => $category_data,
            'tags' => $tag_data,
            'featured_image_url' => $featured_image_url,
            'meta_data' => $meta_data,
            'content_analysis' => $content_analysis
        );
    
        return new \WP_REST_Response($response_data, 200);
    }
    
    private function analyze_content($post_id, $content) {
        // Remove shortcodes and strip tags for accurate analysis
        $clean_content = strip_tags(strip_shortcodes($content));
    
        // Count words
        $word_count = str_word_count($clean_content);
    
        // Count images
        $image_count = substr_count($content, '<img');
    
        // Count headings
        $heading_count = preg_match_all('/<h[1-6][^>]*>.*?<\/h[1-6]>/i', $content, $matches);
    
        // Count paragraphs and classify them
        $paragraphs = preg_split('/\n\s*\n/', $clean_content);
        $total_paragraphs = count($paragraphs);
        $long_paragraphs = 0;
        $medium_paragraphs = 0;
        $short_paragraphs = 0;
        foreach ($paragraphs as $paragraph) {
            $word_count = str_word_count($paragraph);
            if ($word_count > 100) $long_paragraphs++;
            elseif ($word_count > 50) $medium_paragraphs++;
            else $short_paragraphs++;
        }
    
        // Count sentences and classify them
        $sentences = preg_split('/(?<=[.!?])\s+/', $clean_content, -1, PREG_SPLIT_NO_EMPTY);
        $total_sentences = count($sentences);
        $long_sentences = 0;
        $medium_sentences = 0;
        $short_sentences = 0;
        foreach ($sentences as $sentence) {
            $word_count = str_word_count($sentence);
            if ($word_count > 20) $long_sentences++;
            elseif ($word_count > 10) $medium_sentences++;
            else $short_sentences++;
        }
    
        // Count passive sentences (this is a simplified approach)
        $passive_sentences = preg_match_all('/\b(am|is|are|was|were|be|been|being)\s+(\w+ed|[^aeiou]{3,}[aeiou][a-z]+ed)\b/i', $clean_content);
    
        // Calculate readability score (Flesch-Kincaid Grade Level)
        $readability_score = $this->hemingway_analysis($clean_content);

        // Count internal and external links
        $internal_links = $this->analyze_internal_links($post_id, $content);
        $external_links = $this->analyze_external_links($content);
    
    
        return array(
            'word_count' => $word_count,
            'image_count' => $image_count,
            'heading_count' => $heading_count,
            'total_paragraphs' => $total_paragraphs,
            'long_paragraphs' => $long_paragraphs,
            'medium_paragraphs' => $medium_paragraphs,
            'short_paragraphs' => $short_paragraphs,
            'total_sentences' => $total_sentences,
            'long_sentences' => $long_sentences,
            'medium_sentences' => $medium_sentences,
            'short_sentences' => $short_sentences,
            'passive_sentences' => $passive_sentences,
            'readability_score' => $readability_score,
            'internal_links' => $internal_links,
            'external_links' => $external_links
        );
    }

    private function hemingway_analysis($text) {
        $sentences = preg_split('/(?<=[.!?])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $words = str_word_count($text, 1);
        $word_count = count($words);
        $sentence_count = count($sentences);
        $letter_count = strlen(preg_replace('/[^a-zA-Z]/', '', $text));

        $adverbs = 0;
        $passive_voice = 0;
        $complex_words = 0;
        $very_hard_sentences = 0;
        $hard_sentences = 0;

        foreach ($sentences as $sentence) {
            $words_in_sentence = str_word_count($sentence, 1);
            $word_count_in_sentence = count($words_in_sentence);

            // Count adverbs (simplistic approach, might need refinement)
            $adverbs += preg_match_all('/\w+ly\b/', $sentence);

            // Count passive voice (simplistic approach, might need refinement)
            $passive_voice += preg_match_all('/\b(am|is|are|was|were|be|been|being)\s+(\w+ed|[^aeiou]{3,}[aeiou][a-z]+ed)\b/i', $sentence);

            // Count complex words
            foreach ($words_in_sentence as $word) {
                if ($this->count_syllables($word) >= 3 && !$this->is_common_word($word)) {
                    $complex_words++;
                }
            }

            // Identify hard and very hard sentences
            if ($word_count_in_sentence >= 14) {
                $hard_sentences++;
                if ($word_count_in_sentence >= 25) {
                    $very_hard_sentences++;
                }
            }
        }

        // Calculate readability grade
        $grade = $this->calculate_hemingway_grade($letter_count, $word_count, $sentence_count, $complex_words);

        return array(
            'grade' => $grade,
            'adverbs' => $adverbs,
            'passive_voice' => $passive_voice,
            'complex_words' => $complex_words,
            'very_hard_sentences' => $very_hard_sentences,
            'hard_sentences' => $hard_sentences,
            'word_count' => $word_count,
            'sentence_count' => $sentence_count,
            'recommendations' => $this->generate_recommendations($adverbs, $passive_voice, $complex_words, $very_hard_sentences, $hard_sentences, $word_count, $sentence_count)
        );
    }

    private function calculate_hemingway_grade($letters, $words, $sentences, $complex_words) {
        if ($words == 0 || $sentences == 0) {
            return 0;
        }

        // Calculate average sentence length
        $avg_sentence_length = $words / $sentences;

        // Calculate percentage of complex words
        $percent_complex = ($complex_words / $words) * 100;

        // Calculate base score using a modified formula
        $base_score = (1.015 * $avg_sentence_length) + (0.35 * $percent_complex);

        // Adjust score based on letter count per word
        $avg_word_length = $letters / $words;
        $base_score += ($avg_word_length - 5) * 2;  // Assuming average word length of 5 as baseline

        // Map score to Hemingway-like grade levels
        if ($base_score < 6) return 1;      // Very Easy
        elseif ($base_score < 9) return 2;  // Easy
        elseif ($base_score < 12) return 3; // Fairly Easy
        elseif ($base_score < 15) return 4; // Standard
        elseif ($base_score < 18) return 5; // Fairly Difficult
        elseif ($base_score < 21) return 6; // Difficult
        elseif ($base_score < 24) return 7; // Very Difficult
        elseif ($base_score < 27) return 8; // Extremely Difficult
        elseif ($base_score < 30) return 9; // Extremely Difficult
        else return 10;                     // Extremely Difficult
    }

    private function is_common_word($word) {
        $common_words = array(
            'the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I',
            'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at',
            'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she',
            'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what',
            'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me',
            'when', 'make', 'can', 'like', 'time', 'no', 'just', 'him', 'know', 'take',
            'people', 'into', 'year', 'your', 'good', 'some', 'could', 'them', 'see', 'other',
            'than', 'then', 'now', 'look', 'only', 'come', 'its', 'over', 'think', 'also',
            'back', 'after', 'use', 'two', 'how', 'our', 'work', 'first', 'well', 'way',
            'even', 'new', 'want', 'because', 'any', 'these', 'give', 'day', 'most', 'us',
            'is', 'am', 'are', 'was', 'were', 'been', 'being', 'has', 'had', 'did',
            'doing', 'does', 'done', 'said', 'went', 'gone', 'made', 'came', 'become',
            'here', 'there', 'where', 'why', 'when', 'how', 'which', 'who', 'whom', 'whose',
            'what', 'whatever', 'whenever', 'wherever', 'however', 'whichever', 'whoever', 'whomever',
            'he', 'she', 'it', 'they', 'them', 'their', 'theirs', 'themselves', 'him', 'her',
            'his', 'hers', 'its', 'himself', 'herself', 'itself', 'I', 'me', 'my', 'mine',
            'myself', 'we', 'us', 'our', 'ours', 'ourselves', 'you', 'your', 'yours', 'yourself',
            'yourselves', 'very', 'too', 'much', 'many', 'little', 'few', 'lot', 'more', 'most',
            'least', 'less', 'many', 'own', 'same', 'such', 'that', 'those', 'this', 'these'
        );
        return in_array(strtolower($word), $common_words);
    }

    private function count_syllables($word) {
        $word = strtolower($word);
        $word = preg_replace('/(?:[^laeiouy]es|ed|[^laeiouy]e)$/', '', $word);
        $word = preg_replace('/^y/', '', $word);
        $syllable_count = preg_match_all('/[aeiouy]{1,2}/', $word);
        return max(1, $syllable_count);
    }
    
    private function generate_recommendations($adverbs, $passive_voice, $complex_words, $very_hard_sentences, $hard_sentences, $word_count, $sentence_count) {
        $recommendations = array();
    
        if ($adverbs > $word_count * 0.05) {
            $recommendations[] = "Consider removing some adverbs.";
        }
        if ($passive_voice > $sentence_count * 0.1) {
            $recommendations[] = "Try to use active voice more often.";
        }
        if ($complex_words > $word_count * 0.1) {
            $recommendations[] = "Some words might be too complex. Consider simplifying.";
        }
        if ($very_hard_sentences > 0) {
            $recommendations[] = "Try to shorten or break up some very hard sentences.";
        }
        if ($hard_sentences > $sentence_count * 0.2) {
            $recommendations[] = "Consider simplifying some sentences.";
        }
    
        return $recommendations;
    }

    // Internal Links Logic
    private function analyze_internal_links($post_id, $content) {
        return array(
            'inbound' => $this->get_inbound_links($post_id),
            'outbound' => $this->get_outbound_links($content, $post_id)
        );
    }

    private function get_inbound_links($post_id) {
        global $wpdb;

        $post_url = get_permalink($post_id);
        $parsed_url = parse_url($post_url);
        $path = $parsed_url['path'];

        // Escape for use in LIKE
        $escaped_path = $wpdb->esc_like($path);

        // Create different variations of the URL to search for
        $like_paths = array(
            '%' . $escaped_path . '%',
            '%' . $escaped_path . '"%',
            '%href="' . $escaped_path . '"%',
            '%href="' . $escaped_path . '?%',
            '%href=\'' . $escaped_path . '\'%',
            '%href=\'' . $escaped_path . '?%',
        );

        $placeholders = implode(', ', array_fill(0, count($like_paths), '%s'));

        $query = $wpdb->prepare(
            "SELECT ID, post_title, post_content 
            FROM {$wpdb->posts} 
            WHERE post_status = 'publish' 
            AND post_type = 'post' 
            AND ID != %d 
            AND (post_content LIKE " . implode(' OR post_content LIKE ', array_fill(0, count($like_paths), '%s')) . ")",
            array_merge([$post_id], $like_paths)
        );

        $results = $wpdb->get_results($query);

        $inbound_links = array();
        foreach ($results as $result) {
            $dom = new \DOMDocument();
            @$dom->loadHTML($result->post_content);
            $links = $dom->getElementsByTagName('a');
            foreach ($links as $link) {
                $href = $link->getAttribute('href');
                if (strpos($href, $path) !== false) {
                    $inbound_links[] = array(
                        'post_id' => $result->ID,
                        'post_title' => $result->post_title,
                        'anchor_text' => $link->textContent,
                        'url' => $href
                    );
                }
            }
        }

        return array(
            'count' => count($inbound_links),
            'list' => $inbound_links
        );
    }

    private function get_outbound_links($content, $post_id) {
        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
        $links = $dom->getElementsByTagName('a');
        
        $outbound_links = array();
        $site_url = get_site_url();
        
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if (strpos($href, $site_url) === 0) {
                $target_post_id = url_to_postid($href);
                if ($target_post_id && $target_post_id != $post_id) {
                    $outbound_links[] = array(
                        'post_id' => $target_post_id,
                        'post_title' => get_the_title($target_post_id),
                        'anchor_text' => $link->textContent,
                        'url' => $href
                    );
                }
            }
        }
        
        return array(
            'count' => count($outbound_links),
            'list' => $outbound_links
        );
    }

    // External Links Logic
    private function analyze_external_links($content) {
        $external_links = $this->get_external_links($content);
        return array(
            'count' => count($external_links),
            'list' => $external_links
        );
    }

    private function get_external_links($content) {
        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
        $links = $dom->getElementsByTagName('a');
        
        $external_links = array();
        $site_url = get_site_url();
        
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if (strpos($href, 'http') === 0 && strpos($href, $site_url) !== 0) {
                $external_links[] = array(
                    'anchor_text' => $link->textContent,
                    'url' => $href
                );
            }
        }
        
        return $external_links;
    }

    // Article List
    public function article_info_list($request) {
        $parameters = $request->get_params();
    
        // Set default values and sanitize input
        $limit = isset($parameters['limit']) ? absint($parameters['limit']) : 10;
        $offset = isset($parameters['offset']) ? absint($parameters['offset']) : 0;
    
        // Ensure limit is between 1 and 100
        $limit = max(1, min(100, $limit));
    
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'offset' => $offset,
            'orderby' => 'date',
            'order' => 'DESC'
        );
    
        $query = new \WP_Query($args);
    
        $articles = array();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                
                // Create a mock request object with the post ID
                $mock_request = new \WP_REST_Request('GET', '/wp/v2/posts/' . $post_id);
                $mock_request->set_param('post_id', $post_id);
    
                // Get article info using the existing article_info method
                $article_info = $this->article_info($mock_request);
                
                // Extract the data from the WP_REST_Response object
                $article_data = $article_info->get_data();
    
                $articles[] = $article_data;
            }
        }
    
        wp_reset_postdata();
    
        $total_posts = $query->found_posts;
        $max_pages = ceil($total_posts / $limit);
    
        $response = array(
            'articles' => $articles,
            'total_articles' => $total_posts,
            'max_pages' => $max_pages,
            'current_page' => floor($offset / $limit) + 1
        );
    
        return new \WP_REST_Response($response, 200);
    }
    
    public function permalinks_info($request) {
        // Get the current permalink structure
        $permalink_structure = get_option('permalink_structure');
        $permalink_types = array(
            'plain' => '/?p=123',
            'day_name' => '/%year%/%monthnum%/%day%/%postname%/',
            'month_name' => '/%year%/%monthnum%/%postname%/',
            'numeric' => '/archives/%post_id%',
            'post_name' => '/%postname%/',
            'custom' => $permalink_structure
        );

        $available_tags = array(
            '%year%' => 'The year of the post, four digits, for example 2004',
            '%monthnum%' => 'Month of the year, for example 05',
            '%day%' => 'Day of the month, for example 28',
            '%hour%' => 'Hour of the day, for example 15',
            '%minute%' => 'Minute of the hour, for example 43',
            '%second%' => 'Second of the minute, for example 33',
            '%post_id%' => 'The unique ID of the post, for example 423',
            '%postname%' => 'The sanitized post title (slug)',
            '%category%' => 'The category slug. If a post has multiple categories, only the first one is used',
            '%author%' => 'The author slug'
        );

        return new \WP_REST_Response(array(
            'current_structure' => $permalink_structure,
            'available_structures' => $permalink_types,
            'available_tags' => $available_tags
        ), 200);
    }

    public function update_permalinks($request) {
        if (!current_user_can('manage_options')) {
            return new \WP_REST_Response(array(
                'status' => 'error',
                'message' => 'You do not have permission to update permalink settings.'
            ), 403);
        }

        $parameters = $request->get_json_params();
        $new_structure = isset($parameters['structure']) ? sanitize_text_field($parameters['structure']) : '';

        // Validate the structure
        if (empty($new_structure)) {
            return new \WP_REST_Response(array(
                'status' => 'error',
                'message' => 'Permalink structure cannot be empty.'
            ), 400);
        }

        // Update the permalink structure
        $old_structure = get_option('permalink_structure');
        $updated = update_option('permalink_structure', $new_structure);

        if ($updated) {
            // Flush rewrite rules to ensure new permalink structure takes effect
            flush_rewrite_rules();

            return new \WP_REST_Response(array(
                'status' => 'success',
                'message' => 'Permalink structure updated successfully.',
                'old_structure' => $old_structure,
                'new_structure' => $new_structure
            ), 200);
        } else {
            return new \WP_REST_Response(array(
                'status' => 'error',
                'message' => 'Failed to update permalink structure or the same structure was provided.'
            ), 500);
        }
    }
}
