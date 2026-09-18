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
    wp_enqueue_style('vegangarden-main', get_template_directory_uri() . '/styles.css', array(), '20260918_14');
    wp_enqueue_style('vegangarden-theme', get_stylesheet_uri(), array('vegangarden-main'), '1.0.9');

    // Main Script
    wp_enqueue_script('vegangarden-script', get_template_directory_uri() . '/script.js', array(), '20260918_12', true);
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
    if (strpos($src, 'ver=') && !strpos($src, home_url())) {
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
// BANNER MANAGEMENT (CMS)
// ============================================

// Register Banner custom post type
add_action('init', function () {
    register_post_type('vg_banner', array(
        'labels' => array(
            'name'               => 'Banners',
            'singular_name'      => 'Banner',
            'menu_name'          => '🖼️ Banners',
            'add_new'            => 'Add New Banner',
            'add_new_item'       => 'Add New Banner',
            'edit_item'          => 'Edit Banner',
            'all_items'          => 'All Banners',
            'not_found'          => 'No banners found',
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

// Add meta boxes for Banner settings
add_action('add_meta_boxes', function () {
    add_meta_box('vg_banner_settings', 'Banner Settings', 'vg_banner_meta_box', 'vg_banner', 'normal', 'high');
});

function vg_banner_meta_box($post) {
    wp_nonce_field('vg_banner_meta', 'vg_banner_nonce');
    $mobile_img  = get_post_meta($post->ID, '_banner_mobile_img', true);
    $order       = get_post_meta($post->ID, '_banner_order', true);
    $active      = get_post_meta($post->ID, '_banner_active', true);
    $link        = get_post_meta($post->ID, '_banner_link', true);

    if ($order === '') $order = 0;
    if ($active === '') $active = '1';
    ?>
    <style>
        .vg-meta-row { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; padding: 12px 0; border-bottom: 1px solid #eee; }
        .vg-meta-label { font-weight: 600; min-width: 160px; }
        .vg-meta-input { flex: 1; }
        .vg-meta-input input[type="text"], .vg-meta-input input[type="number"], .vg-meta-input input[type="url"] { width: 100%; padding: 8px; }
        .vg-img-preview { max-width: 300px; max-height: 150px; border-radius: 8px; margin-top: 8px; border: 1px solid #ddd; }
        .vg-toggle { position: relative; display: inline-block; width: 50px; height: 26px; }
        .vg-toggle input { opacity: 0; width: 0; height: 0; }
        .vg-toggle-slider { position: absolute; cursor: pointer; inset: 0; background: #ccc; border-radius: 26px; transition: .3s; }
        .vg-toggle-slider:before { content: ""; position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: .3s; }
        .vg-toggle input:checked + .vg-toggle-slider { background: #4CAF50; }
        .vg-toggle input:checked + .vg-toggle-slider:before { transform: translateX(24px); }
    </style>

    <p style="background:#f0f6ff; padding:12px; border-radius:8px; border-left:4px solid #2271b1;">
        <strong>Desktop Image:</strong> Set as "Featured Image" on the right → <strong>1920 × 600 px</strong><br>
        <strong>Mobile Image:</strong> Upload below → <strong>1200 × 800 px</strong>
    </p>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Active</div>
        <div class="vg-meta-input">
            <label class="vg-toggle">
                <input type="checkbox" name="banner_active" value="1" <?php checked($active, '1'); ?>>
                <span class="vg-toggle-slider"></span>
            </label>
            <span style="margin-left:8px; color:#666;">Display banner on website</span>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Display Order</div>
        <div class="vg-meta-input">
            <input type="number" name="banner_order" value="<?php echo esc_attr($order); ?>" min="0" max="99" style="width:80px!important;">
            <span style="margin-left:8px; color:#666;">Lower number = displayed first</span>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Mobile Image (1200×800)</div>
        <div class="vg-meta-input">
            <input type="hidden" name="banner_mobile_img" id="banner_mobile_img" value="<?php echo esc_attr($mobile_img); ?>">
            <button type="button" class="button" id="upload_mobile_btn">Select Image</button>
            <button type="button" class="button" id="remove_mobile_btn" style="color:red; <?php echo empty($mobile_img) ? 'display:none;' : ''; ?>">Remove</button>
            <?php if ($mobile_img): ?>
                <br><img src="<?php echo esc_url($mobile_img); ?>" class="vg-img-preview" id="mobile_preview">
            <?php else: ?>
                <br><img src="" class="vg-img-preview" id="mobile_preview" style="display:none;">
            <?php endif; ?>
        </div>
    </div>

    <div class="vg-meta-row">
        <div class="vg-meta-label">Link (optional)</div>
        <div class="vg-meta-input">
            <input type="url" name="banner_link" value="<?php echo esc_attr($link); ?>" placeholder="https://...">
            <span style="color:#666; font-size:12px;">Clicking banner opens this link</span>
        </div>
    </div>

    <script>
    jQuery(function($) {
        $('#upload_mobile_btn').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({ title: 'Select Mobile Banner (1200×800)', multiple: false, library: { type: 'image' } });
            frame.on('select', function() {
                var url = frame.state().get('selection').first().toJSON().url;
                $('#banner_mobile_img').val(url);
                $('#mobile_preview').attr('src', url).show();
                $('#remove_mobile_btn').show();
            });
            frame.open();
        });
        $('#remove_mobile_btn').on('click', function() {
            $('#banner_mobile_img').val('');
            $('#mobile_preview').hide();
            $(this).hide();
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
    update_post_meta($post_id, '_banner_mobile_img', esc_url_raw($_POST['banner_mobile_img'] ?? ''));
    update_post_meta($post_id, '_banner_link', esc_url_raw($_POST['banner_link'] ?? ''));
});

// Admin columns for Banner list
add_filter('manage_vg_banner_posts_columns', function ($columns) {
    return array(
        'cb'        => $columns['cb'],
        'thumbnail' => 'Preview',
        'title'     => 'Title',
        'active'    => 'Status',
        'order'     => 'Order',
        'date'      => 'Date',
    );
});

add_action('manage_vg_banner_posts_custom_column', function ($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            $thumb = get_the_post_thumbnail_url($post_id, 'medium');
            if ($thumb) echo '<img src="' . esc_url($thumb) . '" style="width:120px;height:40px;object-fit:cover;border-radius:4px;">';
            else echo '<span style="color:#999;">—</span>';
            break;
        case 'active':
            $active = get_post_meta($post_id, '_banner_active', true);
            echo $active === '1'
                ? '<span style="color:#4CAF50;font-weight:700;">● Active</span>'
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
            array('key' => '_banner_active', 'value' => '1'),
        ),
    ));
    $result = array();
    foreach ($banners as $b) {
        $desktop = get_the_post_thumbnail_url($b->ID, 'full');
        if (!$desktop) continue;
        $result[] = array(
            'desktop'    => $desktop,
            'mobile'     => get_post_meta($b->ID, '_banner_mobile_img', true) ?: $desktop,
            'title'      => $b->post_title,
            'link'       => get_post_meta($b->ID, '_banner_link', true),
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
        'Restaurant Info',
        '⚙️ Restaurant Info',
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
            'phone_1'       => sanitize_text_field($_POST['phone_1'] ?? ''),
            'phone_2'       => sanitize_text_field($_POST['phone_2'] ?? ''),
            'email'         => sanitize_email($_POST['email'] ?? ''),
            'address'       => sanitize_text_field($_POST['address'] ?? ''),
            'hours_open'    => sanitize_text_field($_POST['hours_open'] ?? ''),
            'hours_closed'  => sanitize_text_field($_POST['hours_closed'] ?? ''),
            'hours_kitchen' => sanitize_text_field($_POST['hours_kitchen'] ?? ''),
            'menu_pdf'      => esc_url_raw($_POST['menu_pdf'] ?? ''),
            'whatsapp'      => sanitize_text_field($_POST['whatsapp'] ?? ''),
            'instagram'     => esc_url_raw($_POST['instagram'] ?? ''),
            'facebook'      => esc_url_raw($_POST['facebook'] ?? ''),
            'tiktok'        => esc_url_raw($_POST['tiktok'] ?? ''),
            'maps_url'      => esc_url_raw($_POST['maps_url'] ?? ''),
        );
        update_option('vg_restaurant_settings', $data);
        echo '<div class="notice notice-success is-dismissible" style="margin-top:16px;"><p><strong>Settings saved successfully!</strong> All updates are now live on the website.</p></div>';
    }

    $phone_1       = vg_get_option('phone_1', '030 2123 7260');
    $phone_2       = vg_get_option('phone_2', '0162 464 9999');
    $email         = vg_get_option('email', 'info@vegan-garden.berlin');
    $address       = vg_get_option('address', 'Frankfurter Allee 21, 10247 Berlin (Friedrichshain)');
    $hours_open    = vg_get_option('hours_open', 'Di – So: 12:00 – 22:00 Uhr');
    $hours_closed  = vg_get_option('hours_closed', 'Montag Ruhetag');
    $hours_kitchen = vg_get_option('hours_kitchen', 'Küche bis 21:30 Uhr');
    $menu_pdf      = vg_get_option('menu_pdf', home_url('/menu/Druck_Speisekarte_VeganGarden.pdf'));
    $whatsapp      = vg_get_option('whatsapp', '491624649999');
    $instagram     = vg_get_option('instagram', 'https://www.instagram.com/vegan.garden.berlin/');
    $facebook      = vg_get_option('facebook', 'https://www.facebook.com/vegangarden21');
    $tiktok        = vg_get_option('tiktok', 'https://www.tiktok.com/@vegangarden_berlin');
    $maps_url      = vg_get_option('maps_url', 'https://maps.app.goo.gl/St5dH8yWhqsPBheCA');
    ?>
    <div class="wrap" style="max-width: 900px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <h1 style="display:flex; align-items:center; gap:10px; font-size: 24px; margin-bottom: 8px;">
            <span>⚙️</span> Restaurant Information Settings
        </h1>
        <p style="color:#666; font-size:14px; margin-bottom: 24px;">
            Easily update phone numbers, opening hours, address, and menu PDF without touching code.
        </p>

        <form method="post" action="">
            <?php wp_nonce_field('vg_save_settings', 'vg_settings_nonce'); ?>

            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    📞 Contact Information
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:200px; font-weight:600;">Phone Number 1</th>
                        <td>
                            <input type="text" name="phone_1" value="<?php echo esc_attr($phone_1); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. 030 2123 7260 (Landline)</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Phone Number 2</th>
                        <td>
                            <input type="text" name="phone_2" value="<?php echo esc_attr($phone_2); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. 0162 464 9999 (Mobile)</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Email Address</th>
                        <td>
                            <input type="email" name="email" value="<?php echo esc_attr($email); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Address</th>
                        <td>
                            <input type="text" name="address" value="<?php echo esc_attr($address); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. Frankfurter Allee 21, 10247 Berlin (Friedrichshain)</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    🕒 Opening Hours
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:200px; font-weight:600;">Open Days & Hours</th>
                        <td>
                            <input type="text" name="hours_open" value="<?php echo esc_attr($hours_open); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. Dienstag – Sonntag: 12:00 – 22:00 Uhr</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Closed Day Note</th>
                        <td>
                            <input type="text" name="hours_closed" value="<?php echo esc_attr($hours_closed); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. Montag Ruhetag</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="font-weight:600;">Kitchen Note</th>
                        <td>
                            <input type="text" name="hours_kitchen" value="<?php echo esc_attr($hours_kitchen); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. Küche bis 21:30 Uhr</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    📄 Menu (Speisekarte) PDF
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:200px; font-weight:600;">Menu PDF File</th>
                        <td>
                            <input type="text" name="menu_pdf" id="vg_menu_pdf" value="<?php echo esc_attr($menu_pdf); ?>" class="large-text" style="padding:8px 12px; font-size:14px; margin-bottom:8px;">
                            <button type="button" class="button button-secondary" id="vg_upload_pdf_btn" style="padding:4px 14px;">Upload / Select New PDF</button>
                            <?php if ($menu_pdf): ?>
                                <a href="<?php echo esc_url($menu_pdf); ?>" target="_blank" class="button" style="margin-left:6px;">View Current PDF</a>
                            <?php endif; ?>
                            <p class="description">When you upload a new PDF menu here, all "Speisekarte ansehen" buttons across the website will open this new file!</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="background:#fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 2px solid #2271b1; color: #1d2327;">
                    🌐 Social Media & Map Links
                </h2>
                
                <table class="form-table" role="presentation" style="margin-top:0;">
                    <tr>
                        <th scope="row" style="width:200px; font-weight:600;">WhatsApp (Number)</th>
                        <td>
                            <input type="text" name="whatsapp" value="<?php echo esc_attr($whatsapp); ?>" class="regular-text" style="padding:8px 12px; font-size:14px;">
                            <p class="description">e.g. 491624649999 (international format without + or spaces)</p>
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
                        <th scope="row" style="font-weight:600;">Google Maps Link</th>
                        <td>
                            <input type="url" name="maps_url" value="<?php echo esc_url($maps_url); ?>" class="large-text" style="padding:8px 12px; font-size:14px;">
                        </td>
                    </tr>
                </table>
            </div>

            <p class="submit" style="padding: 10px 0;">
                <button type="submit" class="button button-primary button-hero" style="font-size: 16px; padding: 6px 30px; height: auto;">
                    💾 Save Changes
                </button>
            </p>
        </form>
    </div>

    <script>
    jQuery(function($) {
        $('#vg_upload_pdf_btn').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Select or Upload Menu PDF',
                multiple: false,
                library: { type: 'application/pdf' }
            });
            frame.on('select', function() {
                var url = frame.state().get('selection').first().toJSON().url;
                $('#vg_menu_pdf').val(url);
            });
            frame.open();
        });
    });
    </script>
    <?php
}


// ============================================
// SMTP EMAIL CONFIGURATION
// ============================================
add_action('phpmailer_init', function ($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'server11.configcenter.info';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Username   = 'info@vegan-garden.berlin';
    $phpmailer->Password   = '';  // NEEDS PASSWORD
    $phpmailer->From       = 'info@vegan-garden.berlin';
    $phpmailer->FromName   = 'Vegan Garden Berlin';
});

// ============================================
// CONTACT FORM HANDLER
// ============================================

// Register custom post type for contact messages
add_action('init', function () {
    register_post_type('contact_message', array(
        'labels' => array(
            'name'               => 'Messages',
            'singular_name'      => 'Message',
            'menu_name'          => '✉️ Messages',
            'all_items'          => 'All Messages',
            'view_item'          => 'View Message',
            'search_items'       => 'Search Messages',
            'not_found'          => 'No messages found',
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
    $to      = 'giautranth@gmail.com';
    $subject = sprintf('[Vegan Garden] Neue Nachricht von %s', $name);
    $body    = sprintf(
        "Neue Kontaktanfrage über die Website:\n\n" .
        "Name: %s\n" .
        "Telefon: %s\n" .
        "E-Mail: %s\n" .
        "Datum: %s\n\n" .
        "Nachricht:\n%s\n\n" .
        "---\n" .
        "Diese E-Mail wurde automatisch über das Kontaktformular auf vegan-garden.berlin gesendet.",
        $name, $phone, $email, current_time('d.m.Y H:i'), $message
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf('Reply-To: %s <%s>', $name, $email),
    );

    wp_mail($to, $subject, $body, $headers);

    wp_send_json_success('Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet. Wir melden uns in Kürze bei Ihnen.');
}

// Add custom columns to admin list
add_filter('manage_contact_message_posts_columns', function ($columns) {
    $new = array();
    $new['cb']    = $columns['cb'];
    $new['title'] = 'Sender';
    $new['phone'] = 'Phone';
    $new['email'] = 'Email';
    $new['message'] = 'Message';
    $new['date']  = 'Date';
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
            'name'               => 'Reservierungen',
            'singular_name'      => 'Reservierung',
            'menu_name'          => '📅 Reservierungen',
            'all_items'          => 'Alle Reservierungen',
            'view_item'          => 'Reservierung ansehen',
            'search_items'       => 'Reservierungen suchen',
            'not_found'          => 'Keine Reservierungen gefunden',
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
    if (empty($name) || empty($phone) || empty($date) || empty($time) || $guests < 1) {
        wp_send_json_error('Bitte füllen Sie alle Pflichtfelder aus.');
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

    // Rate limiting: max 5 reservations per IP per hour
    $ip = $_SERVER['REMOTE_ADDR'];
    $rate_key = 'vg_reserve_' . md5($ip);
    $submissions = get_transient($rate_key);
    if ($submissions !== false && $submissions >= 5) {
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

        // Try email notification
        $to      = 'giautranth@gmail.com';
        $subject = sprintf('[Vegan Garden] Neue Reservierung: %s, %s %s', $name, $date_formatted, $time);
        $body    = sprintf(
            "Neue Tischreservierung:\n\n" .
            "Name: %s\n" .
            "Telefon: %s\n" .
            "E-Mail: %s\n" .
            "Datum: %s\n" .
            "Uhrzeit: %s\n" .
            "Personen: %d\n" .
            "Anmerkung: %s\n\n" .
            "---\n" .
            "Reservierung verwalten: %s",
            $name, $phone, $email, $date_formatted, $time, $guests,
            ($note ?: '—'),
            admin_url('edit.php?post_type=vg_reservation')
        );
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        wp_mail($to, $subject, $body, $headers);
    }

    wp_send_json_success('Vielen Dank! Ihre Reservierung wurde erfolgreich gesendet. Wir bestätigen in Kürze.');
}

// Admin columns for Reservations
add_filter('manage_vg_reservation_posts_columns', function ($columns) {
    return array(
        'cb'      => $columns['cb'],
        'title'   => 'Reservierung',
        'date_time' => '📅 Datum & Uhrzeit',
        'guests'  => '👥 Personen',
        'phone'   => '📞 Telefon',
        'email'   => '📧 E-Mail',
        'status'  => 'Status',
        'date'    => 'Erstellt',
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
