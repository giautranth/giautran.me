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
          <a href="<?php echo esc_url(home_url('/impressum.html')); ?>" target="_blank">Impressum</a>
          <span class="footer-legal-sep">&bull;</span>
          <a href="<?php echo esc_url(home_url('/datenschutz.html')); ?>" target="_blank">Datenschutz</a>
          <span class="footer-legal-sep">&bull;</span>
          <a href="<?php echo esc_url(home_url('/cookie-einstellungen.html')); ?>" target="_blank">Cookie-Einstellungen</a>
        </div>
      </div>
    </div>
  </footer>
    <!-- MODAL: TABLE RESERVATION -->
  <div class="modal-overlay" id="reservationModal">
    <div class="modal-content modal-content--reserve">
      <button class="modal-close" aria-label="Schließen">&times;</button>
      
      <div class="reserve-modal-header" style="margin-bottom: 6px; padding-right: 28px;">
        <div>
          <h2 class="serif-font" style="color: var(--primary-green-dark); margin: 0; font-size: 1.25rem;">Tisch reservieren</h2>
        </div>
      </div>

      <form id="reserveForm" style="padding: 4px 0 0;">
        <?php wp_nonce_field('vg_reserve_form', 'vg_reserve_nonce'); ?>
        
        <div style="display: flex; flex-direction: column; gap: 7px;">
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">Name *</label>
            <input type="text" name="res_name" id="resName" required style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; box-sizing:border-box; line-height:1.2;">
          </div>
          
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">Datum *</label>
            <input type="date" name="res_date" id="resDate" required style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; box-sizing:border-box; line-height:1.2;">
          </div>
          
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">Uhrzeit *</label>
            <input type="time" name="res_time" id="resTime" required value="18:30" min="12:00" max="22:00" style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; box-sizing:border-box; line-height:1.2;">
          </div>
          
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">Personen *</label>
            <select name="res_guests" id="resGuests" required style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; box-sizing:border-box; line-height:1.2;">
              <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo $i === 2 ? 'selected' : ''; ?>><?php echo $i; ?> <?php echo $i === 1 ? 'Person' : 'Personen'; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">Telefon *</label>
            <input type="tel" name="res_phone" id="resPhone" required style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; box-sizing:border-box; line-height:1.2;">
          </div>
          
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">E-Mail <span style="color:#999; font-weight:400;">(optional)</span></label>
            <input type="email" name="res_email" id="resEmail" style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; box-sizing:border-box; line-height:1.2;">
          </div>
          
          <div>
            <label style="font-weight:600; font-size:0.8rem; color:#2A160F; display:block; margin-bottom:2px;">Anmerkung <span style="color:#999; font-weight:400;">(optional)</span></label>
            <textarea name="res_note" id="resNote" rows="1" style="width:100%; padding:6px 10px; border:1px solid #d4d0cb; border-radius:6px; font-size:15px; background:#faf9f7; resize:vertical; box-sizing:border-box; min-height:38px; height:38px; line-height:1.2;"></textarea>
          </div>
        </div>

        <div id="reserveStatus" style="margin-top:8px; padding:8px 12px; border-radius:6px; display:none; font-size:0.85rem;"></div>

        <button type="submit" id="reserveSubmitBtn" class="btn btn-primary" style="width:100%; margin-top:10px; padding:10px 14px; font-size:0.95rem; font-weight:700; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:8px;">
          <i class="fa-regular fa-calendar-check"></i>
          <span>JETZT RESERVIEREN</span>
        </button>
      </form>

      <script>
      (function(){
        const form = document.getElementById('reserveForm');
        if (!form) return;
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const statusDiv = document.getElementById('reserveStatus');
          const submitBtn = document.getElementById('reserveSubmitBtn');
          
          // Disable button
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Wird gesendet...</span>';
          statusDiv.style.display = 'none';

          const formData = new FormData(form);
          formData.append('action', 'vg_reservation_submit');

          fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
          })
          .then(r => r.json())
          .then(data => {
            statusDiv.style.display = 'block';
            if (data.success) {
              statusDiv.style.background = '#e8f5e9';
              statusDiv.style.color = '#2e7d32';
              statusDiv.style.border = '1px solid #a5d6a7';
              statusDiv.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + data.data;
              form.reset();
              setTimeout(function() {
                document.getElementById('reservationModal').classList.remove('active');
                document.body.style.overflow = '';
                statusDiv.style.display = 'none';
              }, 3000);
            } else {
              statusDiv.style.background = '#fbe9e7';
              statusDiv.style.color = '#c62828';
              statusDiv.style.border = '1px solid #ef9a9a';
              statusDiv.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> ' + data.data;
            }
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-regular fa-calendar-check"></i> <span>JETZT RESERVIEREN</span>';
          })
          .catch(() => {
            statusDiv.style.display = 'block';
            statusDiv.style.background = '#fbe9e7';
            statusDiv.style.color = '#c62828';
            statusDiv.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Netzwerkfehler. Bitte versuchen Sie es erneut.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-regular fa-calendar-check"></i> <span>JETZT RESERVIEREN</span>';
          });
        });
      })();
      </script>
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
            <h4>Vegan Garden Reisnudel-Bowl</h4>
            <p>Reisnudeln mit Bio-Tofu, Mango, Tomaten, Gurken, Erdnüssen, Sesam und Vegan-Garden-Sauce</p>
          </div>
          <div class="menu-item-price">13,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Traditionelle Reisbandnudelsuppe (Phở)</h4>
            <p>Traditionelle vietnamesische Reisbandnudelsuppe mit Kräuterseitlingen, Tofu und frischen Kräutern</p>
          </div>
          <div class="menu-item-price">12,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Knusprige Frühlingsrollen</h4>
            <p>Frittierte Reispapierrollen gefüllt mit Tofu, Gemüse, Mungobohnen, Pilzen und Glasnudeln</p>
          </div>
          <div class="menu-item-price">5,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Gedämpfter Klebreis mit Banane (Chuối Hấp)</h4>
            <p>Gedämpfter Klebreis mit Bananenfüllung, Kokosmilch, Erdnüssen und geröstetem Sesam</p>
          </div>
          <div class="menu-item-price">6,50 €</div>
        </div>
      </div>

      <!-- Category 2: Vorspeisen -->
      <div class="menu-category-content" id="cat-vorspeisen" style="display: none;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Frische Sommerrollen (Gỏi Cuốn)</h4>
            <p>Frische Reispapierrollen mit Bio-Tofu, Kräutern, Mango und Erdnuss-Dip</p>
          </div>
          <div class="menu-item-price">6,50 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Gekochte Edamame</h4>
            <p>Japanische Sojabohnen mit Meersalz</p>
          </div>
          <div class="menu-item-price">5,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Gedämpfte Teigtaschen (Gyoza)</h4>
            <p>Gefüllt mit Gemüse, Pilzen und Tofu, serviert mit Sojasoße</p>
          </div>
          <div class="menu-item-price">5,90 €</div>
        </div>
      </div>

      <!-- Category 3: Hauptspeisen -->
      <div class="menu-category-content" id="cat-hauptspeisen" style="display: none;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Vier Schätze in Chao-Soße</h4>
            <p>Veganer Fisch, Seitan, Tofu, verschiedene Pilze und Gemüse in fermentierter Tofu-Soße</p>
          </div>
          <div class="menu-item-price">13,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Rotes Curry (Cà Ri Đỏ)</h4>
            <p>Cremiges rotes Kokos-Curry mit Süßkartoffeln, Kürbis, Tofu und Duftreis</p>
          </div>
          <div class="menu-item-price">13,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Thailändische Reisnudelsuppe</h4>
            <p>Aromatische thailändische Reisnudelsuppe mit saisonalem Gemüse, Kräutern und Tofu</p>
          </div>
          <div class="menu-item-price">13,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Gebratene Udonnudeln (Udon Xào)</h4>
            <p>Wok-gebratene Udon-Nudeln mit buntem Marktgemüse und Tofu-Streifen</p>
          </div>
          <div class="menu-item-price">14,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Thailändischer Feuertopf</h4>
            <p>Mit saisonalem Gemüse, Pilzen, Tomaten, Ananas, Tofu und aromatischer Brühe</p>
          </div>
          <div class="menu-item-price">ab 35,90 €</div>
        </div>
      </div>

      <!-- Category 4: Desserts & Drinks -->
      <div class="menu-category-content" id="cat-desserts" style="display: none;">
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Aloe-Vera-Eistee (Trà Lô Hội)</h4>
            <p>Frischer Aloe-Vera-Tee mit Limette, Minze und hausgemachtem Sirup</p>
          </div>
          <div class="menu-item-price">4,90 €</div>
        </div>
        <div class="menu-item-row">
          <div class="menu-item-info">
            <h4>Vietnamesischer Eiskaffee (Cà Phê Sữa Đá)</h4>
            <p>Kräftiger Phin-Kaffee mit gesüßter veganer Kondensmilch und Eiswürfeln</p>
          </div>
          <div class="menu-item-price">5,50 €</div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL: VIDEO LIGHTBOX (YOUTUBE) -->
  <div class="modal-overlay" id="videoModal">
    <div class="modal-content" style="max-width: 900px; width: 92%; padding: 0; background: #000; overflow: hidden; border-radius: 12px; position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.6);">
      <button class="modal-close" style="color: #fff; z-index: 10; top: 12px; right: 12px; font-size: 1.6rem; background: rgba(0,0,0,0.6); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer;">&times;</button>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
        <iframe id="gardenYouTubeIframe" src="about:blank" data-src="https://www.youtube.com/embed/g2DIB_n3434?autoplay=1&rel=0&modestbranding=1&enablejsapi=1" title="Vegan Garden Berlin Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="position: absolute; top:0; left: 0; width: 100%; height: 100%; border: none;"></iframe>
      </div>
    </div>
  </div>

  <!-- MODAL: REVIEWS LIGHTBOX -->
  <div class="modal-overlay" id="reviewsModal">
    <div class="modal-content">
      <button class="modal-close">&times;</button>
      <h2 class="serif-font" style="color: var(--primary-green-dark); margin-bottom: 8px;">Google Kundenbewertungen</h2>
      <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 20px;">4,8 von 5 Sternen basierend auf über 285 Google Rezensionen.</p>

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


  <!-- FLOATING RESERVATION BUTTON (GLOBAL ACROSS ALL PAGES) -->
  <button class="floating-reserve-btn js-open-reserve" aria-label="Tisch reservieren" title="Tisch reservieren">
    <span class="floating-reserve-pulse"></span>
    <i class="fa-solid fa-calendar-check"></i>
  </button>

  <?php wp_footer(); ?>
</body>
</html>
