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
      e.preventDefault();
      openModal(menuModal);
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

  // Slider helper with seamless card navigation
  function initAutoSlider(gridId, prevBtnId, nextBtnId, intervalMs = 0) {
    const grid = document.getElementById(gridId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!grid) return;

    let timer = null;
    let isTransitioning = false;

    function getStep() {
      const firstChild = grid.children[0];
      if (!firstChild) return 280;
      const computedGap = parseFloat(window.getComputedStyle(grid).gap) || 20;
      return firstChild.offsetWidth + computedGap;
    }

    function stepNext() {
      if (isTransitioning) return;
      isTransitioning = true;

      const step = getStep();
      const maxScroll = grid.scrollWidth - grid.clientWidth;

      if (grid.scrollLeft >= maxScroll - 15) {
        const first = grid.firstElementChild;
        if (first) {
          grid.appendChild(first);
          grid.scrollLeft -= step;
        }
      }

      grid.scrollBy({ left: step, behavior: 'smooth' });

      setTimeout(() => {
        isTransitioning = false;
      }, 350);
    }

    function stepPrev() {
      if (isTransitioning) return;
      isTransitioning = true;

      const step = getStep();

      if (grid.scrollLeft <= 15) {
        const last = grid.lastElementChild;
        if (last) {
          grid.insertBefore(last, grid.firstElementChild);
          grid.scrollLeft += step;
        }
      }

      grid.scrollBy({ left: -step, behavior: 'smooth' });

      setTimeout(() => {
        isTransitioning = false;
      }, 350);
    }

    function startTimer() {
      if (intervalMs > 0 && !timer) {
        timer = setInterval(stepNext, intervalMs);
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
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        stopTimer();
        stepPrev();
        if (intervalMs > 0) startTimer();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        stopTimer();
        stepNext();
        if (intervalMs > 0) startTimer();
      });
    }
  }

  // SPEISEKARTE and GALLERY: Manual arrow navigation (3 on Desktop, 1 on Mobile)
  initAutoSlider('highlightsGrid', 'highlightsPrev', 'highlightsNext', 0);
  initAutoSlider('galleryGrid', 'galleryPrev', 'galleryNext', 0);
  initAutoSlider('newsGrid', 'ratgeberPrev', 'ratgeberNext', 0);
  initAutoSlider('reviewsSlider', 'reviewsPrev', 'reviewsNext', 0);

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
