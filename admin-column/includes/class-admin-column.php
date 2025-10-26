<?php

if (!defined('ABSPATH')) {
    exit;
}

class Admin_column
{
    public function init()
    {
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }
    public function define_constants()
    {
        define('AC_VERSION', '1.0.0');
        define('AC_PATH', plugin_dir_path(__DIR__) . 'includes/');
        define('AC_URL', plugin_dir_url(__DIR__));
    }
    public function init_plugin()
    {
        $this->includes();
        $this->init_hooks();
    }
    public function includes()
    {
        // if (file_exists(AC_PATH . 'app/CustomColumn.php')) {
            // include_once(AC_PATH . 'app/CustomColumn.php');
            include_once( plugin_dir_path(__DIR__) . 'includes/app/CustomColumn.php');
        // }
        new Custom_column();
    }
    public function init_hooks()
    {

        load_plugin_textdomain('admin-column', false, plugin_dir_path(__FILE__). 'i18n/');
    }


}

