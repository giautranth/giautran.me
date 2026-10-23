<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-KHCWLLSR');</script>
  <!-- End Google Tag Manager -->

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y8EYRNLCSN"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-Y8EYRNLCSN');
  </script>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="2lv5OUVvX3xHJVH3WoMKsIfYC4AMEb2kK1jQmc_U7w0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(home_url('/favicon-32x32.png?v=20260923_circle')); ?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url(home_url('/favicon-192x192.png?v=20260923_circle')); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(home_url('/apple-touch-icon.png?v=20260923_circle')); ?>">
  <link rel="shortcut icon" href="<?php echo esc_url(home_url('/favicon.ico?v=20260923_circle')); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <style>
    .mobile-only-nav-item { display: none !important; }
    @media (max-width: 768px) {
      .mobile-only-nav-item { display: block !important; }
    }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KHCWLLSR"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- HEADER & NAVIGATION -->
  <header class="navbar">
    <div class="container navbar-inner">
      <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
      </button>

      <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo">
        <img src="<?php echo esc_url(home_url('/logo/VN-03.png?v=20260909_padded')); ?>" alt="Vegan Garden Berlin Logo" style="height: 46px; width: auto; max-width: 170px; border-radius: 8px; object-fit: contain; box-shadow: 0 2px 8px rgba(42, 22, 15, 0.18); border: 1px solid rgba(169, 130, 36, 0.28); display: block;">
      </a>

      <nav>
        <ul class="nav-menu" id="navMenu">
          <li><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">HOME</a></li>
          <li><a href="<?php echo esc_url(home_url('/#speisekarte')); ?>" class="nav-link">SPEISEKARTE</a></li>
          <li><a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link <?php echo is_page('about') ? 'active' : ''; ?>">ÜBER UNS</a></li>
          <li><a href="<?php echo esc_url(home_url('/ratgeber/')); ?>" class="nav-link <?php echo is_page('ratgeber') ? 'active' : ''; ?>">JOURNAL</a></li>
          <li><a href="<?php echo esc_url(home_url('/kontakt/')); ?>" class="nav-link <?php echo is_page('kontakt') ? 'active' : ''; ?>">KONTAKT</a></li>
          <li class="mobile-only-nav-item"><a href="<?php echo esc_url(home_url('/impressum/')); ?>" class="nav-link <?php echo is_page('impressum') ? 'active' : ''; ?>">IMPRESSUM</a></li>
        </ul>
      </nav>

      <div class="nav-actions">
        <!-- Desktop Reservation Button -->
        <button class="btn btn-primary desktop-reserve-btn js-open-reserve">
          <i class="fa-regular fa-calendar-check"></i>
          <span>TISCH RESERVIEREN</span>
        </button>

        <!-- Flag Language Box -->
        <div class="lang-box" id="langBox">
          <button class="lang-current" id="langCurrent" aria-haspopup="true" aria-expanded="false" aria-label="Sprache wählen">
            <span class="lang-flag"><img src="https://flagcdn.com/w20/de.png" alt="de" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
            <svg class="lang-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="12"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <ul class="lang-dropdown" id="langDropdown" role="listbox">
            <li class="lang-opt active" data-lang="de" data-flag="de" data-code="DE" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/de.png" alt="de" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng" style="text-transform: capitalize;">Deutsch</span>
            </li>
            <li class="lang-opt" data-lang="en" data-flag="us" data-code="EN" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/us.png" alt="us" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng" style="text-transform: capitalize;">English</span>
            </li>
            <li class="lang-opt" data-lang="vi" data-flag="vn" data-code="VI" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/vn.png" alt="vn" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng" style="text-transform: capitalize;">Tiếng Việt</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
