<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

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
              <span class="lng">Deutsch</span>
            </li>
            <li class="lang-opt" data-lang="en" data-flag="us" data-code="EN" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/us.png" alt="us" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng">English</span>
            </li>
            <li class="lang-opt" data-lang="vi" data-flag="vn" data-code="VI" role="option">
              <span class="flag"><img src="https://flagcdn.com/w20/vn.png" alt="vn" width="20" style="vertical-align: middle; border-radius: 2px;" /></span>
              <span class="lng">Tiếng Việt</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
