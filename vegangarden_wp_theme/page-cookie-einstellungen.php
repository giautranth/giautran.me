<?php
/**
 * Template Name: Cookie-Einstellungen
 */
get_header();
?>

<style>
  .legal-page-wrap {
    background-color: #F6F1E7;
    color: #211A16;
  }
  .legal-hero {
    background: linear-gradient(135deg, #2A160F 0%, #3d2319 100%);
    color: #ffffff;
    padding: 50px 0 40px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .legal-breadcrumbs {
    font-size: 0.88rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 14px;
  }
  .legal-breadcrumbs a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .legal-breadcrumbs a:hover {
    color: #34A853;
  }
  .legal-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.6rem;
    color: #ffffff;
    letter-spacing: 0.04em;
    margin: 0;
  }
  .legal-main {
    padding: 50px 0 70px;
    background-color: #F6F1E7;
  }
  .legal-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 44px 40px;
    box-shadow: 0 4px 24px rgba(42, 22, 15, 0.06);
    max-width: 900px;
    margin: 0 auto;
    line-height: 1.7;
  }
  .legal-card p, .cookie-category p {
    text-align: justify !important;
    text-justify: inter-word !important;
    hyphens: auto;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
  }
  .cookie-category {
    background: #FAF7F2;
    border: 1px solid rgba(42, 22, 15, 0.08);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 20px;
    transition: border-color 0.2s ease;
  }
  .cookie-category:hover {
    border-color: #34A853;
  }
  .cookie-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }
  .cookie-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #2A160F;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .cookie-switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 26px;
  }
  .cookie-switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .3s;
    border-radius: 26px;
  }
  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
  }
  input:checked + .slider {
    background-color: #34A853;
  }
  input:checked + .slider:before {
    transform: translateX(22px);
  }
  input:disabled + .slider {
    background-color: #34A853;
    opacity: 0.7;
    cursor: not-allowed;
  }
  .cookie-status-badge {
    font-size: 0.8rem;
    font-weight: 600;
    background: #e8f5e9;
    color: #2e7d32;
    padding: 4px 10px;
    border-radius: 20px;
  }
  .cookie-actions {
    display: flex;
    gap: 14px;
    justify-content: flex-end;
    margin-top: 30px;
    flex-wrap: wrap;
  }
  #saveNotice {
    display: none;
    background: #e8f5e9;
    color: #1b5e20;
    padding: 14px 20px;
    border-radius: 8px;
    margin-top: 20px;
    font-weight: 600;
    text-align: center;
  }
  @media (max-width: 768px) {
    .legal-card {
      padding: 28px 20px;
      border-radius: 12px;
    }
    .legal-hero-title {
      font-size: 2rem;
    }
  }
</style>

