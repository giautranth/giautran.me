<?php get_header(); ?>


    <!-- ========== AIH PANORAMIC HERO BANNER SECTION (Kích thước 1536 x 536) ========== -->
  <section class="aih-hero-banner-section">
    
    <!-- Circular White Slider Arrows with Blue Icons -->
    <button type="button" class="aih-slider-arrow prev" id="bannerPrevBtn" aria-label="Slide trước">
      <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" class="aih-slider-arrow next" id="bannerNextBtn" aria-label="Slide tiếp">
      <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- Banner Slides Wrapper -->
    <div class="aih-banner-slides-wrap">
      
      <!-- Slide 1: Lễ Công Bố Quyết Định Thành Lập Chi Hội & Ra Mắt Ban Chấp Hành -->
      <div class="aih-hero-slide banner-slide active">
        <img src="photo/banner/banner_bch_1.jpg" alt="Công Bố Quyết Định Thành Lập Chi Hội Và Quyết Định Công Nhận Ban Chấp Hành" class="aih-banner-full-img" />
      </div>

      <!-- Slide 2: Lễ Ra Mắt Ban Chấp Hành Chi Hội Bệnh Viện Tư Nhân Phía Nam -->
      <div class="aih-hero-slide banner-slide">
        <img src="photo/banner/banner_bch_2.jpg" alt="Lễ Công Bố & Ra Mắt Ban Chấp Hành Chi Hội Bệnh Viện Tư Nhân TP.HCM Và Các Tỉnh Phía Nam" class="aih-banner-full-img" />
      </div>

    </div>

    <!-- Slider Dots Indicator -->
    <div class="aih-slider-dots">
      <span class="carousel-dot active" data-slide-index="0" aria-label="Chuyển đến Slide 1"></span>
      <span class="carousel-dot" data-slide-index="1" aria-label="Chuyển đến Slide 2"></span>
    </div>

  </section>

  <!-- ========== 2. GIỚI THIỆU SECTION ========== -->
  <section class="site-section">
    <div class="container">
      <div class="section-label-tag">GIỚI THIỆU</div>
      <div class="white-box-card intro-content-container">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;flex-wrap:wrap;">
          <span style="background:#fee2e2;color:#e22b27;font-size:0.8rem;font-weight:800;padding:4px 12px;border-radius:999px;">
            PHƯƠNG CHÂM HOẠT ĐỘNG
          </span>
          <strong style="color:#2C3691;font-size:1.05rem;letter-spacing:0.3px;">
            "Đoàn kết – Hợp tác – Phát triển bền vững"
          </strong>
        </div>

        <p class="intro-lead-text">
          <strong>Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam</strong> là tổ chức xã hội - nghề nghiệp trực thuộc Hiệp hội Bệnh viện Tư nhân Việt Nam, quy tụ các bệnh viện, phòng khám đa khoa - chuyên khoa tư nhân tiêu biểu tại khu vực TP.HCM và các tỉnh, thành phố phía Nam.
        </p>
        <p style="font-size:0.95rem;color:#334e68;line-height:1.7;margin-bottom:18px;">
          Với sứ mệnh là cầu nối vững chắc giữa khối y tế tư nhân với các cơ quan quản lý nhà nước và cộng đồng người bệnh, Chi hội không ngừng nâng cao chất lượng quản trị bệnh viện, triển khai <strong>8 Chương trình trọng điểm</strong> về liên kết chuyên môn, đào tạo CME, chuyển đổi số - AI và bảo vệ quyền lợi hội viên.
        </p>
        
        <div class="intro-features-grid">
          <div class="intro-stat-item">
            <div class="stat-number">50+</div>
            <div class="stat-label">Bệnh viện & PK Hội viên</div>
          </div>
          <div class="intro-stat-item">
            <div class="stat-number">08</div>
            <div class="stat-label">Chương Trình Trọng Điểm</div>
          </div>
          <div class="intro-stat-item">
            <div class="stat-number">100+</div>
            <div class="stat-label">Khóa Đào Tạo CME</div>
          </div>
          <div class="intro-stat-item">
            <div class="stat-number">100%</div>
            <div class="stat-label">Chuẩn Hóa Y Khoa</div>
          </div>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:20px;flex-wrap:wrap;gap:12px;">
          <div style="font-size:0.86rem;color:#64748b;">
            Nhiệm kỳ 2026 – 2029 | Chủ tịch: <strong>Madam Trần Thị Lâm</strong>
          </div>
          <a href="gioi-thieu" class="link-read-more" style="font-size:0.92rem;color:#27AAE1;font-weight:700;">
            Xem chi tiết 10 định hướng & 8 chương trình →
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== 3. HỘI VIÊN CHI HỘI (Infinite Loop Carousel) ========== -->
  <section class="site-section bg-subtle" style="overflow:hidden;">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">HỘI VIÊN CHI HỘI</div>
      </div>
      
      <div class="infinite-marquee-container">
        
        <!-- Lane 1: Bệnh Viện Hội Viên (Cuộn Vô Tận Trái -> Phải) -->
        <div class="infinite-marquee-wrapper">
          <div class="infinite-marquee-track" id="marqueeTrackLane1">
            <!-- Set 1 (Continuous Seamless Stream - All 16 Member Hospitals) -->
            <div class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
        </div>
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
        <button class="tab-btn training-tab-btn" data-filter="hoat-dong">Hoạt động đào tạo</button>
        <button class="tab-btn training-tab-btn" data-filter="giang-vien">Đội ngũ giảng viên</button>
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
        
        <!-- Card 1 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-header">
            <span class="cme-header-tag">THÔNG BÁO CHIÊU SINH</span>
            <span class="cme-institute-seal"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> MER / HCA</span>
            <div class="cme-course-type">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</div>
            <div class="cme-course-name">"HỒI SINH TIM PHỔI CƠ BẢN"</div>
            <div class="cme-course-batch">KHÓA 5</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – khóa 5.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-1">Chi tiết khóa học →</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-header">
            <span class="cme-header-tag">THÔNG BÁO CHIÊU SINH</span>
            <span class="cme-institute-seal"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> MER / HCA</span>
            <div class="cme-course-type">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</div>
            <div class="cme-course-name">"CHĂM SÓC NGƯỜI BỆNH TOÀN DIỆN"</div>
            <div class="cme-course-batch">KHÓA 1</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Chăm sóc người bệnh toàn diện – khóa 1.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-2">Chi tiết khóa học →</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-header">
            <span class="cme-header-tag">THÔNG BÁO CHIÊU SINH</span>
            <span class="cme-institute-seal"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> MER / HCA</span>
            <div class="cme-course-type">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</div>
            <div class="cme-course-name">"TĂNG CƯỜNG NĂNG LỰC QUẢN LÝ ĐIỀU DƯỠNG"</div>
            <div class="cme-course-batch">KHÓA 2</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – khóa 2.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-3">Chi tiết khóa học →</a>
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
        <a href="dao-tao" class="btn-aih-navy" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 36px; font-size: 0.95rem; font-weight: 700; border-radius: 999px;">Xem tất cả</a>
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
        
        <!-- Card 1 -->
        <div class="news-article-card" data-category="su-kien">
          <div class="news-card-thumbnail-wrap">
            <img src="photo/news/event-photo-1.webp" alt="Ra mắt ban chấp hành chi hội" class="news-thumbnail-img" />
            <span class="news-category-badge event">SỰ KIỆN</span>
          </div>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                19/08/2026
              </div>
              <h3 class="news-card-title">
                Hiệp hội Bệnh viện Tư nhân Việt Nam ra mắt Ban Chấp hành Chi hội TP.HCM và các tỉnh phía Nam
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="#" class="link-read-more btn-news-detail" data-news-title="Hiệp hội Bệnh viện Tư nhân Việt Nam ra mắt Ban Chấp hành Chi hội TP.HCM và các tỉnh phía Nam (Nhiệm kỳ 2026 – 2029)" data-news-cat="SỰ KIỆN" data-news-date="19/08/2026">Đọc bài viết →</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="news-article-card" data-category="chi-hoi">
          <div class="news-card-thumbnail-wrap">
            <img src="photo/news/event-photo-49.jpg" alt="Bộ Y tế phát biểu" class="news-thumbnail-img" />
            <span class="news-category-badge">TIN TỨC</span>
          </div>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                19/08/2026
              </div>
              <h3 class="news-card-title">
                Bộ Y tế: Khối y tế tư nhân phía Nam đóng vai trò then chốt trong chăm sóc sức khỏe nhân dân
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="#" class="link-read-more btn-news-detail" data-news-title="Bộ Y tế: Khối y tế tư nhân phía Nam đóng vai trò then chốt trong chăm sóc sức khỏe nhân dân" data-news-cat="TIN TỨC" data-news-date="19/08/2026">Đọc bài viết →</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="news-article-card" data-category="chi-hoi">
          <div class="news-card-thumbnail-wrap">
            <img src="photo/news/event-photo-50.jpg" alt="GS.VS Nguyễn Văn Đệ phát biểu" class="news-thumbnail-img" />
            <span class="news-category-badge medical">CHI HỘI</span>
          </div>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                19/08/2026
              </div>
              <h3 class="news-card-title">
                GS.VS Nguyễn Văn Đệ: Chi hội phía Nam sẽ quy tụ nguồn lực và nâng tầm vị thế y tế tư nhân
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="#" class="link-read-more btn-news-detail" data-news-title="GS.VS Nguyễn Văn Đệ: Chi hội phía Nam sẽ quy tụ nguồn lực và nâng tầm vị thế y tế tư nhân" data-news-cat="CHI HỘI" data-news-date="19/08/2026">Đọc bài viết →</a>
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
        <a href="tin-tuc" class="btn-aih-navy" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 36px; font-size: 0.95rem; font-weight: 700; border-radius: 999px;">Xem tất cả</a>
      </div>
    </div>
  </section>

    <!-- ========== VIDEO SECTION (Slider Arrows on Both Sides) ========== -->
  <section class="site-section bg-subtle">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">VIDEO</div>
      </div>

      <!-- Video Slider Container with Left & Right Navigation Arrows -->
      <div class="section-slider-container">
        <button type="button" class="section-slider-arrow prev" onclick="scrollSectionCards('video-slider-grid', -1)" aria-label="Xem video trước">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <div class="video-grid-2col" id="video-slider-grid">
          <div class="video-card-item">
            <div class="video-embed-wrap">
              <iframe src="https://www.youtube.com/embed/_3A7urkzB6I" title="Video Chi Hội 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
          <div class="video-card-item">
            <div class="video-embed-wrap">
              <iframe src="https://www.youtube.com/embed/Pk2GA9-9OCs" title="Video Chi Hội 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
        </div>

        <button type="button" class="section-slider-arrow next" onclick="scrollSectionCards('video-slider-grid', 1)" aria-label="Xem video tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- ========== 6. ĐỐI TÁC ĐỒNG HÀNH SECTION (Infinite Loop) ========== -->
  <section class="site-section">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">ĐỐI TÁC ĐỒNG HÀNH</div>
      </div>
      
      <div class="infinite-marquee-container">
        <div class="infinite-marquee-wrapper">
          <div class="infinite-marquee-track">
            <!-- Set 1 (Continuous Seamless Stream) -->
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>

            <!-- Set 2 (Seamless Loop Duplicate) -->
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm" aria-hidden="true">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank" aria-hidden="true">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm" aria-hidden="true">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank" aria-hidden="true">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm" aria-hidden="true">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank" aria-hidden="true">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
            <div class="member-partner-card" title="Tập đoàn Hoa Lâm" aria-hidden="true">
              <img src="photo/doitac/logo_hoalam.png" alt="Tập đoàn Hoa Lâm" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City" />
            </div>
            <div class="member-partner-card" title="Ngân hàng Vietbank" aria-hidden="true">
              <img src="photo/doitac/logo_vietbank.jpg" alt="Ngân hàng Vietbank" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>