<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}
set_time_limit(120);
require_once( dirname( __FILE__ ) . '/wp-load.php' );
global $wpdb;

$failed_ids = array(24040, 24151, 24224, 24220, 24139, 24599, 25081, 25788, 25898, 25950, 26014, 26450, 29704, 29738, 29805, 29878, 42217, 42622, 42811, 44044, 44261, 45179, 45395, 45774);

echo "=== KIỂM TRA TRẠNG THÁI CÁC ID BỊ LỖI ===\n\n";

foreach ($failed_ids as $id) {
    $post = get_post($id);
    if (!$post) {
        echo "ID {$id}: KHÔNG TỒN TẠI (đã bị xoá vĩnh viễn trước đó)\n";
    } else {
        $name = get_post_meta($id, 'thong_tin_benh_nhan_name', true);
        echo "ID {$id}: post_type={$post->post_type} | status={$post->post_status} | name={$name}\n";
    }
}

// Thử xoá lại những ID còn tồn tại
echo "\n=== THỬ XOÁ LẠI ===\n\n";
$success2 = 0;
foreach ($failed_ids as $id) {
    $post = get_post($id);
    if (!$post) continue;
    if ($post->post_status === 'trash') {
        echo "ID {$id}: Đã ở trong Thùng rác rồi → BỎ QUA\n";
        $success2++;
        continue;
    }
    if ($post->post_type !== 'lich-hen') {
        echo "ID {$id}: Không phải lich-hen (là {$post->post_type}) → BỎ QUA\n";
        continue;
    }
    
    $result = wp_trash_post($id);
    if ($result) {
        $success2++;
        $name = get_post_meta($id, 'thong_tin_benh_nhan_name', true);
        echo "✓ ID {$id} | {$name} → Đã chuyển vào Thùng rác\n";
    } else {
        // Thử force delete
        $result2 = wp_update_post(array('ID' => $id, 'post_status' => 'trash'));
        if ($result2 && !is_wp_error($result2)) {
            $success2++;
            echo "✓ ID {$id} → Force trash thành công\n";
        } else {
            echo "✗ ID {$id} → Vẫn lỗi\n";
        }
    }
}

echo "\nXoá thêm: {$success2} bản ghi\n";
?>
