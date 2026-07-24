<?php
/**
 * Template Name: CIH Membership Template
 * Description: Landing page Thẻ Thành Viên – dùng Header/Footer Flatsome,
 *              ACF để quản trị banner slider, các hạng thẻ, bảng so sánh, điều khoản, FAQs, và Forminator cho form đăng ký.
 */

// Load stylesheet và script - chỉ load khi vào đúng trang này
// (Nếu cih-shortcodes.php đã đăng ký rồi thì bỏ qua để tránh duplicate)
if ( ! function_exists( 'cih_membership_assets' ) ) {
    function cih_membership_assets() {
        if ( is_page_template( 'page-membership.php' ) ) {
            $uri = get_stylesheet_directory_uri() . '/cih';
            wp_enqueue_style(
                'cih-static-style',
                $uri . '/static-style.css',
                [],
                '3.3'
            );
            wp_enqueue_style(
                'cih-membership-style',
                $uri . '/membership.css',
                ['cih-static-style'],
                '3.3'
            );
            wp_enqueue_style(
                'be-vietnam-pro',
                'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap',
                [],
                null
            );
            wp_enqueue_script(
                'cih-membership-script',
                $uri . '/membership.js',
                [],
                '3.3',
                true
            );
        }
    }
    add_action( 'wp_enqueue_scripts', 'cih_membership_assets' );
}

// Helper render giá trị trong bảng so sánh
// Đã chuyển sang cih-shortcodes.php — giữ wrapper để tránh lỗi nếu file đó chưa load
if ( ! function_exists( 'cih_render_cell_val' ) ) {
    function cih_render_cell_val( $val ) {
        $val = trim( (string) $val );
        if ( $val === 'checked' ) {
            return '<span class="custom-checkbox checked"></span>';
        } elseif ( $val === 'unchecked' ) {
            return '<span class="custom-checkbox unchecked"></span>';
        }
        return esc_html( $val );
    }
}

// Xác định xem trang hiện tại có phải là trang con (Thẻ Bạc, Vàng, Bạch Kim, Kim Cương)
$cih_post_id = get_the_ID();
$cih_current_slug = get_post_field( 'post_name', $cih_post_id );
$is_tier_page = in_array( $cih_current_slug, ['bac', 'vang', 'bach-kim', 'kim-cuong'] );
$acf_source_id = $is_tier_page ? wp_get_post_parent_id( $cih_post_id ) : $cih_post_id;
if ( ! $acf_source_id ) {
    $acf_source_id = $cih_post_id;
}

$tier_slug_map = [
    'bac'       => 'silver',
    'vang'      => 'gold',
    'bach-kim'  => 'platinum',
    'kim-cuong' => 'diamond'
];
$target_tier_slug = $is_tier_page ? ($tier_slug_map[$cih_current_slug] ?? '') : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <?php
  // Nhúng trực tiếp CSS/JS để tránh LiteSpeed bundle loại bỏ các file này
  $cih_uri = get_stylesheet_directory_uri() . '/cih';
  $css_ver = '3.5';
  ?>
  <link rel="stylesheet" id="cih-static-style-css" href="<?php echo esc_url($cih_uri . '/static-style.css'); ?>?ver=<?php echo $css_ver; ?>" media="all" data-no-optimize="1" data-no-defer="1">
  <link rel="stylesheet" id="cih-membership-style-css" href="<?php echo esc_url($cih_uri . '/membership.css'); ?>?ver=<?php echo $css_ver; ?>" media="all" data-no-optimize="1" data-no-defer="1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap">
</head>
<body <?php body_class(); ?>>

<!-- ═══════════════════════════════════════════════
     TOP BAR
     ═══════════════════════════════════════════════ -->
<div class="top-bar" id="cih-top-bar">
  <div class="container top-bar__inner">
    <div class="top-bar__right" style="margin-left:auto">
      <a href="tel:19008146" class="top-bar__item top-bar__item--hotline">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.87 2 2 0 0 1 3.59 2.68h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l.76-.76a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 17z"></path></svg>
        Tổng đài: <strong>1900 8146</strong>
      </a>
      <span class="top-bar__sep">|</span>
      <a href="tel:02862901155" class="top-bar__item top-bar__item--emergency">
        <span class="pulse-dot"></span> Cấp cứu: <strong>(028) 6290 1155</strong>
      </a>
      <span class="top-bar__sep">|</span>
      <a href="https://patient.cih.com.vn/" class="top-bar__portal" target="_blank" rel="noopener">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        Dành cho khách hàng
      </a>
    </div>
  </div>
</div>

