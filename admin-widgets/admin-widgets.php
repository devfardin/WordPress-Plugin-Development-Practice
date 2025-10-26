<?php

/**
 * Plugin Name: Admin Widgets
 * Descripton: A demo Plugin to showcase asset management in wordpress.
 * Version: 1.0.0
 * Author: Fardin
 * Author URI: https://fardinahmed.com
 * Plugin URI: https://asset-management-demo.com
 * License: GPL v2 or latter
 * License URI: https://fardin.com
 * Text Domain: admin-widgets
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WID_ADMIN_ASSETS_URL', plugin_dir_url(__FILE__) . 'assets/admin/');
define('WID_ADMIN_ASSETS_PATH', plugin_dir_path(__FILE__) . 'includes/');

class Admin_widgets
{
    function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'wid_load_admin_assets']);
        $this->load_depandancy();
        $this->initialize();
    }

    function wid_load_admin_assets($hook)
    {
        if ($hook !== 'index.php')
            return;
        wp_enqueue_style('admin_assets_style', WID_ADMIN_ASSETS_URL . 'css/widget-style.css', [], time());
        wp_enqueue_script('admin_main_script', WID_ADMIN_ASSETS_URL . 'js/main.js', [], time(), true);
    }

    public function load_depandancy() {
        include_once(WID_ADMIN_ASSETS_PATH . 'class-basic-admin-widget.php');
        include_once(WID_ADMIN_ASSETS_PATH . 'class-admin-function.php');
        include_once(WID_ADMIN_ASSETS_PATH . 'class-shortcode.php');
        include_once(WID_ADMIN_ASSETS_PATH . 'class-nested-shortcode.php');
    }
    public function initialize() {
        new WID_Basic_Widget();
        new Class_admin_function();
        new Shortcode();
        new WID_Nested_Shortcode();
    }
    
}
new Admin_widgets();