<?php
/**
 * Template Name: Template Tin Tức Sự Kiện
 */
get_header(); ?>


<main class="site-section news-main-section" style="padding: 40px 0 28px; background: #f8fafc;">
  <style>
    .news-main-section {
      padding-bottom: 28px !important;
    }
    /* News Archive Grid Layout: 9 articles per page (3 columns x 3 rows) */
    .news-archive-grid {
      display: grid !important;
      grid-template-columns: repeat(3, 1fr) !important;
      gap: 28px !important;
      margin-bottom: 0 !important;
      width: 100% !important;
      box-sizing: border-box !important;
      overflow: visible !important;
    }

    .news-archive-grid .news-article-card {
      width: 100% !important;
      min-width: 0 !important;
      max-width: 100% !important;
      flex: none !important;
      margin: 0 !important;
      display: flex !important;
      flex-direction: column !important;
      background: #ffffff !important;
      border: 1px solid #e2e8f0 !important;
      border-radius: 14px !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
      overflow: hidden !important;
      transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
    }

    .news-archive-grid .news-article-card:hover {
      transform: translateY(-4px) !important;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08) !important;
      border-color: #cbd5e1 !important;
    }

    .news-archive-grid .news-card-thumbnail-wrap {
      position: relative !important;
      width: 100% !important;
      height: 205px !important;
      aspect-ratio: 16 / 9 !important;
      overflow: hidden !important;
      background: #f1f5f9 !important;
    }

    .news-archive-grid .news-thumbnail-img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      transition: transform 0.4s ease !important;
      display: block !important;
    }

    .news-archive-grid .news-article-card:hover .news-thumbnail-img {
      transform: scale(1.05) !important;
    }

    .news-archive-grid .news-card-body {
      padding: 20px 20px 18px !important;
      display: flex !important;
      flex-direction: column !important;
      flex: 1 !important;
      justify-content: space-between !important;
    }

    .news-archive-grid .news-publish-date {
      font-size: 0.82rem !important;
      color: #64748b !important;
      font-weight: 600 !important;
      margin-bottom: 10px !important;
      display: flex !important;
      align-items: center !important;
      gap: 6px !important;
    }

    .news-archive-grid .news-card-title {
      font-size: 1.05rem !important;
      font-weight: 700 !important;
      color: #1e293b !important;
      line-height: 1.5 !important;
      margin-bottom: 16px !important;
      display: -webkit-box !important;
      -webkit-line-clamp: 3 !important;
      -webkit-box-orient: vertical !important;
      overflow: hidden !important;
    }

    .news-archive-grid .news-card-title a {
      color: inherit !important;
      text-decoration: none !important;
      transition: color 0.2s ease !important;
    }

    .news-archive-grid .news-card-title a:hover {
      color: #2C3691 !important;
    }

    .news-archive-grid .news-card-footer {
      display: flex !important;
      justify-content: flex-end !important;
      align-items: center !important;
      padding-top: 14px !important;
      border-top: 1px solid #f1f5f9 !important;
    }

    .news-archive-grid .link-read-more {
      color: #2C3691 !important;
      font-weight: 700 !important;
      font-size: 0.88rem !important;
      text-decoration: none !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 4px !important;
      transition: transform 0.2s ease, color 0.2s ease !important;
    }

    .news-archive-grid .link-read-more:hover {
      color: #1e256b !important;
      transform: translateX(4px) !important;
    }

    /* Pagination */
    .news-pagination-wrap {
      margin: 40px 0 20px;
      display: flex;
      justify-content: center;
    }

    .news-pagination {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #ffffff;
      padding: 8px 14px;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .news-pagination .page-numbers {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 38px;
      height: 38px;
      padding: 0 12px;
      border-radius: 8px;
      border: 1px solid transparent;
      background: transparent;
      color: #475569;
      font-size: 0.92rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .news-pagination .page-numbers:hover {
      background: #f1f5f9;
      border-color: #cbd5e1;
      color: #2C3691;
    }

    .news-pagination .page-numbers.current {
      background: #2C3691 !important;
      border-color: #2C3691 !important;
      color: #ffffff !important;
      font-weight: 700;
      box-shadow: 0 4px 10px rgba(44, 54, 145, 0.25);
    }

    .news-pagination .page-numbers.dots {
      border: none;
      background: transparent;
      cursor: default;
      color: #94a3b8;
    }

    @media (max-width: 1024px) {
      .news-archive-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 22px !important;
      }
      .news-main-section {
        padding-bottom: 22px !important;
      }
    }

    @media (max-width: 680px) {
      .news-archive-grid {
        grid-template-columns: 1fr !important;
        gap: 18px !important;
        overflow-x: visible !important;
        flex-direction: unset !important;
        flex-wrap: unset !important;
      }
      .news-archive-grid .news-article-card {
        flex: none !important;
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
      }
      .news-main-section {
        padding-bottom: 18px !important;
      }
    }
  </style>

  <div class="container">
    
    <div class="section-header-row">
      <div class="section-main-title">TIN TỨC</div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs-wrapper" style="margin-bottom: 32px;">
      <button class="tab-btn news-tab-btn active" data-filter="all">Tất cả</button>
      <button class="tab-btn news-tab-btn" data-filter="chi-hoi">Tin tức chi hội</button>
      <button class="tab-btn news-tab-btn" data-filter="su-kien">Sự kiện</button>
    </div>

    <!-- News Archive Grid: 9 Posts Per Page -->
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
    $news_args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 9,
        'paged'          => $paged,
    );
    $news_query = new WP_Query($news_args);
    ?>

    <div class="news-cards-grid news-archive-grid" id="news-cards-grid">
      <?php if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); 
        $cats = wp_get_post_categories(get_the_ID(), array('fields' => 'slugs'));
        $cat_attr = !empty($cats) ? implode(' ', $cats) : 'chi-hoi';
        
        // Thumbnail resolution with fallback
        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$thumb_url) {
            $slug = get_post_field('post_name', get_the_ID());
            if (strpos($slug, 'be-giang') !== false) {
                $thumb_url = '/photo/news/news-be-giang-ceo-1.webp';
            } elseif (strpos($slug, 'madam-lam') !== false || strpos($slug, 'ket-noi') !== false) {
                $thumb_url = '/photo/news/news-cih-madam-lam.webp';
            } elseif (strpos($slug, 'ra-mat') !== false || strpos($slug, 'bch') !== false) {
                $thumb_url = '/photo/news/news-cih-ra-mat-bch.webp';
            } elseif (strpos($slug, 'dien-dan') !== false) {
                $thumb_url = '/photo/news/news-dien-dan-y-te-2026.jpg';
            } else {
                $thumb_url = '/photo/news/news-dien-dan-y-te-2026.jpg';
            }
        }
      ?>
        <div class="news-article-card" data-category="<?php echo esc_attr($cat_attr); ?>">
          <a href="<?php the_permalink(); ?>" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="news-thumbnail-img" loading="lazy" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg><?php echo get_the_date('d/m/Y'); ?>
              </div>
              <h3 class="news-card-title">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="<?php the_permalink(); ?>" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); else: ?>
        <p style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 40px 0;">Hiện chưa có bài viết nào.</p>
      <?php endif; ?>
    </div>

    <!-- Pagination for 9 posts per page -->
    <?php if ($news_query->max_num_pages > 1) : ?>
      <div class="news-pagination-wrap">
        <div class="news-pagination">
          <?php
          echo paginate_links(array(
              'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'format'    => '?paged=%#%',
              'current'   => max(1, $paged),
              'total'     => $news_query->max_num_pages,
              'prev_text' => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>',
              'next_text' => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>',
              'type'      => 'plain',
              'end_size'  => 2,
              'mid_size'  => 2,
          ));
          ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</main>

<!-- ========== FOOTER ========== -->
<?php get_footer(); ?>