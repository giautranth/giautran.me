/**
 * WEBSITE CHI HỘI BỆNH VIỆN TƯ NHÂN TP.HCM VÀ CÁC TỈNH PHÍA NAM
 * Main JavaScript File - Chuẩn Bảng Màu Logo Chi Hội
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileNav();
  initBannerSlider();
  initScrollCarousels();
    initSmoothMarquees();
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
    mobileToggle.onclick = function(e) {
      e.preventDefault();
      e.stopPropagation();
      navMenu.classList.toggle('show-mobile');
    };

    document.addEventListener('click', (e) => {
      if (navMenu.classList.contains('show-mobile') && !navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        navMenu.classList.remove('show-mobile');
      }
    });
  }

  const dropdownParents = document.querySelectorAll('.nav-menu-item.has-dropdown, .aih-menu-item.has-dropdown');
  dropdownParents.forEach(item => {
    const link = item.querySelector('.nav-link-btn, .aih-menu-link');
    const submenu = item.querySelector('.dropdown-menu-list');

    if (link && submenu) {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = item.classList.toggle('open');
        submenu.classList.toggle('show-mobile-sub', isOpen);
      });
    }
  });

  document.addEventListener('click', (e) => {
    dropdownParents.forEach(item => {
      if (!item.contains(e.target)) {
        item.classList.remove('open');
        const submenu = item.querySelector('.dropdown-menu-list');
        if (submenu) submenu.classList.remove('show-mobile-sub');
      }
    });
  });
}

/* ==========================================================================
   2. BANNER SLIDER (Chuẩn AIH Carousel với Autoplay & Touch Swipe)
   ========================================================================== */
