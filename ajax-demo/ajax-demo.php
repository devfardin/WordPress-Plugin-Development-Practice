<?php
/**
 * Plugin Name: Ajax Demo
 * Description: A simple plugin to demonstrate Ajax in wordPress with shortcode and dashboard widget.
 * Version: 1.0.0
 * Author: Fardin
 * Author URI: https://devfardin.com
 * Plugin URI: https://ajax-demo.com
 * Text Domain: ajax-demo
 */

defined('ABSPATH') or exit();
define('AJDM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AJDM_PLUGIN_PATH', plugin_dir_path(__FILE__));

class Ajax_demo
{
    public function __construct()
    {
        $this->include_resources();
        $this->init();
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
        add_action('admin_enqueue_scripts', [$this, 'load_admin_enqueue_script']);
    }
    public function include_resources()
    {
        require_once( AJDM_PLUGIN_PATH . 'includes/class-shortcode-button.php');
        require_once( AJDM_PLUGIN_PATH . 'includes/Class-currency-widget.php');
        require_once( AJDM_PLUGIN_PATH . 'includes/Class-contact-form.php');
    }
    public function init()
    {
        new Class_shortcode_button();
        new Dashboard_currency_widget();
        new Contact_form_notifaction();
    }
    public function load_assets()
    {
        wp_enqueue_script('ajdm-main-js', AJDM_PLUGIN_URL . 'assets/js/ajax-demo.js', [], '1.0.0', true);
        wp_localize_script('ajdm-main-js', 'ajdm', [
            'ajax_url'=> admin_url('admin-ajax.php'),
            'create_nonce' => wp_create_nonce('nonce'),
            'contact_nonce' => wp_create_nonce('create_nonce__')
        ]);
    }
    public function load_admin_enqueue_script($hook) {
        if($hook !== 'index.php') {
            return;
        }
        wp_enqueue_script('admin-script-js', AJDM_PLUGIN_URL . 'assets/js/admin.js', [], time(), true);
        wp_localize_script('admin-script-js', 'currency', [
            'ajax_url'=> admin_url('admin-ajax.php'),
            'create_nonce' => wp_create_nonce('carrency'),
        ]);
    }
}
new Ajax_demo();