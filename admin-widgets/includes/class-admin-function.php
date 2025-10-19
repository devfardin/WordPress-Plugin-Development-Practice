<?php

class Class_admin_function
{
    public function __construct()
    {
        add_filter('admin_footer_text', [$this, 'custom_admin_footer_text']);
    }
    public function custom_admin_footer_text()
    {
        return '<span>Plugin Developer <a href="https://github.com/devfardin" target="_blank">Fardin Ahmed</a></span>';
    }
}