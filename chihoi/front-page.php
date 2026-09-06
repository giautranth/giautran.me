<?php get_header(); ?>


            <?php
  // Truy vấn Banners từ CPT home_banner
  $banner_query = new WP_Query(array(
      'post_type' => 'home_banner',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish',
  ));
  
  $slides = array();
  if ($banner_query->have_posts()) {
      while ($banner_query->have_posts()) {
          $banner_query->the_post();
          $img_pc = get_post_meta(get_the_ID(), '_banner_img_pc', true);
          $img_mb = get_post_meta(get_the_ID(), '_banner_img_mb', true);
          $link = get_post_meta(get_the_ID(), '_banner_link', true);
          if ($img_pc) {
              $slides[] = array(
                  'title' => get_the_title(),
                  'img_pc' => $img_pc,
                  'img_mb' => $img_mb ?: $img_pc,
                  'link' => $link,
              );
          }
      }
      wp_reset_postdata();
  }

  // Dự phòng nếu chưa có banner nào được tạo trong admin
  if (empty($slides)) {
      $slides = array(
          array(
              'title' => 'Chi hội Bệnh viện Tư nhân TP. Hồ Chí Minh và các tỉnh phía Nam - Lễ ra mắt Ban Chấp hành',
              'img_pc' => get_template_directory_uri() . '/photo/banner/1.png',
              'img_mb' => get_template_directory_uri() . '/photo/banner/2.png',
              'link' => '',
          ),
          array(
              'title' => 'Chi hội Bệnh viện Tư nhân TP. Hồ Chí Minh và các tỉnh phía Nam - Đoàn kết Hợp tác Phát triển',
              'img_pc' => get_template_directory_uri() . '/photo/banner/5.png',
              'img_mb' => get_template_directory_uri() . '/photo/banner/3.png',
              'link' => '',
          ),
      );
  }
  $slide_count = count($slides);
  ?>
  <!-- ========== AIH PANORAMIC HERO BANNER (Động CMS) ========== -->
  <section class="home-banner banner-slider aih-hero-banner-section">
    <div class="banner-carousel-wrapper">
      <div class="banner-slides-track">
        <?php foreach ($slides as $idx => $s): ?>
        <div class="banner-slide <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo $idx; ?>">
          <div class="image img-cover">
            <?php if (!empty($s['link'])): ?><a href="<?php echo esc_url($s['link']); ?>" style="display:block;width:100%;height:100%;"><?php endif; ?>
            <picture>
              <source media="(max-width: 767.98px)" srcset="<?php echo esc_url($s['img_mb']); ?>">
              <img src="<?php echo esc_url($s['img_pc']); ?>" alt="<?php echo esc_attr($s['title']); ?>" class="banner-img" <?php echo $idx === 0 ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
            </picture>
            <?php if (!empty($s['link'])): ?></a><?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- AIH Swiper Navigation Arrows -->
      <?php if ($slide_count > 1): ?>
      <div class="swiper-button banner-nav-arrows">
        <button type="button" class="button-prev" id="bannerPrevBtn" aria-label="Banner trước">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button type="button" class="button-next" id="bannerNextBtn" aria-label="Banner tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
      </div>

      <!-- AIH Swiper Pagination Dots -->
      <div class="banner-pagination-dots">
        <?php for ($i = 0; $i < $slide_count; $i++): ?>
        <button type="button" class="carousel-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo $i; ?>" aria-label="Chuyển đến banner <?php echo $i + 1; ?>"></button>
        <?php endfor; ?>
      </div>
      <?php endif; ?>

    </div>
  </section>

    <!-- ========== 2. VỀ CHI HỘI (HERO BANNER) ========== -->
  <section class="site-section" style="padding-top: 36px; padding-bottom: 10px;">
    <div class="container">
      <div class="fv-hero-card" style="margin-top: 0; margin-bottom: 0;">
                        <div class="fv-hero-content-col">
                    <!-- Floating Medical Crosses -->
          <svg class="fv-medical-cross fv-cross-1" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14 4V24M4 14H24" stroke="#38bdf8" stroke-width="2.8" stroke-linecap="round"/>
          </svg>
          <svg class="fv-medical-cross fv-cross-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 3V17M3 10H17" stroke="#38bdf8" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
          <svg class="fv-medical-cross fv-cross-3" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 3.5V18.5M3.5 11H18.5" stroke="#38bdf8" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
          <h2 class="fv-hero-title">VỀ CHI HỘI</h2>
          <p class="fv-hero-paragraph">
            Ngày 19/8/2026, Hiệp hội Bệnh viện Tư nhân Việt Nam chính thức tổ chức Hội nghị lần thứ nhất và Lễ ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP. HCM và các tỉnh, thành phía nam nhiệm kỳ 2026 - 2029.
          </p>
          <p class="fv-hero-paragraph">
            Việc thành lập Chi hội giúp tăng cường liên kết chuyên môn, quy tụ nguồn lực, phát huy thế mạnh giữa các bệnh viện thành viên, đẩy mạnh hoạt động đào tạo, nghiên cứu khoa học và chuyển đổi số y tế, góp phần tích cực cùng hệ thống y tế công lập trong sự nghiệp chăm sóc, bảo vệ sức khỏe nhân dân.
          </p>
          <div class="fv-hero-btn-wrap" style="margin-top: 10px; margin-bottom: 8px; padding-left: 22px;">
            <a href="<?php echo home_url('/ve-chi-hoi/'); ?>" class="about-hero-btn">Xem thêm</a>
          </div>
        </div>

        <div class="fv-hero-image-col">
          <img src="<?php echo get_template_directory_uri(); ?>/photo/hinh-anh-video/3.jpg" alt="Lễ ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân phía Nam" class="fv-hero-main-img" />
        </div>
      </div>
    </div>
  </section>

