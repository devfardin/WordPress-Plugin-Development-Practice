<?php
class Wp_admin_menu
{
    private $table_name;
    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'employee_submissions';
        add_action('admin_menu', [$this, 'wp_database_admin_menu']);
        add_action('admin_post_delete_entry', [$this, 'delete_record']);
    }
    public function wp_database_admin_menu()
    {
        add_menu_page('Wp Database', 'Wp Database', 'manage_options', 'wp-database', [$this, 'show_admin_menu_callback'], 'dashicons-database', 10);
    }
    public function delete_record () {
        global $wpdb;
        if(!wp_verify_nonce($_GET['_wpnonce'], 'delete_entry')) {
            wp_die('Security check failed');
        } 
        $id = intval($_GET['id']);
        if( $id > 0) {
            $wpdb->delete($this->table_name, ['id'=> $id]);
        }
        wp_redirect(admin_url('admin.php?page=wp-database'));
    }
    public function show_admin_menu_callback()
    {
        global $wpdb;
        $sql = "SELECT * FROM  {$this->table_name}";
        $entries = $wpdb->get_results($sql);


        ?>
        <div class="wrap">
            <h1>WPDB Simple Plugin</h1>
            <p>This plugin demonstrates basic WordPress database operations.</p>
            <h2>Database Entries</h2>
            <?php if (empty($entries)): ?>
                <p style="font-size: 20px; text-align: center;">No Entries Found </p>
            <?php else: ?>

                <table class="wp-list-table widefat striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entries as $entry) {
                             $delete_url = wp_nonce_url(
                                admin_url('admin-post.php?action=delete_entry&id='. $entry->id), 'delete_entry')
                            ?>
                            <tr>
                                <td><?php echo esc_html($entry->id); ?></td>
                                <td><?php echo esc_html($entry->full_name); ?></td>
                                <td><?php echo esc_html($entry->email); ?></td>
                                <td><?php echo esc_html($entry->phone); ?></td>
                                <td><?php echo esc_html($entry->position); ?></td>
                                <td><?php echo esc_html($entry->department); ?></td>
                                <td><?php echo esc_html($entry->message); ?></td>
                                <td>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="button button-small"
                                        onclick="return confirm('Are you sure you want to delete this entry?')">
                                        Delete
                                    </a>

                                    <a href="<?php // echo esc_url(// $update_url); ?>" class="button button-small">
                                        Update
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php }
}