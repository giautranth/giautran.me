<?php
/**
 * Module: Quản lý Form - CIH (Bệnh viện Quốc tế City)
 * Tự động tạo menu "Quản lý Form" -> "Tai mũi họng"
 * Tiếp nhận & quản lý Lead từ Landing Page https://cih.com.vn/taimuihong/
 */

if (!defined('ABSPATH')) {
    exit;
}

// ════════════════════════════════════════════════════════════════
// 1. ĐĂNG KÝ POST TYPE "form_tmh" & MENU "QUẢN LÝ FORM"
// ════════════════════════════════════════════════════════════════
add_action('init', 'cih_register_form_manager_cpt');
function cih_register_form_manager_cpt() {
    $labels = array(
        'name'               => 'Quản lý Form',
        'singular_name'      => 'Khách đăng ký Tai mũi họng',
        'menu_name'          => 'Quản lý Form',
        'all_items'          => 'Tai mũi họng',
        'add_new'            => 'Thêm khách hàng',
        'add_new_item'       => 'Thêm khách hàng mới',
        'edit_item'          => 'Chi tiết khách hàng',
        'new_item'           => 'Khách hàng mới',
        'view_item'          => 'Xem khách hàng',
        'search_items'       => 'Tìm kiếm theo tên hoặc SĐT',
        'not_found'          => 'Không có dữ liệu đăng ký nào',
        'not_found_in_trash' => 'Thùng rác trống',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false,        // Không public ra frontend để bảo mật thông tin bệnh nhân
        'publicly_queryable'  => false,
        'show_ui'             => true,         // Hiển thị trong admin dashboard
        'show_in_menu'        => true,         // Hiện trên sidebar menu
        'menu_position'       => 6,            // Nằm ngay bên dưới mục Lịch hẹn
        'menu_icon'           => 'dashicons-clipboard', // Icon bảng biểu kẹp hồ sơ
        'supports'            => array('title'), // Tiêu đề là Họ tên khách hàng
        'has_archive'         => false,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'show_in_rest'        => false,        // Bảo mật: Không công khai danh sách khách hàng qua WP REST API
    );

    register_post_type('form_tmh', $args);
}

// Đổi tên nhãn submenu đầu tiên thành "Tai mũi họng" an toàn chuẩn WordPress
add_action('admin_menu', 'cih_rename_form_manager_submenus', 999);
function cih_rename_form_manager_submenus() {
    global $submenu;
    if (isset($submenu['edit.php?post_type=form_tmh']) && is_array($submenu['edit.php?post_type=form_tmh'])) {
        foreach ($submenu['edit.php?post_type=form_tmh'] as $key => $sub_item) {
            if (isset($sub_item[2]) && $sub_item[2] === 'edit.php?post_type=form_tmh') {
                $submenu['edit.php?post_type=form_tmh'][$key][0] = 'Tai mũi họng';
                break;
            }
        }
    }
}

// Đảm bảo vị trí menu "Quản lý Form" luôn nằm NGAY DƯỚI mục "Lịch hẹn"
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'cih_force_form_manager_menu_order', 999);
function cih_force_form_manager_menu_order($menu_order) {
    if (!$menu_order) return $menu_order;

    $target_item = 'edit.php?post_type=form_tmh';
    $after_item  = 'edit.php?post_type=lich-hen';

    // Xóa vị trí cũ của form_tmh nếu có
    $menu_order = array_diff($menu_order, array($target_item));

    $new_order = array();
    $inserted = false;

    foreach ($menu_order as $item) {
        $new_order[] = $item;
        if ($item === $after_item) {
            $new_order[] = $target_item;
            $inserted = true;
        }
    }

    // Nếu không tìm thấy lich-hen thì chèn sau edit.php (Posts)
    if (!$inserted) {
        $final_order = array();
        foreach ($new_order as $item) {
            $final_order[] = $item;
            if ($item === 'edit.php') {
                $final_order[] = $target_item;
                $inserted = true;
            }
        }
        if ($inserted) return $final_order;
        $new_order[] = $target_item;
    }

    return $new_order;
}


// ════════════════════════════════════════════════════════════════
// 2. CẤU HÌNH CỘT HIỂN THỊ TRONG BẢNG QUẢN TRỊ ADMIN (COLUMNS)
// Thứ tự: STT | Ngày | Họ tên | SDT | Dịch vụ cần khám
// ════════════════════════════════════════════════════════════════
add_filter('manage_form_tmh_posts_columns', 'cih_form_tmh_columns');
function cih_form_tmh_columns($columns) {
    $new_cols = array();
    $new_cols['cb']           = $columns['cb'];
    $new_cols['lead_stt']     = 'STT';
    $new_cols['lead_date']    = 'Ngày';
    $new_cols['title']        = 'Họ tên';
    $new_cols['lead_phone']   = 'SDT';
    $new_cols['lead_service'] = 'Dịch vụ cần khám';
    return $new_cols;
}

