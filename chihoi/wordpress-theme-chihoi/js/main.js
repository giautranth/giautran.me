/**
 * WEBSITE CHI HỘI BỆNH VIỆN TƯ NHÂN TP.HCM VÀ CÁC TỈNH PHÍA NAM
 * Main JavaScript File - Chuẩn Bảng Màu Logo Chi Hội
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileNav();
  initBannerSlider();
  initScrollCarousels();
  initTrainingTabs();
  initNewsTabs();
  initMemberTableSearch();
  initModalHandlers();
});

/* ==========================================================================
   1. MOBILE NAVIGATION & DROPDOWNS
   ========================================================================== */
function initMobileNav() {
  const mobileToggle = document.getElementById('mobileNavToggle');
  const navMenu = document.getElementById('navMenuList');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      navMenu.classList.toggle('show-mobile');
    });
  }

  const dropdownParents = document.querySelectorAll('.nav-menu-item.has-dropdown, .aih-menu-item.has-dropdown');
  dropdownParents.forEach(item => {
    const link = item.querySelector('.nav-link-btn, .aih-menu-link');
    const submenu = item.querySelector('.dropdown-menu-list');

    if (link && submenu) {
      link.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          submenu.classList.toggle('show-mobile-sub');
        }
      });
    }
  });
}

/* ==========================================================================
   2. BANNER SLIDER
   ========================================================================== */
function initBannerSlider() {
  const slides = document.querySelectorAll('.banner-slide');
  const dots = document.querySelectorAll('.carousel-dot');
  const prevBtn = document.getElementById('bannerPrevBtn');
  const nextBtn = document.getElementById('bannerNextBtn');

  if (!slides.length) return;

  let currentSlide = 0;
  let slideInterval = null;

  function showSlide(index) {
    if (index >= slides.length) currentSlide = 0;
    else if (index < 0) currentSlide = slides.length - 1;
    else currentSlide = index;

    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === currentSlide);
    });

    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === currentSlide);
    });
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  function startAutoPlay() {
    slideInterval = setInterval(nextSlide, 5000);
  }

  function stopAutoPlay() {
    if (slideInterval) clearInterval(slideInterval);
  }

  if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); stopAutoPlay(); startAutoPlay(); });
  if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); stopAutoPlay(); startAutoPlay(); });

  dots.forEach(dot => {
    dot.addEventListener('click', (e) => {
      const idx = parseInt(e.target.getAttribute('data-slide-index'), 10);
      if (!isNaN(idx)) {
        showSlide(idx);
        stopAutoPlay();
        startAutoPlay();
      }
    });
  });

  const bannerWrapper = document.querySelector('.banner-carousel-wrapper, .aih-hero-banner-section');
  if (bannerWrapper) {
    bannerWrapper.addEventListener('mouseenter', stopAutoPlay);
    bannerWrapper.addEventListener('mouseleave', startAutoPlay);
  }

  startAutoPlay();
}

/* ==========================================================================
   3. INFINITE LOOP MARQUEE & SCROLL CAROUSELS
   ========================================================================== */
