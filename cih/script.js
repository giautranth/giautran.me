/* CIH Website – script.js v3.0 */
document.addEventListener('DOMContentLoaded', () => {

  /* ── PROMO BANNER CLOSE ── */
  const promoClose = document.getElementById('promo-close');
  const promoBanner = document.getElementById('promo-banner');
  if (promoClose && promoBanner) {
    promoClose.addEventListener('click', () => {
      promoBanner.style.maxHeight = promoBanner.offsetHeight + 'px';
      requestAnimationFrame(() => {
        promoBanner.style.transition = 'max-height .4s ease, opacity .4s ease, padding .4s ease';
        promoBanner.style.maxHeight = '0';
        promoBanner.style.opacity = '0';
        promoBanner.style.padding = '0';
        promoBanner.style.overflow = 'hidden';
      });
    });
  }

  /* ── HEADER SCROLL EFFECT ── */
  const header = document.getElementById('header');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 40);
  }, { passive: true });

  /* ── HAMBURGER ── */
  const hamburger = document.getElementById('hamburger-btn');
  const nav = document.querySelector('.nav');
  if (hamburger && nav) {
    hamburger.addEventListener('click', () => {
      const open = nav.style.display === 'block';
      nav.style.display = open ? '' : 'block';
      if (!open) {
        Object.assign(nav.style, {
          position: 'absolute', top: '64px', left: '0', right: '0',
          background: '#fff', padding: '1rem', boxShadow: '0 8px 32px rgba(0,0,0,.12)',
          zIndex: '500'
        });
      }
    });
  }

  /* ── HERO SLIDER ── */
  const slides = document.querySelectorAll('.hero__slide');
  const dots   = document.querySelectorAll('.hero__dot');
  let current  = 0;
  let autoTimer;

  const goToSlide = (idx) => {
    slides[current].classList.remove('hero__slide--active');
    dots[current].classList.remove('hero__dot--active');
    current = (idx + slides.length) % slides.length;
    slides[current].classList.add('hero__slide--active');
    dots[current].classList.add('hero__dot--active');
  };

  const startAuto = () => {
    clearInterval(autoTimer);
    autoTimer = setInterval(() => goToSlide(current + 1), 5000);
  };

  document.getElementById('slide-next')?.addEventListener('click', () => { goToSlide(current + 1); startAuto(); });
  document.getElementById('slide-prev')?.addEventListener('click', () => { goToSlide(current - 1); startAuto(); });
  dots.forEach((dot, i) => dot.addEventListener('click', () => { goToSlide(i); startAuto(); }));
  startAuto();

  /* ── COUNTER ANIMATION ── */
  const animateCounter = (el, target, dur = 1800) => {
    const start = performance.now();
    const tick = (now) => {
      const p = Math.min((now - start) / dur, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.floor(eased * target);
      if (p < 1) requestAnimationFrame(tick);
      else el.textContent = target;
    };
    requestAnimationFrame(tick);
  };

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el = e.target;
      animateCounter(el, +el.dataset.count);
      io.unobserve(el);
    });
  }, { threshold: 0 });
  document.querySelectorAll('.stat-item__number').forEach(el => io.observe(el));

  /* ── SCROLL REVEAL ── */
  const revealEls = document.querySelectorAll(
    '.qa-card,.spec-card,.doctor-card,.testi-card,.pkg-card,.news-card,.about-feature,.stat-item,.why-feature'
  );
  const revealIO = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
      if (!e.isIntersecting) return;
      setTimeout(() => {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
      }, (i % 4) * 80);
      revealIO.unobserve(e.target);
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

  revealEls.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(22px)';
    el.style.transition = 'opacity .5s ease, transform .5s ease';
    revealIO.observe(el);
  });

  /* ── COUNTDOWN TIMER ── */
  const endDate = new Date('2026-06-30T23:59:59');
  const updateCountdown = () => {
    const diff = endDate - Date.now();
    if (diff <= 0) return;
    const d = Math.floor(diff / 86400000);
    const h = Math.floor((diff % 86400000) / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    const pad = n => String(n).padStart(2, '0');
    const cd = document.getElementById('cd-days');
    const ch = document.getElementById('cd-hours');
    const cm = document.getElementById('cd-mins');
    const cs = document.getElementById('cd-secs');
    if (cd) cd.textContent = pad(d);
    if (ch) ch.textContent = pad(h);
    if (cm) cm.textContent = pad(m);
    if (cs) cs.textContent = pad(s);
  };
  updateCountdown();
  setInterval(updateCountdown, 1000);

  /* ── QUICK BOOKING ── */
  const qbSubmit = document.getElementById('qb-submit');
  if (qbSubmit) {
    qbSubmit.addEventListener('click', () => {
      const sp = document.getElementById('qb-specialty').value;
      const dt = document.getElementById('qb-date').value;
      const tm = document.getElementById('qb-time').value;
      if (!sp) { alert('Vui lòng chọn chuyên khoa!'); return; }
      alert(`✅ Đặt lịch thành công!\n\nChuyên khoa: ${sp}\nNgày khám: ${dt || 'Sẽ được xác nhận'}\nBuổi: ${tm}\n\nChúng tôi sẽ liên hệ trong vòng 30 phút.`);
    });
  }

  /* ── SMOOTH SCROLL ── */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const t = document.querySelector(a.getAttribute('href'));
      if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    });
  });

  /* ── FLOATING CHAT BUTTONS ALWAYS VISIBLE ── */
  const floatActions = document.getElementById('float-actions');
  if (floatActions) {
    floatActions.style.opacity = '1';
    floatActions.style.visibility = 'visible';
  }
  /* ── VIDEO PLAYLIST CONTROLLER ── */
  const playlistCards = document.querySelectorAll('.playlist-card');
  const mainPlayer = document.getElementById('main-youtube-player');
  const mainVideoTitle = document.getElementById('main-video-title');
  const mainVideoDesc = document.getElementById('main-video-desc');

  if (playlistCards.length > 0 && mainPlayer) {
    playlistCards.forEach(card => {
      card.addEventListener('click', () => {
        // Remove active class from all cards
        playlistCards.forEach(c => c.classList.remove('playlist-card--active'));
        
        // Add active class to clicked card
        card.classList.add('playlist-card--active');
        
        // Get data attributes
        const videoId = card.dataset.videoId;
        const title = card.dataset.title;
        const desc = card.dataset.desc;
        
        // Apply fade-out effect to main player wrap for smooth transition
        const playerWrap = document.querySelector('.media-player-wrap');
        if (playerWrap) {
          playerWrap.style.opacity = '0.7';
          playerWrap.style.transform = 'scale(0.99)';
          playerWrap.style.transition = 'all 0.3s ease';
        }
        
        setTimeout(() => {
          // Update player iframe src
          mainPlayer.src = `https://www.youtube.com/embed/${videoId}?enablejsapi=1&autoplay=1`;
          
          // Update text content
          if (mainVideoTitle) mainVideoTitle.textContent = title;
          if (mainVideoDesc) mainVideoDesc.textContent = desc;
          
          // Fade back in
          if (playerWrap) {
            playerWrap.style.opacity = '1';
            playerWrap.style.transform = 'translateY(-5px)';
          }
        }, 250);
      });
    });
  }

  console.log('%cCIH Demo v3.0 loaded ✅', 'color:#007da5;font-weight:bold;font-size:14px');
});