function initBannerSlider() {
  const slides = document.querySelectorAll('.banner-slide');
  const dots = document.querySelectorAll('.carousel-dot');
  const prevBtn = document.getElementById('bannerPrevBtn');
  const nextBtn = document.getElementById('bannerNextBtn');

  if (slides.length <= 1) return;

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
    stopAutoPlay();
    slideInterval = setInterval(nextSlide, 5000);
  }

  function stopAutoPlay() {
    if (slideInterval) {
      clearInterval(slideInterval);
      slideInterval = null;
    }
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', (e) => {
      e.preventDefault();
      nextSlide();
      startAutoPlay();
    });
  }
  if (prevBtn) {
    prevBtn.addEventListener('click', (e) => {
      e.preventDefault();
      prevSlide();
      startAutoPlay();
    });
  }

  dots.forEach(dot => {
    dot.addEventListener('click', (e) => {
      e.preventDefault();
      const idx = parseInt(dot.getAttribute('data-slide-index'), 10);
      if (!isNaN(idx)) {
        showSlide(idx);
        startAutoPlay();
      }
    });
  });

  const bannerWrapper = document.querySelector('.banner-carousel-wrapper, .aih-hero-banner-section');
  if (bannerWrapper) {
    // Touch swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    bannerWrapper.addEventListener('touchstart', (e) => {
      if (e.changedTouches && e.changedTouches[0]) {
        touchStartX = e.changedTouches[0].screenX;
      }
    }, { passive: true });

    bannerWrapper.addEventListener('touchend', (e) => {
      if (e.changedTouches && e.changedTouches[0]) {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 50) {
          nextSlide();
        } else if (touchEndX - touchStartX > 50) {
          prevSlide();
        }
        startAutoPlay();
      }
    }, { passive: true });
  }

  // Tự động chuyển banner đúng chu kỳ 5 giây (5s)
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
    title: 'Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – Khóa 2',
    organizer: 'Viện Đào tạo & Nghiên cứu Khoa học (CIMER) - BV Quốc tế City phối hợp Hội Khoa học Sức khỏe TP.HCM (HSA)',
    target: 'Điều dưỡng trưởng bệnh viện, Điều dưỡng trưởng khoa/phòng, Điều dưỡng viên có định hướng quản lý',
    duration: '40 tiết học (Lý thuyết kết hợp thực hành quản trị điều dưỡng thực chiến)',
    certificate: 'Chứng chỉ Đào tạo Y khoa Liên tục (CME) do Bệnh viện Quốc tế City / Hội Khoa học Sức khỏe TP.HCM cấp có giá trị toàn quốc',
    instructors: 'Ban Lãnh đạo Điều dưỡng BV Quốc tế City & Các Chuyên gia Quản lý Điều dưỡng TP.HCM',
    location: 'Bệnh viện Quốc tế City - Số 3 Đường 17A, P. An Lạc, Q. Bình Tân, TP.HCM',
    tuition: 'Học phí theo quy định đào tạo (Ưu đãi đặc biệt cho Bệnh viện Hội viên Chi hội)',
    startDate: '22/07/2026',
    image: 'photo/dao-tao/13.png',
    pdfUrl: 'http://cih.com.vn/wp-content/uploads/2026/07/20.-Thong-bao-chieu-sinh_Tang-cuong-nang-luc-quan-ly-dieu-duong-khoa-2-CAP-NHAT.pdf'
  },
  'cme-2': {
    title: 'Thông báo chiêu sinh khóa Đào tạo cập nhật kiến thức y khoa liên tục (CME) – An toàn người bệnh – Khóa 4',
    organizer: 'Viện Đào tạo & Nghiên cứu Khoa học (CIMER) - BV Quốc tế City phối hợp Hội Khoa học Sức khỏe TP.HCM (HSA)',
    target: 'Bác sĩ, Điều dưỡng, Kỹ thuật viên, Dược sĩ, Thành viên mạng lưới Quản lý Chất lượng & An toàn Người bệnh',
    duration: '32 tiết học (Phòng ngừa sự cố y khoa, kiểm soát rủi ro và văn hóa an toàn người bệnh)',
    certificate: 'Chứng chỉ Đào tạo Y khoa Liên tục (CME) An Toàn Người Bệnh theo tiêu chuẩn Bộ Y tế',
    instructors: 'Chuyên gia Quản lý Chất lượng & Hội đồng An toàn Người bệnh BV Quốc tế City',
    location: 'Bệnh viện Quốc tế City - Số 3 Đường 17A, P. An Lạc, Q. Bình Tân, TP.HCM',
    tuition: 'Học phí theo quy định đào tạo (Ưu đãi đặc biệt cho Bệnh viện Hội viên Chi hội)',
    startDate: '15/08/2026',
    image: 'photo/dao-tao/11.png',
    pdfUrl: 'http://cih.com.vn/wp-content/uploads/2026/08/28.-TB-chieu-sinh-An-toan-nguoi-benh-khoa-4.pdf'
  },
  'cme-3': {
    title: 'Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – Khóa 3',
    organizer: 'Viện Đào tạo & Nghiên cứu Khoa học (CIMER) - Bệnh viện Quốc tế City',
    target: 'Bác sĩ, Điều dưỡng, Kỹ thuật viên, Hộ sinh, Cứu hộ viên và Nhân viên y tế tuyến cơ sở',
    duration: '24 tiết học (Huấn luyện CPR/BLS và sử dụng máy AED trên mô hình mô phỏng chuẩn AHA)',
    certificate: 'Chứng chỉ Đào tạo Y khoa Liên tục (CME) Hồi sinh Tim phổi Cơ bản (BLS) chuẩn Bộ Y tế',
    instructors: 'Đội ngũ Bác sĩ Chuyên khoa Hồi sức Cấp cứu - BV Quốc tế City',
    location: 'Trung tâm Huấn luyện Kỹ năng Lâm sàng - Bệnh viện Quốc tế City',
    tuition: '1.500.000 VNĐ / Học viên (Giảm 15% cho Bệnh viện Hội viên)',
    startDate: '09/07/2026',
    image: 'photo/dao-tao/12.png',
    pdfUrl: 'https://cih.com.vn/wp-content/uploads/2026/07/9.-Thong-bao-chieu-sinh-BLS-khoa-3.pdf'
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
      const href = btn.getAttribute('href');
      if (href && href !== '#' && !href.startsWith('javascript:')) {
        return; // Allow direct navigation to dedicated course page URL
      }
      e.preventDefault();
      const cmeId = btn.getAttribute('data-cme-id');
      const data = cmeData[cmeId] || cmeData['cme-1'];

      if (modalTitle && modalBody) {
                modalTitle.textContent = 'Thông Tin Chi Tiết Khóa Đào Tạo';
        const imgPrefix = window.location.pathname.includes('/dao-tao') || window.location.pathname.includes('/hoi-vien') || window.location.pathname.includes('/gioi-thieu') || window.location.pathname.includes('/tin-tuc') || window.location.pathname.includes('/lien-he') || window.location.pathname.includes('/so-do-to-chuc') ? '../' : '';
        modalBody.innerHTML = `
          <div style="margin-bottom: 16px;">
            <div style="width: 100%; max-height: 220px; overflow: hidden; border-radius: 8px; margin-bottom: 14px; border: 1px solid #e2e8f0;">
              <img src="${imgPrefix}${data.image}" alt="${data.title}" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
            <h3 style="color: #2C3691; font-size: 1.12rem; font-weight: 800; line-height: 1.4; margin-bottom: 8px;">${data.title}</h3>
            <p style="color: #27AAE1; font-weight: 700; font-size: 0.88rem; margin-bottom: 12px;">Ngày đăng / khai giảng: ${data.startDate}</p>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px; margin-bottom: 16px; font-size: 0.88rem; line-height: 1.7;">
            <p style="margin-bottom: 6px;"><strong>Đơn vị tổ chức:</strong> ${data.organizer}</p>
            <p style="margin-bottom: 6px;"><strong>Đối tượng học viên:</strong> ${data.target}</p>
            <p style="margin-bottom: 6px;"><strong>Thời lượng đào tạo:</strong> ${data.duration}</p>
            <p style="margin-bottom: 6px;"><strong>Địa điểm:</strong> ${data.location}</p>
            <p style="margin-bottom: 6px;"><strong>Chứng chỉ:</strong> ${data.certificate}</p>
            <p style="margin-bottom: 6px;"><strong>Giảng viên:</strong> ${data.instructors}</p>
            <p style="margin-bottom: 6px;"><strong>Học phí:</strong> <span style="color: #e22b27; font-weight: 800;">${data.tuition}</span></p>
            ${data.pdfUrl ? `<div style="margin-top: 10px; padding-top: 8px; border-top: 1px dashed #cbd5e1;"><a href="${data.pdfUrl}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; color: #2C3691; font-weight: 700; text-decoration: none; background: #e0f2fe; padding: 6px 12px; border-radius: 6px; font-size: 0.84rem;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> Xem Thông Báo Chiêu Sinh Chính Thức (PDF) ↗</a></div>` : ''}
          </div>
          <form id="quickRegisterForm" onsubmit="handleQuickRegister(event)" style="border-top: 1px solid #e2e8f0; padding-top: 14px;">
            <h4 style="color: #2C3691; font-size: 0.92rem; font-weight: 700; margin-bottom: 10px; text-transform: uppercase;">Đăng Ký Khóa Học Trực Tuyến</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
              <input type="text" required placeholder="Họ và tên *" class="form-control" />
              <input type="tel" required placeholder="Số điện thoại *" class="form-control" />
            </div>
            <div style="margin-bottom: 10px;">
              <input type="email" placeholder="Email nhận thông báo" class="form-control" />
            </div>
            <div style="margin-bottom: 12px;">
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
      const href = btn.getAttribute('href');
      if (href && href !== '#' && !href.startsWith('javascript:')) {
        return; // Allow direct navigation to article page URL
      }
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
            <p style="margin-bottom: 16px;">Các bệnh viện, phòng khám hội viên có nhu cầu tham gia phối hợp hoặc đăng ký hội viên chính thức vui lòng liên hệ Ban Thường Trực Chi hội qua Hotline: <strong>1900 8146</strong> hoặc email: <strong>info@chihoibenhvien.com</strong>.</p>
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

window.handleQuickRegister = handleQuickRegister;


/* ── MULTI-LANGUAGE TRANSLATOR & SELECTOR (BRAND THEME #2C3691 & #27AAE1) ── */
function loadGoogleTranslateScript() {
  if (window.google && window.google.translate) return;
  if (!document.getElementById('google-translate-script')) {
    const s = document.createElement('script');
    s.id = 'google-translate-script';
    s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async = true;
    document.head.appendChild(s);
  }
}

window.googleTranslateElementInit = function() {
  if (!document.getElementById('google_translate_element')) {
    const div = document.createElement('div');
    div.id = 'google_translate_element';
    div.style.display = 'none';
    document.body.appendChild(div);
  }
  new window.google.translate.TranslateElement({
    pageLanguage: 'vi',
    includedLanguages: 'vi,en,ja,zh-CN',
    autoDisplay: false
  }, 'google_translate_element');
};

function triggerPageTranslation(lang) {
  loadGoogleTranslateScript();
  const langMap = {
    vi: 'vi',
    en: 'en',
    ja: 'ja',
    zh: 'zh-CN'
  };
  const targetLang = langMap[lang] || 'vi';

  // Set Google Translate cookie
  document.cookie = `googtrans=/vi/${targetLang}; path=/; domain=${window.location.hostname}`;
  document.cookie = `googtrans=/vi/${targetLang}; path=/;`;

  // Trigger combo box if element exists
  const combo = document.querySelector('.goog-te-combo');
  if (combo) {
    combo.value = targetLang;
    combo.dispatchEvent(new Event('change'));
  } else {
    // Reload or init
    setTimeout(() => {
      const cb = document.querySelector('.goog-te-combo');
      if (cb) {
        cb.value = targetLang;
        cb.dispatchEvent(new Event('change'));
      }
    }, 600);
  }
}

/* ── MULTI-LANGUAGE TRANSLATOR & SELECTOR (BRAND THEME #2C3691 & #27AAE1) ── */
function loadGoogleTranslateScript() {
  if (window.google && window.google.translate) return;
  if (!document.getElementById('google-translate-script')) {
    const s = document.createElement('script');
    s.id = 'google-translate-script';
    s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async = true;
    document.head.appendChild(s);
  }
}

window.googleTranslateElementInit = function() {
  if (!document.getElementById('google_translate_element')) {
    const div = document.createElement('div');
    div.id = 'google_translate_element';
    div.style.display = 'none';
    document.body.appendChild(div);
  }
  try {
    new window.google.translate.TranslateElement({
      pageLanguage: 'vi',
      includedLanguages: 'vi,en,ja,zh-CN',
      autoDisplay: false
    }, 'google_translate_element');
  } catch (err) {
    console.warn('Google Translate init:', err);
  }
};

function triggerPageTranslation(lang) {
  loadGoogleTranslateScript();
  const langMap = {
    vi: 'vi',
    en: 'en',
    ja: 'ja',
    zh: 'zh-CN'
  };
  const targetLang = langMap[lang] || 'vi';

  if (targetLang === 'vi') {
    // Reset to Vietnamese
    document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = `googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=${window.location.hostname};`;
    const combo = document.querySelector('.goog-te-combo');
    if (combo) {
      combo.value = 'vi';
      combo.dispatchEvent(new Event('change'));
    } else {
      window.location.reload();
    }
    return;
  }

  // Set Google Translate cookie
  document.cookie = `googtrans=/vi/${targetLang}; path=/; domain=${window.location.hostname}`;
  document.cookie = `googtrans=/vi/${targetLang}; path=/;`;

  // Trigger combo box if element exists
  const combo = document.querySelector('.goog-te-combo');
  if (combo) {
    combo.value = targetLang;
    combo.dispatchEvent(new Event('change'));
  } else {
    setTimeout(() => {
      const cb = document.querySelector('.goog-te-combo');
      if (cb) {
        cb.value = targetLang;
        cb.dispatchEvent(new Event('change'));
      }
    }, 600);
  }
}

function initLanguageSwitcher() {
  const langBox = document.getElementById('langBox');
  const langCurrent = document.getElementById('langCurrent');
  if (!langBox || !langCurrent) return;

  langCurrent.addEventListener('click', (e) => {
    e.stopPropagation();
    langBox.classList.toggle('open');
    langCurrent.setAttribute('aria-expanded', langBox.classList.contains('open'));
  });

  document.addEventListener('click', (e) => {
    if (!langBox.contains(e.target)) {
      langBox.classList.remove('open');
      langCurrent.setAttribute('aria-expanded', 'false');
    }
  });

  const i18n = {
    vi: { toast: '🇻🇳 Đã chuyển sang Tiếng Việt' },
    en: { toast: '🇺🇸 Switched to English' },
    ja: { toast: '🇯🇵 日本語に切り替えました' },
    zh: { toast: '🇨🇳 已切换至中文' }
  };

  document.querySelectorAll('.lang-opt').forEach(opt => {
    opt.addEventListener('click', (e) => {
      e.stopPropagation();
      document.querySelectorAll('.lang-opt').forEach(o => o.classList.remove('active'));
      opt.classList.add('active');

      const lang = opt.getAttribute('data-lang');
      const flag = opt.getAttribute('data-flag');

      const flagEl = langCurrent.querySelector('.lang-flag');
      if (flagEl) {
        flagEl.innerHTML = `<img src="https://flagcdn.com/w20/${flag}.png" alt="${flag}" width="20" style="vertical-align:middle;border-radius:2px;" />`;
      }

      langBox.classList.remove('open');
      langCurrent.setAttribute('aria-expanded', 'false');

      // Trigger automatic translation
      triggerPageTranslation(lang);

      // Toast notification
      const toastText = i18n[lang]?.toast || 'Language changed';
      showToast(toastText);
    });
  });

  // Pre-load translate library in background
  setTimeout(loadGoogleTranslateScript, 1000);
}

function showToast(msg) {
  let toast = document.getElementById('appLangToast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'appLangToast';
    Object.assign(toast.style, {
      position: 'fixed',
      bottom: '30px',
      left: '50%',
      transform: 'translateX(-50%) translateY(20px)',
      background: 'rgba(15, 23, 42, 0.95)',
      backdropFilter: 'blur(8px)',
      border: '1px solid rgba(255, 255, 255, 0.15)',
      color: '#ffffff',
      padding: '10px 24px',
      borderRadius: '50px',
      fontSize: '0.88rem',
      fontWeight: '700',
      boxShadow: '0 10px 30px rgba(0, 0, 0, 0.25)',
      zIndex: '99999',
      opacity: '0',
      transition: 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
      pointerEvents: 'none'
    });
    document.body.appendChild(toast);
  }
  toast.textContent = msg;
  toast.style.opacity = '1';
  toast.style.transform = 'translateX(-50%) translateY(0)';
  clearTimeout(window.__toastTimer);
  window.__toastTimer = setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(-50%) translateY(20px)';
  }, 2200);
}

