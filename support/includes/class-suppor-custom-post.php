<?php 
class SUPPORT_CUSTOM_POST {
    public function __construct(){
     add_action('init', [$this, 'register_support_post_type'], 0);   
    }

    public // Register Custom Post Type
function register_support_post_type() {
    $labels = array(
        'name'                  => _x('Supports', 'Post Type General Name', 'support'),
        'singular_name'         => _x('Support', 'Post Type Singular Name', 'support'),
        'menu_name'            => __('Supports', 'support'),
        'all_items'            => __('All Supports', 'support'),
        'add_new_item'         => __('Add New Support', 'support'),
        'add_new'              => __('Add New', 'support'),
        'edit_item'            => __('Edit Support', 'support'),
        'update_item'          => __('Update Support', 'support'),
        'search_items'         => __('Search Support', 'support'),
    );

    $args = array(
        'label'                 => __('Support', 'support'),
        'labels'                => $labels,
        'supports'              => ["title","editor","thumbnail","excerpt","author"],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-superhero',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('support', $args);
}

}

