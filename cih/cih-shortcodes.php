<?php
/**
 * CIH Membership Shortcodes
 * Đăng ký các shortcode dùng trong UX Builder cho trang Thẻ Thành Viên
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$CIH_THEME_URI = get_stylesheet_directory_uri() . '/cih';

// Helper render giá trị cell bảng so sánh
function cih_render_cell_val( $val ) {
    $val = trim( (string) $val );
    if ( $val === 'checked' ) {
        return '<span class="custom-checkbox checked"></span>';
    } elseif ( $val === 'unchecked' ) {
        return '<span class="custom-checkbox unchecked"></span>';
    }
    return esc_html( $val );
}

// -------------------------------------------------------
// 1. BANNER SLIDER — [cih_banner_slider]
// -------------------------------------------------------
function cih_shortcode_banner_slider( $atts ) {
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

    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_banner_slider', 'cih_shortcode_banner_slider' );


// -------------------------------------------------------
// 2. HẠNG THẺ — [cih_membership_cards]
// -------------------------------------------------------
function cih_shortcode_membership_cards( $atts ) {
    $theme_uri = get_stylesheet_directory_uri() . '/cih';
    $tiers = [];

    if ( function_exists('have_rows') && have_rows('membership_tiers') ) {
        while ( have_rows('membership_tiers') ) {
            the_row();
            $tier_img = get_sub_field('tier_image');
            $benefits_text = get_sub_field('tier_benefits') ?? '';
            $benefits_arr = array_filter( array_map('trim', explode("\n", str_replace("\r", "", $benefits_text))) );
            $tiers[] = [
                'name'      => get_sub_field('tier_name'),
                'slug'      => get_sub_field('tier_slug'),
                'image'     => is_array($tier_img) ? $tier_img['url'] : $tier_img,
                'price'     => get_sub_field('tier_price'),
                'price_sub' => get_sub_field('tier_price_sub'),
                'benefits'  => $benefits_arr,
                'btn_text'  => get_sub_field('tier_button_text') ?: 'Đăng ký tư vấn',
                'btn_link'  => get_sub_field('tier_button_link') ?: '#dang-ky'
            ];
        }
    }

    if ( empty($tiers) ) {
        $tiers = [
            [
                'name' => 'Thẻ Bạc', 'slug' => 'silver', 'image' => $theme_uri . '/images/bac.jpg',
                'price' => '1.000.000 VND', 'price_sub' => '/ năm',
                'benefits' => ['Miễn phí khám tối đa 1 lần/tháng với PGS/TS/BS.CKII.','Giảm 5% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.','Miễn phí xe cấp cứu trong phạm vi 10km.','Ưu tiên xếp lịch khám, phẫu thuật.','Tích lũy điểm 2%.','Giảm 25% phí nâng hạng.'],
                'btn_text' => 'Đăng ký tư vấn', 'btn_link' => '#dang-ky'
            ],
            [
                'name' => 'Thẻ Vàng', 'slug' => 'gold', 'image' => $theme_uri . '/images/vang.jpg',
                'price' => '3.000.000 VND', 'price_sub' => '/ năm',
                'benefits' => ['Miễn phí khám không giới hạn với chuyên gia PGS/TS/BS.CKII.','Giảm 10% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.','Miễn phí xe cấp cứu trong phạm vi 10km.','Ưu tiên xếp lịch khám, phẫu thuật.','Tích lũy điểm 3%.','Giảm 25% phí nâng hạng.'],
                'btn_text' => 'Đăng ký tư vấn', 'btn_link' => '#dang-ky'
            ],
            [
                'name' => 'Thẻ Bạch Kim', 'slug' => 'platinum', 'image' => $theme_uri . '/images/bach_kim.jpg',
                'price' => '5.000.000 VND', 'price_sub' => '/ năm',
                'benefits' => ['Miễn phí khám không giới hạn với chuyên gia PGS/TS/BS.CKII.','Giảm 15% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.','Miễn phí xe cấp cứu trong phạm vi 10km.','Ưu tiên xếp lịch khám, phẫu thuật.','Tích lũy điểm 4%.','Áp dụng thêm 1 thành viên gia đình.'],
                'btn_text' => 'Đăng ký tư vấn', 'btn_link' => '#dang-ky'
            ],
            [
                'name' => 'Thẻ Kim Cương', 'slug' => 'diamond', 'image' => $theme_uri . '/images/kim_cuong.jpg',
                'price' => '20.000.000 VND', 'price_sub' => '/ năm',
                'benefits' => ['Miễn phí khám không giới hạn với chuyên gia PGS/TS/BS.CKII.','Giảm 20% xét nghiệm, chẩn đoán hình ảnh, điều trị, gói khám.','Đưa đón 2 chiều khi khám bệnh, cấp cứu.','Chăm sóc 1:1, bác sĩ tư vấn riêng.','Tích lũy điểm 5%.','Áp dụng cả gia đình (+3 thành viên).'],
                'btn_text' => 'Đăng ký tư vấn', 'btn_link' => '#dang-ky'
            ]
        ];
    }

    ob_start();
    ?>
    <div class="member-slider-wrapper">
      <button class="member-slider-arrow member-slider-arrow--prev" id="member-prev-btn" aria-label="Thẻ trước">&#10094;</button>
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
      </div>
      <button class="member-slider-arrow member-slider-arrow--next" id="member-next-btn" aria-label="Thẻ tiếp theo">&#10095;</button>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_membership_cards', 'cih_shortcode_membership_cards' );


// -------------------------------------------------------
// 3. BẢNG SO SÁNH — [cih_comparison_table]
// -------------------------------------------------------
function cih_shortcode_comparison_table( $atts ) {
    $comp_rows = [];
    if ( function_exists('have_rows') && have_rows('comparison_rows') ) {
        while ( have_rows('comparison_rows') ) {
            the_row();
            $comp_rows[] = [
                'type'         => get_sub_field('row_type'),
                'group_title'  => get_sub_field('group_title'),
                'feature_name' => get_sub_field('feature_name'),
                'silver'       => get_sub_field('silver_val'),
                'gold'         => get_sub_field('gold_val'),
                'platinum'     => get_sub_field('platinum_val'),
                'diamond'      => get_sub_field('diamond_val'),
            ];
        }
    }

    if ( empty($comp_rows) ) {
        $comp_rows = [
            ['type' => 'group_header', 'group_title' => 'Khám chuyên khoa'],
            ['type' => 'feature_row', 'feature_name' => 'Miễn phí khám với chuyên gia PGS/TS/BS.CKII', 'silver' => 'Tối đa 1 lần/tháng', 'gold' => 'Không giới hạn', 'platinum' => 'Không giới hạn', 'diamond' => 'Không giới hạn'],
            ['type' => 'group_header', 'group_title' => 'Giảm giá dịch vụ'],
            ['type' => 'feature_row', 'feature_name' => 'Xét nghiệm, CT/MRI, siêu âm', 'silver' => 'Giảm 5%', 'gold' => 'Giảm 10%', 'platinum' => 'Giảm 15%', 'diamond' => 'Giảm 20%'],
            ['type' => 'feature_row', 'feature_name' => 'Điều trị, thủ thuật, phẫu thuật, nội trú', 'silver' => 'Giảm 5%', 'gold' => 'Giảm 10%', 'platinum' => 'Giảm 15%', 'diamond' => 'Giảm 20%'],
            ['type' => 'feature_row', 'feature_name' => 'Gói khám sức khỏe, tầm soát ung thư', 'silver' => 'Giảm 5%', 'gold' => 'Giảm 10%', 'platinum' => 'Giảm 15%', 'diamond' => 'Giảm 20%'],
            ['type' => 'group_header', 'group_title' => 'Tiện ích & vận chuyển'],
            ['type' => 'feature_row', 'feature_name' => 'Miễn phí xe cấp cứu (trong 10km)', 'silver' => '1 chiều', 'gold' => '1 chiều', 'platinum' => '1 chiều', 'diamond' => '2 chiều'],
            ['type' => 'feature_row', 'feature_name' => 'Đưa đón khám, chữa bệnh 2 chiều (trong 10km)', 'silver' => 'unchecked', 'gold' => 'unchecked', 'platinum' => 'unchecked', 'diamond' => 'checked'],
            ['type' => 'feature_row', 'feature_name' => 'Ưu tiên lịch khám, thủ thuật, phẫu thuật', 'silver' => 'checked', 'gold' => 'checked', 'platinum' => 'checked', 'diamond' => 'checked'],
            ['type' => 'feature_row', 'feature_name' => 'Nhắc lịch tái khám chủ động', 'silver' => 'checked', 'gold' => 'checked', 'platinum' => 'checked', 'diamond' => 'checked'],
            ['type' => 'feature_row', 'feature_name' => 'Chăm sóc 1:1 & bác sĩ tư vấn riêng', 'silver' => 'unchecked', 'gold' => 'unchecked', 'platinum' => 'unchecked', 'diamond' => 'checked'],
            ['type' => 'group_header', 'group_title' => 'Tích điểm & gia đình'],
            ['type' => 'feature_row', 'feature_name' => 'Tích điểm trên tổng viện phí', 'silver' => '2%', 'gold' => '3%', 'platinum' => '4%', 'diamond' => '5%'],
            ['type' => 'feature_row', 'feature_name' => 'Giảm 25% phí nâng hạng thẻ', 'silver' => 'checked', 'gold' => 'checked', 'platinum' => 'unchecked', 'diamond' => 'unchecked'],
            ['type' => 'feature_row', 'feature_name' => 'Áp dụng cho thành viên gia đình', 'silver' => '', 'gold' => '', 'platinum' => '+1 thành viên', 'diamond' => '+3 thành viên'],
        ];
    }

    ob_start();
    ?>
    <h2 style="text-align:center; margin:2.5rem 0 1.5rem; font-size:1.6rem; color:#004870; text-transform:uppercase; font-family:'Be Vietnam Pro',sans-serif; font-weight:800;">BẢNG SO SÁNH CÁC HẠNG THẺ</h2>
    <div class="compare-container">
      <table class="compare-table">
        <thead>
          <tr>
            <th class="col-title-header">Quyền lợi</th>
            <th class="col-header silver-cell"><div class="col-header__icon"><svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto 0.2rem"><path d="M14 10L10 22L20 18L30 22L26 10" fill="#7B8FE4"/><path d="M18 10L16 20L20 18L24 20L22 10" fill="#5066D6"/><circle cx="20" cy="22" r="10" fill="url(#sg)" stroke="#B0BAC9" stroke-width="1.5"/><circle cx="20" cy="12" r="2" fill="#B0BAC9"/><text x="20" y="26" font-family="sans-serif" font-size="11" font-weight="900" fill="#4A5568" text-anchor="middle">2</text><defs><linearGradient id="sg" x1="12" y1="14" x2="28" y2="30" gradientUnits="userSpaceOnUse"><stop stop-color="#FFFFFF"/><stop offset="0.5" stop-color="#E2E8F0"/><stop offset="1" stop-color="#CBD5E0"/></linearGradient></defs></svg></div><div class="col-header__name">Thẻ Bạc</div></th>
            <th class="col-header gold-cell"><div class="col-header__icon"><svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto 0.2rem"><path d="M14 10L10 22L20 18L30 22L26 10" fill="#F6AD55"/><path d="M18 10L16 20L20 18L24 20L22 10" fill="#DD6B20"/><circle cx="20" cy="22" r="10" fill="url(#gg)" stroke="#ECC94B" stroke-width="1.5"/><circle cx="20" cy="12" r="2" fill="#ECC94B"/><text x="20" y="26" font-family="sans-serif" font-size="11" font-weight="900" fill="#975A16" text-anchor="middle">1</text><defs><linearGradient id="gg" x1="12" y1="14" x2="28" y2="30" gradientUnits="userSpaceOnUse"><stop stop-color="#FFFDF5"/><stop offset="0.5" stop-color="#F6E05E"/><stop offset="1" stop-color="#d4af37"/></linearGradient></defs></svg></div><div class="col-header__name">Thẻ Vàng</div></th>
            <th class="col-header platinum-cell"><div class="col-header__icon"><svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:0 auto 0.2rem"><path d="M20 6L32 15L20 34L8 15L20 6Z" fill="url(#pg)"/><path d="M20 6L26 15H14L20 6Z" fill="#63B3ED"/><path d="M8 15H14L20 34L8 15Z" fill="#3182CE"/><path d="M32 15H26L20 34L32 15Z" fill="#2B6CB0"/><path d="M14 15L20 34L26 15H14Z" fill="#4299E1"/><defs><linearGradient id="pg" x1="8" y1="6" x2="32" y2="34" gradientUnits="userSpaceOnUse"><stop stop-color="#EBF8FF"/><stop offset="0.5" stop-color="#90CDF4"/><stop offset="1" stop-color="#3182CE"/></linearGradient></defs></svg></div><div class="col-header__name">Thẻ Bạch Kim</div></th>
            <th class="col-header diamond-cell"><div class="col-header__icon" style="font-size:1.4rem;line-height:1;margin-bottom:0.2rem">&#128081;</div><div class="col-header__name">Thẻ Kim Cương</div></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comp_rows as $row) : ?>
            <?php if ( in_array($row['type'], ['group_header', 'Group Header']) ) : ?>
              <tr class="group-header"><td colspan="5"><span><?php echo esc_html($row['group_title']); ?></span></td></tr>
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
          <tr>
            <td></td>
            <td class="cell-value silver-cell" style="padding:1rem 0.5rem"><a href="#dang-ky" class="btn-register">Đăng ký ngay</a></td>
            <td class="cell-value gold-cell" style="padding:1rem 0.5rem"><a href="#dang-ky" class="btn-register">Đăng ký ngay</a></td>
            <td class="cell-value platinum-cell" style="padding:1rem 0.5rem"><a href="#dang-ky" class="btn-register">Đăng ký ngay</a></td>
            <td class="cell-value diamond-cell" style="padding:1rem 0.5rem"><a href="#dang-ky" class="btn-register">Đăng ký ngay</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_comparison_table', 'cih_shortcode_comparison_table' );


// -------------------------------------------------------
// 4. QUY TẮC TÍCH ĐIỂM — [cih_membership_rules]
// -------------------------------------------------------
function cih_shortcode_membership_rules( $atts ) {
    $rules_left  = function_exists('get_field') ? get_field('rules_left')  : '';
    $rules_right = function_exists('get_field') ? get_field('rules_right') : '';

    if ( empty($rules_left) ) $rules_left = '<div class="rules-section-title">Quy tắc quy đổi</div><ul class="rules-item-list"><li>100 điểm = 1.000 đồng.</li><li>Dùng thanh toán lần sử dụng dịch vụ tiếp theo.</li><li>Mỗi lần chỉ được dùng tối đa 30% giá trị hóa đơn.</li></ul>';
    if ( empty($rules_right) ) $rules_right = '<div class="rules-section-title">Hiệu lực điểm</div><ul class="rules-item-list"><li>12 tháng kể từ ngày tích.</li><li>Hết hiệu lực sau 30 ngày khi thẻ hết hạn.</li><li>Không chuyển nhượng.</li></ul>';

    ob_start();
    ?>
    <div class="rules-table-container" style="margin-top:2rem">
      <table class="rules-table">
        <tbody>
          <tr>
            <td colspan="2" style="width:50%"><?php echo wp_kses_post($rules_left); ?></td>
            <td colspan="2" style="width:50%"><?php echo wp_kses_post($rules_right); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_membership_rules', 'cih_shortcode_membership_rules' );


// -------------------------------------------------------
// 5. ĐIỀU KHOẢN — [cih_membership_terms]
// -------------------------------------------------------
function cih_shortcode_membership_terms( $atts ) {
    $terms = function_exists('get_field') ? get_field('membership_terms') : '';
    if ( empty($terms) ) $terms = '<ul style="margin:0;padding-left:1.5rem;line-height:1.8;list-style-type:disc;text-align:justify"><li>Ưu đãi chỉ áp dụng trên chi phí bệnh nhân tự chi trả - không bao gồm phần bảo hiểm, chi phí bác sĩ phẫu thuật, bác sĩ điều trị, thuốc, vật tư tiêu hao.</li><li>Mỗi dịch vụ chỉ được hưởng một ưu đãi cao nhất - không được gộp nhiều ưu đãi cùng lúc.</li><li>Không áp dụng cho gói sinh, gói IVF, gói vắc xin, phòng VIP.</li><li>Điểm tích lũy có hiệu lực 12 tháng. Điểm chỉ dùng tối đa 30% hóa đơn mỗi lần.</li></ul>';

    ob_start();
    ?>
    <div class="faq-container" style="margin-top:0.75rem">
      <div class="faq-item">
        <button class="faq-trigger" onclick="toggleFaq(this)" style="background:#f0f4f8;border-radius:8px">
          <span style="font-weight:600;color:#004870">Điều khoản</span>
          <span class="faq-chevron">&#9660;</span>
        </button>
        <div class="faq-content"><div class="faq-inner-text"><?php echo wp_kses_post($terms); ?></div></div>
      </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_membership_terms', 'cih_shortcode_membership_terms' );


// -------------------------------------------------------
// 6. CÂU HỎI THƯỜNG GẶP — [cih_membership_faq]
// -------------------------------------------------------
function cih_shortcode_membership_faq( $atts ) {
    $faqs = [];
    if ( function_exists('have_rows') && have_rows('faq_list') ) {
        while ( have_rows('faq_list') ) {
            the_row();
            $faqs[] = [ 'q' => get_sub_field('faq_question'), 'a' => get_sub_field('faq_answer') ];
        }
    }
    if ( empty($faqs) ) {
        $faqs = [
            ['q'=>'1. Làm thế nào để đăng ký thẻ hội viên City Membership?', 'a'=>'Quý khách có thể đăng ký trên Website http://cih.com.vn hoặc tại quầy thông tin Bệnh viện Quốc tế City.'],
            ['q'=>'2. Thẻ có hiệu lực trong bao lâu?', 'a'=>'Thẻ có hiệu lực 12 tháng kể từ ngày kích hoạt. Trước khi hết hạn, Bệnh viện Quốc tế City sẽ chủ động gửi thông báo để Quý khách gia hạn.'],
            ['q'=>'3. Tôi có thể đăng ký thẻ cho người thân không?', 'a'=>'Có. Đối với hạng Platinum và Diamond, Quý khách có thể đăng ký thêm thành viên gia đình theo quy định của chương trình.'],
        ];
    }

    ob_start();
    ?>
    <div class="faq-container">
      <?php foreach ($faqs as $faq) : ?>
        <div class="faq-item">
          <button class="faq-trigger" onclick="toggleFaq(this)">
            <span><?php echo wp_kses_post($faq['q']); ?></span>
            <span class="faq-chevron">&#9660;</span>
          </button>
          <div class="faq-content"><div class="faq-inner-text"><?php echo wp_kses_post($faq['a']); ?></div></div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_membership_faq', 'cih_shortcode_membership_faq' );


// -------------------------------------------------------
// 7. FORM ĐĂNG KÝ — [cih_membership_form]
// -------------------------------------------------------
function cih_shortcode_membership_form( $atts ) {
    $shortcode = '[forminator_form id="45718"]';
    if ( function_exists('get_field') ) {
        $acf_sc = get_field('shortcode_form');
        if ( ! empty($acf_sc) ) $shortcode = $acf_sc;
    }

    ob_start();
    ?>
    <div id="dang-ky" class="member-register-card" style="scroll-margin-top:80px">
      <h2 class="member-register-title">ĐĂNG KÝ TƯ VẤN</h2>
      <?php echo do_shortcode($shortcode); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cih_membership_form', 'cih_shortcode_membership_form' );


// -------------------------------------------------------
// LOAD CSS & JS cho trang có shortcode membership
// -------------------------------------------------------
function cih_membership_enqueue_if_needed() {
    global $post;
    $shortcodes = ['cih_banner_slider','cih_membership_cards','cih_comparison_table','cih_membership_rules','cih_membership_terms','cih_membership_faq','cih_membership_form'];
    $has_shortcode = false;

    if ( is_a($post, 'WP_Post') ) {
        foreach ($shortcodes as $sc) {
            if ( has_shortcode($post->post_content, $sc) || is_page_template('page-membership.php') ) {
                $has_shortcode = true;
                break;
            }
        }
    }

    if ( $has_shortcode ) {
        $uri = get_stylesheet_directory_uri() . '/cih';
        wp_enqueue_style('cih-membership-style', $uri . '/membership.css', [], '3.3');
        wp_enqueue_style('be-vietnam-pro', 'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap', [], null);
        wp_enqueue_script('cih-membership-script', $uri . '/membership.js', [], '3.3', true);
    }
}
add_action('wp_enqueue_scripts', 'cih_membership_enqueue_if_needed');
