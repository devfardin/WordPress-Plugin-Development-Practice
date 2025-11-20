<?php

class SUPPRT_CUSTOM_FORM
{
    public function __construct()
    {
        add_shortcode('rander_custom_support_form', [$this, 'custom_support_form']);
        add_action('wp_ajax_nopriv_support_form', [$this, 'custom_support_form_ajax']);
        add_action('wp_ajax_support_form', [$this, 'custom_support_form_ajax']);
    }
    public function custom_support_form($att)
    {
        $default = [
            'fields' => null,
        ];
        $atts = shortcode_atts($default, $att);

        $fields = array_map('trim', explode(',', $atts['fields']));

        ob_start(); ?>
        <div class="contact-card" role="region" aria-labelledby="contactTitle">
            <div class="contact-header">
                <div class="brand-dot">G</div>
                <div>
                    <h1 id="contactTitle">Get in touch</h1>
                    <p class="lead">Send us a message — we usually reply within 24 hours.</p>
                </div>
            </div>

            <!-- the form (no JS required for HTML demonstration) -->
            <form class="contact-form" method="POST" action="support_form">
                <!-- <div class="form-row">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="Your full name">
                </div>

                <div class="form-row">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="you@company.com">
                </div>

                <div class="form-row">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="tel" placeholder="+8801XXXXXXXXX">
                    <div class="helper">Optional — include country code if needed</div>
                </div>
                <div class="form-row">
                    <label for="phone">Address</label>
                    <input id="address" name="address" type="text" placeholder="Dhaka, Bangaldesh">
                </div> -->
                <?php
                if (!empty($fields)) {
                    foreach ($fields as $field) { ?>
                        <div class="form-row">
                            <label for="<?php echo esc_attr($field) ?>">
                                <?php echo esc_html(ucfirst($field)) ?>
                            </label>
                            <input id="<?php echo esc_attr($field) ?>" name="<?php echo esc_attr($field) ?>">
                        </div>
                    <?php }
                }
                ?>
                <input type="hidden" name="fields" value="<?php echo esc_attr( $atts['fields']) ?>">
                <div class="form-row full">
                    <label for="priroty">Select Priroty</label>
                    <select name="priroty" id="priroty">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="form-row full">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Write your message..."></textarea>
                </div>

                <div class="actions">
                    <button type="button" class="btn btn-ghost" onclick="this.form.reset();">Reset</button>
                    <button type="submit" class="btn">Send Message</button>
                </div>
            </form>

            <!-- optionally show messages below -->
            <!-- <div class="msg ok">Message sent — thank you!</div> -->
            <!-- <div class="msg error">There was an error sending your message.</div> -->
        </div>

        <?php return ob_get_clean();
    }


    public function custom_support_form_ajax()
    {
        parse_str($_REQUEST['form_data'], $form_data);



        $name = sanitize_text_field($form_data['name']);
        // $email = sanitize_email($form_data['email']);
        // $phone = sanitize_text_field($form_data['phone']);
        // $address = sanitize_text_field($form_data['address']);
        $message = sanitize_textarea_field($form_data['message']);
        $term = sanitize_text_field($form_data['priroty']);
        $fields = sanitize_text_field($form_data['fields']);
        $extra_fields = array_map('trim', explode(',', $fields));

        foreach($extra_fields as $field) {
            if(!empty($field && isset($form_data[$field]))){
                $value = sanitize_text_field($form_data[$field]);
                $Key = ucfirst($field);
                $message .=   "\n{$Key}: {$value} ";
            }
        }
        



        // print($phone);

        $post_data = array(
            'post_title' => $name,
            'post_content' => $message,
            'post_status' => 'pending', // or 'draft', 'pending', etc.
            'post_type' => 'support', // Replace with your actual custom post type slug
            'post_author' => 1, // User ID of the author
            // Add more fields as needed, e.g., 'meta_input' for custom fields
        );

        check_ajax_referer('create_none', 'nonce');

        $post_id = wp_insert_post($post_data);

        if (!is_wp_error($post_id)) {
            if (isset($term)) {
                wp_set_post_terms($post_id, $term, 'priroty');
            }
            if (isset($name)) {
                update_post_meta($post_id, 'name', sanitize_text_field($name));
            }

            if (isset($email)) {
                update_post_meta($post_id, 'email', sanitize_text_field($email));
            }

            if (isset($phone)) {
                update_post_meta($post_id, 'phone', $phone);
            }

            if (isset($address)) {
                update_post_meta($post_id, 'address', sanitize_text_field($address));
            }

            wp_send_json_success(array(
                'message' => 'Post created successfully',
            ));
        } else {
            wp_send_json_success(array(
                'message' => 'Error creating custom post: ' . $post_id->get_error_message(),
            ));
        }

    }
}