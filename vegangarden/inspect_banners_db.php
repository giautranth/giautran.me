<?php
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

header('Content-Type: text/plain; charset=utf-8');
global $wpdb;

$posts = $wpdb->get_results("SELECT ID, post_title, post_status, post_type FROM $wpdb->posts WHERE post_type = 'vg_banner'");
echo "All vg_banner rows in posts table:\n";
foreach ($posts as $p) {
    echo "ID: {$p->ID} | Status: {$p->post_status} | Title: {$p->post_title}\n";
}
