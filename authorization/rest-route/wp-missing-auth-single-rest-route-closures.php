<?php

// ruleid: wp-missing-auth-single-rest-route-closures
register_rest_route( 'get_post', 'posts/(?P<id>\d+)', array(
        'methods'    => 'GET',
        'callback'   => array($this, 'get_post'),
        'permission_callback' => function() {
            return true;
        }
));

// ok: wp-missing-auth-single-rest-route-closures
register_rest_route(
		'api/v3',
		'/search',
		[
			'callback'            => 'search',
			'methods'             => 'GET',
			'permission_callback' => function () {
				return current_user_can("search");
			},
		]
	);

// ruleid: wp-missing-auth-single-rest-route-closures
register_rest_route(
		'api/v3',
		'/search',
		[
			'callback'            => 'search',
			'methods'             => 'GET',
			'permission_callback' => function () {
				return is_user_logged_in();
			},
		]
	);

// ok: wp-missing-auth-single-rest-route-closures
register_rest_route(
		'api',
		'/edit',
		[
			'callback'            => 'edit',
			'methods'             => 'POST',
			'permission_callback' => function () {
				if (current_user_can("search")) {
                    return True;
                }
                else {
                    return False;
                }
			},
		]
	);


?>