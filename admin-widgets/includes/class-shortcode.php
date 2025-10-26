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
            'url' => '#',
            'target'=> '_self',
        ];
        ob_start();
        $att = shortcode_atts($default, $att);
        return "<a href=$att[url] target=$att[target]
        style='padding: 10px 18px; background:#007bff; color:#fff; border:none; border-radius:5px; cursor:pointer;'
        >  $att[text] </a>";
        ob_get_clean();
    }

}