<?php
function rest_api_init()
{
    // ruleid: wp-return-true-register-rest-route
    register_rest_route( '/v1', '/getMessages', array(
        'methods' => 'GET',
        'callback' => array( $this, 'get_messages' ),
        'permission_callback' => '__return_true'
    ) );

    // ok: wp-return-true-register-rest-route
    register_rest_route( '/v1', '/editTransactions', array(
        'methods' => 'POST',
        'callback' => array( $this, 'editTransactions' ),
        'permission_callback' => array( Rest_Api(), 'is_user_authorized' )
    ) );
}

function get_data() {

    // ok: wp-return-true-register-rest-route
	register_rest_route( 'v3', '/users/data=(?P<market>[^a-zA-Z0-9-]+)/data', [
		'methods' => 'GET',
		'callback' => 'get_data',
		'permission_callback' => 'permission_check',
	] );
}
?>