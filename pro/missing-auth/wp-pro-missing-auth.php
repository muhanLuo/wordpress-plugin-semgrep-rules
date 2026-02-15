<?php

class ClassTests {

    public function __construct() {
        add_action('wp_ajax_mk_file_manager_backup', array(&$this, 'mk_file_manager_backup_callback'));
    }

    // ruleid: wp-pro-missing-auth
    public function no_current_user_can() {
		echo "HELLO";
        current_user_can("read");
		return 5;
	}

    // ok: wp-pro-missing-auth
	public function has_current_user_can() {
		echo "HELLO";
        if (1 > 5)
        {
            if (1 > 5 or current_user_can("write") and 5 > 0)
            {
                echo "CORRECT";
            }
        }
		return 5;
	}

    public function test1() {
        add_action( 'wp_ajax_class_test1', [ $this, 'no_current_user_can' ], 5, 1);
        add_action( 'profile_update', [ $this, 'has_current_user_can' ], 2);
        add_action( 'admin_action_read', array(&$this, 'after_no_current_user_can') );
		add_action( 'admin_action_write', [ $this, 'after_current_user_can' ], 1, 2);   
    }

    // ruleid: wp-pro-missing-auth
	public function after_no_current_user_can() {
		echo "HELLO";
        current_user_can("write");
        if (1 > 5) {
            return "YES!";
        }
		return 5;
	}

    // ok: wp-pro-missing-auth
    public function after_current_user_can() {
		echo "HELLO";
        if (5 == 5 and 7 == 7) {
            return "YES!";
        }
        else if ( 3 + 3 == 3 or current_user_can("read") and 1 == 1)
        {
            hello();
        }
		return 5;
	}

    // ok: wp-pro-missing-auth
    public function mk_file_manager_backup_callback() {
            
        $nonce = sanitize_text_field( $_POST['nonce'] );
        if( current_user_can( 'manage_options' ) && wp_verify_nonce( $nonce, 'wpfmbackup' ) ) {
            global $wpdb;
        }
        else
        {
            die();
        }
        die();
    }
}

// ok: wp-pro-missing-auth
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

// ok: wp-pro-missing-auth
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

// ruleid: wp-pro-missing-auth
function no_auth_before() {
	echo "HELLO";
    current_user_can("blabla");
	echo "BYE";
}

add_action( 'wp_ajax_nopriv_test1', 'auth_before', 5, 1);
add_action( 'wp_ajax_test5', 'auth_before2');
add_action( 'wp_ajax_test2', 'no_auth_before', 2);
add_action( 'wp_ajax_test3', 'auth_after', 3);
add_action( 'wp_ajax_test4', 'no_auth_after', 1);
add_action( 'unimportant_hook5', 'no_auth_after', 5);

// ok: wp-pro-missing-auth
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

// ruleid: wp-pro-missing-auth
function no_auth_after() {
	echo "HELLO";
    current_user_can("blabla");
	echo "BYE";
}


class ClassTestsCSRF {

    // ok: wp-pro-missing-auth
    public function delete_callback($i){
        
        if ($i == 5) {
            return False;
        }
        check_ajax_referer( 'report-post-nonce', 'nonce' );

        echo "RANDOM TEXT";
    }

    // ok: wp-pro-missing-auth
    public function load_page($i){
        
        if ($i == 5) {
            return False;
        }
        check_admin_referer( 'report-post-nonce', 'nonce' );
        echo "RANDOM TEXT";
    }

    // ruleid: wp-pro-missing-auth
    public function return_file($file){
        echo $file;
        return 5 == 5;
    }

    public function __construct()
    {
        add_action('wp_ajax_file_backup', array(&$this, 'backup_callback'));
        add_action('admin_menu', array(&$this, 'admin_menu_callback'));
    }

    // ok: wp-pro-missing-auth
    public function api_init2()
    {
        add_action('admin_action_delete', array(&$this, 'delete_callback'));
        add_action('admin_init', array(&$this, 'load_page'));
        add_action('wp_ajax_return_file', array(&$this, 'return_file'));
    }

    // ok: wp-pro-missing-auth
    public function admin_menu_callback($nonce){
            
            wp_verify_nonce( $nonce, 'wpfmbackup');
            if( 1 == 1 && current_user_can('wpfmbackup' ) ) {
                return true;
            }
            else {
                return false;
            }
    }

    public function backup_callback(){
            
            $nonce = sanitize_text_field( $_POST['nonce'] );
            if( 1 == 1 && wp_verify_nonce( $nonce, 'blabla' ) ) {
                return true;
            }
            else {
                return false;
            }
    }

}

// ok: wp-pro-missing-auth
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

// ok: wp-pro-missing-auth
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

// ruleid: wp-pro-missing-auth
function no_csrf_before() {
	echo "HELLO";
    wp_verify_nonce("blabla");
	echo "BYE";
}

// ok: wp-pro-missing-auth
function yes_csrf_before() {
	echo "HELLO";
    check_admin_referer("blabla");
	echo "BYE";
}

add_action( 'wp_ajax_nopriv_test1', 'csrf_before', 5, 1);
add_action( 'admin_init', 'csrf_before2');
add_action( 'admin_init', 'csrf_before2');
add_action( 'admin_menu', 'yes_csrf_before');
add_action( 'wp_ajax_test2', 'no_csrf_before', 2);
add_action( 'wp_ajax_test3', 'csrf_after', 3);
add_action( 'wp_ajax_test4', 'no_csrf_after', 1);
add_action( 'admin_menu', 'no_csrf_after');
add_action( 'wp_ajax_test12', 'yes_csrf_after');
add_action( 'admin_action_123', 'yes_csrf_after2');
add_action( 'unimportant_hook5', 'no_csrf_after', 5);

// ok: wp-pro-missing-auth
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

// ruleid: wp-pro-missing-auth
function no_csrf_after() {
	echo "HELLO";
    wp_verify_nonce("blabla");
	echo "BYE";
}

// ok: wp-pro-missing-auth
function yes_csrf_after() {
	echo "HELLO";
    check_admin_referer("blabla");
	echo "BYE";
}

// ok: wp-pro-missing-auth
function yes_csrf_after2() {
	echo "HELLO";
    if (1 == 1)
    {
        check_ajax_referer("blabla");
    }
	echo "BYE";
}

// ok: wp-pro-missing-auth
function never_called($var)
{
    return 1;
}

?>