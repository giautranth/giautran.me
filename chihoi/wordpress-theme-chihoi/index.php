<?php get_header(); ?>


          <!-- ========== AIH PANORAMIC HERO BANNER (Desktop: 1.png, Mobile: 2.png) ========== -->
  <section class="home-banner aih-hero-banner-section">
    <div class="banner-carousel-wrapper">
      <div class="image img-cover">
        <picture>
          <source media="(max-width: 767.98px)" srcset="photo/banner/2.png">
          <img src="photo/banner/1.png" alt="Chi hội Bệnh viện Tư nhân TP. Hồ Chí Minh và các tỉnh phía Nam" class="banner-img" fetchpriority="high">
        </picture>
      </div>
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
  <section class="site-section bg-subtle">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">HỘI VIÊN CHI HỘI</div>
      </div>
      
      <div class="infinite-marquee-container">
        <button type="button" class="section-slider-arrow prev" onclick="nudgeMarquee('marqueeTrackLane1', -1)" aria-label="Lùi logo hội viên">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <!-- Lane 1: Bệnh Viện Hội Viên (Cuộn Vô Tận Trái -> Phải) -->
        <div class="infinite-marquee-wrapper">
          <div class="infinite-marquee-track" id="marqueeTrackLane1">
            <!-- Set 1: Tất cả 16 Logo Bệnh viện Hội viên -->
            <div class="member-partner-card" title="Bệnh viện Gia An 115">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City (CIH)" />
            </div>
            <div class="member-partner-card" title="Bệnh viện FV (Pháp Việt)">
              <img src="photo/logo/fv.png" alt="Bệnh viện FV (Pháp Việt)" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Phương Nam">
              <img src="photo/logo/phuongnam.png" alt="Bệnh viện Phương Nam" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Nam Sài Gòn">
              <img src="photo/logo/namsaigon.jpg" alt="Bệnh viện Nam Sài Gòn" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Vinmec Central Park">
              <img src="photo/logo/vinmec.png" alt="Bệnh viện Vinmec Central Park" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Columbia Asia">
              <img src="photo/logo/colombia.png" alt="Bệnh viện Columbia Asia" />
            </div>
            <div class="member-partner-card" title="Bệnh viện ĐK Quốc tế S.I.S Cần Thơ">
              <img src="photo/logo/sis.png" alt="Bệnh viện ĐK Quốc tế S.I.S Cần Thơ" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Minh Anh">
              <img src="photo/logo/minhanh.png" alt="Bệnh viện Minh Anh" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Hoàn Mỹ">
              <img src="photo/logo/hoanmy.webp" alt="Bệnh viện Hoàn Mỹ" />
            </div>
            <div class="member-partner-card" title="Đại học Quốc tế Hồng Bàng">
              <img src="photo/logo/hongbang.png" alt="Đại học Quốc tế Hồng Bàng" />
            </div>
            <div class="member-partner-card" title="Trung tâm Y khoa Medic - Hòa Hảo">
              <img src="photo/logo/medic.webp" alt="Trung tâm Y khoa Medic - Hòa Hảo" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Sài Gòn ITO">
              <img src="photo/logo/saigon-iot.jpg" alt="Bệnh viện Sài Gòn ITO" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Đa khoa Tân Hưng">
              <img src="photo/logo/tanhung.png" alt="Bệnh viện Đa khoa Tân Hưng" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Triều An">
              <img src="photo/logo/trieuan.png" alt="Bệnh viện Triều An" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Việt Mỹ">
              <img src="photo/logo/vietmy.png" alt="Bệnh viện Việt Mỹ" />
            </div>

            <!-- Set 2: Duplicate lặp vô tận (32 thẻ liên tục) -->
            <div class="member-partner-card" title="Bệnh viện Gia An 115" aria-hidden="true">
              <img src="photo/logo/giaan115.png" alt="Bệnh viện Gia An 115" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Quốc tế City (CIH)" aria-hidden="true">
              <img src="photo/logo/CIH.png" alt="Bệnh viện Quốc tế City (CIH)" />
            </div>
            <div class="member-partner-card" title="Bệnh viện FV (Pháp Việt)" aria-hidden="true">
              <img src="photo/logo/fv.png" alt="Bệnh viện FV (Pháp Việt)" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Phương Nam" aria-hidden="true">
              <img src="photo/logo/phuongnam.png" alt="Bệnh viện Phương Nam" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Nam Sài Gòn" aria-hidden="true">
              <img src="photo/logo/namsaigon.jpg" alt="Bệnh viện Nam Sài Gòn" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Vinmec Central Park" aria-hidden="true">
              <img src="photo/logo/vinmec.png" alt="Bệnh viện Vinmec Central Park" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Columbia Asia" aria-hidden="true">
              <img src="photo/logo/colombia.png" alt="Bệnh viện Columbia Asia" />
            </div>
            <div class="member-partner-card" title="Bệnh viện ĐK Quốc tế S.I.S Cần Thơ" aria-hidden="true">
              <img src="photo/logo/sis.png" alt="Bệnh viện ĐK Quốc tế S.I.S Cần Thơ" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Minh Anh" aria-hidden="true">
              <img src="photo/logo/minhanh.png" alt="Bệnh viện Minh Anh" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Hoàn Mỹ" aria-hidden="true">
              <img src="photo/logo/hoanmy.webp" alt="Bệnh viện Hoàn Mỹ" />
            </div>
            <div class="member-partner-card" title="Đại học Quốc tế Hồng Bàng" aria-hidden="true">
              <img src="photo/logo/hongbang.png" alt="Đại học Quốc tế Hồng Bàng" />
            </div>
            <div class="member-partner-card" title="Trung tâm Y khoa Medic - Hòa Hảo" aria-hidden="true">
              <img src="photo/logo/medic.webp" alt="Trung tâm Y khoa Medic - Hòa Hảo" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Sài Gòn ITO" aria-hidden="true">
              <img src="photo/logo/saigon-iot.jpg" alt="Bệnh viện Sài Gòn ITO" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Đa khoa Tân Hưng" aria-hidden="true">
              <img src="photo/logo/tanhung.png" alt="Bệnh viện Đa khoa Tân Hưng" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Triều An" aria-hidden="true">
              <img src="photo/logo/trieuan.png" alt="Bệnh viện Triều An" />
            </div>
            <div class="member-partner-card" title="Bệnh viện Việt Mỹ" aria-hidden="true">
              <img src="photo/logo/vietmy.png" alt="Bệnh viện Việt Mỹ" />
            </div>
          </div>
        </div>
        <button type="button" class="section-slider-arrow next" onclick="nudgeMarquee('marqueeTrackLane1', 1)" aria-label="Xem logo hội viên tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
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
                  Kết Nối Sức Mạnh Y Tế Tư Nhân Phía Nam: Madam Trần Thị Lâm Giữ Vai Trò Chủ Tịch Chi Hội
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
                  Ra Mắt Ban Chấp Hành Chi Hội Bệnh Viện Tư Nhân TP.HCM Và Các Tỉnh, Thành Phía Nam
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
                  Diễn Đàn Phát Triển Y Tế Tư Nhân Việt Nam Năm 2026 (Lần Thứ II) Thành Công Tốt Đẹp
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

      <!-- ========== VIDEO SECTION (Single Featured Video) ========== -->
  <section class="site-section bg-subtle">
    <div class="container">
      <div class="section-header-row" style="margin-bottom: 20px;">
        <div class="section-main-title">VIDEO</div>
      </div>

      <div class="single-video-container">
        <div class="video-embed-wrap">
          <iframe src="https://www.youtube.com/embed/_3A7urkzB6I" title="Lễ Ra Mắt Chi Hội Bệnh Viện Tư Nhân TP.HCM và các tỉnh thành phía Nam" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
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
        <button type="button" class="section-slider-arrow prev" onclick="nudgeMarquee('marqueeTrackPartner', -1)" aria-label="Lùi logo đối tác">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <div class="infinite-marquee-wrapper">
          <div class="infinite-marquee-track" id="marqueeTrackPartner">
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
        <button type="button" class="section-slider-arrow next" onclick="nudgeMarquee('marqueeTrackPartner', 1)" aria-label="Xem logo đối tác tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>