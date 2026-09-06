<?php
require_once(__DIR__ . '/wp-load.php');
$front_id = get_option('page_on_front');
echo 'Front Page ID: ' . $front_id . PHP_EOL;
echo 'Featured Image ID: ' . get_post_thumbnail_id($front_id) . PHP_EOL;
echo 'Rank Math Facebook Image: ' . get_post_meta($front_id, 'rank_math_facebook_image', true) . PHP_EOL;
