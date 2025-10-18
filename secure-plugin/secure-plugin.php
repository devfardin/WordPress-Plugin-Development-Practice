<?php
/*
 * Plugin Name: Secure Plugin
 * Plugin URI: https://devfardin.com
 * Description: Secure Plugin is a lightweight yet powerful WordPress security solution designed to protect your website from common vulnerabilities, unauthorized access, and malicious activities
 * Version: 0.0.1
 * Author: Fardin Ahmed
 * Author URI: https://devfardin.com
 * Text Domain: secure-plugin
 */


// add script and style 
function security_plugin_enqueue_assets()
{
    // wp_enqueue_style($handle, $src, $deps, $ver, $media);
    wp_enqueue_style('secure-plugin', plugin_dir_url(__FILE__) . 'assets/css/style.css', [], '0.0.1', 'all');
    wp_enqueue_style('secure-plugin-toast', 'https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css', [], '0.0.1', 'all');
    wp_enqueue_script('secure-plugin-script', plugin_dir_url(__FILE__) . 'assets/js/form.js', ['jquery'], '0.0.1', true);
    wp_enqueue_script('secure-plugin-toast', 'https://cdn.jsdelivr.net/npm/toastify-js', ['jquery'], '0.0.1', true);


    wp_localize_script('secure-plugin-script', 'siteInfo', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('secure_plugin_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'security_plugin_enqueue_assets');

// Shortcode register
function secure_plugin_form_shortcode()
{
    ob_start();
    require_once('form.php');
    return ob_get_clean();
}
add_shortcode('secure_plugin_form', 'secure_plugin_form_shortcode');

function secure_plugin_form_handler()
{
    // Nonce Validation
    if (!wp_verify_nonce($_REQUEST['nonce'], 'secure_plugin_nonce')) {
        wp_send_json_error(array(
            'message' => 'Unauthorized Request',
        ));
    }

    parse_str($_REQUEST['form_data'], $form_data);

    if (empty($form_data['fname']) || !is_string($form_data['fname'])) {
        wp_send_json_error(array(
            'message' => 'Please enter a valid first name. It should contain only letters.',
        ));
    }

    if (empty($form_data['lname']) || !is_string($form_data['lname'])) {
        wp_send_json_error(array(
            'message' => 'Please enter a valid last name. It should contain only letters.',
        ));
    }

    // if (empty($form_data['phone']) || !is_numeric($form_data['phone'])) {
    //     wp_send_json_error(array(
    //         'message' => 'Please enter a valid phone number. Use only numbers (0–9).',
    //     ));
    // }

    if (empty($form_data['email']) || !is_email($form_data['email'])) {
        wp_send_json_error(array(
            'message' => 'Please enter a valid email address (example: name@email.com).',
        ));
    }

    if (empty($form_data['address'])) {
        wp_send_json_error(array(
            'message' => 'Please provide your address.',
        ));
    }
    if (empty($form_data['address'])) {
        wp_send_json_error(array(
            'message' => 'Please provide your message.',
        ));
    }

    $sanitize = $form_data;
    $sanitize['fname'] = sanitize_file_name($sanitize['fname']);
    $sanitize['lname'] = sanitize_file_name($sanitize['lname']);
    $sanitize['email'] = sanitize_email($sanitize['email']);
    $sanitize['address'] = sanitize_text_field($sanitize['address']);
    $sanitize['address'] = sanitize_textarea_field($sanitize['address']);


        error_log('=================');
    error_log(print_r($form_data, true));
    error_log('===========================');



    update_option('secure_plugin_data', $sanitize);
    wp_send_json_success(array(
        'message' => 'Data Successfully saved in database',
    ));




    wp_send_json_success(array(
        'message' => 'Form submitted successfully!',
        'data' => $form_data
    ));

}


add_action('wp_ajax_nopriv_secure_plugin_form', 'secure_plugin_form_handler');

// add_action('wp_ajax_nopriv_secure_plugin_form', 'secure_plugin_form_handler');
