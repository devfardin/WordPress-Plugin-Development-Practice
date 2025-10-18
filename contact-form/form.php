<div class="contact-container">
  <?php
  $save_info = get_option('contact_form');

  if (!empty($save_info)) {
    echo "Name: $save_info[name] </br>";
    echo "Email: $save_info[email] </br>";
    echo "Subject: $save_info[subject] </br>";
    echo "Mesage: $save_info[message] </br>";
  }
  ?>
  <h2>Contact Us</h2>
  <form method="POST" class="contact-form">
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

    <input type="submit" value="Send Message" class="btn-submit">
  </form>
</div>