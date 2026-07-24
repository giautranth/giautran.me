<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}

require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "=== DIAGNOSING LICH-HEN POST TYPE ===\n";

// 1. Check if post type exists
$post_types = get_post_types();
if ( in_array('lich-hen', $post_types) ) {
    echo "Post type 'lich-hen' exists.\n";
    $pt_object = get_post_type_object('lich-hen');
    echo "Label: " . $pt_object->label . "\n";
} else {
    echo "Post type 'lich-hen' NOT found in registered post types!\n";
}

// 2. Fetch the latest 3 posts of type 'lich-hen'
$args = array(
    'post_type' => 'lich-hen',
    'posts_per_page' => 3,
    'post_status' => 'any'
);
$query = new WP_Query($args);

if ( $query->have_posts() ) {
    echo "Found " . $query->post_count . " posts of type 'lich-hen'.\n";
    while ( $query->have_posts() ) {
        $query->the_row(); // Wait, in WP Query it's the_post()
    }
    // Let's reset loop
    $posts = $query->get_posts();
    foreach ($posts as $p) {
        echo "\n--- Post ID: {$p->ID} ---\n";
        echo "Title: {$p->post_title}\n";
        echo "Date: {$p->post_date}\n";
        echo "Status: {$p->post_status}\n";
        
        // Get all post meta
        $meta = get_post_meta($p->ID);
        echo "Meta keys & values:\n";
        foreach ($meta as $key => $values) {
            // Ignore internal WP keys unless they are important
            if (strpos($key, '_') === 0 && !in_array($key, array('_wp_page_template'))) {
                // If it's ACF field reference or similar, we can print it
                if (strpos($key, '_edit_') === 0 || strpos($key, '_wp_') === 0) {
                    continue;
                }
            }
            echo "  {$key}: " . implode(', ', $values) . "\n";
        }
    }
} else {
    echo "No posts found for post type 'lich-hen'.\n";
}

wp_reset_postdata();
?>
