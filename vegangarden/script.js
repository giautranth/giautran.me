// VEGAN GARDEN BERLIN - INTERACTIVE JS

document.addEventListener('DOMContentLoaded', () => {
  // Mobile Nav Toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const navMenu = document.getElementById('navMenu');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });
  }

  // Modals Logic
  const reservationModal = document.getElementById('reservationModal');
  const menuModal = document.getElementById('menuModal');
  const videoModal = document.getElementById('videoModal');
  const reviewsModal = document.getElementById('reviewsModal');

  // Trigger buttons
  document.querySelectorAll('.js-open-reserve').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(reservationModal);
    });
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

    langOpts.forEach(opt => {
      opt.addEventListener('click', () => {
        langOpts.forEach(o => o.classList.remove('active'));
        opt.classList.add('active');

        const flag = opt.dataset.flag;
        const code = opt.dataset.code;

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

  // Slider Controls Helper (Matching CIH Side Arrows)
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

  initSlider('highlightsGrid', 'highlightsPrev', 'highlightsNext');
  initSlider('newsGrid', 'ratgeberPrev', 'ratgeberNext');
  initSlider('reviewsSlider', 'reviewsPrev', 'reviewsNext');
});
