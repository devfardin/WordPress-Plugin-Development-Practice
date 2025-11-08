<?php 
class SUPPORT_TEXONOMY {
    public function __construct(){
        add_action('init', [$this, 'register_priroty_taxonomy'], 0);
    }
    function register_priroty_taxonomy() {
    $labels = array(
        'name'                       => _x('Priorites', 'Taxonomy General Name', 'text-domain'),
        'singular_name'              => _x('Priority', 'Taxonomy Singular Name', 'text-domain'),
        'menu_name'                  => __('Priorites', 'text-domain'),
        'all_items'                  => __('All Priorites', 'text-domain'),
        'parent_item'                => __('Parent Priority', 'text-domain'),
        'parent_item_colon'          => __('Parent Priority:', 'text-domain'),
        'new_item_name'              => __('New Priority Name', 'text-domain'),
        'add_new_item'               => __('Add New Priority', 'text-domain'),
        'edit_item'                  => __('Edit Priority', 'text-domain'),
        'update_item'                => __('Update Priority', 'text-domain'),
        'view_item'                  => __('View Priority', 'text-domain'),
        'search_items'               => __('Search Priorites', 'text-domain'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false, // false are tag and true are category
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'priroty',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('priroty', ["support"], $args);
    if(!term_exists('low', 'priroty')){
        wp_insert_term('Low', 'priroty');
    }
    if(!term_exists('medium', 'priroty')){
        wp_insert_term('Medium', 'priroty');
    }
    if(!term_exists('high', 'priroty')){
        wp_insert_term('High', 'priroty');
    }
}

}
// Register Custom Taxonomy
