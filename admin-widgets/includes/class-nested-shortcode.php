<?php

Class WID_Nested_Shortcode {
    public function __construct() {
        add_shortcode('nestedshortcode', [$this, 'rander_nested_shortcode']);
    }
    public function rander_nested_shortcode($att, $content=null) {
        $default = [
            'type' => 'info',
        ];

        $bg_color = [
            'info' => '#d1ecf1',
            'error' => '#f8d7da',
            'success' => '#d4edda',
            'warning' => '#fff3cd',
        ];
        $color =[
            'info' => '#0c5460',
            'error' => '#721c24',
            'success' => '#155724',
            'warning' => '#856404',
        ];
        $att = shortcode_atts($default, $att);
        $output = "<div style='padding: 15px 16px; background:{$bg_color[$att['type']]}; color:{$color[$att['type']]}; border:1px solid {$color[$att['type']]}; border-radius:6px; margin:6px 0px; font-size: 20px; font-weight:500; font-family: arial;'>";
        $output .= do_shortcode($content);
        $output .= "</div>";
        return $output;
    }
}