// Call on DOMContentLoaded
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initLanguageSwitcher);
} else {
  initLanguageSwitcher();
}

/* ── SECTION CARDS HORIZONTAL NAVIGATION (Mobile 1 Box Snap & Desktop Smooth Scroll) ── */
function scrollSectionCards(gridId, direction) {
  const grid = document.getElementById(gridId);
  if (!grid) return;
  const isMobile = window.innerWidth <= 768;
  let scrollAmount;
  if (isMobile) {
    scrollAmount = grid.clientWidth || grid.offsetWidth;
  } else {
    const card = grid.querySelector('.cme-training-card, .news-article-card, .video-card-item');
    scrollAmount = card ? (card.offsetWidth + 24) : 380;
  }
  grid.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth'
  });
}
window.scrollSectionCards = scrollSectionCards;

/* ==========================================================================
   INTERACTIVE SMOOTH MARQUEE CONTROLLER (HỘI VIÊN & ĐỐI TÁC ĐỒNG HÀNH)
   Auto-scroll vô tận 60fps, tạm dừng khi hover, cuộn mượt khi click mũi tên
   ========================================================================== */
const marqueeControllers = {};

class SmoothMarquee {
  constructor(trackId, speed = 0.55) {
    this.track = document.getElementById(trackId);
    if (!this.track) return;

    this.trackId = trackId;
    this.speed = speed; // Tốc độ tự cuộn (pixel per frame)
    this.currentX = 0;
    this.targetX = 0;
    this.isHovered = false;
    this.isNudging = false;
    this.halfWidth = 2000;

    this.init();
  }

