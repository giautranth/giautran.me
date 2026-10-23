<?php

/**

 * Template for displaying the front page

 */

get_header();

?>



<!-- HERO BANNER SECTION -->

  <section class="hero" id="home">

    <div class="hero-slider-wrap" id="heroSliderWrap">

      <?php

      $banners = function_exists('vg_get_banners') ? vg_get_banners() : array();

      if (empty($banners)) {

          // Fallback: show original banner if no CMS banners exist

          $banners = array(array(

              'desktop' => esc_url(home_url('/images/banner_4.jpeg?v=20260903_banner4')),

              'mobile'  => esc_url(home_url('/images/banner_4.jpeg?v=20260903_banner4')),

              'title'   => 'Vegan Garden Berlin Banner',

              'link'    => '',

          ));

      }

      foreach ($banners as $i => $banner):

          $active = ($i === 0) ? ' active' : '';

          $priority = ($i === 0) ? ' fetchpriority="high"' : ' loading="lazy"';

      ?>

      <div class="hero-slide<?php echo $active; ?>">

        <?php if (!empty($banner['link'])): ?><a href="<?php echo esc_url($banner['link']); ?>"><?php endif; ?>

        <picture>

          <source media="(max-width: 768px)" srcset="<?php echo esc_url($banner['mobile']); ?>">

          <img src="<?php echo esc_url($banner['desktop']); ?>" alt="<?php echo esc_attr($banner['title']); ?>" class="hero-slide-img"<?php echo $priority; ?>>

        </picture>

        <?php if (!empty($banner['link'])): ?></a><?php endif; ?>

      </div>

      <?php endforeach; ?>

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

    <?php if (count($banners) > 1): ?>
    <button class="hero-arrow hero-arrow-left" id="heroPrevBtn" aria-label="Vorheriges Banner"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="hero-arrow hero-arrow-right" id="heroNextBtn" aria-label="Nächstes Banner"><i class="fa-solid fa-chevron-right"></i></button>
    <div class="hero-dots" id="heroDots">
      <?php for ($d = 0; $d < count($banners); $d++): ?>
        <span class="hero-dot<?php echo $d === 0 ? ' active' : ''; ?>" data-index="<?php echo $d; ?>" data-slide="<?php echo $d; ?>"></span>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

  </section>



  <!-- WELCOME / ABOUT SECTION -->
  <section class="section-welcome" id="restaurant">
    <div class="container">
      <div class="welcome-grid">
        <div class="welcome-text">
          <div class="welcome-tag">
            <span><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('welcome_tag', 'WILLKOMMEN IM') : 'WILLKOMMEN IM'); ?></span>
            <i class="fa-solid fa-leaf"></i>
          </div>
          <h2 class="welcome-heading"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('welcome_heading', 'VEGAN GARDEN BERLIN') : 'VEGAN GARDEN BERLIN'); ?></h2>
          <p class="welcome-desc">
            <?php echo nl2br(esc_html(function_exists('vg_get_option') ? vg_get_option('welcome_desc', 'Mitten in Friedrichshain erwartet Sie ein besonderer Ort voller Ruhe, Natur und Geschmack. Genießen Sie 100 % vegane vietnamesische Küche in entspannter Gartenatmosphäre.') : 'Mitten in Friedrichshain erwartet Sie ein besonderer Ort voller Ruhe, Natur und Geschmack. Genießen Sie 100 % vegane vietnamesische Küche in entspannter Gartenatmosphäre.')); ?>
          </p>

          <div class="welcome-events-box" style="margin: 20px 0 24px; padding: 20px 22px; background: #F6F1E7; border: 1px solid rgba(169, 130, 36, 0.3); border-left: 4px solid #A98224; border-radius: 14px; box-shadow: 0 4px 18px rgba(169, 130, 36, 0.08);">
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #2A160F; margin: 0 0 13px 0; display: flex; align-items: center; gap: 9px; font-family: 'Playfair Display', serif;">
              <i class="fa-solid fa-champagne-glasses" style="color: #A98224;"></i>
              <span><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('welcome_box_title', 'Viel Platz für besondere Momente') : 'Viel Platz für besondere Momente'); ?></span>
            </h3>

            <div class="welcome-feature-pills" style="display: flex; flex-wrap: wrap; gap: 9px; margin-bottom: 12px;">
              <?php
              $line1 = function_exists('vg_get_option') ? vg_get_option('welcome_box_line1', '100 Plätze innen • ca. 100 Plätze im Garten') : '100 Plätze innen • ca. 100 Plätze im Garten';
              $line2 = function_exists('vg_get_option') ? vg_get_option('welcome_box_line2', 'VIP-Raum bis 20 Personen • Bühne') : 'VIP-Raum bis 20 Personen • Bühne';
              $raw_items = array();
              foreach (array($line1, $line2) as $l) {
                  if (!empty($l)) {
                      $parts = preg_split('/[•\n\r]+/', $l);
                      foreach ($parts as $p) {
                          $p = trim($p);
                          if (!empty($p)) $raw_items[] = $p;
                      }
                  }
              }
              foreach ($raw_items as $item):
              ?>
                <div class="welcome-pill-box" style="background: #FFFFFF; color: #2A160F; border: 1px solid rgba(169, 130, 36, 0.25); padding: 7px 15px; border-radius: 30px; font-size: 0.86rem; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(42, 22, 15, 0.04); transition: all 0.2s ease;">
                  <i class="fa-solid fa-check" style="color: #A98224;"></i>
                  <span><?php echo esc_html($item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>

            <p style="font-size: 0.84rem; color: #736b63; margin: 0; font-style: italic;">
              <?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('welcome_box_note', 'Ideal für Geburtstage, Firmenfeiern, Gruppen & Events') : 'Ideal für Geburtstage, Firmenfeiern, Gruppen & Events'); ?>
            </p>
          </div>

          <div>
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary">MEHR ÜBER UNS</a>
          </div>
        </div>
        <?php
        $vid_url = function_exists('vg_get_option') ? vg_get_option('welcome_video_url', 'https://www.youtube.com/watch?v=g2DIB_n3434') : 'https://www.youtube.com/watch?v=g2DIB_n3434';
        $vid_img = function_exists('vg_get_option') ? vg_get_option('welcome_video_img', home_url('/images/garden_preview.jpg')) : home_url('/images/garden_preview.jpg');
        $vid_cap = function_exists('vg_get_option') ? vg_get_option('welcome_video_caption', 'Ein kurzer Einblick in unseren Garten') : 'Ein kurzer Einblick in unseren Garten';
        ?>
        <a href="<?php echo esc_url($vid_url); ?>" target="_blank" rel="noopener noreferrer" class="video-card js-open-video" id="videoCard" title="Vegan Garden Berlin Video auf YouTube ansehen" style="text-decoration: none; display: block;">
          <img src="<?php echo esc_url($vid_img); ?>" alt="Vegan Garden Berlin Video Preview">
          <div class="video-overlay">
            <div class="play-btn">
              <i class="fa-solid fa-play"></i>
            </div>
            <div class="video-caption"><?php echo esc_html($vid_cap); ?></div>
          </div>
        </a>
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
              <span style="font-weight: 800; font-size: 1.15rem; color: #211A16; line-height: 1;"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('reviews_score', '4,8') : '4,8'); ?></span>
              <div class="rating-stars" style="color: #FBBC04; font-size: 1rem; display: flex; gap: 2px;">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
            <div class="rating-score" style="font-weight: 600; color: #6A625A; font-size: 0.85rem; margin-top: 2px;"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('reviews_count_text', '285+ Google Bewertungen') : '285+ Google Bewertungen'); ?></div>
          </div>
        </div>
      </div>

      <!-- Slider Container with Side Arrows -->
      <div class="slider-container-wrap">
        <button class="side-arrow side-arrow--prev" id="reviewsPrev" aria-label="Vorherige Bewertung">
          <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="reviews-card-slider" id="reviewsSlider">
          <?php
          $reviews = function_exists('vg_get_reviews') ? vg_get_reviews() : array();
          if (empty($reviews)) {
              $reviews = array(
                  array('name' => 'René Fleischmann', 'color' => '#e65100', 'initial' => 'R', 'rating' => 5, 'text' => 'Authentisch, lecker, vegan, alles frisch zubereitet, selbst die Soßen. Die hausgemachten Drinks sind der Hammer.'),
                  array('name' => 'Jana Flohr', 'color' => '#7b1fa2', 'initial' => 'J', 'rating' => 5, 'text' => 'We had delicious, incredibly fresh, and beautifully presented food... highly recommended! And then there was the wonderful Karl Marx Avenue... We\'ll be back!'),
                  array('name' => 'frodo aus_dem_auenland', 'color' => '#2e7d32', 'initial' => 'F', 'rating' => 5, 'text' => 'Sehr schönes Restaurant mit leckeren ansprechenden Gerichten in Bio-Qualität. Geschmackvolle Einrichtung, das Essen und der Tee werden mit Liebe zubereitet. Hebt sich wirklich ab!'),
                  array('name' => 'Papadopoulos Pipotimus', 'color' => '#1565c0', 'initial' => 'P', 'rating' => 5, 'text' => 'Love it. Der Raum ist groß und trotz der Nähe zur Frankfurter Allee sehr ruhig, durch die Abendsonne beleuchten. Das Hauptgericht war eine große Suppe mit frischem Tofu. Alles in allem, geht hin!'),
                  array('name' => 'Anna L.', 'color' => '#00838f', 'initial' => 'A', 'rating' => 5, 'text' => 'Wunderschöner Ort, tolles Ambiente und das Essen ist einfach fantastisch! Die veganen Sommerrollen sind ein absolutes Highlight.'),
              );
          }
          foreach ($reviews as $rev):
          ?>
          <div class="review-box">
            <div class="review-box-header">
              <div class="review-avatar" style="background: <?php echo esc_attr($rev['color']); ?>;"><?php echo esc_html($rev['initial']); ?></div>
              <div>
                <div class="review-author-name"><?php echo esc_html($rev['name']); ?></div>
              </div>
            </div>
            <div class="review-stars">
              <?php for ($s = 0; $s < $rev['rating']; $s++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
            </div>
            <p class="review-text">"<?php echo esc_html($rev['text']); ?>"</p>
          </div>
          <?php endforeach; ?>
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
          <?php
          $dishes = function_exists('vg_get_dishes') ? vg_get_dishes() : array();
          if (empty($dishes)) {
              $dishes = array(
                  array('name' => 'Knusprige Frühlingsrollen', 'price' => '5,90 €', 'image' => home_url('/images/nem_ran.jpg')),
                  array('name' => 'Vier Schätze in Chao-Soße', 'price' => '13,90 €', 'image' => home_url('/images/tu_buu_kho_chao.jpg')),
                  array('name' => 'Thailändischer Feuertopf', 'price' => 'ab 35,90 €', 'image' => home_url('/images/lau_thai.jpg')),
                  array('name' => 'Vegan Garden Rollen', 'price' => '6,50 €', 'image' => home_url('/images/vegan_garden_rollen.jpg')),
                  array('name' => 'Vegan Garden Reisnudel-Bowl', 'price' => '13,90 €', 'image' => home_url('/images/summer_bowl.jpg')),
                  array('name' => 'Thailändische Reisnudelsuppe', 'price' => '13,90 €', 'image' => home_url('/images/thai_reisnudelsuppe.jpg')),
                  array('name' => 'Tofu Royal', 'price' => '6,50 €', 'image' => home_url('/images/spargel.jpg')),
              );
          }
          foreach ($dishes as $dish):
          ?>
          <div class="food-card">
            <div class="food-img-wrap">
              <img src="<?php echo esc_url($dish['image']); ?>" alt="<?php echo esc_attr($dish['name']); ?>" loading="lazy">
            </div>
            <div class="food-info">
              <h3 class="food-name"><?php echo esc_html($dish['name']); ?></h3>
              <div class="food-price"><?php echo esc_html($dish['price']); ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button class="side-arrow side-arrow--next" id="highlightsNext" aria-label="Nächstes Gericht">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>

      <?php $pdf_url = function_exists('vg_get_option') ? vg_get_option('menu_pdf', home_url('/menu/Druck_Speisekarte_VeganGarden.pdf')) : home_url('/menu/Druck_Speisekarte_VeganGarden.pdf'); ?>
      <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="noopener" class="btn btn-primary menu-pdf-btn" style="margin-top: 32px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
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
          <img src="<?php echo esc_url(function_exists('vg_get_option') ? vg_get_option('event1_img', home_url('/images/sommergarten.jpg?v=20260903_sommergarten4')) : home_url('/images/sommergarten.jpg?v=20260903_sommergarten4')); ?>" alt="<?php echo esc_attr(function_exists('vg_get_option') ? vg_get_option('event1_title', 'SOMMERGARTEN') : 'SOMMERGARTEN'); ?>">
          <div class="event-overlay">
            <h3 class="event-title"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('event1_title', 'SOMMERGARTEN') : 'SOMMERGARTEN'); ?></h3>
            <p class="event-subtitle"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('event1_sub', 'Über 100 Plätze im Grünen') : 'Über 100 Plätze im Grünen'); ?></p>
          </div>
        </div>

        <!-- Banner 2 -->
        <div class="event-banner">
          <img src="<?php echo esc_url(function_exists('vg_get_option') ? vg_get_option('event2_img', home_url('/images/restaurant.jpg?v=20260903_restaurant4')) : home_url('/images/restaurant.jpg?v=20260903_restaurant4')); ?>" alt="<?php echo esc_attr(function_exists('vg_get_option') ? vg_get_option('event2_title', 'RESTAURANT') : 'RESTAURANT'); ?>">
          <div class="event-overlay">
            <h3 class="event-title"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('event2_title', 'RESTAURANT') : 'RESTAURANT'); ?></h3>
            <p class="event-subtitle"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('event2_sub', 'Modern, gemütlich & entspannt') : 'Modern, gemütlich & entspannt'); ?></p>
          </div>
        </div>

        <!-- Banner 3 -->
        <div class="event-banner" id="events">
          <img src="<?php echo esc_url(function_exists('vg_get_option') ? vg_get_option('event3_img', home_url('/images/events.jpg?v=20260903_event5')) : home_url('/images/events.jpg?v=20260903_event5')); ?>" alt="<?php echo esc_attr(function_exists('vg_get_option') ? vg_get_option('event3_title', 'EVENTS & FEIERN') : 'EVENTS & FEIERN'); ?>">
          <div class="event-overlay">
            <h3 class="event-title"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('event3_title', 'EVENTS & FEIERN') : 'EVENTS & FEIERN'); ?></h3>
            <p class="event-subtitle"><?php echo esc_html(function_exists('vg_get_option') ? vg_get_option('event3_sub', 'Private & Exclusive') : 'Private & Exclusive'); ?></p>
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
          <?php
          $gallery = function_exists('vg_get_gallery') ? vg_get_gallery() : array();
          if (empty($gallery)) {
              $gallery = array(
                  array('title' => 'Vegan Garden Berlin - Tu Buu Kho Chao', 'image' => home_url('/images/gallery/bo-tuu-kho-chao.png?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Lau Thai Feuertopf', 'image' => home_url('/images/gallery/lau.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Bun Bo Hue Nudelsuppe', 'image' => home_url('/images/gallery/bunbo.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Bun Thai Nudelsuppe', 'image' => home_url('/images/gallery/bunthai.png?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Frischer grüner Spargel', 'image' => home_url('/images/gallery/SPARGEL.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Knusprige Frühlingsrollen', 'image' => home_url('/images/gallery/CHIHUONG28.084336-Edit.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Festliche vegane Speisen', 'image' => home_url('/images/gallery/4.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Gesunde Reisspezialitäten', 'image' => home_url('/images/gallery/CHIHUONG28.084466.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Vegane Spezialitäten', 'image' => home_url('/images/gallery/a.jpg?v=20260903_g')),
                  array('title' => 'Vegan Garden Berlin - Gemütliches Restaurant-Ambiente', 'image' => home_url('/images/gallery/CHIHUONG28.085441.jpg?v=20260903_g')),
              );
          }
          foreach ($gallery as $item):
          ?>
          <div class="insta-card">
            <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
          </div>
          <?php endforeach; ?>
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
          <?php
          $home_posts = get_posts(array(
              'post_type'      => 'post',
              'post_status'    => 'publish',
              'posts_per_page' => 4,
              'orderby'        => 'date',
              'order'          => 'DESC'
          ));
          if (!empty($home_posts)) :
              foreach ($home_posts as $post) :
                  setup_postdata($post);
                  $thumb = get_the_post_thumbnail_url($post->ID, 'large');
                  if (!$thumb) $thumb = get_post_meta($post->ID, '_article_custom_img', true) ?: home_url('/images/article_speisekarte.jpg');
                  $post_cats = get_the_category($post->ID);
                  $cat_name = !empty($post_cats) ? $post_cats[0]->name : 'JOURNAL';
                  $cat_filters = implode(' ', wp_list_pluck($post_cats, 'slug'));
          ?>
          <article class="news-card" data-category="<?php echo esc_attr($cat_filters); ?>">
            <a href="<?php the_permalink(); ?>" class="news-card__img-wrap">
              <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="news-card__img" loading="lazy">
              <span class="news-card__cat"><?php echo esc_html(mb_strtoupper(wp_specialchars_decode($cat_name, ENT_QUOTES))); ?></span>
            </a>
            <div class="news-card__body">
              <h3 class="news-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
              <a href="<?php the_permalink(); ?>" class="news-card__more">
                <span class="more-txt">Artikel lesen</span>
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </article>
          <?php
              endforeach;
              wp_reset_postdata();
          endif;
          ?>
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

