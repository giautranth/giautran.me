<?php
/**
 * Template Name: Journal Hub
 */
get_header();
?>

<style>

    .hub-hero {
      background: linear-gradient(135deg, #2A160F 0%, #3d2319 100%);
      color: #ffffff;
      padding: 60px 0 40px;
      text-align: center;
    }
    .hub-breadcrumbs {
      font-size: 0.85rem;
      color: rgba(255,255,255,0.7);
      margin-bottom: 16px;
    }
    .hub-breadcrumbs a {
      color: rgba(255,255,255,0.85);
      text-decoration: none;
    }
    .hub-breadcrumbs a:hover {
      color: #d4af37;
    }
    .hub-hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 3.5vw, 2.8rem);
      font-weight: 600;
      margin-bottom: 12px;
      color: #ffffff;
    }
    .hub-hero-desc {
      font-size: 1.05rem;
      color: rgba(255,255,255,0.85);
      max-width: 650px;
      margin: 0 auto;
    }

    .hub-main {
      padding: 50px 0 90px;
      background: #F6F1E7;
    }

    /* CIH Style Category Filter Tabs */
    .hub-cat-tabs {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 40px;
      border-bottom: 1px solid var(--border-subtle);
      padding-bottom: 16px;
    }
    .hub-cat-btn {
      background: #f4f6f4;
      border: 1px solid #dce5dd;
      color: #4a574b;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 600;
      font-size: 0.88rem;
      padding: 8px 20px;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.25s ease;
    }
    .hub-cat-btn:hover {
      background: #eaf2eb;
      color: var(--primary-green-dark);
      border-color: var(--primary-green);
    }
    .hub-cat-btn.active {
      background: var(--primary-green-dark);
      color: #ffffff;
      border-color: var(--primary-green-dark);
      box-shadow: 0 4px 12px rgba(46, 61, 47, 0.2);
    }

    /* Articles Grid (3-column layout) */
    .hub-news-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 32px;
    }
    .hub-news-card {
      background: #ffffff;
      border: 1px solid var(--border-subtle);
      border-radius: 18px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      height: 100%;
      box-shadow: 0 4px 18px rgba(42, 22, 15, 0.05);
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .hub-news-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 14px 34px rgba(42, 22, 15, 0.12);
      border-color: rgba(169, 130, 36, 0.35);
    }
    .hub-news-img-link {
      position: relative;
      display: block;
      aspect-ratio: 16 / 10;
      overflow: hidden;
      background: #2A160F;
    }
    .hub-news-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    .hub-news-card:hover .hub-news-img {
      transform: scale(1.06);
    }
    .hub-news-badge {
      position: absolute;
      top: 14px;
      left: 14px;
      background: rgba(42, 22, 15, 0.88);
      backdrop-filter: blur(6px);
      color: #F6F1E7;
      border: 1px solid rgba(199, 154, 74, 0.4);
      font-size: 0.72rem;
      font-weight: 700;
      padding: 5px 13px;
      border-radius: 50px;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }
    .hub-news-body {
      padding: 24px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .hub-news-meta {
      font-size: 0.8rem;
      color: #838a84;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .hub-news-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      font-weight: 700;
      color: #2A160F;
      line-height: 1.4;
      margin-bottom: 12px;
      min-height: 3.2em;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .hub-news-title a {
      color: inherit;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .hub-news-title a:hover {
      color: var(--color-gold);
    }
    .hub-news-excerpt {
      font-size: 0.88rem;
      color: #6A625A;
      line-height: 1.6;
      margin-bottom: 22px;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .hub-news-more {
      color: var(--color-gold);
      font-weight: 700;
      font-size: 0.88rem;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      margin-top: auto;
      align-self: flex-start;
      transition: all 0.25s ease;
    }
    .hub-news-more:hover {
      color: #2A160F;
      transform: translateX(4px);
    }

    @media (max-width: 992px) {
      .hub-news-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
      }
    }

    @media (max-width: 680px) {
      .hub-news-grid {
        grid-template-columns: 1fr;
        gap: 24px;
      }
    }
  
</style>


<section class="hub-hero">
    <div class="container">
      <h1 class="hub-hero-title notranslate">JOURNAL</h1>
      <p class="hub-hero-desc">Erfahren Sie mehr über gesundes veganes Essen, vietnamesische Heilkräuter und exklusive Rezepte.</p>
    </div>
  </section>

  <!-- MAIN NEWS HUB SECTION -->
  <section class="hub-main">
    <div class="container">

      <!-- Category Tabs Bar (CIH Style) -->
      <div class="hub-cat-tabs">
        <button class="hub-cat-btn active" data-filter="all">Alle Artikel (3)</button>
        <button class="hub-cat-btn" data-filter="kultur">Kultur &amp; Tipps</button>
        <button class="hub-cat-btn" data-filter="rezepte">Rezepte &amp; Kulinarik</button>
        <button class="hub-cat-btn" data-filter="speisekarte">Speisekarte &amp; Gerichte</button>
      </div>

      <!-- 3-Column Articles Grid -->
      <div class="hub-news-grid" id="hubNewsGrid">
        
        <!-- Article 1: Speisekarte & Gerichte -->
        <article class="hub-news-card" data-category="speisekarte">
          <a href="<?php echo esc_url(home_url('/articles/vegan-garden-berlin-speisekarte.html')); ?>" class="hub-news-img-link">
            <img src="<?php echo esc_url(home_url('/images/article_speisekarte.jpg')); ?>" alt="Die Speisekarte 2026 im Überblick – Gerichte, Preise &amp; Vielfalt" class="hub-news-img" loading="lazy">
            <span class="hub-news-badge">SPEISEKARTE &amp; GERICHTE</span>
          </a>
          <div class="hub-news-body">
            <div class="hub-news-meta">
              <i class="fa-regular fa-clock"></i>
              <span>5 Min. Lesezeit &bull; Speisekarte &amp; Vielfalt</span>
            </div>
            <h3 class="hub-news-title">
              <a href="<?php echo esc_url(home_url('/articles/vegan-garden-berlin-speisekarte.html')); ?>">Die Speisekarte 2026 im Überblick – Gerichte, Preise &amp; Vielfalt</a>
            </h3>
            <p class="hub-news-excerpt">
              Entdecken Sie unsere 100 % pflanzliche Speisekarte 2026: Von knusprigen Frühlingsrollen über aromatische Suppen bis hin zu traditionellen Feuertöpfen.
            </p>
            <a href="<?php echo esc_url(home_url('/articles/vegan-garden-berlin-speisekarte.html')); ?>" class="hub-news-more">
              <span>Artikel lesen</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>

        <!-- Article 2: Veganer Feuertopf (Lẩu) -->
        <article class="hub-news-card" data-category="rezepte kultur">
          <a href="<?php echo esc_url(home_url('/articles/veganer-feuertopf-lau-berlin.html')); ?>" class="hub-news-img-link">
            <img src="<?php echo esc_url(home_url('/images/gallery/lau.jpg?v=20260918')); ?>" alt="Veganer Feuertopf (Lẩu) in Berlin – Das wärmende Geschmackserlebnis" class="hub-news-img" loading="lazy">
            <span class="hub-news-badge">SPEZIALITÄTEN &amp; KULINARIK</span>
          </a>
          <div class="hub-news-body">
            <div class="hub-news-meta">
              <i class="fa-regular fa-clock"></i>
              <span>6 Min. Lesezeit &bull; Tradition &amp; Gemeinschaft</span>
            </div>
            <h3 class="hub-news-title">
              <a href="<?php echo esc_url(home_url('/articles/veganer-feuertopf-lau-berlin.html')); ?>">Veganer Feuertopf (Lẩu) in Berlin – Das wärmende Geschmackserlebnis</a>
            </h3>
            <p class="hub-news-excerpt">
              Reichhaltige Kräuterbrühe, frisches asiatisches Gartengemüse, zarter Bio-Tofu und edle Waldpilze: Erleben Sie unser traditionelles vietnamesisches Lẩu zum Teilen.
            </p>
            <a href="<?php echo esc_url(home_url('/articles/veganer-feuertopf-lau-berlin.html')); ?>" class="hub-news-more">
              <span>Artikel lesen</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>

        <!-- Article 3: Speisekarte & Bún Bò Huế -->
        <article class="hub-news-card" data-category="speisekarte rezepte">
          <a href="<?php echo esc_url(home_url('/articles/bun-bo-hue-vegan-berlin.html')); ?>" class="hub-news-img-link">
            <img src="<?php echo esc_url(home_url('/images/gallery/bunbo.jpg?v=20260910')); ?>" alt="Bun Bo Hue vegan Berlin: Feurige Suppe mit Zitronengras" class="hub-news-img" loading="lazy">
            <span class="hub-news-badge">REZEPTE &amp; KULINARIK</span>
          </a>
          <div class="hub-news-body">
            <div class="hub-news-meta">
              <i class="fa-regular fa-clock"></i>
              <span>5 Min. Lesezeit &bull; Rezepte &amp; Suppen</span>
            </div>
            <h3 class="hub-news-title">
              <a href="<?php echo esc_url(home_url('/articles/bun-bo-hue-vegan-berlin.html')); ?>">Bun Bo Hue vegan Berlin: Feurige Suppe mit Zitronengras</a>
            </h3>
            <p class="hub-news-excerpt">
              Eine unverwechselbare Spezialität aus Zentralvietnam: Kräftige Zitronengras-Brühe, samtiger Tofu, dicke Reisnudeln und frische Gartenkräuter für ein wohltuendes Geschmackserlebnis.
            </p>
            <a href="<?php echo esc_url(home_url('/articles/bun-bo-hue-vegan-berlin.html')); ?>" class="hub-news-more">
              <span>Artikel lesen</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- FOOTER -->
  

<?php
get_footer();