  init() {
    // Đảm bảo không bị CSS animation ghi đè
    this.track.style.animation = 'none';
    this.track.style.willChange = 'transform';

    this.calculateHalfWidth();

    // Tính toán lại halfWidth khi ảnh tải xong hoặc resize
    window.addEventListener('resize', () => this.calculateHalfWidth());
    window.addEventListener('load', () => this.calculateHalfWidth());

    // Wrapper hover event để dừng/chạy tiếp
    const wrapper = this.track.closest('.infinite-marquee-wrapper') || this.track.parentElement;
    if (wrapper) {
      wrapper.addEventListener('mouseenter', () => { this.isHovered = true; });
      wrapper.addEventListener('mouseleave', () => { this.isHovered = false; });

      // Hỗ trợ vuốt chạm trên Mobile
      let touchStartX = 0;
      wrapper.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        this.isHovered = true;
      }, { passive: true });

      wrapper.addEventListener('touchmove', (e) => {
        const currentTouchX = e.touches[0].clientX;
        const diff = touchStartX - currentTouchX;
        if (Math.abs(diff) > 8) {
          this.nudge(diff > 0 ? 1 : -1, Math.min(Math.abs(diff) * 1.5, 120));
          touchStartX = currentTouchX;
        }
      }, { passive: true });

