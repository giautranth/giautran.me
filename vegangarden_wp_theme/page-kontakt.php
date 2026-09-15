<?php
/**
 * Template Name: Kontakt
 */
get_header();
?>

<style>

    .contact-hero {
      background: linear-gradient(135deg, #2A160F 0%, #3d2319 100%);
      color: #ffffff;
      padding: 60px 0 40px;
      text-align: center;
    }
    .contact-breadcrumbs {
      font-size: 0.85rem;
      color: rgba(255,255,255,0.7);
      margin-bottom: 16px;
    }
    .contact-breadcrumbs a {
      color: rgba(255,255,255,0.85);
      text-decoration: none;
    }
    .contact-breadcrumbs a:hover {
      color: #d4af37;
    }
    .contact-hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 3.5vw, 2.8rem);
      font-weight: 600;
      margin-bottom: 12px;
      color: #ffffff;
    }
    .contact-hero-desc {
      font-size: 1.05rem;
      color: rgba(255,255,255,0.85);
      max-width: 600px;
      margin: 0 auto;
    }

    .contact-section {
      padding: 60px 0 90px;
      background: #F6F1E7;
    }
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: start;
    }

    /* Left Column Info Cards */
    .contact-info-col {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .contact-banner-img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .contact-cards-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .contact-info-card {
      background: #ffffff;
      border: 1px solid var(--border-subtle);
      border-radius: 14px;
      padding: 20px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.04);
      display: flex;
      gap: 14px;
      align-items: flex-start;
    }
    .contact-card-icon {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      background: #eaf2eb;
      color: var(--primary-green-dark);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }
    .contact-card-title {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      color: var(--primary-green-dark);
      text-transform: uppercase;
      margin-bottom: 4px;
    }
    .contact-card-text {
      font-size: 0.9rem;
      color: #333333;
      line-height: 1.45;
    }
    .contact-card-text a {
      color: inherit;
      text-decoration: none;
    }
    .contact-card-text a:hover {
      color: var(--primary-green);
    }

    .contact-map-card {
      background: #ffffff;
      border: 1px solid var(--border-subtle);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.04);
      height: 220px;
    }
    .contact-map-card iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    /* Right Column Form Card */
    .contact-form-card {
      background: #ffffff;
      border: 1px solid var(--border-subtle);
      border-radius: 20px;
      padding: 36px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    .form-heading {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      color: var(--primary-green-dark);
      margin-bottom: 8px;
    }
    .form-subheading {
      font-size: 0.9rem;
      color: #6A625A;
      margin-bottom: 24px;
    }
    .form-row-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 16px;
    }
    .form-field-full {
      margin-bottom: 16px;
    }
    .form-label-custom {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      color: #211A16;
      margin-bottom: 6px;
    }
    .form-control-custom {
      width: 100%;
      background: #F6F1E7;
      border: 1px solid #dce5dd;
      border-radius: 10px;
      padding: 12px 16px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.95rem;
      color: #211A16;
      transition: all 0.2s ease;
    }
    .form-control-custom:focus {
      outline: none;
      border-color: var(--primary-green);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(74, 99, 75, 0.12);
    }
    .form-control-custom::placeholder {
      color: #999999;
    }

    @media (max-width: 900px) {
      .contact-grid {
        grid-template-columns: 1fr;
      }
      .contact-cards-grid {
        grid-template-columns: 1fr;
      }
      .form-row-2 {
        grid-template-columns: 1fr;
      }
    }
  
</style>


