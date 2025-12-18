<?php

// include "test.php";

function auth_before() {
	echo "HELLO";
    for ($x = 0; $x <= 100; $x+=10) {
        if (command() and current_user_can("edit") == false or 7 > 8)
        {
            return "BLA";
        }
    }
	echo "BYE";
}

function auth_before2() {
	echo "HELLO";
    for ($x = 0; $x <= 100; $x+=10) {
        if (5 + 5 == 1)
        {
            return "BLA";
        }
        else if (5 + 5 > 1 and current_user_can("hello") or 1 == 1)
        {
            echo "HI";
        }
    }
	echo "BYE";
}

function no_auth_before() {
	echo "HELLO";
    current_user_can("blabla");
	echo "BYE";
}

// ok: wp-hook-missing-auth-functions
add_action( 'wp_ajax_nopriv_test1', 'auth_before', 5, 1);

// ok: wp-hook-missing-auth-functions
add_action( 'admin_init', 'auth_before2');

// ruleid: wp-hook-missing-auth-functions
add_action( 'wp_ajax_test2', 'no_auth_before', 2);

// ok: wp-hook-missing-auth-functions
add_action( 'wp_ajax_test3', 'auth_after', 3);

// ruleid: wp-hook-missing-auth-functions
add_action( 'wp_ajax_test4', 'no_auth_after', 1);

// ok: wp-hook-missing-auth-functions
add_action( 'unimportant_hook5', 'no_auth_after', 5);

function auth_after() {
	echo "HELLO";
    if ("apple" == "orange") {
        if (1 == 2 and !current_user_can("blabla") and 5 == 5)
        {
            echo "BLABLA";
        }
        else {
            echo "HELLO";
        }
    }
    else { die(); }
	echo "BYE";
}

function no_auth_after() {
	echo "HELLO";
    current_user_can("blabla");
	echo "BYE";
}

// ruleid: wp-hook-missing-auth-functions
add_action( 'wp_ajax_test7', 'function_doesnt_exist', 1);

?>