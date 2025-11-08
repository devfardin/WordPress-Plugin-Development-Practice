<?php

/**
 * Plugin Name: Support
 * Description: This plugin only create for support ticket stystem
 * Version: 1.0.0
 * Author Name: Fardin
 * Author URI: https://fardin.com
 * Text Domain: support
 */

if (!defined('ABSPATH'))
    exit();

if (!defined('SUPPORT_PLUGIN_DIR_PATH')) {
    define('SUPPORT_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}
if (!defined('SUPPORT_PLUGIN_DIR_URL')) {
    define('SUPPORT_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

class SUPPORT
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_assets_js']);
        add_action('wp_enqueue_scripts', [$this, 'load_assets_css']);
        $this->load_depandancy();
        $this->init();

    }
    public function load_depandancy()
    {
        include_once(SUPPORT_PLUGIN_DIR_PATH . 'includes/class-suppor-custom-post.php');
        include_once(SUPPORT_PLUGIN_DIR_PATH . 'includes/class-support-form.php');
        include_once(SUPPORT_PLUGIN_DIR_PATH . 'includes/class-support-custom-meta-box.php');
        include_once(SUPPORT_PLUGIN_DIR_PATH . 'includes/class-support-column.php');
        include_once(SUPPORT_PLUGIN_DIR_PATH . 'includes/class-support-taxonomy.php');
    }
    public function load_assets_js()
    {

        wp_enqueue_script('custom_support_form', SUPPORT_PLUGIN_DIR_URL . 'assets/js/custom-support-form.js', ['jquery'], time(), true);

        wp_localize_script('custom_support_form', 'support', [
            'admin_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('create_none'),
        ]);
    }
    public function load_assets_css()
    {
        wp_enqueue_style('custom_support_form', SUPPORT_PLUGIN_DIR_URL . 'assets/css/custom-support-form.css', array(), time(), 'all');
    }

    public function init()
    {
        new SUPPORT_CUSTOM_POST();
        new SUPPRT_CUSTOM_FORM();
        new SUPPORT_CUSTOM_META_BOX();
        new SUPPORT_CUSTOM_COLUMN();
        new SUPPORT_TEXONOMY();

    }
}
new SUPPORT();