      wrapper.addEventListener('touchend', () => {
        this.isHovered = false;
      }, { passive: true });
    }

    // Bắt đầu vòng lặp animation
    this.loop = this.loop.bind(this);
    requestAnimationFrame(this.loop);
  }

  calculateHalfWidth() {
    if (this.track && this.track.scrollWidth > 0) {
      // Set 1 và Set 2 giống hệt nhau nên độ dài 1 chu kỳ là scrollWidth / 2
      this.halfWidth = this.track.scrollWidth / 2;
    }
  }

  nudge(direction, distance) {
    if (!distance) {
      distance = window.innerWidth <= 768 ? 200 : 320;
    }
    this.isNudging = true;
    this.targetX += direction * distance;
  }

  loop() {
    this.calculateHalfWidth();

    // Nếu không hover và không đang bấm nút cuộn thì tự động trôi từ từ
    if (!this.isHovered && !this.isNudging) {
      this.targetX += this.speed;
    }

    // Nội suy mượt (lerp) từ currentX tới targetX
    const diff = this.targetX - this.currentX;
    if (Math.abs(diff) > 0.05) {
      this.currentX += diff * (this.isNudging ? 0.12 : 0.25);
    } else {
      this.currentX = this.targetX;
      this.isNudging = false;
    }

    // Vòng lặp vô tận không bao giờ giật lag
    if (this.halfWidth > 100) {
      while (this.currentX >= this.halfWidth) {
        this.currentX -= this.halfWidth;
        this.targetX -= this.halfWidth;
      }
      while (this.currentX < 0) {
        this.currentX += this.halfWidth;
        this.targetX += this.halfWidth;
      }
    }

    this.track.style.transform = `translate3d(${-this.currentX.toFixed(2)}px, 0, 0)`;
    requestAnimationFrame(this.loop);
  }
}

