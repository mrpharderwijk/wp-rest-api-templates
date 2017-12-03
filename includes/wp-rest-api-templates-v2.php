<?php
/**
 * WP REST API templates Routes
 *
 * @package WP_REST_API_templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_REST_API_templates' ) ) :


  /**
   * WP REST API templates class.
   *
   * WP REST API templates support for WP API v2.
   *
   * @package WP_REST_API_templates
   * @since 1.0.1
   */
  class WP_REST_API_templates {


    /**
     * Get WP API namespace.
     *
     * @since 1.0.1
     * @return string
     */
    public static function get_api_namespace() {
        return 'wp/v2';
    }


    /**
     * Register menu routes for WP API v2.
     *
     * @since  1.0.1
     */
    public function register_routes() {

    	register_rest_route( self::get_api_namespace(), '/templates', array(
          array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => array( $this, 'get_templates' )
          )
        )
      );
    }

    /**
     * Get the templates or page object
     *
     * @since  1.0.1
     * @return Object containing all templates or page objects that comply to the template type parameter
     */
    public static function get_templates($request_data) {
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

      // No static frontpage is set
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
