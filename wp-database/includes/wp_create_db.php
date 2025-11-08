<?php
class Wp_create_db
{
    public function createDB()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'employee_submissions';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `full_name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `phone` VARCHAR(50) NOT NULL,
            `position` VARCHAR(100) DEFAULT NULL,
            `department` VARCHAR(100) DEFAULT NULL,
            `message` TEXT DEFAULT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}