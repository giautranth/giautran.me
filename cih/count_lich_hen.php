<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}

require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "=== COUNTING ALL LICH-HEN POSTS ===\n";

global $wpdb;

// Đếm trực tiếp trong DB để tránh bộ lọc ngôn ngữ của WPML/Polylang
$results = $wpdb->get_results("
    SELECT post_status, COUNT(*) as count 
    FROM $wpdb->posts 
    WHERE post_type = 'lich-hen' 
    GROUP BY post_status
");

$total = 0;
foreach ($results as $row) {
    echo "Status: {$row->post_status} - Count: {$row->count}\n";
    $total += $row->count;
}
echo "Total posts in DB: {$total}\n\n";

// Lấy 5 bài viết mới nhất để xem thông tin
$latest = $wpdb->get_results("
    SELECT ID, post_title, post_date, post_status 
    FROM $wpdb->posts 
    WHERE post_type = 'lich-hen' 
    ORDER BY ID DESC 
    LIMIT 5
");

echo "Latest 5 posts:\n";
foreach ($latest as $p) {
    $synced = get_post_meta($p->ID, '_google_sheets_synced', true);
    echo "  - ID: {$p->ID}, Title: '{$p->post_title}', Date: {$p->post_date}, Status: {$p->post_status}, Synced: " . ($synced ? "YES" : "NO") . "\n";
}
?>
