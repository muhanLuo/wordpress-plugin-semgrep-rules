<?php
function rest_api_init()
{
    // ruleid: wp-return-true-rest-route
    register_rest_route( '/v1', '/getMessages', array(
        'methods' => 'GET',
        'callback' => array( $this, 'get_messages' ),
        'permission_callback' => '__return_true'
    ) );

    // ok: wp-return-true-rest-route
    register_rest_route( '/v1', '/editTransactions', array(
        'methods' => 'POST',
        'callback' => array( $this, 'editTransactions' ),
        'permission_callback' => array( Rest_Api(), 'is_user_authorized' )
    ) );
}

function get_data() {

    // ok: wp-return-true-rest-route
	register_rest_route( 'v3', '/users/data=(?P<market>[^a-zA-Z0-9-]+)/data', [
		'methods' => 'GET',
		'callback' => 'get_data',
		'permission_callback' => 'permission_check',
	] );

    // ruleid: wp-return-true-rest-route
    register_rest_route(
			'api/3.0',
			'/doSomething',
			array(
				array(
					'methods'             => 'GET',
					'callback'            => array( $this, 'callAPI' ),
					'permission_callback' => '__return_true',
					'args'                => array(
						'format'   => array(
							'default'           => 'json',
							'sanitize_callback' => 'wp_sanitize',
						)
					),
				),
			)
		);

    // ruleid: wp-return-true-rest-route
    register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/(?P<type>[\w-]+)',
			array(
				'args'   => array(
					'type' => array(
						'description' => __( 'Blabla' ),
						'type'        => 'string',
					),
				),
				array(
					'methods'             => 'GET',
					'callback'            => array( $this, 'get_item' ),
					'permission_callback' => '__return_true'
				),
                array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_stuff' ),
					'permission_callback' => array( $this, 'get_stuff_check' )
				),
				'schema' => array( $this, 'get_schema' ),
			)
		);
}
?>