function initScrollCarousels() {
  // Infinite Loop Marquee Controller
  const lane1 = document.getElementById('marqueeTrackLane1');
  const lane2 = document.getElementById('marqueeTrackLane2');
  const pausePlayBtn = document.getElementById('marqueePausePlayBtn');
  const speedBtn = document.getElementById('marqueeSpeedBtn');
  const playIcon = document.getElementById('marqueePlayIcon');
  const playText = document.getElementById('marqueePlayText');
  const speedText = document.getElementById('marqueeSpeedText');

  if (lane1 || lane2) {
    let isPaused = false;
    let speedMode = 0; // 0: Chuẩn (30s/32s), 1: Nhanh (16s/18s), 2: Chậm (48s/50s)
    const speeds = [
      { name: 'Chuẩn', s1: '30s', s2: '32s' },
      { name: 'Nhanh', s1: '15s', s2: '17s' },
      { name: 'Chậm', s1: '48s', s2: '52s' }
    ];

    if (pausePlayBtn) {
      pausePlayBtn.addEventListener('click', () => {
        isPaused = !isPaused;
        const state = isPaused ? 'paused' : 'running';
        if (lane1) lane1.style.animationPlayState = state;
        if (lane2) lane2.style.animationPlayState = state;

        if (playIcon) playIcon.textContent = isPaused ? '▶️' : '⏸️';
        if (playText) playText.textContent = isPaused ? 'Tiếp tục' : 'Tạm dừng';
      });
    }

    if (speedBtn) {
      speedBtn.addEventListener('click', () => {
        speedMode = (speedMode + 1) % speeds.length;
        const currentSpeed = speeds[speedMode];
        if (lane1) lane1.style.animationDuration = currentSpeed.s1;
        if (lane2) lane2.style.animationDuration = currentSpeed.s2;
        if (speedText) speedText.textContent = `Tốc độ: ${currentSpeed.name}`;
      });
    }
  }

  // Fallback for manual scroll tracks if present
  const memberTrack = document.getElementById('memberLogosTrack');
  const memberPrev = document.getElementById('memberPrevBtn');
  const memberNext = document.getElementById('memberNextBtn');

  if (memberTrack && memberPrev && memberNext) {
    const scrollAmount = 280;
    memberPrev.addEventListener('click', () => {
      memberTrack.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    memberNext.addEventListener('click', () => {
      memberTrack.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  }
}

/* ==========================================================================
   4. TRAINING TABS FILTER
   ========================================================================== */
function initTrainingTabs() {
  const tabButtons = document.querySelectorAll('.training-tab-btn');
  const trainingCards = document.querySelectorAll('.cme-training-card');

  if (!tabButtons.length || !trainingCards.length) return;

  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      tabButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');

      trainingCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filter === 'all' || filter === category || category.includes(filter)) {
          card.style.display = 'flex';
          card.style.animation = 'fadeIn 0.35s ease';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}

/* ==========================================================================
   5. NEWS TABS FILTER
   ========================================================================== */
function initNewsTabs() {
  const tabButtons = document.querySelectorAll('.news-tab-btn');
  const newsCards = document.querySelectorAll('.news-article-card');

  if (!tabButtons.length || !newsCards.length) return;

  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      tabButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');

      newsCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filter === 'all' || filter === category || category.includes(filter)) {
          card.style.display = 'flex';
          card.style.animation = 'fadeIn 0.35s ease';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}

/* ==========================================================================
   6. MEMBER TABLE REALTIME SEARCH & FILTER
   ========================================================================== */
function initMemberTableSearch() {
  const searchInput = document.getElementById('memberSearchInput');
  const table = document.getElementById('memberDataTable');

  if (!searchInput || !table) return;

  const rows = table.querySelectorAll('tbody tr');
  const noResultRow = document.getElementById('memberNoResultRow');

  searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase().trim();
    let visibleCount = 0;

    rows.forEach(row => {
      if (row.id === 'memberNoResultRow') return;
      const text = row.textContent.toLowerCase();
      if (text.includes(query)) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    if (noResultRow) {
      noResultRow.style.display = visibleCount === 0 ? '' : 'none';
    }
  });
}

/* ==========================================================================
   7. MODAL DIALOGS
   ========================================================================== */
const cmeData = {
  'cme-1': {
    title: 'Khóa Đào Tạo Liên Tục (CME): "Hồi Sinh Tim Phổi Cơ Bản" - Khóa 5',
    target: 'Bác sĩ, Điều dưỡng, Kỹ thuật viên cấp cứu, Nhân viên y tế tuyến cơ sở',
    duration: '24 tiết học (Lý thuyết kết hợp thực hành mô phỏng chuẩn AHA)',
    certificate: 'Chứng chỉ Đào tạo Y khoa Liên tục (CME) có giá trị toàn quốc',
    instructors: 'Đội ngũ Bác sĩ Chuyên khoa Hồi sức Cấp cứu - BV Gia An 115 & BV Quốc tế City',
    tuition: '1.500.000 VNĐ / Học viên (Giảm 15% cho Bệnh viện Hội viên)',
    startDate: '22/07/2026'
  },
  'cme-2': {
    title: 'Khóa Đào Tạo Liên Tục (CME): "Chăm Sóc Người Bệnh Toàn Diện" - Khóa 1',
    target: 'Điều dưỡng trưởng, Điều dưỡng viên các khoa lâm sàng',
    duration: '32 tiết học',
    certificate: 'Chứng chỉ CME Chăm sóc Toàn diện',
    instructors: 'Chuyên gia Điều dưỡng Bệnh viện FV và Bệnh viện Phương Nam',
    tuition: '1.800.000 VNĐ / Học viên (Giảm 15% cho Bệnh viện Hội viên)',
    startDate: '22/07/2026'
  },
  'cme-3': {
    title: 'Khóa Đào Tạo Liên Tục (CME): "Tăng Cường Năng Lực Quản Lý Điều Dưỡng" - Khóa 2',
    target: 'Lãnh đạo phòng Điều dưỡng, Điều dưỡng trưởng khoa, Tổ trưởng điều dưỡng',
    duration: '40 tiết học',
    certificate: 'Chứng chỉ CME Quản lý Điều dưỡng Bệnh viện',
    instructors: 'Giảng viên Trường Đại học Y Dược TP.HCM & Lãnh đạo Chi hội',
    tuition: '2.500.000 VNĐ / Học viên',
    startDate: '22/07/2026'
  },
  'cme-4': {
    title: 'Khóa Đào Tạo Liên Tục (CME): "Phòng Và Kiểm Soát Nhiễm Khuẩn Bệnh Viện" - Khóa 5',
    target: 'Thành viên mạng lưới kiểm soát nhiễm khuẩn, Bác sĩ, Điều dưỡng',
    duration: '30 tiết học',
    certificate: 'Chứng chỉ Kiểm soát Nhiễm khuẩn chuẩn Bộ Y tế',
    instructors: 'Chuyên gia Kiểm soát Nhiễm khuẩn - Hội KSNK TP.HCM',
    tuition: '1.600.000 VNĐ / Học viên',
    startDate: '22/07/2026'
  },
  'cme-5': {
    title: 'Khóa Đào Tạo Liên Tục (CME): "Hồi Sinh Tim Phổi Cơ Bản" - Khóa 4',
    target: 'Bác sĩ, Điều dưỡng, Nhân viên Y tế',
    duration: '24 tiết học',
    certificate: 'Chứng chỉ CME Cấp cứu Cơ bản',
    instructors: 'Đội ngũ Bác sĩ Hồi sức Cấp cứu',
    tuition: '1.500.000 VNĐ / Học viên',
    startDate: '11/07/2026'
  },
  'cme-6': {
    title: 'Khóa Đào Tạo Liên Tục (CME): "Hồi Sinh Tim Phổi Cơ Bản" - Khóa 3',
    target: 'Bác sĩ, Điều dưỡng',
    duration: '24 tiết học',
    certificate: 'Chứng chỉ CME Cấp cứu Cơ bản',
    instructors: 'Đội ngũ Bác sĩ Hồi sức Cấp cứu',
    tuition: '1.500.000 VNĐ / Học viên',
    startDate: '09/07/2026'
  }
};

function initModalHandlers() {
  const modalOverlay = document.getElementById('appModalOverlay');
  const modalCloseBtn = document.getElementById('modalCloseBtn');
  const modalTitle = document.getElementById('modalTitle');
  const modalBody = document.getElementById('modalBody');

  if (!modalOverlay) return;

  function closeModal() {
    modalOverlay.classList.remove('active');
  }

  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);

  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) closeModal();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });

  // Open CME Detail Modal
  document.querySelectorAll('.btn-cme-detail').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const cmeId = btn.getAttribute('data-cme-id');
      const data = cmeData[cmeId] || cmeData['cme-1'];

      if (modalTitle && modalBody) {
        modalTitle.textContent = 'Thông Tin Chi Tiết Khóa Đào Tạo';
        modalBody.innerHTML = `
          <div style="margin-bottom: 16px;">
            <h3 style="color: #2C3691; font-size: 1.15rem; font-weight: 800; line-height: 1.4; margin-bottom: 10px;">${data.title}</h3>
            <p style="color: #27AAE1; font-weight: 700; font-size: 0.88rem; margin-bottom: 16px;">Ngày khai giảng: ${data.startDate}</p>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-bottom: 20px; font-size: 0.9rem; line-height: 1.7;">
            <p><strong>Đối tượng học viên:</strong> ${data.target}</p>
            <p><strong>Thời lượng:</strong> ${data.duration}</p>
            <p><strong>Chứng chỉ:</strong> ${data.certificate}</p>
            <p><strong>Giảng viên:</strong> ${data.instructors}</p>
            <p><strong>Học phí:</strong> <span style="color: #e22b27; font-weight: 800;">${data.tuition}</span></p>
          </div>
          <form id="quickRegisterForm" onsubmit="handleQuickRegister(event)" style="border-top: 1px solid #e2e8f0; padding-top: 16px;">
            <h4 style="color: #2C3691; font-size: 0.95rem; font-weight: 700; margin-bottom: 12px; text-transform: uppercase;">Đăng Ký Khóa Học Nhanh</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
              <input type="text" required placeholder="Họ và tên *" class="form-control" />
              <input type="tel" required placeholder="Số điện thoại *" class="form-control" />
            </div>
            <div style="margin-bottom: 14px;">
              <input type="email" placeholder="Email nhận thông báo" class="form-control" />
            </div>
            <div style="margin-bottom: 14px;">
              <input type="text" placeholder="Đơn vị công tác (Bệnh viện / Phòng khám)" class="form-control" />
            </div>
            <button type="submit" class="btn-primary-pill" style="width: 100%; text-align: center; border-radius: 6px;">Gửi Đăng Ký Trực Tuyến</button>
          </form>
        `;
        modalOverlay.classList.add('active');
      }
    });
  });

  // Open News Detail Modal
  document.querySelectorAll('.btn-news-detail').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const title = btn.getAttribute('data-news-title') || 'Tin tức Chi hội';
      const category = btn.getAttribute('data-news-cat') || 'TIN TỨC';
      const date = btn.getAttribute('data-news-date') || '19/08/2026';

      let bodyHtml = '';
      if (title.includes('Ban Chấp hành') || title.includes('ra mắt')) {
        bodyHtml = `
          <div style="margin-bottom: 16px;">
            <img src="photo/news/event-photo-1.webp" alt="Lễ ra mắt Ban Chấp Hành" style="width:100%;max-height:260px;object-fit:cover;border-radius:6px;margin-bottom:12px;" />
            <span style="background: #2C3691; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 3px; text-transform: uppercase;">${category}</span>
            <span style="color: #64748b; font-size: 0.8rem; margin-left: 8px;">${date}</span>
            <h3 style="color: #2C3691; font-size: 1.18rem; font-weight: 800; line-height: 1.4; margin-top: 10px;">${title}</h3>
          </div>
          <div style="color: #334e68; font-size: 0.92rem; line-height: 1.8;">
            <p style="margin-bottom: 12px;"><strong>TP. Hồ Chí Minh, ngày 19/08/2026</strong> – Tại Bệnh viện Quốc tế City (Khu Y tế Kỹ thuật cao TP.HCM), Hiệp hội Bệnh viện Tư nhân Việt Nam đã long trọng tổ chức Hội nghị lần thứ nhất và Lễ ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh, thành phía Nam (nhiệm kỳ 2026 – 2029).</p>
            <p style="margin-bottom: 12px;">Hội nghị đã bầu ra Ban Chấp hành Chi hội gồm các lãnh đạo uy tín trong ngành:</p>
            <ul style="padding-left: 20px; margin-bottom: 12px;">
              <li><strong>Chủ tịch Chi hội:</strong> Madam Trần Thị Lâm (Chủ tịch sáng lập Tập đoàn Hoa Lâm, Trưởng ban Ủy ban Chiến lược Khu Y tế Kỹ thuật cao TP.HCM).</li>
              <li><strong>Phó Chủ tịch Thường trực:</strong> ThS.BS. Trần Quốc Thành (Giám đốc Điều hành BV Gia An 115 và BV Quốc tế City).</li>
              <li><strong>Các Phó Chủ tịch:</strong> TS.BS. Trương Vĩnh Long, TS.BS. Đào Cảnh Tuất, Ông Phạm Thế Đồng.</li>
            </ul>
            <p style="margin-bottom: 16px;">Sự kiện có sự tham dự và phát biểu chỉ đạo của <strong>TS.BS. Hà Anh Đức</strong> (Cục trưởng Cục Quản lý Khám, chữa bệnh – Bộ Y tế) và <strong>GS. Viện sĩ Nguyễn Văn Đệ</strong> (Chủ tịch Hiệp hội Bệnh viện Tư nhân Việt Nam).</p>
          </div>
        `;
      } else if (title.includes('Bộ Y tế')) {
        bodyHtml = `
          <div style="margin-bottom: 16px;">
            <img src="photo/news/event-photo-49.jpg" alt="Bộ Y tế phát biểu" style="width:100%;max-height:260px;object-fit:cover;border-radius:6px;margin-bottom:12px;" />
            <span style="background: #2C3691; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 3px; text-transform: uppercase;">${category}</span>
            <span style="color: #64748b; font-size: 0.8rem; margin-left: 8px;">${date}</span>
            <h3 style="color: #2C3691; font-size: 1.18rem; font-weight: 800; line-height: 1.4; margin-top: 10px;">${title}</h3>
          </div>
          <div style="color: #334e68; font-size: 0.92rem; line-height: 1.8;">
            <p style="margin-bottom: 12px;">Phát biểu chỉ đạo tại Hội nghị, <strong>TS.BS Hà Anh Đức</strong> – Cục trưởng Cục Quản lý Khám, chữa bệnh (Bộ Y tế) ghi nhận và đánh giá cao những đóng góp to lớn của mạng lưới các cơ sở khám chữa bệnh tư nhân khu vực phía Nam đối với sự nghiệp bảo vệ sức khỏe nhân dân.</p>
            <p style="margin-bottom: 12px;">Cục trưởng đề nghị Chi hội tiếp tục phát huy tinh thần trách nhiệm, chuẩn hóa quy trình chuyên môn kỹ thuật, đẩy mạnh đào tạo y khoa liên tục (CME), nghiên cứu khoa học và phối hợp chặt chẽ với hệ thống y tế công lập để nâng cao chất lượng dịch vụ điều trị.</p>
          </div>
        `;
      } else if (title.includes('Nguyễn Văn Đệ')) {
        bodyHtml = `
          <div style="margin-bottom: 16px;">
            <img src="photo/news/event-photo-50.jpg" alt="GS.VS Nguyễn Văn Đệ phát biểu" style="width:100%;max-height:260px;object-fit:cover;border-radius:6px;margin-bottom:12px;" />
            <span style="background: #2C3691; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 3px; text-transform: uppercase;">${category}</span>
            <span style="color: #64748b; font-size: 0.8rem; margin-left: 8px;">${date}</span>
            <h3 style="color: #2C3691; font-size: 1.18rem; font-weight: 800; line-height: 1.4; margin-top: 10px;">${title}</h3>
          </div>
          <div style="color: #334e68; font-size: 0.92rem; line-height: 1.8;">
            <p style="margin-bottom: 12px;"><strong>GS. Viện sĩ Nguyễn Văn Đệ</strong> – Chủ tịch Hiệp hội Bệnh viện Tư nhân Việt Nam, Ủy viên Đoàn Chủ tịch Ủy ban Trung ương MTTQ Việt Nam nhấn mạnh TP.HCM là đầu tàu phát triển của cả nước, việc thành lập Chi hội phía Nam sẽ tạo cú hích mạnh mẽ kết nối sức mạnh của các bệnh viện ngoài công lập.</p>
            <p style="margin-bottom: 12px;">Chủ tịch Hiệp hội tin tưởng Chi hội dưới sự lãnh đạo của Madam Trần Thị Lâm sẽ hoàn thành xuất sắc các nhiệm vụ, bảo vệ quyền lợi hợp pháp của hội viên và đẩy mạnh chuyển giao công nghệ cao.</p>
          </div>
        `;
      } else {
        bodyHtml = `
          <div style="margin-bottom: 16px;">
            <span style="background: #2C3691; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 3px; text-transform: uppercase;">${category}</span>
            <span style="color: #64748b; font-size: 0.8rem; margin-left: 8px;">${date}</span>
            <h3 style="color: #2C3691; font-size: 1.2rem; font-weight: 800; line-height: 1.4; margin-top: 10px;">${title}</h3>
          </div>
          <div style="color: #334e68; font-size: 0.95rem; line-height: 1.8;">
            <p style="margin-bottom: 12px;"><strong>Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam</strong> tiếp tục đẩy mạnh các hoạt động kết nối, đào tạo liên tục và đồng hành cùng các bệnh viện hội viên nhằm nâng cao chất lượng dịch vụ khám chữa bệnh, bảo đảm quyền lợi người bệnh và nâng cao hiệu quả quản trị y tế tư nhân.</p>
            <p style="margin-bottom: 12px;">Trong thời gian tới, Chi hội sẽ tổ chức chuỗi hội thảo chuyên đề, giao lưu chia sẻ kinh nghiệm quản lý bệnh viện thông minh, ứng dụng chuyển đổi số trong hồ sơ bệnh án điện tử (EMR) và các chương trình bồi dưỡng nâng cao tay nghề lâm sàng.</p>
            <p style="margin-bottom: 16px;">Các bệnh viện, phòng khám hội viên có nhu cầu tham gia phối hợp hoặc đăng ký hội viên chính thức vui lòng liên hệ Ban Thường Trực Chi hội qua Hotline: <strong>1900 8146</strong> hoặc email: <strong>vanphong@chihoiyte.vn</strong>.</p>
          </div>
        `;
      }

      if (modalTitle && modalBody) {
        modalTitle.textContent = 'Bản Tin Chi Hội Y Tế';
        modalBody.innerHTML = bodyHtml + `
          <div style="text-align: right; border-top: 1px solid #e2e8f0; padding-top: 14px;">
            <button onclick="document.getElementById('appModalOverlay').classList.remove('active')" class="btn-primary-pill" style="border-radius: 6px; padding: 8px 20px;">Đóng</button>
          </div>
        `;
        modalOverlay.classList.add('active');
      }
    });
  });
}

function handleQuickRegister(e) {
  e.preventDefault();
  alert('Cảm ơn Quý học viên! Ban Đào tạo Chi hội đã tiếp nhận thông tin đăng ký và sẽ liên hệ xác nhận trong vòng 24h làm việc.');
  const modalOverlay = document.getElementById('appModalOverlay');
  if (modalOverlay) modalOverlay.classList.remove('active');
}

function switchLang(lang) {
  const viBtn = document.getElementById('langViBtn');
  const enBtn = document.getElementById('langEnBtn');
  if (lang === 'vi') {
    if (viBtn) viBtn.classList.add('active');
    if (enBtn) enBtn.classList.remove('active');
  } else {
    if (enBtn) enBtn.classList.add('active');
    if (viBtn) viBtn.classList.remove('active');
    alert('The English language interface is being updated. Switching back to Vietnamese.');
    setTimeout(() => {
      if (viBtn) viBtn.classList.add('active');
      if (enBtn) enBtn.classList.remove('active');
    }, 1500);
  }
}

window.handleQuickRegister = handleQuickRegister;
window.switchLang = switchLang;
