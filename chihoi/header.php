<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicon & Touch Icons (Chuẩn Google Search & Di động) -->
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="48x48" href="/favicon-48x48.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="shortcut icon" href="/favicon.ico">

  <?php
  $social_img = chihoi_get_option('social_img', home_url('/photo/og-image.jpg'));
  $social_title = chihoi_get_option('seo_title', 'Chi hội Bệnh viện Tư nhân TP. HCM và các tỉnh, thành phía Nam');
  $social_desc = chihoi_get_option('seo_desc', 'Cổng thông tin chính thức của Chi hội Bệnh viện Tư nhân TP. HCM và các tỉnh, thành phía Nam.');
  ?>
  <!-- Open Graph & Social Preview (Zalo, Facebook, Messenger, Telegram) -->
  <meta property="og:image" content="<?php echo esc_url($social_img); ?>">
  <meta property="og:image:secure_url" content="<?php echo esc_url($social_img); ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="<?php echo esc_attr($social_title); ?>">
  <meta name="twitter:image" content="<?php echo esc_url($social_img); ?>">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-PDXGQRK8');</script>
  <!-- End Google Tag Manager -->

  <!-- Google tag (gtag.js) - Google Analytics 4 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-394HNWYNZN"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-394HNWYNZN');
  </script>
  <!-- Schema.org Medical Organization JSON-LD -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "MedicalOrganization",
    "name": "Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam",
    "alternateName": "Chi hội Bệnh viện Tư nhân TP.HCM",
    "url": "https://chihoibenhvien.com/",
    "logo": "https://chihoibenhvien.com/photo/logo/chihoi_2.png",
    "telephone": "1900 8146",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Số 3 Đường 17A, Khu Y tế Kỹ thuật cao, Phường An Lạc",
      "addressLocality": "Quận Bình Tân",
      "addressRegion": "Thành phố Hồ Chí Minh",
      "addressCountry": "VN"
    },
    "parentOrganization": {
      "@type": "Organization",
      "name": "Hiệp hội Bệnh viện Tư nhân Việt Nam"
    }
  }
  </script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDXGQRK8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <!-- ========== UNIFIED AIH & FV HEADER ========== -->
  <header class="aih-header" role="banner">
    <div class="aih-header-container">
      
      <!-- Mobile Nav Toggle (Left on Mobile) -->
      <button class="mobile-nav-toggle" id="mobileNavToggle" aria-label="Mở menu">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
      
      <!-- Brand Logo & Gold Accreditation Seal -->
      <div class="aih-brand-group">
        <a href="<?php echo esc_url(home_url('/')); ?>" style="display:flex;align-items:center;text-decoration:none;">
          <img src="<?php echo esc_url(chihoi_get_option('header_logo', get_template_directory_uri() . '/photo/logo/chihoi_2.png')); ?>" alt="Logo Chi hội Bệnh viện Tư nhân" class="aih-logo-img" />
        </a>
      </div>

      <!-- Main Navigation Menu -->
      <nav class="aih-nav" aria-label="Menu chính">
        <ul class="aih-menu-list" id="navMenuList">
          <li class="aih-menu-item <?php echo is_front_page() ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="aih-menu-link <?php echo is_front_page() ? 'active' : ''; ?>">TRANG CHỦ</a>
          </li>
          <li class="aih-menu-item has-dropdown <?php echo is_page(array('ve-chi-hoi', 'ban-chap-hanh', 'gioi-thieu')) ? 'active' : ''; ?>">
            <a href="javascript:void(0)" class="aih-menu-link">GIỚI THIỆU</a>
            <ul class="dropdown-menu-list">
              <li class="dropdown-item"><a href="<?php echo esc_url(home_url('/ve-chi-hoi/')); ?>">VỀ CHI HỘI</a></li>
              <li class="dropdown-item"><a href="<?php echo esc_url(home_url('/ban-chap-hanh/')); ?>">BAN CHẤP HÀNH</a></li>
            </ul>
          </li>
          <li class="aih-menu-item <?php echo is_page('hoi-vien') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/hoi-vien/')); ?>" class="aih-menu-link">HỘI VIÊN</a>
          </li>
          <li class="aih-menu-item <?php echo is_page('dao-tao') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="aih-menu-link">CHƯƠNG TRÌNH ĐÀO TẠO</a>
          </li>
          <li class="aih-menu-item <?php echo is_page('tin-tuc') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="aih-menu-link">TIN TỨC</a>
          </li>
          <li class="aih-menu-item <?php echo is_page('lien-he') ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="aih-menu-link">LIÊN HỆ</a>
          </li>
          <li class="aih-menu-item aih-search-menu-item">
            <button class="aih-search-btn" title="Tìm kiếm" onclick="openSiteSearch();" aria-label="Tìm kiếm">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
          </li>
        </ul>
      </nav>

      <!-- Utilities Tools (Search & Language Switcher) -->
      <div class="aih-header-tools">
        <div class="lang-box" id="langBox">
          <button class="lang-current" id="langCurrent" aria-haspopup="true" aria-expanded="false" aria-label="Chọn ngôn ngữ">
            <span class="lang-flag"><img src="https://flagcdn.com/w20/vn.png" alt="vn" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
            <svg class="lang-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="12" height="12"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <ul class="lang-dropdown" id="langDropdown" role="listbox">
            <li class="lang-opt active" data-lang="vi" data-flag="vn" data-code="VI" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/vn.png" alt="vn" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng">Tiếng Việt</span>
            </li>
            <li class="lang-opt" data-lang="en" data-flag="us" data-code="EN" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/us.png" alt="us" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng">English</span>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </header>
