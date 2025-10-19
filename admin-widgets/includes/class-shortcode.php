<?php
class Shortcode
{
    public function __construct()
    {
        add_shortcode('ad-button', [$this, 'rander_shortcode']);
    }
    public function rander_shortcode($att)
    {
        $default = [
            'text'=> 'Click Me',
        ];
        ob_start();
        $att = shortcode_atts($default, $att);
        return "<button>  $att[text] </button>";
        ob_get_clean();
    }

}