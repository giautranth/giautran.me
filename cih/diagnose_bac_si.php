<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}

require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "=== DIAGNOSING BAC-SI POST TYPE ===\n";

$args = array(
    'post_type' => 'bac-si',
    'posts_per_page' => 2,
    'post_status' => 'publish'
);
$query = new WP_Query($args);
$posts = $query->get_posts();

foreach ($posts as $p) {
    echo "\n--- Doctor Post ID: {$p->ID} - Name: {$p->post_title} ---\n";
    
    // 1. Get all post meta
    $meta = get_post_meta($p->ID);
    echo "Meta Keys:\n";
    foreach ($meta as $key => $values) {
        if (strpos($key, '_edit_') === 0 || strpos($key, '_wp_') === 0) {
            continue;
        }
        $val_str = implode(', ', $values);
        if (strlen($val_str) > 100) {
            $val_str = substr($val_str, 0, 100) . '...';
        }
        echo "  {$key}: {$val_str}\n";
    }
    
    // 2. Get all taxonomies associated with this post
    $taxonomies = get_post_taxonomies($p->ID);
    echo "Taxonomies:\n";
    foreach ($taxonomies as $tax) {
        $terms = wp_get_post_terms($p->ID, $tax);
        $term_names = array();
        foreach ($terms as $t) {
            $term_names[] = $t->name . " (ID: {$t->term_id}, Slug: {$t->slug})";
        }
        echo "  - {$tax}: " . implode(', ', $term_names) . "\n";
    }
}

wp_reset_postdata();
?>
