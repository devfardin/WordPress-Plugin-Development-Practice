<?php
class SUPPORT_CUSTOM_META_BOX
{

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_custom_support_meta_box']);
        add_action('save_post', [$this, 'save_custom_support_meta_box_data']);
        add_action('admin_menu', [$this, 'wpdocs_remove_post_custom_fields']);

    }
    /**
     * Remove Custom Fields meta box
     */
    function wpdocs_remove_post_custom_fields()
    {
        remove_meta_box('postcustom', 'support', 'normal');
    }
    // Register Meta Box
    public function add_custom_support_meta_box()
    {
        add_meta_box(
            'custom_support',
            'Support Details',
            [$this, 'custom_support_meta_box_callback'],
            ["support"],
            'normal',
            'default'
        );
    }

    // Meta Box Callback
    public function custom_support_meta_box_callback($post)
    {
        wp_nonce_field('custom_support_meta_box', 'custom_support_meta_box_nonce');
        $values = get_post_meta($post->ID);
        ?>
        <div class="meta-box-container">

            <div class="meta-box-field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name"
                    value="<?php echo esc_attr(isset($values['name'][0]) ? $values['name'][0] : ''); ?>" />
            </div>

            <div class="meta-box-field">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                    value="<?php echo esc_attr(isset($values['email'][0]) ? $values['email'][0] : ''); ?>" />
            </div>

            <div class="meta-box-field">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone"
                    value="<?php echo esc_attr(isset($values['phone'][0]) ? $values['phone'][0] : ''); ?>" />
            </div>

            <div class="meta-box-field">
                <label for="address">Address</label>
                <input type="text" id="address" name="address"
                    value="<?php echo esc_attr(isset($values['address'][0]) ? $values['address'][0] : ''); ?>" />
            </div>
        </div>
        <?php
    }

    // Save Meta Box Data
    public function save_custom_support_meta_box_data($post_id)
    {
        if (!isset($_POST['custom_support_meta_box_nonce'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['custom_support_meta_box_nonce'], 'custom_support_meta_box')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }


        if (isset($_POST['name'])) {
            update_post_meta($post_id, 'name', sanitize_text_field($_POST['name']));
        }

        if (isset($_POST['email'])) {
            update_post_meta($post_id, 'email', sanitize_text_field($_POST['email']));
        }

        if (isset($_POST['phone'])) {
            update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
        }

        if (isset($_POST['address'])) {
            update_post_meta($post_id, 'address', sanitize_text_field($_POST['address']));
        }
    }

}