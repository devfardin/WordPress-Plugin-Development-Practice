<?php 
$save_data= get_option('secure_plugin_data');
if( !empty($save_data) ){
    echo "Fast Name: $save_data[fname] </br>";
    echo "Last Name: $save_data[lname] </br>";
    echo "Email: $save_data[email] </br>";
    echo "Address: $save_data[address] </br>";
    echo "Message: $save_data[message] </br>";

}
?>

 <div class="form-container">
        <h2>Secure Plugin Form</h2>
        <form method="post" id="user_info_form">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
            </div>

            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" placeholder="Enter your last name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your address"></textarea>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Enter your Message"></textarea>
            </div>

            <input type="submit" class="submit-btn" value="Submit"/>
        </form>
    </div>