function initSmoothMarquees() {
  if (document.getElementById('marqueeTrackLane1')) {
    marqueeControllers['marqueeTrackLane1'] = new SmoothMarquee('marqueeTrackLane1', 0.55);
  }
  if (document.getElementById('marqueeTrackPartner')) {
    marqueeControllers['marqueeTrackPartner'] = new SmoothMarquee('marqueeTrackPartner', 0.5);
  }
}

// Global nudge function được gọi khi bấm nút mũi tên prev/next
function nudgeMarquee(trackId, direction) {
  if (marqueeControllers[trackId]) {
    marqueeControllers[trackId].nudge(direction);
  } else {
    // Fallback nếu chưa khởi tạo controller
    const track = document.getElementById(trackId);
    if (track) {
      marqueeControllers[trackId] = new SmoothMarquee(trackId, 0.55);
      marqueeControllers[trackId].nudge(direction);
    }
  }
}
window.nudgeMarquee = nudgeMarquee;


/* ════════════════════════════════════════════════════════════════
   HÌNH ẢNH - VIDEO SPLIT GALLERY VIEWER (AUTO-PLAY & SCROLL)
════════════════════════════════════════════════════════════════ */
let facilityAutoPlayInterval = null;
let currentFacilityIdx = 0;

function switchFacilityByIndex(idx) {
  const cards = document.querySelectorAll('.facility-side-card');
  if (!cards.length) return;
  
  currentFacilityIdx = (idx + cards.length) % cards.length;
  const targetCard = cards[currentFacilityIdx];
  const img = targetCard.querySelector('img');
  if (!img) return;

  const mainImg = document.getElementById('facility-main-img');
  if (mainImg && !mainImg.src.includes(img.getAttribute('src'))) {
    mainImg.classList.add('fade-out');
    setTimeout(() => {
      mainImg.src = img.getAttribute('src');
      mainImg.classList.remove('fade-out');
    }, 160);
  }

  cards.forEach(c => c.classList.remove('active'));
  targetCard.classList.add('active');

  // Scroll side list smoothly so the active card stays in view
  const sideGrid = document.querySelector('.facilities-side-grid');
  if (sideGrid) {
    if (window.innerWidth > 992) {
      const cardTop = targetCard.offsetTop - sideGrid.offsetTop;
      sideGrid.scrollTo({
        top: Math.max(0, cardTop - 10),
        behavior: 'smooth'
      });
    } else {
      const cardLeft = targetCard.offsetLeft - sideGrid.offsetLeft;
      sideGrid.scrollTo({
        left: Math.max(0, cardLeft - 10),
        behavior: 'smooth'
      });
    }
  }
}

function startFacilityAutoPlay() {
  if (facilityAutoPlayInterval) clearInterval(facilityAutoPlayInterval);
  facilityAutoPlayInterval = setInterval(() => {
    switchFacilityByIndex(currentFacilityIdx + 1);
  }, 4000);
}

