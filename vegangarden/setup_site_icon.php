<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

header('Content-Type: text/plain; charset=utf-8');
echo "=== SETTING UP WORDPRESS SITE ICON ===\n";

global $wpdb;

// 1. Check if favicon-512x512 already in attachments
$attach_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE '%favicon-512x512%' LIMIT 1");

if (!$attach_id) {
    echo "Uploading favicon-512x512.png to Media Library...\n";
    $favicon_path = ABSPATH . 'favicon-512x512.png';
    if (!file_exists($favicon_path)) {
        die("Error: favicon-512x512.png not found at $favicon_path\n");
    }
    
    // Copy to uploads
    $upload_dir = wp_upload_dir();
    $target_file = $upload_dir['path'] . '/favicon-512x512.png';
    copy($favicon_path, $target_file);
    
    $filetype = wp_check_filetype(basename($target_file), null);
    $attachment = array(
        'guid'           => $upload_dir['url'] . '/' . basename($target_file),
        'post_mime_type' => $filetype['type'],
        'post_title'     => 'Vegan Garden Site Icon',
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    
    $attach_id = wp_insert_attachment($attachment, $target_file);
    $attach_data = wp_generate_attachment_metadata($attach_id, $target_file);
    wp_update_attachment_metadata($attach_id, $attach_data);
    echo "Created attachment ID: $attach_id\n";
} else {
    echo "Found existing attachment ID: $attach_id\n";
}

// Update site_icon option
update_option('site_icon', $attach_id);
echo "Updated site_icon option to attachment ID: $attach_id\n";

// Verify
$current_icon = get_option('site_icon');
echo "Verification: get_option('site_icon') = $current_icon\n";
echo "Attachment URL: " . wp_get_attachment_url($current_icon) . "\n";
echo "=== COMPLETE ===\n";