<div class="legal-page-wrap">
  <!-- HERO SECTION -->
  <section class="legal-hero">
    <div class="container">
      <div class="legal-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>">Startseite</a> &nbsp;&bull;&nbsp; <span>Cookie-Einstellungen</span>
      </div>
      <h1 class="legal-hero-title">Cookie-Einstellungen</h1>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="legal-main">
    <div class="container">
      <article class="legal-card">
        
        <p style="font-size: 1rem; margin-bottom: 24px;">
          Wir verwenden Cookies, um die einwandfreie Funktion unserer Website zu gewährleisten (z. B. Sprachauswahl und Reservierungsmodal) und Ihnen das bestmögliche Restauranterlebnis zu bieten. Sie können Ihre Einstellungen jederzeit anpassen.
        </p>

        <!-- Essential Cookies -->
        <div class="cookie-category">
          <div class="cookie-header">
            <div class="cookie-title">
              <i class="fa-solid fa-shield-halved" style="color: #34A853;"></i>
              <span>Technisch notwendige Cookies</span>
            </div>
            <span class="cookie-status-badge">Immer aktiv</span>
          </div>
          <p style="font-size: 0.9rem; color: #554e47; margin: 0;">
            Diese Cookies sind für den grundlegenden Betrieb der Website unerlässlich (z. B. Beibehalten der gewählten Sprache <code>vg_lang</code>, sichere Formularübermittlung und reibungslose Navigation). Sie können nicht deaktiviert werden.
          </p>
        </div>

        <!-- Functional / External Media Cookies -->
        <div class="cookie-category">
          <div class="cookie-header">
            <div class="cookie-title">
              <i class="fa-solid fa-map-location-dot" style="color: #34A853;"></i>
              <span>Externe Medien &amp; Google Maps</span>
            </div>
            <label class="cookie-switch">
              <input type="checkbox" id="cookieFunctional" checked>
              <span class="slider"></span>
            </label>
          </div>
          <p style="font-size: 0.9rem; color: #554e47; margin: 0;">
            Ermöglicht das direkte Laden und die interaktive Nutzung externer Medien, insbesondere der interaktiven <strong>Google Maps</strong> Anfahrtskarte.
          </p>
        </div>

        <!-- Analytics Cookies -->
        <div class="cookie-category">
          <div class="cookie-header">
            <div class="cookie-title">
              <i class="fa-solid fa-chart-line" style="color: #34A853;"></i>
              <span>Anonyme Webanalyse</span>
            </div>
            <label class="cookie-switch">
              <input type="checkbox" id="cookieAnalytics">
              <span class="slider"></span>
            </label>
          </div>
          <p style="font-size: 0.9rem; color: #554e47; margin: 0;">
            Hilft uns zu verstehen, welche Speisen und Ratgeber-Themen für unsere Gäste am interessantesten sind, um unser Angebot stetig zu verbessern. Es werden keine personenbezogenen Profile erstellt.
          </p>
        </div>

        <div id="saveNotice">
          <i class="fa-solid fa-circle-check"></i> Ihre Cookie-Einstellungen wurden erfolgreich gespeichert!
        </div>

        <div class="cookie-actions">
          <button type="button" class="btn btn-outline" style="border: 1px solid #c79a4a; color: #2A160F; padding: 10px 22px; border-radius: 50px; font-weight: 600; cursor: pointer; background: transparent;" onclick="saveCookieChoice(false)">
            Nur essenzielle akzeptieren
          </button>
          <button type="button" class="btn btn-primary" style="padding: 10px 26px; border-radius: 50px; font-weight: 700; cursor: pointer;" onclick="saveCookieChoice(true)">
            Alle akzeptieren &amp; Speichern
          </button>
        </div>

      </article>
    </div>
  </main>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    try {
      var saved = JSON.parse(localStorage.getItem('vg_cookie_consent'));
      if (saved) {
        if (typeof saved.functional !== 'undefined') {
          var funcInput = document.getElementById('cookieFunctional');
          if (funcInput) funcInput.checked = !!saved.functional;
        }
        if (typeof saved.analytics !== 'undefined') {
          var anaInput = document.getElementById('cookieAnalytics');
          if (anaInput) anaInput.checked = !!saved.analytics;
        }
      }
    } catch (e) {}
  });

  function saveCookieChoice(all) {
    if (all) {
      var f = document.getElementById('cookieFunctional');
      var a = document.getElementById('cookieAnalytics');
      if (f) f.checked = true;
      if (a) a.checked = true;
    }
    var consent = {
      essential: true,
      functional: document.getElementById('cookieFunctional') ? document.getElementById('cookieFunctional').checked : false,
      analytics: document.getElementById('cookieAnalytics') ? document.getElementById('cookieAnalytics').checked : false,
      timestamp: new Date().toISOString()
    };
    localStorage.setItem('vg_cookie_consent', JSON.stringify(consent));
    var banner = document.getElementById('vgCookieBanner');
    if (banner) banner.style.display = 'none';
    var notice = document.getElementById('saveNotice');
    if (notice) {
      notice.style.display = 'block';
      setTimeout(function() {
        notice.style.display = 'none';
      }, 4000);
    }
    if (consent.functional && typeof vgLoadGoogleMap === 'function') {
      vgLoadGoogleMap(false);
    }
  }
</script>

<?php
get_footer();
