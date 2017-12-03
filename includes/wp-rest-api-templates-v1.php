<?php
/**
 * WP REST API Templates Routes
 *
 * @package WP_REST_API_template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_JSON_API_templates' ) ) :


  /**
   * WP REST API template class.
   *
   * WP REST API template support for WP API v2.
   *
   * @package WP_REST_API_templates
   * @since 1.0.1
   */
  class WP_JSON_API_templates {


    /**
     * Register menu routes for WP API v2.
     *
     * @since  1.0.1
     */
    public function register_routes($routes) {

      $routes['/templates'] = array(
				array( array( $this, 'get_templates' ), WP_JSON_Server::READABLE ),
			);

      return $routes;
    }


    /**
     * Get the templates or page object
     *
     * @since  1.0.1
     * @return Object containing all templates or page objects that comply to the template type parameter
     */
    public static function get_templates() {
			$parameters = $request_data->get_params();

    	if(!isset( $parameters['type'] ) || empty($parameters['type']) ) {
    		$response = wp_get_theme()->get_page_templates();
    	} else {
				$args = array(
	        'post_type' => 'page',
	        'post_status' => 'publish',
	        'meta_query' => array(
            array(
              'key' => '_wp_page_template',
              'value' => $parameters['type']
            )
        	)
    		);
				$query = new WP_Query($args);
				$response = $query->posts;
    	}

      // Nothing to return
      if( count($response) < 1 ) {
        return new WP_Error( 'wpse-error',
          esc_html__( 'No templates found', 'wpse' ),
          [ 'status' => 404 ] );
      }

      // Return the response
      return $response;
    }
  }

endif;
