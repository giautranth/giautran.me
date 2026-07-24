<?php
// Hàm sử dụng template archive cho trang tìm kiếm
function use_archive_template_for_search($template)
{
    // Kiểm tra nếu là trang tìm kiếm
    if (is_search()) {
        // Lấy giá trị post_type từ URL
        $post_type = get_query_var('post_type');

        // Kiểm tra nếu post_type là 'bac-si'
        if ($post_type === 'bac-si') {
            $archive_template = locate_template('archive-bac-si.php');
            if ($archive_template) {
                return $archive_template;
            }
        }

        // Kiểm tra nếu post_type là 'chuyen-khoa'
        if ($post_type === 'chuyen-khoa') {
            $archive_template = locate_template('archive-chuyen-khoa.php');
            if ($archive_template) {
                return $archive_template;
            }
        }
    }

    // Trả về template mặc định nếu không thỏa mãn điều kiện trên
    return $template;
}
add_filter('template_include', 'use_archive_template_for_search');

// Thêm post type 'chuyen-khoa' vào UX Builder
add_action('init', function () {
    if (function_exists('add_ux_builder_post_type')) {
        add_ux_builder_post_type('chuyen-khoa');
    }
});

// Hàm xử lý khi form được submit qua AJAX
function ajax_form_lich_hen()
{
    // Kiểm tra nonce bảo mật
    check_ajax_referer('ajax_form_nonce', 'security');

    // Lấy dữ liệu từ form và lọc dữ liệu
    $name             = sanitize_text_field($_POST['name']);
    $email            = sanitize_email($_POST['email']);
    $phone            = sanitize_text_field($_POST['phone']);
    $address          = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
    $birthdate        = sanitize_text_field($_POST['birthdate']);
    $gender           = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';
    $chuyen_khoa      = intval($_POST['chuyen_khoa']);
    $bac_si           = intval($_POST['bac_si']);
    $trieu_chung      = sanitize_text_field($_POST['trieu_chung']);
    $appointment_date = sanitize_text_field($_POST['appointment_date']);
    $time             = sanitize_text_field($_POST['time']);

    // Lấy dữ liệu UTM tracking
    $landing_page     = isset($_POST['landing_page']) ? sanitize_text_field($_POST['landing_page']) : '';
    $utm_source       = isset($_POST['utm_source']) ? sanitize_text_field($_POST['utm_source']) : '';
    $utm_medium       = isset($_POST['utm_medium']) ? sanitize_text_field($_POST['utm_medium']) : '';
    $utm_campaign     = isset($_POST['utm_campaign']) ? sanitize_text_field($_POST['utm_campaign']) : '';

    // Tạo bài viết mới trong CPT "lich-hen"
    $post_data = array(
        'post_title'  => $name,       // Sử dụng tên bệnh nhân làm tiêu đề
        'post_status' => 'publish',   // Trạng thái bài viết là xuất bản
        'post_type'   => 'lich-hen',  // CPT là "lich-hen"
    );

    // Chèn bài viết mới và lấy ID của bài viết
    $post_id = wp_insert_post($post_data);

    // Kiểm tra xem bài viết có được tạo thành công hay không
    if ($post_id) {
        // Lưu các trường tùy chỉnh bằng ACF
        update_field('thong_tin_benh_nhan_name', $name, $post_id);
        update_field('thong_tin_benh_nhan_email', $email, $post_id);
        update_field('thong_tin_benh_nhan_phone', $phone, $post_id);
        update_field('thong_tin_benh_nhan_address', $address, $post_id);
        update_field('thong_tin_benh_nhan_birthdate', $birthdate, $post_id);
        update_field('thong_tin_benh_nhan_gender', $gender, $post_id);
        update_field('chon_chuyen_khoa_chuyen_khoa', $chuyen_khoa, $post_id);  // Lưu Post Object
        update_field('chon_chuyen_khoa_bac_si', $bac_si, $post_id);            // Lưu Post Object
        update_field('chon_chuyen_khoa_trieu_chung', $trieu_chung, $post_id);
        update_field('ngay_va_gio_thich_hop_appointment_date', $appointment_date, $post_id);
        update_field('ngay_va_gio_thich_hop_time', $time, $post_id);

        // Lưu UTM tracking vào post meta
        update_post_meta($post_id, '_utm_landing_page', $landing_page);
        update_post_meta($post_id, '_utm_source', $utm_source);
        update_post_meta($post_id, '_utm_medium', $utm_medium);
        update_post_meta($post_id, '_utm_campaign', $utm_campaign);

        // Gửi email thông báo cho admin (chạy ngầm để không làm chậm form)
        wp_schedule_single_event(time() + 5, 'cih_send_booking_email', array($post_id));

        wp_send_json_success('Lịch hẹn đã được tạo thành công!');
    } else {
        wp_send_json_error('Đã xảy ra lỗi khi tạo lịch hẹn.');
    }

    wp_die();  // Kết thúc hàm AJAX
}