add_action('manage_form_tmh_posts_custom_column', 'cih_form_tmh_custom_column', 10, 2);
function cih_form_tmh_custom_column($column, $post_id) {
    global $wp_query;

    switch ($column) {
        case 'lead_stt':
            $paged = max(1, (int) get_query_var('paged'));
            $per_page = (int) ($wp_query->query_vars['posts_per_page'] ?? 20);
            if ($per_page <= 0) $per_page = 20;
            $post_ids = wp_list_pluck($wp_query->posts, 'ID');
            $idx = array_search($post_id, $post_ids);
            $stt = ($paged - 1) * $per_page + ($idx !== false ? $idx + 1 : 1);
            echo '<span style="font-weight:700; color:#475569; font-size:13px;">' . esc_html($stt) . '</span>';
            break;

        case 'lead_date':
            $date = get_the_date('d/m/Y', $post_id);
            echo '<span style="color:#0f172a; font-weight:600; font-size:13px; white-space:nowrap;">' . esc_html($date) . '</span>';
            break;

        case 'lead_phone':
            $phone = get_post_meta($post_id, '_lead_phone', true);
            if ($phone) {
                // Bỏ icon, hiển thị số điện thoại sạch, có thể click gọi
                echo '<a href="tel:' . esc_attr($phone) . '" style="font-weight:700; color:#007DA5; text-decoration:none; font-size:14px; letter-spacing:0.3px;">' . esc_html($phone) . '</a>';
            } else {
                echo '<span style="color:#94a3b8;">--</span>';
            }
            break;

        case 'lead_service':
            $service = get_post_meta($post_id, '_lead_service', true);
            if ($service) {
                echo '<span style="display:inline-block; padding:4px 12px; background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe; border-radius:8px; font-weight:600; font-size:13px;">' . esc_html($service) . '</span>';
            } else {
                echo '<span style="color:#94a3b8;">--</span>';
            }
            break;
    }
}

// Cho phép sắp xếp theo cột Ngày và Họ tên
add_filter('manage_edit-form_tmh_sortable_columns', 'cih_form_tmh_sortable_columns');
function cih_form_tmh_sortable_columns($columns) {
    $columns['lead_date'] = 'date';
    $columns['title']     = 'title';
    return $columns;
}

// ════════════════════════════════════════════════════════════════
// 3. TỐI ƯU GIAO DIỆN BẢNG: GOM CÁC CỘT QUA TRÁI, KHOẢNG CÁCH GỌN GÀNG
// ════════════════════════════════════════════════════════════════
add_action('admin_head', 'cih_form_tmh_admin_compact_css');
function cih_form_tmh_admin_compact_css() {
    global $typenow;
    if ($typenow === 'form_tmh') {
        ?>
        <style>
            /* Giới hạn độ rộng bảng và gom các cột về bên trái gọn gàng */
            .post-type-form_tmh .wp-list-table {
                table-layout: fixed !important;
                max-width: 1050px !important;
            }
            .post-type-form_tmh .tablenav {
                max-width: 1050px !important;
            }
            .post-type-form_tmh .wp-list-table th#cb,
            .post-type-form_tmh .wp-list-table td.check-column {
                width: 36px !important;
                padding-left: 8px !important;
                padding-right: 0 !important;
            }
            .post-type-form_tmh .wp-list-table th#lead_stt,
            .post-type-form_tmh .wp-list-table td.column-lead_stt {
                width: 60px !important;
                text-align: center !important;
            }
            .post-type-form_tmh .wp-list-table th#lead_date,
            .post-type-form_tmh .wp-list-table td.column-lead_date {
                width: 120px !important;
            }
            .post-type-form_tmh .wp-list-table th#title,
            .post-type-form_tmh .wp-list-table td.column-title {
                width: 230px !important;
            }
            .post-type-form_tmh .wp-list-table th#lead_phone,
            .post-type-form_tmh .wp-list-table td.column-lead_phone {
                width: 160px !important;
            }
            .post-type-form_tmh .wp-list-table th#lead_service,
            .post-type-form_tmh .wp-list-table td.column-lead_service {
                width: 420px !important;
            }
        </style>
        <?php
    }
}