<!-- HEADER -->
<header class="header" id="cih-header">
  <div class="container header__inner">
    <button class="hamburger" id="hamburger-btn" aria-label="Mở menu">
      <span></span><span></span><span></span>
    </button>

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" id="site-logo" aria-label="CIH Trang chủ">
      <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/cih/images/logo_cih_acci.png' ); ?>"
           alt="" class="header__logo-img"
           onerror="this.style.display='none';document.getElementById('logo-fallback').style.display='flex'" />
      <div id="logo-fallback" class="logo-fallback" style="display:none">
        <div class="logo-mark">C<span class="logo-cross">✚</span>IH</div>
      </div>
    </a>

    <!-- Navigation -->
    <nav class="custom-nav" id="main-nav" aria-label="Menu chính">
      <ul class="custom-nav__list">
        <li class="custom-nav__item"><a href="<?php echo esc_url( home_url( '/gioi-thieu/' ) ); ?>" class="custom-nav__link">Giới Thiệu</a></li>
        <li class="custom-nav__item"><a href="<?php echo esc_url( home_url( '/chuyen-khoa/' ) ); ?>" class="custom-nav__link">Chuyên Khoa</a></li>
        <li class="custom-nav__item"><a href="<?php echo esc_url( home_url( '/bac-si/' ) ); ?>" class="custom-nav__link">Bác Sĩ</a></li>
        <li class="custom-nav__item custom-nav__item--has-dropdown">
          <a href="<?php echo esc_url( home_url( '/dich-vu/' ) ); ?>" class="custom-nav__link">Dịch Vụ <span class="custom-nav__arrow">▾</span></a>
          <div class="custom-nav__dropdown dropdown--single">
            <div class="dropdown__col">
              <a href="<?php echo esc_url( home_url( '/bang-gia-dich-vu-thuoc-vat-tu-y-te/' ) ); ?>" class="dropdown__link">Bảng giá dịch vụ & Thuốc, Vật tư Y tế</a>
              <a href="<?php echo esc_url( home_url( '/dich-vu/quy-trinh-nhap-vien/' ) ); ?>" class="dropdown__link">Quy trình nhập viện</a>
              <a href="<?php echo esc_url( home_url( '/dich-vu/quy-trinh-xuat-vien/' ) ); ?>" class="dropdown__link">Quy trình xuất viện</a>
            </div>
          </div>
        </li>
        <li class="custom-nav__item custom-nav__item--has-dropdown">
          <a href="<?php echo esc_url( home_url( '/goi-tam-soat/' ) ); ?>" class="custom-nav__link">Gói Khám <span class="custom-nav__arrow">▾</span></a>
          <div class="custom-nav__dropdown dropdown--single">
            <div class="dropdown__col">
              <a href="<?php echo esc_url( home_url( '/danh-muc-goi-kham/kham-tong-quat-doanh-nghiep/' ) ); ?>" class="dropdown__link">Khám tổng quát doanh nghiệp</a>
              <a href="<?php echo esc_url( home_url( '/danh-muc-goi-kham/goi-kham-tong-quat/' ) ); ?>" class="dropdown__link">Gói tổng quát cá nhân</a>
              <a href="<?php echo esc_url( home_url( '/danh-muc-goi-kham/goi-thai-san/' ) ); ?>" class="dropdown__link">Gói thai sản</a>
              <a href="<?php echo esc_url( home_url( '/danh-muc-goi-kham/goi-chuyen-khoa/' ) ); ?>" class="dropdown__link">Gói chuyên khoa</a>
              <a href="<?php echo esc_url( home_url( '/danh-muc-goi-kham/goi-vaccine-cho-tre/' ) ); ?>" class="dropdown__link">Gói vaccine cho trẻ</a>
            </div>
          </div>
        </li>
        <li class="custom-nav__item custom-nav__item--has-dropdown">
          <a href="<?php echo esc_url( home_url( '/tin-tuc/' ) ); ?>" class="custom-nav__link">Tin Tức <span class="custom-nav__arrow">▾</span></a>
          <div class="custom-nav__dropdown dropdown--single">
            <div class="dropdown__col">
              <a href="<?php echo esc_url( home_url( '/category/khoa-san-nhi/' ) ); ?>" class="dropdown__link">Khoa Sản - Nhi</a>
              <a href="<?php echo esc_url( home_url( '/category/khoa-noi-khoa-ngoai/' ) ); ?>" class="dropdown__link">Khoa Nội - Khoa Ngoại</a>
              <a href="<?php echo esc_url( home_url( '/category/tim-mach-can-thiep-mach-mau/' ) ); ?>" class="dropdown__link">Tim mạch - Can thiệp mạch máu</a>
              <a href="<?php echo esc_url( home_url( '/category/khoa-cap-cuu/' ) ); ?>" class="dropdown__link">Khoa Cấp Cứu</a>
              <a href="<?php echo esc_url( home_url( '/category/chuyen-khoa-khac/' ) ); ?>" class="dropdown__link">Chuyên khoa khác</a>
              <a href="<?php echo esc_url( home_url( '/category/cam-nghi-benh-nhan/' ) ); ?>" class="dropdown__link">Cảm nghĩ bệnh nhân</a>
            </div>
          </div>
        </li>
        <li class="custom-nav__item custom-nav__item--has-dropdown">
          <a href="<?php echo esc_url( home_url( '/vien-dao-tao-nckh/' ) ); ?>" class="custom-nav__link">Viện Đào Tạo & NCKH <span class="custom-nav__arrow">▾</span></a>
          <div class="custom-nav__dropdown dropdown--single">
            <div class="dropdown__col">
              <a href="<?php echo esc_url( home_url( '/category/ke-hoach/' ) ); ?>" class="dropdown__link">Kế hoạch</a>
              <a href="<?php echo esc_url( home_url( '/category/chieu-sinh/' ) ); ?>" class="dropdown__link">Thông báo chiêu sinh</a>
              <a href="<?php echo esc_url( home_url( '/category/dao-tao/' ) ); ?>" class="dropdown__link">Hoạt động đào tạo</a>
              <a href="<?php echo esc_url( home_url( '/category/chung-chi/' ) ); ?>" class="dropdown__link">Quyết định cấp GCN/ Chứng chỉ</a>
              <a href="<?php echo esc_url( home_url( '/category/giang-vien/' ) ); ?>" class="dropdown__link">Đội ngũ Giảng viên</a>
              <a href="<?php echo esc_url( home_url( '/category/nckh/' ) ); ?>" class="dropdown__link">Hoạt động nghiên cứu khoa học</a>
              <a href="<?php echo esc_url( home_url( '/category/dao-tao/khac/' ) ); ?>" class="dropdown__link">Khác</a>
            </div>
          </div>
        </li>
      </ul>
    </nav>

    <div class="header__cta">
      <a href="<?php echo esc_url( home_url( '/dat-lich-hen/' ) ); ?>" class="btn btn--primary btn--sm" id="header-booking-btn">📅 Đặt Lịch Khám</a>
      <button class="header-search-btn" id="header-search-btn" aria-label="Tìm kiếm">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </div>
  </div>
