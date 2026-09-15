<footer class="footer" id="kontakt">
    <div class="container">
      <div class="footer-grid">
        <!-- Brand Column -->
        <div class="footer-brand">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
            <img src="<?php echo esc_url(home_url('/logo/VN-02.png?v=20260909_logo')); ?>" alt="Vegan Garden Berlin Logo" style="height: 60px; width: auto; max-width: 220px; object-fit: contain; display: block;">
          </a>
          <p style="margin-bottom: 14px; font-size: 0.85rem; line-height: 1.45; color: #a4aaa5;">100 % vegane vietnamesische Küche.<br>Natürlich. Frisch. Mit Liebe.</p>
          <div class="social-links">
            <?php if ($fb = function_exists('vg_get_option') ? vg_get_option('facebook', 'https://www.facebook.com/vegangarden21') : ''): ?>
              <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <?php endif; ?>
            <?php if ($ig = function_exists('vg_get_option') ? vg_get_option('instagram', 'https://www.instagram.com/vegan.garden.berlin/') : ''): ?>
              <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <?php endif; ?>
            <?php if ($tt = function_exists('vg_get_option') ? vg_get_option('tiktok', 'https://www.tiktok.com/@vegangarden_berlin') : ''): ?>
              <a href="<?php echo esc_url($tt); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
            <?php endif; ?>
            <?php if ($wa = function_exists('vg_get_option') ? vg_get_option('whatsapp', '491624649999') : ''): ?>
              <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $wa)); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Contact Column -->
        <div class="footer-contact">
          <h3 class="footer-col-title">KONTAKT</h3>
          <div class="footer-contact-item">
            <i class="fa-solid fa-location-dot"></i>
            <span><?php echo nl2br(esc_html(function_exists('vg_get_option') ? vg_get_option('address', "Frankfurter Allee 21\n10247 Berlin (Friedrichshain)") : "Frankfurter Allee 21\n10247 Berlin (Friedrichshain)")); ?></span>
          </div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-phone"></i>
            <span>
              <?php
              $p1 = function_exists('vg_get_option') ? vg_get_option('phone_1', '030 2123 7260') : '030 2123 7260';
              $p2 = function_exists('vg_get_option') ? vg_get_option('phone_2', '0162 464 9999') : '0162 464 9999';
              ?>
              <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $p1)); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html($p1); ?></a>
              <?php if (!empty($p2)): ?>
                / <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $p2)); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html($p2); ?></a>
              <?php endif; ?>
            </span>
          </div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-envelope"></i>
            <?php $em = function_exists('vg_get_option') ? vg_get_option('email', 'info@vegan-garden.berlin') : 'info@vegan-garden.berlin'; ?>
            <a href="mailto:<?php echo esc_attr($em); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html($em); ?></a>
          </div>
        </div>

        <!-- Hours Column -->
        <div class="footer-hours">
          <h3 class="footer-col-title">ÖFFNUNGSZEITEN</h3>
          <p><?php echo nl2br(esc_html(function_exists('vg_get_option') ? vg_get_option('hours_open', "Dienstag – Sonntag\n12:00 – 22:00 Uhr") : "Dienstag – Sonntag\n12:00 – 22:00 Uhr")); ?></p>
          <?php if ($h_closed = function_exists('vg_get_option') ? vg_get_option('hours_closed', 'Montag Ruhetag') : ''): ?>
            <p style="margin-top: 10px;"><strong><?php echo esc_html($h_closed); ?></strong></p>
          <?php endif; ?>
          <?php if ($h_kit = function_exists('vg_get_option') ? vg_get_option('hours_kitchen', 'Küche bis 21:30 Uhr') : ''): ?>
            <p style="margin-top: 10px; font-size: 0.82rem; color: #838a84;"><?php echo esc_html($h_kit); ?></p>
          <?php endif; ?>
        </div>

        <!-- Map Location Column -->
        <div class="footer-map">
          <h3 class="footer-col-title">FINDEN SIE UNS</h3>
          <div class="map-card" style="padding: 0; border: none; background: transparent;">
            <?php $map_link = function_exists('vg_get_option') ? vg_get_option('maps_url', 'https://maps.app.goo.gl/St5dH8yWhqsPBheCA') : 'https://maps.app.goo.gl/St5dH8yWhqsPBheCA'; ?>
            <a href="<?php echo esc_url($map_link); ?>" target="_blank" rel="noopener" style="display: block; position: relative; border-radius: 12px; overflow: hidden; height: 140px;" title="Route planen auf Google Maps">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2428.174100523497!2d13.461623976899723!3d52.51402283681423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a84ebd0b4fffff%3A0x868b420084f7bbd8!2sFrankfurter%20Allee%2021%2C%2010247%20Berlin%2C%20Germany!5e0!3m2!1sen!2s!4v1722600000000!5m2!1sen!2s" width="100%" height="100%" style="border:0; border-radius: 12px; pointer-events: none;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div>© 2026 Vegan Garden Berlin – Alle Rechte vorbehalten</div>
                        <div class="footer-legal-links">
          <a href="javascript:void(0)" onclick="openLegalModal('impressum')">Impressum</a>
          <span class="footer-legal-sep">&bull;</span>
          <a href="javascript:void(0)" onclick="openLegalModal('datenschutz')">Datenschutz</a>
          <span class="footer-legal-sep">&bull;</span>
          <a href="javascript:void(0)" onclick="openLegalModal('cookies')">Cookie-Einstellungen</a>
        </div>
      </div>
    </div>
  </footer>
    <!-- MODAL: TABLE RESERVATION (FOODAMIGOS) -->
  <div class="modal-overlay" id="reservationModal">
    <div class="modal-content modal-content--reserve">
      <button class="modal-close" aria-label="Schließen">&times;</button>
      
      <div class="reserve-modal-header">
        <div>
          <h2 class="serif-font" style="color: var(--primary-green-dark); margin: 0 0 4px 0; font-size: 1.35rem;">Tisch reservieren</h2>
          <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Online-Reservierung via Foodamigos &bull; Sofortige Bestätigung</p>
        </div>
        <a href="https://vegangarden.tischreservieren.com" target="_blank" rel="noopener" class="reserve-ext-link">
          <span>In neuem Tab öffnen</span>
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>

      <div class="foodamigos-iframe-wrap">
        <iframe 
          src="https://vegangarden.tischreservieren.com" 
          title="Tisch reservieren über Foodamigos" 
          loading="lazy">
        </iframe>
      </div>
    </div>
  </div>

  <!-- MODAL: SPEISEKARTE (FULL MENU) -->
  <div class="modal-overlay" id="menuModal">
    <div class="modal-content" style="max-width: 800px;">
      <button class="modal-close">&times;</button>
      <h2 class="serif-font" style="color: var(--primary-green-dark); margin-bottom: 8px;">Speisekarte</h2>
      <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 16px;">100 % vegane vietnamesische Spezialitäten.</p>

      <?php $modal_pdf = function_exists('vg_get_option') ? vg_get_option('menu_pdf', home_url('/menu/Druck_Speisekarte_VeganGarden.pdf')) : home_url('/menu/Druck_Speisekarte_VeganGarden.pdf'); ?>
      <a href="<?php echo esc_url($modal_pdf); ?>" target="_blank" class="btn btn-primary" style="margin-bottom: 24px; padding: 10px 20px; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-file-pdf" style="font-size: 1.1rem;"></i>
        <span>SPEISEKARTE PDF HERUNTERLADEN</span>
      </a>

      <div class="menu-tabs">
        <button class="menu-tab active" data-category="highlights">Highlights</button>
        <button class="menu-tab" data-category="vorspeisen">Vorspeisen</button>
        <button class="menu-tab" data-category="hauptspeisen">Hauptspeisen</button>
        <button class="menu-tab" data-category="desserts">Desserts & Drinks</button>
      </div>

      <!-- Category 1: Highlights -->
      <div class="menu-category-content" id="cat-highlights" style="display: block;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Summer Bowl</h4>
            <p>Frische Bowl mit Tofu, Mango, Avocado, edlem Gemüse und Erdnuss-Dressing</p>
          </div>
          <div class="menu-item-price">15,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Pho Bo Chay</h4>
            <p>Aromatische Reisnudelsuppe mit Pilzen, Tofu und frischen Kräutern</p>
          </div>
          <div class="menu-item-price">14,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Frühlingsrollen (Nem Ran)</h4>
            <p>Knusprige Reispapierrollen mit Gemüse, Glasnudeln und hausgemachter Erdnuss-Sauce</p>
          </div>
          <div class="menu-item-price">6,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Mango Sticky Rice</h4>
            <p>Klebreis mit Kokosmilch, frischer Mango und geröstetem Sesam</p>
          </div>
          <div class="menu-item-price">6,50 €</div>
        </div>
      </div>

      <!-- Category 2: Vorspeisen -->
      <div class="menu-category-content" id="cat-vorspeisen" style="display: none;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Sommerrollen (Goi Cuon)</h4>
            <p>Frische Reispapierrollen mit Bio-Tofu, Kräutern, Mango und Erdnuss-Dip</p>
          </div>
          <div class="menu-item-price">6,50 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Edamame mit Meersalz</h4>
            <p>Gedämpfte Sojabohnen mit grobem Meersalz und Chili-Flocken</p>
          </div>
          <div class="menu-item-price">5,20 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Gebratene Veggie Dumplings</h4>
            <p>Gefüllte Teigtaschen mit Pilzen, Gemüse und Sesam-Sojasauce</p>
          </div>
          <div class="menu-item-price">6,90 €</div>
        </div>
      </div>

      <!-- Category 3: Hauptspeisen -->
      <div class="menu-category-content" id="cat-hauptspeisen" style="display: none;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Bun Chay Berlin</h4>
            <p>Laue Reisnudeln mit gegrilltem Tofu, frischem Salat, Erdnüssen und Limetten-Dresssing</p>
          </div>
          <div class="menu-item-price">14,50 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Red Curry Garden</h4>
            <p>Cremiges rotes Kokos-Curry mit Süßkartoffeln, Kürbis, Tofu und Duftreis</p>
          </div>
          <div class="menu-item-price">15,20 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Udon Stir Fry</h4>
            <p>Wok-gebratene Udon-Nudeln mit buntem Marktgemüse und Seitan-Streifen</p>
          </div>
          <div class="menu-item-price">14,90 €</div>
        </div>
      </div>

      <!-- Category 4: Desserts & Drinks -->
      <div class="menu-category-content" id="cat-desserts" style="display: none;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Hausgemachte Matcha Lemonade</h4>
            <p>Frische Matcha-Limonade mit Limette und Minze</p>
          </div>
          <div class="menu-item-price">4,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Vietnamesischer Kokos-Kaffee</h4>
            <p>Espresso auf cremigem Kokos-Eis-Schaum</p>
          </div>
          <div class="menu-item-price">5,20 €</div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL: VIDEO LIGHTBOX -->
  <div class="modal-overlay" id="videoModal">
    <div class="modal-content" style="max-width: 900px; padding: 12px; background: #000000; border-radius: 16px;">
      <button class="modal-close" style="color: #ffffff; top: -40px; right: 0;">&times;</button>
      <div style="aspect-ratio: 16/9; width: 100%; border-radius: 12px; overflow: hidden; position: relative;">
        <video id="gardenVideo" controls poster="<?php echo esc_url(home_url('/images/garden_preview.jpg')); ?>" style="width: 100%; height: 100%; object-fit: cover;">
          <source src="<?php echo esc_url(home_url('/video/garden_tour.mp4')); ?>" type="video/mp4">
          Ihr Browser unterstützt kein HTML5 Video.
        </video>
      </div>
    </div>
  </div>

  <!-- MODAL: REVIEWS LIGHTBOX -->
  <div class="modal-overlay" id="reviewsModal">
    <div class="modal-content">
      <button class="modal-close">&times;</button>
      <h2 class="serif-font" style="color: var(--primary-green-dark); margin-bottom: 8px;">Google Kundenbewertungen</h2>
      <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px;">4.8 von 5 Sternen basierend auf über 520 Google Rezensionen.</p>

      <div style="display: flex; flex-direction: column; gap: 16px;">
        <div style="background: #F6F1E7; padding: 16px; border-radius: 8px; border-left: 3px solid #FBBC04;">
          <div style="color: #FBBC04; font-size: 0.85rem; margin-bottom: 4px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p style="font-size: 0.9rem; color: var(--text-dark);">"Eines der schönsten Restaurants in Berlin. Die Summer Bowl war fantastisch frisch und der Garten ist pure Entspannung!"</p>
          <span style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-top: 6px; display: block;">– Sarah M.</span>
        </div>

        <div style="background: #F6F1E7; padding: 16px; border-radius: 8px; border-left: 3px solid #FBBC04;">
          <div style="color: #FBBC04; font-size: 0.85rem; margin-bottom: 4px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p style="font-size: 0.9rem; color: var(--text-dark);">"Super freundlicher Service, authentische vegane vietnamesische Aromen und ein wunderbarer Außenbereich."</p>
          <span style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-top: 6px; display: block;">– David K.</span>
        </div>
      </div>
    </div>
  </div>

  
  <?php wp_footer(); ?>
</body>
</html>
