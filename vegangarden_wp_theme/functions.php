<?php

/**

 * Vegan Garden Berlin Theme Functions

 */



if (!defined('ABSPATH')) {

    exit;

}



function vegangarden_setup() {

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(

        'primary' => __('Primary Menu', 'vegangarden')

    ));

}

add_action('after_setup_theme', 'vegangarden_setup');



function vegangarden_scripts() {

    // Google Fonts

    wp_enqueue_style('vegangarden-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap', array(), null);

    

    // Font Awesome

    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');

    

    // Main Stylesheet
    wp_enqueue_style('vegangarden-main', get_template_directory_uri() . '/styles.css', array(), '20260925_arrow_translucent');
    wp_enqueue_style('vegangarden-theme', get_stylesheet_uri(), array('vegangarden-main'), '1.1.3');



    // Main Script

    wp_enqueue_script('vegangarden-script', get_template_directory_uri() . '/script.js', array(), '20260919_01', true);

}

add_action('wp_enqueue_scripts', 'vegangarden_scripts');



// ============================================

// SECURITY HARDENING (FULL)

// ============================================



// --- A. CHỐNG TẤN CÔNG BRUTE-FORCE & AI BOT ---



// 1. Disable XML-RPC completely

add_filter('xmlrpc_enabled', '__return_false');

add_filter('xmlrpc_methods', function () {

    return array();

});



// 2. Remove XML-RPC link from HTML head

remove_action('wp_head', 'rsd_link');

remove_action('wp_head', 'wlwmanifest_link');



// 3. Limit login attempts (block IP after 5 failed attempts for 30 minutes)

add_filter('authenticate', function ($user, $username, $password) {

    if (empty($username)) return $user;

    $ip = $_SERVER['REMOTE_ADDR'];

    $transient_key = 'login_attempts_' . md5($ip);

    $attempts = get_transient($transient_key);

    if ($attempts !== false && $attempts >= 5) {

        return new WP_Error('too_many_attempts',

            '<strong>Sicherheit:</strong> Zu viele fehlgeschlagene Anmeldeversuche. Bitte versuchen Sie es in 30 Minuten erneut.');

    }

    return $user;

}, 30, 3);



add_action('wp_login_failed', function ($username) {

    $ip = $_SERVER['REMOTE_ADDR'];

    $transient_key = 'login_attempts_' . md5($ip);

    $attempts = get_transient($transient_key);

    if ($attempts === false) {

        set_transient($transient_key, 1, 30 * MINUTE_IN_SECONDS);

    } else {

        set_transient($transient_key, $attempts + 1, 30 * MINUTE_IN_SECONDS);

    }

});



// --- B. ẨN THÔNG TIN WORDPRESS ---



// 4. Remove WordPress version from HTML head & feeds

remove_action('wp_head', 'wp_generator');

add_filter('the_generator', '__return_empty_string');



// 5. Remove version from CSS/JS urls

add_filter('style_loader_src', 'vegangarden_remove_ver', 9999);

add_filter('script_loader_src', 'vegangarden_remove_ver', 9999);

function vegangarden_remove_ver($src) {

    if (strpos($src, 'ver=') !== false && strpos($src, home_url()) === false) {

        $src = remove_query_arg('ver', $src);

    }

    return $src;

}



// 6. Block REST API user enumeration

add_filter('rest_endpoints', function ($endpoints) {

    if (isset($endpoints['/wp/v2/users'])) {

        unset($endpoints['/wp/v2/users']);

    }

    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {

        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);

    }

    return $endpoints;

});



// 7. Block user enumeration via ?author=1

add_action('template_redirect', function () {

    if (is_author()) {

        wp_redirect(home_url('/'), 301);

        exit;

    }

});



// 8. Remove unnecessary meta tags from head

remove_action('wp_head', 'rsd_link');

remove_action('wp_head', 'wlwmanifest_link');

remove_action('wp_head', 'wp_shortlink_wp_head');

remove_action('wp_head', 'rest_output_link_wp_head');

remove_action('wp_head', 'wp_oembed_add_discovery_links');

remove_action('wp_head', 'feed_links', 2);

remove_action('wp_head', 'feed_links_extra', 3);



// 9. Disable wp-emoji scripts (performance + reduces fingerprint)

remove_action('wp_head', 'print_emoji_detection_script', 7);

remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');

remove_action('admin_print_styles', 'print_emoji_styles');



// --- C. CHỐNG MÃ ĐỘC & INJECTION ---



// 10. Disable file editor in wp-admin (prevents code injection if admin hacked)

if (!defined('DISALLOW_FILE_EDIT')) {

    define('DISALLOW_FILE_EDIT', true);

}



// 11. Block PHP execution in uploads directory

add_action('init', function () {

    if (preg_match('#/wp-content/uploads/.*\.php#i', $_SERVER['REQUEST_URI'])) {

        status_header(403);

        exit('Forbidden');

    }

});



// 12. Block suspicious query strings (SQL injection, path traversal, AI scraping)

add_action('init', function () {

    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

    $query_string = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

    

    $blocked_patterns = array(

        'eval\(',

        'base64_',

        'GLOBALS\[',

        '_REQUEST\[',

        'proc/self/environ',

        'mosConfig_',

        '<script',

        'etc/passwd',

        'boot\.ini',

        '\.\.\/',

        'wp-config\.php',

    );

    

    foreach ($blocked_patterns as $pattern) {

        if (preg_match('/' . $pattern . '/i', $request_uri . $query_string)) {

            status_header(403);

            exit('Forbidden');

        }

    }

});



// 13. Block known malicious bots & AI scrapers

add_action('init', function () {

    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';

    $bad_bots = array(

        'sqlmap', 'nikto', 'nmap', 'masscan', 'zmeu', 'morfeus',

        'havij', 'w3af', 'nessus', 'openvas', 'dirbuster',

        'gobuster', 'wpscan', 'nuclei', 'httpx',

    );

    foreach ($bad_bots as $bot) {

        if (strpos($user_agent, $bot) !== false) {

            status_header(403);

            exit('Forbidden');

        }

    }

});



// --- D. CHỐNG SPAM & ĐÓNG CHỨC NĂNG KHÔNG CẦN ---



// 14. Disable comments completely (restaurant doesn't need WP comments)

add_action('admin_init', function () {

    $post_types = get_post_types();

    foreach ($post_types as $post_type) {

        if (post_type_supports($post_type, 'comments')) {

            remove_post_type_support($post_type, 'comments');

            remove_post_type_support($post_type, 'trackbacks');

        }

    }

});

add_filter('comments_open', '__return_false', 20, 2);

add_filter('pings_open', '__return_false', 20, 2);

add_filter('comments_array', '__return_empty_array', 10, 2);

add_action('admin_menu', function () {

    remove_menu_page('edit-comments.php');

});



// --- E. SECURITY HEADERS ---



// 15. Comprehensive security headers

add_action('send_headers', function () {

    header('X-Content-Type-Options: nosniff');

    header('X-XSS-Protection: 1; mode=block');

    header('X-Frame-Options: SAMEORIGIN');

    header('Referrer-Policy: strict-origin-when-cross-origin');

    header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(), usb=()');

    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');

});



// --- F. WORDPRESS FRONTEND CLEANUP ---



// 16. Hide admin bar on frontend (prevents mobile scroll conflicts)

add_filter('show_admin_bar', '__return_false');



// 17. Dequeue unnecessary WordPress block styles (reduces conflicts with theme CSS)

add_action('wp_enqueue_scripts', function () {

    wp_dequeue_style('wp-block-library');

    wp_dequeue_style('wp-block-library-theme');

    wp_dequeue_style('global-styles');

    wp_dequeue_style('classic-theme-styles');

}, 100);



// ============================================
// CMS ADMIN LOCALIZATION HELPER (VI / DE / EN)
// ============================================

function vg_get_admin_lang() {
    $locale = '';
    if (function_exists('determine_locale')) {
        $locale = determine_locale();
    } elseif (function_exists('get_user_locale')) {
        $locale = get_user_locale();
    } elseif (function_exists('get_locale')) {
        $locale = get_locale();
    }
    if (strpos($locale, 'vi') === 0) {
        return 'vi';
    } elseif (strpos($locale, 'de') === 0) {
        return 'de';
    }
    return 'en';
}

function vg_admin_i18n($key, $default = '') {
    $lang = vg_get_admin_lang();
    static $dict = array(
        // Restaurant Info
        'menu_restaurant_info' => array('vi' => 'Thông tin nhà hàng', 'de' => 'Restaurant-Info', 'en' => 'Restaurant Info'),
        'title_restaurant_info' => array('vi' => 'Cài Đặt Toàn Bộ Website (Site Settings)', 'de' => 'Website-Einstellungen (Site Settings)', 'en' => 'Website Settings (Site Settings)'),

        // Banner CPT
        'banner_name' => array('vi' => 'Banner', 'de' => 'Banner', 'en' => 'Banners'),
        'banner_singular' => array('vi' => 'Banner', 'de' => 'Banner', 'en' => 'Banner'),
        'banner_menu' => array('vi' => 'Banner', 'de' => 'Banner', 'en' => 'Banners'),
        'banner_all' => array('vi' => 'Tất cả Banner', 'de' => 'Alle Banner', 'en' => 'All Banners'),
        'banner_add_new' => array('vi' => 'Thêm Banner mới', 'de' => 'Neuen Banner hinzufügen', 'en' => 'Add New Banner'),
        'banner_edit' => array('vi' => 'Chỉnh sửa Banner', 'de' => 'Banner bearbeiten', 'en' => 'Edit Banner'),
        'banner_not_found' => array('vi' => 'Không tìm thấy banner nào', 'de' => 'Keine Banner gefunden', 'en' => 'No banners found'),

        // Speisekarte / Dishes CPT
        'dish_name' => array('vi' => 'Món ăn', 'de' => 'Speisekarte', 'en' => 'Dishes'),
        'dish_singular' => array('vi' => 'Món ăn', 'de' => 'Gericht', 'en' => 'Dish'),
        'dish_menu' => array('vi' => 'Thực đơn', 'de' => 'Speisekarte', 'en' => 'Menu'),
        'dish_all' => array('vi' => 'Tất cả món ăn', 'de' => 'Alle Gerichte', 'en' => 'All Dishes'),
        'dish_add_new' => array('vi' => 'Thêm món mới', 'de' => 'Neues Gericht hinzufügen', 'en' => 'Add New Dish'),
        'dish_edit' => array('vi' => 'Chỉnh sửa món ăn', 'de' => 'Gericht bearbeiten', 'en' => 'Edit Dish'),
        'dish_not_found' => array('vi' => 'Không tìm thấy món ăn nào', 'de' => 'Keine Gerichte gefunden', 'en' => 'No dishes found'),

        // Reviews CPT
        'review_name' => array('vi' => 'Đánh giá', 'de' => 'Bewertungen', 'en' => 'Reviews'),
        'review_singular' => array('vi' => 'Đánh giá', 'de' => 'Bewertung', 'en' => 'Review'),
        'review_menu' => array('vi' => 'Đánh giá', 'de' => 'Bewertungen', 'en' => 'Reviews'),
        'review_all' => array('vi' => 'Tất cả đánh giá', 'de' => 'Alle Bewertungen', 'en' => 'All Reviews'),
        'review_add_new' => array('vi' => 'Thêm đánh giá mới', 'de' => 'Neue Bewertung hinzufügen', 'en' => 'Add New Review'),
        'review_edit' => array('vi' => 'Chỉnh sửa đánh giá', 'de' => 'Bewertung bearbeiten', 'en' => 'Edit Review'),
        'review_not_found' => array('vi' => 'Không tìm thấy đánh giá nào', 'de' => 'Keine Bewertungen gefunden', 'en' => 'No reviews found'),

        // Gallery CPT
        'gallery_name' => array('vi' => 'Thư viện ảnh', 'de' => 'Galerie', 'en' => 'Gallery'),
        'gallery_singular' => array('vi' => 'Hình ảnh', 'de' => 'Foto', 'en' => 'Photo'),
        'gallery_menu' => array('vi' => 'Thư viện ảnh', 'de' => 'Galerie', 'en' => 'Gallery'),
        'gallery_all' => array('vi' => 'Tất cả hình ảnh', 'de' => 'Alle Fotos', 'en' => 'All Photos'),
        'gallery_add_new' => array('vi' => 'Thêm ảnh mới', 'de' => 'Neues Foto hinzufügen', 'en' => 'Add New Photo'),
        'gallery_edit' => array('vi' => 'Chỉnh sửa ảnh', 'de' => 'Foto bearbeiten', 'en' => 'Edit Photo'),
        'gallery_not_found' => array('vi' => 'Không tìm thấy ảnh nào', 'de' => 'Keine Fotos gefunden', 'en' => 'No photos found'),

        // Reservierungen CPT
        'reservation_name' => array('vi' => 'Đặt bàn', 'de' => 'Reservierungen', 'en' => 'Reservations'),
        'reservation_singular' => array('vi' => 'Đặt bàn', 'de' => 'Reservierung', 'en' => 'Reservation'),
        'reservation_menu' => array('vi' => 'Đặt bàn', 'de' => 'Reservierungen', 'en' => 'Reservations'),
        'reservation_all' => array('vi' => 'Tất cả đặt bàn', 'de' => 'Alle Reservierungen', 'en' => 'All Reservations'),
        'reservation_view' => array('vi' => 'Xem chi tiết đặt bàn', 'de' => 'Reservierung ansehen', 'en' => 'View Reservation'),
        'reservation_search' => array('vi' => 'Tìm kiếm đặt bàn', 'de' => 'Reservierungen suchen', 'en' => 'Search Reservations'),
        'reservation_not_found' => array('vi' => 'Không có lịch đặt bàn nào', 'de' => 'Keine Reservierungen gefunden', 'en' => 'No reservations found'),

        // Contact Messages CPT
        'message_name' => array('vi' => 'Tin nhắn', 'de' => 'Nachrichten', 'en' => 'Messages'),
        'message_singular' => array('vi' => 'Tin nhắn', 'de' => 'Nachricht', 'en' => 'Message'),
        'message_menu' => array('vi' => 'Tin nhắn', 'de' => 'Nachrichten', 'en' => 'Messages'),
        'message_all' => array('vi' => 'Tất cả tin nhắn', 'de' => 'Alle Nachrichten', 'en' => 'All Messages'),
        'message_view' => array('vi' => 'Xem chi tiết tin nhắn', 'de' => 'Nachricht ansehen', 'en' => 'View Message'),
        'message_search' => array('vi' => 'Tìm kiếm tin nhắn', 'de' => 'Nachrichten suchen', 'en' => 'Search Messages'),
        'message_not_found' => array('vi' => 'Không có tin nhắn nào', 'de' => 'Keine Nachrichten gefunden', 'en' => 'No messages found'),

        // Table Columns
        'col_preview' => array('vi' => 'Xem trước (Desktop / Mobile)', 'de' => 'Vorschau (Desktop / Mobil)', 'en' => 'Preview (Desktop / Mobile)'),
        'col_title' => array('vi' => 'Tiêu đề', 'de' => 'Titel', 'en' => 'Title'),
        'col_dish_name' => array('vi' => 'Tên món ăn', 'de' => 'Gerichtname', 'en' => 'Dish Name'),
        'col_price' => array('vi' => 'Giá tiền', 'de' => 'Preis', 'en' => 'Price'),
        'col_status' => array('vi' => 'Trạng thái', 'de' => 'Status', 'en' => 'Status'),
        'col_order' => array('vi' => 'Thứ tự', 'de' => 'Reihenfolge', 'en' => 'Order'),
        'col_date' => array('vi' => 'Ngày tạo', 'de' => 'Datum', 'en' => 'Date'),
        'col_reviewer' => array('vi' => 'Khách hàng', 'de' => 'Kunde / Name', 'en' => 'Reviewer'),
        'col_stars' => array('vi' => 'Số sao', 'de' => 'Sterne', 'en' => 'Stars'),
        'col_content' => array('vi' => 'Nội dung đánh giá', 'de' => 'Bewertungstext', 'en' => 'Review Text'),
        'col_photo' => array('vi' => 'Hình ảnh', 'de' => 'Foto', 'en' => 'Photo'),
        'col_sender' => array('vi' => 'Người gửi', 'de' => 'Absender', 'en' => 'Sender'),
        'col_phone' => array('vi' => 'Số điện thoại', 'de' => 'Telefon', 'en' => 'Phone'),
        'col_email' => array('vi' => 'Email', 'de' => 'E-Mail', 'en' => 'Email'),
        'col_message' => array('vi' => 'Nội dung tin nhắn', 'de' => 'Nachricht', 'en' => 'Message'),
        'col_datetime' => array('vi' => '📅 Ngày & Giờ ăn', 'de' => '📅 Datum & Uhrzeit', 'en' => '📅 Date & Time'),
        'col_guests' => array('vi' => '👥 Số lượng khách', 'de' => '👥 Personen', 'en' => '👥 Guests'),

        // Buttons
        'btn_export_res' => array('vi' => 'Xuất dữ liệu Đặt bàn (Excel/CSV)', 'de' => 'Reservierungen exportieren (Excel/CSV)', 'en' => 'Export Reservations (Excel/CSV)'),
        'btn_export_msg' => array('vi' => 'Xuất dữ liệu Tin nhắn (Excel/CSV)', 'de' => 'Nachrichten exportieren (Excel/CSV)', 'en' => 'Export Messages (Excel/CSV)'),
    );

    if (isset($dict[$key][$lang])) {
        return $dict[$key][$lang];
    }
    return $default ?: $key;
}

// Localize admin navigation menu & submenu titles dynamically across all languages
add_action('admin_menu', function () {
    global $menu, $submenu;
    if (!is_admin() || empty($menu)) return;

    $mappings = array(
        'vg-restaurant-settings'            => vg_admin_i18n('menu_restaurant_info'),
        'edit.php?post_type=vg_banner'      => vg_admin_i18n('banner_menu'),
        'edit.php?post_type=vg_dish'        => vg_admin_i18n('dish_menu'),
        'edit.php?post_type=vg_review'      => vg_admin_i18n('review_menu'),
        'edit.php?post_type=vg_gallery'     => vg_admin_i18n('gallery_menu'),
        'edit.php?post_type=vg_reservation' => vg_admin_i18n('reservation_menu'),
        'edit.php?post_type=contact_message'=> vg_admin_i18n('message_menu'),
    );

    foreach ($menu as $k => $item) {
        if (isset($item[2]) && isset($mappings[$item[2]])) {
            $menu[$k][0] = $mappings[$item[2]];
        }
    }

    $sub_mappings = array(
        'edit.php?post_type=vg_banner' => array(
            'edit.php?post_type=vg_banner' => vg_admin_i18n('banner_all'),
            'post-new.php?post_type=vg_banner' => vg_admin_i18n('banner_add_new'),
        ),
        'edit.php?post_type=vg_dish' => array(
            'edit.php?post_type=vg_dish' => vg_admin_i18n('dish_all'),
            'post-new.php?post_type=vg_dish' => vg_admin_i18n('dish_add_new'),
        ),
        'edit.php?post_type=vg_review' => array(
            'edit.php?post_type=vg_review' => vg_admin_i18n('review_all'),
            'post-new.php?post_type=vg_review' => vg_admin_i18n('review_add_new'),
        ),
        'edit.php?post_type=vg_gallery' => array(
            'edit.php?post_type=vg_gallery' => vg_admin_i18n('gallery_all'),
            'post-new.php?post_type=vg_gallery' => vg_admin_i18n('gallery_add_new'),
        ),
        'edit.php?post_type=vg_reservation' => array(
            'edit.php?post_type=vg_reservation' => vg_admin_i18n('reservation_all'),
        ),
        'edit.php?post_type=contact_message' => array(
            'edit.php?post_type=contact_message' => vg_admin_i18n('message_all'),
        ),
    );

    foreach ($sub_mappings as $parent_slug => $items) {
        if (isset($submenu[$parent_slug])) {
            foreach ($submenu[$parent_slug] as $sub_k => $sub_item) {
                if (isset($sub_item[2]) && isset($items[$sub_item[2]])) {
                    $submenu[$parent_slug][$sub_k][0] = $items[$sub_item[2]];
                }
            }
        }
    }
}, 990);