</header>
<?php
// TỰ ĐỘNG KHỞI TẠO DỮ LIỆU ACF VÀO DATABASE KHI TẢI TRANG LẦN ĐẦU TIÊN
$theme_uri = get_stylesheet_directory_uri() . '/cih';
if ( function_exists('update_field') ) {
    $post_id = get_the_ID();
    $initialized = get_post_meta($post_id, '_cih_membership_initialized', true);
    if ( !$initialized && $post_id ) {
        // 1. Banner slider mặc định
        $default_banners = [
            ['field_banner_image' => $theme_uri . '/images/membership_banner1.png'],
            ['field_banner_image' => $theme_uri . '/images/membership_banner2.png'],
            ['field_banner_image' => $theme_uri . '/images/membership_banner3.png']
        ];
        
        // 2. Hạng thẻ mặc định
        $default_tiers = [
            [
                'field_tier_name' => 'Thẻ Bạc',
                'field_tier_slug' => 'silver',
                'field_tier_image' => $theme_uri . '/images/bac.jpg',
                'field_tier_price' => '1.000.000 VND',
                'field_tier_price_sub' => '/ năm',
                'field_tier_benefits' => "Miễn phí khám chuyên khoa tối đa 1 lần/tháng với PGS/TS/BS.CKII.\nGiảm 5% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.\nMiễn phí xe cấp cứu trong phạm vi 10km.\nƯu tiên xếp lịch khám, phẫu thuật.\nTích lũy điểm 2%.\nGiảm 25% phí nâng hạng.",
                'field_tier_button_text' => 'Đăng ký tư vấn',
                'field_tier_button_link' => '#dang-ky'
            ],
            [
                'field_tier_name' => 'Thẻ Vàng',
                'field_tier_slug' => 'gold',
                'field_tier_image' => $theme_uri . '/images/vang.jpg',
                'field_tier_price' => '3.000.000 VND',
                'field_tier_price_sub' => '/ năm',
                'field_tier_benefits' => "Miễn phí khám chuyên khoa không giới hạn số lần với chuyên gia PGS/TS/BS.CKII.\nGiảm 10% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.\nMiễn phí xe cấp cứu trong phạm vi 10km.\nƯu tiên xếp lịch khám, phẫu thuật.\nTích lũy điểm 3%.\nGiảm 25% phí nâng hạng.",
                'field_tier_button_text' => 'Đăng ký tư vấn',
                'field_tier_button_link' => '#dang-ky'
            ],
            [
                'field_tier_name' => 'Thẻ Bạch Kim',
                'field_tier_slug' => 'platinum',
                'field_tier_image' => $theme_uri . '/images/bach_kim.jpg',
                'field_tier_price' => '5.000.000 VND',
                'field_tier_price_sub' => '/ năm',
                'field_tier_benefits' => "Miễn phí khám chuyên khoa không giới hạn số lần với chuyên gia PGS/TS/BS.CKII.\nGiảm 15% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.\nMiễn phí xe cấp cứu trong phạm vi 10km.\nƯu tiên xếp lịch khám, phẫu thuật.\nTích lũy điểm 4%.\nÁp dụng thêm 1 thành viên gia đình.",
                'field_tier_button_text' => 'Đăng ký tư vấn',
                'field_tier_button_link' => '#dang-ky'
            ],
            [
                'field_tier_name' => 'Thẻ Kim Cương',
                'field_tier_slug' => 'diamond',
                'field_tier_image' => $theme_uri . '/images/kim_cuong.jpg',
                'field_tier_price' => '20.000.000 VND',
                'field_tier_price_sub' => '/ năm',
                'field_tier_benefits' => "Miễn phí khám chuyên khoa không giới hạn số lần với chuyên gia PGS/TS/BS.CKII.\nGiảm 20% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.\nĐưa đón 2 chiều khi khám bệnh, cấp cứu.\nChăm sóc 1:1, bác sĩ tư vấn riêng.\nTích lũy điểm 5%.\nÁp dụng cả gia đình (+3 thành viên).",
                'field_tier_button_text' => 'Đăng ký tư vấn',
                'field_tier_button_link' => '#dang-ky'
            ]
        ];
        
        // 3. Bảng so sánh mặc định
        $default_comp_rows = [
            ['field_row_type' => 'group_header', 'field_group_title' => 'Khám chuyên khoa'],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Miễn phí khám với chuyên gia PGS/TS/BS.CKII',
                'field_silver_val' => 'Tối đa 1 lần/tháng',
                'field_gold_val' => 'Không giới hạn',
                'field_platinum_val' => 'Không giới hạn',
                'field_diamond_val' => 'Không giới hạn'
            ],
            ['field_row_type' => 'group_header', 'field_group_title' => 'Giảm giá dịch vụ'],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Xét nghiệm, CT/MRI, siêu âm',
                'field_silver_val' => 'Giảm 5%',
                'field_gold_val' => 'Giảm 10%',
                'field_platinum_val' => 'Giảm 15%',
                'field_diamond_val' => 'Giảm 20%'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Điều trị, thủ thuật, phẫu thuật, nội trú',
                'field_silver_val' => 'Giảm 5%',
                'field_gold_val' => 'Giảm 10%',
                'field_platinum_val' => 'Giảm 15%',
                'field_diamond_val' => 'Giảm 20%'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Gói khám sức khỏe, tầm soát ung thư',
                'field_silver_val' => 'Giảm 5%',
                'field_gold_val' => 'Giảm 10%',
                'field_platinum_val' => 'Giảm 15%',
                'field_diamond_val' => 'Giảm 20%'
            ],
            ['field_row_type' => 'group_header', 'field_group_title' => 'Tiện ích & vận chuyển'],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Miễn phí xe cấp cứu (trong 10km)',
                'field_silver_val' => '1 chiều',
                'field_gold_val' => '1 chiều',
                'field_platinum_val' => '1 chiều',
                'field_diamond_val' => '2 chiều'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Đưa đón khám, chữa bệnh 2 chiều (trong 10km)',
                'field_silver_val' => 'unchecked',
                'field_gold_val' => 'unchecked',
                'field_platinum_val' => 'unchecked',
                'field_diamond_val' => 'checked'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Ưu tiên lịch khám, thủ thuật, phẫu thuật',
                'field_silver_val' => 'checked',
                'field_gold_val' => 'checked',
                'field_platinum_val' => 'checked',
                'field_diamond_val' => 'checked'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Nhắc lịch tái khám chủ động',
                'field_silver_val' => 'checked',
                'field_gold_val' => 'checked',
                'field_platinum_val' => 'checked',
                'field_diamond_val' => 'checked'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Chăm sóc 1:1 & bác sĩ tư vấn riêng',
                'field_silver_val' => 'unchecked',
                'field_gold_val' => 'unchecked',
                'field_platinum_val' => 'unchecked',
                'field_diamond_val' => 'checked'
            ],
            ['field_row_type' => 'group_header', 'field_group_title' => 'Tích điểm & gia đình'],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Tích điểm nâng hạng thẻ',
                'field_silver_val' => 'checked',
                'field_gold_val' => 'checked',
                'field_platinum_val' => 'checked',
                'field_diamond_val' => 'checked'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Giảm 25% phí nâng hạng thẻ',
                'field_silver_val' => 'checked',
                'field_gold_val' => 'checked',
                'field_platinum_val' => 'unchecked',
                'field_diamond_val' => 'unchecked'
            ],
            [
                'field_row_type' => 'feature_row', 
                'field_feature_name' => 'Áp dụng cho thành viên gia đình',
                'field_silver_val' => '',
                'field_gold_val' => '',
                'field_platinum_val' => '+1 thành viên',
                'field_diamond_val' => '+3 thành viên'
            ]
        ];
        
        // 4. Quy tắc tích điểm mặc định
        $default_rules_left = '
            <div class="rules-section-title">Quy tắc quy đổi</div>
            <ul class="rules-item-list">
              <li>100 điểm = 1.000 đồng.</li>
              <li>Dùng thanh toán lần sử dụng dịch vụ tiếp theo.</li>
              <li>Mỗi lần chỉ được dùng tối đa 30% giá trị hóa đơn.</li>
            </ul>
        ';
        $default_rules_right = '
            <div class="rules-section-title">Hiệu lực điểm</div>
            <ul class="rules-item-list">
              <li>12 tháng kể từ ngày tích.</li>
              <li>Hết hiệu lực sau 30 ngày khi thẻ hết hạn.</li>
              <li>Không chuyển nhượng.</li>
            </ul>
        ';
        
        // 5. Điều khoản mặc định
        $default_terms = '
            <ul style="margin:0;padding-left:1.5rem;line-height:1.8;list-style-type:disc;text-align:justify">
              <li>Ưu đãi chỉ áp dụng trên chi phí bệnh nhân tự chi trả - không bao gồm phần bảo hiểm, chi phí bác sĩ phẫu thuật, bác sĩ điều trị, thuốc, vật tư tiêu hao, và dịch vụ thuộc đơn vị hợp tác.</li>
              <li>Mỗi dịch vụ chỉ được hưởng một ưu đãi cao nhất - không được gộp nhiều ưu đãi cùng lúc.</li>
              <li>Không áp dụng cho gói sinh, gói IVF, gói vắc xin, phòng VIP, và dịch vụ gửi xét nghiệm ra ngoài bệnh viện.</li>
              <li>Thẻ định danh cố định cho chủ thẻ và người được thêm vào - không thay đổi định danh trong suốt thời gian thẻ còn hiệu lực.</li>
              <li>Điểm tích lũy có hiệu lực 12 tháng và hết hiệu lực sau 30 ngày kể từ khi thẻ hết hạn. Điểm chỉ dùng tối đa 30% hóa đơn mỗi lần.</li>
            </ul>
        ';
        
        // 6. FAQs mặc định
        $default_faqs = [
            ['field_faq_question' => '1. Làm thế nào để đăng ký thẻ hội viên City Membership?', 'field_faq_answer' => 'Quý khách có thể đăng ký trên Website http://cih.com.vn hoặc tại quầy thông tin Bệnh viện Quốc tế City.'],
            ['field_faq_question' => '2. Thẻ hội viên City Membership mang đến những quyền lợi gì?', 'field_faq_answer' => 'Hội viên Bệnh viện Quốc tế City được hưởng các đặc quyền như ưu đãi chi phí khám và điều trị, tích lũy điểm thưởng, ưu tiên đặt lịch khám, hỗ trợ cấp cứu và nhiều quyền lợi chăm sóc sức khỏe dành riêng cho tung hạng thẻ.'],
            ['field_faq_question' => '3. Thẻ có hiệu lực trong bao lâu?', 'field_faq_answer' => 'Thẻ có hiệu lực 12 tháng kể từ ngày kích hoạt. Trước khi hết hạn, Bệnh viện Quốc tế City sẽ chủ động gửi thông báo để Quy khách dễ dàng gia hạn.'],
            ['field_faq_question' => '4. Tôi có thể đăng ký thẻ cho người thân không?', 'field_faq_answer' => 'Có. Đối với hạng Platinum và Diamond, Quy khách có thể đăng ký thêm thành viên gia đình theo quy định của chương trình.'],
            ['field_faq_question' => '5. Dịch vụ vận chuyển cấp cứu dành cho hội viên được áp dụng ra sao?', 'field_faq_answer' => 'Tất cả hội viên đều được hỗ trợ vận chuyển cấp cứu đến Bệnh viện Quốc tế City trong phạm vi áp dụng. Tùy theo hạng thẻ, Quy khách sẽ được hưởng thêm các quyền lợi hỗ trợ nâng cao.'],
            ['field_faq_question' => '6. Tôi có thể sử dụng đồng thời ưu đãi thẻ và các chương trình khuyến mại khác không?', 'field_faq_answer' => 'Mỗi dịch vụ sẽ áp dụng một mức ưu đãi tối ưu nhất tại thời điểm sử dụng. Hệ thống sẽ tự động lựa chọn quyền lợi có giá trị cao nhất.']
        ];
        
        $default_shortcode = '[forminator_form id="45718"]';
        
        // Lưu dữ liệu vào Database
        update_field('field_banner_slider', $default_banners, $post_id);
        update_field('field_membership_tiers', $default_tiers, $post_id);
        update_field('field_comparison_rows', $default_comp_rows, $post_id);
        update_field('field_rules_left', $default_rules_left, $post_id);
        update_field('field_rules_right', $default_rules_right, $post_id);
        update_field('field_membership_terms', $default_terms, $post_id);
        update_field('field_faq_list', $default_faqs, $post_id);
        update_field('field_shortcode_form', $default_shortcode, $post_id);
        
        // Đánh dấu đã khởi tạo thành công để không chạy lại
        update_post_meta($post_id, '_cih_membership_initialized', '1');
    }
}
?>

