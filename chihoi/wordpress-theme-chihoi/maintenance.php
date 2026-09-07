<?php
/**
 * Maintenance / Under Construction Template
 * Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh, thành phía Nam
 */
if (!defined('ABSPATH')) exit;

$options = get_option('chihoi_theme_options', array());
$title = !empty($options['maintenance_title']) ? $options['maintenance_title'] : 'WEBSITE ĐANG TRONG QUÁ TRÌNH XÂY DỰNG';
$desc = !empty($options['maintenance_desc']) ? $options['maintenance_desc'] : "Website của Chi hội Bệnh viện Tư nhân TP. HCM và các tỉnh, thành phía Nam đang được hoàn thiện và sẽ sớm chính thức đi vào hoạt động.\n\nTrân trọng cảm ơn.";
$logo = chihoi_get_option('header_logo', get_template_directory_uri() . '/photo/logo/chihoi_2.png');
$hotline = chihoi_get_option('footer_phone', '1900 8146');
$email = chihoi_get_option('footer_email', 'info@chihoibenhvien.com');
$address = chihoi_get_option('footer_address', 'Số 5 Đường 17A, P. An Lạc, TP. HCM');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo esc_html($title); ?> - Chi hội Bệnh viện Tư nhân TP.HCM</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="icon" type="image/png" sizes="48x48" href="/favicon-48x48.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: #f1f5f9;
      color: #1e293b;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow-x: hidden;
    }
    
    /* Background Medical Graphics */
    .bg-canvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle at 50% 20%, rgba(39, 170, 225, 0.08) 0%, rgba(44, 54, 145, 0.03) 70%, transparent 100%);
      pointer-events: none;
      z-index: 0;
    }
    .medical-cross-pattern {
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: radial-gradient(#cbd5e1 1.2px, transparent 1.2px);
      background-size: 32px 32px;
      opacity: 0.45;
      pointer-events: none;
      z-index: 0;
    }

    /* Main Container */
    .construction-wrapper {
      position: relative;
      z-index: 1;
      max-width: 820px;
      margin: auto;
      padding: 40px 24px;
      text-align: center;
    }

    /* Card */
    .construction-card {
      background: #ffffff;
      border-radius: 24px;
      padding: 50px 40px;
      box-shadow: 0 20px 40px -15px rgba(44, 54, 145, 0.08), 0 0 0 1px rgba(226, 232, 240, 0.8);
      position: relative;
      overflow: hidden;
    }
    .construction-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, #2C3691 0%, #27AAE1 50%, #e22b27 100%);
    }

    /* Logo */
    .brand-logo-wrap {
      margin-bottom: 28px;
    }
    .brand-logo-img {
      max-height: 70px;
      width: auto;
      object-fit: contain;
    }

    /* Heading */
    .main-title {
      font-size: 1.85rem;
      font-weight: 800;
      color: #1e3a8a;
      line-height: 1.35;
      margin-bottom: 20px;
      letter-spacing: -0.5px;
    }

    /* Description */
    .main-desc {
      font-size: 1.08rem;
      color: #475569;
      line-height: 1.75;
      margin-bottom: 36px;
      max-width: 680px;
      margin-left: auto;
      margin-right: auto;
      white-space: pre-line;
    }

    /* Contact Info Bar */
    .contact-bar {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding-top: 28px;
      border-top: 1px solid #e2e8f0;
    }
    .contact-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.92rem;
      color: #334155;
      font-weight: 600;
      background: #f8fafc;
      padding: 10px 18px;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .contact-item:hover {
      background: #eff6ff;
      border-color: #bfdbfe;
      color: #1d4ed8;
      transform: translateY(-2px);
    }
    .contact-item svg {
      color: #27AAE1;
      flex-shrink: 0;
    }

    /* Responsive */
    @media (max-width: 640px) {
      .construction-card {
        padding: 36px 20px;
      }
      .main-title {
        font-size: 1.45rem;
      }
      .main-desc {
        font-size: 0.98rem;
      }
      .contact-bar {
        flex-direction: column;
        gap: 10px;
      }
      .contact-item {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>
<body>

  <div class="bg-canvas"></div>
  <div class="medical-cross-pattern"></div>

  <div class="construction-wrapper">
    <div class="construction-card">
      
      <!-- Logo -->
      <div class="brand-logo-wrap">
        <img src="<?php echo esc_url($logo); ?>" alt="Chi hội Bệnh viện Tư nhân TP.HCM" class="brand-logo-img" />
      </div>

      

      <!-- Title -->
      <h1 class="main-title"><?php echo esc_html($title); ?></h1>

      <!-- Description -->
      <div class="main-desc"><?php echo nl2br(esc_html($desc)); ?></div>

      <!-- Contact Bar -->
      <div class="contact-bar">
        
        <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-item">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          <span>Email: <?php echo esc_html($email); ?></span>
        </a>
        <div class="contact-item">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <span>Văn phòng: <?php echo esc_html($address); ?></span>
        </div>
      </div>

    </div>
  </div>

  

</body>
</html>
