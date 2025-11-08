<?php
class SUPPORT_CUSTOM_COLUMN
{
    public function __construct()
    {
        add_filter('manage_support_posts_columns', [$this, 'rander_column'], 5);
        add_action('manage_support_posts_custom_column', [$this, 'display_custom_post_type_column_data'], 10, 2);
        add_filter('manage_edit-support_sortable_columns', [$this, 'email_sortable']);
        add_action('pre_get_posts', [$this, 'support_adjust_queries']);

        // add_action('init', [$this, 'new_role']);
    }
    public function rander_column($columns)
    {
        $post_id = get_post_type();
        if ($post_id == 'support') {
            $new_columns = array(
                'email' => esc_html__('Email', 'support'),
                'phone' => esc_html__('Phone', 'support'),
                'address' => esc_html__('Address', 'support'),
            );
            return array_merge($columns, $new_columns);
        }
    }
    public function display_custom_post_type_column_data($column, $post_id)
    {
        if ($column == 'email') {
            // $email =  get_field( 'email',$post_id );
            $email2 = get_post_meta($post_id, 'email');
            echo $email2[0];
        }
        if ($column == 'phone') {
            // $email =  get_field( 'email',$post_id );
            $email2 = get_post_meta($post_id, 'phone');
            echo $email2[0];
        }
        if ($column == 'address') {
            // $email =  get_field( 'email',$post_id );
            $email2 = get_post_meta($post_id, 'address');
            echo $email2[0];
        }
    }
    public function email_sortable($columns)
    {
        $columns['email'] = 'email';
        $columns['phone'] = 'phone';
        $columns['phone'] = 'phone';
        $columns['taxonomy-priroty'] = 'priroty';
        return $columns;

    }
    public function support_adjust_queries($query)
    {
        $orderby = $query->get('orderby');
        if ($orderby == 'email') {
            $query->set('meta_key', 'email');
            $query->set('orderby', 'meta_value');
        }
    }

    function new_role()
    {

        if (get_option('custom_roles_version') < 2) {
            $role_permession = array(
                'read' => false,  // true allows this capability
                'edit_posts' => true,
                'create_users' => true,
                'delete_posts' => false, // Use false to explicitly deny
                'manage_sites' => true,
                'list_users' => true,
            );
            add_role('custom_role', 'Fardin', array(
                'read' => false,  // true allows this capability
                'edit_posts' => true,
                'create_users' => true,
                'delete_posts' => false, // Use false to explicitly deny
                'manage_sites' => true,
                'list_users' => true,
            ));

            update_option('custom_roles_version', 2);
        }
    }
}