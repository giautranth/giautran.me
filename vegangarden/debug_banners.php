<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

header('Content-Type: text/plain; charset=utf-8');

$all = get_posts(array('post_type' => 'vg_banner', 'posts_per_page' => -1, 'post_status' => 'any'));
echo "Total vg_banner posts: " . count($all) . "\n";
foreach ($all as $p) {
    $thumb = get_the_post_thumbnail_url($p->ID, 'full');
    $active = get_post_meta($p->ID, '_banner_active', true);
    $order = get_post_meta($p->ID, '_banner_order', true);
    echo "ID: {$p->ID} | Title: {$p->post_title} | Status: {$p->post_status} | ActiveMeta: {$active} | Order: {$order} | Thumb: {$thumb}\n";
}

echo "\nCalling vg_get_banners():\n";
$banners = vg_get_banners();
print_r($banners);