/* ── BANNER SLIDER FUNCTIONS ── */
let currentMemberSlide = 0;
window.changeSlide = function(direction) {
  const slides = document.querySelectorAll('.member-banner-slider .slide');
  const dots = document.querySelectorAll('.member-banner-slider .dot');
  if (!slides.length) return;
  slides[currentMemberSlide]?.classList.remove('active');
  dots[currentMemberSlide]?.classList.remove('active');
  currentMemberSlide = (currentMemberSlide + direction + slides.length) % slides.length;
  slides[currentMemberSlide]?.classList.add('active');
  dots[currentMemberSlide]?.classList.add('active');
};

window.setSlide = function(index) {
  const slides = document.querySelectorAll('.member-banner-slider .slide');
  const dots = document.querySelectorAll('.member-banner-slider .dot');
  if (!slides.length) return;
  slides[currentMemberSlide]?.classList.remove('active');
  dots[currentMemberSlide]?.classList.remove('active');
  currentMemberSlide = (index + slides.length) % slides.length;
  slides[currentMemberSlide]?.classList.add('active');
  dots[currentMemberSlide]?.classList.add('active');
};

setInterval(() => {
  if (document.querySelector('.member-banner-slider')) {
    window.changeSlide(1);
  }
}, 5000);

/* ── SECTION SLIDER ARROWS (BÁC SĨ & TIN TỨC) ── */
document.addEventListener('DOMContentLoaded', () => {
  function initSectionSlider(prevId, nextId, trackWrapId) {
    const prevBtn = document.getElementById(prevId);
    const nextBtn = document.getElementById(nextId);
    const trackWrap = document.getElementById(trackWrapId);

    if (!trackWrap) return;

    const getScrollAmount = () => {
      const card = trackWrap.querySelector('.doctor-card, .doc-card-v2, .news-card, .spec-card, .pkg-card');
      return card ? (card.offsetWidth + 24) : 320;
    };

    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        trackWrap.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        trackWrap.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
      });
    }
  }

  initSectionSlider('doc-prev', 'doc-next', 'doc-track-wrap');
  initSectionSlider('doc-side-prev', 'doc-side-next', 'doc-track-wrap');
  initSectionSlider('news-prev', 'news-next', 'news-track-wrap');
  initSectionSlider('news-side-prev', 'news-side-next', 'news-track-wrap');
  initSectionSlider('spec-prev', 'spec-next', 'spec-track-wrap');
  initSectionSlider('spec-side-prev', 'spec-side-next', 'spec-track-wrap');
  initSectionSlider('pkg-prev', 'pkg-next', 'pkg-track-wrap');
  initSectionSlider('pkg-side-prev', 'pkg-side-next', 'pkg-track-wrap');
  initSectionSlider('case-prev', 'case-next', 'case-track-wrap');
  initSectionSlider('case-side-prev', 'case-side-next', 'case-track-wrap');

  /* ── MOBILE INFINITE LOOP CAROUSEL SLIDER ── */
  function initMobileInfiniteSlider(trackId, prevBtnId, nextBtnId) {
    const track = document.getElementById(trackId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!track || !prevBtn || !nextBtn) return;

    let currentIndex = 0;

    function updateSlider() {
      const items = track.children;
      const totalItems = items.length;
      if (totalItems === 0) return;

      const isDesktop = window.innerWidth > 768;
      const visibleCount = isDesktop ? 3 : 1;
      const maxIndex = Math.max(0, totalItems - visibleCount);

      // Infinite loop wrap
      if (currentIndex > maxIndex) currentIndex = 0;
      if (currentIndex < 0) currentIndex = maxIndex;

      if (isDesktop) {
        // Shift percent for 3-column view: currentIndex * (33.333% + gap)
        const shiftPercent = currentIndex * 35.666;
        track.style.transform = `translateX(-${shiftPercent}%)`;
      } else {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
      }
    }

    nextBtn.addEventListener('click', (e) => {
      e.preventDefault();
      currentIndex++;
      updateSlider();
    });

    prevBtn.addEventListener('click', (e) => {
      e.preventDefault();
      currentIndex--;
      updateSlider();
    });

    // Touch swipe support on mobile
    let startX = 0;
    let dist = 0;

    track.addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
      dist = 0;
    }, { passive: true });

    track.addEventListener('touchmove', (e) => {
      dist = e.touches[0].clientX - startX;
    }, { passive: true });

    track.addEventListener('touchend', () => {
      if (Math.abs(dist) > 35) {
        if (dist < 0) {
          currentIndex++;
        } else {
          currentIndex--;
        }
        updateSlider();
      }
    });

    window.addEventListener('resize', () => {
      updateSlider();
    });
  }

  initMobileInfiniteSlider('spec-grid', 'spec-mob-prev', 'spec-mob-next');
  initMobileInfiniteSlider('doc-grid-3', 'doc-mob-prev', 'doc-mob-next');
  initMobileInfiniteSlider('pkg-grid', 'pkg-mob-prev', 'pkg-mob-next');
  initMobileInfiniteSlider('news-grid-3', 'news-mob-prev', 'news-mob-next');

  /* ── NEWS CATEGORY TABS FILTER (FV STYLE) ── */
  const newsTabs = document.querySelectorAll('.news-tab');
  newsTabs.forEach(tab => {
    tab.addEventListener('click', (e) => {
      e.preventDefault();
      newsTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const filter = tab.getAttribute('data-filter');
      const newsCards = document.querySelectorAll('#news-track .news-card');

      newsCards.forEach(card => {
        const cat = card.getAttribute('data-category');
        if (filter === 'all' || cat === filter) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  /* ── DATASET FEED RENDERER FOR NEWS, DOCTORS, SPECIALTIES ── */
  async function loadCihDataset() {
    try {
      const res = await fetch('data/cih_dataset.json');
      if (!res.ok) return null;
      return await res.json();
    } catch (err) {
      console.error('Error loading dataset:', err);
      return null;
    }
  }

  loadCihDataset().then(dataset => {
    if (!dataset) return;

    // 1. DETAIL NEWS PAGE (chi-tiet-tin-tuc.html)
    if (document.getElementById('art-title') && document.getElementById('art-body')) {
      const urlParams = new URLSearchParams(window.location.search);
      const artId = urlParams.get('id');
      const artSlug = urlParams.get('slug');
      let article = null;

      if (artId) {
        article = dataset.posts.find(p => p.id == artId);
      } else if (artSlug) {
        article = dataset.posts.find(p => p.slug === artSlug);
      }

      if (!article && dataset.posts.length > 0) {
        article = dataset.posts[0]; // fallback
      }

      function formatDate(dStr) {
        if (!dStr) return '';
        dStr = String(dStr).trim();
        const ymdMatch = dStr.match(/^(\d{4})[-/](\d{1,2})[-/](\d{1,2})/);
        if (ymdMatch) {
          const y = ymdMatch[1];
          const m = ymdMatch[2].padStart(2, '0');
          const d = ymdMatch[3].padStart(2, '0');
          return `${d}/${m}/${y}`;
        }
        const dmyMatch = dStr.match(/^(\d{1,2})[-/](\d{1,2})[-/](\d{4})/);
        if (dmyMatch) {
          const d = dmyMatch[1].padStart(2, '0');
          const m = dmyMatch[2].padStart(2, '0');
          const y = dmyMatch[3];
          return `${d}/${m}/${y}`;
        }
        return dStr;
      }

      function formatTitleCase(str) {
        if (!str) return '';
        str = String(str).trim();
        const letters = str.replace(/[^a-zA-ZàáảãạâầấẩẫậăằắẳẵặèéẻẽẹêềếểễệđìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửữựỳýỷỹỵĐÀÁẢÃẠÂẦẤẨẪẬĂẰẮẲẴẶÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỮỰỲÝỶỸỴ]/g, '');
        if (letters && letters === letters.toUpperCase()) {
          let res = str.toLowerCase();
          res = res.charAt(0).toUpperCase() + res.slice(1);
          const acronyms = [
            ['cme', 'CME'], ['cih', 'CIH'], ['pr', 'PR'], ['aaci', 'AACI'], ['jci', 'JCI'],
            ['nicu', 'NICU'], ['vip', 'VIP'], ['tp. hcm', 'TP. HCM'], ['bs.ckii', 'BS.CKII'],
            ['bs.cki', 'BS.CKI'], ['bs', 'BS'], ['gs', 'GS']
          ];
          acronyms.forEach(([ac, rep]) => {
            const reg = new RegExp('\\b' + ac.replace('.', '\\.') + '\\b', 'gi');
            res = res.replace(reg, rep);
          });
          return res;
        }
        return str;
      }

      if (article) {
        document.title = formatTitleCase(article.title) + " | Bệnh viện Quốc tế City";
        if (document.getElementById('art-title')) {
          document.getElementById('art-title').innerText = formatTitleCase(article.title);
        }
        if (document.getElementById('art-date-val')) {
          document.getElementById('art-date-val').innerText = formatDate(article.date);
        }
        if (document.getElementById('art-cat')) {
          document.getElementById('art-cat').innerText = (article.categories && article.categories.length > 0) ? article.categories[0] : 'TIN TỨC';
        }
        
        if (document.getElementById('art-body') && article.content) {
          let bodyHtml = '';
          if (article.image) {
            bodyHtml += `<div style="margin-bottom: 2rem; border-radius: 12px; overflow: hidden; aspect-ratio: 16 / 9;"><img src="${article.image}" alt="${formatTitleCase(article.title)}" style="width: 100%; height: 100%; object-fit: cover;" /></div>`;
          }
          bodyHtml += article.content;
          document.getElementById('art-body').innerHTML = bodyHtml;
        }

        // Render Related Grid
        const relGrid = document.getElementById('related-grid');
        if (relGrid) {
          const related = dataset.posts.filter(p => p.id != article.id).slice(0, 3);
          relGrid.innerHTML = related.map(p => `
            <article class="news-card news-card--standard">
              <a href="chi-tiet-tin-tuc?id=${p.id}" class="news-card__img-link">
                <img src="${p.image || 'images/HÌNH ẢNH/Phòng khám Quốc tế/27.png'}" alt="${formatTitleCase(p.title)}" class="news-card__img" />
                <span class="news-card__cat">${p.categories[0] || 'TIN TỨC'}</span>
              </a>
              <div class="news-card__body">
                <div class="news-card__meta">${formatDate(p.date)}</div>
                <h3 class="news-card__title"><a href="chi-tiet-tin-tuc?id=${p.id}">${formatTitleCase(p.title)}</a></h3>
                <a href="chi-tiet-tin-tuc?id=${p.id}" class="news-card__more">Xem thêm →</a>
              </div>
            </article>
          `).join('');
        }
      }
    }

    // 2. NEWS LIST PAGE (tin-tuc.html)
    const newsListGrid = document.getElementById('news-list-grid');
    if (newsListGrid) {
      newsListGrid.innerHTML = dataset.posts.map(p => `
        <article class="news-card news-card--standard">
          <a href="chi-tiet-tin-tuc?id=${p.id}" class="news-card__img-link">
            <img src="${p.image || 'images/HÌNH ẢNH/Phòng khám Quốc tế/27.png'}" alt="${formatTitleCase(p.title)}" class="news-card__img" />
            <span class="news-card__cat">${p.categories[0] || 'TIN TỨC'}</span>
          </a>
          <div class="news-card__body">
            <div class="news-card__meta">${formatDate(p.date)}</div>
            <h3 class="news-card__title"><a href="chi-tiet-tin-tuc?id=${p.id}">${formatTitleCase(p.title)}</a></h3>
            <p class="news-card__excerpt">${p.excerpt ? p.excerpt.slice(0, 90) : ''}...</p>
            <a href="chi-tiet-tin-tuc?id=${p.id}" class="news-card__more">Xem thêm →</a>
          </div>
        </article>
      `).join('');
    }

    window.cihGlobalDataset = dataset;

    // 3. DOCTORS PAGE (bac-si.html)
    const docGrid = document.querySelector('.doc-grid-4');
    if (docGrid && dataset.doctors.length > 0) {
      docGrid.innerHTML = dataset.doctors.map((d, i) => `
        <div class="doc-card-v2 doc-detail-card animate-fade-up" style="animation-delay: ${(i % 10) * 0.04}s;">
          <div class="doc-card-v2__img-wrap" onclick="openDoctorModal(${d.id})" style="cursor: pointer;">
            <img src="${d.image || 'images/doctor_male_1.png'}" alt="${d.name}" class="doc-card-v2__img" onerror="this.src='images/doctor_male_1.png'" />
          </div>
          <div class="doc-card-v2__body">
            <h3 class="doc-card-v2__name" onclick="openDoctorModal(${d.id})" style="cursor: pointer;">${d.name}</h3>
            <div class="doc-card-v2__position">${d.position ? d.position.replace(/&amp;/g, '&').slice(0, 80) : 'Bác sĩ chuyên khoa'}</div>
            <button type="button" onclick="openDoctorModal(${d.id})" class="doc-card-v2__more-link" style="background: none; border: none; padding: 0; cursor: pointer; text-align: left; margin-top: 0.5rem;">Xem thêm <span class="arrow">→</span></button>
          </div>
        </div>
      `).join('');
    }
  });
});

window.openDoctorModal = function(docId) {
  let d = null;
  if (window.CIH_DOCTORS && Array.isArray(window.CIH_DOCTORS)) {
    d = window.CIH_DOCTORS.find(item => item.id == docId);
  }
  if (!d && window.cihGlobalDataset && window.cihGlobalDataset.doctors) {
    d = window.cihGlobalDataset.doctors.find(item => item.id == docId);
  }
  if (!d) {
    console.warn('Doctor not found for ID:', docId);
    return;
  }

  // Navigate to doctor detail page (giống cih.com.vn/bac-si/slug/)
  if (d.slug) {
    window.location.href = 'bac-si/' + d.slug;
  } else {
    // Fallback: open modal if no slug
    const imgEl = document.getElementById('doc-modal-img');
    const nameEl = document.getElementById('doc-modal-name');
    const tagEl = document.getElementById('doc-modal-tag');
    const expEl = document.getElementById('doc-modal-exp');
    const contentEl = document.getElementById('doc-modal-content');

    if (imgEl) imgEl.src = d.image || 'images/doctor_male_1.png';
    if (nameEl) nameEl.innerText = d.name;
    let cleanContent = (d.content || d.excerpt || '<p>Thông tin chuyên môn chi tiết đang được cập nhật.</p>')
      .replace(/Bệnh Viện Quốc Tế City\s*[–\-]\s*Mỗi điểm chạm là một trải nghiệm hạnh phúc!?/gi, '')
      .replace(/Số 3 Đường 17A,\s*Phường An Lạc,\s*TP\.?HCM\.?\s*\(Cạnh siêu thị Aeon Mall Bình Tân\)\.?/gi, '')
      .replace(/Số 3 Đường 17A,\s*Phường An Lạc,\s*TP\.?HCM\.?/gi, '')
      .replace(/(?:Tổng đài|ĐT):\s*19008146/gi, '')
      .replace(/Cấp cứu:\s*\(028\)\s*6290\s*1155/gi, '')
      .trim();
    if (contentEl) contentEl.innerHTML = cleanContent;

    const modal = document.getElementById('doctor-profile-modal');
    if (modal) {
      modal.style.display = 'flex';
    }
  }
};

window.closeDoctorModal = function() {
  const modal = document.getElementById('doctor-profile-modal');
  if (modal) {
    modal.style.display = 'none';
  }
};

/* ── AWARD DETAIL MODAL POPUP ── */
const CIH_AWARDS_DATA = {
  aaci: {
    img: 'images/Website/giai-thuong/gt_acci.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/logo/acci_transparent.png',
    title: 'Chứng nhận Chất lượng Quốc tế AACI (Hoa Kỳ)',
    badge: 'Chứng nhận Quốc tế',
    desc: 'Bệnh viện Quốc tế City là bệnh viện đầu tiên tại Việt Nam đạt Tiêu chuẩn An toàn & Chất lượng Y tế Quốc tế AACI (American Accreditation Commission International). AACI đánh giá toàn diện các tiêu chuẩn khắt khe về an toàn người bệnh, quản lý rủi ro lâm sàng, cơ sở hạ tầng hiện đại và văn hóa y tế lấy người bệnh làm trung tâm.'
  },
  rtac: {
    img: 'images/Website/giai-thuong/gt_rtac.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/logo/RTAC_transparent.png',
    title: 'Chứng nhận Quốc tế Hỗ trợ Sinh sản RTAC (Úc)',
    badge: 'Chứng nhận Quốc tế',
    desc: 'RTAC là bộ tiêu chuẩn chất lượng quốc tế uy tín trong lĩnh vực Hỗ trợ Sinh sản (IVF), do Ủy ban Chứng nhận Kỹ thuật Hỗ trợ Sinh sản trực thuộc Hiệp hội Sinh sản Úc và New Zealand (Fertility Society of Australia) xây dựng và thẩm định. Bộ tiêu chuẩn được áp dụng bắt buộc tại Úc và New Zealand, nhằm đảm bảo an toàn tối đa cho người bệnh, độ chính xác tuyệt đối trong thực hành chuyên môn và tỷ lệ thụ thai thành công vượt trội.'
  },
  asia: {
    img: 'images/Website/giai-thuong/ASIA TOP TRUST BRAND AWARD 2025.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/ASIA TOP TRUST BRAND AWARD 2025.jpg?v=20260812',
    title: 'Top 10 Thương hiệu Uy tín Hàng đầu Châu Á 2025',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Bệnh viện Quốc tế City vinh dự được vinh danh trong hạng mục “Top 10 Thương hiệu Uy tín Hàng đầu Châu Á 2025” (Asia Top Trust Brand Award 2025). Giải thưởng ghi nhận chiến lược phát triển bền vững, chất lượng điều trị y tế chuyên sâu, dịch vụ chăm sóc chuẩn 5 sao và uy tín hàng đầu của bệnh viện trong khu vực.'
  },
  'asia-brand': {
    img: 'images/Website/giai-thuong/ASIA TOP TRUST BRAND AWARD 2025.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/ASIA TOP TRUST BRAND AWARD 2025.jpg?v=20260812',
    title: 'Top 10 Thương hiệu Uy tín Hàng đầu Châu Á 2025',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Bệnh viện Quốc tế City vinh dự được vinh danh trong hạng mục “Top 10 Thương hiệu Uy tín Hàng đầu Châu Á 2025” (Asia Top Trust Brand Award 2025). Giải thưởng ghi nhận chiến lược phát triển bền vững, chất lượng điều trị y tế chuyên sâu, dịch vụ chăm sóc chuẩn 5 sao và uy tín hàng đầu của bệnh viện trong khu vực.'
  },
  ihf: {
    img: 'images/Website/giai-thuong/gt_ihf.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/gt_ihf.jpg?v=20260812',
    title: 'Thành viên Liên đoàn Bệnh viện Quốc tế (IHF)',
    badge: 'Hội viên Toàn cầu',
    desc: 'Bệnh viện Quốc tế City tự hào là thành viên chính thức độc lập của Liên đoàn Bệnh viện Quốc tế (International Hospital Federation - IHF). Là tổ chức phi chính phủ toàn cầu đại diện cho các bệnh viện và tổ chức chăm sóc sức khỏe uy tín, IHF kết nối CIH với mạng lưới các chuyên gia y tế thế giới nhằm không ngừng nâng cao chất lượng dịch vụ theo chuẩn quốc tế.'
  },
  esc: {
    img: 'images/Website/giai-thuong/cert_esc_icare.png?v=20260812',
    logo: 'images/Website/giai-thuong/logo/Esc-logo_transparent.png',
    title: 'Chứng nhận Quốc tế Điều trị Suy tim Full ICARe-HF (ESC/HFA)',
    badge: 'Chứng nhận Quốc tế',
    desc: 'Bệnh viện Quốc tế City vinh dự là 1 trong 4 bệnh viện duy nhất tại TP. HCM đạt chứng nhận Quốc tế cao nhất trong điều trị suy tim (Full ICARe-HF Accreditation), cấp bởi Hiệp hội Tim mạch Châu Âu ESC/HFA. Đây là chứng nhận quốc tế uy tín, đánh giá toàn diện chất lượng chăm sóc và điều trị bệnh nhân suy tim dựa trên các tiêu chuẩn chuyên môn nghiêm ngặt của châu Âu.'
  },
  'healthcare-asia': {
    img: 'images/Website/giai-thuong/HEALTHCARE ASIA AWARD 2023.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/HEALTHCARE ASIA AWARD 2023.jpg?v=20260812',
    title: 'Giải thưởng Healthcare Asia Awards 2023',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Giải thưởng danh giá Healthcare Asia Awards 2023 vinh danh Bệnh viện Quốc tế City với hạng mục "Most Improved Community Hospital of the Year - Vietnam" nhờ những nỗ lực không ngừng trong việc đổi mới quy trình khám chữa bệnh, ứng dụng kỹ thuật cao và nâng tầm trải nghiệm chăm sóc sức khỏe cộng đồng.'
  },
  top10ivf: {
    img: 'images/Website/giai-thuong/top10ivf.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/top10ivf.jpg?v=20260812',
    title: 'Top 10 Trung tâm Hỗ trợ Sinh sản Tốt nhất Việt Nam 2025',
    badge: 'Giải thưởng Y tế',
    desc: 'Trung tâm Hỗ trợ Sinh sản (IVF Center) thuộc Bệnh viện Quốc tế City vinh dự đạt danh hiệu Top 10 Trung tâm Hỗ trợ Sinh sản tốt nhất Việt Nam. Giải thưởng khẳng định năng lực chuyên môn vượt trội của đội ngũ bác sĩ, chuyên gia phôi học giàu kinh nghiệm, hệ thống phòng Lab sạch chuẩn quốc tế và tỷ lệ điều trị hiếm muộn thành công hàng đầu tại Việt Nam.'
  },
  'top-10-ivf': {
    img: 'images/Website/giai-thuong/top10ivf.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/top10ivf.jpg?v=20260812',
    title: 'Top 10 Trung tâm Hỗ trợ Sinh sản Tốt nhất Việt Nam 2025',
    badge: 'Giải thưởng Y tế',
    desc: 'Trung tâm Hỗ trợ Sinh sản (IVF Center) thuộc Bệnh viện Quốc tế City vinh dự đạt danh hiệu Top 10 Trung tâm Hỗ trợ Sinh sản tốt nhất Việt Nam. Giải thưởng khẳng định năng lực chuyên môn vượt trội của đội ngũ bác sĩ, chuyên gia phôi học giàu kinh nghiệm, hệ thống phòng Lab sạch chuẩn quốc tế và tỷ lệ điều trị hiếm muộn thành công hàng đầu tại Việt Nam.'
  },
  top3: {
    img: 'images/Website/giai-thuong/top3.png?v=20260812',
    logo: 'images/Website/giai-thuong/top3.png?v=20260812',
    title: 'Top 3 Thương hiệu Tiêu biểu Châu Á - Thái Bình Dương 2026',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Bệnh viện Quốc tế City tự hào đạt danh hiệu "Top 3 Thương hiệu Tiêu biểu Châu Á - Thái Bình Dương 2026". Đây là minh chứng rõ nét cho sự đầu tư chuẩn mực về chuyên môn, công nghệ y khoa hiện đại và dịch vụ y tế hướng tới trải nghiệm hoàn hảo cho khách hàng.'
  },
  'top-3': {
    img: 'images/Website/giai-thuong/top3.png?v=20260812',
    logo: 'images/Website/giai-thuong/top3.png?v=20260812',
    title: 'Top 3 Thương hiệu Tiêu biểu Châu Á Thái Bình Dương 2026',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Tại Diễn đàn Kinh tế Châu Á – Thái Bình Dương (APEF) diễn ra ở Bắc Kinh, Bệnh viện Quốc tế City vinh dự được vinh danh trong hạng mục “Top 3 Thương hiệu – Doanh nghiệp tiêu biểu Châu Á Thái Bình Dương 2026”. Giải thưởng là sự ghi nhận xứng đáng cho hành trình tiên phong đổi mới, năng lực y tế chuyên môn sâu, chất lượng dịch vụ 5 sao và uy tín vững chắc của CIH trên trường quốc tế.'
  },
  iso: {
    img: 'images/Website/giai-thuong/iso.png?v=20260812',
    logo: 'images/Website/giai-thuong/iso.png?v=20260812',
    title: 'Chứng Nhận ISO 15189:2022',
    badge: 'Tiêu chuẩn Quốc tế',
    desc: 'Khoa Xét nghiệm Bệnh viện Quốc tế City cũng đạt chứng nhận ISO 15189:2022 - thuộc tổ chức tiêu chuẩn hóa quốc tế (ISO) toàn cầu. Trong lĩnh vực y học xét nghiệm, ISO 15189:2022 được xem là chuẩn mực khắt khe bậc nhất, các tiêu chí đánh giá toàn diện năng lực và chất lượng Khoa Xét nghiệm của bệnh viện.'
  },
  'iso-15189': {
    img: 'images/Website/giai-thuong/iso.png?v=20260812',
    logo: 'images/Website/giai-thuong/iso.png?v=20260812',
    title: 'Chứng Nhận ISO 15189:2022',
    badge: 'Tiêu chuẩn Quốc tế',
    desc: 'Khoa Xét nghiệm Bệnh viện Quốc tế City cũng đạt chứng nhận ISO 15189:2022 - thuộc tổ chức tiêu chuẩn hóa quốc tế (ISO) toàn cầu. Trong lĩnh vực y học xét nghiệm, ISO 15189:2022 được xem là chuẩn mực khắt khe bậc nhất, các tiêu chí đánh giá toàn diện năng lực và chất lượng Khoa Xét nghiệm của bệnh viện.'
  },
  'top10-asia-2025': {
    img: 'images/Website/giai-thuong/gt_thuonghieuxuatsac.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/gt_thuonghieuxuatsac.jpg?v=20260812',
    title: 'Top 10 thương hiệu xuất sắc Châu Á 2025',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Danh hiệu danh giá này được xét duyệt dựa trên những tiêu chí khắt khe như chất lượng dịch vụ, uy tín thương hiệu, hệ thống quản lý chất lượng và các giá trị đóng góp cho cộng đồng. Đây là một bước tiến quan trọng, đánh dấu vị thế ngày càng vững chắc của Bệnh viện Quốc tế City trên bản đồ y tế khu vực, khẳng định chiến lược phát triển bền vững và tầm nhìn hội nhập quốc tế.'
  },
  'top10asia': {
    img: 'images/Website/giai-thuong/gt_thuonghieuxuatsac.jpg?v=20260812',
    logo: 'images/Website/giai-thuong/gt_thuonghieuxuatsac.jpg?v=20260812',
    title: 'Top 10 thương hiệu xuất sắc Châu Á 2025',
    badge: 'Giải thưởng Quốc tế',
    desc: 'Danh hiệu danh giá này được xét duyệt dựa trên những tiêu chí khắt khe như chất lượng dịch vụ, uy tín thương hiệu, hệ thống quản lý chất lượng và các giá trị đóng góp cho cộng đồng. Đây là một bước tiến quan trọng, đánh dấu vị thế ngày càng vững chắc của Bệnh viện Quốc tế City trên bản đồ y tế khu vực, khẳng định chiến lược phát triển bền vững và tầm nhìn hội nhập quốc tế.'
  }
};

window.openAwardModal = function(key) {
  const data = CIH_AWARDS_DATA[key];
  if (!data) return;

  let modal = document.getElementById('award-modal');
  if (!modal) {
    modal = document.createElement('div');
    modal.className = 'award-modal';
    modal.id = 'award-modal';
    modal.onclick = function(e) { if (e.target === modal) closeAwardModal(); };
    modal.innerHTML = `
      <div class="award-modal__content">
        <button class="award-modal__close" onclick="closeAwardModal()" aria-label="Đóng">✕</button>
        <div class="award-modal__img-box" id="award-modal-img-wrap">
          <img id="award-modal-img" src="" alt="" />
        </div>
        <div id="award-modal-badge" class="award-modal__badge">🏆 Chứng nhận Quốc tế</div>
        <h3 class="award-modal__title" id="award-modal-title"></h3>
        <p class="award-modal__desc" id="award-modal-desc"></p>
      </div>
    `;
    document.body.appendChild(modal);
  }

  const imgEl = document.getElementById('award-modal-img') || document.getElementById('award-modal-logo');
  const titleEl = document.getElementById('award-modal-title');
  const descEl = document.getElementById('award-modal-desc');
  const badgeEl = document.getElementById('award-modal-badge');

  if (imgEl) {
    imgEl.src = data.img || data.logo || '';
    imgEl.alt = data.title;
  }
  if (badgeEl && data.badge) {
    badgeEl.textContent = `🏆 ${data.badge}`;
  }
  if (titleEl) titleEl.innerText = data.title;
  if (descEl) descEl.innerHTML = data.desc;

  modal.style.display = 'flex';
  setTimeout(() => {
    modal.classList.add('active');
    modal.style.opacity = '1';
  }, 10);
  document.body.style.overflow = 'hidden';
};

window.closeAwardModal = function() {
  const modal = document.getElementById('award-modal');
  if (modal) {
    modal.classList.remove('active');
    modal.style.opacity = '0';
    setTimeout(() => {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }, 280);
  }
};

// Global escape key listener for award modal
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeAwardModal();
  }
});

/* ════════════════════════════════════════════════════════════════
   LANGUAGE SWITCHER JS LOGIC (VIE, ENG, KHM)
   ════════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('lang-switcher-btn');
  const container = document.getElementById('lang-switcher');

  if (btn && container) {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      container.classList.toggle('open');
    });

    document.addEventListener('click', () => {
      container.classList.remove('open');
    });
  }
});

window.changeLanguage = function(langCode) {
  const flags = {
    'vi': "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 900 600'><rect width='900' height='600' fill='%23da251d'/><polygon fill='%23ffff00' points='450,150 491,276 623,276 516,354 557,480 450,402 343,480 384,354 277,276 409,276'/></svg>",
    'en': "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7410 3900'><rect width='7410' height='3900' fill='%23b22234'/><path d='M0,600H7410M0,1200H7410M0,1800H7410M0,2400H7410M0,3000H7410M0,3600H7410' stroke='%23fff' stroke-width='300'/><rect width='2964' height='2100' fill='%233c3b6e'/><g fill='%23fff'><circle cx='247' cy='175' r='70'/><circle cx='741' cy='175' r='70'/><circle cx='1235' cy='175' r='70'/><circle cx='1729' cy='175' r='70'/><circle cx='2223' cy='175' r='70'/><circle cx='2717' cy='175' r='70'/><circle cx='494' cy='350' r='70'/><circle cx='988' cy='350' r='70'/><circle cx='1482' cy='350' r='70'/><circle cx='1976' cy='350' r='70'/><circle cx='2470' cy='350' r='70'/><circle cx='247' cy='525' r='70'/><circle cx='741' cy='525' r='70'/><circle cx='1235' cy='525' r='70'/><circle cx='1729' cy='525' r='70'/><circle cx='2223' cy='525' r='70'/><circle cx='2717' cy='525' r='70'/><circle cx='494' cy='700' r='70'/><circle cx='988' cy='700' r='70'/><circle cx='1482' cy='700' r='70'/><circle cx='1976' cy='700' r='70'/><circle cx='2470' cy='700' r='70'/><circle cx='247' cy='875' r='70'/><circle cx='741' cy='875' r='70'/><circle cx='1235' cy='875' r='70'/><circle cx='1729' cy='875' r='70'/><circle cx='2223' cy='875' r='70'/><circle cx='2717' cy='875' r='70'/><circle cx='494' cy='1050' r='70'/><circle cx='988' cy='1050' r='70'/><circle cx='1482' cy='1050' r='70'/><circle cx='1976' cy='1050' r='70'/><circle cx='2470' cy='1050' r='70'/><circle cx='247' cy='1225' r='70'/><circle cx='741' cy='1225' r='70'/><circle cx='1235' cy='1225' r='70'/><circle cx='1729' cy='1225' r='70'/><circle cx='2223' cy='1225' r='70'/><circle cx='2717' cy='1225' r='70'/><circle cx='494' cy='1400' r='70'/><circle cx='988' cy='1400' r='70'/><circle cx='1482' cy='1400' r='70'/><circle cx='1976' cy='1400' r='70'/><circle cx='2470' cy='1400' r='70'/><circle cx='247' cy='1575' r='70'/><circle cx='741' cy='1575' r='70'/><circle cx='1235' cy='1575' r='70'/><circle cx='1729' cy='1575' r='70'/><circle cx='2223' cy='1575' r='70'/><circle cx='2717' cy='1575' r='70'/><circle cx='494' cy='1750' r='70'/><circle cx='988' cy='1750' r='70'/><circle cx='1482' cy='1750' r='70'/><circle cx='1976' cy='1750' r='70'/><circle cx='2470' cy='1750' r='70'/><circle cx='247' cy='1925' r='70'/><circle cx='741' cy='1925' r='70'/><circle cx='1235' cy='1925' r='70'/><circle cx='1729' cy='1925' r='70'/><circle cx='2223' cy='1925' r='70'/><circle cx='2717' cy='1925' r='70'/></g></svg>",
    'km': "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 600'><rect width='1000' height='150' fill='%23032ea1'/><rect y='150' width='1000' height='300' fill='%23e00025'/><rect y='450' width='1000' height='150' fill='%23032ea1'/><path d='M430,390H570V350H550V330H530V290H510V270H490V290H470V330H450V350H430Z' fill='%23fff'/><path d='M450,330V350H550V330M470,290V330H530V290' fill='%23fff' stroke='%23e00025' stroke-width='6'/></svg>",
    'ja': "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 900 600'><rect width='900' height='600' fill='%23ffffff'/><circle cx='450' cy='300' r='180' fill='%23bc002d'/></svg>",
    'zh-CN': "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 900 600'><rect width='900' height='600' fill='%23ee1c25'/><polygon fill='%23ffde00' points='150,90 168,144 225,144 179,178 196,232 150,198 104,232 121,178 75,144 132,144'/></svg>"
  };

  const btnFlag = document.getElementById('lang-btn-flag');
  if (btnFlag && flags[langCode]) {
    btnFlag.src = flags[langCode];
  }

  // Update active state in menu
  document.querySelectorAll('.lang-option').forEach(opt => {
    if (opt.getAttribute('data-lang') === langCode) {
      opt.classList.add('active');
    } else {
      opt.classList.remove('active');
    }
  });

  // Close dropdown
  const container = document.getElementById('lang-switcher');
  if (container) container.classList.remove('open');

  // Save selected lang to localStorage
  try {
    localStorage.setItem('cih_lang', langCode);
  } catch(e) {}

  // Trigger Google Translate
  const select = document.querySelector('.goog-te-combo');
  if (select) {
    select.value = langCode;
    select.dispatchEvent(new Event('change'));
  }
};

window.googleTranslateElementInit = function() {
  if (window.google && window.google.translate) {
    new window.google.translate.TranslateElement({
      pageLanguage: 'vi',
      includedLanguages: 'vi,en,km',
      autoDisplay: false
    }, 'google_translate_element');

    // Restore saved language if any
    try {
      const savedLang = localStorage.getItem('cih_lang');
      if (savedLang && savedLang !== 'vi') {
        setTimeout(() => {
          changeLanguage(savedLang);
        }, 800);
      }
    } catch(e) {}
  }
};

/* ════════════════════════════════════════════════════════════════
   FACILITIES SPLIT GALLERY VIEWER (AUTO-PLAY & SCROLL)
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
  }, 3500);
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

  /* ── UNIVERSAL SEARCH COMPACT DROPDOWN ── */
  const searchNavItems = document.querySelectorAll('.nav__item--search');
  searchNavItems.forEach(item => {
    if (!item.querySelector('.header-search-dropdown')) {
      item.insertAdjacentHTML('beforeend', `
        <div class="header-search-dropdown" id="header-search-dropdown">
          <form action="bac-si" method="get" class="header-search-form" onsubmit="event.preventDefault(); const val=this.querySelector('.header-search-input').value.trim(); if(val) window.location.href='bac-si?search=' + encodeURIComponent(val);">
            <input type="text" name="s" class="header-search-input" placeholder="Tìm kiếm..." autocomplete="off" />
            <button type="submit" class="header-search-submit">Tìm kiếm</button>
          </form>
        </div>
      `);
    }
  });

  document.querySelectorAll('.header-search-btn, .nav__link--search').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      const parentItem = btn.closest('.nav__item--search') || document.querySelector('.nav__item--search');
      const dropdown = parentItem?.querySelector('.header-search-dropdown') || document.getElementById('header-search-dropdown');
      if (dropdown) {
        const isActive = dropdown.classList.toggle('is-active');
        if (isActive) {
          setTimeout(() => dropdown.querySelector('.header-search-input')?.focus(), 50);
        }
      }
    });
  });

  // Close dropdown on click outside
  document.addEventListener('click', (e) => {
    document.querySelectorAll('.header-search-dropdown.is-active').forEach(dropdown => {
      if (!dropdown.contains(e.target) && !e.target.closest('.header-search-btn, .nav__link--search')) {
        dropdown.classList.remove('is-active');
      }
    });
  });

  // Close dropdown on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.header-search-dropdown.is-active').forEach(dropdown => {
        dropdown.classList.remove('is-active');
      });
    }
  });
});
