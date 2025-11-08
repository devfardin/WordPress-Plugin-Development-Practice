<?php 
Class Class_shortcode_button{
    public function __construct(){
        add_shortcode('ajax_demo_button', [$this, 'rander_button']);
        add_action('wp_ajax_demo', [$this, 'demo_call']);
        add_action('wp_ajax_nopriv_demo', [$this, 'demo_call']);
    }
    public function rander_button(){
        ob_start();

        ?>
        <style>
            #ajax-demo-btn{background: #007cba; color: white; padding: 10px 15px; border: none; border-radius: 6px;}
            #ajax-demo-btn:hover{background: #005a87;}
            #ajax-demo-result{margin-top: 10px;}
        </style>
        <p><button id="ajax-demo-btn">Click Me</button></p>
        <div id="ajax-demo-result"></div>
        <?php
       return ob_get_clean();
    }
     public function demo_call() {
        check_ajax_referer('nonce', 'verify_nonce' ); // nonce ==  wp_create_nonce('nonce')
        //  //formData.append('verify_nonce', ajdm.create_nonce);
        wp_send_json_success('Received Ajax Call');
    }


}