// Đăng ký action AJAX
add_action('wp_ajax_submit_lich_hen', 'ajax_form_lich_hen');
add_action('wp_ajax_nopriv_submit_lich_hen', 'ajax_form_lich_hen');

// ===== GỬI EMAIL THÔNG BÁO LỊCH HẸN (CHẠY NGẦM) =====
add_action('cih_send_booking_email', 'cih_send_booking_email_handler');
function cih_send_booking_email_handler($post_id) {
    $name             = get_post_meta($post_id, 'thong_tin_benh_nhan_name', true);
    $email            = get_post_meta($post_id, 'thong_tin_benh_nhan_email', true);
    $phone            = get_post_meta($post_id, 'thong_tin_benh_nhan_phone', true);
    $birthdate        = get_post_meta($post_id, 'thong_tin_benh_nhan_birthdate', true);
    $appointment_date = get_post_meta($post_id, 'ngay_va_gio_thich_hop_appointment_date', true);
    $time             = get_post_meta($post_id, 'ngay_va_gio_thich_hop_time', true);
    $trieu_chung      = get_post_meta($post_id, 'chon_chuyen_khoa_trieu_chung', true);

    $bac_si_id        = get_post_meta($post_id, 'chon_chuyen_khoa_bac_si', true);
    $chuyen_khoa_id   = get_post_meta($post_id, 'chon_chuyen_khoa_chuyen_khoa', true);
    $bac_si_name      = $bac_si_id ? get_the_title($bac_si_id) : '';
    $chuyen_khoa_name = $chuyen_khoa_id ? get_the_title($chuyen_khoa_id) : '';

    $admin_email = 'booking@cih.com.vn';
    $subject = 'Thông báo lịch hẹn mới từ phòng khám';
    $message = '
        <p>Chào admin,</p>
        <p>Có một lịch hẹn mới vừa được tạo với thông tin sau:</p>
        <ul>
            <li><strong>Họ và tên:</strong> ' . esc_html($name) . '</li>
            <li><strong>Email:</strong> ' . esc_html($email) . '</li>
            <li><strong>Số điện thoại:</strong> ' . esc_html($phone) . '</li>
            <li><strong>Ngày sinh:</strong> ' . esc_html($birthdate) . '</li>
            <li><strong>Ngày hẹn:</strong> ' . esc_html($appointment_date) . '</li>
            <li><strong>Giờ hẹn:</strong> ' . esc_html($time) . '</li>
            <li><strong>Bác sĩ:</strong> ' . esc_html($bac_si_name) . '</li>
            <li><strong>Chuyên khoa:</strong> ' . esc_html($chuyen_khoa_name) . '</li>
            <li><strong>Triệu chứng:</strong> ' . esc_html($trieu_chung) . '</li>
        </ul>
        <p>Vui lòng kiểm tra và xác nhận lịch hẹn.</p>
        <p>Trân trọng,</p>
        <p>Hệ thống đặt lịch hẹn</p>
    ';

    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($admin_email, $subject, $message, $headers);
}

// ===== HIỂN THỊ CỘT UTM TRACKING TRÊN TRANG QUẢN LÝ LỊCH HẸN =====

// Thêm cột UTM vào danh sách cột admin (priority 999 để chạy sau Admin Columns Pro)
add_filter('manage_lich-hen_posts_columns', 'cih_lich_hen_add_utm_columns', 999);
add_filter('manage_edit-lich-hen_columns', 'cih_lich_hen_add_utm_columns', 999);
function cih_lich_hen_add_utm_columns($columns) {
    $columns['utm_landing_page'] = 'Trang đến';
    $columns['utm_source']       = 'UTM Source';
    $columns['utm_medium']       = 'UTM Medium';
    $columns['utm_campaign']     = 'UTM Campaign';
    return $columns;
}

// Hiển thị dữ liệu cho các cột UTM
add_action('manage_lich-hen_posts_custom_column', 'cih_lich_hen_render_utm_columns', 10, 2);
function cih_lich_hen_render_utm_columns($column, $post_id) {
    switch ($column) {
        case 'utm_landing_page':
            echo esc_html(get_post_meta($post_id, '_utm_landing_page', true));
            break;
        case 'utm_source':
            echo esc_html(get_post_meta($post_id, '_utm_source', true));
            break;
        case 'utm_medium':
            echo esc_html(get_post_meta($post_id, '_utm_medium', true));
            break;
        case 'utm_campaign':
            echo esc_html(get_post_meta($post_id, '_utm_campaign', true));
            break;
    }
}
