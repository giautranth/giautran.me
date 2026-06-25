<?php
/**
 * Template Name: CIH Membership Template
 * Description: Landing page Thẻ Thành Viên – dùng Header/Footer Flatsome,
 *              ACF để quản trị banner slider, các hạng thẻ, bảng so sánh, điều khoản, FAQs, và Forminator cho form đăng ký.
 */

// Load stylesheet và script của landing page - chỉ load khi vào đúng trang này
function cih_membership_assets() {
    if ( is_page_template( 'page-membership.php' ) ) {
        $uri = get_stylesheet_directory_uri() . '/cih';
        wp_enqueue_style(
            'cih-membership-style',
            $uri . '/membership.css',
            [],
            '3.1'
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
            '3.1',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'cih_membership_assets' );

// Helper render giá trị trong bảng so sánh (Hỗ trợ checkbox hoặc text)
function cih_render_cell_val($val) {
    $val = trim($val);
    if ($val === 'checked') {
        return '<span class="custom-checkbox checked"></span>';
    } elseif ($val === 'unchecked') {
        return '<span class="custom-checkbox unchecked"></span>';
    }
    return esc_html($val);
}

get_header(); // Header thật của Flatsome
?>

<link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>" />

<!-- BREADCRUMBS -->
<div class="breadcrumbs-bar" style="background: var(--c-bg, #f5f7fa); padding: 0.75rem 0;">
  <div class="container">
    <div style="font-size: 0.8rem; color: #718096;">
      <a href="<?php echo home_url(); ?>" style="color: #4a5568; text-decoration: none;">Trang Chủ</a>
      &nbsp;&raquo;&nbsp;
      <span>Thẻ Thành Viên</span>
    </div>
  </div>
</div>

<?php
// 1. BANNER SLIDER: lấy từ ACF Repeater (banner_slider > banner_image)
$theme_uri = get_stylesheet_directory_uri() . '/cih';
$banners = [];
if ( function_exists('have_rows') && have_rows('banner_slider') ) {
    while ( have_rows('banner_slider') ) {
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

<!-- MAIN CONTENT -->
<main class="subpage-content" style="background: var(--c-bg, #f5f7fa); padding: 2rem 0 3rem 0;">
  <div class="container">

    <!-- 2. CÁC HẠNG THẺ (ACF Repeater: membership_tiers) -->
    <h2 class="section__title"
        style="text-align:center; margin-bottom:2rem; font-size:1.6rem; color:#004870; text-transform:uppercase;">
      CÁC HẠNG THẺ
    </h2>

    <?php
    $tiers = [];
    if ( function_exists('have_rows') && have_rows('membership_tiers') ) {
        while ( have_rows('membership_tiers') ) {
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
                    'Miễn phí khám chuyên khoa không giới hạn số lần với chuyên gia PGS/TS/BS.CKII.',
                    'Giảm 10% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.',
                    'Miễn phí xe cấp cứu trong phạm vi 10km.',
                    'Ưu tiên xếp lịch khám, phẫu thuật.',
                    'Tích lũy điểm 3%.',
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
    ?>

    <div class="member-slider-wrapper">
      <button class="member-slider-arrow member-slider-arrow--prev"
              id="member-prev-btn" aria-label="Thẻ trước">&#10094;</button>

      <div class="member-grid" id="dat-mua">
        <?php foreach ($tiers as $tier) : ?>
          <div class="member-card member-card--<?php echo esc_attr($tier['slug']); ?>" onclick="toggleMemberCard(this, event)">
            <img src="<?php echo esc_url($tier['image']); ?>" alt="<?php echo esc_attr($tier['name']); ?> CIH" class="member-card__img" loading="lazy" />
            <h2 class="member-card__title"><?php echo esc_html($tier['name']); ?></h2>
            <div class="member-card__price"><?php echo esc_html($tier['price']); ?> <span class="member-card__price-sub"><?php echo esc_html($tier['price_sub']); ?></span></div>
            <div class="member-card__toggle-link">Xem thêm &#9660;</div>
            <div class="member-card__details">
              <div class="member-card__benefits">
                <?php foreach ($tier['benefits'] as $benefit) : ?>
                  <div class="member-card__benefit-item"><?php echo esc_html($benefit); ?></div>
                <?php endforeach; ?>
              </div>
              <a href="<?php echo esc_url($tier['btn_link']); ?>" class="member-card__btn member-card__btn--<?php echo esc_attr($tier['slug']); ?>"><?php echo esc_html($tier['btn_text']); ?></a>
            </div>
          </div>
        <?php endforeach; ?>
      </div><!-- /.member-grid -->

      <button class="member-slider-arrow member-slider-arrow--next"
              id="member-next-btn" aria-label="Thẻ tiếp theo">&#10095;</button>
    </div><!-- /.member-slider-wrapper -->


    <!-- 3. BẢNG SO SÁNH CHI TIẾT (ACF Repeater: comparison_rows) -->
    <h2 class="section__title"
        style="text-align:center; margin: 2.5rem 0 1.5rem; font-size:1.6rem; color:#004870; text-transform:uppercase;">
      BẢNG SO SÁNH CÁC HẠNG THẺ
    </h2>

    <?php
    $comp_rows = [];
    if ( function_exists('have_rows') && have_rows('comparison_rows') ) {
        while ( have_rows('comparison_rows') ) {
            the_row();
            $row_type = get_sub_field('row_type'); // 'Group Header' hoặc 'Feature Row'
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
                'feature_name' => 'Tích điểm trên tổng viện phí',
                'silver' => '2%',
                'gold' => '3%',
                'platinum' => '4%',
                'diamond' => '5%'
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

    <!-- 4. QUY TẮC TÍCH ĐIỂM (ACF WYSIWYG Editors: rules_left, rules_right) -->
    <?php
    $rules_left = '';
    $rules_right = '';
    if ( function_exists('get_field') ) {
        $rules_left = get_field('rules_left');
        $rules_right = get_field('rules_right');
    }
    
    if ( empty($rules_left) ) {
        $rules_left = '
            <div class="rules-section-title">Quy tắc quy đổi</div>
            <ul class="rules-item-list">
              <li>100 điểm = 1.000 đồng.</li>
              <li>Dùng thanh toán lần sử dụng dịch vụ tiếp theo.</li>
              <li>Mỗi lần chỉ được dùng tối đa 30% giá trị hóa đơn.</li>
            </ul>
        ';
    }
    if ( empty($rules_right) ) {
        $rules_right = '
            <div class="rules-section-title">Hiệu lực điểm</div>
            <ul class="rules-item-list">
              <li>12 tháng kể từ ngày tích.</li>
              <li>Hết hiệu lực sau 30 ngày khi thẻ hết hạn.</li>
              <li>Không chuyển nhượng.</li>
            </ul>
        ';
    }
    ?>

    <div class="rules-table-container" style="margin-top:2rem">
      <table class="rules-table">
        <tbody>
          <tr>
            <td colspan="2" style="width:50%">
              <?php echo wp_kses_post($rules_left); ?>
            </td>
            <td colspan="2" style="width:50%">
              <?php echo wp_kses_post($rules_right); ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- 5. ĐIỀU KHOẢN CHƯƠNG TRÌNH (ACF WYSIWYG Editor: membership_terms) -->
    <?php
    $terms = '';
    if ( function_exists('get_field') ) {
        $terms = get_field('membership_terms');
    }
    if ( empty($terms) ) {
        $terms = '
            <ul style="margin:0;padding-left:1.5rem;line-height:1.8;list-style-type:disc;text-align:justify">
              <li>Ưu đãi chỉ áp dụng trên chi phí bệnh nhân tự chi trả - không bao gồm phần bảo hiểm, chi phí bác sĩ phẫu thuật, bác sĩ điều trị, thuốc, vật tư tiêu hao, và dịch vụ thuộc đơn vị hợp tác.</li>
              <li>Mỗi dịch vụ chỉ được hưởng một ưu đãi cao nhất - không được gộp nhiều ưu đãi cùng lúc.</li>
              <li>Không áp dụng cho gói sinh, gói IVF, gói vắc xin, phòng VIP, và dịch vụ gửi xét nghiệm ra ngoài bệnh viện.</li>
              <li>Thẻ định danh cố định cho chủ thẻ và người được thêm vào - không thay đổi định danh trong suốt thời gian thẻ còn hiệu lực.</li>
              <li>Điểm tích lũy có hiệu lực 12 tháng và hết hiệu lực sau 30 ngày kể từ khi thẻ hết hạn. Điểm chỉ dùng tối đa 30% hóa đơn mỗi lần.</li>
            </ul>
        ';
    }
    ?>
    <div class="faq-container" style="margin-top:0.75rem">
      <div class="faq-item">
        <button class="faq-trigger" onclick="toggleFaq(this)" style="background:#f0f4f8;border-radius:8px">
          <span style="font-weight:600;color:#004870">Điều khoản</span>
          <span class="faq-chevron">&#9660;</span>
        </button>
        <div class="faq-content">
          <div class="faq-inner-text">
            <?php echo wp_kses_post($terms); ?>
          </div>
        </div>
      </div>
    </div>

    <!-- 6. CÂU HỎI THƯỜNG GẶP (ACF Repeater: faq_list) -->
    <h2 class="section__title" style="text-align:center; margin:2.5rem 0 1.5rem; font-size:1.6rem; color:#004870">
      CÂU HỎI THƯỜNG GẶP
    </h2>
    
    <?php
    $faqs = [];
    if ( function_exists('have_rows') && have_rows('faq_list') ) {
        while ( have_rows('faq_list') ) {
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
            ['q'=>'6. Tôi có thể sử dụng đồng thời ưu đãi thẻ và các chương trình khuyến mại khác không?', 'a'=>'Mỗi dịch vụ sẽ áp dụng một mức ưu đãi tối ưu nhất tại thời điểm sử dụng. Hệ thống sẽ tự động lựa chọn quyền lợi có giá trị cao nhất.'],
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

    <!-- 7. FORM ĐĂNG KÝ — Mặc định Forminator id=45718 hoặc cấu hình từ ACF shortcode_form -->
    <div id="dang-ky" class="member-register-card" style="scroll-margin-top:80px">
      <h2 class="member-register-title">ĐĂNG KÝ TƯ VẤN</h2>
      <?php
      $shortcode = '[forminator_form id="45718"]';
      if ( function_exists('get_field') ) {
          $acf_sc = get_field('shortcode_form');
          if ( ! empty($acf_sc) ) $shortcode = $acf_sc;
      }
      echo do_shortcode( $shortcode );
      ?>
    </div>

  </div><!-- /.container -->
</main>

<?php
get_footer(); // Footer thật của Flatsome
?>
