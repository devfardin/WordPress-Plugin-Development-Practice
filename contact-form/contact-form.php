<?php

/*
* Plugin Name: Contact Form
* Description: This plugin for a simple contact form with ajax submition
* Plugin URI: https://contactform.com
* Author: Fardin Ahmed, Ontor Hasan
* Author URI: https://fardinahmed.com
* Version: 0.0.1
* Text Domain: contact-form
*
*/


add_action('wp_enqueue_scripts', 'handle_all_scripts');
function handle_all_scripts(){
    wp_enqueue_style('contact-form', plugin_dir_url(__FILE__ ). 'asset/style/form.css', array(), '0.0.1', 'all');
    wp_enqueue_script('contact_form_script', plugin_dir_url(__FILE__) . 'asset/js/form.js', ['jquery'], '0.0.1', true );

    wp_localize_script('contact_form_script', 'siteInfo', array(
       'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('contact_form_none')
    ));
}

add_shortcode('simple_contact_form', 'handle_contact_form');
function handle_contact_form(){
    ob_start();
    include_once('form.php');
    return ob_get_clean();
}

add_action('wp_ajax_nopriv_contact_form', 'contact_form_handler');
function contact_form_handler(){
    parse_str($_REQUEST['form_data'], $form_data);

    if(empty($form_data['name'])){
        wp_send_json_error(array(
            'message' => 'Name is required',
        ));
    } else if(!is_string($form_data['name'])) {
         wp_send_json_error(array(
            'message' => 'Name should be string',
        ));
    }
    if(empty($form_data['email'])){
        wp_send_json_error(array(
            'message' => 'Email is required',
        ));
    } else if( !is_email($form_data['email'])){
        wp_send_json_error(array(
            'message' => 'Please provide a valid email',
        ));
    }

    $sanitize = $form_data;
    $sanitize['name'] = sanitize_file_name($sanitize['name']);
    $sanitize['email'] = sanitize_email($sanitize['email']);
    $sanitize['subject'] = sanitize_file_name($sanitize['subject']);
    $sanitize['message'] = sanitize_textarea_field($sanitize['message']);

    update_option('contact_form', $sanitize);
     wp_send_json_success(array(
        'message' => 'Data Successfully saved in database',
    ));

   

    wp_send_json_success(array(
        'message' => 'Your Message Successfully Sent',
    ));
    
}