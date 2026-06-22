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
  }, { threshold: 0.5 });
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

  /* ── BACK TO TOP on scroll ── */
  const floatActions = document.getElementById('float-actions');
  window.addEventListener('scroll', () => {
    if (floatActions) floatActions.style.opacity = window.scrollY > 300 ? '1' : '0';
  }, { passive: true });
  if (floatActions) floatActions.style.opacity = '0';
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
