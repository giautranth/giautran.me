<?php get_header(); ?>

<!-- ========== BREADCRUMB ========== -->
<div style="background:#f1f5f9;padding:14px 0;border-bottom:1px solid #e2e8f0;">
  <div class="container" style="font-size:0.88rem;color:#64748b;">
    <a href="<?php echo esc_url(home_url('/')); ?>" style="color:#2C3691;text-decoration:none;font-weight:600;">Trang chủ</a>
    <span style="margin:0 8px;color:#94a3b8;">/</span>
    <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color:#2C3691;text-decoration:none;font-weight:600;">Tin tức & Sự kiện</a>
    <span style="margin:0 8px;color:#94a3b8;">/</span>
    <span style="color:#0f172a;font-weight:700;"><?php the_title(); ?></span>
  </div>
</div>

<main class="site-section" style="padding: 40px 0 60px; background: #f8fafc;">
  <div class="container" style="max-width: 980px;">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <article class="single-article-card" style="background:#ffffff;border-radius:16px;padding:40px;box-shadow:0 4px 20px rgba(0,0,0,0.04);border:1px solid #e2e8f0;">
        
        <!-- Post Date & Category -->
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <span style="background:#eff6ff;color:#1d4ed8;padding:4px 12px;border-radius:50px;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">TIN TỨC CHI HỘI</span>
          <span style="font-size:0.88rem;color:#64748b;display:inline-flex;align-items:center;gap:6px;">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <?php the_time('d/m/Y'); ?>
          </span>
        </div>

        <!-- Title -->
        <h1 style="color:#1e3a8a;font-size:2rem;font-weight:800;line-height:1.4;margin-bottom:24px;letter-spacing:-0.5px;">
          <?php the_title(); ?>
        </h1>

        <!-- Content -->
        <div class="entry-content article-rich-body" style="line-height:1.85;color:#334155;font-size:1.05rem;">
          <?php the_content(); ?>
        </div>

        <!-- Back to news button -->
        <div style="margin-top:40px;padding-top:24px;border-top:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;">
          <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="display:inline-flex;align-items:center;gap:8px;color:#2C3691;text-decoration:none;font-weight:700;font-size:0.95rem;">
            ← Quay lại danh sách tin tức
          </a>
        </div>

      </article>

    <?php endwhile; endif; ?>

    <!-- ========== TIN TỨC LIÊN QUAN (Layout 3 Box Chuẩn AIH) ========== -->
    <?php
    $current_id = get_the_ID();
    $related_query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => array($current_id),
        'orderby' => 'date',
        'order' => 'DESC',
    ));

    if ($related_query->have_posts()) :
    ?>
    <section class="related-news-section" style="margin-top: 48px; padding-top: 36px; border-top: 2px solid #e2e8f0;">
      <div class="section-header-row" style="margin-bottom: 24px;">
        <div class="section-main-title">TIN TỨC LIÊN QUAN</div>
      </div>

      <div class="section-slider-container">
        <button type="button" class="section-slider-arrow prev" onclick="scrollSectionCards('related-news-grid', -1)" aria-label="Xem tin trước">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <div class="news-cards-grid" id="related-news-grid">
          <?php while ($related_query->have_posts()) : $related_query->the_post(); 
            $rel_thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
            if (!$rel_thumb_url) {
                $slug = get_post_field('post_name', get_the_ID());
                if (strpos($slug, 'be-giang') !== false) {
                    $rel_thumb_url = home_url('/photo/news/news-be-giang-ceo-1.webp');
                } elseif (strpos($slug, 'madam-lam') !== false || strpos($slug, 'ket-noi') !== false) {
                    $rel_thumb_url = home_url('/photo/news/news-cih-madam-lam.webp');
                } elseif (strpos($slug, 'ra-mat') !== false || strpos($slug, 'bch') !== false) {
                    $rel_thumb_url = home_url('/photo/news/news-cih-ra-mat-bch.webp');
                } elseif (strpos($slug, 'dien-dan') !== false) {
                    $rel_thumb_url = home_url('/photo/news/news-dien-dan-y-te-2026.jpg');
                } else {
                    $rel_thumb_url = home_url('/photo/news/news-dien-dan-y-te-2026.jpg');
                }
            }
          ?>
            <div class="news-article-card" data-category="chi-hoi">
              <a href="<?php the_permalink(); ?>" class="news-card-thumbnail-wrap" style="display:block;">
                <img src="<?php echo esc_url($rel_thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="news-thumbnail-img" />
              </a>
              <div class="news-card-body">
                <div>
                  <div class="news-publish-date">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <?php the_time('d/m/Y'); ?>
                  </div>
                  <h3 class="news-card-title">
                    <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;">
                      <?php the_title(); ?>
                    </a>
                  </h3>
                </div>
                <div class="news-card-footer">
                  <a href="<?php the_permalink(); ?>" class="link-read-more">Xem thêm →</a>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <button type="button" class="section-slider-arrow next" onclick="scrollSectionCards('related-news-grid', 1)" aria-label="Xem tin tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>
    </section>
    <?php endif; ?>

  </div>
</main>

<style>
.article-rich-body img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  margin: 20px 0;
  display: block;
}
.article-rich-body p {
  margin-bottom: 18px;
}
@media (max-width: 640px) {
  .single-article-card {
    padding: 24px 18px !important;
  }
  .single-article-card h1 {
    font-size: 1.5rem !important;
  }
}
</style>

<?php get_footer(); ?>
