<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}

require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "=== DIAGNOSING ACF DOCTOR DEPARTMENTS ===\n";

if ( ! function_exists('get_field') ) {
    die("ACF get_field not available.\n");
}

$args = array(
    'post_type' => 'bac-si',
    'posts_per_page' => 20,
    'post_status' => 'publish'
);
$query = new WP_Query($args);
$posts = $query->get_posts();

echo "Found " . count($posts) . " doctors. Checking 'chuyen_khoa' field:\n";
foreach ($posts as $p) {
    // Lấy dữ liệu field 'chuyen_khoa' bằng ACF
    $chuyen_khoa_val = get_field('chuyen_khoa', $p->ID);
    
    echo "  Doctor ID: {$p->ID} - Name: '{$p->post_title}'\n";
    echo "    ACF Value Type: " . gettype($chuyen_khoa_val) . "\n";
    if ( is_object($chuyen_khoa_val) ) {
        echo "    Department: " . $chuyen_khoa_val->post_title . " (ID: " . $chuyen_khoa_val->ID . ")\n";
    } elseif ( is_array($chuyen_khoa_val) ) {
        echo "    Departments (Array):\n";
        foreach ($chuyen_khoa_val as $ck) {
            if ( is_object($ck) ) {
                echo "      - " . $ck->post_title . " (ID: " . $ck->ID . ")\n";
            } else {
                // Có thể là array of IDs
                echo "      - ID/Value: " . print_r($ck, true) . "\n";
            }
        }
    } elseif ( !empty($chuyen_khoa_val) ) {
        // Có thể là post ID trực tiếp
        echo "    Department ID: " . $chuyen_khoa_val . " (Title: " . get_the_title($chuyen_khoa_val) . ")\n";
    } else {
        echo "    Department: (Empty)\n";
    }
}

wp_reset_postdata();
?>
