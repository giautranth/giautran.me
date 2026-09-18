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
            <span><a href="https://maps.app.goo.gl/St5dH8yWhqsPBheCA" target="_blank" rel="noopener" style="color: inherit; text-decoration: none;" title="Auf Google Maps ansehen">Frankfurter Allee 21<br>10247 Berlin, Germany</a></span>
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
          <a href="<?php echo esc_url(home_url('/impressum.html')); ?>" target="_blank" style="display: inline-block; text-transform: capitalize;">Impressum</a>
          <span class="footer-legal-sep">&bull;</span>
          <a href="<?php echo esc_url(home_url('/datenschutz.html')); ?>" target="_blank">Datenschutz</a>
          <span class="footer-legal-sep">&bull;</span>
          <a href="<?php echo esc_url(home_url('/cookie-einstellungen.html')); ?>" target="_blank">Cookie-Einstellungen</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- RESERVATION MODAL (INLINE CRITICAL CSS FOR ZERO-CACHE ISSUES) -->
  <style id="vg-reserve-modal-critical-css">
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(20, 15, 10, 0.65);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      z-index: 99999;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 16px;
      box-sizing: border-box;
    }
    .modal-overlay.active {
      display: flex !important;
    }
    .modal-content--reserve {
      max-width: 520px;
      width: 100%;
      padding: 26px 28px 22px;
      border-radius: 20px;
      max-height: 92vh;
      overflow-y: auto;
      background: #ffffff;
      box-shadow: 0 16px 45px rgba(0, 0, 0, 0.18);
      position: relative;
      box-sizing: border-box;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .modal-content--reserve .modal-close {
      position: absolute;
      top: 16px;
      right: 20px;
      font-size: 26px;
      color: #8A887F;
      cursor: pointer;
      line-height: 1;
      padding: 4px;
      transition: color 0.2s ease;
      background: none;
      border: none;
    }
    .modal-content--reserve .modal-close:hover {
      color: #2A160F;
    }
    .reserve-modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
      padding-right: 32px;
      flex-wrap: wrap;
      gap: 8px;
    }
    .reserve-modal-header h2 {
      font-family: 'Playfair Display', Georgia, serif;
      color: #2A160F;
      margin: 0;
      font-size: 1.4rem;
      font-weight: 700;
      letter-spacing: -0.2px;
    }
    .vg-form-grid {
      display: flex;
      flex-direction: column;
      gap: 13px;
    }
    .vg-row-2col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .vg-field-group {
      display: flex;
      flex-direction: column;
    }
    .vg-field-label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: #6C6259;
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      gap: 2px;
    }
    .vg-field-label .req {
      color: #8F6D1E;
      font-weight: 700;
    }
    .vg-field-label .opt {
      color: #9E9486;
      font-weight: 400;
      text-transform: none;
      font-size: 10.5px;
      margin-left: 4px;
      letter-spacing: 0;
    }
    .vg-input-wrap {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
    }
    .vg-input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #A3998C;
      font-size: 13.5px;
      pointer-events: none;
      z-index: 2;
    }
    .vg-field-input {
      width: 100%;
      padding: 11px 14px 11px 38px !important;
      background-color: #EAE4D8 !important;
      border: 1px solid transparent !important;
      border-radius: 12px !important;
      font-size: 14px !important;
      color: #2A160F !important;
      font-family: inherit !important;
      box-sizing: border-box !important;
      outline: none !important;
      transition: all 0.2s ease !important;
    }
    .vg-field-input::placeholder {
      color: #9E9486 !important;
    }
    .vg-field-input:focus {
      background-color: #F0EAE0 !important;
      border-color: #8F6D1E !important;
      box-shadow: 0 0 0 3px rgba(143, 109, 30, 0.12) !important;
    }
    .vg-field-select {
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='13' height='13' viewBox='0 0 24 24' fill='none' stroke='%238F6D1E' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: right 14px center !important;
      padding-right: 36px !important;
      cursor: pointer;
    }
    .vg-textarea-wrap {
      align-items: flex-start;
    }
    .vg-textarea-wrap .vg-input-icon {
      top: 13px;
      transform: none;
    }
    .vg-field-textarea {
      resize: vertical !important;
      min-height: 64px !important;
      line-height: 1.4 !important;
    }
    .vg-helper-text {
      font-size: 11px;
      color: #8A887F;
      margin-top: 4px;
      line-height: 1.35;
    }
    #reserveSubmitBtn {
      background: #8F6D1E !important;
      color: #ffffff !important;
      border: none !important;
      border-radius: 30px !important;
      padding: 13px 26px !important;
      font-size: 13.5px !important;
      font-weight: 700 !important;
      letter-spacing: 0.8px !important;
      text-transform: uppercase !important;
      box-shadow: 0 4px 14px rgba(143, 109, 30, 0.25) !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 8px !important;
      width: 100% !important;
      margin-top: 6px !important;
      font-family: inherit !important;
    }
    #reserveSubmitBtn:hover {
      background: #7A5C17 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 6px 18px rgba(143, 109, 30, 0.32) !important;
    }
    #reserveSubmitBtn:active {
      transform: translateY(0) !important;
    }
    #reserveSubmitBtn:disabled {
      opacity: 0.7 !important;
      cursor: not-allowed !important;
    }
    .vg-confirmation-hint {
      text-align: center;
      margin-top: 10px;
      font-size: 11.5px;
      color: #8A887F;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }
    .vg-confirmation-hint i {
      color: #8F6D1E;
      font-size: 12px;
    }
    @media (max-width: 640px) {
      .modal-content--reserve {
        padding: 20px 16px 18px !important;
        max-height: 94vh !important;
        border-radius: 16px !important;
      }
      .modal-content--reserve .modal-close {
        top: 12px;
        right: 14px;
      }
    }
    @media (max-width: 480px) {
      .vg-row-2col {
        grid-template-columns: 1fr !important;
        gap: 12px !important;
      }
    }
  </style>

  <!-- RESERVATION MODAL -->
  <div class="modal-overlay" id="reservationModal">
    <div class="modal-content modal-content--reserve">
      <button class="modal-close" aria-label="Schließen">&times;</button>
      
      <div class="reserve-modal-header">
        <h2>Tisch reservieren</h2>
      </div>

      <form id="reserveForm" class="vg-form-grid" style="padding: 4px 0 0;">
        <?php wp_nonce_field('vg_reserve_form', 'vg_reserve_nonce'); ?>
        
        <!-- ROW 1: DATE & TIME -->
        <div class="vg-row-2col">
          <div class="vg-field-group">
            <label class="vg-field-label">DATUM <span class="req">*</span></label>
            <div class="vg-input-wrap">
              <i class="fa-regular fa-calendar vg-input-icon"></i>
              <input type="date" name="res_date" id="resDate" required class="vg-field-input" min="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <div class="vg-field-group">
            <label class="vg-field-label">UHRZEIT <span class="req">*</span></label>
            <div class="vg-input-wrap">
              <i class="fa-regular fa-clock vg-input-icon"></i>
              <select name="res_time" id="resTime" required class="vg-field-input vg-field-select">
                <option value="12:00">12:00 Uhr</option>
                <option value="12:30">12:30 Uhr</option>
                <option value="13:00">13:00 Uhr</option>
                <option value="13:30">13:30 Uhr</option>
                <option value="14:00">14:00 Uhr</option>
                <option value="14:30">14:30 Uhr</option>
                <option value="15:00">15:00 Uhr</option>
                <option value="15:30">15:30 Uhr</option>
                <option value="16:00">16:00 Uhr</option>
                <option value="16:30">16:30 Uhr</option>
                <option value="17:00">17:00 Uhr</option>
                <option value="17:30">17:30 Uhr</option>
                <option value="18:00">18:00 Uhr</option>
                <option value="18:30" selected>18:30 Uhr</option>
                <option value="19:00">19:00 Uhr</option>
                <option value="19:30">19:30 Uhr</option>
                <option value="20:00">20:00 Uhr</option>
                <option value="20:30">20:30 Uhr</option>
                <option value="21:00">21:00 Uhr</option>
                <option value="21:30">21:30 Uhr</option>
              </select>
            </div>
          </div>
        </div>

        <!-- ROW 2: NUMBER OF GUESTS -->
        <div class="vg-field-group">
          <label class="vg-field-label">ANZAHL DER GÄSTE <span class="req">*</span></label>
          <div class="vg-input-wrap">
            <i class="fa-solid fa-user-group vg-input-icon"></i>
            <select name="res_guests" id="resGuests" required class="vg-field-input vg-field-select">
              <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo $i === 2 ? 'selected' : ''; ?>><?php echo $i; ?> <?php echo $i === 1 ? 'Gast' : 'Gäste'; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="vg-helper-text">Mehr als 12 Gäste? Bitte rufen Sie uns rechtzeitig an.</div>
        </div>

        <!-- ROW 3: YOUR NAME -->
        <div class="vg-field-group">
          <label class="vg-field-label">IHR NAME <span class="req">*</span></label>
          <div class="vg-input-wrap">
            <i class="fa-regular fa-user vg-input-icon"></i>
            <input type="text" name="res_name" id="resName" required placeholder="Vor- und Nachname" class="vg-field-input">
          </div>
        </div>

        <!-- ROW 4: EMAIL & PHONE -->
        <div class="vg-row-2col vg-row-2col--contact">
          <div class="vg-field-group">
            <label class="vg-field-label">E-MAIL-ADRESSE <span class="req">*</span></label>
            <div class="vg-input-wrap">
              <i class="fa-regular fa-envelope vg-input-icon"></i>
              <input type="email" name="res_email" id="resEmail" required placeholder="name@beispiel.de" class="vg-field-input">
            </div>
          </div>

          <div class="vg-field-group">
            <label class="vg-field-label">TELEFONNUMMER <span class="req">*</span></label>
            <div class="vg-input-wrap">
              <i class="fa-solid fa-phone vg-input-icon"></i>
              <input type="tel" name="res_phone" id="resPhone" required placeholder="+49 ..." class="vg-field-input">
            </div>
          </div>
        </div>

        <!-- ROW 5: SPECIAL REQUEST / ANMERKUNG -->
        <div class="vg-field-group">
          <label class="vg-field-label">BESONDERE WÜNSCHE / ALLERGIEN <span class="opt">(optional)</span></label>
          <div class="vg-input-wrap vg-textarea-wrap">
            <i class="fa-regular fa-comment-dots vg-input-icon"></i>
            <textarea name="res_note" id="resNote" rows="2" placeholder="Fensterplatz, Allergien, Geburtstag, Hochstuhl..." class="vg-field-input vg-field-textarea"></textarea>
          </div>
        </div>

        <div id="reserveStatus" style="margin-top:4px; padding:10px 14px; border-radius:8px; display:none; font-size:0.88rem;"></div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" id="reserveSubmitBtn">
          <span>JETZT RESERVIEREN</span>
        </button>

        <!-- FOOTER CONFIRMATION HINT -->
        <div class="vg-confirmation-hint">
          <i class="fa-solid fa-leaf"></i>
          <span>Sie erhalten eine Bestätigung per E-Mail.</span>
        </div>
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
            submitBtn.innerHTML = '<span>JETZT RESERVIEREN</span>';
          })
          .catch(() => {
            statusDiv.style.display = 'block';
            statusDiv.style.background = '#fbe9e7';
            statusDiv.style.color = '#c62828';
            statusDiv.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Netzwerkfehler. Bitte versuchen Sie es erneut.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>JETZT RESERVIEREN</span>';
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
