<?php
/**
 * Import images from /images/ and /logo/ into WordPress Media Library
 */

define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

if (!current_user_can('manage_options') && php_sapi_name() !== 'cli') {
    // Check security key if called via web
    if (!isset($_GET['token']) || $_GET['token'] !== 'vg_media_import_2026') {
        die('Unauthorized');
    }
}

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

header('Content-Type: text/plain; charset=utf-8');

global $wpdb;

$upload_dir = wp_upload_dir();
$upload_path = $upload_dir['path'];
$upload_url  = $upload_dir['url'];

if (!file_exists($upload_path)) {
    wp_mkdir_p($upload_path);
}

echo "=== STARTING WORDPRESS MEDIA IMPORT ===\n";
echo "Upload Target: $upload_path\n";
echo "Upload URL: $upload_url\n\n";

$sources = array(
    ABSPATH . 'images',
    ABSPATH . 'images/gallery',
    ABSPATH . 'logo'
);

$imported_count = 0;
$skipped_count  = 0;
$attachment_map = array(); // filename => attach_id

foreach ($sources as $src_dir) {
    if (!is_dir($src_dir)) continue;

    $files = scandir($src_dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, array('jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'))) continue;

        $source_file = $src_dir . '/' . $file;
        if (!is_file($source_file)) continue;

        // Check if already in database
        $existing_id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND (post_title = %s OR guid LIKE %s)",
            pathinfo($file, PATHINFO_FILENAME),
            '%' . $wpdb->esc_like($file) . '%'
        ));

        if ($existing_id) {
            $skipped_count++;
            $attachment_map[$file] = (int)$existing_id;
            echo "Skipped (already in Media): $file (ID: $existing_id)\n";
            continue;
        }

        // Copy file to wp-content/uploads/
        $dest_file = $upload_path . '/' . $file;
        if (!copy($source_file, $dest_file)) {
            echo "Error copying: $file\n";
            continue;
        }

        $filetype = wp_check_filetype($file, null);
        $title = preg_replace('/\.[^.]+$/', '', $file);
        $title = ucwords(str_replace(array('_', '-'), ' ', $title));

        $attachment = array(
            'guid'           => $upload_url . '/' . $file,
            'post_mime_type' => $filetype['type'],
            'post_title'     => $title,
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $dest_file);
        if (!is_wp_error($attach_id)) {
            $attach_data = wp_generate_attachment_metadata($attach_id, $dest_file);
            wp_update_attachment_metadata($attach_id, $attach_data);
            $imported_count++;
            $attachment_map[$file] = $attach_id;
            echo "IMPORTED: $file -> Attachment ID $attach_id\n";
        } else {
            echo "Error inserting attachment: $file\n";
        }
    }
}

echo "\n--- SUMMARY ---\n";
echo "Total newly imported: $imported_count\n";
echo "Total previously present: $skipped_count\n";

// Connect to CPTs
echo "\n--- CONNECTING FEATURED IMAGES TO CPTs ---\n";

// 1. Dishes (Speisekarte)
$dishes = get_posts(array('post_type' => 'vg_dish', 'posts_per_page' => -1));
$dish_updated = 0;
foreach ($dishes as $dish) {
    $custom_img = get_post_meta($dish->ID, '_dish_custom_img', true);
    if ($custom_img) {
        $base = basename(parse_url($custom_img, PHP_URL_PATH));
        if (isset($attachment_map[$base])) {
            set_post_thumbnail($dish->ID, $attachment_map[$base]);
            $dish_updated++;
            echo "Set thumbnail for Dish '{$dish->post_title}': Attachment ID {$attachment_map[$base]}\n";
        }
    }
}
echo "Dishes updated with Featured Image: $dish_updated\n";

// 2. Gallery (vg_gallery)
$gallery_items = get_posts(array('post_type' => 'vg_gallery', 'posts_per_page' => -1));
$gallery_updated = 0;
foreach ($gallery_items as $item) {
    $custom_img = get_post_meta($item->ID, '_gallery_custom_img', true);
    if ($custom_img) {
        $base = basename(parse_url($custom_img, PHP_URL_PATH));
        if (isset($attachment_map[$base])) {
            set_post_thumbnail($item->ID, $attachment_map[$base]);
            $gallery_updated++;
            echo "Set thumbnail for Gallery '{$item->post_title}': Attachment ID {$attachment_map[$base]}\n";
        }
    }
}
echo "Gallery items updated with Featured Image: $gallery_updated\n";

// 3. Articles (Posts)
$posts = get_posts(array('post_type' => 'post', 'posts_per_page' => -1));
$posts_updated = 0;
foreach ($posts as $p) {
    if (!has_post_thumbnail($p->ID)) {
        // Try match post slug with article image
        $slug = $p->post_name;
        // Find best match in attachment_map
        foreach ($attachment_map as $fname => $aid) {
            if (strpos($fname, 'article_') === 0) {
                $clean_fname = str_replace(array('article_', '.jpg', '.png'), '', $fname);
                if (strpos($slug, $clean_fname) !== false || strpos($clean_fname, $slug) !== false) {
                    set_post_thumbnail($p->ID, $aid);
                    $posts_updated++;
                    echo "Set thumbnail for Post '{$p->post_title}': Attachment ID $aid\n";
                    break;
                }
            }
        }
    }
}
echo "Posts updated with Featured Image: $posts_updated\n";

echo "\n=== IMPORT COMPLETED SUCCESSFULLY ===\n";
