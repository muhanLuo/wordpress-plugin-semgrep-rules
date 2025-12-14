<?php

function csrf_before() {
	echo "HELLO";
    for ($x = 0; $x <= 100; $x+=10) {
        if (command() and check_ajax_referer( 'random_nonce' ) == false or 7 > 8)
        {
            return "BLA";
        }
    }
	echo "BYE";
}

function csrf_before2() {
	echo "HELLO";
    for ($x = 0; $x <= 100; $x+=10) {
        if (5 + 5 == 1)
        {
            return "BLA";
        }
        else if (5 + 5 > 1 and wp_verify_nonce("hello") or 1 == 1)
        {
            echo "HI";
        }
    }
	echo "BYE";
}

function no_csrf_before() {
	echo "HELLO";
    wp_verify_nonce("blabla");
	echo "BYE";
}

function yes_csrf_before() {
	echo "HELLO";
    check_admin_referer("blabla");
	echo "BYE";
}

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'wp_ajax_nopriv_test1', 'csrf_before', 5, 1);

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'admin_init', 'csrf_before2');

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'admin_init', 'csrf_before2');

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'admin_menu', 'yes_csrf_before');

// ruleid: wp-hook-missing-csrf-protection-functions
add_action( 'wp_ajax_test2', 'no_csrf_before', 2);

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'wp_ajax_test3', 'csrf_after', 3);

// ruleid: wp-hook-missing-csrf-protection-functions
add_action( 'wp_ajax_test4', 'no_csrf_after', 1);

// ruleid: wp-hook-missing-csrf-protection-functions
add_action( 'admin_menu', 'no_csrf_after');

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'wp_ajax_test12', 'yes_csrf_after');

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'admin_action_123', 'yes_csrf_after2');

// ok: wp-hook-missing-csrf-protection-functions
add_action( 'unimportant_hook5', 'no_csrf_after', 5);

function csrf_after() {
	echo "HELLO";
    if ("apple" == "orange") {
        if (1 == 2 and !check_admin_referer("blabla") and 5 == 5)
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

function no_csrf_after() {
	echo "HELLO";
    wp_verify_nonce("blabla");
	echo "BYE";
}

function yes_csrf_after() {
	echo "HELLO";
    check_admin_referer("blabla");
	echo "BYE";
}

function yes_csrf_after2() {
	echo "HELLO";
    if (1 == 1)
    {
        check_ajax_referer("blabla");
    }
	echo "BYE";
}

// ruleid: wp-hook-missing-csrf-protection-functions
add_action( 'wp_ajax_test7', 'function_doesnt_exist', 1);

?>