<?php
/**
 * Chi Hội Bệnh Viện Tư Nhân Theme Functions
 *
 * @package ChiHoi
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Setup Theme Supports
function chihoi_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('align-wide');
    add_theme_support('editor-styles');

    register_nav_menus(array(
        'primary_menu' => __('Menu Chính Header', 'chihoi'),
        'footer_menu_about' => __('Menu Footer - Về Chi Hội', 'chihoi'),
        'footer_menu_activities' => __('Menu Footer - Hoạt Động', 'chihoi'),
    ));
}
add_action('after_setup_theme', 'chihoi_theme_setup');

// Register Block Pattern Category
function chihoi_register_patterns() {
    register_block_pattern_category(
        'chihoi',
        array('label' => __('Chi Hội Bệnh Viện', 'chihoi'))
    );
}
add_action('init', 'chihoi_register_patterns');

// Enqueue Styles & Scripts
function chihoi_enqueue_scripts() {
    wp_enqueue_style('chihoi-google-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans:wght@400;500;600;700&display=swap', array(), null);
    wp_enqueue_style('chihoi-main-style', get_template_directory_uri() . '/css/style.css', array(), '3.0.0');
    wp_enqueue_style('chihoi-theme-style', get_stylesheet_uri(), array('chihoi-main-style'), '3.0.0');
    wp_enqueue_script('chihoi-main-script', get_template_directory_uri() . '/js/main.js', array(), '3.0.0', true);
}
add_action('wp_enqueue_scripts', 'chihoi_enqueue_scripts');

// Register Custom Post Types for Medical CMS
function chihoi_register_cpts() {
    // 1. CPT Bệnh Viện Hội Viên
    register_post_type('member_hospital', array(
        'labels' => array(
            'name' => __('Bệnh Viện Hội Viên', 'chihoi'),
            'singular_name' => __('Bệnh viện', 'chihoi'),
            'add_new' => __('Thêm Bệnh Viện', 'chihoi'),
            'add_new_item' => __('Thêm Bệnh Viện Hội Viên Mới', 'chihoi'),
            'edit_item' => __('Chỉnh sửa Bệnh Viện', 'chihoi'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
        'rewrite' => array('slug' => 'hoi-vien-chi-tiet'),
        'show_in_rest' => true,
    ));

    // 2. CPT Khóa Đào Tạo CME
    register_post_type('cme_training', array(
        'labels' => array(
            'name' => __('Đào Tạo CME', 'chihoi'),
            'singular_name' => __('Khóa Đào Tạo', 'chihoi'),
            'add_new' => __('Thêm Khóa Học', 'chihoi'),
            'add_new_item' => __('Thêm Khóa Đào Tạo CME Mới', 'chihoi'),
            'edit_item' => __('Chỉnh sửa Khóa Học', 'chihoi'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
        'rewrite' => array('slug' => 'dao-tao-cme'),
        'show_in_rest' => true,
    ));

    // Taxonomy Chuyên Khoa Đào Tạo
    register_taxonomy('cme_category', 'cme_training', array(
        'labels' => array(
            'name' => __('Chuyên Khoa Đào Tạo', 'chihoi'),
            'singular_name' => __('Chuyên khoa', 'chihoi'),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'chuyen-khoa-cme'),
    ));

    // 3. CPT Văn Bản & Quyết Định
    register_post_type('decision_doc', array(
        'labels' => array(
            'name' => __('Văn Bản & Quyết Định', 'chihoi'),
            'singular_name' => __('Văn bản', 'chihoi'),
            'add_new' => __('Thêm Văn Bản', 'chihoi'),
            'add_new_item' => __('Thêm Văn Bản Quyết Định Mới', 'chihoi'),
            'edit_item' => __('Chỉnh sửa Văn Bản', 'chihoi'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
        'rewrite' => array('slug' => 'van-ban-quyet-dinh'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'chihoi_register_cpts');

// ==============================================================================
// 7. HỆ THỐNG QUẢN TRỊ TRỰC QUAN (VISUAL CMS) TOÀN DIỆN
// ==============================================================================

// Helper lấy cấu hình giao diện
function chihoi_get_option($key, $default = '') {
    $options = get_option('chihoi_theme_options', array());
    if (isset($options[$key]) && $options[$key] !== '') {
        return $options[$key];
    }
    $defaults = array(
        'header_logo' => get_template_directory_uri() . '/photo/logo/chihoi_2.png',
        'footer_logo' => get_template_directory_uri() . '/photo/logo/chihoi_2.png',
        'footer_affil' => 'Thuộc Hiệp hội Bệnh viện Tư nhân Việt Nam',
        'footer_slogan' => 'ĐOÀN KẾT - HỢP TÁC - PHÁT TRIỂN',
        'footer_address' => 'Số 5 Đường 17A, P. An Lạc, TP. HCM',
        'footer_phone' => '1900 8146',
        'footer_email' => 'info@chihoibenhvien.com',
        'footer_newsletter_desc' => 'Nhận thông báo về các khóa đào tạo, hội nghị và chính sách y tế mới nhất.',
        'footer_copyright' => 'Bản quyền © 2026 thuộc về Chi hội Bệnh viện Tư nhân TP. HCM và các tỉnh, thành phía Nam.',
        'seo_title' => 'Chi Hội Bệnh Viện Tư Nhân TP.HCM & Các Tỉnh Phía Nam - Trang Chủ',
        'seo_desc' => 'Cổng thông tin chính thức của Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh thành phía Nam. Cập nhật tin tức y tế, thông báo chiêu sinh đào tạo liên tục CME, kết nối mạng lưới bệnh viện tư nhân.',
        'social_img' => get_home_url(null, '/photo/og-image.jpg'),
    );
    return $defaults[$key] ?? $default;
}

// 1. CPT BANNER SLIDER TRANG CHỦ
function chihoi_register_banner_cpt() {
    register_post_type('home_banner', array(
        'labels' => array(
            'name' => __('Banner Slider', 'chihoi'),
            'singular_name' => __('Banner', 'chihoi'),
            'add_new' => __('Thêm Banner Mới', 'chihoi'),
            'add_new_item' => __('Thêm Banner Mới', 'chihoi'),
            'edit_item' => __('Chỉnh Sửa Banner', 'chihoi'),
            'all_items' => __('Tất Cả Banners', 'chihoi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 15,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title', 'page-attributes'),
    ));
}
add_action('init', 'chihoi_register_banner_cpt');

// Metabox cho Banner Slider
function chihoi_banner_metabox() {
    add_meta_box('chihoi_banner_meta', 'Cấu Hình Hình Ảnh & Liên Kết Banner', 'chihoi_render_banner_metabox', 'home_banner', 'normal', 'high');
}
add_action('add_meta_boxes', 'chihoi_banner_metabox');

function chihoi_render_banner_metabox($post) {
    wp_nonce_field('chihoi_save_banner', 'chihoi_banner_nonce');
    $img_pc = get_post_meta($post->ID, '_banner_img_pc', true);
    $img_mb = get_post_meta($post->ID, '_banner_img_mb', true);
    $link = get_post_meta($post->ID, '_banner_link', true);
    ?>
    <table class="form-table">
        <tr>
            <th style="width:200px;"><label for="banner_img_pc"><strong>Ảnh Máy Tính (Desktop)</strong> <span style="color:red;">*</span></label></th>
            <td>
                <input type="text" id="banner_img_pc" name="banner_img_pc" value="<?php echo esc_attr($img_pc); ?>" style="width:70%;" placeholder="https://..." />
                <button type="button" class="button chihoi-upload-btn" data-target="banner_img_pc">Chọn Từ Thư Viện</button>
                <p class="description">Kích thước khuyến nghị: 1920x600px hoặc tỷ lệ 16:5.</p>
                <div id="preview_banner_img_pc" style="margin-top:10px;">
                    <?php if ($img_pc): ?><img src="<?php echo esc_url($img_pc); ?>" style="max-height:120px;border-radius:6px;border:1px solid #cbd5e1;" /><?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th><label for="banner_img_mb"><strong>Ảnh Điện Thoại (Mobile)</strong></label></th>
            <td>
                <input type="text" id="banner_img_mb" name="banner_img_mb" value="<?php echo esc_attr($img_mb); ?>" style="width:70%;" placeholder="https://..." />
                <button type="button" class="button chihoi-upload-btn" data-target="banner_img_mb">Chọn Từ Thư Viện</button>
                <p class="description">Kích thước khuyến nghị: 768x450px hoặc vuông/dọc để hiển thị đẹp trên điện thoại.</p>
                <div id="preview_banner_img_mb" style="margin-top:10px;">
                    <?php if ($img_mb): ?><img src="<?php echo esc_url($img_mb); ?>" style="max-height:120px;border-radius:6px;border:1px solid #cbd5e1;" /><?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th><label for="banner_link"><strong>Đường Dẫn Liên Kết (URL)</strong></label></th>
            <td>
                <input type="url" id="banner_link" name="banner_link" value="<?php echo esc_attr($link); ?>" style="width:70%;" placeholder="https://... (để trống nếu không muốn click chuyển trang)" />
            </td>
        </tr>
    </table>
    <script>
    jQuery(document).ready(function($){
        $('.chihoi-upload-btn').click(function(e){
            e.preventDefault();
            var targetInput = $(this).data('target');
            var custom_uploader = wp.media({
                title: 'Chọn Hình Ảnh Banner',
                button: { text: 'Sử Dụng Ảnh Này' },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#' + targetInput).val(attachment.url);
                $('#preview_' + targetInput).html('<img src="' + attachment.url + '" style="max-height:120px;border-radius:6px;border:1px solid #cbd5e1;" />');
            }).open();
        });
    });
    </script>
    <?php
}

function chihoi_save_banner_meta($post_id) {
    if (!isset($_POST['chihoi_banner_nonce']) || !wp_verify_nonce($_POST['chihoi_banner_nonce'], 'chihoi_save_banner')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['banner_img_pc'])) update_post_meta($post_id, '_banner_img_pc', esc_url_raw($_POST['banner_img_pc']));
    if (isset($_POST['banner_img_mb'])) update_post_meta($post_id, '_banner_img_mb', esc_url_raw($_POST['banner_img_mb']));
    if (isset($_POST['banner_link'])) update_post_meta($post_id, '_banner_link', esc_url_raw($_POST['banner_link']));
}
add_action('save_post_home_banner', 'chihoi_save_banner_meta');

// Cột hiển thị Banner trong Admin
function chihoi_banner_columns($cols) {
    return array(
        'cb' => '<input type="checkbox" />',
        'banner_thumb' => 'Hình Ảnh Banner',
        'title' => 'Tên Banner',
        'banner_link' => 'Liên Kết',
        'menu_order' => 'Thứ Tự',
        'date' => 'Ngày Đăng',
    );
}
add_filter('manage_home_banner_posts_columns', 'chihoi_banner_columns');

function chihoi_banner_custom_column($col, $post_id) {
    if ($col === 'banner_thumb') {
        $img = get_post_meta($post_id, '_banner_img_pc', true);
        echo $img ? '<img src="' . esc_url($img) . '" style="width:120px;height:45px;object-fit:cover;border-radius:4px;" />' : '—';
    } elseif ($col === 'banner_link') {
        $link = get_post_meta($post_id, '_banner_link', true);
        echo $link ? '<a href="' . esc_url($link) . '" target="_blank">' . esc_html($link) . '</a>' : '<span style="color:#94a3b8;">Không liên kết</span>';
    } elseif ($col === 'menu_order') {
        $post = get_post($post_id);
        echo '<strong>' . esc_html($post->menu_order) . '</strong>';
    }
}
add_action('manage_home_banner_posts_custom_column', 'chihoi_banner_custom_column', 10, 2);


// 2. CPT ĐỐI TÁC ĐỒNG HÀNH
function chihoi_register_partner_cpt() {
    register_post_type('partner_logo', array(
        'labels' => array(
            'name' => __('Đối Tác Đồng Hành', 'chihoi'),
            'singular_name' => __('Đối Tác', 'chihoi'),
            'add_new' => __('Thêm Đối Tác Mới', 'chihoi'),
            'add_new_item' => __('Thêm Logo Đối Tác Mới', 'chihoi'),
            'edit_item' => __('Chỉnh Sửa Đối Tác', 'chihoi'),
            'all_items' => __('Tất Cả Đối Tác', 'chihoi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 17,
        'menu_icon' => 'dashicons-networking',
        'supports' => array('title', 'thumbnail', 'page-attributes'),
    ));
}
add_action('init', 'chihoi_register_partner_cpt');

// Metabox cho Đối Tác Đồng Hành
function chihoi_partner_metabox() {
    add_meta_box('chihoi_partner_meta', 'Cấu Hình Website Đối Tác', 'chihoi_render_partner_metabox', 'partner_logo', 'normal', 'high');
}
add_action('add_meta_boxes', 'chihoi_partner_metabox');

function chihoi_render_partner_metabox($post) {
    wp_nonce_field('chihoi_save_partner', 'chihoi_partner_nonce');
    $url = get_post_meta($post->ID, '_partner_url', true);
    ?>
    <p><strong>Lưu ý:</strong> Vui lòng đặt ảnh <strong>Ảnh Đại Diện (Featured Image)</strong> ở cột bên phải để làm Logo hiển thị ngoài website.</p>
    <table class="form-table">
        <tr>
            <th style="width:180px;"><label for="partner_url">Website Đối Tác</label></th>
            <td>
                <input type="url" id="partner_url" name="partner_url" value="<?php echo esc_attr($url); ?>" class="regular-text" placeholder="https://..." />
            </td>
        </tr>
    </table>
    <?php
}

function chihoi_save_partner_meta($post_id) {
    if (!isset($_POST['chihoi_partner_nonce']) || !wp_verify_nonce($_POST['chihoi_partner_nonce'], 'chihoi_save_partner')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['partner_url'])) update_post_meta($post_id, '_partner_url', esc_url_raw($_POST['partner_url']));
}
add_action('save_post_partner_logo', 'chihoi_save_partner_meta');

function chihoi_partner_columns($cols) {
    return array(
        'cb' => '<input type="checkbox" />',
        'partner_logo' => 'Logo',
        'title' => 'Tên Đơn Vị Đối Tác',
        'partner_url' => 'Website',
        'menu_order' => 'Thứ Tự',
        'date' => 'Ngày Đăng',
    );
}
add_filter('manage_partner_logo_posts_columns', 'chihoi_partner_columns');

function chihoi_partner_custom_column($col, $post_id) {
    if ($col === 'partner_logo') {
        if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail($post_id, array(90, 45), array('style' => 'object-fit:contain;background:#f8fafc;border:1px solid #e2e8f0;padding:4px;border-radius:4px;'));
        } else {
            echo '<span style="color:#94a3b8;">Chưa có logo</span>';
        }
    } elseif ($col === 'partner_url') {
        $url = get_post_meta($post_id, '_partner_url', true);
        echo $url ? '<a href="' . esc_url($url) . '" target="_blank">' . esc_html($url) . '</a>' : '—';
    } elseif ($col === 'menu_order') {
        $post = get_post($post_id);
        echo '<strong>' . esc_html($post->menu_order) . '</strong>';
    }
}
add_action('manage_partner_logo_posts_custom_column', 'chihoi_partner_custom_column', 10, 2);


// 3. TRANG CÀI ĐẶT GIAO DIỆN WEBSITE (THEME OPTIONS CHUYÊN NGHIỆP)
function chihoi_admin_menu() {
    add_menu_page(
        'Cài Đặt Website',
        'Cài Đặt Website',
        'manage_options',
        'chihoi-settings',
        'chihoi_settings_page_html',
        'dashicons-admin-customizer',
        19
    );
}
add_action('admin_menu', 'chihoi_admin_menu');

// Enqueue media uploader in admin settings
function chihoi_admin_scripts($hook) {
    if ($hook === 'toplevel_page_chihoi-settings' || $hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'chihoi_admin_scripts');

function chihoi_settings_page_html() {
    if (!current_user_can('manage_options')) return;

    // Xử lý lưu dữ liệu
    $updated = false;
    if (isset($_POST['chihoi_save_settings']) && check_admin_referer('chihoi_theme_options_verify')) {
        $options = array(
            'header_logo' => esc_url_raw($_POST['header_logo'] ?? ''),
            'footer_logo' => esc_url_raw($_POST['footer_logo'] ?? ''),
            'footer_affil' => sanitize_text_field($_POST['footer_affil'] ?? ''),
            'footer_slogan' => sanitize_text_field($_POST['footer_slogan'] ?? ''),
            'footer_address' => sanitize_text_field($_POST['footer_address'] ?? ''),
            'footer_phone' => sanitize_text_field($_POST['footer_phone'] ?? ''),
            'footer_email' => sanitize_email($_POST['footer_email'] ?? ''),
            'footer_newsletter_desc' => sanitize_textarea_field($_POST['footer_newsletter_desc'] ?? ''),
            'footer_copyright' => sanitize_text_field($_POST['footer_copyright'] ?? ''),
            'seo_title' => sanitize_text_field($_POST['seo_title'] ?? ''),
            'seo_desc' => sanitize_textarea_field($_POST['seo_desc'] ?? ''),
            'social_img' => esc_url_raw($_POST['social_img'] ?? ''),
        );
        update_option('chihoi_theme_options', $options);

        // Đồng bộ tự động sang Rank Math SEO và Trang Chủ
        $front_id = get_option('page_on_front');
        if ($front_id) {
            update_post_meta($front_id, 'rank_math_title', $options['seo_title']);
            update_post_meta($front_id, 'rank_math_facebook_title', $options['seo_title']);
            update_post_meta($front_id, 'rank_math_description', $options['seo_desc']);
            update_post_meta($front_id, 'rank_math_facebook_description', $options['seo_desc']);
            if (!empty($options['social_img'])) {
                update_post_meta($front_id, 'rank_math_facebook_image', $options['social_img']);
            }
        }
        // Tự động xóa cache LiteSpeed ngay khi người dùng bấm Lưu cài đặt
        if (has_action('litespeed_purge_all')) {
            do_action('litespeed_purge_all');
        }
        $updated = true;
    }

// Tự động đồng bộ tiêu đề và mô tả trang chủ từ Cài Đặt Website
function chihoi_sync_front_page_title($title) {
    if (is_front_page()) {
        $custom_title = chihoi_get_option('seo_title');
        if (!empty($custom_title)) {
            return $custom_title;
        }
    }
    return $title;
}
add_filter('pre_get_document_title', 'chihoi_sync_front_page_title', 9999);
add_filter('rank_math/frontend/title', 'chihoi_sync_front_page_title', 9999);

function chihoi_sync_front_page_desc($desc) {
    if (is_front_page()) {
        $custom_desc = chihoi_get_option('seo_desc');
        if (!empty($custom_desc)) {
            return $custom_desc;
        }
    }
    return $desc;
}
add_filter('rank_math/frontend/description', 'chihoi_sync_front_page_desc', 9999);

add_filter('rank_math/opengraph/facebook/image', function($image) {
    if (is_front_page()) {
        $custom_img = chihoi_get_option('social_img');
        if (!empty($custom_img)) {
            return $custom_img;
        }
    }
    return $image;
}, 9999);

    $opt = get_option('chihoi_theme_options', array());
    $header_logo = chihoi_get_option('header_logo');
    $footer_logo = chihoi_get_option('footer_logo');
    $footer_affil = chihoi_get_option('footer_affil');
    $footer_slogan = chihoi_get_option('footer_slogan');
    $footer_address = chihoi_get_option('footer_address');
    $footer_phone = chihoi_get_option('footer_phone');
    $footer_email = chihoi_get_option('footer_email');
    $footer_newsletter_desc = chihoi_get_option('footer_newsletter_desc');
    $footer_copyright = chihoi_get_option('footer_copyright');
    ?>
    <div class="wrap" style="max-width:1000px;">
        <h1 style="color:#2C3691;font-weight:800;display:flex;align-items:center;gap:10px;">
            <span class="dashicons dashicons-admin-customizer" style="font-size:32px;width:32px;height:32px;"></span>
            Cài Đặt Giao Diện Website (Header, Footer & Thông Tin Chi Hội)
        </h1>
        
        <?php if ($updated): ?>
        <div class="notice notice-success is-dismissible" style="padding:12px;font-weight:700;">
            <p>✓ Đã lưu các thay đổi cài đặt giao diện thành công!</p>
        </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field('chihoi_theme_options_verify'); ?>
            
            <!-- SECTION 1: HEADER -->
            <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-top:20px;border-left:5px solid #2C3691;">
                <h2 style="color:#2C3691;margin-top:0;">1. Đầu Trang (Header & Logo)</h2>
                <table class="form-table">
                    <tr>
                        <th style="width:220px;"><label for="header_logo"><strong>Logo Chi Hội (Header)</strong></label></th>
                        <td>
                            <input type="text" id="header_logo" name="header_logo" value="<?php echo esc_attr($header_logo); ?>" style="width:70%;" />
                            <button type="button" class="button chihoi-upload-btn" data-target="header_logo">Tải Lên / Chọn Ảnh</button>
                            <p class="description">Logo chính hiển thị ở góc trái thanh menu. Định dạng PNG trong suốt hoặc SVG.</p>
                            <div id="preview_header_logo" style="margin-top:10px;background:#f8fafc;padding:10px;display:inline-block;border-radius:6px;border:1px solid #e2e8f0;">
                                <img src="<?php echo esc_url($header_logo); ?>" style="max-height:55px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><strong>Sắp Xếp Menu Chính</strong></th>
                        <td>
                            <p style="margin:0 0 8px;">Bạn có thể kéo thả, thêm bớt hoặc đổi tên các nút menu (Trang chủ, Giới thiệu, Đào tạo, Hội viên...) dễ dàng:</p>
                            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="button button-secondary" target="_blank">👉 Đến Trang Quản Lý Menu (Kéo Thả)</a>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- SECTION 2: FOOTER -->
            <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-top:20px;border-left:5px solid #e22b27;">
                <h2 style="color:#e22b27;margin-top:0;">2. Chân Trang (Footer) & Thông Tin Liên Hệ</h2>
                <table class="form-table">
                    <tr>
                        <th style="width:220px;"><label for="footer_logo"><strong>Logo Chân Trang (Footer)</strong></label></th>
                        <td>
                            <input type="text" id="footer_logo" name="footer_logo" value="<?php echo esc_attr($footer_logo); ?>" style="width:70%;" />
                            <button type="button" class="button chihoi-upload-btn" data-target="footer_logo">Tải Lên / Chọn Ảnh</button>
                            <div id="preview_footer_logo" style="margin-top:10px;background:#2C3691;padding:10px;display:inline-block;border-radius:6px;">
                                <img src="<?php echo esc_url($footer_logo); ?>" style="max-height:50px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_affil"><strong>Đơn Vị Trực Thuộc</strong></label></th>
                        <td>
                            <input type="text" id="footer_affil" name="footer_affil" value="<?php echo esc_attr($footer_affil); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_slogan"><strong>Khẩu Hiệu / Slogan</strong></label></th>
                        <td>
                            <input type="text" id="footer_slogan" name="footer_slogan" value="<?php echo esc_attr($footer_slogan); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_address"><strong>Địa Chỉ Văn Phòng</strong></label></th>
                        <td>
                            <input type="text" id="footer_address" name="footer_address" value="<?php echo esc_attr($footer_address); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_phone"><strong>Hotline Liên Hệ</strong></label></th>
                        <td>
                            <input type="text" id="footer_phone" name="footer_phone" value="<?php echo esc_attr($footer_phone); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_email"><strong>Email Liên Hệ</strong></label></th>
                        <td>
                            <input type="email" id="footer_email" name="footer_email" value="<?php echo esc_attr($footer_email); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_newsletter_desc"><strong>Mô Tả Đăng Ký Nhận Tin</strong></label></th>
                        <td>
                            <textarea id="footer_newsletter_desc" name="footer_newsletter_desc" rows="2" class="large-text"><?php echo esc_textarea($footer_newsletter_desc); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_copyright"><strong>Thông Tin Bản Quyền (Copyright)</strong></label></th>
                        <td>
                            <input type="text" id="footer_copyright" name="footer_copyright" value="<?php echo esc_attr($footer_copyright); ?>" class="large-text" />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- SECTION 3: SOCIAL SHARE & SEO (ZALO, FACEBOOK, GOOGLE PREVIEW) -->
            <?php
            $seo_title = chihoi_get_option('seo_title');
            $seo_desc = chihoi_get_option('seo_desc');
            $social_img = chihoi_get_option('social_img');
            ?>
            <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.06);margin-top:20px;border-left:5px solid #0284c7;">
                <h2 style="color:#0284c7;margin-top:0;">3. Tiêu Đề & Mô Tả Khi Chia Sẻ Link (Zalo, Facebook, Google Search)</h2>
                <p class="description" style="margin-bottom:16px;font-size:0.95rem;">
                    Nội dung hiển thị trong khung thẻ bài viết khi bạn gửi link <code>https://chihoibenhvien.com/</code> qua <strong>Zalo, Messenger, Facebook, Viber, Telegram</strong> và trên kết quả tìm kiếm <strong>Google</strong>.
                </p>
                <table class="form-table">
                    <tr>
                        <th style="width:220px;"><label for="seo_title"><strong>Dòng Tiêu Đề (Title)</strong> <span style="color:red;">*</span></label></th>
                        <td>
                            <input type="text" id="seo_title" name="seo_title" value="<?php echo esc_attr($seo_title); ?>" class="large-text" style="font-weight:700;font-size:1rem;color:#1e293b;" />
                            <p class="description">Dòng chữ in đậm trên cùng của khung xem trước (Khuyến nghị 50 - 70 ký tự).</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="seo_desc"><strong>Đoạn Văn Mô Tả (Description)</strong> <span style="color:red;">*</span></label></th>
                        <td>
                            <textarea id="seo_desc" name="seo_desc" rows="3" class="large-text" style="font-size:0.95rem;line-height:1.5;"><?php echo esc_textarea($seo_desc); ?></textarea>
                            <p class="description">Đoạn văn tóm tắt ngắn hiển thị phía dưới dòng tiêu đề (Khuyến nghị 120 - 160 ký tự).</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="social_img"><strong>Ảnh Đại Diện Chia Sẻ (Banner Zalo/FB)</strong></label></th>
                        <td>
                            <input type="text" id="social_img" name="social_img" value="<?php echo esc_attr($social_img); ?>" style="width:70%;" />
                            <button type="button" class="button chihoi-upload-btn" data-target="social_img">Tải Lên / Đổi Ảnh Khác</button>
                            <p class="description">Kích thước chuẩn hiển thị đẹp nhất trên Zalo & Facebook: <strong>1200 x 630 px</strong>.</p>
                            <div id="preview_social_img" style="margin-top:10px;">
                                <?php if ($social_img): ?>
                                <img src="<?php echo esc_url($social_img); ?>" style="max-height:120px;border-radius:6px;border:1px solid #cbd5e1;" />
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- BUTTON LƯU -->
            <p style="margin-top:24px;">
                <input type="submit" name="chihoi_save_settings" class="button button-primary button-large" value="💾 Lưu Tất Cả Cài Đặt Giao Diện" style="font-weight:700;padding:6px 24px;font-size:1rem;" />
                <a href="<?php echo esc_url(home_url('/')); ?>" class="button button-secondary button-large" target="_blank" style="margin-left:10px;">Xem Website Trực Tiếp ↗</a>
            </p>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($){
        $('.chihoi-upload-btn').click(function(e){
            e.preventDefault();
            var targetInput = $(this).data('target');
            var custom_uploader = wp.media({
                title: 'Chọn Hình Ảnh',
                button: { text: 'Sử Dụng Ảnh Này' },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#' + targetInput).val(attachment.url);
                $('#preview_' + targetInput).find('img').attr('src', attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}


// ==========================================
// 4. QUẢN LÝ LỊCH HẸN & LIÊN HỆ CHUẨN CIH.COM.VN
// ==========================================
function chihoi_register_contact_cpt() {
    register_post_type('contact_message', array(
        'labels' => array(
            'name' => __('Lịch Hẹn & Liên Hệ', 'chihoi'),
            'singular_name' => __('Lịch Hẹn', 'chihoi'),
            'menu_name' => __('Lịch Hẹn & Liên Hệ', 'chihoi'),
            'all_items' => __('Tất Cả Lịch Hẹn & Tin Nhắn', 'chihoi'),
            'view_item' => __('Xem Chi Tiết', 'chihoi'),
            'search_items' => __('Tìm kiếm Lịch hẹn...', 'chihoi'),
            'not_found' => __('Chưa có lịch hẹn hay tin nhắn nào', 'chihoi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => array('title', 'editor'),
        'capabilities' => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap' => true,
    ));
}
add_action('init', 'chihoi_register_contact_cpt');

// Cấu hình các cột hiển thị chuẩn CIH
function chihoi_contact_columns($columns) {
    $new_cols = array(
        'cb' => '<input type="checkbox" />',
        'date' => __('Date', 'chihoi'),
        'title' => __('Họ và tên', 'chihoi'),
        'contact_phone' => __('Số điện thoại', 'chihoi'),
        'contact_email' => __('Email', 'chihoi'),
        'contact_message' => __('Nội dung / Nhu cầu', 'chihoi'),
        'contact_page' => __('Trang đến', 'chihoi'),
        'contact_status' => __('Trạng thái', 'chihoi'),
    );
    return $new_cols;
}
add_filter('manage_contact_message_posts_columns', 'chihoi_contact_columns');

function chihoi_contact_custom_column($column, $post_id) {
    switch ($column) {
        case 'contact_phone':
            $phone = get_post_meta($post_id, '_contact_phone', true);
            echo $phone ? '<a href="tel:' . esc_attr($phone) . '" style="font-weight:700;color:#2C3691;">' . esc_html($phone) . '</a>' : '—';
            break;
            
        case 'contact_email':
            $email = get_post_meta($post_id, '_contact_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
            
        case 'contact_message':
            $content = get_post_field('post_content', $post_id);
            echo esc_html(wp_trim_words($content, 12, '...'));
            break;
            
        case 'contact_page':
            $page = get_post_meta($post_id, '_contact_page', true);
            if ($page) {
                $path = parse_url($page, PHP_URL_PATH);
                echo '<a href="' . esc_url($page) . '" target="_blank" style="color:#0284c7;">' . esc_html($path ? $path : '/') . '</a>';
            } else {
                echo '<span style="color:#94a3b8;">/lien-he/</span>';
            }
            break;
            
        case 'contact_status':
            $status = get_post_meta($post_id, '_contact_status', true);
            if ($status === 'completed') {
                echo '<span style="background:#dcfce7;color:#15803d;padding:4px 8px;border-radius:4px;font-weight:700;font-size:0.8rem;border:1px solid #86efac;">✓ Đã liên hệ</span>';
            } else {
                echo '<span style="background:#fee2e2;color:#b91c1c;padding:4px 8px;border-radius:4px;font-weight:700;font-size:0.8rem;border:1px solid #fca5a5;">● Chưa xử lý</span>';
            }
            break;
    }
}
add_action('manage_contact_message_posts_custom_column', 'chihoi_contact_custom_column', 10, 2);

// Thêm nút [Xuất Excel / CSV] chuẩn như CIH
function chihoi_add_export_button_admin($which) {
    global $typenow;
    if ($typenow === 'contact_message' && $which === 'top') {
        $export_url = admin_url('admin-post.php?action=chihoi_export_contacts');
        echo '<a href="' . esc_url($export_url) . '" class="button button-secondary" style="margin-left:8px;display:inline-flex;align-items:center;gap:4px;font-weight:600;"><span class="dashicons dashicons-download" style="font-size:16px;line-height:26px;"></span> Xuất File Excel (CSV)</a>';
    }
}
add_action('manage_posts_extra_tablenav', 'chihoi_add_export_button_admin');

// Xử lý Xuất file Excel chuẩn UTF-8 BOM
function chihoi_handle_export_contacts() {
    if (!current_user_can('manage_options')) {
        wp_die('Bạn không có quyền thực hiện thao tác này.');
    }
    
    $args = array(
        'post_type' => 'contact_message',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $query = new WP_Query($args);
    
    $filename = 'Danh_Sach_Lich_Hen_ChiHoi_' . date('Y-m-d_H-i') . '.csv';
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    
    $output = fopen('php://output', 'w');
    // Xuất UTF-8 BOM để Excel hiển thị tiếng Việt không bị lỗi font
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, array('STT', 'Ngày Gửi', 'Họ và Tên', 'Số Điện Thoại', 'Email', 'Nội Dung / Yêu Cầu', 'Trang Gửi Đến', 'Trạng Thái'));
    
    $i = 1;
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $name = get_post_meta($id, '_contact_name', true) ?: get_the_title();
            $phone = get_post_meta($id, '_contact_phone', true);
            $email = get_post_meta($id, '_contact_email', true);
            $page = get_post_meta($id, '_contact_page', true) ?: '/lien-he/';
            $status = get_post_meta($id, '_contact_status', true) === 'completed' ? 'Đã liên hệ' : 'Chưa xử lý';
            $message = get_the_content();
            
            fputcsv($output, array($i++, get_the_date('d/m/Y H:i'), $name, $phone, $email, $message, $page, $status));
        }
        wp_reset_postdata();
    }
    
    fclose($output);
    exit;
}
add_action('admin_post_chihoi_export_contacts', 'chihoi_handle_export_contacts');

// Meta Box chi tiết thông tin và Chuyển trạng thái
function chihoi_contact_details_metabox() {
    add_meta_box(
        'chihoi_contact_details',
        'Thông Tin Chi Tiết Lịch Hẹn & Người Gửi',
        'chihoi_render_contact_details_metabox',
        'contact_message',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'chihoi_contact_details_metabox');

function chihoi_render_contact_details_metabox($post) {
    $name = get_post_meta($post->ID, '_contact_name', true) ?: get_the_title();
    $phone = get_post_meta($post->ID, '_contact_phone', true);
    $email = get_post_meta($post->ID, '_contact_email', true);
    $page = get_post_meta($post->ID, '_contact_page', true);
    $ip = get_post_meta($post->ID, '_contact_ip', true);
    $status = get_post_meta($post->ID, '_contact_status', true);
    
    wp_nonce_field('chihoi_save_contact_status', 'chihoi_contact_nonce');
    ?>
    <table class="form-table">
        <tr>
            <th style="width:180px;">Họ và Tên:</th>
            <td><strong style="font-size:1.15rem;color:#1e293b;"><?php echo esc_html($name); ?></strong></td>
        </tr>
        <tr>
            <th>Số Điện Thoại:</th>
            <td><a href="tel:<?php echo esc_attr($phone); ?>" style="font-size:1.2rem;font-weight:700;color:#2C3691;text-decoration:none;">📞 <?php echo esc_html($phone); ?></a></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><a href="mailto:<?php echo esc_attr($email); ?>" style="font-size:1rem;color:#0284c7;">✉️ <?php echo esc_html($email); ?></a></td>
        </tr>
        <tr>
            <th>Trang Khách Gửi Đến:</th>
            <td><a href="<?php echo esc_url($page ?: home_url('/lien-he/')); ?>" target="_blank"><code><?php echo esc_html($page ?: '/lien-he/'); ?></code></a></td>
        </tr>
        <tr>
            <th>Trạng Thái Xử Lý:</th>
            <td>
                <select name="contact_status_update" style="padding:6px 12px;font-weight:600;">
                    <option value="pending" <?php selected($status, 'pending'); ?>>● Chưa xử lý</option>
                    <option value="completed" <?php selected($status, 'completed'); ?>>✓ Đã liên hệ thành công</option>
                </select>
                <span class="description">Chọn trạng thái để theo dõi tiến độ chăm sóc học viên/khách hàng.</span>
            </td>
        </tr>
    </table>
    <?php
}

function chihoi_save_contact_status($post_id) {
    if (!isset($_POST['chihoi_contact_nonce']) || !wp_verify_nonce($_POST['chihoi_contact_nonce'], 'chihoi_save_contact_status')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['contact_status_update'])) {
        update_post_meta($post_id, '_contact_status', sanitize_text_field($_POST['contact_status_update']));
    }
}
add_action('save_post_contact_message', 'chihoi_save_contact_status');

// REST API Tiếp nhận Form Liên Hệ & Lưu vào Database
function chihoi_register_contact_rest_route() {
    register_rest_route('chihoi/v1', '/contact', array(
        'methods' => 'POST',
        'callback' => 'chihoi_handle_contact_submission',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'chihoi_register_contact_rest_route');

function chihoi_handle_contact_submission($request) {
    // 1. Kiểm tra Bẫy Honeypot chống Bot tự động
    if (!empty($params['website_url']) || !empty($params['company_trap'])) {
        return new WP_Error('spam_detected', 'Yêu cầu không hợp lệ.', array('status' => 403));
    }
    
    // 2. Rate Limiting: Giới hạn tối đa 3 lần gửi / 60 giây cho mỗi IP (Chống điền hàng loạt)
    $client_ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $rate_key = 'rate_contact_' . md5($client_ip);
    $attempts = (int) get_transient($rate_key);
    if ($attempts >= 3) {
        return new WP_Error('rate_limit', 'Bạn đang gửi yêu cầu quá nhanh. Vui lòng đợi 1 phút trước khi thử lại.', array('status' => 429));
    }
    set_transient($rate_key, $attempts + 1, 60);
    $params = $request->get_json_params();
    if (empty($params)) {
        $params = $request->get_body_params();
    }
    
    $name = sanitize_text_field($params['name'] ?? '');
    $phone = sanitize_text_field($params['phone'] ?? '');
    $email = sanitize_email($params['email'] ?? '');
    $message = sanitize_textarea_field($params['message'] ?? '');
    $page = esc_url_raw($params['page'] ?? home_url('/lien-he/'));
    
    if (empty($name) || empty($phone) || empty($message)) {
        return new WP_Error('missing_fields', 'Vui lòng điền đầy đủ họ tên, số điện thoại và nội dung.', array('status' => 400));
    }
    
    // 3. Kiểm tra số điện thoại thông minh (Việt Nam 10 số, Quốc tế / WhatsApp + hoặc 00 từ 8-15 số)
    $phone_check = chihoi_validate_phone_number($phone);
    if (!$phone_check['valid']) {
        return new WP_Error('invalid_phone', $phone_check['message'], array('status' => 400));
    }
    $phone = $phone_check['clean'];

    // 4. Kiểm tra Email thông minh (Bắt lỗi gõ nhầm gmaill, kiểm tra DNS MX)
    if (!empty($email)) {
        $email_check = chihoi_validate_real_email($email);
        if (!$email_check['valid']) {
            return new WP_Error('invalid_email', $email_check['message'], array('status' => 400));
        }
    }

    // Lưu vào Database WordPress
    $post_id = wp_insert_post(array(
        'post_title' => $name,
        'post_content' => $message,
        'post_type' => 'contact_message',
        'post_status' => 'publish',
    ));
    
    if (is_wp_error($post_id)) {
        return new WP_Error('db_error', 'Không thể lưu tin nhắn vào cơ sở dữ liệu.', array('status' => 500));
    }
    
    // Lưu Meta Data chi tiết
    update_post_meta($post_id, '_contact_name', $name);
    update_post_meta($post_id, '_contact_phone', $phone);
    update_post_meta($post_id, '_contact_email', $email);
    update_post_meta($post_id, '_contact_page', $page);
    update_post_meta($post_id, '_contact_status', 'pending');
    update_post_meta($post_id, '_contact_ip', $_SERVER['REMOTE_ADDR'] ?? '');
    
    // Gửi email thông báo cho Admin
    $admin_email = get_option('admin_email');
    if ($admin_email) {
        $subject = '[Chi hội Bệnh viện] Lịch hẹn / Liên hệ mới từ: ' . $name;
        $body = "Họ và tên: {$name}\nSố điện thoại: {$phone}\nEmail: {$email}\nTrang gửi đến: {$page}\n\nNội dung yêu cầu:\n{$message}\n\n---\nXem trực tiếp tại: " . admin_url('post.php?post=' . $post_id . '&action=edit');
        @wp_mail($admin_email, $subject, $body);
    }
    
    return array(
        'success' => true,
        'message' => 'Cảm ơn bạn! Thông tin lịch hẹn / liên hệ đã được lưu thành công.',
        'post_id' => $post_id,
    );
}


// ==========================================
// 5. PHÂN HỆ ĐĂNG KÝ NHẬN TIN (NEWSLETTER DATABASE)
// ==========================================
function chihoi_register_newsletter_cpt() {
    register_post_type('newsletter_sub', array(
        'labels' => array(
            'name' => __('Đăng Ký Nhận Tin', 'chihoi'),
            'singular_name' => __('Email Nhận Tin', 'chihoi'),
            'menu_name' => __('Đăng Ký Nhận Tin', 'chihoi'),
            'all_items' => __('Danh Sách Email Đăng Ký', 'chihoi'),
            'search_items' => __('Tìm kiếm Email...', 'chihoi'),
            'not_found' => __('Chưa có ai đăng ký nhận tin', 'chihoi'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-email',
        'supports' => array('title'),
        'capabilities' => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap' => true,
    ));
}
add_action('init', 'chihoi_register_newsletter_cpt');

// Cột hiển thị trong admin
function chihoi_newsletter_columns($columns) {
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Địa Chỉ Email Đăng Ký', 'chihoi'),
        'sub_ip' => __('Địa Chỉ IP', 'chihoi'),
        'date' => __('Thời Gian Đăng Ký', 'chihoi'),
    );
}
add_filter('manage_newsletter_sub_posts_columns', 'chihoi_newsletter_columns');

function chihoi_newsletter_custom_column($column, $post_id) {
    if ($column === 'sub_ip') {
        $ip = get_post_meta($post_id, '_sub_ip', true);
        echo '<code>' . esc_html($ip ?: '—') . '</code>';
    }
}
add_action('manage_newsletter_sub_posts_custom_column', 'chihoi_newsletter_custom_column', 10, 2);

// Nút Xuất Excel cho Newsletter
function chihoi_add_export_newsletter_button($which) {
    global $typenow;
    if ($typenow === 'newsletter_sub' && $which === 'top') {
        $export_url = admin_url('admin-post.php?action=chihoi_export_newsletter');
        echo '<a href="' . esc_url($export_url) . '" class="button button-secondary" style="margin-left:8px;display:inline-flex;align-items:center;gap:4px;font-weight:600;"><span class="dashicons dashicons-download" style="font-size:16px;line-height:26px;"></span> Xuất Danh Sách Email (CSV)</a>';
    }
}
add_action('manage_posts_extra_tablenav', 'chihoi_add_export_newsletter_button');

// Xử lý Xuất file Excel Newsletter UTF-8 BOM
function chihoi_handle_export_newsletter() {
    if (!current_user_can('manage_options')) {
        wp_die('Bạn không có quyền thực hiện thao tác này.');
    }
    
    $query = new WP_Query(array(
        'post_type' => 'newsletter_sub',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    
    $filename = 'Danh_Sach_Email_Nhan_Tin_' . date('Y-m-d_H-i') . '.csv';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    
    $output = fopen('php://output', 'w');
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    fputcsv($output, array('STT', 'Địa Chỉ Email', 'Ngày Đăng Ký', 'Địa Chỉ IP'));
    
    $i = 1;
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $email = get_the_title();
            $ip = get_post_meta($id, '_sub_ip', true) ?: '—';
            fputcsv($output, array($i++, $email, get_the_date('d/m/Y H:i'), $ip));
        }
        wp_reset_postdata();
    }
    fclose($output);
    exit;
}
add_action('admin_post_chihoi_export_newsletter', 'chihoi_handle_export_newsletter');

// REST API Đăng Ký Nhận Tin
function chihoi_register_newsletter_rest_route() {
    register_rest_route('chihoi/v1', '/newsletter', array(
        'methods' => 'POST',
        'callback' => 'chihoi_handle_newsletter_submission',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'chihoi_register_newsletter_rest_route');


// Hàm kiểm tra tính hợp lệ & chống gõ sai email (Ví dụ: gmaill.com, yaho.com...)

// Hàm kiểm tra tính hợp lệ số điện thoại (Hỗ trợ cả Việt Nam và Quốc tế / WhatsApp)
function chihoi_validate_phone_number($phone) {
    // Loại bỏ toàn bộ khoảng trắng, dấu gạch ngang, dấu chấm
    $clean = preg_replace('/[\s\-\.]/', '', trim($phone));
    
    if (empty($clean)) {
        return array('valid' => false, 'message' => 'Vui lòng nhập số điện thoại.');
    }
    
    // Trường hợp 1: Số điện thoại Quốc tế / WhatsApp (Bắt đầu bằng dấu + hoặc 00)
    if (str_starts_with($clean, '+') || str_starts_with($clean, '00')) {
        $digits = preg_replace('/[^0-9]/', '', $clean);
        // Chuẩn viễn thông quốc tế ITU-T E.164: từ 8 đến 15 chữ số
        if (strlen($digits) < 8) {
            return array('valid' => false, 'message' => 'Số điện thoại quốc tế / WhatsApp quá ngắn (tối thiểu 8 chữ số).');
        }
        if (strlen($digits) > 15) {
            return array('valid' => false, 'message' => 'Số điện thoại quốc tế / WhatsApp quá dài (tối đa 15 chữ số).');
        }
        return array('valid' => true, 'clean' => $clean);
    }
    
    // Trường hợp 2: Số điện thoại Việt Nam
    if (!str_starts_with($clean, '0')) {
        return array('valid' => false, 'message' => 'Số điện thoại trong nước phải bắt đầu bằng số 0 (hoặc nhập mã quốc tế dạng +84...).');
    }
    
    $len = strlen($clean);
    if ($len < 10) {
        return array('valid' => false, 'message' => 'Số điện thoại đang bị thiếu số (' . $len . '/10 số). Số điện thoại Việt Nam phải có đủ 10 chữ số.');
    }
    if ($len > 10) {
        return array('valid' => false, 'message' => 'Số điện thoại quá dài (' . $len . ' số). Số điện thoại Việt Nam chỉ gồm 10 chữ số.');
    }
    
    // Kiểm tra đầu số nhà mạng hợp lệ (02: cố định, 03, 05, 07, 08, 09: di động)
    $prefix = substr($clean, 0, 2);
    $valid_prefixes = array('02', '03', '05', '07', '08', '09');
    if (!in_array($prefix, $valid_prefixes)) {
        return array('valid' => false, 'message' => 'Đầu số "' . $prefix . '" không hợp lệ tại Việt Nam. Vui lòng kiểm tra lại.');
    }
    
    return array('valid' => true, 'clean' => $clean);
}

function chihoi_validate_real_email($email) {
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array('valid' => false, 'message' => 'Địa chỉ email không đúng định dạng (Ví dụ đúng: bacsi@gmail.com).');
    }

    $parts = explode('@', $email);
    if (count($parts) !== 2) {
        return array('valid' => false, 'message' => 'Email phải có ký tự @ và tên miền hợp lệ.');
    }

    $domain = strtolower(trim($parts[1]));

    // Danh sách các tên miền thường bị gõ sai chính tả
    $typo_domains = array(
        'gmaill.com' => 'gmail.com',
        'gamil.com'  => 'gmail.com',
        'gmial.com'  => 'gmail.com',
        'gmai.com'   => 'gmail.com',
        'gmaik.com'  => 'gmail.com',
        'gmal.com'   => 'gmail.com',
        'gmai.vn'    => 'gmail.com',
        'yaho.com'   => 'yahoo.com',
        'yahooo.com' => 'yahoo.com',
        'yaho.com.vn'=> 'yahoo.com.vn',
        'hotmial.com'=> 'hotmail.com',
        'hotmai.com' => 'hotmail.com',
        'outlok.com' => 'outlook.com',
        'outloo.com' => 'outlook.com',
        'icoud.com'  => 'icloud.com',
    );

    if (isset($typo_domains[$domain])) {
        $suggest = $parts[0] . '@' . $typo_domains[$domain];
        return array(
            'valid' => false,
            'message' => 'Có vẻ bạn gõ nhầm tên miền "@' . $domain . '". Có phải bạn muốn nhập: ' . $suggest . '?'
        );
    }

    // Kiểm tra bản ghi MX thực tế của tên miền trên Internet
    if (function_exists('checkdnsrr')) {
        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            return array(
                'valid' => false,
                'message' => 'Tên miền email "@' . $domain . '" không tồn tại hoặc không thể nhận thư. Vui lòng kiểm tra lại.'
            );
        }
    }

    return array('valid' => true);
}

function chihoi_handle_newsletter_submission($request) {
    // 1. Kiểm tra Bẫy Honeypot chống Bot tự động
    if (!empty($params['website_url']) || !empty($params['company_trap'])) {
        return new WP_Error('spam_detected', 'Yêu cầu không hợp lệ.', array('status' => 403));
    }
    
    // 2. Rate Limiting chống spam newsletter
    $client_ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $rate_key = 'rate_newsletter_' . md5($client_ip);
    $attempts = (int) get_transient($rate_key);
    if ($attempts >= 3) {
        return new WP_Error('rate_limit', 'Bạn thao tác quá nhanh. Vui lòng thử lại sau 1 phút.', array('status' => 429));
    }
    set_transient($rate_key, $attempts + 1, 60);
    $params = $request->get_json_params() ?: $request->get_body_params();
    $email = sanitize_email($params['email'] ?? '');
    
    $val_result = chihoi_validate_real_email($email);
    if (!$val_result['valid']) {
        return new WP_Error('invalid_email', $val_result['message'], array('status' => 400));
    }
    
    // Kiểm tra trùng email
    $existing = get_posts(array(
        'post_type' => 'newsletter_sub',
        'title' => $email,
        'post_status' => 'publish',
        'posts_per_page' => 1,
    ));
    
    if (!empty($existing)) {
        return array(
            'success' => true,
            'message' => 'Email của bạn đã có trong danh sách nhận tin của Chi hội.',
        );
    }
    
    $post_id = wp_insert_post(array(
        'post_title' => $email,
        'post_type' => 'newsletter_sub',
        'post_status' => 'publish',
    ));
    
    if (is_wp_error($post_id)) {
        return new WP_Error('db_error', 'Không thể lưu thông tin vào cơ sở dữ liệu.', array('status' => 500));
    }
    
    update_post_meta($post_id, '_sub_ip', $_SERVER['REMOTE_ADDR'] ?? '');
    
    return array(
        'success' => true,
        'message' => 'Cảm ơn bạn! Đã đăng ký nhận bản tin Chi hội thành công.',
    );
}


// ==========================================
// 6. CÁC LỚP BẢO MẬT & CHỐNG HACKER CHUYÊN SÂU
// ==========================================

// 1. Giấu phiên bản WordPress khỏi mã nguồn HTML (Chống bot dò lỗi theo version)
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// 2. Chặn hoàn toàn tính năng XML-RPC (Chống tấn công brute-force password & DDoS)
add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', function($methods) {
    return array();
});

// 3. Chặn lộ danh sách User/Tài khoản qua REST API (/wp-json/wp/v2/users)
add_filter('rest_endpoints', function($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        if (!current_user_can('list_users')) {
            unset($endpoints['/wp/v2/users']);
            unset($endpoints['/wp/v2/users/(?P<id>[\\d]+)']);
        }
    }
    return $endpoints;
});

// 4. Chặn kỹ thuật quét tên đăng nhập qua tham số ?author=N
add_action('template_redirect', function() {
    if (is_author()) {
        wp_redirect(home_url('/'), 301);
        exit;
    }
});

// 5. Xóa các header nhạy cảm và thông tin phiên bản
function chihoi_remove_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY) ?? '', $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'chihoi_remove_version_strings');
add_filter('style_loader_src', 'chihoi_remove_version_strings');
