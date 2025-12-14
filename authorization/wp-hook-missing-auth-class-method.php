<?php

class ClassTests {

    public function __construct() {
        // ok: wp-hook-missing-auth-class-method
        add_action('wp_ajax_mk_file_manager_backup', array(&$this, 'mk_file_manager_backup_callback'));
    }

    public function no_current_user_can() {
		echo "HELLO";
        current_user_can("read");
		return 5;
	}

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
		// ruleid: wp-hook-missing-auth-class-method
        add_action( 'wp_ajax_class_test1', [ $this, 'no_current_user_can' ], 5, 1);

		// ok: wp-hook-missing-auth-class-method
        add_action( 'profile_update', [ $this, 'has_current_user_can' ], 2);

		// ruleid: wp-hook-missing-auth-class-method
        add_action( 'admin_init', array(&$this, 'after_no_current_user_can') );

		// ok: wp-hook-missing-auth-class-method
		add_action( 'admin_action_write', [ $this, 'after_current_user_can' ], 1, 2);
        
    }

	public function after_no_current_user_can() {
		echo "HELLO";
        current_user_can("write");
        if (1 > 5) {
            return "YES!";
        }
		return 5;
	}

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

?>