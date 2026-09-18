<?php
/**
 * Template Name: Template Về Hiệp Hội
 */
get_header(); ?>

  <!-- ========== MAIN CONTENT: VỀ HIỆP HỘI ========== -->
  <main class="site-section">
    <div class="container">
      
      <!-- FV HOSPITAL STYLE HERO CARD -->
      <div class="fv-hero-card">
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
          <h1 class="fv-hero-title">VỀ HIỆP HỘI BỆNH VIỆN TƯ NHÂN VIỆT NAM</h1>
          <p class="fv-hero-paragraph">
            Sự phát triển mạnh mẽ của hệ thống y tế tư nhân trong hơn hai thập kỷ qua là kết quả từ chủ trương xã hội hóa y tế của Đảng và Nhà nước, góp phần đa dạng hóa dịch vụ khám chữa bệnh, giảm tải cho hệ thống y tế công lập và nâng cao chất lượng chăm sóc sức khỏe nhân dân.
          </p>
          <p class="fv-hero-paragraph">
            Trong bối cảnh đó, việc hình thành một tổ chức đại diện cho tiếng nói chung của cộng đồng y tế tư nhân là yêu cầu tất yếu. Ngày 26/8/2014, Hiệp hội Bệnh viện Tư nhân Việt Nam chính thức được thành lập theo Quyết định của Bộ Nội vụ, trở thành tổ chức xã hội – nghề nghiệp đại diện cho các bệnh viện, cơ sở y tế tư nhân trên cả nước.
          </p>
        </div>

        <div class="fv-hero-image-col">
          <img src="<?php echo get_template_directory_uri(); ?>/photo/news/tienphong-photo-1.jpg" alt="Hiệp hội Bệnh viện Tư nhân Việt Nam" class="fv-hero-main-img" onerror="this.src='<?php echo esc_url(home_url('/photo/news/tienphong-photo-1.jpg')); ?>'" />
        </div>
      </div>

      <!-- 3 CORE PILLARS: KẾT NỐI - ĐỒNG HÀNH - KIẾN TẠO -->
      <div class="directions-wrapper-modern" style="margin-top: 40px; margin-bottom: 45px;">
        <div class="directions-header-row" style="text-align: center; margin-bottom: 30px;">
          <span style="display:inline-block;font-size:0.85rem;font-weight:700;letter-spacing:1px;color:#0284c7;text-transform:uppercase;background:#e0f2fe;padding:6px 16px;border-radius:20px;margin-bottom:12px;">Sứ Mệnh Cốt Lõi</span>
          <h2 class="about-section-heading" style="margin:0;font-size:1.85rem;color:#071f46;">HÀNH TRÌNH: KẾT NỐI – ĐỒNG HÀNH – KIẾN TẠO</h2>
          <p style="max-width:760px;margin:12px auto 0;color:#64748b;font-size:0.98rem;line-height:1.6;">
            Từ những ngày đầu thành lập, Hiệp hội luôn kiên định với sứ mệnh phụng sự cộng đồng, nâng tầm y tế tư nhân Việt Nam phát triển hiện đại và nhân văn.
          </p>
        </div>

        <div class="hiep-hoi-pillars-grid">
          <!-- Pillar 1 -->
          <div class="pillar-card">
            <div class="pillar-icon-box">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
            <div class="pillar-tag">TRỤ CỘT 01</div>
            <h3 class="pillar-title">KẾT NỐI</h3>
            <div class="pillar-subtitle">Mái nhà chung y tế tư nhân</div>
            <p class="pillar-desc">
              Tập hợp, quy tụ các bệnh viện và cơ sở y tế tư nhân trên toàn quốc; đẩy mạnh hợp tác chuyên môn, chia sẻ nguồn lực và lan tỏa những giá trị chuẩn mực trong quản trị y tế.
            </p>
          </div>

          <!-- Pillar 2 -->
          <div class="pillar-card">
            <div class="pillar-icon-box" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
            </div>
            <div class="pillar-tag">TRỤ CỘT 02</div>
            <h3 class="pillar-title">ĐỒNG HÀNH</h3>
            <div class="pillar-subtitle">Cầu nối vững chắc & Tiếng nói đại diện</div>
            <p class="pillar-desc">
              Đồng hành cùng hội viên bảo vệ quyền và lợi ích hợp pháp; tích cực tham gia đóng góp, phản biện chính sách y tế, thúc đẩy môi trường phát triển công bằng, minh bạch và thuận lợi.
            </p>
          </div>

          <!-- Pillar 3 -->
          <div class="pillar-card">
            <div class="pillar-icon-box" style="background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="pillar-tag">TRỤ CỘT 03</div>
            <h3 class="pillar-title">KIẾN TẠO</h3>
            <div class="pillar-subtitle">Hiện đại - Nhân văn - Bền vững</div>
            <p class="pillar-desc">
              Tiên phong ứng dụng công nghệ, chuyển đổi số và nâng cao chất lượng dịch vụ y tế, hướng đến giá trị cao nhất là chăm sóc sức khỏe toàn diện và phụng sự người bệnh.
            </p>
          </div>
        </div>
      </div>

      <!-- LEADERSHIP SPOTLIGHT SECTION -->
      <div class="hiep-hoi-leaders-wrapper" style="margin-bottom: 50px;">
        <div class="directions-header-row" style="text-align: center; margin-bottom: 32px;">
          <span style="display:inline-block;font-size:0.85rem;font-weight:700;letter-spacing:1px;color:#0284c7;text-transform:uppercase;background:#e0f2fe;padding:6px 16px;border-radius:20px;margin-bottom:12px;">Đội Ngũ Tiên Phong</span>
          <h2 class="about-section-heading" style="margin:0;font-size:1.85rem;color:#071f46;">BAN LÃNH ĐẠO HIỆP HỘI BỆNH VIỆN TƯ NHÂN VIỆT NAM</h2>
          <p style="max-width:760px;margin:12px auto 0;color:#64748b;font-size:0.98rem;line-height:1.6;">
            Sự dẫn dắt tâm huyết của những người đặt nền móng cùng sự tín nhiệm của toàn thể hội viên là nền tảng vững chắc cho sự lớn mạnh không ngừng của Hiệp hội.
          </p>
        </div>

        <div class="leaders-cards-grid">
          
          <!-- LEADER 1: GS. NGUYỄN VĂN ĐỆ -->
          <div class="executive-card">
            <div class="executive-img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/photo/news/tienphong-photo-2.jpg" alt="Giáo sư, Viện sĩ Danh dự Nguyễn Văn Đệ" class="executive-img" onerror="this.src='<?php echo esc_url(home_url('/photo/news/tienphong-photo-2.jpg')); ?>'" />
              <div class="executive-badge">Chủ tịch Hiệp hội</div>
            </div>
            <div class="executive-info">
              <div class="executive-role-title">CHỦ TỊCH HIỆP HỘI BỆNH VIỆN TƯ NHÂN VIỆT NAM</div>
              <h3 class="executive-name">GS. Viện sĩ Danh dự NGUYỄN VĂN ĐỆ</h3>
              <div class="executive-divider"></div>
              <p class="executive-text">
                Từ những ngày đầu thành lập, dưới sự dẫn dắt đầy tâm huyết của Giáo sư, Viện sĩ Danh dự Nguyễn Văn Đệ – Chủ tịch Hiệp hội Bệnh viện Tư nhân Việt Nam, Hiệp hội không ngừng khẳng định vai trò là cầu nối giữa cộng đồng y tế tư nhân với các cơ quan quản lý nhà nước.
              </p>
              <p class="executive-text">
                Ông đã luôn đồng hành cùng hội viên trong việc bảo vệ quyền và lợi ích hợp pháp, tích cực tham gia phản biện chính sách, thúc đẩy môi trường phát triển công bằng, minh bạch và bền vững cho toàn bộ hệ sinh thái y tế tư nhân Việt Nam.
              </p>
            </div>
          </div>

          <!-- LEADER 2: MADAM TRẦN THỊ LÂM -->
          <div class="executive-card">
            <div class="executive-img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/photo/news/news-cih-madam-lam.webp" alt="Madam Trần Thị Lâm" class="executive-img" onerror="this.src='<?php echo esc_url(home_url('/photo/news/news-cih-madam-lam.webp')); ?>'" />
              <div class="executive-badge" style="background:#0284c7;">Phó Chủ tịch Thường trực</div>
            </div>
            <div class="executive-info">
              <div class="executive-role-title">PHÓ CHỦ TỊCH THƯỜNG TRỰC HIỆP HỘI</div>
              <h3 class="executive-name">Madam TRẦN THỊ LÂM</h3>
              <div class="executive-subrole" style="font-weight:600;color:#0284c7;font-size:0.92rem;margin-bottom:12px;">Chủ tịch Sáng lập Tập đoàn Hoa Lâm</div>
              <div class="executive-divider"></div>
              <p class="executive-text">
                Với sự tín nhiệm của Ban Chấp hành Hiệp hội, Madam Trần Thị Lâm – Chủ tịch Sáng lập Tập đoàn Hoa Lâm được tín nhiệm giữ vai trò Phó Chủ tịch Thường trực Hiệp hội. Đây là sự ghi nhận đối với những đóng góp, tâm huyết và dấu ấn của bà trong hành trình đầu tư, phát triển y tế tư nhân, đồng thời thể hiện kỳ vọng về một tiếng nói mạnh mẽ, kết nối và đồng hành cùng cộng đồng bệnh viện tư nhân trên cả nước.
              </p>
              <p class="executive-text">
                Trên cương vị Phó Chủ tịch Thường trực, cùng Ban Lãnh đạo Hiệp hội, Madam Trần Thị Lâm tiếp tục đồng hành trong việc tăng cường kết nối hội viên, thúc đẩy hợp tác, chia sẻ kinh nghiệm và đóng góp vào quá trình xây dựng một môi trường thuận lợi cho y tế tư nhân phát triển chuyên nghiệp, bền vững, hướng đến giá trị cao nhất là chăm sóc sức khỏe và phục vụ người bệnh.
              </p>
            </div>
          </div>

        </div>
      </div>

      <!-- SUMMARY & CTA BANNER -->
      <div class="hiep-hoi-summary-card">
        <div class="hiep-hoi-summary-inner">
          <div class="summary-quote-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="#38bdf8" opacity="0.6">
              <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
            </svg>
          </div>
          <h3 class="summary-title">MÁI NHÀ CHUNG CỦA CỘNG ĐỒNG Y TẾ TƯ NHÂN VIỆT NAM</h3>
          <p class="summary-desc">
            Đến nay, Hiệp hội Bệnh viện Tư nhân Việt Nam đã trở thành mái nhà chung của cộng đồng y tế tư nhân, quy tụ các bệnh viện và cơ sở y tế trên cả nước; từng bước khẳng định vai trò kết nối, đại diện và đồng hành cùng sự phát triển của khu vực y tế tư nhân Việt Nam.
          </p>
          <p class="summary-desc highlight-desc">
            Từ tâm huyết của những người đặt nền móng đến sự chung sức của cộng đồng hội viên, Hiệp hội đang tiếp tục viết nên hành trình kết nối – đồng hành – kiến tạo, góp phần xây dựng một nền y tế Việt Nam hiện đại, nhân văn và phát triển bền vững.
          </p>
          <div class="summary-actions">
            <a href="<?php echo esc_url(home_url('/ve-chi-hoi/')); ?>" class="btn-hero-primary" style="background:#0284c7;color:#fff;padding:12px 28px;border-radius:50px;text-decoration:none;font-weight:700;display:inline-flex;align-items:center;gap:8px;box-shadow:0 6px 20px rgba(2,132,199,0.35);transition:all 0.3s ease;">
              Tìm hiểu Về Chi Hội Phía Nam
              <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="<?php echo esc_url(home_url('/ban-chap-hanh/')); ?>" class="btn-hero-secondary" style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.35);padding:12px 26px;border-radius:50px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:8px;backdrop-filter:blur(6px);transition:all 0.3s ease;">
              Xem Ban Chấp Hành Chi Hội
            </a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- STYLES CHO TRANG VỀ HIỆP HỘI -->
  <style>
    /* Trụ cột sứ mệnh */
    .hiep-hoi-pillars-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 26px;
      margin-top: 10px;
    }
    .pillar-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 32px 26px 28px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
      position: relative;
      transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
      display: flex;
      flex-direction: column;
    }
    .pillar-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 18px 36px rgba(2, 132, 199, 0.12);
      border-color: #bae6fd;
    }
    .pillar-icon-box {
      width: 58px;
      height: 58px;
      border-radius: 16px;
      background: linear-gradient(135deg, #071f46 0%, #1e40af 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      box-shadow: 0 8px 18px rgba(7, 31, 70, 0.2);
    }
    .pillar-tag {
      font-size: 0.76rem;
      font-weight: 800;
      letter-spacing: 1px;
      color: #0284c7;
      text-transform: uppercase;
      margin-bottom: 6px;
    }
    .pillar-title {
      font-size: 1.4rem;
      font-weight: 800;
      color: #071f46;
      margin: 0 0 4px;
    }
    .pillar-subtitle {
      font-size: 0.88rem;
      font-weight: 600;
      color: #0284c7;
      margin-bottom: 14px;
    }
    .pillar-desc {
      font-size: 0.92rem;
      color: #475569;
      line-height: 1.65;
      margin: 0;
    }

    /* Đội ngũ lãnh đạo */
    .leaders-cards-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      align-items: stretch;
    }
    .executive-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .executive-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 42px rgba(7, 31, 70, 0.12);
      border-color: #cbd5e1;
    }
    .executive-img-wrap {
      position: relative;
      width: 100%;
      height: 320px;
      background: #0f172a;
      overflow: hidden;
    }
    .executive-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center top;
      transition: transform 0.5s ease;
    }
    .executive-card:hover .executive-img {
      transform: scale(1.03);
    }
    .executive-badge {
      position: absolute;
      bottom: 16px;
      left: 18px;
      background: #071f46;
      color: #ffffff;
      padding: 6px 16px;
      border-radius: 50px;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.3);
      backdrop-filter: blur(4px);
    }
    .executive-info {
      padding: 28px 28px 30px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .executive-role-title {
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.8px;
      color: #0284c7;
      text-transform: uppercase;
      margin-bottom: 6px;
    }
    .executive-name {
      font-size: 1.32rem;
      font-weight: 800;
      color: #071f46;
      margin: 0 0 6px;
      line-height: 1.35;
    }
    .executive-divider {
      width: 44px;
      height: 3px;
      background: #0284c7;
      border-radius: 2px;
      margin: 10px 0 16px;
    }
    .executive-text {
      font-size: 0.92rem;
      color: #334155;
      line-height: 1.68;
      margin: 0 0 12px;
      text-align: justify;
    }
    .executive-text:last-child {
      margin-bottom: 0;
    }

    /* Summary Card */
    .hiep-hoi-summary-card {
      background: linear-gradient(135deg, #071f46 0%, #0b326c 50%, #0284c7 100%);
      border-radius: 26px;
      padding: 44px 38px;
      color: #ffffff;
      position: relative;
      overflow: hidden;
      box-shadow: 0 18px 45px rgba(7, 31, 70, 0.25);
    }
    .hiep-hoi-summary-card::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(56,189,248,0.2) 0%, transparent 70%);
      pointer-events: none;
    }
    .hiep-hoi-summary-inner {
      position: relative;
      z-index: 2;
      max-width: 920px;
      margin: 0 auto;
      text-align: center;
    }
    .summary-quote-icon {
      margin-bottom: 16px;
      display: inline-block;
    }
    .summary-title {
      font-size: 1.65rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 16px;
      letter-spacing: 0.5px;
    }
    .summary-desc {
      font-size: 1.02rem;
      line-height: 1.75;
      color: #e0f2fe;
      margin-bottom: 14px;
      text-align: center;
    }
    .highlight-desc {
      font-weight: 600;
      color: #ffffff;
      font-size: 1.05rem;
    }
    .summary-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 28px;
    }
    .btn-hero-primary:hover {
      background: #0369a1 !important;
      transform: translateY(-2px);
    }
    .btn-hero-secondary:hover {
      background: rgba(255,255,255,0.22) !important;
      transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 991px) {
      .hiep-hoi-pillars-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }
      .leaders-cards-grid {
        grid-template-columns: 1fr;
        gap: 24px;
      }
      .executive-img-wrap {
        height: 280px;
      }
      .hiep-hoi-summary-card {
        padding: 32px 24px;
      }
      .summary-title {
        font-size: 1.35rem;
      }
    }
    @media (max-width: 600px) {
      .executive-img-wrap {
        height: 240px;
      }
      .executive-info {
        padding: 22px 18px 24px;
      }
      .executive-name {
        font-size: 1.18rem;
      }
      .hiep-hoi-summary-card {
        padding: 26px 18px;
        border-radius: 20px;
      }
      .summary-title {
        font-size: 1.2rem;
      }
      .summary-desc {
        font-size: 0.92rem;
        text-align: left;
      }
      .summary-actions {
        flex-direction: column;
        width: 100%;
      }
      .summary-actions a {
        width: 100%;
        justify-content: center;
        text-align: center;
      }
    }
  </style>

<?php get_footer(); ?>