<!-- ========== 3. HỘI VIÊN CHI HỘI (Infinite Loop Carousel Động) ========== -->
  <?php
  $members_q = new WP_Query(array(
      'post_type' => 'member_hospital',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish',
  ));
  $member_items = array();
  if ($members_q->have_posts()) {
      while ($members_q->have_posts()) {
          $members_q->the_post();
          $logo = get_the_post_thumbnail_url(get_the_ID(), 'full');
          $site = get_post_meta(get_the_ID(), '_member_website', true);
          if ($logo) {
              $member_items[] = array('name' => get_the_title(), 'logo' => $logo, 'url' => $site);
          }
      }
      wp_reset_postdata();
  }
  if (empty($member_items)) {
      $default_logos = array(
          array('name' => 'Bệnh viện Gia An 115', 'logo' => get_template_directory_uri() . '/photo/logo/giaan115-.jpg'),
          array('name' => 'Bệnh viện Quốc tế City', 'logo' => get_template_directory_uri() . '/photo/logo/CIH.png'),
          array('name' => 'Bệnh viện FV', 'logo' => get_template_directory_uri() . '/photo/logo/fv.png'),
          array('name' => 'Bệnh viện Phương Nam', 'logo' => get_template_directory_uri() . '/photo/logo/phuongnam.png'),
          array('name' => 'Bệnh viện Nam Sài Gòn', 'logo' => get_template_directory_uri() . '/photo/logo/namsaigon.jpg'),
          array('name' => 'Bệnh viện Vinmec Central Park', 'logo' => get_template_directory_uri() . '/photo/logo/vinmec.png'),
          array('name' => 'Bệnh viện Columbia Asia', 'logo' => get_template_directory_uri() . '/photo/logo/colombia.png'),
          array('name' => 'Bệnh viện ĐK Quốc tế S.I.S Cần Thơ', 'logo' => get_template_directory_uri() . '/photo/logo/sis.png'),
          array('name' => 'Bệnh viện Minh Anh', 'logo' => get_template_directory_uri() . '/photo/logo/minhanh.png'),
          array('name' => 'Bệnh viện Hoàn Mỹ', 'logo' => get_template_directory_uri() . '/photo/logo/hoanmy.webp'),
          array('name' => 'Đại học Quốc tế Hồng Bàng', 'logo' => get_template_directory_uri() . '/photo/logo/hongbang.png'),
          array('name' => 'Trung tâm Y khoa Medic - Hòa Hảo', 'logo' => get_template_directory_uri() . '/photo/logo/medic.webp'),
          array('name' => 'Bệnh viện Sài Gòn ITO', 'logo' => get_template_directory_uri() . '/photo/logo/saigon-iot.jpg'),
          array('name' => 'Bệnh viện Đa khoa Tân Hưng', 'logo' => get_template_directory_uri() . '/photo/logo/tanhung.png'),
          array('name' => 'Bệnh viện Triều An', 'logo' => get_template_directory_uri() . '/photo/logo/trieuan.png'),
          array('name' => 'Bệnh viện Việt Mỹ', 'logo' => get_template_directory_uri() . '/photo/logo/vietmy.png'),
      );
      $member_items = $default_logos;
  }
  ?>
  <section class="site-section bg-subtle">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">HỘI VIÊN CHI HỘI</div>
      </div>
      
      <div class="infinite-marquee-container">
        <button type="button" class="section-slider-arrow prev" onclick="nudgeMarquee('marqueeTrackLane1', -1)" aria-label="Lùi logo hội viên">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <div class="infinite-marquee-wrapper">
          <div class="infinite-marquee-track" id="marqueeTrackLane1">
            <!-- Set 1 -->
            <?php foreach ($member_items as $m): ?>
            <div class="member-partner-card" title="<?php echo esc_attr($m['name']); ?>">
              <?php if (!empty($m['url'])): ?><a href="<?php echo esc_url($m['url']); ?>" target="_blank" rel="noopener"><?php endif; ?>
              <img src="<?php echo esc_url($m['logo']); ?>" alt="<?php echo esc_attr($m['name']); ?>" loading="lazy" />
              <?php if (!empty($m['url'])): ?></a><?php endif; ?>
            </div>
            <?php endforeach; ?>
            
            <!-- Set 2 Duplicate (Seamless loop) -->
            <?php foreach ($member_items as $m): ?>
            <div class="member-partner-card" title="<?php echo esc_attr($m['name']); ?>" aria-hidden="true">
              <?php if (!empty($m['url'])): ?><a href="<?php echo esc_url($m['url']); ?>" target="_blank" rel="noopener" tabindex="-1"><?php endif; ?>
              <img src="<?php echo esc_url($m['logo']); ?>" alt="<?php echo esc_attr($m['name']); ?>" loading="lazy" />
              <?php if (!empty($m['url'])): ?></a><?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <button type="button" class="section-slider-arrow next" onclick="nudgeMarquee('marqueeTrackLane1', 1)" aria-label="Tiến logo hội viên">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
      </div>
    </div>
  </section>

  <!-- ========== 4. CHƯƠNG TRÌNH ĐÀO TẠO SECTION (Nền Trắng AIH) ========== -->
  <section class="site-section">
    <div class="container">
      <div class="section-header-row">
        <div class="section-main-title">CHƯƠNG TRÌNH ĐÀO TẠO</div>
      </div>
      
      <!-- Filter Tabs -->
      <div class="filter-tabs-wrapper">
        <button class="tab-btn training-tab-btn active" data-filter="all">Tất cả</button>
        <button class="tab-btn training-tab-btn" data-filter="chieu-sinh">Thông báo chiêu sinh</button>
        <button class="tab-btn training-tab-btn" data-filter="nghien-cuu">Nghiên cứu khoa học</button>
      </div>

      <!-- Training Cards Grid (3 Cards hiển thị trang chủ) -->
            <!-- Training Slider Container with Left & Right Navigation Arrows -->
      <div class="section-slider-container">
        <button type="button" class="section-slider-arrow prev" onclick="scrollSectionCards('training-cards-grid', -1)" aria-label="Xem khóa học trước">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <div class="training-cards-grid" id="training-cards-grid">
        <!-- Card: Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – Khóa 2 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-tang-cuong-nang-luc-quan-ly-dieu-duong-khoa-2" class="cme-card-thumb-link" style="display:block;text-decoration:none;">
            <div class="cme-card-thumb-wrap">
              <img src="photo/dao-tao/13.png" alt="Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – Khóa 2" class="cme-card-thumb-img" />
            </div>
          </a>
          <div class="cme-card-body" style="padding:16px 18px 14px;display:flex;flex-direction:column;justify-content:space-between;background:#ffffff;">
            <div>
              <div style="display:flex;align-items:center;margin-bottom:12px;">
                <span style="font-size:0.84rem;color:#64748b;font-weight:600;display:flex;align-items:center;gap:6px;">
                  <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  22/07/2026
                </span>
              </div>
              <h3 class="cme-card-title" style="font-size:1.04rem;font-weight:700;color:#111827;line-height:1.6;text-align:justify;margin-bottom:0;">
                <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-tang-cuong-nang-luc-quan-ly-dieu-duong-khoa-2" style="color:#111827;text-decoration:none;transition:color 0.2s;">Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – Khóa 2</a>
              </h3>
            </div>
            <div class="cme-card-footer">
              <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-tang-cuong-nang-luc-quan-ly-dieu-duong-khoa-2" class="link-read-more" style="font-weight:700;color:#2C3691;text-decoration:none;">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card: Thông báo chiêu sinh khóa Đào tạo cập nhật kiến thức y khoa liên tục (CME) – An toàn người bệnh – Khóa 4 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-cap-nhat-kien-thuc-y-khoa-lien-tuc-cme-an-toan-nguoi-benh-khoa-4" class="cme-card-thumb-link" style="display:block;text-decoration:none;">
            <div class="cme-card-thumb-wrap">
              <img src="photo/dao-tao/11.png" alt="Thông báo chiêu sinh khóa Đào tạo cập nhật kiến thức y khoa liên tục (CME) – An toàn người bệnh – Khóa 4" class="cme-card-thumb-img" />
            </div>
          </a>
          <div class="cme-card-body" style="padding:16px 18px 14px;display:flex;flex-direction:column;justify-content:space-between;background:#ffffff;">
            <div>
              <div style="display:flex;align-items:center;margin-bottom:12px;">
                <span style="font-size:0.84rem;color:#64748b;font-weight:600;display:flex;align-items:center;gap:6px;">
                  <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  15/08/2026
                </span>
              </div>
              <h3 class="cme-card-title" style="font-size:1.04rem;font-weight:700;color:#111827;line-height:1.6;text-align:justify;margin-bottom:0;">
                <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-cap-nhat-kien-thuc-y-khoa-lien-tuc-cme-an-toan-nguoi-benh-khoa-4" style="color:#111827;text-decoration:none;transition:color 0.2s;">Thông báo chiêu sinh khóa Đào tạo cập nhật kiến thức y khoa liên tục (CME) – An toàn người bệnh – Khóa 4</a>
              </h3>
            </div>
            <div class="cme-card-footer">
              <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-cap-nhat-kien-thuc-y-khoa-lien-tuc-cme-an-toan-nguoi-benh-khoa-4" class="link-read-more" style="font-weight:700;color:#2C3691;text-decoration:none;">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card: Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – Khóa 3 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-hoi-sinh-tim-phoi-co-ban-khoa-3" class="cme-card-thumb-link" style="display:block;text-decoration:none;">
            <div class="cme-card-thumb-wrap">
              <img src="photo/dao-tao/12.png" alt="Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – Khóa 3" class="cme-card-thumb-img" />
            </div>
          </a>
          <div class="cme-card-body" style="padding:16px 18px 14px;display:flex;flex-direction:column;justify-content:space-between;background:#ffffff;">
            <div>
              <div style="display:flex;align-items:center;margin-bottom:12px;">
                <span style="font-size:0.84rem;color:#64748b;font-weight:600;display:flex;align-items:center;gap:6px;">
                  <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  09/07/2026
                </span>
              </div>
              <h3 class="cme-card-title" style="font-size:1.04rem;font-weight:700;color:#111827;line-height:1.6;text-align:justify;margin-bottom:0;">
                <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-hoi-sinh-tim-phoi-co-ban-khoa-3" style="color:#111827;text-decoration:none;transition:color 0.2s;">Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – Khóa 3</a>
              </h3>
            </div>
            <div class="cme-card-footer">
              <a href="dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-hoi-sinh-tim-phoi-co-ban-khoa-3" class="link-read-more" style="font-weight:700;color:#2C3691;text-decoration:none;">Xem thêm →</a>
            </div>
          </div>
        </div>

      </div>

        <button type="button" class="section-slider-arrow next" onclick="scrollSectionCards('training-cards-grid', 1)" aria-label="Xem khóa học tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>

      <div style="text-align: center; margin-top: 32px;">
        <a href="dao-tao" class="btn-aih-navy">Xem tất cả</a>
      </div>
    </div>
  </section>

  <!-- ========== 5. TIN TỨC SECTION (Chuẩn Tin Tức AIH) ========== -->
  <section class="site-section bg-subtle">
    <div class="container">
      <div class="section-header-row">
        <div class="section-main-title">TIN TỨC</div>
      </div>
      
      <!-- Filter Tabs -->
      <div class="filter-tabs-wrapper">
        <button class="tab-btn news-tab-btn active" data-filter="all">Tất cả</button>
        <button class="tab-btn news-tab-btn" data-filter="chi-hoi">Tin tức chi hội</button>
        <button class="tab-btn news-tab-btn" data-filter="su-kien">Sự kiện</button>
      </div>

      <!-- News Cards Grid -->
            <!-- News Slider Container with Left & Right Navigation Arrows -->
      <div class="section-slider-container">
        <button type="button" class="section-slider-arrow prev" onclick="scrollSectionCards('news-cards-grid', -1)" aria-label="Xem tin trước">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <div class="news-cards-grid" id="news-cards-grid">
        <!-- Card 1: Madam Trần Thị Lâm giữ vai trò Chủ tịch Chi hội -->
        <div class="news-article-card" data-category="chi-hoi">
          <a href="tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam/" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="photo/news/news-cih-madam-lam.webp" alt="Madam Trần Thị Lâm giữ vai trò Chủ tịch Chi hội" class="news-thumbnail-img" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>21/07/2026</div>
              <h3 class="news-card-title">
                <a href="tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam/" style="color:inherit;text-decoration:none;">
                  Kết nối sức mạnh y tế tư nhân phía Nam: Madam Trần Thị Lâm giữ vai trò Chủ tịch Chi hội
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam/" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 2: Ra mắt Ban Chấp hành Chi hội -->
        <div class="news-article-card" data-category="su-kien">
          <a href="tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm/" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="photo/news/news-cih-ra-mat-bch.webp" alt="Ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP.HCM" class="news-thumbnail-img" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>19/08/2026</div>
              <h3 class="news-card-title">
                <a href="tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm/" style="color:inherit;text-decoration:none;">
                  Ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh, thành phía Nam
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm/" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 3: Diễn đàn Phát triển Y tế tư nhân Việt Nam năm 2026 -->
        <div class="news-article-card" data-category="su-kien">
          <a href="tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026/" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="photo/news/news-dien-dan-y-te-2026.jpg" alt="Diễn đàn Phát triển Y tế tư nhân Việt Nam năm 2026" class="news-thumbnail-img" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>21/08/2026</div>
              <h3 class="news-card-title">
                <a href="tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026/" style="color:inherit;text-decoration:none;">
                  Diễn đàn phát triển y tế tư nhân Việt Nam năm 2026 (lần thứ II) thành công tốt đẹp
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026/" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>
      </div>

        <button type="button" class="section-slider-arrow next" onclick="scrollSectionCards('news-cards-grid', 1)" aria-label="Xem tin tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>

      <div style="text-align: center; margin-top: 32px;">
        <a href="tin-tuc" class="btn-aih-navy">Xem tất cả</a>
      </div>
    </div>
  </section>

      <!-- ========== HÌNH ẢNH NỔI BẬT SECTION (Single Featured Video) ========== -->
  <section class="site-section bg-subtle">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">HÌNH ẢNH NỔI BẬT</div>
      </div>

            <!-- Split Layout: 1 Big Left, 12 Photos Scrollable Right -->
            <!-- Split Layout: 1 Big Left (Media Viewer), Video + 12 Photos Scrollable Right -->
      <div class="facilities-split-layout">
        
        <!-- Left Big Featured Media View -->
        <div class="facilities-split__left">
                    <div class="facilities-main-view">
            <img id="facility-main-img" src="photo/hinh-anh-video/1.jpg" alt="Hình ảnh Chi hội Bệnh viện Tư nhân" class="facility-main-image" style="display:block;" />
            <div id="facility-main-video-wrap" class="facility-main-video-wrap" style="display:none;width:100%;height:100%;">
              <iframe id="facility-main-video-iframe" src="" title="Video Chi hội Bệnh viện Tư nhân" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%;height:100%;border:none;border-radius:20px;"></iframe>
            </div>
          </div>
        </div>

        <!-- Right Side Photos Grid -->
        <div class="facilities-split__right">
          <div class="facilities-side-grid">
            
            <!-- Video Item -->
            <div class="facility-side-card card-video" data-type="video" data-video="https://www.youtube.com/embed/_3A7urkzB6I" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/video-thumb.jpg" alt="Video Lễ Ra Mắt Chi Hội" loading="lazy" />
              <div class="video-play-overlay">
                <span class="video-play-icon">▶</span>
                <span class="video-card-badge">VIDEO SỰ KIỆN</span>
              </div>
            </div>

            <div class="facility-side-card active" data-type="image" data-src="photo/hinh-anh-video/1.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/1.jpg" alt="Hình ảnh Chi hội 1" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/2.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/2.jpg" alt="Hình ảnh Chi hội 2" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/3.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/3.jpg" alt="Hình ảnh Chi hội 3" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/4.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/4.jpg" alt="Hình ảnh Chi hội 4" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/5.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/5.jpg" alt="Hình ảnh Chi hội 5" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/6.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/6.jpg" alt="Hình ảnh Chi hội 6" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/7.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/7.jpg" alt="Hình ảnh Chi hội 7" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/8.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/8.jpg" alt="Hình ảnh Chi hội 8" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/9.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/9.jpg" alt="Hình ảnh Chi hội 9" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/10.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/10.jpg" alt="Hình ảnh Chi hội 10" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/11.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/11.jpg" alt="Hình ảnh Chi hội 11" loading="lazy" />
            </div>

            <div class="facility-side-card" data-type="image" data-src="photo/hinh-anh-video/12.jpg" onclick="switchFacilityMedia(this)">
              <img src="photo/hinh-anh-video/12.jpg" alt="Hình ảnh Chi hội 12" loading="lazy" />
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========== 6. ĐỐI TÁC ĐỒNG HÀNH SECTION (Infinite Loop Động) ========== -->
  <?php
  $partners_q = new WP_Query(array(
      'post_type' => 'partner_logo',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish',
  ));
  $partner_items = array();
  if ($partners_q->have_posts()) {
      while ($partners_q->have_posts()) {
          $partners_q->the_post();
          $logo = get_the_post_thumbnail_url(get_the_ID(), 'full');
          $site = get_post_meta(get_the_ID(), '_partner_url', true);
          if ($logo) {
              $partner_items[] = array('name' => get_the_title(), 'logo' => $logo, 'url' => $site);
          }
      }
      wp_reset_postdata();
  }
  if (empty($partner_items)) {
      $partner_items = array(
          array('name' => 'Tập đoàn Hoa Lâm', 'logo' => get_template_directory_uri() . '/photo/doitac/logo_hoalam.png'),
          array('name' => 'Bệnh viện Gia An 115', 'logo' => get_template_directory_uri() . '/photo/logo/giaan115-.jpg'),
          array('name' => 'Bệnh viện Quốc tế City', 'logo' => get_template_directory_uri() . '/photo/logo/CIH.png'),
          array('name' => 'Ngân hàng Vietbank', 'logo' => get_template_directory_uri() . '/photo/doitac/logo_vietbank.jpg'),
      );
  }
  ?>
  <section class="site-section">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">ĐỐI TÁC ĐỒNG HÀNH</div>
      </div>
      
      <div class="infinite-marquee-container">
        <button type="button" class="section-slider-arrow prev" onclick="nudgeMarquee('marqueeTrackPartner', -1)" aria-label="Lùi logo đối tác">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <div class="infinite-marquee-wrapper">
          <div class="infinite-marquee-track" id="marqueeTrackPartner">
            <!-- Set 1 -->
            <?php for ($repeat = 0; $repeat < (count($partner_items) < 8 ? 2 : 1); $repeat++): ?>
            <?php foreach ($partner_items as $p): ?>
            <div class="member-partner-card" title="<?php echo esc_attr($p['name']); ?>">
              <?php if (!empty($p['url'])): ?><a href="<?php echo esc_url($p['url']); ?>" target="_blank" rel="noopener"><?php endif; ?>
              <img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['name']); ?>" />
              <?php if (!empty($p['url'])): ?></a><?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endfor; ?>

            <!-- Set 2 Duplicate for seamless loop -->
            <?php for ($repeat = 0; $repeat < (count($partner_items) < 8 ? 2 : 1); $repeat++): ?>
            <?php foreach ($partner_items as $p): ?>
            <div class="member-partner-card" title="<?php echo esc_attr($p['name']); ?>" aria-hidden="true">
              <?php if (!empty($p['url'])): ?><a href="<?php echo esc_url($p['url']); ?>" target="_blank" rel="noopener" tabindex="-1"><?php endif; ?>
              <img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['name']); ?>" />
              <?php if (!empty($p['url'])): ?></a><?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endfor; ?>
          </div>
        </div>
        <button type="button" class="section-slider-arrow next" onclick="nudgeMarquee('marqueeTrackPartner', 1)" aria-label="Tiến logo đối tác">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
      </div>
    </div>
  </section>

  <!-- ========== FOOTER ========== -->
  

  

<?php get_footer(); ?>