<link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>" />

<?php
$tier_names = [
    'bac'       => 'Thẻ Bạc',
    'vang'      => 'Thẻ Vàng',
    'bach-kim'  => 'Thẻ Bạch Kim',
    'kim-cuong' => 'Thẻ Kim Cương'
];
$current_tier_name = $is_tier_page ? ($tier_names[$cih_current_slug] ?? '') : '';
?>

<!-- BREADCRUMBS -->
<div class="breadcrumbs-bar" style="background: var(--c-bg, #f5f7fa); padding: 0.75rem 0;">
  <div class="container">
    <div style="font-size: 0.8rem; color: #718096;">
      <a href="<?php echo home_url(); ?>" style="color: #4a5568; text-decoration: none;">Trang Chủ</a>
      &nbsp;&raquo;&nbsp;
      <?php if ( $is_tier_page ) : ?>
        <a href="<?php echo esc_url( home_url( '/the-thanh-vien/' ) ); ?>" style="color: #4a5568; text-decoration: none;">Thẻ Thành Viên</a>
        &nbsp;&raquo;&nbsp;
        <span><?php echo esc_html( $current_tier_name ); ?></span>
      <?php else : ?>
        <span>Thẻ Thành Viên</span>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php if ( ! $is_tier_page ) : ?>
<?php
// 1. BANNER SLIDER: lấy từ ACF
$banners = [];
if ( function_exists('have_rows') && have_rows('banner_slider', $acf_source_id) ) {
    while ( have_rows('banner_slider', $acf_source_id) ) {
        the_row();
        $img = get_sub_field('banner_image');
        if ( $img ) $banners[] = is_array($img) ? $img['url'] : $img;
    }
}
if ( empty($banners) ) {
    $banners = [
        $theme_uri . '/images/membership_banner1.png',
        $theme_uri . '/images/membership_banner2.png',
        $theme_uri . '/images/membership_banner3.png',
    ];
}
?>

<!-- BANNER SLIDER -->
<section class="member-banner-slider">
  <div class="slider-container">
    <?php foreach ( $banners as $idx => $url ) : ?>
      <div class="slide <?php echo $idx === 0 ? 'active' : ''; ?>">
        <img src="<?php echo esc_url($url); ?>"
             alt="Thẻ Hội Viên CIH Banner <?php echo $idx + 1; ?>"
             class="member-banner-image"
             loading="<?php echo $idx === 0 ? 'eager' : 'lazy'; ?>" />
      </div>
    <?php endforeach; ?>
    <button class="slider-arrow prev-arrow" onclick="changeSlide(-1)" aria-label="Slide trước">&#10094;</button>
    <button class="slider-arrow next-arrow" onclick="changeSlide(1)"  aria-label="Slide tiếp theo">&#10095;</button>
    <div class="slider-dots">
      <?php foreach ( $banners as $idx => $_ ) : ?>
        <span class="dot <?php echo $idx === 0 ? 'active' : ''; ?>"
              onclick="setSlide(<?php echo $idx; ?>)"></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- MAIN CONTENT -->
