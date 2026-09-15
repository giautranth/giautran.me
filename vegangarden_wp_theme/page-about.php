<?php
/**
 * Template Name: Über Uns
 */
get_header();
?>

<style>

    .about-page {
      background-color: #F6F1E7 !important;
      color: #211A16;
    }
    .about-hero {
      background: linear-gradient(135deg, #2A160F 0%, #3d2319 100%);
      color: #ffffff;
      padding: 60px 0 45px;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .about-hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.8rem;
      color: #ffffff;
      letter-spacing: 0.06em;
      margin-bottom: 12px;
      text-align: center;
    }
    .about-hero-subtitle {
      font-size: 1.1rem;
      color: rgba(255, 255, 255, 0.88);
      max-width: 680px;
      margin: 0 auto;
      line-height: 1.6;
      text-align: center !important;
    }
    .about-section {
      background-color: #F6F1E7 !important;
      padding: 50px 0;
    }

    /* FEATURE ROW (SPLIT LAYOUT WITH IMAGES ON DARK GREEN CARDS) */
    .feature-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
      margin-bottom: 60px;
      background: #2A160F; border: 1px solid rgba(199, 154, 74, 0.2);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.25);
      border: 1px solid rgba(255, 255, 255, 0.12);
    }
    .feature-row.reverse {
      grid-template-columns: 1fr 1fr;
    }
    @media (max-width: 992px) {
      .feature-row, .feature-row.reverse {
        grid-template-columns: 1fr;
      }
    }
    .feature-img-wrap {
      width: 100%;
      height: 100%;
      min-height: 340px;
      position: relative;
      overflow: hidden;
    }
    .feature-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    .feature-row:hover .feature-img-wrap img {
      transform: scale(1.04);
    }
    .feature-content {
      padding: 40px;
    }
    .feature-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.15em;
      color: #A98224;
      text-transform: uppercase;
      margin-bottom: 12px;
    }
    .feature-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      color: #ffffff !important;
      margin-bottom: 16px;
      line-height: 1.3;
    }
    .feature-desc {
      font-size: 1.02rem;
      line-height: 1.7;
      color: rgba(255, 255, 255, 0.88) !important;
      margin-bottom: 24px;
      text-align: justify !important;
      text-justify: inter-word !important;
    }
    .feature-highlights {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    .highlight-pill {
      background: rgba(255, 255, 255, 0.12) !important;
      color: #ffffff !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      padding: 8px 16px;
      border-radius: 30px;
      font-size: 0.88rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* GALLERY MINI GRID FOR DISHES */
    .dish-gallery-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
    }
    .dish-gallery-item {
      border-radius: 12px;
      overflow: hidden;
      height: 110px;
      position: relative;
    }
    .dish-gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    .dish-gallery-item:hover img {
      transform: scale(1.08);
    }

    /* STATS BAR - CENTER ALIGNED */
    .about-stats-bar {
      background: #2A160F; border: 1px solid rgba(199, 154, 74, 0.2);
      color: #ffffff;
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 20px;
      padding: 36px 20px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      text-align: center !important;
      margin-bottom: 50px;
      justify-items: center;
      align-items: center;
    }
    @media (max-width: 768px) {
      .about-stats-bar {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    .stat-item {
      text-align: center !important;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 100%;
    }
    .stat-item h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.85rem;
      color: var(--accent-gold) !important;
      margin-bottom: 6px;
      text-align: center !important;
    }
    .stat-item p {
      font-size: 0.88rem;
      color: rgba(255, 255, 255, 0.85) !important;
      text-align: center !important;
      line-height: 1.4;
    }
  
</style>


<section class="about-hero">
    <div class="container">

      <h1 class="about-hero-title">ÜBER UNS</h1>
      <p class="about-hero-subtitle">Authentische 100 % vegane vietnamesische Oase im Herzen von Berlin-Friedrichshain</p>
    </div>
  </section>

  <!-- MAIN ABOUT CONTENT SECTION -->
  <section class="about-section">
    <div class="container">

      <!-- FEATURE ROW 1: PHILOSOPHIE -->
      <div class="feature-row">
        <div class="feature-img-wrap">
          <img src="<?php echo esc_url(home_url('/images/about_section_1.jpg')); ?>" alt="A7402933 - Philosophie & Natur">
        </div>
        <div class="feature-content">
          <div class="feature-badge">
            <i class="fa-solid fa-seedling"></i>
            <span>PHILOSOPHIE & NATUR</span>
          </div>
          <h2 class="feature-title">Reine Pflanzliche Küche</h2>
          <p class="feature-desc">
            Alle Gerichte im Vegan Garden Berlin werden zu 100 % rein pflanzlich zubereitet – vollkommen ohne Eier, ohne Milchprodukte und ohne tierische Inhaltsstoffe. Wir bewahren ausschließlich die reinen, unverfälschten Aromen, die uns die Natur schenkt.
          </p>
          <div class="feature-highlights">
            <div class="highlight-pill"><i class="fa-solid fa-check" style="color: #A98224;"></i> 100 % Pflanzlich</div>
            <div class="highlight-pill"><i class="fa-solid fa-check" style="color: #A98224;"></i> Ohne Ei & Milch</div>
            <div class="highlight-pill"><i class="fa-solid fa-check" style="color: #A98224;"></i> Natürliche Zutaten</div>
          </div>
        </div>
      </div>

      <!-- FEATURE ROW 2: KULINARIK & DISHES -->
      <div class="feature-row reverse">
        <div class="feature-content">
          <div class="feature-badge">
            <i class="fa-solid fa-utensils"></i>
            <span>VIELFÄLTIGE KULINARIK</span>
          </div>
          <h2 class="feature-title">Einzigartiges Ambiente & Vielfältige Speisekarte</h2>
          <p class="feature-desc">
            Inspiriert von der schlichten Eleganz vietnamesischer Gärten bietet unsere Speisekarte eine reiche Auswahl: von duftender Phở Chay, frischen Sommerrollen und cremigen Currys bis hin zu würzigem Pilz-Feuertopf und sour-scharfem Thai-Lẩu. Verfeinert mit frischen Heilkräutern wie Basilikum, Minze und Koriander sowie bestem Bio-Tofu & Seitan.
          </p>
        </div>
        <div class="feature-img-wrap">
          <img src="<?php echo esc_url(home_url('/images/about_section_2.jpg?v=20260904_about2')); ?>" alt="Vegan Garden Berlin - Vietnamesische Küche">
        </div>
      </div>

      <!-- FEATURE ROW 3: GASTFREUNDSCHAFT & HOURS -->
      <div class="feature-row">
        <div class="feature-img-wrap">
          <img src="<?php echo esc_url(home_url('/images/about_section_3.jpg')); ?>" alt="44790733 - Gastfreundschaft">
        </div>
        <div class="feature-content">
          <div class="feature-badge">
            <i class="fa-solid fa-star"></i>
            <span>BEWERTUNGEN & GASTRONOMIE</span>
          </div>
          <h2 class="feature-title">Höchste Wertschätzung & Herzlicher Service</h2>
          <p class="feature-desc">
            Unser Restaurant zählt auf renommierten Plattformen wie HappyCow und Quandoo zu den am besten bewerteten Adressen in Berlin. Besonders beliebt sind unsere Phở Chay und das aromatische Red Curry – geschätzt für höchsten Geschmack und unseren herzlichen, aufmerksamen Service. Geöffnet von Dienstag bis Sonntag (12:00 – 22:00 Uhr).
          </p>
          <div class="feature-highlights">
            <div class="highlight-pill"><i class="fa-solid fa-heart" style="color: #e74c3c;"></i> HappyCow Top-Bewertung</div>
            <div class="highlight-pill"><i class="fa-solid fa-award" style="color: #A98224;"></i> Bei 4,9 ★</div>
            <div class="highlight-pill"><i class="fa-solid fa-clock" style="color: #A98224;"></i> Di - So 12:00 - 22:00</div>
          </div>
        </div>
      </div>


      <!-- STATS BAR -->
      <div class="about-stats-bar">
        <div class="stat-item">
          <h3>100 %</h3>
          <p>Pflanzlich & Frisch</p>
        </div>
        <div class="stat-item">
          <h3>Di – So</h3>
          <p>12:00 – 22:00 Uhr</p>
        </div>
        <div class="stat-item">
          <h3>100+</h3>
          <p>Garten Sitzplätze</p>
        </div>
        <div class="stat-item">
          <h3>★ 4.9</h3>
          <p>HappyCow & Quandoo</p>
        </div>
      </div>

      <!-- CTA BOX -->
      <div style="background: linear-gradient(135deg, #3d2319 0%, #2A160F 100%); border-radius: 20px; padding: 48px 32px; text-align: center; color: #ffffff; box-shadow: 0 10px 30px rgba(0,0,0,0.12);">
        <h2 class="serif-font" style="font-size: 2.2rem; color: #ffffff; margin-bottom: 12px;">Besuchen Sie uns im Vegan Garden Berlin</h2>
        <p style="font-size: 1.05rem; color: #d1d5d1; max-width: 600px; margin: 0 auto 28px; line-height: 1.6;">
          Erleben Sie unvergessliche kulinarische Momente in unserer grünen Oase in Berlin-Friedrichshain.
        </p>
        <button class="btn btn-primary js-open-reserve" style="padding: 14px 36px; font-size: 1rem;">
          <i class="fa-regular fa-calendar-check" style="margin-right: 8px;"></i>
          TISCH JETZT RESERVIEREN
        </button>
      </div>

    </div>
  </section>

  <!-- FOOTER -->
  

<?php
get_footer();