window.switchFacilityImg = function(src, cardEl) {
  const cards = Array.from(document.querySelectorAll('.facility-side-card'));
  const idx = cards.indexOf(cardEl);
  if (idx !== -1) {
    switchFacilityByIndex(idx);
    startFacilityAutoPlay();
  }
};

document.addEventListener('DOMContentLoaded', () => {
  const sideGrid = document.querySelector('.facilities-side-grid');
  if (sideGrid) {
    startFacilityAutoPlay();
    sideGrid.addEventListener('mouseenter', () => clearInterval(facilityAutoPlayInterval));
    sideGrid.addEventListener('mouseleave', () => startFacilityAutoPlay());
  }
});


/* ════════════════════════════════════════════════════════════════
   SITE SEARCH MODAL & INSTANT SEARCH ENGINE
════════════════════════════════════════════════════════════════ */
const siteSearchData = [
  // Đào tạo
  {
    title: "Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – Khóa 2",
    category: "Đào tạo CME",
    badge: "badge-dao-tao",
    desc: "Khóa đào tạo cập nhật kiến thức y khoa liên tục về quản lý điều dưỡng bệnh viện.",
    url: "dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-tang-cuong-nang-luc-quan-ly-dieu-duong-khoa-2"
  },
  {
    title: "Thông báo chiêu sinh khóa Đào tạo cập nhật kiến thức y khoa liên tục (CME) – An toàn người bệnh – Khóa 4",
    category: "Đào tạo CME",
    badge: "badge-dao-tao",
    desc: "Cập nhật kiến thức chuyên sâu về quản lý rủi ro và nâng cao văn hóa an toàn người bệnh.",
    url: "dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-cap-nhat-kien-thuc-y-khoa-lien-tuc-cme-an-toan-nguoi-benh-khoa-4"
  },
  {
    title: "Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – Khóa 3",
    category: "Đào tạo CME",
    badge: "badge-dao-tao",
    desc: "Chuẩn hóa kỹ năng cấp cứu ngưng tuần hoàn hô hấp cơ bản theo phác đồ quốc tế.",
    url: "dao-tao/thong-bao-chieu-sinh-khoa-dao-tao-lien-tuc-cme-hoi-sinh-tim-phoi-co-ban-khoa-3"
  },
  // Tin tức
  {
    title: "Ra Mắt Ban Chấp Hành Chi Hội Bệnh Viện Tư Nhân TP.HCM Và Các Tỉnh, Thành Phía Nam",
    category: "Tin tức",
    badge: "badge-tin-tuc",
    desc: "Lễ ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam (Nhiệm kỳ 2026 – 2029).",
    url: "tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm"
  },
  {
    title: "Diễn Đàn Phát Triển Y Tế Tư Nhân Việt Nam Năm 2026: Đổi Mới Quản Trị Y Tế",
    category: "Tin tức",
    badge: "badge-tin-tuc",
    desc: "Thông qua Tuyên bố Thành phố Hồ Chí Minh về phát triển y tế tư nhân Việt Nam 2026.",
    url: "tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026"
  },
  {
    title: "Kết Nối Sức Mạnh Y Tế Tư Nhân Phía Nam: Madam Trần Thị Lâm Giữ Vai Trò Chủ Tịch Chi Hội",
    category: "Tin tức",
    badge: "badge-tin-tuc",
    desc: "Đại hội thành lập Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam.",
    url: "tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam"
  },
  // Hội viên tiêu biểu
  {
    title: "Bệnh viện Quốc tế City (CIH)",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "Số 3, Đường 17A, Phường An Lạc, TP. Hồ Chí Minh - Trụ sở văn phòng Chi hội.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Gia An 115",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "Số 05, Đường 17A, Phường An Lạc, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Đa khoa Hoàn Mỹ Sài Gòn",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "60-60A Phan Xích Long, Phường 1, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Đa khoa Triều An",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "425 Kinh Dương Vương, Phường An Lạc, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Đa khoa Quốc tế Vinmec Central Park",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "208 Nguyễn Hữu Cảnh, Phường 22, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Đa khoa Tâm Anh TP.HCM",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "2B Phổ Quang, Phường 2, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Đa khoa Quốc tế S.I.S Cần Thơ",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "397 Nguyễn Văn Cừ, Phường An Bình, Thành phố Cần Thơ.",
    url: "hoi-vien"
  },
  {
    title: "Bệnh viện Đa khoa Quốc tế Nam Sài Gòn",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "Số 88, Đường số 8, KDC Trung Sơn, Xã Bình Hưng, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  {
    title: "Phòng khám Đa khoa Thuận Kiều",
    category: "Hội viên",
    badge: "badge-hoi-vien",
    desc: "Thuận Kiều, TP. Hồ Chí Minh.",
    url: "hoi-vien"
  },
  // Các trang chính
  {
    title: "Giới thiệu Chi hội & 10 Định hướng chiến lược",
    category: "Giới thiệu",
    badge: "",
    desc: "Tôn chỉ mục đích, 10 Định hướng chiến lược và 8 Chương trình trọng điểm của Chi hội.",
    url: "gioi-thieu"
  },
  {
    title: "Sơ đồ tổ chức Ban Chấp Hành",
    category: "Cơ cấu",
    badge: "",
    desc: "Cơ cấu tổ chức Ban Thường vụ, Ban Chấp hành và các Ban chuyên môn Chi hội.",
    url: "so-do-to-chuc"
  },
  {
    title: "Liên hệ Văn phòng Chi hội Bệnh viện Tư nhân",
    category: "Liên hệ",
    badge: "",
    desc: "Địa chỉ trụ sở, email tiếp nhận thông tin và số điện thoại hỗ trợ hội viên.",
    url: "lien-he"
  }
];

