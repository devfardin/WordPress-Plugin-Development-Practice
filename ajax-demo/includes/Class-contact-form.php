<?php
class Contact_form_notifaction
{
    function __construct()
    {
        add_shortcode('contact_form_rander', [$this, 'rander_form']);
        add_action('wp_ajax_contact_form_ajax', [$this, 'rander_ajax_contact']);
        add_action('wp_ajax_nopriv_contact_form_ajax', [$this, 'rander_ajax_contact']);
    }
    public function rander_form()
    {
        ob_start(); ?>

        <div class="contact-container">
            <h2>Contact Us</h2>
            <form id="ajax-contact-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Your email">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Write your message..." rows="5"></textarea>
                </div>
                <input type="submit" value="Send Message" id="btn-submit">
            </form>
            <div id="ajax-contact-result"></div>
        </div>

        <?php return ob_get_clean();
    }
    public function rander_ajax_contact(){
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_text_field($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_text_field($_POST['message']);

        if(empty($name) || empty($email) || empty($subject) || empty($message)){
            wp_send_json_error('All Fields are required');
        }
        $to = get_option('admin_email');
        $sub = "Contact Form Submission from $name ";
        $body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";
        $headers = ['Content-Type: text/plain; charset=UTF-8'];
        if(wp_mail($to, $sub, $body,$headers )){
            wp_send_json_success('Message sent successfully');
        } else {
            wp_send_json_error('Failed to sent');
        }

    }
}