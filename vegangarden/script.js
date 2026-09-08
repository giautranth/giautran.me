// VEGAN GARDEN BERLIN - INTERACTIVE JS

// ── GLOBAL GOOGLE TRANSLATE ENGINE (DE, EN, VI) ──
window.googleTranslateElementInit = function() {
  let el = document.getElementById('google_translate_element');
  if (!el) {
    el = document.createElement('div');
    el.id = 'google_translate_element';
    if (document.body && document.body.firstChild) {
      document.body.insertBefore(el, document.body.firstChild);
    } else if (document.body) {
      document.body.appendChild(el);
    }
  }
  try {
    new window.google.translate.TranslateElement({
      pageLanguage: 'de',
      includedLanguages: 'de,en,vi',
      autoDisplay: false
    }, 'google_translate_element');
  } catch (e) {
    console.warn('Translate init:', e);
  }
};

// Prevent Google Translate from displacing page downward
const fixBodyTop = () => {
  if (document.body && document.body.style.top && document.body.style.top !== '0px') {
    document.body.style.top = '0px';
  }
  if (document.documentElement && document.documentElement.style.top && document.documentElement.style.top !== '0px') {
    document.documentElement.style.top = '0px';
  }
};
setInterval(fixBodyTop, 300);
if (window.MutationObserver) {
  const mo = new MutationObserver(fixBodyTop);
  mo.observe(document.documentElement, { attributes: true, attributeFilter: ['style', 'class'] });
  document.addEventListener('DOMContentLoaded', () => {
    if (document.body) mo.observe(document.body, { attributes: true, attributeFilter: ['style', 'class'] });
  });
}

function ensureGoogleTranslateLoaded() {
  if (window.google && window.google.translate) return;
  if (!document.getElementById('google-translate-script')) {
    const s = document.createElement('script');
    s.id = 'google-translate-script';
    s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async = true;
    document.head.appendChild(s);
  }
}
ensureGoogleTranslateLoaded();

