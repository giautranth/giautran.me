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

// Enqueue Styles & Scripts
function chihoi_enqueue_scripts() {
    wp_enqueue_style('chihoi-google-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans:wght@400;500;600;700&display=swap', array(), null);
    wp_enqueue_style('chihoi-main-style', get_template_directory_uri() . '/css/style.css', array(), '1.0.0');
    wp_enqueue_style('chihoi-theme-style', get_stylesheet_uri(), array('chihoi-main-style'), '1.0.0');
    wp_enqueue_script('chihoi-main-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
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

// Custom Options Page for Chi Hoi Settings
function chihoi_admin_menu() {
    add_menu_page(
        'Cấu Hình Chi Hội',
        'Cấu Hình Chi Hội',
        'manage_options',
        'chihoi-settings',
        'chihoi_settings_page_html',
        'dashicons-plus-alt',
        20
    );
}
add_action('admin_menu', 'chihoi_admin_menu');

function chihoi_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1 style="color:#2C3691;">Cấu Hình Cổng Thông Tin Chi Hội Bệnh Viện Tư Nhân</h1>
        <div style="background:#fff;padding:24px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.05);margin-top:16px;max-width:800px;">
            <h2 style="color:#e22b27;">Thông Tin Thường Trực & Đường Dây Nóng</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">Chủ tịch Chi hội</th>
                    <td><strong>Madam Trần Thị Lâm</strong> (Chủ tịch sáng lập Tập đoàn Hoa Lâm)</td>
                </tr>
                <tr>
                    <th scope="row">Phó Chủ tịch Thường trực</th>
                    <td><strong>ThS.BS. Trần Quốc Thành</strong> (Giám đốc Điều hành BV Quốc tế City & BV Gia An 115)</td>
                </tr>
                <tr>
                    <th scope="row">Hotline 24/7</th>
                    <td><input type="text" value="1900 8146" class="regular-text" readonly /></td>
                </tr>
                <tr>
                    <th scope="row">Địa chỉ Trụ sở Văn phòng</th>
                    <td>Số 3 Đường 17A, Khu Y tế Kỹ thuật cao, P. An Lạc, Q. Bình Tân, TP. HCM</td>
                </tr>
            </table>
            <p><a href="<?php echo esc_url(home_url('/')); ?>" class="button button-primary" target="_blank">Xem Website Trực Tiếp</a></p>
        </div>
    </div>
    <?php
}