function getBasePath() {
  const path = window.location.pathname;
  if (path.includes('/tin-tuc/') || path.includes('/dao-tao/')) {
    const parts = path.split('/').filter(Boolean);
    const chihoiIdx = parts.indexOf('chihoi');
    const depth = chihoiIdx !== -1 ? parts.length - 1 - chihoiIdx : 1;
    return depth > 1 ? '../' : '';
  }
  return '';
}

function resolveSearchUrl(url) {
  // If in WordPress, prepend home_url
  if (window.chihoiThemeData && window.chihoiThemeData.homeUrl) {
    return window.chihoiThemeData.homeUrl.replace(/\/$/, '') + '/' + url.replace(/^\//, '');
  }
  const base = getBasePath();
  return base ? base + url : url;
}

window.openSiteSearch = function() {
  const modal = document.getElementById('siteSearchModal');
  if (!modal) return;
  modal.classList.add('is-open');
  modal.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
  const input = document.getElementById('siteSearchInput');
  if (input) {
    input.value = '';
    setTimeout(() => input.focus(), 80);
    renderSearchResults('');
  }
};

window.closeSiteSearch = function() {
  const modal = document.getElementById('siteSearchModal');
  if (!modal) return;
  modal.classList.remove('is-open');
  modal.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
};

window.clearSiteSearch = function() {
  const input = document.getElementById('siteSearchInput');
  if (input) {
    input.value = '';
    input.focus();
    renderSearchResults('');
  }
};

window.fillSearchTag = function(keyword) {
  const input = document.getElementById('siteSearchInput');
  if (input) {
    input.value = keyword;
    input.focus();
    renderSearchResults(keyword);
  }
};

function renderSearchResults(keyword) {
  const container = document.getElementById('siteSearchResults');
  const clearBtn = document.getElementById('siteSearchClear');
  if (!container) return;

  const kw = keyword.trim().toLowerCase();
  if (clearBtn) {
    clearBtn.style.display = kw ? 'flex' : 'none';
  }

  if (!kw) {
    container.innerHTML = '<div class="site-search-empty">Nhập từ khóa để tìm kiếm tin tức, hội viên, đào tạo CME hoặc thông tin Chi hội...</div>';
    return;
  }

  const results = siteSearchData.filter(item => {
    return item.title.toLowerCase().includes(kw) ||
           item.desc.toLowerCase().includes(kw) ||
           item.category.toLowerCase().includes(kw);
  });

  if (!results.length) {
    container.innerHTML = `<div class="site-search-empty">Không tìm thấy kết quả phù hợp cho <strong>"${keyword}"</strong>. Vui lòng thử từ khóa khác.</div>`;
    return;
  }

  let html = '';
  results.forEach(item => {
    const finalUrl = resolveSearchUrl(item.url);
    html += `
      <a href="${finalUrl}" class="site-search-item">
        <span class="site-search-item-badge ${item.badge}">${item.category}</span>
        <div class="site-search-item-content">
          <h4 class="site-search-item-title">${item.title}</h4>
          <p class="site-search-item-desc">${item.desc}</p>
        </div>
      </a>
    `;
  });

  container.innerHTML = html;
}

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('siteSearchInput');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      renderSearchResults(e.target.value);
    });
  }

  // Keyboard shortcut: ESC to close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeSiteSearch();
    }
  });
});
