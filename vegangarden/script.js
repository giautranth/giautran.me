// VEGAN GARDEN BERLIN - INTERACTIVE JS

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

  // Handle Reservation Form Submit
  const reserveForm = document.getElementById('reserveForm');
  if (reserveForm) {
    reserveForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('resName').value;
      const date = document.getElementById('resDate').value;
      const time = document.getElementById('resTime').value;
      const guests = document.getElementById('resGuests').value;

      alert(`Vielen Dank, ${name}! Ihre Tischreservierung für ${guests} Personen am ${date} um ${time} Uhr wurde erfolgreich angefragt. Wir senden eine Bestätigung per E-Mail.`);
      closeAllModals();
      reserveForm.reset();
    });
  }

  // Custom Flag Language Box (Matching Hoalam style)
  const langBox = document.getElementById('langBox');
  const langCurrent = document.getElementById('langCurrent');
  const langOpts = document.querySelectorAll('.lang-opt');

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

    // Trigger Google Translate engine
    function triggerTranslate(targetLang) {
      const googCombo = document.querySelector('.goog-te-combo');
      if (googCombo) {
        googCombo.value = targetLang;
        googCombo.dispatchEvent(new Event('change'));
      } else {
        setTimeout(() => {
          const retryCombo = document.querySelector('.goog-te-combo');
          if (retryCombo) {
            retryCombo.value = targetLang;
            retryCombo.dispatchEvent(new Event('change'));
          }
        }, 600);
      }
    }

    langOpts.forEach(opt => {
      opt.addEventListener('click', () => {
        langOpts.forEach(o => o.classList.remove('active'));
        opt.classList.add('active');

        const flag = opt.dataset.flag;
        const code = opt.dataset.code;
        const lang = opt.dataset.lang || (code === 'EN' ? 'en' : code === 'VI' ? 'vi' : 'de');

        const flagImg = langCurrent.querySelector('.lang-flag img');
        if (flagImg) {
          flagImg.src = `https://flagcdn.com/w20/${flag}.png`;
          flagImg.alt = flag;
        }

        langBox.classList.remove('open');
        langCurrent.setAttribute('aria-expanded', 'false');

        // Update Article "Read more" links & filter tab labels based on active language
        const moreTxts = document.querySelectorAll('.more-txt');
        const newsTabsList = document.querySelectorAll('.news-tab');
        const allArticlesBtn = document.getElementById('allArticlesBtn');

        if (code === 'EN') {
          moreTxts.forEach(el => el.textContent = 'Read article');
          newsTabsList.forEach(tab => { if (tab.dataset.en) tab.textContent = tab.dataset.en; });
          if (allArticlesBtn) allArticlesBtn.textContent = 'VIEW ALL ARTICLES';
        } else if (code === 'VI') {
          moreTxts.forEach(el => el.textContent = 'Xem thêm');
          newsTabsList.forEach(tab => { if (tab.dataset.vi) tab.textContent = tab.dataset.vi; });
          if (allArticlesBtn) allArticlesBtn.textContent = 'XEM TẤT CẢ BÀI VIẾT';
        } else {
          moreTxts.forEach(el => el.textContent = 'Artikel lesen');
          newsTabsList.forEach(tab => { if (tab.dataset.de) tab.textContent = tab.dataset.de; });
          if (allArticlesBtn) allArticlesBtn.textContent = 'ALLE ARTIKEL ANSEHEN';
        }

        // Trigger automatic full-page translation
        triggerTranslate(lang);
      });
    });
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

  // Auto-slide helper with hover pause and exact item snapping
  function initAutoSlider(gridId, prevBtnId, nextBtnId, intervalMs = 3500) {
    const grid = document.getElementById(gridId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!grid) return;

    let timer = null;

    function getStep() {
      const firstChild = grid.children[0];
      if (!firstChild) return 280;
      const computedGap = parseFloat(window.getComputedStyle(grid).gap) || 20;
      return firstChild.offsetWidth + computedGap;
    }

    function stepNext() {
      const step = getStep();
      const maxScroll = grid.scrollWidth - grid.clientWidth;
      if (grid.scrollLeft >= maxScroll - 15) {
        grid.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        grid.scrollBy({ left: step, behavior: 'smooth' });
      }
    }

    function stepPrev() {
      const step = getStep();
      if (grid.scrollLeft <= 15) {
        grid.scrollTo({ left: grid.scrollWidth, behavior: 'smooth' });
      } else {
        grid.scrollBy({ left: -step, behavior: 'smooth' });
      }
    }

    function startTimer() {
      if (!timer) {
        timer = setInterval(stepNext, intervalMs);
      }
    }

    function stopTimer() {
      if (timer) {
        clearInterval(timer);
        timer = null;
      }
    }

    startTimer();

    grid.addEventListener('mouseenter', stopTimer);
    grid.addEventListener('mouseleave', startTimer);
    grid.addEventListener('touchstart', stopTimer, { passive: true });
    grid.addEventListener('touchend', startTimer, { passive: true });

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        stopTimer();
        stepPrev();
        startTimer();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        stopTimer();
        stepNext();
        startTimer();
      });
    }
  }

  initAutoSlider('highlightsGrid', 'highlightsPrev', 'highlightsNext', 3000);
  initAutoSlider('galleryGrid', 'galleryPrev', 'galleryNext', 3000);
  initAutoSlider('newsGrid', 'ratgeberPrev', 'ratgeberNext', 4000);
  initAutoSlider('reviewsSlider', 'reviewsPrev', 'reviewsNext', 3500);

  // Hero Banner Fade Slider logic (5 seconds auto slide)
  function initHeroSlider(intervalMs = 5000) {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');
    const heroSection = document.getElementById('home');

    if (!slides.length) return;

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
