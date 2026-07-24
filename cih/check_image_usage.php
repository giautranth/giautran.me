<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}

require_once( dirname( __FILE__ ) . '/wp-load.php' );
global $wpdb;

$image_url = 'dsadsad'; // Tìm theo tên file gốc
$full_url = 'cih.com.vn/wp-content/uploads/2024/10/dsadsad';

echo "=== TÌM ẢNH: dsadsad ===\n\n";

// 1. Tìm trong Media Library (attachment)
echo "--- 1. MEDIA LIBRARY (attachments) ---\n";
$attachments = $wpdb->get_results(
    $wpdb->prepare("SELECT ID, post_title, post_name, guid FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s", '%' . $image_url . '%')
);
if ($attachments) {
    foreach ($attachments as $att) {
        echo "  ID: {$att->ID} | Title: {$att->post_title} | GUID: {$att->guid}\n";
        // Tìm post nào dùng attachment này làm Featured Image
        $used_as_thumb = $wpdb->get_results(
            $wpdb->prepare("SELECT post_id, meta_key FROM {$wpdb->postmeta} WHERE meta_value = %s AND meta_key = '_thumbnail_id'", $att->ID)
        );
        if ($used_as_thumb) {
            foreach ($used_as_thumb as $thumb) {
                $post_title = get_the_title($thumb->post_id);
                $post_type = get_post_type($thumb->post_id);
                $edit_link = admin_url("post.php?post={$thumb->post_id}&action=edit");
                echo "    → Dùng làm Featured Image cho: [{$post_type}] \"{$post_title}\" (ID: {$thumb->post_id})\n";
                echo "      Edit: {$edit_link}\n";
            }
        }
    }
} else {
    echo "  Không tìm thấy trong Media Library.\n";
}

// 2. Tìm trong nội dung bài viết (post_content)
echo "\n--- 2. NỘI DUNG BÀI VIẾT (post_content) ---\n";
$in_content = $wpdb->get_results(
    $wpdb->prepare("SELECT ID, post_title, post_type FROM {$wpdb->posts} WHERE post_content LIKE %s AND post_status IN ('publish','draft','private') LIMIT 20", '%' . $image_url . '%')
);
if ($in_content) {
    foreach ($in_content as $p) {
        echo "  [{$p->post_type}] \"{$p->post_title}\" (ID: {$p->ID})\n";
    }
} else {
    echo "  Không tìm thấy trong nội dung bài viết.\n";
}

// 3. Tìm trong postmeta (ACF fields, custom fields)
echo "\n--- 3. CUSTOM FIELDS / ACF (postmeta) ---\n";
$in_meta = $wpdb->get_results(
    $wpdb->prepare("SELECT pm.post_id, pm.meta_key, pm.meta_value, p.post_title, p.post_type FROM {$wpdb->postmeta} pm JOIN {$wpdb->posts} p ON pm.post_id = p.ID WHERE pm.meta_value LIKE %s LIMIT 20", '%' . $image_url . '%')
);
if ($in_meta) {
    foreach ($in_meta as $m) {
        echo "  [{$m->post_type}] \"{$m->post_title}\" (ID: {$m->post_id}) | meta_key: {$m->meta_key}\n";
    }
} else {
    echo "  Không tìm thấy trong custom fields.\n";
}

// 4. Tìm trong options (widgets, theme settings)
echo "\n--- 4. OPTIONS (widgets, theme settings) ---\n";
$in_options = $wpdb->get_results(
    $wpdb->prepare("SELECT option_name, LEFT(option_value, 300) as option_value FROM {$wpdb->options} WHERE option_value LIKE %s LIMIT 10", '%' . $image_url . '%')
);
if ($in_options) {
    foreach ($in_options as $opt) {
        echo "  option_name: {$opt->option_name}\n";
        echo "  value (truncated): {$opt->option_value}\n\n";
    }
} else {
    echo "  Không tìm thấy trong options.\n";
}

?>