document.addEventListener('DOMContentLoaded', () => {
  // Mobile Nav Toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const navMenu = document.getElementById('navMenu');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      navMenu.classList.toggle('active');
      mobileToggle.classList.toggle('active');
    });

    // Close menu when clicking links inside navMenu
    navMenu.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        mobileToggle.classList.remove('active');
      });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        navMenu.classList.remove('active');
        mobileToggle.classList.remove('active');
      }
    });
  }

  // Modals Logic
  const reservationModal = document.getElementById('reservationModal');
  const menuModal = document.getElementById('menuModal');
  const videoModal = document.getElementById('videoModal');
  const reviewsModal = document.getElementById('reviewsModal');

  // Trigger buttons
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.js-open-reserve, a[href*="elementor-action"]');
    if (btn) {
      const resModal = document.getElementById('reservationModal');
      if (resModal) {
        e.preventDefault();
        openModal(resModal);
      } else {
        const href = btn.getAttribute('href');
        if (!href || href === '#' || href.includes('elementor-action')) {
          e.preventDefault();
          window.location.href = '../kontakt';
        }
      }
    }
  });

  document.querySelectorAll('.js-open-menu').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const href = btn.getAttribute('href');
      if (href && href.endsWith('.pdf')) {
        return;
      }
      e.preventDefault();
      window.open('menu/Druck_Speisekarte_VeganGarden.pdf', '_blank');
    });
  });

  const videoCard = document.getElementById('videoCard');
  if (videoCard) {
    videoCard.addEventListener('click', () => {
      openModal(videoModal);
    });
  }

  document.querySelectorAll('.js-open-reviews').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(reviewsModal);
    });
  });

  // Close modals
  document.querySelectorAll('.modal-close, .js-modal-close').forEach(btn => {
    btn.addEventListener('click', () => {
      closeAllModals();
    });
  });

  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        closeAllModals();
      }
    });
  });

  const gardenVideo = document.getElementById('gardenVideo');

  function openModal(modal) {
    if (!modal) return;
    closeAllModals();
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    if (modal === videoModal && gardenVideo) {
      gardenVideo.play().catch(() => {});
    }
  }

  function closeAllModals() {
    document.querySelectorAll('.modal-overlay').forEach(modal => {
      modal.classList.remove('active');
    });
    document.body.style.overflow = '';
    if (gardenVideo) {
      gardenVideo.pause();
    }
  }

  // Menu Modal Tab Switcher
  const menuTabs = document.querySelectorAll('.menu-tab');
  const menuCategories = document.querySelectorAll('.menu-category-content');

  menuTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const category = tab.dataset.category;
      
      menuTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      menuCategories.forEach(cat => {
        if (cat.id === `cat-${category}`) {
          cat.style.display = 'block';
        } else {
          cat.style.display = 'none';
        }
      });
    });
  });

  // Handle Reservation Form, Monday (Ruhetag) & Time (12:00 - 22:00) Validation
  const resDateInput = document.getElementById('resDate');
  const checkMonday = (inputEl) => {
    if (!inputEl || !inputEl.value) return true;
    const parts = inputEl.value.split('-').map(Number);
    if (parts.length < 3) return true;
    const [y, m, d] = parts;
    const selDate = new Date(y, m - 1, d);
    if (selDate.getDay() === 1) { // 1 = Monday / Thứ Hai
      const lang = (localStorage.getItem('vg_lang') || 'de').toLowerCase();
      let msg = 'Montags hat unser Restaurant Ruhetag. Bitte wählen Sie einen Tag von Dienstag bis Sonntag.';
      if (lang === 'vi') {
        msg = 'Thứ Hai là ngày nhà hàng nghỉ (Ruhetag). Quý khách vui lòng chọn ngày khác từ Thứ Ba đến Chủ Nhật!';
      } else if (lang === 'en') {
        msg = 'We are closed on Mondays (Ruhetag). Please choose another day from Tuesday to Sunday.';
      }
      alert(msg);
      inputEl.value = '';
      inputEl.focus();
      return false;
    }
    return true;
  };

  const resTimeInput = document.getElementById('resTime');
  const checkTime = (inputEl) => {
    if (!inputEl || !inputEl.value) return true;
    const parts = inputEl.value.split(':').map(Number);
    if (parts.length < 2) return true;
    const [h, m] = parts;
    const totalMinutes = h * 60 + (m || 0);
    const minMinutes = 12 * 60; // 12:00
    const maxMinutes = 22 * 60; // 22:00
    if (totalMinutes < minMinutes || totalMinutes > maxMinutes) {
      const lang = (localStorage.getItem('vg_lang') || 'de').toLowerCase();
      let msg = 'Reservierungen sind nur während unserer Öffnungszeiten von 12:00 bis 22:00 Uhr möglich.';
      if (lang === 'vi') {
        msg = 'Nhà hàng chỉ nhận đặt bàn trong khung giờ mở cửa từ 12:00 đến 22:00.';
      } else if (lang === 'en') {
        msg = 'Reservations are only available during our opening hours between 12:00 and 22:00.';
      }
      alert(msg);
      inputEl.value = '18:30';
      inputEl.focus();
      return false;
    }
    return true;
  };

  if (resDateInput) {
    const today = new Date().toISOString().split('T')[0];
    resDateInput.min = today;
    resDateInput.addEventListener('change', () => checkMonday(resDateInput));
    resDateInput.addEventListener('input', () => checkMonday(resDateInput));
  }

  if (resTimeInput) {
    if (resTimeInput.tagName && resTimeInput.tagName.toLowerCase() === 'input') {
      resTimeInput.min = '12:00';
      resTimeInput.max = '22:00';
    }
    resTimeInput.addEventListener('change', () => checkTime(resTimeInput));
  }

  const reserveForm = document.getElementById('reserveForm');
  if (reserveForm) {
    reserveForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const dateEl = document.getElementById('resDate');
      if (dateEl && !checkMonday(dateEl)) {
        return;
      }
      const timeEl = document.getElementById('resTime');
      if (timeEl && !checkTime(timeEl)) {
        return;
      }

      const name = document.getElementById('resName')?.value || '';
      const date = dateEl?.value || '';
      const time = timeEl?.value || '';
      const guests = document.getElementById('resGuests')?.value || '';
      const phone = document.getElementById('resPhone')?.value || '';
      const email = document.getElementById('resEmail')?.value || '';

      const lang = (localStorage.getItem('vg_lang') || 'de').toLowerCase();
      let alertMsg = `Vielen Dank, ${name}! Ihre Tischreservierung für ${guests} Personen am ${date} um ${time} Uhr wurde erfolgreich angefragt. Wir senden eine Bestätigung an ${email}.`;
      if (lang === 'vi') {
        alertMsg = `Cảm ơn quý khách ${name}! Yêu cầu đặt bàn cho ${guests} người vào ngày ${date} lúc ${time} đã được ghi nhận. Nhà hàng sẽ liên hệ xác nhận qua số ${phone} hoặc email ${email} sớm nhất.`;
      } else if (lang === 'en') {
        alertMsg = `Thank you, ${name}! Your table reservation request for ${guests} guests on ${date} at ${time} has been received. We will confirm via ${email} or phone soon.`;
      }

      alert(alertMsg);
      closeAllModals();
      reserveForm.reset();
    });
  }

  // Custom Flag Language Box (Matching Hoalam / CIH style)
  const langBox = document.getElementById('langBox');
  const langCurrent = document.getElementById('langCurrent');
  const langOpts = document.querySelectorAll('.lang-opt');

  function getActiveLang() {
    const m = document.cookie.match(/googtrans=\/de\/([a-z]{2})/i);
    if (m && m[1]) return m[1].toLowerCase();
    const stored = localStorage.getItem('vg_lang');
    if (stored) return stored.toLowerCase();
    return 'de';
  }

  function setLanguage(lang) {
    ensureGoogleTranslateLoaded();
    const targetLang = (lang === 'en' || lang === 'vi') ? lang : 'de';
    localStorage.setItem('vg_lang', targetLang);

    // Update Flag & Active State in UI
    const flagMap = { de: 'de', en: 'us', vi: 'vn' };
    const activeFlag = flagMap[targetLang] || 'de';
    if (langCurrent) {
      const flagImg = langCurrent.querySelector('.lang-flag img');
      if (flagImg) {
        flagImg.src = `https://flagcdn.com/w20/${activeFlag}.png`;
        flagImg.alt = activeFlag;
      }
    }
    langOpts.forEach(o => {
      const optLang = o.dataset.lang || (o.dataset.code === 'EN' ? 'en' : o.dataset.code === 'VI' ? 'vi' : 'de');
      o.classList.toggle('active', optLang === targetLang);
    });

    if (langBox) {
      langBox.classList.remove('open');
      if (langCurrent) langCurrent.setAttribute('aria-expanded', 'false');
    }

    // Update Article "Read more" links & filter tab labels based on active language
    const moreTxts = document.querySelectorAll('.more-txt');
    const newsTabsList = document.querySelectorAll('.news-tab');
    const allArticlesBtn = document.getElementById('allArticlesBtn');

    if (targetLang === 'en') {
      moreTxts.forEach(el => el.textContent = 'Read article');
      newsTabsList.forEach(tab => { if (tab.dataset.en) tab.textContent = tab.dataset.en; });
      if (allArticlesBtn) allArticlesBtn.textContent = 'VIEW ALL ARTICLES';
    } else if (targetLang === 'vi') {
      moreTxts.forEach(el => el.textContent = 'Xem thêm');
      newsTabsList.forEach(tab => { if (tab.dataset.vi) tab.textContent = tab.dataset.vi; });
      if (allArticlesBtn) allArticlesBtn.textContent = 'XEM TẤT CẢ BÀI VIẾT';
    } else {
      moreTxts.forEach(el => el.textContent = 'Artikel lesen');
      newsTabsList.forEach(tab => { if (tab.dataset.de) tab.textContent = tab.dataset.de; });
      if (allArticlesBtn) allArticlesBtn.textContent = 'ALLE ARTIKEL ANSEHEN';
    }

    function triggerCombo(target) {
      const combo = document.querySelector('.goog-te-combo');
      if (combo) {
        combo.value = target;
        if (typeof combo.onchange === 'function') combo.onchange();
        combo.dispatchEvent(new Event('change', { bubbles: true }));
        return true;
      }
      return false;
    }

    if (targetLang === 'de') {
      // Clear cookies to reset to default German
      document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      document.cookie = `googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=${window.location.hostname};`;
      document.cookie = `googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.${window.location.hostname};`;
      
      triggerCombo('de');
      setTimeout(() => {
        window.location.reload();
      }, 100);
      return;
    }

    // Set Google Translate cookie
    document.cookie = `googtrans=/de/${targetLang}; path=/;`;
    document.cookie = `googtrans=/de/${targetLang}; path=/; domain=${window.location.hostname};`;
    document.cookie = `googtrans=/de/${targetLang}; path=/; domain=.${window.location.hostname};`;

    if (!triggerCombo(targetLang)) {
      let attempts = 0;
      const interval = setInterval(() => {
        attempts++;
        if (triggerCombo(targetLang)) {
          clearInterval(interval);
        } else if (attempts >= 8) {
          clearInterval(interval);
          window.location.reload();
        }
      }, 150);
    }
  }

  if (langBox && langCurrent) {
    langCurrent.addEventListener('click', (e) => {
      e.stopPropagation();
      langBox.classList.toggle('open');
      const isExpanded = langBox.classList.contains('open');
      langCurrent.setAttribute('aria-expanded', isExpanded);
    });

    document.addEventListener('click', (e) => {
      if (!langBox.contains(e.target)) {
        langBox.classList.remove('open');
        langCurrent.setAttribute('aria-expanded', 'false');
      }
    });

    langOpts.forEach(opt => {
      opt.addEventListener('click', (e) => {
        e.stopPropagation();
        const code = opt.dataset.code;
        const lang = opt.dataset.lang || (code === 'EN' ? 'en' : code === 'VI' ? 'vi' : 'de');
        setLanguage(lang);
      });
    });

    // Initialize UI with active language
    const currentLang = getActiveLang();
    if (currentLang !== 'de') {
      const flagMap = { en: 'us', vi: 'vn' };
      const flag = flagMap[currentLang] || 'de';
      const flagImg = langCurrent.querySelector('.lang-flag img');
      if (flagImg) {
        flagImg.src = `https://flagcdn.com/w20/${flag}.png`;
        flagImg.alt = flag;
      }
      langOpts.forEach(o => {
        const optLang = o.dataset.lang || (o.dataset.code === 'EN' ? 'en' : o.dataset.code === 'VI' ? 'vi' : 'de');
        o.classList.toggle('active', optLang === currentLang);
      });
    }
  }

  // News / Ratgeber Category Filter Tabs (CIH Style)
  const newsTabs = document.querySelectorAll('.news-tab');
  const newsCards = document.querySelectorAll('.news-card');

  if (newsTabs.length > 0 && newsCards.length > 0) {
    newsTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        newsTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const filter = tab.dataset.filter;

        newsCards.forEach(card => {
          if (filter === 'all' || card.dataset.category === filter) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  function initSlider(gridId, prevBtnId, nextBtnId) {
    const grid = document.getElementById(gridId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!grid || !prevBtn || !nextBtn) return;

    prevBtn.addEventListener('click', () => {
      grid.scrollBy({ left: -320, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
      grid.scrollBy({ left: 320, behavior: 'smooth' });
    });
  }

  // Seamless Infinite Auto Slider - Left to Right Direction (Google Reviews, SPEISEKARTE, GALLERY)
  function initAutoSlider(gridId, prevBtnId, nextBtnId, intervalMs = 0, defaultDirection = 'ltr') {
    const grid = document.getElementById(gridId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!grid) return;

    let timer = null;
    let isTransitioning = false;

    function getStep() {
      const firstChild = grid.firstElementChild;
      if (!firstChild) return 300;
      const computedGap = parseFloat(window.getComputedStyle(grid).gap) || 20;
      return firstChild.offsetWidth + computedGap;
    }

    // Slide Left-to-Right: Cards move smoothly rightwards (→)
    function slideLtr() {
      if (isTransitioning || grid.children.length <= 1) return;
      isTransitioning = true;

      const step = getStep();
      const last = grid.lastElementChild;
      if (last) {
        grid.style.scrollBehavior = 'auto';
        grid.insertBefore(last, grid.firstElementChild);
        grid.scrollLeft += step;
      }

      requestAnimationFrame(() => {
        setTimeout(() => {
          grid.style.scrollBehavior = 'smooth';
          grid.scrollBy({ left: -step, behavior: 'smooth' });

          setTimeout(() => {
            grid.style.scrollBehavior = 'auto';
            isTransitioning = false;
          }, 450);
        }, 30);
      });
    }

    // Slide Right-to-Left: Cards move smoothly leftwards (←)
    function slideRtl() {
      if (isTransitioning || grid.children.length <= 1) return;
      isTransitioning = true;

      const step = getStep();
      grid.style.scrollBehavior = 'smooth';
      grid.scrollBy({ left: step, behavior: 'smooth' });

      setTimeout(() => {
        grid.style.scrollBehavior = 'auto';
        const first = grid.firstElementChild;
        if (first) {
          grid.appendChild(first);
          grid.scrollLeft -= step;
        }
        isTransitioning = false;
      }, 450);
    }

    function startTimer() {
      if (intervalMs > 0 && !timer) {
        timer = setInterval(() => {
          if (defaultDirection === 'ltr') {
            slideLtr();
          } else {
            slideRtl();
          }
        }, intervalMs);
      }
    }

    function stopTimer() {
      if (timer) {
        clearInterval(timer);
        timer = null;
      }
    }

    if (intervalMs > 0) {
      startTimer();
      grid.addEventListener('mouseenter', stopTimer);
      grid.addEventListener('mouseleave', startTimer);
      grid.addEventListener('touchstart', stopTimer, { passive: true });
      grid.addEventListener('touchend', startTimer, { passive: true });

      document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
          stopTimer();
        } else {
          startTimer();
        }
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        stopTimer();
        slideLtr();
        if (intervalMs > 0) startTimer();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        stopTimer();
        slideRtl();
        if (intervalMs > 0) startTimer();
      });
    }
  }

  // Google Reviews, SPEISEKARTE, and GALLERY: Smooth Auto Slider with Left-to-Right transition
  initAutoSlider('highlightsGrid', 'highlightsPrev', 'highlightsNext', 3200, 'ltr');
  initAutoSlider('galleryGrid', 'galleryPrev', 'galleryNext', 3000, 'ltr');
  initAutoSlider('reviewsSlider', 'reviewsPrev', 'reviewsNext', 3500, 'ltr');
  initAutoSlider('newsGrid', 'ratgeberPrev', 'ratgeberNext', 0);

  // Hero Banner Fade Slider logic (5 seconds auto slide)
  function initHeroSlider(intervalMs = 5000) {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    const heroSection = document.getElementById('home');

    if (!slides.length) return;
    if (slides.length <= 1) {
      slides[0].classList.add('active');
      return;
    }

    let currentIndex = 0;
    let timer = null;

    function showSlide(index) {
      if (index >= slides.length) currentIndex = 0;
      else if (index < 0) currentIndex = slides.length - 1;
      else currentIndex = index;

      slides.forEach((slide, i) => {
        if (i === currentIndex) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });

      dots.forEach((dot, i) => {
        if (i === currentIndex) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });
    }

    function startAutoSlide() {
      if (!timer) {
        timer = setInterval(() => {
          showSlide(currentIndex + 1);
        }, intervalMs);
      }
    }

    function stopAutoSlide() {
      if (timer) {
        clearInterval(timer);
        timer = null;
      }
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        showSlide(currentIndex - 1);
        startAutoSlide();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        showSlide(currentIndex + 1);
        startAutoSlide();
      });
    }

    dots.forEach((dot) => {
      dot.addEventListener('click', () => {
        const idx = parseInt(dot.dataset.slide, 10);
        stopAutoSlide();
        showSlide(idx);
        startAutoSlide();
      });
    });

    if (heroSection) {
      heroSection.addEventListener('mouseenter', stopAutoSlide);
      heroSection.addEventListener('mouseleave', startAutoSlide);
      heroSection.addEventListener('touchstart', stopAutoSlide, { passive: true });
      heroSection.addEventListener('touchend', startAutoSlide, { passive: true });
    }

    startAutoSlide();
  }

  initHeroSlider(5000);
});