// ════════════════════════════════════════════════════════════════
// 4. META BOX CHI TIẾT & CẬP NHẬT TRẠNG THÁI TRONG TRANG SỬA BÀI
// ════════════════════════════════════════════════════════════════
add_action('add_meta_boxes', 'cih_form_tmh_add_meta_box');
function cih_form_tmh_add_meta_box() {
    add_meta_box(
        'cih_form_tmh_details',
        '📋 Thông Tin Đăng Ký & Xử Lý CSKH',
        'cih_form_tmh_render_meta_box',
        'form_tmh',
        'normal',
        'high'
    );
}

function cih_form_tmh_render_meta_box($post) {
    wp_nonce_field('cih_form_tmh_nonce_action', 'cih_form_tmh_nonce');

    $phone   = get_post_meta($post->ID, '_lead_phone', true);
    $service = get_post_meta($post->ID, '_lead_service', true);
    $status  = get_post_meta($post->ID, '_lead_status', true) ?: 'pending';
    $note    = get_post_meta($post->ID, '_lead_note', true);
    $source  = get_post_meta($post->ID, '_lead_source', true) ?: 'Landing Page Tai Mũi Họng';
    $ip      = get_post_meta($post->ID, '_lead_ip', true);
    $created = get_post_meta($post->ID, '_lead_created_at', true) ?: $post->post_date;
    ?>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; padding: 10px 0;">
        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:18px;">
            <h4 style="margin:0 0 12px 0; color:#007DA5; font-size:14px; text-transform:uppercase;">👤 Thông Tin Khách Hàng</h4>
            <p style="margin:6px 0;"><strong>Họ và tên:</strong> <?php echo esc_html($post->post_title); ?></p>
            <p style="margin:6px 0;"><strong>Số điện thoại:</strong> 
                <a href="tel:<?php echo esc_attr($phone); ?>" style="color:#0284c7; font-weight:700; font-size:15px; text-decoration:none;">📞 <?php echo esc_html($phone); ?></a>
            </p>
            <p style="margin:6px 0;"><strong>Dịch vụ cần khám:</strong> 
                <span style="font-weight:700; color:#1e293b; background:#fef3c7; padding:2px 8px; border-radius:6px;"><?php echo esc_html($service); ?></span>
            </p>
            <p style="margin:6px 0;"><strong>Nguồn trang:</strong> <?php echo esc_html($source); ?></p>
            <p style="margin:6px 0; font-size:12px; color:#64748b;"><strong>Thời gian gửi:</strong> <?php echo esc_html($created); ?> (IP: <?php echo esc_html($ip); ?>)</p>
        </div>

        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:18px;">
            <h4 style="margin:0 0 12px 0; color:#007DA5; font-size:14px; text-transform:uppercase;">🎯 Trạng Thái Xử Lý (Dành Cho CSKH)</h4>
            <div style="margin-bottom:14px;">
                <label for="cih_lead_status" style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Cập nhật trạng thái:</label>
                <select name="cih_lead_status" id="cih_lead_status" style="width:100%; padding:8px 12px; border-radius:8px; border:1.5px solid #cbd5e1; font-weight:600;">
                    <option value="pending" <?php selected($status, 'pending'); ?>>🟡 Chờ liên hệ</option>
                    <option value="contacted" <?php selected($status, 'contacted'); ?>>🔵 Đã liên hệ</option>
                    <option value="booked" <?php selected($status, 'booked'); ?>>🟢 Đã đặt hẹn khám</option>
                    <option value="cancelled" <?php selected($status, 'cancelled'); ?>>⚪ Hủy / Không nghe máy</option>
                </select>
            </div>
            <div>
                <label for="cih_lead_note" style="display:block; font-weight:700; margin-bottom:6px; font-size:13px;">Ghi chú tư vấn:</label>
                <textarea name="cih_lead_note" id="cih_lead_note" rows="3" style="width:100%; padding:8px 12px; border-radius:8px; border:1.5px solid #cbd5e1;" placeholder="VD: Đã gọi khách lúc 10h, hẹn khám thứ 3 tuần sau..."><?php echo esc_textarea($note); ?></textarea>
            </div>
        </div>
    </div>
    <?php
}

