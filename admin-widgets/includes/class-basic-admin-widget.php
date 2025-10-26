<?php
class WID_Basic_Widget
{
    function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'register_widget']);

    }
    public function register_widget()
    {
        wp_add_dashboard_widget(
            'wid_basic_widget',
            'Quick Links',
            [$this, 'wid_rander_dashboard_widget'],
            ''

        );
    }
    public function wid_rander_dashboard_widget()
    {
        $links = [
            [
                'title' => 'Create New Post',
                'url' => admin_url('post-new.php'),
                'icon' => '📝',
                'description' => 'Write a new blog post',
            ],
            [
                'title' => 'All Posts',
                'url' => admin_url('edit.php'),
                'icon' => '📚',
                'description' => 'View and manage all blog posts',
            ],
            [
                'title' => 'Create New Page',
                'url' => admin_url('post-new.php?post_type=page'),
                'icon' => '📄',
                'description' => 'Create a new page for your site',
            ],
            [
                'title' => 'All Pages',
                'url' => admin_url('edit.php?post_type=page'),
                'icon' => '📘',
                'description' => 'View and manage all pages',
            ],
            [
                'title' => 'Manage Comments',
                'url' => admin_url('edit-comments.php'),
                'icon' => '💬',
                'description' => 'Review and moderate user comments',
            ],
            [
                'title' => 'Manage Options',
                'url' => admin_url('options.php'),
                'icon' => '🛠️',
                'description' => 'Access and configure advanced WordPress settings and site options.',
            ],
            [
                'title' => 'Upload Media',
                'url' => admin_url('media-new.php'),
                'icon' => '🖼️',
                'description' => 'Upload new images, videos, or files',
            ],
            [
                'title' => 'Media Library',
                'url' => admin_url('upload.php'),
                'icon' => '🗂️',
                'description' => 'Browse and manage all media files',
            ],
            [
                'title' => 'Theme Customizer',
                'url' => admin_url('customize.php'),
                'icon' => '🎨',
                'description' => 'Personalize your website appearance',
            ],
            [
                'title' => 'Plugin Manager',
                'url' => admin_url('plugins.php'),
                'icon' => '🔌',
                'description' => 'View, activate, or deactivate plugins',
            ],
            [
                'title' => 'Install Plugin',
                'url' => admin_url('plugin-install.php'),
                'icon' => '⬇️',
                'description' => 'Install new plugins from the directory',
            ],
            [
                'title' => 'Manage Users',
                'url' => admin_url('users.php'),
                'icon' => '👥',
                'description' => 'View and manage all registered users',
            ],
            [
                'title' => 'Create New User',
                'url' => admin_url('user-new.php'),
                'icon' => '➕',
                'description' => 'Add a new user account',
            ],
            [
                'title' => 'View Site',
                'url' => home_url(),
                'icon' => '🌐',
                'description' => 'Visit your live website',
            ],
            [
                'title' => 'Settings',
                'url' => admin_url('options-general.php'),
                'icon' => '⚙️',
                'description' => 'Adjust your site’s general settings',
            ],
        ];

        echo '<div class="quick-links-grid">';

        foreach ($links as $link) {
            ?>
            <a href="<?php echo esc_url($link['url']) ?>" class="quick-link-item">
                <div class="quick-link-icon"><?php echo esc_html($link['icon']) ?></div>
                <div class="quick-link-content">
                    <div class="quick-link-title"><?php echo esc_html($link['title']) ?></div>
                    <div class="quick-link-desc"><?php echo esc_html($link['description']) ?></div>
                </div>
            </a>
            <?php
        }

        echo '</div>';

    }
}