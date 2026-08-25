<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ========== UNIFIED AIH & FV HEADER ========== -->
  <header class="aih-header" role="banner">
    <div class="aih-header-container">
      
      <!-- Brand & Accreditation Seal -->
      <div class="aih-brand-group">
        <a href="<?php echo esc_url(home_url('/')); ?>" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
          <img src="<?php echo get_template_directory_uri(); ?>/photo/logo/chihoi.png" alt="Logo Chi hội" class="aih-logo-img" />
          <div class="aih-gold-badge">
            <svg width="44" height="44" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="24" cy="24" r="22" fill="url(#seal-gold-grad)" stroke="#27AAE1" stroke-width="1.5"/>
              <circle cx="24" cy="24" r="18" fill="none" stroke="#2C3691" stroke-width="1" stroke-dasharray="2 2"/>
              <path d="M24 8L27.5 17.5H37.5L29.5 23.5L32.5 33L24 27.5L15.5 33L18.5 23.5L10.5 17.5H20.5L24 8Z" fill="#2C3691"/>
              <defs>
                <linearGradient id="seal-gold-grad" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#FFFDF0"/>
                  <stop offset="0.5" stop-color="#FEF08A"/>
                  <stop offset="1" stop-color="#F59E0B"/>
                </linearGradient>
              </defs>
            </svg>
          </div>
        </a>
      </div>

      <!-- Navigation -->
      <nav class="aih-nav" aria-label="Menu chính">
        <ul class="aih-menu-list">
          <li class="aih-menu-item <?php echo is_front_page() ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="aih-menu-link">TRANG CHỦ</a>
          </li>
          <li class="aih-menu-item has-dropdown <?php echo is_page(array('gioi-thieu', 'so-do-to-chuc')) ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>" class="aih-menu-link">
              GIỚI THIỆU
              <span class="arrow-icon">▼</span>
            </a>
            <ul class="dropdown-menu-list">
              <li class="dropdown-item"><a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>">Về Chi Hội</a></li>
              <li class="dropdown-item"><a href="<?php echo esc_url(home_url('/so-do-to-chuc/')); ?>">Sơ Đồ Cơ Cấu Tổ Chức</a></li>
            </ul>
          </li>
          <li class="aih-menu-item <?php echo is_page('hoi-vien') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/hoi-vien/')); ?>" class="aih-menu-link">HỘI VIÊN</a>
          </li>
          <li class="aih-menu-item <?php echo is_page('dao-tao') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="aih-menu-link">ĐÀO TẠO</a>
          </li>
          <li class="aih-menu-item <?php echo is_page('tin-tuc') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="aih-menu-link">TIN TỨC</a>
          </li>
          <li class="aih-menu-item <?php echo is_page('lien-he') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="aih-menu-link">LIÊN HỆ</a>
          </li>
        </ul>
      </nav>

      <!-- Utilities Tools -->
      <div class="aih-header-tools">
        <a href="tel:19008146" class="aih-header-hotline-btn" title="Tổng đài hỗ trợ Chi hội 24/7">
          <span class="hotline-pulse-dot"></span>
          <span>1900 8146</span>
        </a>
        <button class="aih-search-btn" title="Tìm kiếm" onclick="alert('Tính năng tìm kiếm dữ liệu Chi hội y tế');">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </button>
        <div class="aih-lang-picker">
          <span class="aih-flag-icon">🇻🇳</span>
          <select class="aih-lang-select" aria-label="Chọn Ngôn ngữ">
            <option value="vi">Tiếng Việt</option>
            <option value="en">English</option>
          </select>
        </div>
      </div>

    </div>
  </header>
