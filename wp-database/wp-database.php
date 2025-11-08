<?php
/**
 * Plugin Name: WP Database
 * Version: 1.0.0
 * Plugin URI: https://wp-database.com
 * Author: Fardin
 * Author URI: https://fardin.com
 * Description: sinple database Operation 
 */

if (!defined('ABSPATH'))
    exit();

define('WP_DATABASE_URL', plugin_dir_url(__FILE__) . 'assets/');
define('WP_DATABASE_PATH', plugin_dir_path(__FILE__) . 'includes/');


class Wp_database
{
    public function __construct()
    {
        $this->load_depandacy();
        $this->int();
        register_activation_hook(__FILE__, [$this, 'wp_database_plugin_activation']);
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
        add_action('admin_enqueue_scripts', [$this, 'admin_script']);
    }
    public function admin_script(){
        wp_enqueue_style('admin_Style', WP_DATABASE_URL . 'css/admin.css', array(), time(), 'all');
    }
    public function load_assets()
    {
        wp_enqueue_style('wp_form_style', WP_DATABASE_URL . 'css/form.css', array(), time(), 'all');
        wp_enqueue_script('wp_database_js', WP_DATABASE_URL . 'js/wp-database.js', ['jquery'], time(), true);
        wp_localize_script('wp_database_js', 'siteInfo', [
            'admin_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('create_none'),
        ]);
        wp_enqueue_style('wp_database_plugin-toast', 'https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css', [], '0.0.1', 'all');
        wp_enqueue_script('wp_database_plugin-toast', 'https://cdn.jsdelivr.net/npm/toastify-js', ['jquery'], '0.0.1', true);
    }

    public function load_depandacy()
    {
        include_once(WP_DATABASE_PATH . 'wp_database_form.php');
        include_once(WP_DATABASE_PATH . 'wp_database.php');
        include_once(WP_DATABASE_PATH . 'wp_admin_menu.php');
    }

    public function int()
    {
        new Wp_database_form();
        new Wp_database_get();
        new Wp_admin_menu();


    }
    public function wp_database_plugin_activation()
    {
        include_once(WP_DATABASE_PATH . 'wp_create_db.php');
        $db = new Wp_create_db();
        $db->createDB();
    }
}
new Wp_database();