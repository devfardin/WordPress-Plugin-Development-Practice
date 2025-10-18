<div class="wrap">
    <h1>filap your form</h1>
    <div>
        <?php
        $save_data = get_option('admin_panel_setting', []); ?>

    </div>
    <div class="form-container">
        <form method="post" class="contact-form" action="<?php echo admin_url('admin-post.php'); ?>">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Your name" value="<?php echo $save_data['name'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Your email" value="<?php echo $save_data['email'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="Subject" value="<?php echo $save_data['subject'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Write your message..." rows="5">
                    <?php echo $save_data['message'] ?? '' ?>
                </textarea>
            </div> 

            <input type="hidden" name="action" value="save_admin_panel_settings">
            <input type="hidden" name="page_url" value="<?php echo site_url(); ?>">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('admin_panel_nonce') ?>">

            <input type="submit" value="Send Message" class="btn-submit">
        </form>
    </div>
</div>