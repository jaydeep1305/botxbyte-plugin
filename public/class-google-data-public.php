<?php
// Add this to your theme's functions.php file or in a custom plugin
namespace Botxbyte;

class GoogleDataPublic {

    public function google_data_register_custom_route(){
        // Endpoint for Google Analytics 4 data
        register_rest_route('botxbyte/v1', '/analytics-data', array(
            'methods' => 'GET',
            'callback' => array(new GoogleDataPublic(), 'get_analytics_data'),
            'permission_callback' => function () {
                return current_user_can('manage_options');
            }, // This makes the endpoint public
        ));
    
        // Endpoint for Search Console data
        register_rest_route('botxbyte/v1', '/search-console-data', array(
            'methods' => 'GET',
            'callback' => array(new GoogleDataPublic(), 'get_search_console_data'),
            'permission_callback' => function () {
                return current_user_can('manage_options');
            },
        ));
    }

    public function get_analytics_data(\WP_REST_Request $request) {
        // Check if Site Kit is active
        if (!class_exists('Google\Site_Kit\Plugin')) {
            return new \WP_Error('site_kit_not_active', 'Site Kit by Google is not active', array('status' => 400));
        }
    
        $context = new \Google\Site_Kit\Context(ABSPATH);
        $options = new \Google\Site_Kit\Core\Storage\Options($context);
        $analytics = new \Google\Site_Kit\Modules\Analytics_4($context, $options);
    
        if (!$analytics) {
            return new \WP_Error('analytics_4_not_available', 'Analytics 4 module is not available', array('status' => 400));
        }
    
        // Check if the module is connected
        if (!$analytics->is_connected()) {
            return new \WP_Error('analytics_4_not_connected', 'Analytics 4 module is not connected', array('status' => 400));
        }
    
        // Use the module's get_data method
        try {
            $params = $request->get_params();
            $response = $analytics->get_data('report', $params);
        } catch (Exception $e) {
            return new \WP_Error('analytics_4_error', $e->getMessage(), array('status' => 500));
        }
    
        if (is_wp_error($response)) {
            return $response;
        }
    
        return rest_ensure_response($response);
    }
    
    public function get_search_console_data(\WP_REST_Request $request) {
        // Check if Site Kit is active
        if (!class_exists('Google\Site_Kit\Plugin')) {
            return new \WP_Error('site_kit_not_active', 'Site Kit by Google is not active', array('status' => 400));
        }
    
        $context = new \Google\Site_Kit\Context(ABSPATH);
        $options = new \Google\Site_Kit\Core\Storage\Options($context);
        $search_console = new \Google\Site_Kit\Modules\Search_Console($context, $options);
    
        if (!$search_console) {
            return new \WP_Error('search_console_not_available', 'Search Console module is not available', array('status' => 400));
        }
    
        // Check if the module is connected
        if (!$search_console->is_connected()) {
            return new \WP_Error('search_console_not_connected', 'Search Console module is not connected', array('status' => 400));
        }
    
        // Use the module's get_data method
        try {
            $params = $request->get_params();
            $response = $search_console->get_data('searchanalytics', $params);
        } catch (Exception $e) {
            return new \WP_Error('search_console_error', $e->getMessage(), array('status' => 500));
        }
    
        if (is_wp_error($response)) {
            return $response;
        }
    
        return rest_ensure_response($response);
    }
}