<main class="subpage-content" style="background: var(--c-bg, #f5f7fa); padding: 2rem 0 3rem 0;">
  <div class="container">

    <!-- 2. CÁC HẠNG THẺ (ACF Repeater: membership_tiers) -->
    <?php
    $tiers = [];
    if ( function_exists('have_rows') && have_rows('membership_tiers', $acf_source_id) ) {
        while ( have_rows('membership_tiers', $acf_source_id) ) {
            the_row();
            $tier_name = get_sub_field('tier_name');
            $tier_slug = get_sub_field('tier_slug'); // silver, gold, platinum, diamond
            $tier_img = get_sub_field('tier_image');
            $tier_img_url = is_array($tier_img) ? $tier_img['url'] : $tier_img;
            $tier_price = get_sub_field('tier_price');
            $tier_price_sub = get_sub_field('tier_price_sub');
            $tier_btn_text = get_sub_field('tier_button_text');
            $tier_btn_link = get_sub_field('tier_button_link');
            
            $benefits_text = get_sub_field('tier_benefits');
            $benefits_arr = [];
            if ( ! empty($benefits_text) ) {
                $benefits_arr = array_map('trim', explode("\n", str_replace("\r", "", $benefits_text)));
                $benefits_arr = array_filter($benefits_arr);
            }
            
            $tiers[] = [
                'name' => $tier_name,
                'slug' => $tier_slug,
                'image' => $tier_img_url,
                'price' => $tier_price,
                'price_sub' => $tier_price_sub,
                'benefits' => $benefits_arr,
                'btn_text' => $tier_btn_text ? $tier_btn_text : 'Đăng ký tư vấn',
                'btn_link' => $tier_btn_link ? $tier_btn_link : '#dang-ky'
            ];
        }
    }
    
    if ( empty($tiers) ) {
        // Fallback mặc định
        $tiers = [
            [
                'name' => 'Thẻ Bạc',
                'slug' => 'silver',
                'image' => $theme_uri . '/images/bac.jpg',
                'price' => '1.000.000 VND',
                'price_sub' => '/ năm',
                'benefits' => [
                    'Miễn phí khám chuyên khoa tối đa 1 lần/tháng với PGS/TS/BS.CKII.',
                    'Giảm 5% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.',
                    'Miễn phí xe cấp cứu trong phạm vi 10km.',
                    'Ưu tiên xếp lịch khám, phẫu thuật.',
                    'Tích lũy điểm 2%.',
                    'Giảm 25% phí nâng hạng.'
                ],
                'btn_text' => 'Đăng ký tư vấn',
                'btn_link' => '#dang-ky'
            ],
            [
                'name' => 'Thẻ Vàng',
                'slug' => 'gold',
                'image' => $theme_uri . '/images/vang.jpg',
                'price' => '3.000.000 VND',
                'price_sub' => '/ năm',
                'benefits' => [
                    'Miễn phí khám chuyên khoa không giới hạn số lần với Chuyên gia PGS/ TS/ BS. CKII.',
                    'Giảm 10% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.',
                    'Miễn phí xe cấp cứu trong 10km.',
                    'Ưu tiên lịch khám, phẫu thuật.',
                    'Giảm 25% phí nâng hạng.'
                ],
                'btn_text' => 'Đăng ký tư vấn',
                'btn_link' => '#dang-ky'
            ],
            [
                'name' => 'Thẻ Bạch Kim',
                'slug' => 'platinum',
                'image' => $theme_uri . '/images/bach_kim.jpg',
                'price' => '5.000.000 VND',
                'price_sub' => '/ năm',
                'benefits' => [
                    'Miễn phí khám chuyên khoa không giới hạn số lần với chuyên gia PGS/TS/BS.CKII.',
                    'Giảm 15% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.',
                    'Miễn phí xe cấp cứu trong phạm vi 10km.',
                    'Ưu tiên xếp lịch khám, phẫu thuật.',
                    'Tích lũy điểm 4%.',
                    'Áp dụng thêm 1 thành viên gia đình.'
                ],
                'btn_text' => 'Đăng ký tư vấn',
                'btn_link' => '#dang-ky'
            ],
            [
                'name' => 'Thẻ Kim Cương',
                'slug' => 'diamond',
                'image' => $theme_uri . '/images/kim_cuong.jpg',
                'price' => '20.000.000 VND',
                'price_sub' => '/ năm',
                'benefits' => [
                    'Miễn phí khám chuyên khoa không giới hạn số lần với chuyên gia PGS/TS/BS.CKII.',
                    'Giảm 20% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.',
                    'Đưa đón 2 chiều khi khám bệnh, cấp cứu.',
                    'Chăm sóc 1:1, bác sĩ tư vấn riêng.',
                    'Tích lũy điểm 5%.',
                    'Áp dụng cả gia đình (+3 thành viên).'
                ],
                'btn_text' => 'Đăng ký tư vấn',
                'btn_link' => '#dang-ky'
            ]
        ];
    }

    // Tìm dữ liệu của thẻ hiện tại nếu là trang con
    $current_tier_data = null;
    if ( $is_tier_page ) {
        foreach ( $tiers as $t ) {
            if ( $t['slug'] === $target_tier_slug ) {
                $current_tier_data = $t;
                break;
            }
        }
    }
    ?>

    <?php if ( $is_tier_page && $current_tier_data ) : ?>
      <!-- CHI TIẾT 1 HẠNG THẺ (Dành cho trang quét mã QR) -->
      <section class="single-tier-hero single-tier-panel tier-<?php echo esc_attr($current_tier_data['slug']); ?>">
        <div class="single-tier-hero__grid">
          <div class="tier-card-wrapper">
            <img src="<?php echo esc_url($current_tier_data['image']); ?>" alt="<?php echo esc_attr($current_tier_data['name']); ?> CIH" class="tier-card-img" />
          </div>
          <div class="single-tier-hero__info-col">
            <h1 class="tier-title" style="text-transform:uppercase; margin-top:0;">
              <span class="tier-title-main">QUYỀN LỢI THẺ HỘI VIÊN</span><span class="tier-title-sep"> - </span><span class="tier-title-sub">THẺ <?php echo esc_html($cih_current_slug === 'bach-kim' ? 'BẠCH KIM' : ($cih_current_slug === 'kim-cuong' ? 'KIM CƯƠNG' : ($cih_current_slug === 'vang' ? 'VÀNG' : 'BẠC'))); ?></span>
            </h1>
            <ul class="tier-benefits-list">
              <?php foreach ($current_tier_data['benefits'] as $benefit) : ?>
                <li>
                  <span class="benefit-icon">&#10004;</span>
                  <span class="benefit-text"><?php echo esc_html($benefit); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </section>

    <?php else : ?>
      <!-- GIAO DIỆN TRANG CHỦ THÀNH VIÊN (Hiện đầy đủ slider và bảng so sánh) -->
      <h2 class="section__title"
          style="text-align:center; margin-bottom:2rem; font-size:1.6rem; color:#004870; text-transform:uppercase;">
        CÁC HẠNG THẺ
      </h2>

      <div class="member-slider-wrapper">
        <button class="member-slider-arrow member-slider-arrow--prev"
                id="member-prev-btn" aria-label="Thẻ trước">&#10094;</button>

        <div class="member-grid" id="dat-mua">
          <?php foreach ($tiers as $tier) : ?>
            <div class="member-card member-card--<?php echo esc_attr($tier['slug']); ?>">
              <img src="<?php echo esc_url($tier['image']); ?>" alt="<?php echo esc_attr($tier['name']); ?> CIH" class="member-card__img" loading="lazy" />
              <h2 class="member-card__title"><?php echo esc_html($tier['name']); ?></h2>
              <div class="member-card__price"><?php echo esc_html($tier['price']); ?> <span class="member-card__price-sub"><?php echo esc_html($tier['price_sub']); ?></span></div>
            </div>
          <?php endforeach; ?>
        </div><!-- /.member-grid -->

        <button class="member-slider-arrow member-slider-arrow--next"
                id="member-next-btn" aria-label="Thẻ tiếp theo">&#10095;</button>
      </div><!-- /.member-slider-wrapper -->

      <!-- 3. BẢNG SO SÁNH CHI TIẾT (ACF Repeater: comparison_rows) -->
      <h2 class="section__title"
          style="text-align:center; margin: 2.5rem 0 1.5rem; font-size:1.6rem; color:#004870; text-transform:uppercase;">
        QUYỀN LỢI CÁC HẠNG THẺ
      </h2>

      <?php
      $comp_rows = [];
      if ( function_exists('have_rows') && have_rows('comparison_rows', $acf_source_id) ) {
          while ( have_rows('comparison_rows', $acf_source_id) ) {
              the_row();
              $row_type = get_sub_field('row_type');
              $group_title = get_sub_field('group_title');
              $feat_name = get_sub_field('feature_name');
              $silver_val = get_sub_field('silver_val');
              $gold_val = get_sub_field('gold_val');
              $plat_val = get_sub_field('platinum_val');
              $diam_val = get_sub_field('diamond_val');
              
              $comp_rows[] = [
                  'type' => $row_type,
                  'group_title' => $group_title,
                  'feature_name' => $feat_name,
                  'silver' => $silver_val,
                  'gold' => $gold_val,
                  'platinum' => $plat_val,
                  'diamond' => $diam_val,
              ];
          }
      }
      
      if ( empty($comp_rows) ) {
          // Fallback mặc định
          $comp_rows = [
              ['type' => 'Group Header', 'group_title' => 'Khám chuyên khoa'],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Miễn phí khám với chuyên gia PGS/TS/BS.CKII',
                  'silver' => 'Tối đa 1 lần/tháng',
                  'gold' => 'Không giới hạn',
                  'platinum' => 'Không giới hạn',
                  'diamond' => 'Không giới hạn'
              ],
              ['type' => 'Group Header', 'group_title' => 'Giảm giá dịch vụ'],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Xét nghiệm, CT/MRI, siêu âm',
                  'silver' => 'Giảm 5%',
                  'gold' => 'Giảm 10%',
                  'platinum' => 'Giảm 15%',
                  'diamond' => 'Giảm 20%'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Điều trị, thủ thuật, phẫu thuật, nội trú',
                  'silver' => 'Giảm 5%',
                  'gold' => 'Giảm 10%',
                  'platinum' => 'Giảm 15%',
                  'diamond' => 'Giảm 20%'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Gói khám sức khỏe, tầm soát ung thư',
                  'silver' => 'Giảm 5%',
                  'gold' => 'Giảm 10%',
                  'platinum' => 'Giảm 15%',
                  'diamond' => 'Giảm 20%'
              ],
              ['type' => 'Group Header', 'group_title' => 'Tiện ích & vận chuyển'],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Miễn phí xe cấp cứu (trong 10km)',
                  'silver' => '1 chiều',
                  'gold' => '1 chiều',
                  'platinum' => '1 chiều',
                  'diamond' => '2 chiều'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Đưa đón khám, chữa bệnh 2 chiều (trong 10km)',
                  'silver' => 'unchecked',
                  'gold' => 'unchecked',
                  'platinum' => 'unchecked',
                  'diamond' => 'checked'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Ưu tiên lịch khám, thủ thuật, phẫu thuật',
                  'silver' => 'checked',
                  'gold' => 'checked',
                  'platinum' => 'checked',
                  'diamond' => 'checked'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Nhắc lịch tái khám chủ động',
                  'silver' => 'checked',
                  'gold' => 'checked',
                  'platinum' => 'checked',
                  'diamond' => 'checked'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Chăm sóc 1:1 & bác sĩ tư vấn riêng',
                  'silver' => 'unchecked',
                  'gold' => 'unchecked',
                  'platinum' => 'unchecked',
                  'diamond' => 'checked'
              ],
              ['type' => 'Group Header', 'group_title' => 'Tích điểm & gia đình'],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Tích điểm nâng hạng thẻ',
                  'silver' => 'checked',
                  'gold' => 'checked',
                  'platinum' => 'checked',
                  'diamond' => 'checked'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Giảm 25% phí nâng hạng thẻ',
                  'silver' => 'checked',
                  'gold' => 'checked',
                  'platinum' => 'unchecked',
                  'diamond' => 'unchecked'
              ],
              [
                  'type' => 'Feature Row', 
                  'feature_name' => 'Áp dụng cho thành viên gia đình',
                  'silver' => '',
                  'gold' => '',
                  'platinum' => '+1 thành viên',
                  'diamond' => '+3 thành viên'
              ],
          ];
      }
      ?>

      <div class="compare-container">
        <table class="compare-table">
          <thead>
            <tr>
              <th class="col-title-header">Quyền lợi</th>
              <th class="col-header silver-cell">
                <div class="col-header__icon">
                  <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto 0.2rem">
                    <path d="M14 10L10 22L20 18L30 22L26 10" fill="#7B8FE4"/>
                    <path d="M18 10L16 20L20 18L24 20L22 10" fill="#5066D6"/>
                    <circle cx="20" cy="22" r="10" fill="url(#sg)" stroke="#B0BAC9" stroke-width="1.5"/>
                    <circle cx="20" cy="12" r="2" fill="#B0BAC9"/>
                    <text x="20" y="26" font-family="sans-serif" font-size="11" font-weight="900" fill="#4A5568" text-anchor="middle">2</text>
                    <defs><linearGradient id="sg" x1="12" y1="14" x2="28" y2="30" gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFFFFF"/><stop offset="0.5" stop-color="#E2E8F0"/><stop offset="1" stop-color="#CBD5E0"/>
                    </linearGradient></defs>
                  </svg>
                </div>
                <div class="col-header__name">Thẻ Bạc</div>
              </th>
              <th class="col-header gold-cell">
                <div class="col-header__icon">
                  <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto 0.2rem">
                    <path d="M14 10L10 22L20 18L30 22L26 10" fill="#F6AD55"/>
                    <path d="M18 10L16 20L20 18L24 20L22 10" fill="#DD6B20"/>
                    <circle cx="20" cy="22" r="10" fill="url(#gg)" stroke="#ECC94B" stroke-width="1.5"/>
                    <circle cx="20" cy="12" r="2" fill="#ECC94B"/>
                    <text x="20" y="26" font-family="sans-serif" font-size="11" font-weight="900" fill="#975A16" text-anchor="middle">1</text>
                    <defs><linearGradient id="gg" x1="12" y1="14" x2="28" y2="30" gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFFDF5"/><stop offset="0.5" stop-color="#F6E05E"/><stop offset="1" stop-color="#d4af37"/>
                    </linearGradient></defs>
                  </svg>
                </div>
                <div class="col-header__name">Thẻ Vàng</div>
              </th>
              <th class="col-header platinum-cell">
                <div class="col-header__icon">
                  <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto 0.2rem">
                    <path d="M20 6L32 15L20 34L8 15L20 6Z" fill="url(#pg)"/>
                    <path d="M20 6L26 15H14L20 6Z" fill="#63B3ED"/>
                    <path d="M8 15H14L20 34L8 15Z" fill="#3182CE"/>
                    <path d="M32 15H26L20 34L32 15Z" fill="#2B6CB0"/>
                    <path d="M14 15L20 34L26 15H14Z" fill="#4299E1"/>
                    <defs><linearGradient id="pg" x1="8" y1="6" x2="32" y2="34" gradientUnits="userSpaceOnUse">
                      <stop stop-color="#EBF8FF"/><stop offset="0.5" stop-color="#90CDF4"/><stop offset="1" stop-color="#3182CE"/>
                    </linearGradient></defs>
                  </svg>
                </div>
                <div class="col-header__name">Thẻ Bạch Kim</div>
              </th>
              <th class="col-header diamond-cell">
                <div class="col-header__icon" style="font-size:1.4rem;line-height:1;margin-bottom:0.2rem">&#128081;</div>
                <div class="col-header__name">Thẻ Kim Cương</div>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($comp_rows as $row) : ?>
              <?php if ($row['type'] === 'Group Header' || $row['type'] === 'group_header') : ?>
                <tr class="group-header">
                  <td colspan="5"><span><?php echo esc_html($row['group_title']); ?></span></td>
                </tr>
              <?php else : ?>
                <tr>
                  <td style="padding-left:1.5rem"><span class="row-title"><?php echo esc_html($row['feature_name']); ?></span></td>
                  <td class="cell-value silver-cell"><?php echo cih_render_cell_val($row['silver']); ?></td>
                  <td class="cell-value gold-cell"><?php echo cih_render_cell_val($row['gold']); ?></td>
                  <td class="cell-value platinum-cell"><?php echo cih_render_cell_val($row['platinum']); ?></td>
                  <td class="cell-value diamond-cell"><?php echo cih_render_cell_val($row['diamond']); ?></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            
            <!-- Hàng chứa nút bấm -->
            <tr>
              <td style="padding-left:1.5rem"></td>
              <td class="cell-value silver-cell" style="padding:1rem 0.5rem">
                <a href="<?php echo esc_url($tiers[0]['btn_link'] ?? '#dang-ky'); ?>" class="btn-register">
                  <?php echo esc_html($tiers[0]['btn_text'] ?? 'Đăng ký ngay'); ?>
                </a>
              </td>
              <td class="cell-value gold-cell" style="padding:1rem 0.5rem">
                <a href="<?php echo esc_url($tiers[1]['btn_link'] ?? '#dang-ky'); ?>" class="btn-register">
                  <?php echo esc_html($tiers[1]['btn_text'] ?? 'Đăng ký ngay'); ?>
                </a>
              </td>
              <td class="cell-value platinum-cell" style="padding:1rem 0.5rem">
                <a href="<?php echo esc_url($tiers[2]['btn_link'] ?? '#dang-ky'); ?>" class="btn-register">
                  <?php echo esc_html($tiers[2]['btn_text'] ?? 'Đăng ký ngay'); ?>
                </a>
              </td>
              <td class="cell-value diamond-cell" style="padding:1rem 0.5rem">
                <a href="<?php echo esc_url($tiers[3]['btn_link'] ?? '#dang-ky'); ?>" class="btn-register">
                  <?php echo esc_html($tiers[3]['btn_text'] ?? 'Đăng ký ngay'); ?>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
    <!-- 5. ĐIỀU KHOẢN CHƯƠNG TRÌNH (ACF WYSIWYG Editor: membership_terms) -->
    <?php
    $terms = '';
    if ( function_exists('get_field') ) {
        $terms = get_field('membership_terms', $acf_source_id);
    }
    if ( empty($terms) ) {
        $terms = '
            <ul class="rules-item-list">
              <li>Ưu đãi chỉ áp dụng trên chi phí bệnh nhân tự chi trả - không bao gồm phần bảo hiểm, chi phí bác sĩ phẫu thuật, bác sĩ điều trị, thuốc, vật tư tiêu hao, và dịch vụ thuộc đơn vị hợp tác.</li>
              <li>Mỗi dịch vụ chỉ được hưởng một ưu đãi cao nhất - không được gộp nhiều ưu đãi cùng lúc.</li>
              <li>Không áp dụng cho gói sinh, gói IVF, gói vắc xin, phòng VIP, và dịch vụ gửi xét nghiệm ra ngoài bệnh viện.</li>
              <li>Thẻ định danh cố định cho chủ thẻ và người được thêm vào - không thay đổi định danh trong suốt thời gian thẻ còn hiệu lực.</li>
              <li>Điểm tích lũy có hiệu lực 12 tháng và hết hiệu lực sau 30 ngày kể từ khi thẻ hết hạn. Điểm chỉ dùng tối đa 30% hóa đơn mỗi lần.</li>
            </ul>
        ';
    } else {
        // Convert any standard list tag to use rules-item-list to render as details (arrow style)
        $terms = preg_replace('/<ul[^>]*>/iu', '<ul class="rules-item-list">', $terms);
    }
    ?>
    <div class="rules-table-container" style="margin-top:2rem; padding:1.5rem; background:#fff; border:1px solid var(--c-border); border-radius:var(--r-md)">
      <div class="rules-section-title" style="font-weight:700; font-size:1.1rem; margin-bottom:1rem">ĐIỀU KHOẢN</div>
      <?php echo wp_kses_post($terms); ?>
    </div>

    <?php if ( ! $is_tier_page ) : ?>
    <!-- 6. CÂU HỎI THƯỜNG GẶP (ACF Repeater: faq_list) -->
    <h2 class="section__title" style="text-align:center; margin:2.5rem 0 1.5rem; font-size:1.6rem; color:#004870">
      CÂU HỎI THƯỜNG GẶP
    </h2>
    
    <?php
    $faqs = [];
    if ( function_exists('have_rows') && have_rows('faq_list', $acf_source_id) ) {
        while ( have_rows('faq_list', $acf_source_id) ) {
            the_row();
            $faqs[] = [
                'q' => get_sub_field('faq_question'),
                'a' => get_sub_field('faq_answer'),
            ];
        }
    }
    if ( empty($faqs) ) {
        $faqs = [
            ['q'=>'1. Làm thế nào để đăng ký thẻ hội viên City Membership?', 'a'=>'Quý khách có thể đăng ký trên Website http://cih.com.vn hoặc tại quầy thông tin Bệnh viện Quốc tế City.'],
            ['q'=>'2. Thẻ hội viên City Membership mang đến những quyền lợi gì?', 'a'=>'Hội viên Bệnh viện Quốc tế City được hưởng các đặc quyền như ưu đãi chi phí khám và điều trị, tích lũy điểm thưởng, ưu tiên đặt lịch khám, hỗ trợ cấp cứu và nhiều quyền lợi chăm sóc sức khỏe dành riêng cho từng hạng thẻ.'],
            ['q'=>'3. Thẻ có hiệu lực trong bao lâu?', 'a'=>'Thẻ có hiệu lực 12 tháng kể từ ngày kích hoạt. Trước khi hết hạn, Bệnh viện Quốc tế City sẽ chủ động gửi thông báo để Quý khách dễ dàng gia hạn.'],
            ['q'=>'4. Tôi có thể đăng ký thẻ cho người thân không?', 'a'=>'Có. Đối với hạng Platinum và Diamond, Quý khách có thể đăng ký thêm thành viên gia đình theo quy định của chương trình.'],
            ['q'=>'5. Dịch vụ vận chuyển cấp cứu dành cho hội viên được áp dụng ra sao?', 'a'=>'Tất cả hội viên đều được hỗ trợ vận chuyển cấp cứu đến Bệnh viện Quốc tế City trong phạm vi áp dụng. Tùy theo hạng thẻ, Quý khách sẽ được hưởng thêm các quyền lợi hỗ trợ nâng cao.'],
            ['q'=>'6. Tôi có thể sử dụng đồng thời ưu đãi thẻ và các chương trình khuyến mại khác không?', 'a'=>'Mỗi dịch vụ sẽ áp dụng một mức ưu đãi tối ưu nhất tại thời điểm sử dụng. Hệ thống sẽ tự động lựa chọn quyền lợi có giá trị cao nhất.']
        ];
    }
    ?>

    <div class="faq-container">
      <?php foreach ( $faqs as $faq ) : ?>
        <div class="faq-item">
          <button class="faq-trigger" onclick="toggleFaq(this)">
            <span><?php echo wp_kses_post($faq['q']); ?></span>
            <span class="faq-chevron">&#9660;</span>
          </button>
          <div class="faq-content">
            <div class="faq-inner-text"><?php echo wp_kses_post($faq['a']); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- 7. FORM ĐĂNG KÝ — Mặc định Forminator id=45718 hoặc cấu hình từ ACF shortcode_form -->
    <?php if ( ! $is_tier_page ) : ?>
    <div id="dang-ky" class="member-register-card" style="scroll-margin-top:80px">
      <h2 class="member-register-title">ĐĂNG KÝ TƯ VẤN</h2>
      <?php
      $shortcode = '[forminator_form id="45718"]';
      if ( function_exists('get_field') ) {
          $acf_sc = get_field('shortcode_form', $acf_source_id);
          if ( ! empty($acf_sc) ) $shortcode = $acf_sc;
      }
      echo do_shortcode( $shortcode );
      ?>
    </div>
    <?php endif; ?>

  </div><!-- /.container -->
