<?php
/**
 * Tự động đồng bộ dữ liệu Lịch Hẹn (post type: lich-hen) sang Google Sheets
 */

// 1. Đồng bộ sau khi ACF lưu toàn bộ các trường (Dành cho việc đặt hẹn qua Form AJAX sử dụng update_field)
add_action('acf/save_post', 'cih_sync_lich_hen_acf_trigger', 20);
function cih_sync_lich_hen_acf_trigger($post_id)
{
    // Chỉ chạy cho post type lich-hen
    if (get_post_type($post_id) !== 'lich-hen') {
        return;
    }
    cih_sync_lich_hen_to_google_sheet_action($post_id);
}

// 2. Đồng bộ khi lưu bài viết thông thường (Dự phòng cho admin hoặc cách lưu khác)
add_action('save_post_lich-hen', 'cih_sync_lich_hen_save_post_trigger', 99, 3);
function cih_sync_lich_hen_save_post_trigger($post_id, $post, $update)
{
    // Bỏ qua autosave, revision
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Chỉ chạy khi trạng thái là publish
    if ($post->post_status !== 'publish') {
        return;
    }

    cih_sync_lich_hen_to_google_sheet_action($post_id);
}

// 3. Đồng bộ khi các trường dữ liệu meta ACF được lưu thủ công từ AJAX (ACF không tự trigger acf/save_post khi gọi update_field thủ công)
add_action('added_post_meta', 'cih_sync_lich_hen_meta_trigger', 10, 4);
add_action('updated_post_meta', 'cih_sync_lich_hen_meta_trigger', 10, 4);
function cih_sync_lich_hen_meta_trigger($meta_id, $post_id, $meta_key, $meta_value)
{
    // Chỉ kích hoạt khi cập nhật trường cuối cùng trong form đặt hẹn (ngay_va_gio_thich_hop_time)
    if ($meta_key === 'ngay_va_gio_thich_hop_time' && get_post_type($post_id) === 'lich-hen') {
        cih_sync_lich_hen_to_google_sheet_action($post_id);
    }
}

