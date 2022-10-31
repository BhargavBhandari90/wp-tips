<?php

/**
 * Initialize the REST API.
 *
 * @return void
 */
function bwp_rest_api_init() {

	// New end point registration.
	register_rest_route(
		'myplugin/v1',
		'acf-books',
		array(
			'methods'             => 'GET',
			'callback'            => 'bwp_get_acf_books',
			'permission_callback' => 'bwp_permission_callback',
			'args'                => array(
				'meta-key'   => array(
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						return ! is_numeric( $param );
					},
				),
				'meta-value' => array(
					// 'required'          => true,
					'default'           => 1,
					'validate_callback' => function ( $param, $request, $key ) {
						return is_numeric( $param );
					},
				),
			),
		)
	);

}

add_action( 'rest_api_init', 'bwp_rest_api_init' );

/**
 * Callback function to process API and return response.
 *
 * @param WP_REST_Request $request
 * @return json
 */
function bwp_get_acf_books( WP_REST_Request $request ) {

	$meta_key   = $request->get_param( 'meta-key' ); // Get meta-key from API args.
	$meta_value = $request->get_param( 'meta-value' ); // Get meta-value from API args.

	$args = array(
		'post_type'      => 'book',
		'status'         => 'publish',
		'posts_per_page' => 10,
		'meta_query'     => array(
			array(
				'key'   => $meta_key,
				'value' => $meta_value,
			),
		),
	);

	// The Query
	$the_query = new WP_Query( $args );
	$acf_books = $the_query->posts;

	if ( empty( $acf_books ) ) {
		return new WP_Error(
			'no_data_found',
			'No data found',
			array(
				'status' => 404,
				'bvbv'   => 'asdas',
			)
		);
	}

	return rest_ensure_response( $acf_books );

}

/**
 * Set permission to run API.
 * Here we are allowing only loggedin users to run API.
 *
 * @return void
 */
function bwp_permission_callback() {

	if ( is_user_logged_in() ) {
		return true;
	}

	return false;
}
