<?php 
if(!defined('ABSPATH')){
    exit;
}

Class Custom_column {
    public function __construct() {
        add_filter('manage_posts_columns', [$this, 'add_custom_column']);
        add_action('manage_posts_custom_column', [$this, 'rander_columns'], 10, 2);
        add_filter('manage_edit-post_sortable_columns', [$this, 'make_sortable_column']);
        add_filter('manage_edit-post_sortable_columns', [$this, 'make_sortable_author']);
        add_action('pre_get_posts', [$this, 'sort_column']);
    }
    public function add_custom_column($columns) {
        // $columns['price'] = esc_html('Price');
        
        $first_part = array_slice($columns, 0, 3, true);

        $second_part = array_slice($columns, 3, count($columns), true);
        
        $first_part['price'] = esc_html("Price");
        return array_merge($first_part, $second_part);
    }
    public function rander_columns($column_name, $id) {
        if($column_name == 'price'){
            // $price = get_post_meta($id, 'price', true);
            $price = get_field('price', $id);
            echo $price;
        }
    }

    public function make_sortable_column($columns) {
        $columns['price'] = 'price';
        return $columns;
    }

    // Make Author filter option
    public function make_sortable_author($columns) {
        $columns['author'] = 'author';
        return $columns;
    }

    public function sort_column($query) {
        if($query->get('orderby')== 'price'){
            $query->set('meta_key', 'price');
            $query->set('orderby', 'meta_value_num');
        }
    }
}