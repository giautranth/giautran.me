<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

if (!isset($_GET['token']) || $_GET['token'] !== 'vg_banner_sync_2026') {
    die('Unauthorized');
}

header('Content-Type: text/plain; charset=utf-8');
echo "=== SYNCING BANNER DESKTOP & MOBILE META ===\n";

$banners = get_posts(array(
    'post_type'      => 'vg_banner',
    'posts_per_page' => -1,
    'post_status'    => 'any'
));

echo "Found " . count($banners) . " banners.\n";

foreach ($banners as $b) {
    $thumb_id = get_post_thumbnail_id($b->ID);
    $thumb_url = get_the_post_thumbnail_url($b->ID, 'full');
    
    $desk_img = get_post_meta($b->ID, '_banner_desktop_img', true);
    $desk_id  = get_post_meta($b->ID, '_banner_desktop_id', true);
    $mob_img  = get_post_meta($b->ID, '_banner_mobile_img', true);
    
    if (empty($desk_img) && $thumb_url) {
        update_post_meta($b->ID, '_banner_desktop_img', $thumb_url);
        update_post_meta($b->ID, '_banner_desktop_id', $thumb_id);
        $desk_img = $thumb_url;
    }
    
    echo "Banner #{$b->ID} '{$b->post_title}':\n";
    echo "  - Desktop: {$desk_img}\n";
    echo "  - Mobile:  {$mob_img}\n";
}

echo "=== SYNC COMPLETE ===\n";