// ============================================
// BANNER MANAGEMENT (CMS)
// ============================================

// Register Banner custom post type
add_action('init', function () {
    register_post_type('vg_banner', array(
        'labels' => array(
            'name'               => vg_admin_i18n('banner_name', 'Banners'),
            'singular_name'      => vg_admin_i18n('banner_singular', 'Banner'),
            'menu_name'          => vg_admin_i18n('banner_menu', 'Banners'),
            'add_new'            => vg_admin_i18n('banner_add_new', 'Add New Banner'),
            'add_new_item'       => vg_admin_i18n('banner_add_new', 'Add New Banner'),
            'edit_item'          => vg_admin_i18n('banner_edit', 'Edit Banner'),
            'all_items'          => vg_admin_i18n('banner_all', 'All Banners'),
            'not_found'          => vg_admin_i18n('banner_not_found', 'No banners found'),
        ),

        'public'             => false,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'menu_position'      => 5,

        'menu_icon'          => 'dashicons-format-image',

        'supports'           => array('title', 'thumbnail'),

        'capability_type'    => 'post',

        'has_archive'        => false,

    ));

});



// Enqueue WP Media library on vg_banner edit screen
add_action('admin_enqueue_scripts', function ($hook) {
    global $post_type;
    if ($post_type === 'vg_banner') {
        wp_enqueue_media();
    }
});

// Add meta boxes for Banner settings
add_action('add_meta_boxes', function () {
    add_meta_box('vg_banner_settings', 'Cài đặt Banner (Desktop & Mobile)', 'vg_banner_meta_box', 'vg_banner', 'normal', 'high');
});

function vg_banner_meta_box($post) {
    wp_nonce_field('vg_banner_meta', 'vg_banner_nonce');

    // Retrieve desktop image & id
    $desktop_img = get_post_meta($post->ID, '_banner_desktop_img', true);
    $desktop_id  = get_post_meta($post->ID, '_banner_desktop_id', true);
    if (!$desktop_img && has_post_thumbnail($post->ID)) {
        $desktop_img = get_the_post_thumbnail_url($post->ID, 'full');
        $desktop_id  = get_post_thumbnail_id($post->ID);
    }

    // Retrieve mobile image & id
    $mobile_img  = get_post_meta($post->ID, '_banner_mobile_img', true);
    $mobile_id   = get_post_meta($post->ID, '_banner_mobile_id', true);

    $order       = get_post_meta($post->ID, '_banner_order', true);
    $active      = get_post_meta($post->ID, '_banner_active', true);
    $link        = get_post_meta($post->ID, '_banner_link', true);

    if ($order === '') $order = 0;
    if ($active === '') $active = '1';
    ?>
    <style>
        .vg-banner-box-wrap {
            margin: 6px 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        }
        .vg-banner-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }
        @media (max-width: 860px) {
            .vg-banner-grid { grid-template-columns: 1fr; }
        }
        .vg-banner-card {
            background: #ffffff;
            border: 1px solid #ccd0d4;
            border-radius: 10px;
            padding: 18px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
            transition: border-color 0.2s;
        }
        .vg-banner-card:hover {
            border-color: #2271b1;
        }
        .vg-banner-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f1;
        }
        .vg-banner-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #1d2327;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .vg-banner-badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 4px;
            background: #e7f3fe;
            color: #135e96;
        }
        .vg-banner-badge-mobile {
            background: #f0f6ec;
            color: #385a26;
        }
        .vg-img-preview-box {
            width: 100%;
            height: 200px;
            background: #f6f7f7;
            border: 2px dashed #dcdcde;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            margin-bottom: 14px;
        }
        .vg-img-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .vg-empty-placeholder {
            text-align: center;
            color: #8c8f94;
            font-size: 13px;
        }
        .vg-empty-placeholder .dashicons {
            font-size: 40px;
            width: 40px;
            height: 40px;
            margin-bottom: 6px;
            color: #c3c4c7;
        }
        .vg-banner-card-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: auto;
        }
        .vg-banner-hint {
            font-size: 12px;
            color: #646970;
            margin-top: 10px;
            line-height: 1.45;
        }
        .vg-setting-row {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 14px 0;
            border-top: 1px solid #f0f0f1;
        }
        .vg-setting-label {
            width: 220px;
            font-weight: 600;
            color: #1d2327;
            font-size: 13px;
        }
        .vg-setting-field {
            flex: 1;
        }
        .vg-toggle-switch {
            position: relative;
            display: inline-block;
            width: 46px;
            height: 24px;
            vertical-align: middle;
        }
        .vg-toggle-switch input { opacity: 0; width: 0; height: 0; }
        .vg-toggle-track {
            position: absolute; cursor: pointer; inset: 0;
            background-color: #c3c4c7;
            border-radius: 24px;
            transition: .25s ease;
        }
        .vg-toggle-track:before {
            position: absolute; content: "";
            height: 18px; width: 18px; left: 3px; bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: .25s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.25);
        }
        .vg-toggle-switch input:checked + .vg-toggle-track {
            background-color: #00a32a;
        }
        .vg-toggle-switch input:checked + .vg-toggle-track:before {
            transform: translateX(22px);
        }
    </style>

    <div class="vg-banner-box-wrap">
        <div class="vg-banner-grid">
            <!-- 1. DESKTOP BANNER BOX -->
            <div class="vg-banner-card">
                <div class="vg-banner-card-header">
                    <div class="vg-banner-card-title">
                        <span class="dashicons dashicons-desktop" style="font-size:20px;color:#2271b1;line-height:1;"></span>
                        <span>1. Ảnh Banner Desktop</span>
                    </div>
                    <span class="vg-banner-badge">Khuyên dùng: 1920 × 600 px</span>
                </div>

                <input type="hidden" name="banner_desktop_img" id="banner_desktop_img" value="<?php echo esc_attr($desktop_img); ?>">
                <input type="hidden" name="banner_desktop_id" id="banner_desktop_id" value="<?php echo esc_attr($desktop_id); ?>">

                <div class="vg-img-preview-box" id="desktop_preview_container">
                    <img src="<?php echo esc_url($desktop_img); ?>" id="desktop_preview" style="<?php echo empty($desktop_img) ? 'display:none;' : ''; ?>">
                    <div class="vg-empty-placeholder" id="desktop_placeholder" style="<?php echo !empty($desktop_img) ? 'display:none;' : ''; ?>">
                        <span class="dashicons dashicons-format-image"></span><br>
                        <span>Chưa chọn ảnh Desktop</span>
                    </div>
                </div>

                <div class="vg-banner-card-actions">
                    <button type="button" class="button button-primary" id="btn_select_desktop">
                        <span class="dashicons dashicons-upload" style="vertical-align:middle;margin-top:-2px;"></span>
                        <span id="btn_select_desktop_text"><?php echo !empty($desktop_img) ? 'Đổi ảnh' : 'Chọn ảnh'; ?></span>
                    </button>
                    <button type="button" class="button" id="btn_remove_desktop" style="color:#b32d2e;<?php echo empty($desktop_img) ? 'display:none;' : ''; ?>">
                        Xóa ảnh
                    </button>
                </div>
            </div>

            <!-- 2. MOBILE BANNER BOX -->
            <div class="vg-banner-card">
                <div class="vg-banner-card-header">
                    <div class="vg-banner-card-title">
                        <span class="dashicons dashicons-smartphone" style="font-size:20px;color:#385a26;line-height:1;"></span>
                        <span>2. Ảnh Banner Mobile</span>
                    </div>
                    <span class="vg-banner-badge vg-banner-badge-mobile">Khuyên dùng: 1200 × 800 px</span>
                </div>

                <input type="hidden" name="banner_mobile_img" id="banner_mobile_img" value="<?php echo esc_attr($mobile_img); ?>">
                <input type="hidden" name="banner_mobile_id" id="banner_mobile_id" value="<?php echo esc_attr($mobile_id); ?>">

                <div class="vg-img-preview-box" id="mobile_preview_container">
                    <img src="<?php echo esc_url($mobile_img); ?>" id="mobile_preview" style="<?php echo empty($mobile_img) ? 'display:none;' : ''; ?>">
                    <div class="vg-empty-placeholder" id="mobile_placeholder" style="<?php echo !empty($mobile_img) ? 'display:none;' : ''; ?>">
                        <span class="dashicons dashicons-smartphone"></span><br>
                        <span>Chưa chọn ảnh Mobile (sẽ tự dùng ảnh Desktop)</span>
                    </div>
                </div>

                <div class="vg-banner-card-actions">
                    <button type="button" class="button button-secondary" id="btn_select_mobile">
                        <span class="dashicons dashicons-upload" style="vertical-align:middle;margin-top:-2px;"></span>
                        <span id="btn_select_mobile_text"><?php echo !empty($mobile_img) ? 'Đổi ảnh' : 'Chọn ảnh'; ?></span>
                    </button>
                    <button type="button" class="button" id="btn_remove_mobile" style="color:#b32d2e;<?php echo empty($mobile_img) ? 'display:none;' : ''; ?>">
                        Xóa ảnh
                    </button>
                </div>
            </div>
        </div>

        <!-- ADDITIONAL SETTINGS -->
        <div class="vg-setting-row">
            <div class="vg-setting-label">Liên kết khi bấm vào (Link)</div>
            <div class="vg-setting-field">
                <input type="text" name="banner_link" value="<?php echo esc_attr($link); ?>" placeholder="Ví dụ: #speisekarte hoặc https://vegan-garden.berlin/kontakt/" style="width:100%;max-width:550px;padding:6px 10px;">
                <div style="color:#646970;font-size:12px;margin-top:4px;">Tùy chọn: Nhấp vào banner trên website sẽ dẫn đến link này.</div>
            </div>
        </div>

        <div class="vg-setting-row">
            <div class="vg-setting-label">Thứ tự hiển thị (Order)</div>
            <div class="vg-setting-field">
                <input type="number" name="banner_order" value="<?php echo esc_attr($order); ?>" min="0" max="99" style="width:80px;padding:6px 10px;">
                <span style="color:#646970;font-size:12px;margin-left:10px;">Số nhỏ hơn hiển thị trước (0 là banner đầu tiên).</span>
            </div>
        </div>

        <div class="vg-setting-row">
            <div class="vg-setting-label">Trạng thái hiển thị</div>
            <div class="vg-setting-field" style="display:flex;align-items:center;gap:12px;">
                <label class="vg-toggle-switch">
                    <input type="checkbox" name="banner_active" value="1" <?php checked($active, '1'); ?>>
                    <span class="vg-toggle-track"></span>
                </label>
                <span style="font-weight:600;color:<?php echo $active === '1' ? '#00a32a' : '#646970'; ?>;">
                    <?php echo $active === '1' ? 'Đang bật hiển thị trên website' : 'Đang tạm ẩn'; ?>
                </span>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Desktop media frame
        var desktopFrame;
        $('#btn_select_desktop').on('click', function(e) {
            e.preventDefault();
            desktopFrame = wp.media({
                title: 'Chọn ảnh Banner Desktop (Khuyên dùng: 1920 × 600 px)',
                button: { text: 'Sử dụng làm ảnh Desktop' },
                multiple: false,
                library: { type: 'image' }
            });
            desktopFrame.on('select', function() {
                var attachment = desktopFrame.state().get('selection').first().toJSON();
                $('#banner_desktop_img').val(attachment.url);
                $('#banner_desktop_id').val(attachment.id);
                $('#desktop_preview').attr('src', attachment.url).show();
                $('#desktop_placeholder').hide();
                $('#btn_remove_desktop').show();
                $('#btn_select_desktop_text').text('Đổi ảnh');
            });
            desktopFrame.open();
        });

        $('#btn_remove_desktop').on('click', function(e) {
            e.preventDefault();
            $('#banner_desktop_img').val('');
            $('#banner_desktop_id').val('');
            $('#desktop_preview').attr('src', '').hide();
            $('#desktop_placeholder').show();
            $(this).hide();
            $('#btn_select_desktop_text').text('Chọn ảnh');
        });

        // Mobile media frame
        var mobileFrame;
        $('#btn_select_mobile').on('click', function(e) {
            e.preventDefault();
            mobileFrame = wp.media({
                title: 'Chọn ảnh Banner Mobile (Khuyên dùng: 1200 × 800 px)',
                button: { text: 'Sử dụng làm ảnh Mobile' },
                multiple: false,
                library: { type: 'image' }
            });
            mobileFrame.on('select', function() {
                var attachment = mobileFrame.state().get('selection').first().toJSON();
                $('#banner_mobile_img').val(attachment.url);
                $('#banner_mobile_id').val(attachment.id);
                $('#mobile_preview').attr('src', attachment.url).show();
                $('#mobile_placeholder').hide();
                $('#btn_remove_mobile').show();
                $('#btn_select_mobile_text').text('Đổi ảnh');
            });
            mobileFrame.open();
        });

        $('#btn_remove_mobile').on('click', function(e) {
            e.preventDefault();
            $('#banner_mobile_img').val('');
            $('#banner_mobile_id').val('');
            $('#mobile_preview').attr('src', '').hide();
            $('#mobile_placeholder').show();
            $(this).hide();
            $('#btn_select_mobile_text').text('Chọn ảnh');
        });
    });
    </script>
    <?php
}

// Save Banner meta
add_action('save_post_vg_banner', function ($post_id) {
    if (!isset($_POST['vg_banner_nonce']) || !wp_verify_nonce($_POST['vg_banner_nonce'], 'vg_banner_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_banner_active', isset($_POST['banner_active']) ? '1' : '0');
    update_post_meta($post_id, '_banner_order', intval($_POST['banner_order'] ?? 0));
    update_post_meta($post_id, '_banner_link', esc_url_raw($_POST['banner_link'] ?? ''));

    // Desktop image
    $desktop_img = esc_url_raw($_POST['banner_desktop_img'] ?? '');
    $desktop_id  = intval($_POST['banner_desktop_id'] ?? 0);
    update_post_meta($post_id, '_banner_desktop_img', $desktop_img);
    update_post_meta($post_id, '_banner_desktop_id', $desktop_id);

    // Auto-sync with Featured Image
    if ($desktop_id > 0) {
        set_post_thumbnail($post_id, $desktop_id);
    } elseif (!empty($desktop_img)) {
        $found_id = attachment_url_to_postid($desktop_img);
        if ($found_id) {
            set_post_thumbnail($post_id, $found_id);
            update_post_meta($post_id, '_banner_desktop_id', $found_id);
        }
    } elseif (empty($desktop_img)) {
        delete_post_thumbnail($post_id);
    }

    // Mobile image
    $mobile_img = esc_url_raw($_POST['banner_mobile_img'] ?? '');
    $mobile_id  = intval($_POST['banner_mobile_id'] ?? 0);
    update_post_meta($post_id, '_banner_mobile_img', $mobile_img);
    update_post_meta($post_id, '_banner_mobile_id', $mobile_id);
});

// Admin columns for Banner list
add_filter('manage_vg_banner_posts_columns', function ($columns) {
    return array(
        'cb'        => $columns['cb'],
        'thumbnail' => vg_admin_i18n('col_preview'),
        'title'     => vg_admin_i18n('col_title'),
        'active'    => vg_admin_i18n('col_status'),
        'order'     => vg_admin_i18n('col_order'),
        'date'      => vg_admin_i18n('col_date'),
    );
});

add_action('manage_vg_banner_posts_custom_column', function ($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            $thumb = get_post_meta($post_id, '_banner_desktop_img', true) ?: get_the_post_thumbnail_url($post_id, 'medium');
            $mob_thumb = get_post_meta($post_id, '_banner_mobile_img', true);
            if ($thumb) {
                echo '<div style="display:flex;align-items:center;gap:8px;">';
                echo '<img src="' . esc_url($thumb) . '" style="width:110px;height:42px;object-fit:cover;border-radius:4px;border:1px solid #ddd;" title="Desktop Image">';
                if ($mob_thumb && $mob_thumb !== $thumb) {
                    echo '<img src="' . esc_url($mob_thumb) . '" style="width:32px;height:42px;object-fit:cover;border-radius:4px;border:1px solid #ddd;" title="Mobile Image">';
                }
                echo '</div>';
            } else {
                echo '<span style="color:#999;">—</span>';
            }
            break;

        case 'active':
            $active = get_post_meta($post_id, '_banner_active', true);
            echo $active === '1'
                ? '<span style="color:#00a32a;font-weight:700;">● Active</span>'
                : '<span style="color:#999;">○ Inactive</span>';
            break;

        case 'order':
            echo intval(get_post_meta($post_id, '_banner_order', true));
            break;
    }
}, 10, 2);

// Make order column sortable
add_filter('manage_edit-vg_banner_sortable_columns', function ($columns) {
    $columns['order'] = 'banner_order';
    return $columns;
});

// Helper: Get active banners
function vg_get_banners() {
    $banners = get_posts(array(
        'post_type'      => 'vg_banner',
        'posts_per_page' => -1,
        'meta_key'       => '_banner_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'relation' => 'OR',
                array('key' => '_banner_active', 'value' => '1'),
                array('key' => '_banner_active', 'compare' => 'NOT EXISTS'),
            )
        ),
    ));

    $result = array();
    foreach ($banners as $b) {
        $desktop = get_post_meta($b->ID, '_banner_desktop_img', true);
        if (!$desktop) {
            $desktop = get_the_post_thumbnail_url($b->ID, 'full');
        }
        if (!$desktop) continue;

        $mobile = get_post_meta($b->ID, '_banner_mobile_img', true);
        if (!$mobile) {
            $mobile = $desktop;
        }

        $result[] = array(
            'desktop' => $desktop,
            'mobile'  => $mobile,
            'title'   => $b->post_title,
            'link'    => get_post_meta($b->ID, '_banner_link', true),
        );
    }
    return $result;
}



// ============================================

// RESTAURANT SETTINGS (CMS)

// ============================================



function vg_get_option($key, $default = '') {

    $opts = get_option('vg_restaurant_settings', array());

    return (!empty($opts[$key])) ? $opts[$key] : $default;

}



