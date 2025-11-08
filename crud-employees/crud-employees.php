<?php 
/**
 * Plugin Name: WP Employees  CRUD
 * Description: This plugin performs CRUD Operations with Employees Table. also on Activation it will create a dynamic wordPress page and it will have a shortcode.
 * Version: 1.0.0
 * Author: Fardin Ahmed
 * Author URI: https://fardin.com
 */

if(!defined('ABSPATH')) exit();

class Crud_employees{
    public function __construct(){
        add_action('wp_footer', [$this, 'rander_footer']);
    }

}
new Crud_employees();