add_action('save_post_form_tmh', 'cih_form_tmh_save_meta');
function cih_form_tmh_save_meta($post_id) {
    if (!isset($_POST['cih_form_tmh_nonce']) || !wp_verify_nonce($_POST['cih_form_tmh_nonce'], 'cih_form_tmh_nonce_action')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['cih_lead_status'])) {
        update_post_meta($post_id, '_lead_status', sanitize_text_field($_POST['cih_lead_status']));
    }
    if (isset($_POST['cih_lead_note'])) {
        update_post_meta($post_id, '_lead_note', sanitize_textarea_field($_POST['cih_lead_note']));
    }
}

// ════════════════════════════════════════════════════════════════
// 5. REST API TIẾP NHẬN LEAD TỪ LANDING PAGE TAI MŨI HỌNG
// ════════════════════════════════════════════════════════════════
add_action('rest_api_init', function () {
    register_rest_route('cih/v1', '/submit-tmh-lead', array(
        'methods'             => 'POST',
        'callback'            => 'cih_handle_tmh_lead_submission',
        'permission_callback' => '__return_true', // Cho phép gửi từ form khách hàng
    ));
});

function cih_handle_tmh_lead_submission($request) {
    // 1. Kiểm tra Rate Limit theo IP (Tối đa 5 lần gửi / 10 phút trên mỗi IP)
    $client_ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
    $rate_key  = 'cih_tmh_rl_' . md5($client_ip);
    $attempts  = (int) get_transient($rate_key);
    if ($attempts >= 5) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Bạn đã gửi yêu cầu quá nhiều lần. Vui lòng thử lại sau ít phút hoặc gọi hotline 1900 8146.',
        ), 429);
    }

    $params = $request->get_params();

    $name    = isset($params['name']) ? sanitize_text_field($params['name']) : '';
    $phone   = isset($params['phone']) ? sanitize_text_field($params['phone']) : '';
    $service = isset($params['service']) ? sanitize_text_field($params['service']) : '';
    $source  = isset($params['source']) ? sanitize_text_field($params['source']) : 'Landing Page Tai Mũi Họng';

    // 2. Kiểm tra dữ liệu bắt buộc và định dạng số điện thoại hợp lệ
    if (empty($phone) || !preg_match('/^[0-9\+\-\s\.]{8,15}$/', $phone)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Vui lòng cung cấp số điện thoại hợp lệ.',
        ), 400);
    }

    // Tăng bộ đếm Rate Limit (lưu trong 10 phút)
    set_transient($rate_key, $attempts + 1, 10 * MINUTE_IN_SECONDS);

    if (empty($name)) {
        $name = 'Khách đăng ký ' . substr($phone, -4);
    }

    // Chèn dữ liệu vào CPT form_tmh
    $post_data = array(
        'post_title'   => $name,
        'post_status'  => 'publish',
        'post_type'    => 'form_tmh',
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_lead_phone', $phone);
        update_post_meta($post_id, '_lead_service', $service);
        update_post_meta($post_id, '_lead_status', 'pending'); // Mặc định là Chờ liên hệ
        update_post_meta($post_id, '_lead_source', $source);
        update_post_meta($post_id, '_lead_ip', $client_ip);
        update_post_meta($post_id, '_lead_created_at', current_time('mysql'));

        // Gửi email thông báo cho Admin (nếu cấu hình)
        $admin_email = get_option('admin_email');
        if ($admin_email) {
            $subject = '[CIH Tai Mũi Họng] Có khách hàng mới đăng ký: ' . $name;
            $body = "Chào bộ phận CSKH CIH,\n\n"
                  . "Có khách hàng vừa đăng ký tư vấn từ trang Tai Mũi Họng:\n\n"
                  . "• Họ và tên: " . $name . "\n"
                  . "• Số điện thoại: " . $phone . "\n"
                  . "• Dịch vụ cần khám: " . $service . "\n"
                  . "• Nguồn: " . $source . "\n"
                  . "• Thời gian: " . current_time('d/m/Y H:i:s') . "\n\n"
                  . "Vui lòng đăng nhập vào CMS để xử lý: " . admin_url('edit.php?post_type=form_tmh') . "\n\n"
                  . "Trân trọng,\nBệnh viện Quốc tế City";
            wp_mail($admin_email, $subject, $body);
        }

        return new WP_REST_Response(array(
            'success' => true,
            'message' => 'Thông tin đã được ghi nhận! Bộ phận CSKH Bệnh viện Quốc tế City sẽ liên hệ tư vấn đến Quý khách trong thời gian sớm nhất.',
            'lead_id' => $post_id,
        ), 200);
    }

    return new WP_REST_Response(array(
        'success' => false,
        'message' => 'Đã có lỗi xảy ra trong quá trình lưu thông tin. Vui lòng thử lại hoặc gọi hotline 1900 8146.',
    ), 500);
}