add_action('admin_menu', function () {
    add_menu_page(
        vg_admin_i18n('title_restaurant_info', 'Cài Đặt Toàn Bộ Website'),
        vg_admin_i18n('menu_restaurant_info', 'Thông tin nhà hàng'),
        'manage_options',
        'vg-restaurant-settings',
        'vg_render_restaurant_settings_page',
        'dashicons-store',
        4
    );
});



function vg_render_restaurant_settings_page() {
    if (isset($_POST['vg_settings_nonce']) && wp_verify_nonce($_POST['vg_settings_nonce'], 'vg_save_settings')) {
        $data = array(
            // Contact & Hours
            'phone_1'               => sanitize_text_field($_POST['phone_1'] ?? ''),
            'phone_2'               => sanitize_text_field($_POST['phone_2'] ?? ''),
            'email'                 => sanitize_email($_POST['email'] ?? ''),
            'address'               => sanitize_text_field($_POST['address'] ?? ''),
            'hours_open'            => sanitize_textarea_field($_POST['hours_open'] ?? ''),
            'hours_closed'          => sanitize_text_field($_POST['hours_closed'] ?? ''),
            'hours_kitchen'         => sanitize_text_field($_POST['hours_kitchen'] ?? ''),
            'menu_pdf'              => esc_url_raw($_POST['menu_pdf'] ?? ''),
            'whatsapp'              => sanitize_text_field($_POST['whatsapp'] ?? ''),
            'instagram'             => esc_url_raw($_POST['instagram'] ?? ''),
            'facebook'              => esc_url_raw($_POST['facebook'] ?? ''),
            'tiktok'                => esc_url_raw($_POST['tiktok'] ?? ''),
            'maps_url'              => esc_url_raw($_POST['maps_url'] ?? ''),
            
            // Homepage - Welcome Section
            'welcome_tag'           => sanitize_text_field($_POST['welcome_tag'] ?? ''),
            'welcome_heading'       => sanitize_text_field($_POST['welcome_heading'] ?? ''),
            'welcome_desc'          => sanitize_textarea_field($_POST['welcome_desc'] ?? ''),
            'welcome_box_title'     => sanitize_text_field($_POST['welcome_box_title'] ?? ''),
            'welcome_box_line1'     => sanitize_text_field($_POST['welcome_box_line1'] ?? ''),
            'welcome_box_line2'     => sanitize_text_field($_POST['welcome_box_line2'] ?? ''),
            'welcome_box_note'      => sanitize_text_field($_POST['welcome_box_note'] ?? ''),
            'welcome_video_url'     => esc_url_raw($_POST['welcome_video_url'] ?? ''),
            'welcome_video_img'     => esc_url_raw($_POST['welcome_video_img'] ?? ''),
            'welcome_video_caption' => sanitize_text_field($_POST['welcome_video_caption'] ?? ''),
            
            // Homepage - Reviews Score
            'reviews_score'         => sanitize_text_field($_POST['reviews_score'] ?? ''),
            'reviews_count_text'    => sanitize_text_field($_POST['reviews_count_text'] ?? ''),
            
            // Homepage - Garten & Events (3 Cards)
            'event1_title'          => sanitize_text_field($_POST['event1_title'] ?? ''),
            'event1_sub'            => sanitize_text_field($_POST['event1_sub'] ?? ''),
            'event1_img'            => esc_url_raw($_POST['event1_img'] ?? ''),
            'event2_title'          => sanitize_text_field($_POST['event2_title'] ?? ''),
            'event2_sub'            => sanitize_text_field($_POST['event2_sub'] ?? ''),
            'event2_img'            => esc_url_raw($_POST['event2_img'] ?? ''),
            'event3_title'          => sanitize_text_field($_POST['event3_title'] ?? ''),
            'event3_sub'            => sanitize_text_field($_POST['event3_sub'] ?? ''),
            'event3_img'            => esc_url_raw($_POST['event3_img'] ?? ''),
        );
        update_option('vg_restaurant_settings', $data);
        echo '<div class="notice notice-success is-dismissible" style="margin-top:16px;"><p><strong>Settings saved successfully!</strong> All updates are now live on the website.</p></div>';
    }

    // Contact & Hours
    $phone_1       = vg_get_option('phone_1', '030 2123 7260');
    $phone_2       = vg_get_option('phone_2', '0162 464 9999');
    $email         = vg_get_option('email', 'info@vegan-garden.berlin');
    $address       = vg_get_option('address', 'Frankfurter Allee 21, 10247 Berlin (Friedrichshain)');
    $hours_open    = vg_get_option('hours_open', "Dienstag – Sonntag\n12:00 – 22:00 Uhr");
    $hours_closed  = vg_get_option('hours_closed', 'Montag Ruhetag');
    $hours_kitchen = vg_get_option('hours_kitchen', 'Küche bis 21:30 Uhr');
    $menu_pdf      = vg_get_option('menu_pdf', home_url('/menu/Druck_Speisekarte_VeganGarden.pdf'));
    $whatsapp      = vg_get_option('whatsapp', '491624649999');
    $instagram     = vg_get_option('instagram', 'https://www.instagram.com/vegan.garden.berlin/');
    $facebook      = vg_get_option('facebook', 'https://www.facebook.com/vegangarden21');
    $tiktok        = vg_get_option('tiktok', 'https://www.tiktok.com/@vegangarden_berlin');
    $maps_url      = vg_get_option('maps_url', 'https://maps.app.goo.gl/St5dH8yWhqsPBheCA');

    // Homepage - Welcome
    $welcome_tag           = vg_get_option('welcome_tag', 'WILLKOMMEN IM');
    $welcome_heading       = vg_get_option('welcome_heading', 'VEGAN GARDEN BERLIN');
    $welcome_desc          = vg_get_option('welcome_desc', 'Mitten in Friedrichshain erwartet Sie ein besonderer Ort voller Ruhe, Natur und Geschmack. Genießen Sie 100 % vegane vietnamesische Küche in entspannter Gartenatmosphäre.');
    $welcome_box_title     = vg_get_option('welcome_box_title', 'Viel Platz für besondere Momente');
    $welcome_box_line1     = vg_get_option('welcome_box_line1', '100 Plätze innen • ca. 100 Plätze im Garten');
    $welcome_box_line2     = vg_get_option('welcome_box_line2', 'VIP-Raum bis 20 Personen • Bühne');
    $welcome_box_note      = vg_get_option('welcome_box_note', 'Ideal für Geburtstage, Firmenfeiern, Gruppen & Events');
    $welcome_video_url     = vg_get_option('welcome_video_url', 'https://www.youtube.com/watch?v=g2DIB_n3434');
    $welcome_video_img     = vg_get_option('welcome_video_img', home_url('/images/garden_preview.jpg'));
    $welcome_video_caption = vg_get_option('welcome_video_caption', 'Ein kurzer Einblick in unseren Garten');

    // Homepage - Reviews
    $reviews_score         = vg_get_option('reviews_score', '4,8');
    $reviews_count_text    = vg_get_option('reviews_count_text', '285+ Google Bewertungen');

    // Homepage - Events Cards
    $event1_title = vg_get_option('event1_title', 'SOMMERGARTEN');
    $event1_sub   = vg_get_option('event1_sub', 'Über 100 Plätze im Grünen');
    $event1_img   = vg_get_option('event1_img', home_url('/images/sommergarten.jpg?v=20260903_sommergarten4'));

    $event2_title = vg_get_option('event2_title', 'RESTAURANT');
    $event2_sub   = vg_get_option('event2_sub', 'Modern, gemütlich & entspannt');
    $event2_img   = vg_get_option('event2_img', home_url('/images/restaurant.jpg?v=20260903_restaurant4'));

    $event3_title = vg_get_option('event3_title', 'EVENTS & FEIERN');
    $event3_sub   = vg_get_option('event3_sub', 'Private & Exclusive');
    $event3_img   = vg_get_option('event3_img', home_url('/images/events.jpg?v=20260903_event5'));
    ?>
    <div class="wrap" style="max-width: 960px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <h1 style="display:flex; align-items:center; gap:10px; font-size: 24px; margin-bottom: 8px;">
            <span>⚙️</span> Cài Đặt Toàn Bộ Website (Site Settings)
        </h1>
        <p style="color:#666; font-size:14px; margin-bottom: 24px;">
            Dễ dàng chỉnh sửa thông tin nhà hàng, nội dung giới thiệu, video, điểm Google và hình ảnh không gian mà không cần chạm vào code.
        </p>

        <form method="post" action="">
            <?php wp_nonce_field('vg_save_settings', 'vg_settings_nonce'); ?>

            <!-- 1. LIÊN HỆ & GIỜ MỞ CỬA -->
            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    📞 Thông Tin Liên Hệ & Giờ Mở Cửa
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:220px; font-weight:600;">Số điện thoại chính</th>
                        <td>
                            <input type="text" name="phone_1" value="<?php echo esc_attr($phone_1); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Số điện thoại phụ (Mobile)</th>
                        <td>
                            <input type="text" name="phone_2" value="<?php echo esc_attr($phone_2); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Email liên hệ</th>
                        <td>
                            <input type="email" name="email" value="<?php echo esc_attr($email); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Địa chỉ nhà hàng</th>
                        <td>
                            <input type="text" name="address" value="<?php echo esc_attr($address); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Giờ mở cửa</th>
                        <td>
                            <textarea name="hours_open" rows="2" class="large-text" style="padding:8px 12px; font-size:14px;"><?php echo esc_textarea($hours_open); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Ngày nghỉ</th>
                        <td>
                            <input type="text" name="hours_closed" value="<?php echo esc_attr($hours_closed); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Giờ nhận bếp (Kitchen closing)</th>
                        <td>
                            <input type="text" name="hours_kitchen" value="<?php echo esc_attr($hours_kitchen); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">File Menu PDF</th>
                        <td>
                            <input type="text" name="menu_pdf" id="vg_menu_pdf" value="<?php echo esc_attr($menu_pdf); ?>" class="large-text" style="padding:8px 12px; font-size:14px; margin-bottom:8px;">
                            <button type="button" class="button button-secondary" id="vg_upload_pdf_btn" style="padding:4px 14px;">Tải lên file PDF mới</button>
                            <?php if ($menu_pdf): ?>
                                <a href="<?php echo esc_url($menu_pdf); ?>" target="_blank" class="button" style="margin-left:6px;">Xem file PDF hiện tại</a>
                            <?php endif; ?>
                            <p class="description">Khi bạn đổi file PDF ở đây, nút "Gesamte Speisekarte ansehen" trên toàn website sẽ tự động mở file này.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- 2. TRANG CHỦ - GIỚI THIỆU & VIDEO -->
            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    🌿 Trang Chủ - Mục Giới Thiệu (Welcome) & Video
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:220px; font-weight:600;">Tag phụ trên cùng</th>
                        <td>
                            <input type="text" name="welcome_tag" value="<?php echo esc_attr($welcome_tag); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">Mặc định: WILLKOMMEN IM</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Tiêu đề chính</th>
                        <td>
                            <input type="text" name="welcome_heading" value="<?php echo esc_attr($welcome_heading); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">Mặc định: VEGAN GARDEN BERLIN</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Đoạn văn mô tả</th>
                        <td>
                            <textarea name="welcome_desc" rows="3" class="large-text" style="padding:8px 12px; font-size:14px;"><?php echo esc_textarea($welcome_desc); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Hộp sự kiện - Tiêu đề</th>
                        <td>
                            <input type="text" name="welcome_box_title" value="<?php echo esc_attr($welcome_box_title); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Hộp sự kiện - Dòng 1 (Số chỗ)</th>
                        <td>
                            <input type="text" name="welcome_box_line1" value="<?php echo esc_attr($welcome_box_line1); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Hộp sự kiện - Dòng 2 (Tiện ích)</th>
                        <td>
                            <input type="text" name="welcome_box_line2" value="<?php echo esc_attr($welcome_box_line2); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Hộp sự kiện - Ghi chú dưới</th>
                        <td>
                            <input type="text" name="welcome_box_note" value="<?php echo esc_attr($welcome_box_note); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Link Video YouTube</th>
                        <td>
                            <input type="url" name="welcome_video_url" value="<?php echo esc_url($welcome_video_url); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Ảnh đại diện Video</th>
                        <td>
                            <input type="text" name="welcome_video_img" id="vg_welcome_video_img" value="<?php echo esc_url($welcome_video_img); ?>" class="large-text" style="padding:8px 12px; font-size:14px; margin-bottom:8px;">
                            <button type="button" class="button button-secondary" id="vg_upload_video_img_btn">Chọn ảnh từ thư viện</button>
                            <?php if ($welcome_video_img): ?>
                                <br><img src="<?php echo esc_url($welcome_video_img); ?>" id="vg_video_img_preview" style="max-height:100px; border-radius:6px; margin-top:8px;">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Chú thích Video</th>
                        <td>
                            <input type="text" name="welcome_video_caption" value="<?php echo esc_attr($welcome_video_caption); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- 3. TRANG CHỦ - ĐIỂM ĐÁNH GIÁ GOOGLE -->
            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    ⭐ Trang Chủ - Điểm Đánh Giá Google (Google Reviews Header)
                </h2>
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:220px; font-weight:600;">Điểm số đánh giá</th>
                        <td>
                            <input type="text" name="reviews_score" value="<?php echo esc_attr($reviews_score); ?>" style="width:100px; padding:8px 12px; font-size:14px;">
                            <span class="description" style="margin-left:8px;">e.g. 4,8 hoặc 4,9</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Dòng chữ tổng số review</th>
                        <td>
                            <input type="text" name="reviews_count_text" value="<?php echo esc_attr($reviews_count_text); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <span class="description" style="margin-left:8px;">e.g. 285+ Google Bewertungen</span>
                        </td>
                    </tr>
                </table>
                <p style="background:#f0f6ff; padding:12px; border-radius:8px; border-left:4px solid #2271b1; margin-top:12px;">
                    💡 Để thêm/sửa/xoá các thẻ đánh giá của khách hàng, hãy vào menu <strong>"⭐ Reviews"</strong> ở cột bên trái!
                </p>
            </div>

            <!-- 4. TRANG CHỦ - KHÔNG GIAN (GARTEN & EVENTS) -->
            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    🎪 Trang Chủ - 3 Khối Không Gian & Sự Kiện (Garten & Events)
                </h2>

                <h3 style="font-size:14px; margin:16px 0 8px; color:#2A160F;">Card 1:</h3>
                <table class="form-table" style="margin-top:0;">
                    <tr>
                        <th style="width:220px;">Tiêu đề Card 1</th>
                        <td><input type="text" name="event1_title" value="<?php echo esc_attr($event1_title); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Phụ đề Card 1</th>
                        <td><input type="text" name="event1_sub" value="<?php echo esc_attr($event1_sub); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Ảnh Card 1</th>
                        <td><input type="text" name="event1_img" value="<?php echo esc_url($event1_img); ?>" class="large-text"></td>
                    </tr>
                </table>

                <h3 style="font-size:14px; margin:24px 0 8px; color:#2A160F; border-top:1px dashed #ddd; padding-top:16px;">Card 2:</h3>
                <table class="form-table" style="margin-top:0;">
                    <tr>
                        <th style="width:220px;">Tiêu đề Card 2</th>
                        <td><input type="text" name="event2_title" value="<?php echo esc_attr($event2_title); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Phụ đề Card 2</th>
                        <td><input type="text" name="event2_sub" value="<?php echo esc_attr($event2_sub); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Ảnh Card 2</th>
                        <td><input type="text" name="event2_img" value="<?php echo esc_url($event2_img); ?>" class="large-text"></td>
                    </tr>
                </table>

                <h3 style="font-size:14px; margin:24px 0 8px; color:#2A160F; border-top:1px dashed #ddd; padding-top:16px;">Card 3:</h3>
                <table class="form-table" style="margin-top:0;">
                    <tr>
                        <th style="width:220px;">Tiêu đề Card 3</th>
                        <td><input type="text" name="event3_title" value="<?php echo esc_attr($event3_title); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Phụ đề Card 3</th>
                        <td><input type="text" name="event3_sub" value="<?php echo esc_attr($event3_sub); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Ảnh Card 3</th>
                        <td><input type="text" name="event3_img" value="<?php echo esc_url($event3_img); ?>" class="large-text"></td>
                    </tr>
                </table>
            </div>

            <!-- 5. MẠNG XÃ HỘI & BẢN ĐỒ -->
            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    🌐 Mạng Xã Hội & Bản Đồ Google Maps
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:220px; font-weight:600;">Số WhatsApp</th>
                        <td>
                            <input type="text" name="whatsapp" value="<?php echo esc_attr($whatsapp); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">Định dạng quốc tế, ví dụ: 491624649999 (không dấu + hoặc khoảng trắng)</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Instagram URL</th>
                        <td>
                            <input type="url" name="instagram" value="<?php echo esc_url($instagram); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Facebook URL</th>
                        <td>
                            <input type="url" name="facebook" value="<?php echo esc_url($facebook); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">TikTok URL</th>
                        <td>
                            <input type="url" name="tiktok" value="<?php echo esc_url($tiktok); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Link Google Maps (Chỉ đường)</th>
                        <td>
                            <input type="url" name="maps_url" value="<?php echo esc_url($maps_url); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                </table>
            </div>

            <p class="submit" style="padding: 10px 0;">
                <button type="submit" class="button button-primary button-hero" style="font-size: 16px; padding: 6px 30px; height: auto;">
                    💾 Lưu Cài Đặt (Save Changes)
                </button>
            </p>
        </form>
    </div>

    <script>
    jQuery(function($) {
        // PDF Uploader
        $('#vg_upload_pdf_btn').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Tải lên hoặc chọn file Menu PDF',
                multiple: false,
                library: { type: 'application/pdf' }
            });
            frame.on('select', function() {
                var url = frame.state().get('selection').first().toJSON().url;
                $('#vg_menu_pdf').val(url);
            });
            frame.open();
        });

        // Video Image Uploader
        $('#vg_upload_video_img_btn').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Chọn ảnh đại diện cho Video',
                multiple: false,
                library: { type: 'image' }
            });
            frame.on('select', function() {
                var url = frame.state().get('selection').first().toJSON().url;
                $('#vg_welcome_video_img').val(url);
                $('#vg_video_img_preview').attr('src', url).show();
            });
            frame.open();
        });
    });
    </script>
    <?php
}



// ============================================
// CMS EXTENSIONS: DISHES (SPEISEKARTE), REVIEWS, GALLERY
// ============================================