</main>

<!-- FOOTER -->
<footer class="footer" id="lien-he">
  <div class="footer__main">
    <div class="container footer__grid">
      <div class="footer__brand">
        <div class="footer__logo">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/cih/images/logo_cih_acci.png' ); ?>"
               alt="" class="footer__logo-img"
               onerror="this.style.display='none'" />
        </div>
        <div class="footer__company-info">
          <p class="footer__legal-name">CÔNG TY TNHH BỆNH VIỆN QUỐC TẾ CITY</p>
          <p class="footer__license">Số đăng ký kinh doanh: 0310898993 cấp bởi Sở Kế hoạch và Đầu tư TP. HCM, đăng ký lần đầu ngày 03/06/2011.</p>
        </div>
        <div class="footer__social">
          <a href="https://www.facebook.com/benhvienquoctecity" class="footer__soc-btn" id="footer-fb" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H7v3h2v9h4v-9h3.6l.4-3H13V6c0-.5.5-1 1-1h3V1h-4c-3 0-5 2-5 5v2z"/></svg>
          </a>
          <a href="https://www.youtube.com/@bvqtcity" class="footer__soc-btn" id="footer-yt" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2c-.3-1.1-1.2-2-2.3-2.3C19.2 3.5 12 3.5 12 3.5s-7.2 0-9.2.4c-1.1.3-2 1.2-2.3 2.3C.1 8.2.1 12 .1 12s0 3.8.4 5.8c.3 1.1 1.2 2 2.3 2.3 2 .4 9.2.4 9.2.4s7.2 0 9.2-.4c1.1-.3 2-1.2 2.3-2.3.4-2 .4-5.8.4-5.8s0-3.8-.4-5.8zM9.5 15.5V8.5l6.5 3.5-6.5 3.5z"/></svg>
          </a>
          <a href="https://tiktok.com/@benhvienquoctecity" class="footer__soc-btn" id="footer-tiktok" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.5 3v11.7c0 2-1.7 3.8-3.8 3.8a3.8 3.8 0 0 1-3.8-3.8c0-2 1.7-3.8 3.8-3.8.3 0 .7.1 1 .2V7.1a7.8 7.8 0 0 0-4.8 1c-1.8 1.1-3 3-3 5.3a7.8 7.8 0 0 0 7.8 7.8 7.8 7.8 0 0 0 7.8-7.8V8.2c1.3.9 3 1.5 4.8 1.5V6a4.8 4.8 0 0 1-4-2.2V3h-3z"/></svg>
          </a>
        </div>
      </div>

      <div class="footer__col">
        <h4 class="footer__heading">TRUY CẬP NHANH</h4>
        <ul class="footer__links">
          <li><a href="<?php echo esc_url( home_url( '/gioi-thieu/' ) ); ?>">Giới thiệu</a></li>
          <li><a href="<?php echo esc_url( home_url( '/chuyen-khoa/' ) ); ?>">Chuyên khoa</a></li>
          <li><a href="<?php echo esc_url( home_url( '/bac-si/' ) ); ?>">Bác sĩ</a></li>
        </ul>
      </div>

      <div class="footer__col">
        <h4 class="footer__heading">DÀNH CHO KHÁCH HÀNG</h4>
        <ul class="footer__links">
          <li><a href="https://patient.cih.com.vn/Account/Login" target="_blank">Cổng khách hàng</a></li>
          <li><a href="<?php echo esc_url( home_url( '/the-thanh-vien/' ) ); ?>">Thẻ thành viên</a></li>
        </ul>
      </div>

      <div class="footer__col">
        <h4 class="footer__heading">LIÊN HỆ</h4>
        <ul class="footer__contact">
          <li>
            <span class="footer__contact-icon" style="margin-top: 2px;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </span>
            <span>Địa chỉ: &nbsp;Số 3 Đường 17A, Phường An Lạc, TP. HCM</span>
          </li>
          <li>
            <span class="footer__contact-icon">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.87 2 2 0 0 1 3.59 2.68h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l.76-.76a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 17z"></path></svg>
            </span>
            <span>Tổng đài: &nbsp;<a href="tel:19008146"><strong>1900 8146</strong></a></span>
          </li>
          <li>
            <span class="footer__contact-icon">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.87 2 2 0 0 1 3.59 2.68h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l.76-.76a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 17z"></path></svg>
            </span>
            <span>Cấp cứu: &nbsp;<a href="tel:02862901155"><strong>(028) 6290 1155</strong></a></span>
          </li>
          <li>
            <span class="footer__contact-icon">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </span>
            <span>Email: &nbsp;<a href="mailto:truyenthong@cih.com.vn">truyenthong@cih.com.vn</a></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="container footer__bottom-inner">
      <p>Copyright © 2026 City International Hospital. All Rights Reserved.</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
<script src="<?php echo esc_url( get_stylesheet_directory_uri() . '/cih/membership.js' ); ?>?ver=3.5" data-no-optimize="1" data-no-defer="1"></script>
</body>
</html>
