<?php

class Wp_database_get
{
    public function __construct()
    {
        add_action('wp_ajax_nopriv_wp_databases', [$this, 'wp_database_ajax_form_submition']);
        add_action('wp_ajax_wp_databases', [$this, 'wp_database_ajax_form_submition']);
    }
    public function wp_database_ajax_form_submition()
    {
        parse_str($_POST['form_data'], $form_data);

        global $wpdb;
        $table_name = $wpdb->prefix . 'employee_submissions';

        $full_name = sanitize_text_field($form_data['name']);
        $email = sanitize_email($form_data['email']);
        $phone = sanitize_text_field($form_data['phone']);
        $position = sanitize_text_field($form_data['position']);
        $department = sanitize_text_field($form_data['department']);
        $message = sanitize_textarea_field($form_data['message']);

        $query = $wpdb->insert(
            $table_name,
            array(
                'full_name' => $full_name,
                'email' => $email,
                'phone' => $phone,
                'position' => $position,
                'department' => $department,
                'message' => $message,
            ),
            // array('%s', '%s', '%s', '%s', '%s', '%s')
        );

        if ($query) {
            // ✅ Success message
            wp_send_json_success([
                'message' => 'Form submitted successfully!',
            ]);
        } else {
            // ❌ Error message
            wp_send_json_error([
                'message' => 'Failed to save data. Please try again later.',
                'error' => $wpdb->last_error, // shows DB error if any
            ]);
        }








    }
}