// 1. DISHES (SPEISEKARTE) CPT
add_action('init', function () {
    register_post_type('vg_dish', array(
        'labels' => array(
            'name'               => vg_admin_i18n('dish_name', 'Dishes'),
            'singular_name'      => vg_admin_i18n('dish_singular', 'Dish'),
            'menu_name'          => vg_admin_i18n('dish_menu', 'Speisekarte'),
            'add_new'            => vg_admin_i18n('dish_add_new', 'Add New Dish'),
            'add_new_item'       => vg_admin_i18n('dish_add_new', 'Add New Dish'),
            'edit_item'          => vg_admin_i18n('dish_edit', 'Edit Dish'),
            'all_items'          => vg_admin_i18n('dish_all', 'All Dishes'),
            'not_found'          => vg_admin_i18n('dish_not_found', 'No dishes found'),
        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-food',
        'supports'           => array('title', 'thumbnail'),
        'capability_type'    => 'post',
        'has_archive'        => false,
    ));
});

add_action('add_meta_boxes', function () {
    add_meta_box('vg_dish_settings', 'Dish Details (Thông tin món ăn)', 'vg_dish_meta_box', 'vg_dish', 'normal', 'high');
});

function vg_dish_meta_box($post) {
    wp_nonce_field('vg_dish_meta', 'vg_dish_nonce');
    $price      = get_post_meta($post->ID, '_dish_price', true);
    $order      = get_post_meta($post->ID, '_dish_order', true);
    $active     = get_post_meta($post->ID, '_dish_active', true);
    $custom_img = get_post_meta($post->ID, '_dish_custom_img', true);

    if ($order === '') $order = 0;
    if ($active === '') $active = '1';
    ?>
    <style>
        .vg-meta-row { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; padding: 12px 0; border-bottom: 1px solid #eee; }
        .vg-meta-label { font-weight: 600; min-width: 160px; }
        .vg-meta-input { flex: 1; }
        .vg-meta-input input[type="text"], .vg-meta-input input[type="number"] { width: 100%; max-width: 320px; padding: 8px; }
        .vg-toggle { position: relative; display: inline-block; width: 50px; height: 26px; }
        .vg-toggle input { opacity: 0; width: 0; height: 0; }
        .vg-toggle-slider { position: absolute; cursor: pointer; inset: 0; background: #ccc; border-radius: 26px; transition: .3s; }
        .vg-toggle-slider:before { content: ""; position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: .3s; }
        .vg-toggle input:checked + .vg-toggle-slider { background: #4CAF50; }
        .vg-toggle input:checked + .vg-toggle-slider:before { transform: translateX(24px); }
    </style>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Active (Hiển thị)</div>
        <div class="vg-meta-input">
            <label class="vg-toggle">
                <input type="checkbox" name="dish_active" value="1" <?php checked($active, '1'); ?>>
                <span class="vg-toggle-slider"></span>
            </label>
            <span style="margin-left: 8px; color: #666;">Bật/tắt hiển thị món trên trang chủ</span>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Price (Giá tiền)</div>
        <div class="vg-meta-input">
            <input type="text" name="dish_price" value="<?php echo esc_attr($price); ?>" placeholder="e.g. 5,90 € hoặc ab 35,90 €">
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Display Order (Thứ tự)</div>
        <div class="vg-meta-input">
            <input type="number" name="dish_order" value="<?php echo esc_attr($order); ?>" min="0" max="999" style="width:80px!important;">
            <span style="margin-left:8px; color:#666;">Số nhỏ hơn hiển thị trước</span>
        </div>
    </div>

    <?php if ($custom_img): ?>
    <div class="vg-meta-row">
        <div class="vg-meta-label">Fallback Image URL</div>
        <div class="vg-meta-input">
            <input type="text" name="dish_custom_img" value="<?php echo esc_attr($custom_img); ?>" style="max-width: 500px;">
            <br><img src="<?php echo esc_url($custom_img); ?>" style="height:60px; border-radius:6px; margin-top:6px;">
        </div>
    </div>
    <?php endif; ?>

    <p style="background:#f0f6ff; padding:12px; border-radius:8px; border-left:4px solid #2271b1; margin-top:12px;">
        💡 <strong>Dish Image (Ảnh món ăn):</strong> Hãy tải ảnh lên ở mục <strong>"Featured Image (Ảnh đại diện)"</strong> ở cột bên phải! (Nếu có cả ảnh đại diện và link fallback, hệ thống ưu tiên ảnh đại diện).
    </p>
    <?php
}

add_action('save_post_vg_dish', function ($post_id) {
    if (!isset($_POST['vg_dish_nonce']) || !wp_verify_nonce($_POST['vg_dish_nonce'], 'vg_dish_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_dish_active', isset($_POST['dish_active']) ? '1' : '0');
    update_post_meta($post_id, '_dish_price', sanitize_text_field($_POST['dish_price'] ?? ''));
    update_post_meta($post_id, '_dish_order', intval($_POST['dish_order'] ?? 0));
    if (isset($_POST['dish_custom_img'])) {
        update_post_meta($post_id, '_dish_custom_img', esc_url_raw($_POST['dish_custom_img']));
    }
});

add_filter('manage_vg_dish_posts_columns', function ($columns) {
    return array(
        'cb'        => $columns['cb'],
        'thumbnail' => vg_admin_i18n('col_photo'),
        'title'     => vg_admin_i18n('col_dish_name'),
        'price'     => vg_admin_i18n('col_price'),
        'active'    => vg_admin_i18n('col_status'),
        'order'     => vg_admin_i18n('col_order'),
        'date'      => vg_admin_i18n('col_date'),
    );
});

add_action('manage_vg_dish_posts_custom_column', function ($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            $thumb = get_the_post_thumbnail_url($post_id, 'thumbnail');
            if (!$thumb) $thumb = get_post_meta($post_id, '_dish_custom_img', true);
            if ($thumb) echo '<img src="' . esc_url($thumb) . '" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">';
            else echo '<span style="color:#999;">—</span>';
            break;
        case 'price':
            echo '<strong>' . esc_html(get_post_meta($post_id, '_dish_price', true) ?: '—') . '</strong>';
            break;
        case 'active':
            $active = get_post_meta($post_id, '_dish_active', true);
            echo $active === '1'
                ? '<span style="color:#4CAF50;font-weight:700;">● Active</span>'
                : '<span style="color:#999;">○ Inactive</span>';
            break;
        case 'order':
            echo intval(get_post_meta($post_id, '_dish_order', true));
            break;
    }
}, 10, 2);

add_filter('manage_edit-vg_dish_sortable_columns', function ($columns) {
    $columns['order'] = 'dish_order';
    return $columns;
});

function vg_get_dishes() {
    $posts = get_posts(array(
        'post_type'      => 'vg_dish',
        'posts_per_page' => -1,
        'meta_key'       => '_dish_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => array(
            array('key' => '_dish_active', 'value' => '1'),
        ),
    ));
    if (empty($posts)) return array();
    $result = array();
    foreach ($posts as $p) {
        $img = get_the_post_thumbnail_url($p->ID, 'large');
        if (!$img) $img = get_post_meta($p->ID, '_dish_custom_img', true);
        $result[] = array(
            'id'    => $p->ID,
            'name'  => $p->post_title,
            'price' => get_post_meta($p->ID, '_dish_price', true),
            'image' => $img,
        );
    }
    return $result;
}


// 2. REVIEWS CPT (⭐ Reviews)
add_action('init', function () {
    register_post_type('vg_review', array(
        'labels' => array(
            'name'               => vg_admin_i18n('review_name', 'Reviews'),
            'singular_name'      => vg_admin_i18n('review_singular', 'Review'),
            'menu_name'          => vg_admin_i18n('review_menu', 'Reviews'),
            'add_new'            => vg_admin_i18n('review_add_new', 'Add New Review'),
            'add_new_item'       => vg_admin_i18n('review_add_new', 'Add New Review'),
            'edit_item'          => vg_admin_i18n('review_edit', 'Edit Review'),
            'all_items'          => vg_admin_i18n('review_all', 'All Reviews'),
            'not_found'          => vg_admin_i18n('review_not_found', 'No reviews found'),
        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array('title', 'editor'),
        'capability_type'    => 'post',
        'has_archive'        => false,
    ));
});

add_action('add_meta_boxes', function () {
    add_meta_box('vg_review_settings', 'Review Details (Chi tiết đánh giá)', 'vg_review_meta_box', 'vg_review', 'normal', 'high');
});

function vg_review_meta_box($post) {
    wp_nonce_field('vg_review_meta', 'vg_review_nonce');
    $rating = get_post_meta($post->ID, '_review_rating', true);
    $color  = get_post_meta($post->ID, '_review_avatar_color', true);
    $order  = get_post_meta($post->ID, '_review_order', true);
    $active = get_post_meta($post->ID, '_review_active', true);

    if ($rating === '') $rating = 5;
    if ($color === '') $color = '#e65100';
    if ($order === '') $order = 0;
    if ($active === '') $active = '1';
    ?>
    <div class="vg-meta-row">
        <div class="vg-meta-label">Active (Hiển thị)</div>
        <div class="vg-meta-input">
            <label class="vg-toggle">
                <input type="checkbox" name="review_active" value="1" <?php checked($active, '1'); ?>>
                <span class="vg-toggle-slider"></span>
            </label>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Rating Stars (Số sao)</div>
        <div class="vg-meta-input">
            <select name="review_rating" style="padding:6px 12px; font-size:15px;">
                <?php for ($s = 5; $s >= 1; $s--): ?>
                    <option value="<?php echo $s; ?>" <?php selected($rating, $s); ?>>
                        <?php echo str_repeat('★', $s) . ' (' . $s . ' sao)'; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Avatar Color (Màu nền đại diện)</div>
        <div class="vg-meta-input">
            <input type="color" name="review_avatar_color" value="<?php echo esc_attr($color); ?>" style="height:40px; width:60px; padding:2px; vertical-align:middle;">
            <span style="margin-left:8px; color:#666;">Chữ cái đầu tên khách sẽ tự động làm avatar với màu nền này</span>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Display Order (Thứ tự)</div>
        <div class="vg-meta-input">
            <input type="number" name="review_order" value="<?php echo esc_attr($order); ?>" min="0" max="999" style="width:80px!important;">
        </div>
    </div>

    <p style="background:#f0f6ff; padding:12px; border-radius:8px; border-left:4px solid #2271b1; margin-top:12px;">
        💡 <strong>Review Text:</strong> Nhập nội dung nhận xét của khách hàng vào khung soạn thảo nội dung chính ở trên!<br>
        💡 <strong>Author Name:</strong> Nhập tên khách hàng vào ô tiêu đề (Title) ở trên cùng.
    </p>
    <?php
}

add_action('save_post_vg_review', function ($post_id) {
    if (!isset($_POST['vg_review_nonce']) || !wp_verify_nonce($_POST['vg_review_nonce'], 'vg_review_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_review_active', isset($_POST['review_active']) ? '1' : '0');
    update_post_meta($post_id, '_review_rating', intval($_POST['review_rating'] ?? 5));
    update_post_meta($post_id, '_review_avatar_color', sanitize_hex_color($_POST['review_avatar_color'] ?? '#e65100'));
    update_post_meta($post_id, '_review_order', intval($_POST['review_order'] ?? 0));
});

add_filter('manage_vg_review_posts_columns', function ($columns) {
    return array(
        'cb'      => $columns['cb'],
        'title'   => vg_admin_i18n('col_reviewer'),
        'rating'  => vg_admin_i18n('col_stars'),
        'content' => vg_admin_i18n('col_content'),
        'active'  => vg_admin_i18n('col_status'),
        'order'   => vg_admin_i18n('col_order'),
        'date'    => vg_admin_i18n('col_date'),
    );
});

add_action('manage_vg_review_posts_custom_column', function ($column, $post_id) {
    switch ($column) {
        case 'rating':
            $stars = intval(get_post_meta($post_id, '_review_rating', true) ?: 5);
            echo '<span style="color:#FBBC04;font-size:15px;">' . str_repeat('★', $stars) . '</span>';
            break;
        case 'content':
            $post = get_post($post_id);
            echo esc_html(wp_trim_words($post->post_content, 12, '...'));
            break;
        case 'active':
            $active = get_post_meta($post_id, '_review_active', true);
            echo $active === '1'
                ? '<span style="color:#4CAF50;font-weight:700;">● Active</span>'
                : '<span style="color:#999;">○ Inactive</span>';
            break;
        case 'order':
            echo intval(get_post_meta($post_id, '_review_order', true));
            break;
    }
}, 10, 2);

add_filter('manage_edit-vg_review_sortable_columns', function ($columns) {
    $columns['order'] = 'review_order';
    return $columns;
});

function vg_get_reviews() {
    $posts = get_posts(array(
        'post_type'      => 'vg_review',
        'posts_per_page' => -1,
        'meta_key'       => '_review_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => array(
            array('key' => '_review_active', 'value' => '1'),
        ),
    ));
    if (empty($posts)) return array();
    $result = array();
    foreach ($posts as $p) {
        $initial = mb_substr($p->post_title, 0, 1, 'UTF-8');
        $result[] = array(
            'id'      => $p->ID,
            'name'    => $p->post_title,
            'initial' => $initial,
            'color'   => get_post_meta($p->ID, '_review_avatar_color', true) ?: '#e65100',
            'rating'  => intval(get_post_meta($p->ID, '_review_rating', true) ?: 5),
            'text'    => $p->post_content,
        );
    }
    return $result;
}


// 3. GALLERY CPT (📸 Gallery)
add_action('init', function () {
    register_post_type('vg_gallery', array(
        'labels' => array(
            'name'               => vg_admin_i18n('gallery_name', 'Gallery'),
            'singular_name'      => vg_admin_i18n('gallery_singular', 'Photo'),
            'menu_name'          => vg_admin_i18n('gallery_menu', 'Gallery'),
            'add_new'            => vg_admin_i18n('gallery_add_new', 'Add New Photo'),
            'add_new_item'       => vg_admin_i18n('gallery_add_new', 'Add New Photo'),
            'edit_item'          => vg_admin_i18n('gallery_edit', 'Edit Photo'),
            'all_items'          => vg_admin_i18n('gallery_all', 'All Photos'),
            'not_found'          => vg_admin_i18n('gallery_not_found', 'No photos found'),
        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-images-alt2',
        'supports'           => array('title', 'thumbnail'),
        'capability_type'    => 'post',
        'has_archive'        => false,
    ));
});

add_action('add_meta_boxes', function () {
    add_meta_box('vg_gallery_settings', 'Photo Details (Chi tiết ảnh)', 'vg_gallery_meta_box', 'vg_gallery', 'normal', 'high');
});

function vg_gallery_meta_box($post) {
    wp_nonce_field('vg_gallery_meta', 'vg_gallery_nonce');
    $order      = get_post_meta($post->ID, '_gallery_order', true);
    $active     = get_post_meta($post->ID, '_gallery_active', true);
    $custom_img = get_post_meta($post->ID, '_gallery_custom_img', true);

    if ($order === '') $order = 0;
    if ($active === '') $active = '1';
    ?>
    <div class="vg-meta-row">
        <div class="vg-meta-label">Active (Hiển thị)</div>
        <div class="vg-meta-input">
            <label class="vg-toggle">
                <input type="checkbox" name="gallery_active" value="1" <?php checked($active, '1'); ?>>
                <span class="vg-toggle-slider"></span>
            </label>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Display Order (Thứ tự)</div>
        <div class="vg-meta-input">
            <input type="number" name="gallery_order" value="<?php echo esc_attr($order); ?>" min="0" max="999" style="width:80px!important;">
            <span style="margin-left:8px; color:#666;">Số nhỏ hơn hiển thị trước</span>
        </div>
    </div>

    <?php if ($custom_img): ?>
    <div class="vg-meta-row">
        <div class="vg-meta-label">Fallback Image URL</div>
        <div class="vg-meta-input">
            <input type="text" name="gallery_custom_img" value="<?php echo esc_attr($custom_img); ?>" style="max-width: 500px;">
            <br><img src="<?php echo esc_url($custom_img); ?>" style="height:60px; border-radius:6px; margin-top:6px;">
        </div>
    </div>
    <?php endif; ?>

    <p style="background:#f0f6ff; padding:12px; border-radius:8px; border-left:4px solid #2271b1; margin-top:12px;">
        💡 <strong>Image:</strong> Tải ảnh lên ở mục <strong>"Featured Image (Ảnh đại diện)"</strong> ở cột bên phải.<br>
        💡 <strong>Title:</strong> Tiêu đề sẽ được dùng làm chú thích (Alt text) của ảnh.
    </p>
    <?php
}

add_action('save_post_vg_gallery', function ($post_id) {
    if (!isset($_POST['vg_gallery_nonce']) || !wp_verify_nonce($_POST['vg_gallery_nonce'], 'vg_gallery_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_gallery_active', isset($_POST['gallery_active']) ? '1' : '0');
    update_post_meta($post_id, '_gallery_order', intval($_POST['gallery_order'] ?? 0));
    if (isset($_POST['gallery_custom_img'])) {
        update_post_meta($post_id, '_gallery_custom_img', esc_url_raw($_POST['gallery_custom_img']));
    }
});

add_filter('manage_vg_gallery_posts_columns', function ($columns) {
    return array(
        'cb'        => $columns['cb'],
        'thumbnail' => vg_admin_i18n('col_photo'),
        'title'     => vg_admin_i18n('col_title'),
        'active'    => vg_admin_i18n('col_status'),
        'order'     => vg_admin_i18n('col_order'),
        'date'      => vg_admin_i18n('col_date'),
    );
});

add_action('manage_vg_gallery_posts_custom_column', function ($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            $thumb = get_the_post_thumbnail_url($post_id, 'thumbnail');
            if (!$thumb) $thumb = get_post_meta($post_id, '_gallery_custom_img', true);
            if ($thumb) echo '<img src="' . esc_url($thumb) . '" style="width:70px;height:70px;object-fit:cover;border-radius:8px;">';
            else echo '<span style="color:#999;">—</span>';
            break;
        case 'active':
            $active = get_post_meta($post_id, '_gallery_active', true);
            echo $active === '1'
                ? '<span style="color:#4CAF50;font-weight:700;">● Active</span>'
                : '<span style="color:#999;">○ Inactive</span>';
            break;
        case 'order':
            echo intval(get_post_meta($post_id, '_gallery_order', true));
            break;
    }
}, 10, 2);

add_filter('manage_edit-vg_gallery_sortable_columns', function ($columns) {
    $columns['order'] = 'gallery_order';
    return $columns;
});

function vg_get_gallery() {
    $posts = get_posts(array(
        'post_type'      => 'vg_gallery',
        'posts_per_page' => -1,
        'meta_key'       => '_gallery_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => array(
            array('key' => '_gallery_active', 'value' => '1'),
        ),
    ));
    if (empty($posts)) return array();
    $result = array();
    foreach ($posts as $p) {
        $img = get_the_post_thumbnail_url($p->ID, 'large');
        if (!$img) $img = get_post_meta($p->ID, '_gallery_custom_img', true);
        if (!$img) continue;
        $result[] = array(
            'id'    => $p->ID,
            'title' => $p->post_title,
            'image' => $img,
        );
    }
    return $result;
}


// 4. AUTO-SEED INITIAL DATA (Dishes, Reviews, Gallery)
add_action('admin_init', function () {
    if (get_option('vg_cms_seeded_v1')) return;

    // A. Seed Dishes
    $default_dishes = array(
        array('title' => 'Knusprige Frühlingsrollen', 'price' => '5,90 €', 'img' => home_url('/images/nem_ran.jpg'), 'order' => 1),
        array('title' => 'Vier Schätze in Chao-Soße', 'price' => '13,90 €', 'img' => home_url('/images/tu_buu_kho_chao.jpg'), 'order' => 2),
        array('title' => 'Thailändischer Feuertopf', 'price' => 'ab 35,90 €', 'img' => home_url('/images/lau_thai.jpg'), 'order' => 3),
        array('title' => 'Vegan Garden Rollen', 'price' => '6,50 €', 'img' => home_url('/images/vegan_garden_rollen.jpg'), 'order' => 4),
        array('title' => 'Vegan Garden Reisnudel-Bowl', 'price' => '13,90 €', 'img' => home_url('/images/summer_bowl.jpg'), 'order' => 5),
        array('title' => 'Thailändische Reisnudelsuppe', 'price' => '13,90 €', 'img' => home_url('/images/thai_reisnudelsuppe.jpg'), 'order' => 6),
        array('title' => 'Tofu Royal', 'price' => '6,50 €', 'img' => home_url('/images/spargel.jpg'), 'order' => 7),
    );
    foreach ($default_dishes as $d) {
        $id = wp_insert_post(array(
            'post_title'  => $d['title'],
            'post_type'   => 'vg_dish',
            'post_status' => 'publish',
        ));
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_dish_price', $d['price']);
            update_post_meta($id, '_dish_order', $d['order']);
            update_post_meta($id, '_dish_active', '1');
            update_post_meta($id, '_dish_custom_img', $d['img']);
        }
    }

    // B. Seed Reviews
    $default_reviews = array(
        array(
            'name'   => 'René Fleischmann',
            'color'  => '#e65100',
            'rating' => 5,
            'text'   => 'Authentisch, lecker, vegan, alles frisch zubereitet, selbst die Soßen. Die hausgemachten Drinks sind der Hammer.',
            'order'  => 1
        ),
        array(
            'name'   => 'Jana Flohr',
            'color'  => '#7b1fa2',
            'rating' => 5,
            'text'   => 'We had delicious, incredibly fresh, and beautifully presented food... highly recommended! And then there was the wonderful Karl Marx Avenue... We\'ll be back!',
            'order'  => 2
        ),
        array(
            'name'   => 'frodo aus_dem_auenland',
            'color'  => '#2e7d32',
            'rating' => 5,
            'text'   => 'Sehr schönes Restaurant mit leckeren ansprechenden Gerichten in Bio-Qualität. Geschmackvolle Einrichtung, das Essen und der Tee werden mit Liebe zubereitet. Hebt sich wirklich ab!',
            'order'  => 3
        ),
        array(
            'name'   => 'Papadopoulos Pipotimus',
            'color'  => '#1565c0',
            'rating' => 5,
            'text'   => 'Love it. Der Raum ist groß und trotz der Nähe zur Frankfurter Allee sehr ruhig, durch die Abendsonne beleuchten. Das Hauptgericht war eine große Suppe mit frischem Tofu. Alles in allem, geht hin!',
            'order'  => 4
        ),
        array(
            'name'   => 'Anna L.',
            'color'  => '#00838f',
            'rating' => 5,
            'text'   => 'Wunderschöner Ort, tolles Ambiente und das Essen ist einfach fantastisch! Die veganen Sommerrollen sind ein absolutes Highlight.',
            'order'  => 5
        ),
    );
    foreach ($default_reviews as $r) {
        $id = wp_insert_post(array(
            'post_title'   => $r['name'],
            'post_content' => $r['text'],
            'post_type'    => 'vg_review',
            'post_status'  => 'publish',
        ));
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_review_rating', $r['rating']);
            update_post_meta($id, '_review_avatar_color', $r['color']);
            update_post_meta($id, '_review_order', $r['order']);
            update_post_meta($id, '_review_active', '1');
        }
    }

    // C. Seed Gallery
    $default_gallery = array(
        array('title' => 'Vegan Garden Berlin - Tu Buu Kho Chao', 'img' => home_url('/images/gallery/bo-tuu-kho-chao.png?v=20260903_g'), 'order' => 1),
        array('title' => 'Vegan Garden Berlin - Lau Thai Feuertopf', 'img' => home_url('/images/gallery/lau.jpg?v=20260903_g'), 'order' => 2),
        array('title' => 'Vegan Garden Berlin - Bun Bo Hue Nudelsuppe', 'img' => home_url('/images/gallery/bunbo.jpg?v=20260903_g'), 'order' => 3),
        array('title' => 'Vegan Garden Berlin - Bun Thai Nudelsuppe', 'img' => home_url('/images/gallery/bunthai.png?v=20260903_g'), 'order' => 4),
        array('title' => 'Vegan Garden Berlin - Frischer grüner Spargel', 'img' => home_url('/images/gallery/SPARGEL.jpg?v=20260903_g'), 'order' => 5),
        array('title' => 'Vegan Garden Berlin - Knusprige Frühlingsrollen', 'img' => home_url('/images/gallery/CHIHUONG28.084336-Edit.jpg?v=20260903_g'), 'order' => 6),
        array('title' => 'Vegan Garden Berlin - Festliche vegane Speisen', 'img' => home_url('/images/gallery/4.jpg?v=20260903_g'), 'order' => 7),
        array('title' => 'Vegan Garden Berlin - Gesunde Reisspezialitäten', 'img' => home_url('/images/gallery/CHIHUONG28.084466.jpg?v=20260903_g'), 'order' => 8),
        array('title' => 'Vegan Garden Berlin - Vegane Spezialitäten', 'img' => home_url('/images/gallery/a.jpg?v=20260903_g'), 'order' => 9),
        array('title' => 'Vegan Garden Berlin - Gemütliches Restaurant-Ambiente', 'img' => home_url('/images/gallery/CHIHUONG28.085441.jpg?v=20260903_g'), 'order' => 10),
    );
    foreach ($default_gallery as $g) {
        $id = wp_insert_post(array(
            'post_title'  => $g['title'],
            'post_type'   => 'vg_gallery',
            'post_status' => 'publish',
        ));
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_gallery_order', $g['order']);
            update_post_meta($id, '_gallery_active', '1');
            update_post_meta($id, '_gallery_custom_img', $g['img']);
        }
    }

    update_option('vg_cms_seeded_v1', 1);
});


// ============================================

// SMTP EMAIL CONFIGURATION

// ============================================

add_action('phpmailer_init', function ($phpmailer) {

    $phpmailer->isSMTP();

    $phpmailer->Host       = 'server11.configcenter.info';

    $phpmailer->SMTPAuth   = true;

    $phpmailer->Port       = 465;

    $phpmailer->SMTPSecure = 'ssl';

    $phpmailer->Username   = 'booking@vegan-garden.berlin';

    $phpmailer->Password   = 'Rv2tL0{BS\81';

    $phpmailer->From       = 'booking@vegan-garden.berlin';

    $phpmailer->FromName   = 'Vegan Garden Berlin';

});



// ============================================

// CONTACT FORM HANDLER

// ============================================



// Register custom post type for contact messages
add_action('init', function () {
    register_post_type('contact_message', array(
        'labels' => array(
            'name'               => vg_admin_i18n('message_name', 'Messages'),
            'singular_name'      => vg_admin_i18n('message_singular', 'Message'),
            'menu_name'          => vg_admin_i18n('message_menu', 'Messages'),
            'all_items'          => vg_admin_i18n('message_all', 'All Messages'),
            'view_item'          => vg_admin_i18n('message_view', 'View Message'),
            'search_items'       => vg_admin_i18n('message_search', 'Search Messages'),
            'not_found'          => vg_admin_i18n('message_not_found', 'No messages found'),
        ),

        'public'             => false,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'menu_position'      => 25,

        'menu_icon'          => 'dashicons-email-alt',

        'supports'           => array('title', 'editor', 'custom-fields'),

        'capability_type'    => 'post',

        'has_archive'        => false,

    ));

});



// Handle AJAX form submission

add_action('wp_ajax_vg_contact_submit', 'vg_handle_contact_form');

add_action('wp_ajax_nopriv_vg_contact_submit', 'vg_handle_contact_form');



function vg_handle_contact_form() {

    // Verify nonce

    if (!isset($_POST['vg_contact_nonce']) || !wp_verify_nonce($_POST['vg_contact_nonce'], 'vg_contact_form')) {

        wp_send_json_error('Sicherheitsfehler. Bitte laden Sie die Seite neu.');

        return;

    }



    // Sanitize inputs

    $name    = sanitize_text_field($_POST['contact_name'] ?? '');

    $phone   = sanitize_text_field($_POST['contact_phone'] ?? '');

    $email   = sanitize_email($_POST['contact_email'] ?? '');

    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');



    // Validate

    if (empty($name) || empty($phone) || empty($email) || empty($message)) {

        wp_send_json_error('Bitte füllen Sie alle Pflichtfelder aus.');

        return;

    }



    if (!is_email($email)) {

        wp_send_json_error('Bitte geben Sie eine gültige E-Mail-Adresse ein.');

        return;

    }



    // Rate limiting: max 3 submissions per IP per hour

    $ip = $_SERVER['REMOTE_ADDR'];

    $rate_key = 'vg_contact_' . md5($ip);

    $submissions = get_transient($rate_key);

    if ($submissions !== false && $submissions >= 3) {

        wp_send_json_error('Zu viele Anfragen. Bitte versuchen Sie es später erneut.');

        return;

    }

    set_transient($rate_key, ($submissions ? $submissions + 1 : 1), HOUR_IN_SECONDS);



    // Save to database as custom post type

    $post_id = wp_insert_post(array(

        'post_type'    => 'contact_message',

        'post_title'   => sprintf('%s — %s', $name, $email),

        'post_content' => $message,

        'post_status'  => 'publish',

    ));



    if ($post_id) {

        update_post_meta($post_id, '_contact_name', $name);

        update_post_meta($post_id, '_contact_email', $email);

        update_post_meta($post_id, '_contact_phone', $phone);

        update_post_meta($post_id, '_contact_ip', $ip);

        update_post_meta($post_id, '_contact_date', current_time('mysql'));

    }



    // Send email notification

    $to         = 'info@vegan-garden.berlin';

    $date_now   = current_time('d.m.Y');

    $subject    = sprintf('✉️ [Vegan Garden] Neue Kontaktanfrage von %s — %s', $name, $date_now);



    $logo_url   = esc_url(home_url('/logo/VN-02.png?v=20260918_noborder'));

    $created_at = current_time('d.m.Y, H:i') . ' Uhr';



    // Format phone for tel: and WhatsApp

    $phone_digits = preg_replace('/[^0-9]/', '', $phone);

    $phone_tel    = preg_replace('/[^0-9\+]/', '', $phone);

    if (strpos($phone_digits, '0') === 0 && strlen($phone_digits) >= 10) {

        $phone_wa = '49' . substr($phone_digits, 1);

    } else {

        $phone_wa = $phone_digits;

    }



    $wa_link_html = '';

    if (!empty($phone_wa)) {

        $wa_link_html = ' &bull; <a href="https://wa.me/' . esc_attr($phone_wa) . '" target="_blank" rel="noopener" class="vg-info-link-wa" style="color:#A98224; font-size:12px; font-weight:700; text-decoration:none;">💬 WhatsApp</a>';

    }



    $html_body = '<!DOCTYPE html>

<html lang="de" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="color-scheme" content="light dark">

<meta name="supported-color-schemes" content="light dark">

<title>Neue Nachricht — Vegan Garden Berlin</title>

<style>

  :root {

    color-scheme: light dark;

    supported-color-schemes: light dark;

  }

  body {

    margin: 0 !important;

    padding: 0 !important;

    width: 100% !important;

    -webkit-text-size-adjust: 100%;

    -ms-text-size-adjust: 100%;

  }

  table, td {

    mso-table-lspace: 0pt;

    mso-table-rspace: 0pt;

    border-collapse: collapse;

  }

  img {

    -ms-interpolation-mode: bicubic;

    border: 0;

    height: auto;

    line-height: 100%;

    outline: none;

    text-decoration: none;

    display: block;

  }

  a {

    text-decoration: none;

    color: #A98224;

  }

  a[x-apple-data-detectors] {

    color: inherit !important;

    text-decoration: none !important;

    font-size: inherit;

    font-family: inherit;

    font-weight: inherit;

    line-height: inherit;

  }

  @media (prefers-color-scheme: dark) {

    .vg-email-wrapper { background-color: #160E0A !important; }

    .vg-card-container {

      background-color: #221711 !important;

      border-color: rgba(169, 130, 36, 0.4) !important;

      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.45) !important;

    }

    .vg-body-cell { background-color: #221711 !important; }

    .vg-text-h2 { color: #FAF4E8 !important; }

    .vg-text-intro { color: #E2DACD !important; }

    .vg-text-intro strong { color: #FFFFFF !important; }

    .vg-info-card {

      background-color: #2A1D16 !important;

      border-color: #3D2D22 !important;

      border-left-color: #A98224 !important;

    }

    .vg-info-card-title {

      border-bottom-color: #3D2D22 !important;

      color: #C79A4A !important;

    }

    .vg-info-label { color: #A89D92 !important; }

    .vg-info-val { color: #FAF4E8 !important; }

    .vg-info-link { color: #FAF4E8 !important; text-decoration: none !important; }

    .vg-info-link-wa { color: #C79A4A !important; }

    .vg-msg-box {

      background-color: #2A1D16 !important;

      border-color: #3D2D22 !important;

      border-left-color: #A98224 !important;

    }

    .vg-msg-text { color: #FAF4E8 !important; }

    .vg-msg-title { color: #C79A4A !important; }

    .vg-footer-cell { background-color: #1A110D !important; }

    .vg-meta-row { color: #8C8074 !important; border-top-color: #3D2D22 !important; }

  }

  [data-ogsc] .vg-email-wrapper { background-color: #160E0A !important; }

  [data-ogsc] .vg-card-container { background-color: #221711 !important; border-color: rgba(169, 130, 36, 0.4) !important; }

  [data-ogsc] .vg-body-cell { background-color: #221711 !important; }

  [data-ogsc] .vg-text-h2 { color: #FAF4E8 !important; }

  [data-ogsc] .vg-text-intro { color: #E2DACD !important; }

  [data-ogsc] .vg-text-intro strong { color: #FFFFFF !important; }

  [data-ogsc] .vg-info-card { background-color: #2A1D16 !important; border-color: #3D2D22 !important; }

  [data-ogsc] .vg-info-card-title { color: #C79A4A !important; }

  [data-ogsc] .vg-info-label { color: #A89D92 !important; }

  [data-ogsc] .vg-info-val { color: #FAF4E8 !important; }

  [data-ogsc] .vg-info-link { color: #FAF4E8 !important; }

  [data-ogsc] .vg-info-link-wa { color: #C79A4A !important; }

  [data-ogsc] .vg-msg-box { background-color: #2A1D16 !important; border-color: #3D2D22 !important; }

  [data-ogsc] .vg-msg-text { color: #FAF4E8 !important; }

  [data-ogsc] .vg-msg-title { color: #C79A4A !important; }

  [data-ogsc] .vg-footer-cell { background-color: #1A110D !important; }

  [data-ogsc] .vg-meta-row { color: #8C8074 !important; border-top-color: #3D2D22 !important; }

</style>

</head>

<body id="body" class="vg-email-wrapper" style="margin:0; padding:0; background-color:#F6F1E7; font-family:-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; color:#211A16;">

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" class="vg-email-wrapper" style="background-color:#F6F1E7; padding:30px 12px;">

    <tr>

      <td align="center">

        <!--[if (gte mso 9)|(IE)]>

        <table align="center" border="0" cellspacing="0" cellpadding="0" width="580"><tr><td align="center" valign="top">

        <![endif]-->

        <table role="presentation" width="100%" class="vg-card-container" style="max-width:580px; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 8px 30px rgba(42, 22, 15, 0.12); border:1px solid rgba(169, 130, 36, 0.28);" cellspacing="0" cellpadding="0" border="0">

          

          <!-- BRAND HEADER -->

          <tr>

            <td class="vg-header-cell" style="background-color:#2A160F; background-image:linear-gradient(#2A160F, #2A160F); padding:30px 24px 24px; text-align:center; border-bottom:3px solid #A98224;">

              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">

                <tr>

                  <td align="center">

                    <img src="' . $logo_url . '" alt="Vegan Garden Berlin" width="220" style="display:block; max-width:220px; width:100%; height:auto; border:none; outline:none; text-decoration:none; margin:0 auto;">

                  </td>

                </tr>

                <tr>

                  <td align="center" style="padding-top:14px;">

                    <div style="display:inline-block; background-color:#A98224; background-image:linear-gradient(#A98224, #A98224); color:#ffffff; font-size:11px; text-transform:uppercase; letter-spacing:1.5px; font-weight:700; padding:4px 14px; border-radius:20px;">

                      ✉️ NEUE KONTAKTANFRAGE

                    </div>

                  </td>

                </tr>

              </table>

            </td>

          </tr>



          <!-- BODY CONTENT -->

          <tr>

            <td class="vg-body-cell" style="padding:32px 28px 30px; background-color:#ffffff;">

              <h2 class="vg-text-h2" style="color:#2A160F; font-size:21px; font-weight:700; margin:0 0 10px 0; font-family:Georgia, serif;">Neue Nachricht über das Kontaktformular</h2>

              <p class="vg-text-intro" style="font-size:15px; line-height:1.6; color:#4A4036; margin:0 0 20px 0;">

                Hallo <strong>Admin</strong>,<br>

                ein Besucher hat soeben eine neue Nachricht über das Kontaktformular auf <strong>vegan-garden.berlin</strong> gesendet:

              </p>



              <!-- SENDER INFO CARD -->

              <table role="presentation" width="100%" class="vg-info-card" style="background-color:#FBF9F5; border:1px solid #ECE4D8; border-left:4px solid #A98224; border-radius:8px; margin:22px 0 18px;" cellspacing="0" cellpadding="0">

                <tr>

                  <td colspan="2" class="vg-info-card-title" style="border-bottom:1px solid #ECE4D8; padding:12px 16px; font-weight:700; font-size:13px; color:#A98224; text-transform:uppercase; letter-spacing:1px;">

                    👤 Kontaktdaten des Absenders

                  </td>

                </tr>

                <tr>

                  <td width="32%" class="vg-info-label" style="padding:11px 16px 6px; font-size:14px; color:#6A625A;">Name:</td>

                  <td class="vg-info-val" style="padding:11px 16px 6px; font-size:15px; font-weight:700; color:#2A160F;">' . esc_html($name) . '</td>

                </tr>

                <tr>

                  <td class="vg-info-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Telefon:</td>

                  <td class="vg-info-val" style="padding:6px 16px; font-size:14px; color:#211A16;">

                    <a href="tel:' . esc_attr($phone_tel) . '" class="vg-info-link" style="color:#211A16; text-decoration:none; font-weight:600;">' . esc_html($phone) . '</a>' . $wa_link_html . '

                  </td>

                </tr>

                <tr>

                  <td class="vg-info-label" style="padding:6px 16px 11px; font-size:14px; color:#6A625A;">E-Mail:</td>

                  <td class="vg-info-val" style="padding:6px 16px 11px; font-size:14px; color:#211A16;">

                    <a href="mailto:' . esc_attr($email) . '" class="vg-info-link" style="color:#211A16; text-decoration:none; font-weight:600;">' . esc_html($email) . '</a>

                  </td>

                </tr>

              </table>



              <!-- MESSAGE BOX -->

              <table role="presentation" width="100%" class="vg-msg-box" style="background-color:#F8F5EE; border:1px solid #E5DEC9; border-left:4px solid #A98224; border-radius:8px; margin:0 0 24px;" cellspacing="0" cellpadding="0">

                <tr>

                  <td class="vg-msg-title" style="padding:12px 16px 6px; font-weight:700; font-size:13px; color:#A98224; text-transform:uppercase; letter-spacing:1px;">

                    💬 Nachricht / Anliegen:

                  </td>

                </tr>

                <tr>

                  <td class="vg-msg-text" style="padding:4px 16px 16px; font-size:14.5px; line-height:1.65; color:#2A160F; font-style:italic;">

                    "' . nl2br(esc_html($message)) . '"

                  </td>

                </tr>

              </table>



              <!-- ACTION BUTTONS -->

              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:20px 0 10px;">

                <tr>

                  <td align="center">

                    <a href="mailto:' . esc_attr($email) . '?subject=Re:%20Ihre%20Anfrage%20bei%20Vegan%20Garden%20Berlin" style="display:inline-block; background-color:#A98224; background-image:linear-gradient(#A98224, #A98224); color:#ffffff; font-size:13.5px; font-weight:700; padding:12px 24px; border-radius:30px; text-decoration:none; margin:4px 6px;">

                      ✉️ Per E-Mail antworten

                    </a>

                    <a href="tel:' . esc_attr($phone_tel) . '" style="display:inline-block; background-color:#2A160F; color:#FAF4E8; font-size:13.5px; font-weight:700; padding:12px 24px; border-radius:30px; text-decoration:none; margin:4px 6px; border:1px solid #A98224;">

                      📞 Direkt anrufen

                    </a>

                  </td>

                </tr>

              </table>



            </td>

          </tr>



          <!-- FOOTER -->

          <tr>

            <td class="vg-footer-cell" style="background-color:#2A160F; background-image:linear-gradient(#2A160F, #2A160F); padding:24px 28px; text-align:center; border-top:1px solid #3D2D22;">

              <p style="margin:0 0 6px 0; font-size:12px; color:#D2C8BC;">

                Vegan Garden Berlin &bull; Frankfurter Allee 21, 10247 Berlin

              </p>

              <p style="margin:0 0 8px 0; font-size:12px; color:#A98224;">

                <a href="' . esc_url(home_url('/')) . '" target="_blank" style="color:#A98224; text-decoration:underline;">vegan-garden.berlin</a>

              </p>

              <p class="vg-meta-row" style="margin:12px 0 0 0; font-size:11px; color:#8C8074; border-top:1px solid #3D2D22; padding-top:10px;">

                Eingegangen am: ' . esc_html($created_at) . ' &bull; Übertragen über Kontaktformular

              </p>

            </td>

          </tr>



        </table>

        <!--[if (gte mso 9)|(IE)]>

        </td></tr></table>

        <![endif]-->

      </td>

    </tr>

  </table>

</body>

</html>';



    $headers = array(

        'Content-Type: text/html; charset=UTF-8',

        'From: Vegan Garden Berlin <booking@vegan-garden.berlin>',

        sprintf('Reply-To: %s <%s>', $name, $email),

    );



    wp_mail($to, $subject, $html_body, $headers);



    wp_send_json_success('Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet. Wir melden uns in Kürze bei Ihnen.');

}



// Add custom columns to admin list
add_filter('manage_contact_message_posts_columns', function ($columns) {
    $new = array();
    $new['cb']      = $columns['cb'];
    $new['title']   = vg_admin_i18n('col_sender');
    $new['phone']   = vg_admin_i18n('col_phone');
    $new['email']   = vg_admin_i18n('col_email');
    $new['message'] = vg_admin_i18n('col_message');
    $new['date']    = vg_admin_i18n('col_date');
    return $new;
});



add_action('manage_contact_message_posts_custom_column', function ($column, $post_id) {

    switch ($column) {

        case 'phone':

            echo esc_html(get_post_meta($post_id, '_contact_phone', true));

            break;

        case 'email':

            $email = get_post_meta($post_id, '_contact_email', true);

            echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';

            break;

        case 'message':

            echo esc_html(wp_trim_words(get_the_content(null, false, $post_id), 15));

            break;

    }

}, 10, 2);



// Show unread count in admin menu

add_action('admin_menu', function () {

    $count = wp_count_posts('contact_message');

    $total = isset($count->publish) ? $count->publish : 0;

    if ($total > 0) {

        global $menu;

        foreach ($menu as $key => $item) {

            if (isset($item[2]) && $item[2] === 'edit.php?post_type=contact_message') {

                $menu[$key][0] .= " <span class='update-plugins count-{$total}'><span class='plugin-count'>{$total}</span></span>";

                break;

            }

        }

    }

}, 999);



// ============================================

// TABLE RESERVATION SYSTEM (CMS)

// ============================================



// Register Reservation custom post type

add_action('init', function () {
    register_post_type('vg_reservation', array(
        'labels' => array(
            'name'               => vg_admin_i18n('reservation_name', 'Reservierungen'),
            'singular_name'      => vg_admin_i18n('reservation_singular', 'Reservierung'),
            'menu_name'          => vg_admin_i18n('reservation_menu', 'Reservierungen'),
            'all_items'          => vg_admin_i18n('reservation_all', 'Alle Reservierungen'),
            'view_item'          => vg_admin_i18n('reservation_view', 'Reservierung ansehen'),
            'search_items'       => vg_admin_i18n('reservation_search', 'Reservierungen suchen'),
            'not_found'          => vg_admin_i18n('reservation_not_found', 'Keine Reservierungen gefunden'),
        ),

        'public'             => false,

        'show_ui'            => true,

        'show_in_menu'       => true,

        'menu_position'      => 6,

        'menu_icon'          => 'dashicons-calendar-alt',

        'supports'           => array('title'),

        'capability_type'    => 'post',

        'has_archive'        => false,

    ));

});



// Handle AJAX reservation submission

add_action('wp_ajax_vg_reservation_submit', 'vg_handle_reservation');

add_action('wp_ajax_nopriv_vg_reservation_submit', 'vg_handle_reservation');



function vg_handle_reservation() {

    // Verify nonce

    if (!isset($_POST['vg_reserve_nonce']) || !wp_verify_nonce($_POST['vg_reserve_nonce'], 'vg_reserve_form')) {

        wp_send_json_error('Sicherheitsfehler. Bitte laden Sie die Seite neu.');

        return;

    }



    // Sanitize

    $name   = sanitize_text_field($_POST['res_name'] ?? '');

    $email  = sanitize_email($_POST['res_email'] ?? '');

    $phone  = sanitize_text_field($_POST['res_phone'] ?? '');

    $date   = sanitize_text_field($_POST['res_date'] ?? '');

    $time   = sanitize_text_field($_POST['res_time'] ?? '');

    $guests = intval($_POST['res_guests'] ?? 1);

    $note   = sanitize_textarea_field($_POST['res_note'] ?? '');



    // Validate required

    if (empty($name) || empty($phone) || empty($email) || !is_email($email) || empty($date) || empty($time) || $guests < 1) {

        wp_send_json_error('Bitte füllen Sie alle Pflichtfelder mit einer gültigen E-Mail-Adresse aus.');

        return;

    }



    // Validate date format & not Monday

    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {

        $day = date('N', strtotime($date)); // 1=Mon

        if ($day == 1) {

            wp_send_json_error('Montags hat unser Restaurant Ruhetag. Bitte wählen Sie Di–So.');

            return;

        }

    }



    // Validate time 12:00-22:00

    if (preg_match('/^(\d{2}):(\d{2})$/', $time, $tm)) {

        $mins = intval($tm[1]) * 60 + intval($tm[2]);

        if ($mins < 720 || $mins > 1320) {

            wp_send_json_error('Reservierungen nur von 12:00 bis 22:00 Uhr möglich.');

            return;

        }

    }



    // Rate limiting: max 20 reservations per IP per hour

    $ip = $_SERVER['REMOTE_ADDR'];

    $rate_key = 'vg_reserve_' . md5($ip);

    $submissions = get_transient($rate_key);

    if ($submissions !== false && $submissions >= 20) {

        wp_send_json_error('Zu viele Anfragen. Bitte versuchen Sie es später.');

        return;

    }

    set_transient($rate_key, ($submissions ? $submissions + 1 : 1), HOUR_IN_SECONDS);



    // Format date for title

    $date_formatted = date('d.m.Y', strtotime($date));

    $title = sprintf('%s — %s %s — %d Pers.', $name, $date_formatted, $time, $guests);



    // Save to database

    $post_id = wp_insert_post(array(

        'post_type'    => 'vg_reservation',

        'post_title'   => $title,

        'post_content' => $note,

        'post_status'  => 'publish',

    ));



    if ($post_id) {

        update_post_meta($post_id, '_res_name', $name);

        update_post_meta($post_id, '_res_email', $email);

        update_post_meta($post_id, '_res_phone', $phone);

        update_post_meta($post_id, '_res_date', $date);

        update_post_meta($post_id, '_res_time', $time);

        update_post_meta($post_id, '_res_guests', $guests);

        update_post_meta($post_id, '_res_note', $note);

        update_post_meta($post_id, '_res_status', 'new');

        update_post_meta($post_id, '_res_ip', $ip);

        update_post_meta($post_id, '_res_created', current_time('mysql'));



        // Common email assets

        $guest_str = $guests === 1 ? '1 Person' : $guests . ' Personen';

        $logo_url  = esc_url(home_url('/logo/VN-02.png?v=20260918_noborder'));

        $created_at = current_time('d.m.Y, H:i') . ' Uhr';



        // Clean phone for tel: and WhatsApp

        $phone_digits = preg_replace('/[^0-9]/', '', $phone);

        $phone_tel    = preg_replace('/[^0-9\+]/', '', $phone);

        if (strpos($phone_digits, '0') === 0 && strlen($phone_digits) >= 10) {

            $phone_wa = '49' . substr($phone_digits, 1);

        } else {

            $phone_wa = $phone_digits;

        }



        $admin_note_row = '';

        if (!empty($note)) {

            $admin_note_row = '<tr><td style="padding:8px 16px 10px; font-size:14px; color:#6A625A; vertical-align:top; border-top:1px solid #ECE4D8;">Anmerkung:</td><td class="vg-res-val" style="padding:8px 16px 10px; font-size:14px; color:#211A16; border-top:1px solid #ECE4D8; font-style:italic;">' . esc_html($note) . '</td></tr>';

        } else {

            $admin_note_row = '<tr><td style="padding:8px 16px 10px; font-size:14px; color:#6A625A; vertical-align:top; border-top:1px solid #ECE4D8;">Anmerkung:</td><td class="vg-res-val" style="padding:8px 16px 10px; font-size:14px; color:#8C8074; border-top:1px solid #ECE4D8; font-style:italic;">Keine besonderen Anmerkungen angegeben.</td></tr>';

        }



        $wa_link_html = '';

        if (!empty($phone_wa)) {

            $wa_link_html = ' &bull; <a href="https://wa.me/' . esc_attr($phone_wa) . '" target="_blank" rel="noopener" class="vg-res-link-wa" style="color:#A98224; font-size:12px; font-weight:700; text-decoration:none;">💬 WhatsApp</a>';

        }



        // ============================================

        // 1. BRANDED HTML EMAIL NOTIFICATION TO ADMIN

        // ============================================

        $admin_to      = 'restaurant@vegan-garden.berlin';

        $admin_subject = sprintf('🔔 [Vegan Garden] Neue Reservierung: %s — %s um %s Uhr (%s)', $name, $date_formatted, $time, $guest_str);



        $admin_html = '<!DOCTYPE html>

<html lang="de" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="color-scheme" content="light dark">

<meta name="supported-color-schemes" content="light dark">

<title>' . esc_html($admin_subject) . '</title>

<style>

  :root {

    color-scheme: light dark;

    supported-color-schemes: light dark;

  }

  body {

    margin: 0 !important;

    padding: 0 !important;

    width: 100% !important;

    -webkit-text-size-adjust: 100%;

    -ms-text-size-adjust: 100%;

  }

  a[x-apple-data-detectors] {

    color: inherit !important;

    text-decoration: none !important;

    font-size: inherit !important;

    font-family: inherit !important;

    font-weight: inherit !important;

    line-height: inherit !important;

  }

  u + #body a, #MessageViewBody a {

    color: inherit;

    text-decoration: none;

    font-size: inherit;

    font-family: inherit;

    font-weight: inherit;

    line-height: inherit;

  }

  @media (prefers-color-scheme: dark) {

    .vg-email-wrapper { background-color: #160E0A !important; }

    .vg-card-container {

      background-color: #221711 !important;

      border-color: rgba(169, 130, 36, 0.4) !important;

      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.45) !important;

    }

    .vg-body-cell { background-color: #221711 !important; }

    .vg-text-h2 { color: #FAF4E8 !important; }

    .vg-text-intro { color: #E2DACD !important; }

    .vg-text-intro strong { color: #FFFFFF !important; }

    .vg-res-card {

      background-color: #2A1D16 !important;

      border-color: #3D2D22 !important;

      border-left-color: #A98224 !important;

    }

    .vg-res-card-title {

      border-bottom-color: #3D2D22 !important;

      color: #C79A4A !important;

    }

    .vg-res-label { color: #A89D92 !important; }

    .vg-res-val { color: #FAF4E8 !important; }

    .vg-res-link { color: #FAF4E8 !important; text-decoration: none !important; }

    .vg-res-link-wa { color: #C79A4A !important; }

    .vg-footer-cell { background-color: #1A110D !important; }

    .vg-meta-row { color: #8C8074 !important; border-top-color: #3D2D22 !important; }

  }

  [data-ogsc] .vg-email-wrapper { background-color: #160E0A !important; }

  [data-ogsc] .vg-card-container { background-color: #221711 !important; border-color: rgba(169, 130, 36, 0.4) !important; }

  [data-ogsc] .vg-body-cell { background-color: #221711 !important; }

  [data-ogsc] .vg-text-h2 { color: #FAF4E8 !important; }

  [data-ogsc] .vg-text-intro { color: #E2DACD !important; }

  [data-ogsc] .vg-text-intro strong { color: #FFFFFF !important; }

  [data-ogsc] .vg-res-card { background-color: #2A1D16 !important; border-color: #3D2D22 !important; }

  [data-ogsc] .vg-res-card-title { color: #C79A4A !important; }

  [data-ogsc] .vg-res-label { color: #A89D92 !important; }

  [data-ogsc] .vg-res-val { color: #FAF4E8 !important; }

  [data-ogsc] .vg-res-link { color: #FAF4E8 !important; }

  [data-ogsc] .vg-res-link-wa { color: #C79A4A !important; }

  [data-ogsc] .vg-footer-cell { background-color: #1A110D !important; }

  [data-ogsc] .vg-meta-row { color: #8C8074 !important; border-top-color: #3D2D22 !important; }

</style>

</head>

<body id="body" class="vg-email-wrapper" style="margin:0; padding:0; background-color:#F6F1E7; font-family:-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; color:#211A16;">

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" class="vg-email-wrapper" style="background-color:#F6F1E7; padding:30px 12px;">

    <tr>

      <td align="center">

        <!--[if (gte mso 9)|(IE)]>

        <table align="center" border="0" cellspacing="0" cellpadding="0" width="580"><tr><td align="center" valign="top">

        <![endif]-->

        <table role="presentation" width="100%" class="vg-card-container" style="max-width:580px; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 8px 30px rgba(42, 22, 15, 0.12); border:1px solid rgba(169, 130, 36, 0.28);" cellspacing="0" cellpadding="0" border="0">

          

          <!-- BRAND HEADER -->

          <tr>

            <td class="vg-header-cell" style="background-color:#2A160F; background-image:linear-gradient(#2A160F, #2A160F); padding:30px 24px 24px; text-align:center; border-bottom:3px solid #A98224;">

              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">

                <tr>

                  <td align="center">

                    <img src="' . $logo_url . '" alt="Vegan Garden Berlin" width="220" style="display:block; max-width:220px; width:100%; height:auto; border:none; outline:none; text-decoration:none; margin:0 auto;">

                  </td>

                </tr>

                <tr>

                  <td align="center" style="padding-top:14px;">

                    <div style="display:inline-block; background-color:#A98224; background-image:linear-gradient(#A98224, #A98224); color:#ffffff; font-size:11px; text-transform:uppercase; letter-spacing:1.5px; font-weight:700; padding:4px 14px; border-radius:20px;">

                      🔔 NEUE RESERVIERUNGSANFRAGE

                    </div>

                  </td>

                </tr>

              </table>

            </td>

          </tr>



          <!-- BODY CONTENT -->

          <tr>

            <td class="vg-body-cell" style="padding:32px 28px 30px; background-color:#ffffff;">

              <h2 class="vg-text-h2" style="color:#2A160F; font-size:21px; font-weight:700; margin:0 0 10px 0; font-family:Georgia, serif;">Neue Tischreservierung eingegangen!</h2>

              <p class="vg-text-intro" style="font-size:15px; line-height:1.6; color:#4A4036; margin:0 0 20px 0;">

                Hallo <strong>Admin</strong>,<br>

                soeben ist eine neue Tischreservierungsanfrage über die Website eingegangen. Bitte prüfen Sie die Angaben und reservieren Sie rechtzeitig den Tisch:

              </p>



              <!-- RESERVATION CARD -->

              <table role="presentation" width="100%" class="vg-res-card" style="background-color:#FBF9F5; border:1px solid #ECE4D8; border-left:4px solid #A98224; border-radius:8px; margin:22px 0;" cellspacing="0" cellpadding="0">

                <tr>

                  <td colspan="2" class="vg-res-card-title" style="border-bottom:1px solid #ECE4D8; padding:12px 16px; font-weight:700; font-size:13px; color:#A98224; text-transform:uppercase; letter-spacing:1px;">

                    📋 Kundendaten &amp; Buchungsdetails

                  </td>

                </tr>

                <tr>

                  <td width="36%" class="vg-res-label" style="padding:11px 16px 6px; font-size:14px; color:#6A625A;">Kunde:</td>

                  <td class="vg-res-val" style="padding:11px 16px 6px; font-size:15px; font-weight:700; color:#2A160F;">' . esc_html($name) . '</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Datum:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; font-weight:700; color:#2A160F;">' . esc_html($date_formatted) . '</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Uhrzeit:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; font-weight:700; color:#8F6D1E;">' . esc_html($time) . ' Uhr</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Personen:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; font-weight:700; color:#2A160F;">' . esc_html($guest_str) . '</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Telefon:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; color:#211A16;">

                    <a href="tel:' . esc_attr($phone_tel) . '" class="vg-res-link" style="color:#211A16; text-decoration:none; font-weight:600;">' . esc_html($phone) . '</a>' . $wa_link_html . '

                  </td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">E-Mail:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; color:#211A16;">

                    ' . (!empty($email) ? '<a href="mailto:' . esc_attr($email) . '" class="vg-res-link" style="color:#211A16; text-decoration:none;">' . esc_html($email) . '</a>' : '<span style="color:#8C8074;">—</span>') . '

                  </td>

                </tr>

                ' . $admin_note_row . '

              </table>

            </td>

          </tr>

        </table>

        <!--[if (gte mso 9)|(IE)]>

        </td></tr></table>

        <![endif]-->

      </td>

    </tr>

  </table>

</body>

</html>';



        $admin_headers = array(

            'Content-Type: text/html; charset=UTF-8',

            'From: Vegan Garden Berlin <booking@vegan-garden.berlin>',

            'Reply-To: ' . (!empty($email) ? esc_html($name) . ' <' . $email . '>' : 'booking@vegan-garden.berlin')

        );

        wp_mail($admin_to, $admin_subject, $admin_html, $admin_headers);



        // ============================================

        // 2. BRANDED HTML CONFIRMATION EMAIL TO CUSTOMER

        // ============================================

        if (!empty($email) && is_email($email)) {

            $cust_subject = 'Bestätigung Ihrer Reservierungsanfrage — Vegan Garden Berlin';

            

            $note_row = '';

            if (!empty($note)) {

                $note_row = '<tr><td style="padding:6px 16px 10px; font-size:14px; color:#6A625A; vertical-align:top; border-top:1px solid #ECE4D8;">Anmerkung:</td><td style="padding:6px 16px 10px; font-size:14px; color:#211A16; border-top:1px solid #ECE4D8; font-style:italic;">' . esc_html($note) . '</td></tr>';

            }



            $cust_html = '<!DOCTYPE html>

<html lang="de" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="color-scheme" content="light dark">

<meta name="supported-color-schemes" content="light dark">

<title>Bestätigung Ihrer Reservierungsanfrage — Vegan Garden Berlin</title>

<style>

  :root {

    color-scheme: light dark;

    supported-color-schemes: light dark;

  }

  

  body {

    margin: 0 !important;

    padding: 0 !important;

    width: 100% !important;

    -webkit-text-size-adjust: 100%;

    -ms-text-size-adjust: 100%;

  }



  /* Prevent auto blue links on iOS, Apple Mail, Gmail */

  a[x-apple-data-detectors] {

    color: inherit !important;

    text-decoration: none !important;

    font-size: inherit !important;

    font-family: inherit !important;

    font-weight: inherit !important;

    line-height: inherit !important;

  }

  u + #body a {

    color: inherit;

    text-decoration: none;

    font-size: inherit;

    font-family: inherit;

    font-weight: inherit;

    line-height: inherit;

  }

  #MessageViewBody a {

    color: inherit;

    text-decoration: none;

    font-size: inherit;

    font-family: inherit;

    font-weight: inherit;

    line-height: inherit;

  }



  /* DARK MODE OVERRIDES */

  @media (prefers-color-scheme: dark) {

    .vg-email-wrapper {

      background-color: #160E0A !important;

    }

    .vg-card-container {

      background-color: #221711 !important;

      border-color: rgba(169, 130, 36, 0.4) !important;

      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.45) !important;

    }

    .vg-body-cell {

      background-color: #221711 !important;

    }

    .vg-text-h2 {

      color: #FAF4E8 !important;

    }

    .vg-text-intro {

      color: #E2DACD !important;

    }

    .vg-text-intro strong {

      color: #FFFFFF !important;

    }

    .vg-res-card {

      background-color: #2A1D16 !important;

      border-color: #3D2D22 !important;

      border-left-color: #A98224 !important;

    }

    .vg-res-card-title {

      border-bottom-color: #3D2D22 !important;

      color: #C79A4A !important;

    }

    .vg-res-label {

      color: #A89D92 !important;

    }

    .vg-res-val {

      color: #FAF4E8 !important;

    }

    .vg-res-link {

      color: #FAF4E8 !important;

      text-decoration: none !important;

    }

    .vg-notice-box {

      background-color: #2D2015 !important;

      border-color: rgba(169, 130, 36, 0.4) !important;

      border-left-color: #A98224 !important;

      color: #F0DFC0 !important;

    }

    .vg-notice-link {

      color: #C79A4A !important;

    }

    .vg-sign-text {

      color: #E2DACD !important;

    }

    .vg-sign-team {

      color: #FAF4E8 !important;

    }

    .vg-footer-cell {

      background-color: #1A110D !important;

    }

  }



  /* OUTLOOK.COM DARK MODE */

  [data-ogsc] .vg-email-wrapper { background-color: #160E0A !important; }

  [data-ogsc] .vg-card-container { background-color: #221711 !important; border-color: rgba(169, 130, 36, 0.4) !important; }

  [data-ogsc] .vg-body-cell { background-color: #221711 !important; }

  [data-ogsc] .vg-text-h2 { color: #FAF4E8 !important; }

  [data-ogsc] .vg-text-intro { color: #E2DACD !important; }

  [data-ogsc] .vg-text-intro strong { color: #FFFFFF !important; }

  [data-ogsc] .vg-res-card { background-color: #2A1D16 !important; border-color: #3D2D22 !important; }

  [data-ogsc] .vg-res-card-title { color: #C79A4A !important; }

  [data-ogsc] .vg-res-label { color: #A89D92 !important; }

  [data-ogsc] .vg-res-val { color: #FAF4E8 !important; }

  [data-ogsc] .vg-res-link { color: #FAF4E8 !important; }

  [data-ogsc] .vg-notice-box { background-color: #2D2015 !important; color: #F0DFC0 !important; }

  [data-ogsc] .vg-notice-link { color: #C79A4A !important; }

  [data-ogsc] .vg-sign-text { color: #E2DACD !important; }

  [data-ogsc] .vg-sign-team { color: #FAF4E8 !important; }

  [data-ogsc] .vg-footer-cell { background-color: #1A110D !important; }

</style>

</head>

<body id="body" class="vg-email-wrapper" style="margin:0; padding:0; background-color:#F6F1E7; font-family:-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; color:#211A16;">

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" class="vg-email-wrapper" style="background-color:#F6F1E7; padding:30px 12px;">

    <tr>

      <td align="center">

        <!--[if (gte mso 9)|(IE)]>

        <table align="center" border="0" cellspacing="0" cellpadding="0" width="580"><tr><td align="center" valign="top">

        <![endif]-->

        <table role="presentation" width="100%" class="vg-card-container" style="max-width:580px; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 8px 30px rgba(42, 22, 15, 0.12); border:1px solid rgba(169, 130, 36, 0.28);" cellspacing="0" cellpadding="0" border="0">

          

          <!-- BRAND HEADER -->

          <tr>

            <td class="vg-header-cell" style="background-color:#2A160F; background-image:linear-gradient(#2A160F, #2A160F); padding:32px 24px 26px; text-align:center; border-bottom:3px solid #A98224;">

              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">

                <tr>

                  <td align="center">

                    <img src="' . $logo_url . '" alt="Vegan Garden Berlin" width="220" style="display:block; max-width:220px; width:100%; height:auto; border:none; outline:none; text-decoration:none; margin:0 auto;">

                  </td>

                </tr>

                <tr>

                  <td align="center" style="padding-top:14px;">

                    <p style="color:#C79A4A; font-size:11px; text-transform:uppercase; letter-spacing:2px; margin:0; font-weight:600;">100 % Vegane Vietnamesische Küche</p>

                  </td>

                </tr>

              </table>

            </td>

          </tr>



          <!-- BODY CONTENT -->

          <tr>

            <td class="vg-body-cell" style="padding:32px 28px 24px; background-color:#ffffff;">

              <h2 class="vg-text-h2" style="color:#2A160F; font-size:20px; font-weight:700; margin:0 0 14px 0; font-family:Georgia, serif;">Ihre Reservierungsanfrage ist eingegangen!</h2>

              <p class="vg-text-intro" style="font-size:15px; line-height:1.6; color:#4A4036; margin:0 0 20px 0;">

                Hallo <strong style="color:#2A160F;">' . esc_html($name) . '</strong>,<br><br>

                vielen Dank für Ihre Tischreservierung im <strong>Vegan Garden Berlin</strong>. Wir haben Ihre Daten erfolgreich erhalten und freuen uns sehr darauf, Sie bei uns begrüßen zu dürfen!

              </p>



              <!-- RESERVATION CARD -->

              <table role="presentation" width="100%" class="vg-res-card" style="background-color:#FBF9F5; border:1px solid #ECE4D8; border-left:4px solid #A98224; border-radius:8px; margin:22px 0;" cellspacing="0" cellpadding="0">

                <tr>

                  <td colspan="2" class="vg-res-card-title" style="border-bottom:1px solid #ECE4D8; padding:12px 16px; font-weight:700; font-size:13px; color:#A98224; text-transform:uppercase; letter-spacing:1px;">

                    📅 Details Ihrer Reservierung

                  </td>

                </tr>

                <tr>

                  <td width="36%" class="vg-res-label" style="padding:10px 16px 6px; font-size:14px; color:#6A625A;">Datum:</td>

                  <td class="vg-res-val" style="padding:10px 16px 6px; font-size:14px; font-weight:700; color:#2A160F;">' . esc_html($date_formatted) . '</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Uhrzeit:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; font-weight:700; color:#2A160F;">' . esc_html($time) . ' Uhr</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Personen:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; font-weight:700; color:#2A160F;">' . esc_html($guest_str) . '</td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px; font-size:14px; color:#6A625A;">Telefon:</td>

                  <td class="vg-res-val" style="padding:6px 16px; font-size:14px; color:#211A16;">

                    <a href="tel:' . esc_attr(preg_replace('/[^0-9\+]/', '', $phone)) . '" class="vg-res-link" style="color:#211A16; text-decoration:none; font-weight:500;">' . esc_html($phone) . '</a>

                  </td>

                </tr>

                <tr>

                  <td class="vg-res-label" style="padding:6px 16px 10px; font-size:14px; color:#6A625A;">E-Mail:</td>

                  <td class="vg-res-val" style="padding:6px 16px 10px; font-size:14px; color:#211A16;">

                    <a href="mailto:' . esc_attr($email) . '" class="vg-res-link" style="color:#211A16; text-decoration:none;">' . esc_html($email) . '</a>

                  </td>

                </tr>

                ' . $note_row . '

              </table>



              <!-- NOTICE BOX -->

              <div class="vg-notice-box" style="background-color:#FAF4E8; border:1px solid rgba(169, 130, 36, 0.3); border-left:4px solid #A98224; padding:14px 16px; border-radius:6px; font-size:13px; line-height:1.6; color:#523C12; margin:22px 0;">

                <strong>Wichtiger Hinweis:</strong> Sollten sich Ihre Pläne ändern oder möchten Sie die Reservierung anpassen, kontaktieren Sie uns bitte rechtzeitig telefonisch unter <a href="tel:+493021237260" class="vg-notice-link" style="color:#A98224; font-weight:700; text-decoration:none;">+49 30 2123 7260</a> oder per WhatsApp unter <a href="https://wa.me/491624649999" target="_blank" rel="noopener" class="vg-notice-link" style="color:#A98224; font-weight:700; text-decoration:none;">+49 16 2464 9999</a>.

              </div>



              <!-- ROUTE BUTTON -->

              <div style="text-align:center; margin:26px 0 12px;">

                <a href="https://maps.app.goo.gl/St5dH8yWhqsPBheCA" target="_blank" rel="noopener" style="background-color:#A98224; background-image:linear-gradient(#A98224, #A98224); color:#ffffff !important; font-size:13px; font-weight:700; text-decoration:none; padding:13px 28px; border-radius:8px; display:inline-block; letter-spacing:0.5px; box-shadow:0 4px 12px rgba(169, 130, 36, 0.3);">

                  📍 ROUTE / GOOGLE MAPS

                </a>

              </div>



              <p class="vg-sign-text" style="font-size:14px; line-height:1.6; color:#4A4036; margin:24px 0 0 0;">

                Wir freuen uns auf Ihren Besuch!<br><br>

                Herzliche Grüße,<br>

                <strong class="vg-sign-team" style="color:#2A160F;">Ihr Vegan Garden Berlin Team</strong>

              </p>

            </td>

          </tr>



          <!-- BRAND FOOTER -->

          <tr>

            <td class="vg-footer-cell" style="background-color:#2A160F; background-image:linear-gradient(#2A160F, #2A160F); padding:22px 24px; text-align:center; font-size:12px; color:#C4BBB3; line-height:1.7;">

              <strong style="color:#C79A4A; font-size:14px;">Vegan Garden Berlin</strong><br>

              <a href="https://maps.app.goo.gl/St5dH8yWhqsPBheCA" target="_blank" rel="noopener" style="color:#C4BBB3; text-decoration:underline;">📍 Frankfurter Allee 21, 10247 Berlin, Germany</a><br>

              Telefon: <a href="tel:+493021237260" style="color:#C79A4A; text-decoration:none; font-weight:600;">+49 30 2123 7260</a> &bull; WhatsApp: <a href="https://wa.me/491624649999" target="_blank" rel="noopener" style="color:#C79A4A; text-decoration:none; font-weight:600;">+49 16 2464 9999</a><br>

              Website: <a href="' . esc_url(home_url('/')) . '" target="_blank" style="color:#ffffff; text-decoration:underline; font-weight:600;">vegan-garden.berlin</a>

            </td>

          </tr>

        </table>

        <!--[if (gte mso 9)|(IE)]>

        </td></tr></table>

        <![endif]-->

      </td>

    </tr>

  </table>

</body>

</html>';



            $cust_headers = array(

                'Content-Type: text/html; charset=UTF-8',

                'From: Vegan Garden Berlin <booking@vegan-garden.berlin>',

                'Reply-To: Vegan Garden Berlin <booking@vegan-garden.berlin>'

            );

            wp_mail($email, $cust_subject, $cust_html, $cust_headers);

        }

    }



    wp_send_json_success('Vielen Dank! Ihre Reservierung wurde erfolgreich gesendet. Wir bestätigen in Kürze.');

}



// Admin columns for Reservations
add_filter('manage_vg_reservation_posts_columns', function ($columns) {
    return array(
        'cb'        => $columns['cb'],
        'title'     => vg_admin_i18n('reservation_singular'),
        'date_time' => vg_admin_i18n('col_datetime'),
        'guests'    => vg_admin_i18n('col_guests'),
        'phone'     => vg_admin_i18n('col_phone'),
        'email'     => vg_admin_i18n('col_email'),
        'status'    => vg_admin_i18n('col_status'),
        'date'      => vg_admin_i18n('col_date'),
    );
});



add_action('manage_vg_reservation_posts_custom_column', function ($column, $post_id) {

    switch ($column) {

        case 'date_time':

            $d = get_post_meta($post_id, '_res_date', true);

            $t = get_post_meta($post_id, '_res_time', true);

            if ($d) echo '<strong>' . date('d.m.Y', strtotime($d)) . '</strong>';

            if ($t) echo ' um ' . esc_html($t);

            // Highlight if today or past

            if ($d && strtotime($d) < strtotime('today')) {

                echo ' <span style="color:#999; font-size:11px;">✓ vergangen</span>';

            } elseif ($d && strtotime($d) == strtotime('today')) {

                echo ' <span style="color:#e65100; font-weight:700; font-size:11px;">⚡ HEUTE</span>';

            }

            break;

        case 'guests':

            echo intval(get_post_meta($post_id, '_res_guests', true));

            break;

        case 'phone':

            $p = get_post_meta($post_id, '_res_phone', true);

            echo '<a href="tel:' . esc_attr(preg_replace('/[^0-9+]/', '', $p)) . '">' . esc_html($p) . '</a>';

            break;

        case 'email':

            $e = get_post_meta($post_id, '_res_email', true);

            if ($e) echo '<a href="mailto:' . esc_attr($e) . '">' . esc_html($e) . '</a>';

            else echo '—';

            break;

        case 'status':

            $s = get_post_meta($post_id, '_res_status', true);

            $labels = array(

                'new'       => array('🆕 Neu', '#1976d2'),

                'confirmed' => array('✅ Bestätigt', '#4CAF50'),

                'cancelled' => array('❌ Storniert', '#f44336'),

                'completed' => array('✓ Abgeschlossen', '#999'),

            );

            $info = $labels[$s] ?? array('🆕 Neu', '#1976d2');

            echo '<span style="color:' . $info[1] . '; font-weight:600;">' . $info[0] . '</span>';

            break;

    }

}, 10, 2);



// Add status meta box to reservation edit screen

add_action('add_meta_boxes', function () {

    add_meta_box('vg_res_status_box', 'Reservierung-Status', 'vg_res_status_meta_box', 'vg_reservation', 'side', 'high');

});



function vg_res_status_meta_box($post) {

    wp_nonce_field('vg_res_status', 'vg_res_status_nonce');

    $status = get_post_meta($post->ID, '_res_status', true) ?: 'new';

    $name   = get_post_meta($post->ID, '_res_name', true);

    $phone  = get_post_meta($post->ID, '_res_phone', true);

    $email  = get_post_meta($post->ID, '_res_email', true);

    $date   = get_post_meta($post->ID, '_res_date', true);

    $time   = get_post_meta($post->ID, '_res_time', true);

    $guests = get_post_meta($post->ID, '_res_guests', true);

    $note   = get_post_meta($post->ID, '_res_note', true);

    ?>

    <div style="margin-bottom: 12px;">

        <label for="res_status" style="font-weight:600; display:block; margin-bottom:4px;">Status:</label>

        <select name="res_status" id="res_status" style="width:100%; padding:6px;">

            <option value="new" <?php selected($status, 'new'); ?>>🆕 Neu</option>

            <option value="confirmed" <?php selected($status, 'confirmed'); ?>>✅ Bestätigt</option>

            <option value="cancelled" <?php selected($status, 'cancelled'); ?>>❌ Storniert</option>

            <option value="completed" <?php selected($status, 'completed'); ?>>✓ Abgeschlossen</option>

        </select>

    </div>

    <hr>

    <div style="font-size:13px; line-height:1.8;">

        <strong>👤 Name:</strong> <?php echo esc_html($name); ?><br>

        <strong>📞 Telefon:</strong> <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a><br>

        <?php if ($email): ?><strong>📧 E-Mail:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><br><?php endif; ?>

        <strong>📅 Datum:</strong> <?php echo $date ? date('d.m.Y', strtotime($date)) : '—'; ?><br>

        <strong>🕒 Uhrzeit:</strong> <?php echo esc_html($time); ?><br>

        <strong>👥 Personen:</strong> <?php echo intval($guests); ?><br>

        <?php if ($note): ?><strong>📝 Anmerkung:</strong> <?php echo esc_html($note); ?><br><?php endif; ?>

    </div>

    <?php

}



// Save reservation status

add_action('save_post_vg_reservation', function ($post_id) {

    if (!isset($_POST['vg_res_status_nonce']) || !wp_verify_nonce($_POST['vg_res_status_nonce'], 'vg_res_status')) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $valid = array('new', 'confirmed', 'cancelled', 'completed');

    $status = sanitize_text_field($_POST['res_status'] ?? 'new');

    if (in_array($status, $valid)) {

        update_post_meta($post_id, '_res_status', $status);

    }

});



// Show reservation count badge in admin menu

add_action('admin_menu', function () {

    $count = new WP_Query(array(

        'post_type' => 'vg_reservation',

        'post_status' => 'publish',

        'meta_query' => array(array('key' => '_res_status', 'value' => 'new')),

        'fields' => 'ids',

        'posts_per_page' => -1,

    ));

    $total = $count->found_posts;

    if ($total > 0) {

        global $menu;

        foreach ($menu as $key => $item) {

            if (isset($item[2]) && $item[2] === 'edit.php?post_type=vg_reservation') {

                $menu[$key][0] .= " <span class='update-plugins count-{$total}'><span class='plugin-count'>{$total}</span></span>";

                break;

            }

        }

    }

}, 999);



// ============================================

// CUSTOM LOGIN PAGE BRANDING & STYLING

// ============================================



function vegangarden_custom_login_scripts() {

    wp_enqueue_style('vegangarden-login-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans:wght@400;500;600;700&display=swap', array(), null);

    $bg_img = esc_url(home_url('/images/banner_4.jpeg'));

    $logo_img = esc_url(home_url('/logo/VN-03.png'));

    ?>

    <style type="text/css">

        /* Reset & Base */

        html, body.login {

            min-height: 100% !important;

        }



        body.login {

            background-color: #1a0d08 !important;

            background-image: linear-gradient(135deg, rgba(26, 13, 8, 0.90) 0%, rgba(42, 22, 15, 0.86) 100%), url('<?php echo $bg_img; ?>') !important;

            background-position: center center !important;

            background-size: cover !important;

            background-repeat: no-repeat !important;

            background-attachment: fixed !important;

            font-family: 'Plus Jakarta Sans', 'Noto Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;

            display: flex !important;

            flex-direction: column !important;

            justify-content: center !important;

            align-items: center !important;

            padding: 40px 16px !important;

            box-sizing: border-box !important;

            position: relative !important;

        }



        /* Container */

        #login {

            width: 440px !important;

            max-width: 100% !important;

            padding: 0 !important;

            margin: 0 auto !important;

            position: relative !important;

            z-index: 10 !important;

        }



        /* Logo Badge */

        #login h1 {

            margin: 0 0 16px 0 !important;

            text-align: center !important;

            line-height: 1 !important;

        }



        #login h1 a {

            background-image: url('<?php echo $logo_img; ?>') !important;

            background-size: contain !important;

            background-repeat: no-repeat !important;

            background-position: center !important;

            width: 100% !important;

            max-width: 370px !important;

            height: 74px !important;

            margin: 0 auto !important;

            border-radius: 14px !important;

            background-color: #361300 !important;

            box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.65), 0 0 0 1.5px rgba(169, 130, 36, 0.55) !important;

            padding: 12px 24px !important;

            box-sizing: border-box !important;

            border: none !important;

            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;

            display: block !important;

            text-indent: -9999px;

            overflow: hidden;

        }



        #login h1 a:hover {

            transform: translateY(-2px) scale(1.01) !important;

            box-shadow: 0 20px 42px -6px rgba(0, 0, 0, 0.75), 0 0 0 2.5px rgba(199, 154, 74, 0.85) !important;

        }



        /* Tiêu đề CỔNG QUẢN TRỊ WEBSITE */

        .vg-login-title {

            font-family: 'Plus Jakarta Sans', sans-serif !important;

            font-size: 1.15rem !important;

            font-weight: 800 !important;

            color: #ffffff !important;

            letter-spacing: 1.4px !important;

            text-align: center !important;

            margin: 0 0 20px 0 !important;

            text-transform: uppercase !important;

            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6) !important;

        }



        /* Thẻ Form Card */

        #loginform, #lostpasswordform, #resetpassform {

            background: #ffffff !important;

            border-radius: 20px !important;

            padding: 34px 32px 30px !important;

            border: 1px solid rgba(255, 255, 255, 0.95) !important;

            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.55), 0 0 0 1px rgba(226, 232, 240, 0.6) !important;

        }



        /* Nhãn */

        #loginform label, #lostpasswordform label, #resetpassform label {

            font-family: 'Plus Jakarta Sans', sans-serif !important;

            font-size: 0.88rem !important;

            font-weight: 600 !important;

            color: #2A160F !important;

            margin-bottom: 6px !important;

            display: block !important;

        }



        /* Inputs */

        .login input[type="text"],

        .login input[type="password"],

        .login input[type="email"] {

            height: 48px !important;

            font-size: 0.98rem !important;

            font-family: 'Noto Sans', sans-serif !important;

            border: 1.5px solid #cbd5e1 !important;

            border-radius: 12px !important;

            background: #f8fafc !important;

            padding: 0 16px !important;

            color: #0f172a !important;

            margin-top: 6px !important;

            margin-bottom: 16px !important;

            width: 100% !important;

            box-sizing: border-box !important;

            transition: all 0.2s ease !important;

            outline: none !important;

        }



        .login input[type="text"]:focus,

        .login input[type="password"]:focus,

        .login input[type="email"]:focus {

            background: #ffffff !important;

            border-color: #A98224 !important;

            box-shadow: 0 0 0 4px rgba(169, 130, 36, 0.18) !important;

        }



        /* Password Toggle */

        .login .user-pass-wrap {

            position: relative !important;

            margin-bottom: 16px !important;

        }



        .login .user-pass-wrap .wp-pwd {

            position: relative !important;

        }



        .wp-pwd .button.wp-hide-pw {

            position: absolute !important;

            right: 8px !important;

            top: 50% !important;

            transform: translateY(-50%) !important;

            background: transparent !important;

            border: none !important;

            box-shadow: none !important;

            color: #64748b !important;

            cursor: pointer !important;

            padding: 0 6px !important;

            display: flex !important;

            align-items: center !important;

            justify-content: center !important;

        }



        .wp-pwd .button.wp-hide-pw:hover {

            color: #2A160F !important;

        }



        /* Checkbox Ghi nhớ */

        .login .forgetmenot {

            margin: 4px 0 18px 0 !important;

            float: none !important;

        }



        .login .forgetmenot label {

            display: inline-flex !important;

            align-items: center !important;

            gap: 8px !important;

            font-family: 'Noto Sans', sans-serif !important;

            font-size: 0.88rem !important;

            font-weight: 500 !important;

            color: #475569 !important;

            cursor: pointer !important;

            margin-bottom: 0 !important;

        }



        .login input[type="checkbox"] {

            border-radius: 5px !important;

            border: 1.5px solid #94a3b8 !important;

            width: 17px !important;

            height: 17px !important;

            accent-color: #A98224 !important;

            margin: 0 !important;

            cursor: pointer !important;

        }



        /* Nút Submit Đăng nhập */

        .login p.submit {

            margin: 0 !important;

            padding: 0 !important;

        }



        .login .button.button-primary {

            float: none !important;

            width: 100% !important;

            height: 48px !important;

            line-height: 48px !important;

            padding: 0 24px !important;

            background: linear-gradient(135deg, #2A160F 0%, #432216 45%, #A98224 100%) !important;

            border: none !important;

            border-radius: 12px !important;

            font-family: 'Plus Jakarta Sans', sans-serif !important;

            font-size: 1.02rem !important;

            font-weight: 700 !important;

            color: #ffffff !important;

            letter-spacing: 0.4px !important;

            box-shadow: 0 10px 24px -4px rgba(169, 130, 36, 0.45) !important;

            cursor: pointer !important;

            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;

            margin-top: 6px !important;

            display: block !important;

            text-align: center !important;

            text-shadow: none !important;

            outline: none !important;

        }



        .login .button.button-primary:hover,

        .login .button.button-primary:focus {

            background: linear-gradient(135deg, #381D14 0%, #522B1D 45%, #C2962D 100%) !important;

            box-shadow: 0 14px 28px -4px rgba(169, 130, 36, 0.65) !important;

            transform: translateY(-2px) !important;

            color: #ffffff !important;

        }



        .login .button.button-primary:active {

            transform: translateY(0) !important;

            box-shadow: 0 4px 12px -2px rgba(169, 130, 36, 0.5) !important;

        }



        /* Thông báo lỗi & Thông điệp */

        #login_error, .login .message, .login .notice {

            border-radius: 12px !important;

            border-left: none !important;

            padding: 14px 18px !important;

            margin-bottom: 20px !important;

            font-size: 0.88rem !important;

            box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.25) !important;

            line-height: 1.5 !important;

        }



        #login_error {

            background-color: #fef2f2 !important;

            border: 1px solid #fecaca !important;

            color: #991b1b !important;

        }



        #login_error a {

            color: #dc2626 !important;

            font-weight: 600 !important;

        }



        .login .message, .login .notice {

            background-color: #eff6ff !important;

            border: 1px solid #bfdbfe !important;

            color: #1e40af !important;

        }



        /* Links bên dưới form */

        #login #nav {

            padding: 0 !important;

            margin: 20px 0 0 0 !important;

            text-align: center !important;

            font-size: 0.92rem !important;

        }



        #login #nav a {

            color: #f1f5f9 !important;

            text-decoration: none !important;

            font-weight: 500 !important;

            transition: color 0.2s ease !important;

            text-shadow: 0 2px 4px rgba(0,0,0,0.5);

        }



        #login #nav a:hover {

            color: #eab308 !important;

            text-decoration: underline !important;

        }



        #login #backtoblog {

            display: none !important;

        }



        /* Language Switcher */

        .language-switcher {

            margin-top: 24px !important;

            text-align: center !important;

        }



        .language-switcher label {

            color: #cbd5e1 !important;

            font-size: 0.85rem !important;

            margin-right: 6px;

        }



        .language-switcher select {

            background: rgba(42, 22, 15, 0.75) !important;

            color: #ffffff !important;

            border: 1px solid rgba(169, 130, 36, 0.4) !important;

            border-radius: 8px !important;

            padding: 6px 14px !important;

            font-size: 0.85rem !important;

            outline: none;

        }



        .language-switcher select option {

            background: #2A160F !important;

            color: #ffffff !important;

        }



        .language-switcher .button {

            background: rgba(169, 130, 36, 0.3) !important;

            color: #ffffff !important;

            border: 1px solid rgba(169, 130, 36, 0.5) !important;

            border-radius: 8px !important;

            padding: 5px 14px !important;

            font-size: 0.82rem !important;

            cursor: pointer !important;

            margin-left: 6px;

            transition: all 0.2s ease !important;

        }



        .language-switcher .button:hover {

            background: rgba(169, 130, 36, 0.5) !important;

        }



        /* Mobile */

        @media (max-width: 480px) {

            body.login {

                padding: 30px 16px !important;

            }

            #login {

                width: 100% !important;

            }

            #login h1 a {

                max-width: 320px !important;

                height: 64px !important;

                padding: 10px 16px !important;

                border-radius: 12px !important;

                margin-bottom: 14px !important;

            }

            .vg-login-title {

                font-size: 1.02rem !important;

                margin-bottom: 16px !important;

            }

            #loginform, #lostpasswordform, #resetpassform {

                padding: 26px 20px 22px !important;

                border-radius: 16px !important;

            }

        }

    </style>

    <?php

}

add_action('login_enqueue_scripts', 'vegangarden_custom_login_scripts');



// Point Login Logo to Homepage

add_filter('login_headerurl', function() {

    return home_url('/');

});



// Set Login Logo Text / Alt

add_filter('login_headertext', function() {

    return 'Vegan Garden Berlin';

});



// Inject Subtitle "CỔNG QUẢN TRỊ WEBSITE"

add_filter('login_message', function($message) {

    return '<h2 class="vg-login-title">CỔNG QUẢN TRỊ WEBSITE</h2>' . $message;

});

// Force redirect to wp-admin after login
add_filter('login_redirect', function($redirect_to, $requested_redirect_to, $user) {
    if (!is_wp_error($user) && in_array('administrator', (array) $user->roles)) {
        return admin_url();
    }
    return $redirect_to;
}, 99, 3);

// Auto-seed legal pages (impressum, datenschutz, cookie-einstellungen)
add_action('init', function() {
    $legal_pages = [
        'impressum'            => 'Impressum',
        'datenschutz'          => 'Datenschutzerklärung',
        'cookie-einstellungen' => 'Cookie-Einstellungen',
    ];
    foreach ($legal_pages as $slug => $title) {
        $page = get_page_by_path($slug);
        if (!$page) {
            wp_insert_post([
                'post_title'     => $title,
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_content'   => '',
            ]);
        }
    }
    // Trash default sample page to keep sitemap clean
    if (get_post(2) && get_post_status(2) === 'publish') {
        wp_trash_post(2);
    }
});

// Output Vegan Garden Favicon for Admin & Login screens
add_action('admin_head', 'vegangarden_admin_favicon');
add_action('login_head', 'vegangarden_admin_favicon');
function vegangarden_admin_favicon() {
    $ver = '20260925_circle_v2';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url(home_url('/favicon-32x32.png?v=' . $ver)) . '">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="192x192" href="' . esc_url(home_url('/favicon-192x192.png?v=' . $ver)) . '">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="512x512" href="' . esc_url(home_url('/favicon-512x512.png?v=' . $ver)) . '">' . "\n";
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url(home_url('/apple-touch-icon.png?v=' . $ver)) . '">' . "\n";
    echo '<link rel="shortcut icon" href="' . esc_url(home_url('/favicon.ico?v=' . $ver)) . '">' . "\n";
}

// ============================================
// EXPORT DATA: RESERVIERUNGEN & MESSAGES
// ============================================

// 1. Hide 'Add Post' and Add single Export button to edit.php screens
add_action('admin_head-edit.php', function () {
    global $typenow;
    if ($typenow === 'vg_reservation' || $typenow === 'contact_message') {
        $is_res = ($typenow === 'vg_reservation');
        $action = $is_res ? 'vg_export_reservations' : 'vg_export_messages';
        $nonce_action = $is_res ? 'vg_export_res_nonce' : 'vg_export_msg_nonce';
        $export_url = wp_nonce_url(admin_url('admin-post.php?action=' . $action), $nonce_action);
        $btn_label = $is_res ? vg_admin_i18n('btn_export_res') : vg_admin_i18n('btn_export_msg');
        ?>
        <style>
        body.post-type-vg_reservation a.page-title-action:not(.vg-export-btn-top),
        body.post-type-contact_message a.page-title-action:not(.vg-export-btn-top) {
            display: none !important;
        }
        </style>
        <script>
        jQuery(document).ready(function($) {
            $('a.page-title-action:not(.vg-export-btn-top)').remove();
            if ($('.vg-export-btn-top').length === 0) {
                var btnHtml = '<a href="<?php echo esc_url($export_url); ?>" class="page-title-action vg-export-btn-top" style="background:#2271b1; color:#fff; border-color:#2271b1; font-weight:600; display:inline-flex; align-items:center; gap:5px; margin-left:8px;"><span class="dashicons dashicons-download" style="font-size:16px; width:16px; height:16px; line-height:16px; margin-top:-1px;"></span><?php echo esc_js($btn_label); ?></a>';
                var heading = $('.wrap .wp-heading-inline');
                if (heading.length) {
                    heading.after(btnHtml);
                }
            }
        });
        </script>
        <?php
    }
});

// Remove 'Add Post' submenu from sidebar for Reservations and Messages
add_action('admin_menu', function () {
    remove_submenu_page('edit.php?post_type=vg_reservation', 'post-new.php?post_type=vg_reservation');
    remove_submenu_page('edit.php?post_type=contact_message', 'post-new.php?post_type=contact_message');
}, 999);

// 2. Handle Export Reservations CSV
add_action('admin_post_vg_export_reservations', function () {
    if (!current_user_can('edit_posts')) {
        wp_die('Bạn không có quyền xuất dữ liệu.');
    }
    check_admin_referer('vg_export_res_nonce');

    $args = array(
        'post_type'      => 'vg_reservation',
        'post_status'    => array('publish', 'pending', 'draft', 'future', 'private'),
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $query = new WP_Query($args);

    $filename = 'Reservierungen_VeganGarden_' . date('Y-m-d_His') . '.csv';

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // UTF-8 BOM for Microsoft Excel compatibility
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    // CSV Headers
    fputcsv($output, array(
        'Mã đơn (ID)',
        'Thời gian gửi',
        'Tên khách hàng',
        'Số điện thoại',
        'Email',
        'Ngày đến ăn',
        'Giờ đến',
        'Số lượng khách',
        'Trạng thái',
        'Ghi chú / Yêu cầu',
        'Địa chỉ IP'
    ));

    $status_labels = array(
        'new'         => 'Eingegangen (Mới)',
        'confirmed'   => 'Bestätigt (Đã xác nhận)',
        'cancelled'   => 'Storniert (Đã huỷ)',
        'completed'   => 'Abgeschlossen (Hoàn tất)',
    );

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            $date_raw = get_post_meta($id, '_res_date', true);
            $date_fmt = $date_raw ? date('d.m.Y', strtotime($date_raw)) : '';
            $status_raw = get_post_meta($id, '_res_status', true) ?: 'new';
            $status_lbl = $status_labels[$status_raw] ?? $status_raw;

            fputcsv($output, array(
                $id,
                get_the_date('Y-m-d H:i:s'),
                get_post_meta($id, '_res_name', true) ?: get_the_title(),
                get_post_meta($id, '_res_phone', true),
                get_post_meta($id, '_res_email', true),
                $date_fmt,
                get_post_meta($id, '_res_time', true),
                get_post_meta($id, '_res_guests', true),
                $status_lbl,
                get_post_meta($id, '_res_note', true) ?: get_the_content(),
                get_post_meta($id, '_res_ip', true)
            ));
        }
        wp_reset_postdata();
    }

    fclose($output);
    exit;
});

// 3. Handle Export Messages CSV
add_action('admin_post_vg_export_messages', function () {
    if (!current_user_can('edit_posts')) {
        wp_die('Bạn không có quyền xuất dữ liệu.');
    }
    check_admin_referer('vg_export_msg_nonce');

    $args = array(
        'post_type'      => 'contact_message',
        'post_status'    => array('publish', 'pending', 'draft', 'future', 'private'),
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $query = new WP_Query($args);

    $filename = 'Messages_VeganGarden_' . date('Y-m-d_His') . '.csv';

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // UTF-8 BOM for Microsoft Excel compatibility
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    // CSV Headers
    fputcsv($output, array(
        'Mã tin nhắn (ID)',
        'Thời gian gửi',
        'Người gửi',
        'Số điện thoại',
        'Email',
        'Nội dung tin nhắn',
        'Địa chỉ IP'
    ));

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();

            fputcsv($output, array(
                $id,
                get_the_date('Y-m-d H:i:s'),
                get_post_meta($id, '_contact_name', true) ?: get_the_title(),
                get_post_meta($id, '_contact_phone', true),
                get_post_meta($id, '_contact_email', true),
                get_the_content(),
                get_post_meta($id, '_contact_ip', true)
            ));
        }
        wp_reset_postdata();
    }

    fclose($output);
    exit;
});



