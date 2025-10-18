<?php

/**
 * Plugin Name: Admin Column
 * Descripton: A demo Plugin to showcase asset management in wordpress.
 * Version: 1.0.0
 * Author: Fardin
 * Author URI: https://fardinahmed.com
 * Plugin URI: https://asset-management-demo.com
 * License: GPL v2 or latter
 * License URI: https://fardin.com
 * Text Domain: admin-column
 */

if (!defined('ABSPATH')) {
    exit;
}

if (file_exists(plugin_dir_path(__FILE__) . 'includes/class-admin-column.php')) {
    include_once(plugin_dir_path(__FILE__) . 'includes/class-admin-column.php');
}

$admin_column = new Admin_column();
$admin_column->init();