// ════════════════════════════════════════════════════════════════
// 6. XUẤT DỮ LIỆU EXCEL (CSV HỖ TRỢ TIẾNG VIỆT UTF-8 BOM)
// ════════════════════════════════════════════════════════════════
add_action('manage_posts_extra_tablenav', 'cih_form_tmh_export_button');
function cih_form_tmh_export_button($which) {
    global $typenow;
    if ($typenow === 'form_tmh' && $which === 'top') {
        $export_url = add_query_arg(array('action' => 'cih_export_tmh_leads'), admin_url('admin-post.php'));
        echo '<a href="' . esc_url($export_url) . '" class="button button-secondary" style="margin-left:8px; border-color:#007DA5; color:#007DA5; font-weight:700;">📊 Xuất Excel (CSV)</a>';
    }
}

add_action('admin_post_cih_export_tmh_leads', 'cih_handle_export_tmh_leads');
function cih_handle_export_tmh_leads() {
    if (!current_user_can('edit_posts')) {
        wp_die('Bạn không có quyền xuất dữ liệu.');
    }

    $filename = 'cih-lead-tai-mui-hong-' . date('Y-m-d') . '.csv';
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Xuất UTF-8 BOM để Excel hiển thị đúng dấu tiếng Việt
    echo "\xEF\xBB\xBF";

    $output = fopen('php://output', 'w');
    fputcsv($output, array('STT', 'Ngày', 'Họ tên', 'SDT', 'Dịch vụ cần khám'));

    $leads = get_posts(array(
        'post_type'      => 'form_tmh',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));

    $stt = 1;
    foreach ($leads as $lead) {
        $phone   = get_post_meta($lead->ID, '_lead_phone', true);
        $service = get_post_meta($lead->ID, '_lead_service', true);
        $date    = get_the_date('d/m/Y', $lead->ID);

        fputcsv($output, array(
            $stt++,
            $date,
            $lead->post_title,
            "'" . $phone, // Thêm dấu ' để Excel không bị mất số 0 đầu tiên
            $service,
        ));
    }

    fclose($output);
    exit;
}

// ════════════════════════════════════════════════════════════════
// 7. BẢO MẬT HỆ THỐNG (SECURITY HARDENING CHO CIH.COM.VN)
// ════════════════════════════════════════════════════════════════

// 7.1. Chặn truy cập công khai vào REST API của Lịch hẹn (lich-hen), Quản lý Form (form_tmh) và Danh sách User (users)
add_filter('rest_pre_dispatch', 'cih_restrict_sensitive_rest_routes', 10, 3);
function cih_restrict_sensitive_rest_routes($result, $server, $request) {
    $route = $request->get_route();
    $protected_prefixes = array(
        '/wp/v2/lich-hen',
        '/wp/v2/form_tmh',
        '/wp/v2/users',
    );

    foreach ($protected_prefixes as $prefix) {
        if (strpos($route, $prefix) === 0) {
            if (!current_user_can('edit_posts')) {
                return new WP_Error(
                    'rest_forbidden',
                    'Truy cập bị từ chối vì lý do bảo mật thông tin.',
                    array('status' => 403)
                );
            }
        }
    }

    return $result;
}

// 7.2. Chống Spam / Rate Limit cho form Đặt lịch hẹn chính (wp_ajax_nopriv_submit_lich_hen)
add_action('wp_ajax_nopriv_submit_lich_hen', 'cih_rate_limit_booking_ajax', 1);
function cih_rate_limit_booking_ajax() {
    $client_ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
    $rate_key  = 'cih_bk_rl_' . md5($client_ip);
    $attempts  = (int) get_transient($rate_key);
    if ($attempts >= 5) {
        wp_send_json_error('Bạn đã gửi yêu cầu đặt lịch quá nhiều lần. Vui lòng thử lại sau ít phút.');
        wp_die();
    }
    set_transient($rate_key, $attempts + 1, 10 * MINUTE_IN_SECONDS);
}

// 7.3. Vô hiệu hóa XML-RPC để chống tấn công Brute-Force & Pingback DDoS
add_filter('xmlrpc_enabled', '__return_false');

// 7.4. Ẩn thông tin tài khoản quản trị trong oEmbed API & chặn dò tìm Author Archive
add_filter('oembed_response_data', function ($data) {
    unset($data['author_name']);
    unset($data['author_url']);
    return $data;
}, 999);
add_action('template_redirect', function () {
    if (!is_admin() && (is_author() || isset($_REQUEST['author']))) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
});
