<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

header('Content-Type: text/plain; charset=utf-8');

echo "Site URL: " . get_site_url() . "\n";
echo "Home URL: " . get_home_url() . "\n";
echo "show_on_front: " . get_option('show_on_front') . "\n";
echo "page_on_front: " . get_option('page_on_front') . "\n";
echo "Current theme: " . wp_get_theme()->get('Name') . "\n";
echo "Template: " . get_template() . "\n";
echo "Stylesheet: " . get_stylesheet() . "\n";

// Check DirectoryIndex or .htaccess
if (file_exists(__DIR__ . '/.htaccess')) {
    echo "\n--- .htaccess ---\n";
    echo file_get_contents(__DIR__ . '/.htaccess');
}