// 3. Hàm xử lý đồng bộ chính
function cih_sync_lich_hen_to_google_sheet_action($post_id)
{
    // Tránh việc gửi trùng lặp nếu đã đồng bộ thành công trước đó
    if (get_post_meta($post_id, '_google_sheets_synced', true)) {
        return;
    }

    // CẤU HÌNH URL WEB APP GOOGLE SHEETS
    $web_app_url = 'https://script.google.com/macros/s/AKfycbwhg4yW0lSFDe9qizEYIipOkYFOH2CoEA9Qby3jHkXZpGPDzpkw7B0Vd8cfHfpf64vj/exec';

    // Nếu chưa cấu hình URL thì dừng lại
    if (empty($web_app_url) || $web_app_url === 'YOUR_GOOGLE_WEB_APP_URL_HERE') {
        return;
    }

    // Lấy Số điện thoại (là trường bắt buộc của lịch hẹn, nếu rỗng tức là ACF chưa lưu xong, ta sẽ chờ chạy ở hook acf/save_post tiếp theo)
    $phone = get_post_meta($post_id, 'customer_phone', true);
    if (empty($phone)) {
        $phone = get_post_meta($post_id, 'thong_tin_benh_nhan_phone', true);
    }
    
    // Nếu cả số điện thoại và tên bệnh nhân đều trống, dừng lại chờ lần lưu sau
    $name = get_post_meta($post_id, 'customer_name', true);
    if (empty($name)) {
        $name = get_post_meta($post_id, 'thong_tin_benh_nhan_name', true);
    }
    
    if (empty($phone) && empty($name)) {
        return;
    }

    if (empty($name)) {
        $name = get_the_title($post_id);
    }

    // Lấy Email
    $email = get_post_meta($post_id, 'customer_email', true);
    if (empty($email)) {
        $email = get_post_meta($post_id, 'thong_tin_benh_nhan_email', true);
    }

    // Lấy Ngày sinh & Giới tính
    $birthdate = get_post_meta($post_id, 'thong_tin_benh_nhan_birthdate', true);
    $gender    = get_post_meta($post_id, 'thong_tin_benh_nhan_gender', true);

    // Lấy Địa chỉ
    $address   = get_post_meta($post_id, 'thong_tin_benh_nhan_address', true);

    // Lấy Ngày hẹn & Giờ hẹn
    $booking_date = get_post_meta($post_id, 'booking_date', true);
    if (empty($booking_date)) {
        $booking_date = get_post_meta($post_id, 'ngay_va_gio_thich_hop_appointment_date', true);
    }

    $booking_time = get_post_meta($post_id, 'booking_time', true);
    if (empty($booking_time)) {
        $booking_time = get_post_meta($post_id, 'ngay_va_gio_thich_hop_time', true);
    }

    // Lấy Chuyên khoa
    $department = get_post_meta($post_id, 'department', true);
    if (empty($department)) {
        $chuyen_khoa_id = get_post_meta($post_id, 'chon_chuyen_khoa_chuyen_khoa', true);
        if ($chuyen_khoa_id) {
            $department = get_the_title($chuyen_khoa_id);
        }
    }

    // Lấy Bác sĩ
    $doctor = get_post_meta($post_id, 'doctor_name', true);
    if (empty($doctor)) {
        $bac_si_id = get_post_meta($post_id, 'chon_chuyen_khoa_bac_si', true);
        if ($bac_si_id) {
            $doctor = get_the_title($bac_si_id);
        }
    }

    // Ghi chú / Triệu chứng
    $note = get_post_meta($post_id, 'note', true);
    if (empty($note)) {
        $note = get_post_meta($post_id, 'chon_chuyen_khoa_trieu_chung', true);
    }

    // Ngày tạo lịch hẹn trên web
    $date_created = get_the_date('Y-m-d H:i:s', $post_id);

    // UTM Tracking
    $landing_page = get_post_meta($post_id, '_utm_landing_page', true);
    $utm_source   = get_post_meta($post_id, '_utm_source', true);
    $utm_medium   = get_post_meta($post_id, '_utm_medium', true);
    $utm_campaign = get_post_meta($post_id, '_utm_campaign', true);

    // Chuẩn bị mảng dữ liệu gửi đi
    $payload = array(
        'post_id'        => $post_id,
        'date_created'   => $date_created,
        'customer_name'  => $name,
        'customer_phone' => $phone,
        'customer_email' => $email,
        'birthdate'      => $birthdate,
        'gender'         => $gender,
        'address'        => $address,
        'booking_date'   => $booking_date,
        'booking_time'   => $booking_time,
        'department'     => $department,
        'doctor_name'    => $doctor,
        'note'           => $note,
        'landing_page'   => $landing_page,
        'utm_source'     => $utm_source,
        'utm_medium'     => $utm_medium,
        'utm_campaign'   => $utm_campaign
    );

    // Gửi request POST không chờ phản hồi (non-blocking) để không làm chậm trải nghiệm người dùng
    // Google Apps Script đã có cơ chế chống trùng ID nên dữ liệu luôn an toàn
    $response = wp_remote_post($web_app_url, array(
        'method'      => 'POST',
        'timeout'     => 5,
        'redirection' => 5,
        'blocking'    => false,
        'headers'     => array(
            'Content-Type' => 'application/json'
        ),
        'body'        => json_encode($payload)
    ));

    // Đánh dấu đã gửi đồng bộ (request đã được gửi đi, không cần chờ phản hồi)
    update_post_meta($post_id, '_google_sheets_synced', true);
}

// ===== TỰ ĐỘNG XOÁ DÒNG TRÊN GOOGLE SHEET KHI XOÁ LỊCH HẸN =====

// Khi bỏ vào Thùng rác
add_action('wp_trash_post', 'cih_delete_lich_hen_from_google_sheet');
// Khi xoá vĩnh viễn
add_action('before_delete_post', 'cih_delete_lich_hen_from_google_sheet');

function cih_delete_lich_hen_from_google_sheet($post_id) {
    // Chỉ xử lý cho post type lich-hen
    if (get_post_type($post_id) !== 'lich-hen') {
        return;
    }

    $web_app_url = 'https://script.google.com/macros/s/AKfycbwhg4yW0lSFDe9qizEYIipOkYFOH2CoEA9Qby3jHkXZpGPDzpkw7B0Vd8cfHfpf64vj/exec';

    // Gửi request xoá (non-blocking)
    wp_remote_post($web_app_url, array(
        'method'      => 'POST',
        'timeout'     => 5,
        'redirection' => 5,
        'blocking'    => false,
        'headers'     => array(
            'Content-Type' => 'application/json'
        ),
        'body'        => json_encode(array(
            'action'  => 'delete',
            'post_id' => $post_id
        ))
    ));
}
