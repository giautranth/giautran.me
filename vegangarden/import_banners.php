<?php
/**
 * Setup Initial Banners in WordPress Custom Post Type 'vg_banner'
 */

define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

if (!current_user_can('manage_options') && php_sapi_name() !== 'cli') {
    if (!isset($_GET['token']) || $_GET['token'] !== 'vg_banner_init_2026') {
        die('Unauthorized');
    }
}

header('Content-Type: text/plain; charset=utf-8');
global $wpdb;

echo "=== INITIALIZING VEGAN GARDEN BANNERS ===\n";

$existing_banners = get_posts(array(
    'post_type'      => 'vg_banner',
    'posts_per_page' => -1,
    'post_status'    => 'any'
));

echo "Existing vg_banner count: " . count($existing_banners) . "\n";

// Helper function to find attachment ID by filename
function vg_find_attachment_by_filename($filename) {
    global $wpdb;
    $id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
        '%' . $wpdb->esc_like($filename) . '%'
    ));
    if (!$id) {
        $id = $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_title = %s LIMIT 1",
            pathinfo($filename, PATHINFO_FILENAME)
        ));
    }
    return $id ? (int)$id : 0;
}

$banners_data = array(
    array(
        'title'      => 'Vegan Garden Berlin - Sommergarten & Restaurant',
        'file'       => 'banner_4.jpeg',
        'order'      => 0,
        'link'       => '#speisekarte',
    ),
    array(
        'title'      => '100 % Vegane Vietnamesische Küche',
        'file'       => 'hero_banner_2.jpg',
        'order'      => 1,
        'link'       => '#speisekarte',
    ),
    array(
        'title'      => 'Ein Ort zum Genießen - Entspannte Gartenatmosphäre',
        'file'       => 'hero_banner_3.jpg',
        'order'      => 2,
        'link'       => home_url('/about/'),
    ),
    array(
        'title'      => 'Events, Feiern & Besondere Momente im Grünen',
        'file'       => 'hero_banner_4.jpg',
        'order'      => 3,
        'link'       => home_url('/kontakt/'),
    ),
);

$created = 0;

foreach ($banners_data as $b) {
    // Check if a banner with this title already exists
    $existing = get_page_by_title($b['title'], OBJECT, 'vg_banner');
    if ($existing) {
        echo "Banner already exists: '{$b['title']}' (ID: {$existing->ID})\n";
        continue;
    }

    $attach_id = vg_find_attachment_by_filename($b['file']);
    $img_url = $attach_id ? wp_get_attachment_url($attach_id) : home_url('/images/' . $b['file']);

    $post_id = wp_insert_post(array(
        'post_title'   => $b['title'],
        'post_type'    => 'vg_banner',
        'post_status'  => 'publish',
        'menu_order'   => $b['order'],
    ));

    if (!is_wp_error($post_id)) {
        if ($attach_id) {
            set_post_thumbnail($post_id, $attach_id);
        }
        update_post_meta($post_id, '_banner_active', '1');
        update_post_meta($post_id, '_banner_order', $b['order']);
        update_post_meta($post_id, '_banner_mobile_img', $img_url);
        update_post_meta($post_id, '_banner_link', $b['link']);

        $created++;
        echo "CREATED Banner '{$b['title']}' (ID: $post_id) with Attach ID: $attach_id\n";
    } else {
        echo "Error creating banner: " . $post_id->get_error_message() . "\n";
    }
}

echo "\n--- SUMMARY ---\n";
echo "Total banners created: $created\n";
$total_now = count(get_posts(array('post_type' => 'vg_banner', 'posts_per_page' => -1)));
echo "Total vg_banner now in system: $total_now\n";
