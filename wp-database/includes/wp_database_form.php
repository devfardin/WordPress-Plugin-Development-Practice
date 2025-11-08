<?php

class Wp_database_form
{
    public function __construct()
    {
        add_shortcode('rander_database_form', [$this, 'wp_database_form__']);

    }
    public function wp_database_form__()
    {
        ob_start();
        ?>

        <div class="card" role="region" aria-labelledby="formTitle">
            <h2 id="formTitle">Employee Submission</h2>
            <p class="lead">Please fill your details and upload the required files (resume, ID, certificates, etc.). Max file
                size 10MB each.</p>

    
            <form class="employee-form" method="post"  enctype="multipart/form-data">
                <div>
                    <label for="emp_name">Full name</label>
                    <input id="emp_name" name="name" type="text" placeholder="Jane Doe" required>
                </div>

                <div>
                    <label for="emp_email">Email address</label>
                    <input id="emp_email" name="email" type="email" placeholder="you@company.com" required>
                </div>

                <div>
                    <label for="emp_phone">Phone</label>
                    <input id="emp_phone" name="phone" type="text" placeholder="+8801XXXXXXXXX"
                        title="Use numbers, + and - only" required>
                </div>

                <div>
                    <label for="emp_position">Position applied for</label>
                    <input id="emp_position" name="position" type="text" placeholder="e.g. Frontend Developer">
                </div>

                <div class="full select-wrap">
                    <label for="emp_department">Department</label>
                    <select id="emp_department" name="department" required>
                        <option value="">Select department</option>
                        <option>Engineering</option>
                        <option>Design</option>
                        <option>Marketing</option>
                        <option>HR</option>
                        <option>Sales</option>
                    </select>
                </div>

                <div class="full">
                    <label for="emp_message">Message / Notes</label>
                    <textarea id="emp_message" name="message"
                        placeholder="Anything you'd like to tell us (optional)"></textarea>
                </div>

                <!-- <div class="full">
                    <label>Required files</label>
                    <div class="file-wrap" aria-hidden="false">
                        <label for="files" class="file-label" tabindex="0">📁 Choose files</label>
                        <div class="file-note">PDF, DOCX, JPG, PNG — up to 10MB each</div>
                    </div>

                    <input id="files" name="files[]" type="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple>

                    <div class="file-list" id="fileList" aria-live="polite">No files selected.</div>
                </div> -->

                <div class="actions">
                    <button type="reset" class="btn btn-ghost">Reset</button>
                    <button type="submit" class="btn">Submit Application</button>
                </div>
            </form>
        </div>

        <?php return ob_get_clean();
    }
}