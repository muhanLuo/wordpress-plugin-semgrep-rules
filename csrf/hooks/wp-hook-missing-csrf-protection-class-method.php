<?php
class ClassTests {

    public function delete_callback($i){
        
        if ($i == 5) {
            return False;
        }
        check_ajax_referer( 'report-post-nonce', 'nonce' );

        echo "RANDOM TEXT";
    }

    public function load_page($i){
        
        if ($i == 5) {
            return False;
        }
        check_admin_referer( 'report-post-nonce', 'nonce' );

        echo "RANDOM TEXT";
    }

    public function return_file($file){
        
        echo $file;
        return 5 == 5;
    }

    public function __construct()
    {
        // ok: wp-hook-missing-csrf-protection-class-method
        add_action('wp_ajax_file_backup', array(&$this, 'backup_callback'));

        // ruleid: wp-hook-missing-csrf-protection-class-method
        add_action('admin_menu', array(&$this, 'callback1'));
    }

    public function api_init2()
    {
        // ok: wp-hook-missing-csrf-protection-class-method
        add_action('admin_action_delete', array(&$this, 'delete_callback'));

        // ok: wp-hook-missing-csrf-protection-class-method
        add_action('admin_init', array(&$this, 'load_page'));

        // ruleid: wp-hook-missing-csrf-protection-class-method
        add_action('wp_ajax_return_file', array(&$this, 'return_file'));
    }

    public function callback1($nonce){
            
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
?>