// ── RECHTLICHE HINWEISE / LEGAL MODAL (Impressum, Datenschutz, Cookie-Einstellungen) ──
window.openLegalModal = function(type) {
  let modal = document.getElementById('vgLegalModal');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'vgLegalModal';
    modal.className = 'modal-overlay';
    modal.style.zIndex = '3000';
    modal.innerHTML = `
      <div class="modal-content" style="max-width: 680px; max-height: 85vh; display: flex; flex-direction: column; padding: 0; overflow: hidden; border-radius: 16px; background: #fff; text-align: left;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; border-bottom: 1px solid rgba(42, 22, 15, 0.1); background: #FAF7F2; gap: 12px; flex-wrap: wrap;">
          <h3 id="vgLegalTitle" class="serif-font" style="margin: 0; font-size: 1.35rem; color: #2A160F;">Rechtliche Hinweise</h3>
          <div style="display: flex; align-items: center; gap: 14px; margin-left: auto;">
            <a id="vgLegalPageLink" href="/vegangarden/impressum.html" target="_blank" style="font-size: 0.82rem; color: #34A853; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
              <span>In neuem Tab öffnen</span>
              <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
            </a>
            <button type="button" class="modal-close" style="position: static; font-size: 1.6rem; color: #6A625A; background: none; border: none; cursor: pointer; line-height: 1;" onclick="closeLegalModal()">&times;</button>
          </div>
        </div>
        <div id="vgLegalBody" style="padding: 24px; overflow-y: auto; font-size: 0.92rem; line-height: 1.65; color: #211A16;"></div>
      </div>
    `;
    document.body.appendChild(modal);
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeLegalModal();
    });
  }

  const linkMap = {
    impressum: '/vegangarden/impressum.html',
    datenschutz: '/vegangarden/datenschutz.html',
    cookies: '/vegangarden/cookie-einstellungen.html'
  };
  const pageLink = document.getElementById('vgLegalPageLink');
  if (pageLink && linkMap[type]) {
    pageLink.href = linkMap[type];
  }

  const contents = {
    impressum: {
      title: 'Impressum',
      body: `
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">Angaben gemäß § 5 TMG</h4>
        <p style="margin-bottom: 16px;">
          <strong>Vegan Garden Berlin</strong><br>
          Frankfurter Allee 21<br>
          10247 Berlin (Friedrichshain), Deutschland
        </p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">Kontakt</h4>
        <p style="margin-bottom: 16px;">
          Telefon: 030 2123 7260 / 0162 464 9999<br>
          E-Mail: info@vegan-garden.berlin<br>
          Website: https://giautran.me/vegangarden/
        </p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h4>
        <p style="margin-bottom: 16px;">Vegan Garden Berlin Management<br>Frankfurter Allee 21, 10247 Berlin</p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">Haftung für Inhalte &amp; Links</h4>
        <p style="margin-bottom: 16px;">Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Für externe Links übernehmen wir keine Haftung; für die Inhalte der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.</p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">Urheberrecht</h4>
        <p>Die durch die Betreiber erstellten Inhalte und Werke auf dieser Website unterliegen dem deutschen Urheberrecht.</p>
      `
    },
    datenschutz: {
      title: 'Datenschutzerklärung',
      body: `
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">1. Datenschutz auf einen Blick</h4>
        <p style="margin-bottom: 16px;">Wir nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften (DSGVO, BDSG) sowie dieser Datenschutzerklärung.</p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">2. Datenerfassung bei Tischreservierungen &amp; Kontakt</h4>
        <p style="margin-bottom: 16px;">Wenn Sie über unsere Website einen Tisch reservieren oder uns per E-Mail / Telefon kontaktieren, werden Ihre Angaben (Name, Telefonnummer, E-Mail, Datum, Personenanzahl) ausschließlich zur Bearbeitung der Reservierung und für Rückfragen verwendet und nicht an Dritte weitergegeben.</p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">3. Externe Dienste (Google Maps &amp; Fonts)</h4>
        <p style="margin-bottom: 16px;">Zur ansprechenden Darstellung unserer Speisekarte und unseres Standorts nutzen wir Google Web Fonts und eine interaktive Google Maps Karte. Anbieter ist die Google Ireland Limited.</p>
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">4. Ihre Rechte</h4>
        <p>Sie haben jederzeit das Recht auf Auskunft, Berichtigung, Sperrung oder Löschung Ihrer bei uns gespeicherten personenbezogenen Daten. Wenden Sie sich hierzu gerne an info@vegan-garden.berlin.</p>
      `
    },
    cookies: {
      title: 'Cookie-Einstellungen',
      body: `
        <h4 style="font-size: 1.1rem; color: #2A160F; margin-bottom: 8px;">Cookie-Präferenzen verwalten</h4>
        <p style="margin-bottom: 16px;">Wir verwenden Cookies, um die einwandfreie Funktion unserer Website (z. B. Sprachauswahl und Reservierungsmodal) zu gewährleisten.</p>
        <div style="background: #F6F1E7; border-left: 4px solid #A98224; padding: 14px; border-radius: 8px; margin-bottom: 16px;">
          <strong style="color: #2A160F;">✓ Technisch notwendige Cookies (Immer aktiv)</strong>
          <p style="margin: 4px 0 0 0; font-size: 0.85rem; color: #6A625A;">Diese Cookies sind für das einwandfreie Funktionieren der Website unerlässlich.</p>
        </div>
        <p style="font-size: 0.88rem; color: #6A625A; margin-bottom: 20px;">Es werden keine Marketing- oder Tracking-Cookies von Drittanbietern ohne Ihre Zustimmung verwendet.</p>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
          <button type="button" class="btn btn-primary" style="padding: 8px 18px; font-size: 0.85rem;" onclick="closeLegalModal()">Auswahl speichern</button>
        </div>
      `
    }
  };

  const item = contents[type];
  if (!item) return;

  document.getElementById('vgLegalTitle').innerText = item.title;
  document.getElementById('vgLegalBody').innerHTML = item.body;
  modal.style.display = 'flex';
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
};

window.closeLegalModal = function() {
  const modal = document.getElementById('vgLegalModal');
  if (modal) {
    modal.classList.remove('active');
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }
};

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeLegalModal();
});