<section class="contact-hero">
    <div class="container">

      <h1 class="contact-hero-title">KONTAKT & ANFAHRT</h1>
      <p class="contact-hero-desc">Wir freuen uns auf Ihren Besuch im Herzen von Berlin-Friedrichshain!</p>
    </div>
  </section>

  <!-- MAIN CONTACT SECTION -->
  <section class="contact-section">
    <div class="container">
      <div class="contact-grid">
        <!-- Left Info Column -->
        <div class="contact-info-col">
          <img src="<?php echo esc_url(home_url('/images/store.jpg')); ?>" alt="Vegan Garden Berlin Restaurant Store" class="contact-banner-img">

          <div class="contact-cards-grid">
            <!-- Adresse -->
            <div class="contact-info-card">
              <div class="contact-card-icon"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <div class="contact-card-title">ADRESSE</div>
                <div class="contact-card-text"><?php echo nl2br(esc_html(function_exists('vg_get_option') ? vg_get_option('address', "Frankfurter Allee 21\n10247 Berlin-Friedrichshain") : "Frankfurter Allee 21\n10247 Berlin-Friedrichshain")); ?></div>
              </div>
            </div>

            <!-- Öffnungszeiten -->
            <div class="contact-info-card">
              <div class="contact-card-icon"><i class="fa-regular fa-clock"></i></div>
              <div>
                <div class="contact-card-title">ÖFFNUNGSZEITEN</div>
                <div class="contact-card-text">
                  <?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('hours_open', 'Di – So: 12:00 – 22:00 Uhr') : 'Di – So: 12:00 – 22:00 Uhr'); ?><br>
                  <?php if ($h_cl = function_exists('vg_get_option') ? vg_get_option('hours_closed', 'Montag Ruhetag') : ''): ?>
                    <small style="color: #6A625A;"><?php echo esc_html($h_cl); ?></small>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- Telefon -->
            <div class="contact-info-card">
              <div class="contact-card-icon"><i class="fa-solid fa-phone"></i></div>
              <div>
                <div class="contact-card-title">TELEFON</div>
                <div class="contact-card-text">
                  <?php
                  $p1 = function_exists('vg_get_option') ? vg_get_option('phone_1', '030 2123 7260') : '030 2123 7260';
                  $p2 = function_exists('vg_get_option') ? vg_get_option('phone_2', '0162 464 9999') : '0162 464 9999';
                  ?>
                  <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $p1)); ?>"><?php echo esc_html($p1); ?></a>
                  <?php if (!empty($p2)): ?>
                    <br><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $p2)); ?>"><?php echo esc_html($p2); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- E-Mail -->
            <div class="contact-info-card">
              <div class="contact-card-icon"><i class="fa-solid fa-envelope"></i></div>
              <div>
                <div class="contact-card-title">E-MAIL</div>
                <?php $em = function_exists('vg_get_option') ? vg_get_option('email', 'info@vegan-garden.berlin') : 'info@vegan-garden.berlin'; ?>
                <div class="contact-card-text"><a href="mailto:<?php echo esc_attr($em); ?>"><?php echo esc_html($em); ?></a></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Form Column (Clean form without placeholders) -->
        <div class="contact-form-card">
          <h2 class="form-heading" style="margin-bottom: 24px;">KONTAKT</h2>

          <form id="contactPageForm">
            <?php wp_nonce_field('vg_contact_form', 'vg_contact_nonce'); ?>
            <div id="contactFormStatus" style="display:none; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.92rem; font-weight: 500;"></div>
            <div class="form-row-2">
              <div>
                <label class="form-label-custom">Name *</label>
                <input type="text" name="contact_name" required class="form-control-custom">
              </div>
              <div>
                <label class="form-label-custom">Telefonnummer *</label>
                <input type="tel" name="contact_phone" required class="form-control-custom">
              </div>
            </div>

            <div class="form-field-full">
              <label class="form-label-custom">E-Mail-Adresse *</label>
              <input type="email" name="contact_email" required class="form-control-custom">
            </div>

            <div class="form-field-full" style="margin-bottom: 24px;">
              <label class="form-label-custom">Nachricht *</label>
              <textarea name="contact_message" required class="form-control-custom" rows="5"></textarea>
            </div>

            <button type="submit" id="contactSubmitBtn" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px; border-radius: 50px; font-size: 1rem; font-weight: 700;">
              SENDEN
            </button>
          </form>
          <script>
          document.getElementById('contactPageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const btn = document.getElementById('contactSubmitBtn');
            const status = document.getElementById('contactFormStatus');
            const formData = new FormData(form);
            formData.append('action', 'vg_contact_submit');

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> WIRD GESENDET...';

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
              method: 'POST',
              body: formData
            })
            .then(r => r.json())
            .then(data => {
              status.style.display = 'block';
              if (data.success) {
                status.style.background = '#d4edda';
                status.style.color = '#155724';
                status.style.border = '1px solid #c3e6cb';
                status.innerHTML = '<i class="fa-solid fa-check-circle"></i> ' + data.data;
                form.reset();
              } else {
                status.style.background = '#f8d7da';
                status.style.color = '#721c24';
                status.style.border = '1px solid #f5c6cb';
                status.innerHTML = '<i class="fa-solid fa-exclamation-circle"></i> ' + data.data;
              }
              btn.disabled = false;
              btn.innerHTML = 'SENDEN';
              setTimeout(() => { status.style.display = 'none'; }, 8000);
            })
            .catch(() => {
              status.style.display = 'block';
              status.style.background = '#f8d7da';
              status.style.color = '#721c24';
              status.innerHTML = '<i class="fa-solid fa-exclamation-circle"></i> Netzwerkfehler. Bitte versuchen Sie es erneut.';
              btn.disabled = false;
              btn.innerHTML = 'SENDEN';
            });
          });
          </script>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  

<?php
get_footer();
