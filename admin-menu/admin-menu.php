<?php
/**
 * Plugin Name: Admin Menu
 * Description: This plugin for register admin menu
 * Plugin URI: https://fardin.com
 * Author: Fardin
 * Author URI: https://fardinahmed.com
 * Version: 0.0.1
 * 
 */

Class Admin_menu{
    function __construct(){
        add_action('admin_menu', [$this, 'my_menu_pages'] );
        add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
        add_action('admin_post_save_admin_panel_settings', [$this, 'admin_panel_settings']);
    }

    public function admin_scripts($hook) {
        if($hook !== 'toplevel_page_menu-page' ) return;
        wp_enqueue_style('admin_form_style', plugin_dir_url(__FILE__) .'/assets/admin/css/form.css', [],time());
        wp_enqueue_script('admin_form_script', plugin_dir_url(__FILE__). '/assets/admin/js/admin-script.js', array(), '0.0.1', true);
    }


    function my_menu_pages(){

        add_menu_page(
            'Menu Page',
            'Menu Page',
            'manage_options',
            'menu-page',
            [$this, 'menu_page_setting'],
            'dashicons-admin-page',
            10
        );

    }


    function menu_page_setting(){
        $post_count= wp_count_posts('post')->publish;
        $comment = wp_count_comments();
       ?>
            <div class="wrap">
                <?php 
                require_once( plugin_dir_path(__FILE__). 'form.php');
                ?>
            </div>
       <?
    }

    function admin_panel_settings(){
        error_log(print_r($_REQUEST, true));
        $form = $_REQUEST;
        if(!wp_verify_nonce($form['nonce'], 'admin_panel_nonce')){
           wp_safe_redirect(admin_url('admin.php?page=menu-page&status=unauthorize'));
        }

        if( !is_string($form['name'] )) {
           wp_safe_redirect(admin_url('admin.php?page=menu-page&status=invalid-name'));
        }
        if(!is_email($form['email'])) {
            wp_safe_redirect(admin_url('admin.php?page=menu-page&status=invalid-email'));
        }
        if(!is_string($form['subject'])){
           wp_safe_redirect(admin_url('admin.php?page=menu-page&status=invalid-subject'));
        }
        if(!is_string($form['message'])){
           wp_safe_redirect(admin_url('admin.php?page=menu-page&status=invalid-message'));
        }

        $sanitize = $form;
        $sanitize['name'] = sanitize_file_name($sanitize['name']);
        $sanitize['email'] = sanitize_email($sanitize['email']);
        $sanitize['subject'] = sanitize_file_name($sanitize['subject']);
        $sanitize['message'] = sanitize_text_field($sanitize['message']);

        update_option('admin_panel_setting', $sanitize);
        wp_safe_redirect(admin_url('admin.php?page=menu-page&status=success'));

    }
}

new Admin_menu();

