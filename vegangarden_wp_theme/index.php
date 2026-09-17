<?php
/**
 * Template for displaying the front page
 */
get_header();
?>

<!-- HERO BANNER SECTION -->
  <section class="hero" id="home">
    <div class="hero-slider-wrap" id="heroSliderWrap">
      <div class="hero-slide active">
        <img src="<?php echo esc_url(home_url('/images/banner_4.jpeg?v=20260903_banner4')); ?>" alt="Vegan Garden Berlin Banner" class="hero-slide-img" fetchpriority="high">
      </div>
    </div>
    <div class="hero-overlay"></div>
    <div class="container hero-container">
      <div class="hero-buttons">
        <button class="btn btn-primary js-open-reserve" aria-label="Tisch reservieren">
          <i class="fa-regular fa-calendar-check"></i>
          <span>Tisch reservieren</span>
        </button>
        <a href="#speisekarte" class="btn btn-glass" aria-label="Speisekarte ansehen">
          <i class="fa-solid fa-utensils"></i>
          <span>Speisekarte ansehen</span>
        </a>
      </div>
    </div>
  </section>

  <!-- WELCOME / ABOUT SECTION -->
  <section class="section-welcome" id="restaurant">
    <div class="container">
      <div class="welcome-grid">
        <div class="welcome-text">
          <div class="welcome-tag">
            <span>WILLKOMMEN IM</span>
            <i class="fa-solid fa-leaf"></i>
          </div>
          <h2 class="welcome-heading">VEGAN GARDEN BERLIN</h2>
          <p class="welcome-desc">
            Mitten in Friedrichshain erwartet Sie ein außergewöhnlicher Ort voller Natur, Ruhe und Geschmack. Genießen Sie 100 % vegane vietnamesische Küche in einzigartiger Gartenatmosphäre.
          </p>
          <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary">MEHR ÜBER UNS</a>
        </div>
        <div class="video-card" id="videoCard">
          <img src="<?php echo esc_url(home_url('/images/garden_preview.jpg')); ?>" alt="Vegan Garden Berlin Video Preview">
          <div class="video-overlay">
            <div class="play-btn">
              <i class="fa-solid fa-play"></i>
            </div>
            <div class="video-caption">Ein kurzer Einblick in unseren Garten</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- GOOGLE REVIEWS SECTION (INTERACTIVE SLIDER) -->
  <section class="section-reviews" id="bewertungen" style="background: #F6F1E7; padding: 40px 0; border: none;">
    <div class="container">
      <div class="reviews-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 20px;">
        <div class="reviews-google-badge" style="display: flex; align-items: center; gap: 16px;">
          <img src="<?php echo esc_url(home_url('/images/google_logo.png')); ?>" alt="Google Logo" style="height: 30px; width: auto; max-width: 105px; object-fit: contain; display: block;">
          <div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <span style="font-weight: 800; font-size: 1.15rem; color: #211A16; line-height: 1;">4,8</span>
              <div class="rating-stars" style="color: #FBBC04; font-size: 1rem; display: flex; gap: 2px;">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
            <div class="rating-score" style="font-weight: 600; color: #6A625A; font-size: 0.85rem; margin-top: 2px;">285+ Google Bewertungen</div>
          </div>
        </div>
      </div>

      <!-- Slider Container with Side Arrows -->
      <div class="slider-container-wrap">
        <button class="side-arrow side-arrow--prev" id="reviewsPrev" aria-label="Vorherige Bewertung">
          <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="reviews-card-slider" id="reviewsSlider">
          <!-- Card 1 (René Fleischmann) -->
          <div class="review-box">
            <div class="review-box-header">
              <div class="review-avatar" style="background: #e65100;">R</div>
              <div>
                <div class="review-author-name">René Fleischmann</div>
              </div>
            </div>
            <div class="review-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="review-text">"Authentisch, lecker, vegan, alles frisch zubereitet, selbst die Soßen. Die hausgemachten Drinks sind der Hammer."</p>
          </div>

          <!-- Card 2 (Jana Flohr) -->
          <div class="review-box">
            <div class="review-box-header">
              <div class="review-avatar" style="background: #7b1fa2;">J</div>
              <div>
                <div class="review-author-name">Jana Flohr</div>
              </div>
            </div>
            <div class="review-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="review-text">"We had delicious, incredibly fresh, and beautifully presented food... highly recommended! And then there was the wonderful Karl Marx Avenue... We'll be back!"</p>
          </div>

          <!-- Card 3 (frodo aus_dem_auenland) -->
          <div class="review-box">
            <div class="review-box-header">
              <div class="review-avatar" style="background: #2e7d32;">F</div>
              <div>
                <div class="review-author-name">frodo aus_dem_auenland</div>
              </div>
            </div>
            <div class="review-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="review-text">"Sehr schönes Restaurant mit leckeren ansprechenden Gerichten in Bio-Qualität. Geschmackvolle Einrichtung, das Essen und der Tee werden mit Liebe zubereitet. Hebt sich wirklich ab!"</p>
          </div>

          <!-- Card 4 (Papadopoulos Pipotimus) -->
          <div class="review-box">
            <div class="review-box-header">
              <div class="review-avatar" style="background: #1565c0;">P</div>
              <div>
                <div class="review-author-name">Papadopoulos Pipotimus</div>
              </div>
            </div>
            <div class="review-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="review-text">"Love it. Der Raum ist groß und trotz der Nähe zur Frankfurter Allee sehr ruhig, durch die Abendsonne beleuchten. Das Hauptgericht war eine große Suppe mit frischem Tofu. Alles in allem, geht hin!"</p>
          </div>

          <!-- Card 5 (Anna L.) -->
          <div class="review-box">
            <div class="review-box-header">
              <div class="review-avatar" style="background: #00838f;">A</div>
              <div>
                <div class="review-author-name">Anna L.</div>
              </div>
            </div>
            <div class="review-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="review-text">"Wunderschöner Ort, tolles Ambiente und das Essen ist einfach fantastisch! Die veganen Sommerrollen sind ein absolutes Highlight."</p>
          </div>
        </div>

        <button class="side-arrow side-arrow--next" id="reviewsNext" aria-label="Nächste Bewertung">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </section>

  <!-- HIGHLIGHTS / SPEISEKARTE SECTION -->
  <section class="section-highlights" id="speisekarte">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title notranslate">SPEISEKARTE</h2>
      </div>

      <div class="slider-container-wrap">
        <button class="side-arrow side-arrow--prev" id="highlightsPrev" aria-label="Vorheriges Gericht">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <div class="food-grid-slider" id="highlightsGrid">
          <!-- Dish 1 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/nem_ran.jpg')); ?>" alt="Knusprige Frühlingsrollen">
            </div>
            <div class="food-info">
              <h3 class="food-name">Knusprige Frühlingsrollen</h3>
              <div class="food-price">5,90 €</div>
            </div>
          </div>

          <!-- Dish 2 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/tu_buu_kho_chao.jpg')); ?>" alt="Vier Schätze in Chao-Soße">
            </div>
            <div class="food-info">
              <h3 class="food-name">Vier Schätze in Chao-Soße</h3>
              <div class="food-price">13,90 €</div>
            </div>
          </div>

          <!-- Dish 3 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/lau_thai.jpg')); ?>" alt="Thailändischer Feuertopf">
            </div>
            <div class="food-info">
              <h3 class="food-name">Thailändischer Feuertopf</h3>
              <div class="food-price">ab 35,90 €</div>
            </div>
          </div>

          <!-- Dish 4 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/vegan_garden_rollen.jpg')); ?>" alt="Vegan Garden Rollen">
            </div>
            <div class="food-info">
              <h3 class="food-name">Vegan Garden Rollen</h3>
              <div class="food-price">6,50 €</div>
            </div>
          </div>

          <!-- Dish 5 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/summer_bowl.jpg')); ?>" alt="Vegan Garden Reisnudel-Bowl">
            </div>
            <div class="food-info">
              <h3 class="food-name">Vegan Garden Reisnudel-Bowl</h3>
              <div class="food-price">13,90 €</div>
            </div>
          </div>

          <!-- Dish 6 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/thai_reisnudelsuppe.jpg')); ?>" alt="Thailändische Reisnudelsuppe">
            </div>
            <div class="food-info">
              <h3 class="food-name">Thailändische Reisnudelsuppe</h3>
              <div class="food-price">13,90 €</div>
            </div>
          </div>

          <!-- Dish 7 -->
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url(home_url('/images/spargel.jpg')); ?>" alt="Tofu Royal">
            </div>
            <div class="food-info">
              <h3 class="food-name">Tofu Royal</h3>
              <div class="food-price">6,50 €</div>
            </div>
          </div>
        </div>
        <button class="side-arrow side-arrow--next" id="highlightsNext" aria-label="Nächstes Gericht">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>

      <a href="<?php echo esc_url(home_url('/menu/Druck_Speisekarte_VeganGarden.pdf')); ?>" target="_blank" rel="noopener" class="btn btn-primary" style="margin-top: 32px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
        <i class="fa-solid fa-file-pdf"></i>
        <span>GESAMTE SPEISEKARTE ANSEHEN</span>
      </a>
    </div>
  </section>

  <!-- GARTEN & EVENTS SECTION -->
  <section class="section-events" id="garten">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">GARTEN & EVENTS</h2>
      </div>

      <div class="events-grid">
        <!-- Banner 1 -->
        <div class="event-banner">
          <img src="<?php echo esc_url(home_url('/images/sommergarten.jpg?v=20260903_sommergarten4')); ?>" alt="Sommergarten">
          <div class="event-overlay">
            <h3 class="event-title">SOMMERGARTEN</h3>
            <p class="event-subtitle">Über 100 Plätze im Grünen</p>
          </div>
        </div>

        <!-- Banner 2 -->
        <div class="event-banner">
          <img src="<?php echo esc_url(home_url('/images/restaurant.jpg?v=20260903_restaurant4')); ?>" alt="Restaurant Indoor">
          <div class="event-overlay">
            <h3 class="event-title">RESTAURANT</h3>
            <p class="event-subtitle">Modern, gemütlich & entspannt</p>
          </div>
        </div>

        <!-- Banner 3 -->
        <div class="event-banner" id="events">
          <img src="<?php echo esc_url(home_url('/images/events.jpg?v=20260903_event5')); ?>" alt="Events & Feiern">
          <div class="event-overlay">
            <h3 class="event-title">EVENTS & FEIERN</h3>
            <p class="event-subtitle">Private & Exclusive</p>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- INSTAGRAM / GALLERY SECTION -->
  <section class="section-instagram">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title notranslate">GALLERY</h2>
      </div>

      <div class="slider-container-wrap">
        <button class="side-arrow side-arrow--prev" id="galleryPrev" aria-label="Vorheriges Bild">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <div class="food-grid-slider gallery-grid-slider" id="galleryGrid">
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/bo-tuu-kho-chao.png?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Tu Buu Kho Chao" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/lau.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Lau Thai Feuertopf" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/bunbo.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Bun Bo Hue Nudelsuppe" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/bunthai.png?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Bun Thai Nudelsuppe" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/SPARGEL.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Frischer grüner Spargel" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/CHIHUONG28.084336-Edit.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Knusprige Frühlingsrollen" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/4.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Festliche vegane Speisen" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/CHIHUONG28.084466.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Gesunde Reisspezialitäten" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/a.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Vegane Spezialitäten" loading="lazy">
          </div>
          <div class="insta-card">
            <img src="<?php echo esc_url(home_url('/images/gallery/CHIHUONG28.085441.jpg?v=20260903_g')); ?>" alt="Vegan Garden Berlin - Gemütliches Restaurant-Ambiente" loading="lazy">
          </div>
        </div>
        <button class="side-arrow side-arrow--next" id="galleryNext" aria-label="Nächstes Bild">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </section>

  <!-- RATGEBER / ARTICLES SECTION (CIH STYLE) -->
  <section class="section-highlights" id="ratgeber" style="background-color: var(--bg-cream); padding: 40px 0; text-align: center;">
    <div class="container">
      <div class="section-header" style="margin-bottom: 24px;">
        <h2 class="section-title notranslate">JOURNAL</h2>
      </div>


      <!-- Articles Grid (CIH Style Slider) -->
      <div class="slider-container-wrap" style="margin-bottom: 36px;">
        <button class="side-arrow side-arrow--prev" id="ratgeberPrev" aria-label="Vorheriger Artikel">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <div class="news-card-grid" id="newsGrid" style="text-align: left;">
          <!-- Article 1: Speisekarte -->
          <article class="news-card" data-category="speisekarte">
            <a href="<?php echo esc_url(home_url('/articles/vegan-garden-berlin-speisekarte.html')); ?>" class="news-card__img-wrap">
              <img src="<?php echo esc_url(home_url('/images/article_speisekarte.jpg')); ?>" alt="Die Speisekarte 2026 im Überblick" class="news-card__img">
              <span class="news-card__cat">SPEISEKARTE</span>
            </a>
            <div class="news-card__body">
              <h3 class="news-card__title">
                <a href="<?php echo esc_url(home_url('/articles/vegan-garden-berlin-speisekarte.html')); ?>">Die Speisekarte 2026 im Überblick – Gerichte, Preise & Vielfalt</a>
              </h3>
              <a href="<?php echo esc_url(home_url('/articles/vegan-garden-berlin-speisekarte.html')); ?>" class="news-card__more">
                <span class="more-txt">Artikel lesen</span>
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </article>

          <!-- Article 2: Lẩu (Feuertopf) -->
          <article class="news-card" data-category="rezepte">
            <a href="<?php echo esc_url(home_url('/articles/banh-mi-vegan-berlin.html')); ?>" class="news-card__img-wrap">
              <img src="<?php echo esc_url(home_url('/images/gallery/lau.jpg?v=20260918')); ?>" alt="Veganer Feuertopf (Lẩu) in Berlin" class="news-card__img">
              <span class="news-card__cat">SPEZIALITÄTEN</span>
            </a>
            <div class="news-card__body">
              <h3 class="news-card__title">
                <a href="<?php echo esc_url(home_url('/articles/banh-mi-vegan-berlin.html')); ?>">Veganer Feuertopf (Lẩu) in Berlin – Das wärmende Geschmackserlebnis</a>
              </h3>
              <a href="<?php echo esc_url(home_url('/articles/banh-mi-vegan-berlin.html')); ?>" class="news-card__more">
                <span class="more-txt">Artikel lesen</span>
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </article>

          <!-- Article 3: Bun Bo Hue -->
          <article class="news-card" data-category="rezepte">
            <a href="<?php echo esc_url(home_url('/articles/bun-bo-hue-vegan-berlin.html')); ?>" class="news-card__img-wrap">
              <img src="<?php echo esc_url(home_url('/images/gallery/bunbo.jpg?v=20260910')); ?>" alt="Bun Bo Hue vegan Berlin" class="news-card__img">
              <span class="news-card__cat">REZEPTE</span>
            </a>
            <div class="news-card__body">
              <h3 class="news-card__title">
                <a href="<?php echo esc_url(home_url('/articles/bun-bo-hue-vegan-berlin.html')); ?>">Bun Bo Hue vegan Berlin: Feurige Suppe mit Zitronengras</a>
              </h3>
              <a href="<?php echo esc_url(home_url('/articles/bun-bo-hue-vegan-berlin.html')); ?>" class="news-card__more">
                <span class="more-txt">Artikel lesen</span>
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </article>

        </div>
        <button class="side-arrow side-arrow--next" id="ratgeberNext" aria-label="Nächster Artikel">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>

      <a href="<?php echo esc_url(home_url('/ratgeber/')); ?>" class="btn btn-primary" id="allArticlesBtn">ALLE ARTIKEL ANSEHEN</a>
    </div>
  </section>

  <!-- FOOTER SECTION -->
  

<?php
get_footer();
