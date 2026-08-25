<?php
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'antigravity_check_123' ) {
    die('Unauthorized');
}

require_once( dirname( __FILE__ ) . '/wp-load.php' );
global $wpdb;

echo "=== KIỂM TRA LỊCH HẸN TRÙNG LẶP ===\n";
echo "Tiêu chí: Cùng tên + cùng SĐT + đăng ký cách nhau dưới 10 phút\n\n";

// Lấy toàn bộ lịch hẹn kèm tên và SĐT
$results = $wpdb->get_results("
    SELECT 
        p.ID,
        p.post_date,
        p.post_status,
        pm_name.meta_value as patient_name,
        pm_phone.meta_value as patient_phone,
        pm_email.meta_value as patient_email
    FROM {$wpdb->posts} p
    LEFT JOIN {$wpdb->postmeta} pm_name ON p.ID = pm_name.post_id AND pm_name.meta_key = 'thong_tin_benh_nhan_name'
    LEFT JOIN {$wpdb->postmeta} pm_phone ON p.ID = pm_phone.post_id AND pm_phone.meta_key = 'thong_tin_benh_nhan_phone'
    LEFT JOIN {$wpdb->postmeta} pm_email ON p.ID = pm_email.post_id AND pm_email.meta_key = 'thong_tin_benh_nhan_email'
    WHERE p.post_type = 'lich-hen'
    AND p.post_status IN ('publish', 'draft', 'private')
    ORDER BY pm_name.meta_value, p.post_date
");

// Nhóm theo tên + SĐT
$groups = array();
foreach ($results as $r) {
    $key = mb_strtolower(trim($r->patient_name)) . '|' . trim($r->patient_phone);
    if (!isset($groups[$key])) {
        $groups[$key] = array();
    }
    $groups[$key][] = $r;
}

// Tìm các nhóm có bản ghi cách nhau dưới 10 phút
$duplicate_groups = array();
foreach ($groups as $key => $entries) {
    if (count($entries) < 2) continue;
    
    for ($i = 0; $i < count($entries) - 1; $i++) {
        $time1 = strtotime($entries[$i]->post_date);
        $time2 = strtotime($entries[$i + 1]->post_date);
        $diff_minutes = abs($time2 - $time1) / 60;
        
        if ($diff_minutes <= 10) {
            if (!isset($duplicate_groups[$key])) {
                $duplicate_groups[$key] = array();
            }
            // Thêm cả 2 bản ghi nếu chưa có
            $ids_in_group = array_map(function($e) { return $e->ID; }, $duplicate_groups[$key]);
            if (!in_array($entries[$i]->ID, $ids_in_group)) {
                $duplicate_groups[$key][] = $entries[$i];
            }
            if (!in_array($entries[$i + 1]->ID, $ids_in_group)) {
                $duplicate_groups[$key][] = $entries[$i + 1];
            }
        }
    }
}

echo "Tìm thấy " . count($duplicate_groups) . " nhóm trùng lặp:\n";
echo str_repeat("=", 120) . "\n\n";

$total_duplicates = 0;
$group_num = 0;
foreach ($duplicate_groups as $key => $entries) {
    $group_num++;
    echo "--- Nhóm {$group_num}: " . $entries[0]->patient_name . " | " . $entries[0]->patient_phone . " (" . count($entries) . " lần) ---\n";
    
    foreach ($entries as $e) {
        $total_duplicates++;
        echo "  ID: {$e->ID} | Ngày: {$e->post_date} | Email: {$e->patient_email} | Status: {$e->post_status}\n";
    }
    
    // Tính khoảng cách
    for ($i = 0; $i < count($entries) - 1; $i++) {
        $diff = abs(strtotime($entries[$i + 1]->post_date) - strtotime($entries[$i]->post_date));
        $mins = floor($diff / 60);
        $secs = $diff % 60;
        echo "  ↕ Cách nhau: {$mins} phút {$secs} giây\n";
    }
    echo "\n";
}

echo str_repeat("=", 120) . "\n";
echo "TỔNG KẾT: {$total_duplicates} bản ghi trùng lặp trong " . count($duplicate_groups) . " nhóm\n";
echo "Tổng số lịch hẹn: " . count($results) . "\n";
?>
