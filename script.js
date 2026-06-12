/* ================================================================
   HOA LÂM - SHANGRILA · WEBSITE LOGIC & INTERACTION
   ================================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ── NAVBAR & MOBILE TOGGLE ─────────────────────────────────── */
  const navbar = document.getElementById('navbar');
  const navToggle = document.getElementById('navToggle');
  const navLinks = document.getElementById('navLinks');
  const backToTop = document.getElementById('backToTop');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
      backToTop.classList.add('visible');
    } else {
      navbar.classList.remove('scrolled');
      backToTop.classList.remove('visible');
    }
  });

  navToggle?.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });

  // Close menu on link click
  document.querySelectorAll('.nav-link, .dropdown-menu a').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
    });
  });

  // Back to Top click
  backToTop?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ── ACTIVE NAV LINK ON SCROLL ─────────────────────────────── */
  const sections = document.querySelectorAll('section[id]');
  const navAnchors = document.querySelectorAll('.nav-link');

  const navObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navAnchors.forEach(a => a.classList.remove('active'));
        const activeLink = document.querySelector(`.nav-link[href="#${entry.target.id}"]`);
        if (activeLink) {
          activeLink.classList.add('active');
        }
      }
    });
  }, { rootMargin: '-30% 0px -60% 0px' });

  sections.forEach(s => navObserver.observe(s));

  /* ── REVEAL ON SCROLL ANIMATION ────────────────────────────── */
  const revealElements = document.querySelectorAll('.reveal');
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.classList.add('visible');
        }, index * 60);
        revealObserver.unobserve(entry.target);
      }
    });
  }, { rootMargin: '0px 0px -50px 0px' });

  revealElements.forEach(el => revealObserver.observe(el));

  /* ── COUNTER ANIMATION (Slide 15 & 21) ─────────────────────── */
  const statNumbers = document.querySelectorAll('.stat-num, .m-num, .sb-num');
  
  function runCounter(el) {
    const target = parseFloat(el.getAttribute('data-target'));
    const prefix = el.getAttribute('data-prefix') || '';
    const suffix = el.getAttribute('data-suffix') || '';
    const duration = 2000; // ms
    const start = performance.now();
    const isDecimal = target % 1 !== 0;

    const update = (now) => {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      // Ease out cubic
      const ease = 1 - Math.pow(1 - progress, 3);
      const currentVal = target * ease;
      
      el.textContent = prefix + (isDecimal ? currentVal.toFixed(1) : Math.floor(currentVal)) + suffix;

      if (progress < 1) {
        requestAnimationFrame(update);
      }
    };
    requestAnimationFrame(update);
  }

  const countersObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const nums = entry.target.querySelectorAll('.stat-num, .m-num, .sb-num');
        nums.forEach(runCounter);
        countersObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  const statsSections = document.querySelectorAll('.hero-stats, .metrics-grid, .staff-breakdown');
  statsSections.forEach(s => countersObserver.observe(s));

  /* ── HERO FLOATING PARTICLES ───────────────────────────────── */
  const heroParticles = document.getElementById('heroParticles');
  if (heroParticles) {
    for (let i = 0; i < 40; i++) {
      const particle = document.createElement('div');
      const size = Math.random() * 4 + 1;
      Object.assign(particle.style, {
        position: 'absolute',
        width: size + 'px',
        height: size + 'px',
        borderRadius: '50%',
        background: Math.random() > 0.5 ? 'rgba(227, 30, 36, 0.25)' : 'rgba(201, 168, 76, 0.3)',
        left: Math.random() * 100 + '%',
        top: Math.random() * 100 + '%',
        pointerEvents: 'none',
        animation: `float-particle ${Math.random() * 10 + 8}s infinite ease-in-out`,
        animationDelay: Math.random() * 5 + 's'
      });
      heroParticles.appendChild(particle);
    }
  }

  // Inject particle CSS animation dynamically
  const particleStyles = document.createElement('style');
  particleStyles.textContent = `
    @keyframes float-particle {
      0%, 100% { transform: translateY(0) translateX(0) scale(1); opacity: 0.3; }
      50% { transform: translateY(-40px) translateX(20px) scale(1.2); opacity: 0.8; }
    }
  `;
  document.head.appendChild(particleStyles);



  /* ── AWARDS POPUP DETAILS (Slide 16, 17) ──────────────────────── */
  const awardDetails = {
    '2019': {
      title: 'Excellence Award – Asian Hospital Management Association (HMA)',
      desc: 'Bệnh viện Gia An 115 nhận giải thưởng <strong>Excellence Award</strong> về Quản lý Bệnh viện Xuất sắc tại khu vực Châu Á. Giải thưởng ghi nhận những thành tích nổi bật của bệnh viện trong việc tiên phong ứng dụng công nghệ thông tin và cải tiến quy trình khám chữa bệnh hướng tới bệnh nhân.'
    },
    '2023-hsa': {
      title: 'Healthcare Asia Awards 2023 (Singapore)',
      desc: 'Cột mốc lịch sử khi cả <strong>Bệnh viện Quốc tế City (CIH)</strong> và <strong>Bệnh viện Gia An 115</strong> đều được vinh danh tại lễ trao giải Healthcare Asia Awards diễn ra tại Singapore. Đây là hai bệnh viện tư nhân đầu tiên tại Việt Nam xuất sắc nhận giải thưởng danh giá này nhờ sự đầu tư đồng bộ và chất lượng chuyên môn vượt trội.'
    },
    '2023-aaci': {
      title: 'Chứng nhận Chất lượng Y tế Quốc tế AACI (Hoa Kỳ)',
      desc: 'Tháng 11/2023, CIH & Gia An 115 chính thức trở thành hai bệnh viện đầu tiên tại Việt Nam đạt tiêu chuẩn chất lượng y tế của <strong>Hiệp hội Chứng nhận Chất lượng Y tế Hoa Kỳ (AACI)</strong>. Chứng nhận AACI đòi hỏi bệnh viện phải tuân thủ nghiêm ngặt các quy trình an toàn người bệnh và kiểm soát nhiễm khuẩn theo tiêu chuẩn khắt khe nhất thế giới.'
    },
    '2024': {
      title: 'Best Quality Leadership Award 2024 (ESQR - Thụy Sĩ)',
      desc: 'Gia An 115 vinh dự nhận giải thưởng <strong>Best Quality Leadership Award</strong> do Hiệp hội Nghiên cứu Chất lượng Châu Âu (ESQR) trao tặng tại Brussels, Bỉ. Giải thưởng vinh danh các doanh nghiệp, cơ sở y tế trên toàn thế giới đi đầu trong chất lượng lãnh đạo, cải tiến liên tục và áp dụng chuẩn quản trị chất lượng tiên tiến.'
    },
    '2025-leader': {
      title: 'Giải thưởng "Asia\'s Excellent Leader 2025"',
      desc: 'Vinh danh cá nhân <strong>Bà Trần Thị Lâm – Chủ tịch Tập đoàn Hoa Lâm</strong> với danh hiệu "Asia\'s Excellent Leader 2025" tại diễn đàn kinh tế châu Á. Giải thưởng tôn vinh tầm nhìn chiến lược, lòng bền bỉ và những đóng góp to lớn của bà trong việc xã hội hóa y tế tại Việt Nam, mang các giải pháp điều trị kỹ thuật cao về phục vụ nhân dân.'
    },
    '2025-green': {
      title: 'Danh hiệu "Green – Clean – Smart Hospital 2025"',
      desc: 'Gia An 115 được Bộ Y tế và các cơ quan khảo sát đánh giá đạt danh hiệu <strong>Bệnh viện Xanh – Sạch – Thông minh</strong> năm 2025. Giải thưởng chứng nhận quy trình vận hành thân thiện với môi trường, hệ thống xử lý rác thải y tế đạt chuẩn, không gian cảnh quan xanh mát và áp dụng số hóa bệnh án điện tử, thanh toán không dùng tiền mặt.'
    }
  };

  const awardModal = document.getElementById('awardModal');
  const modalClose = document.getElementById('modalClose');
  const modalBody = document.getElementById('modalBody');

  document.querySelectorAll('.award-card').forEach(card => {
    card.addEventListener('click', () => {
      const awardId = card.getAttribute('data-award');
      openAwardDetails(awardId);
    });
  });

  function openAwardDetails(awardId) {
    const data = awardDetails[awardId];
    if (!data) return;

    modalBody.innerHTML = `
      <div class="modal-award-detail">
        <div class="detail-icon">🏆</div>
        <h3 class="detail-title">${data.title}</h3>
        <p>${data.desc}</p>
      </div>
    `;
    awardModal.classList.add('open');
  }

  modalClose?.addEventListener('click', () => {
    awardModal.classList.remove('open');
  });

  awardModal?.addEventListener('click', (e) => {
    if (e.target === awardModal) {
      awardModal.classList.remove('open');
    }
  });

  /* ── TOUR 3D BUTTONS ───────────────────────────────────────── */
  const start3dBtn = document.getElementById('start3dBtn');
  const pulseTourBtn = document.getElementById('pulseTourBtn');

  function openTourLink() {
    window.open('https://360.benhvienphuongdong.vn/', '_blank', 'noopener');
  }

  start3dBtn?.addEventListener('click', openTourLink);
  pulseTourBtn?.addEventListener('click', openTourLink);

  /* ── NEWS TABS FILTER (Slide 23) ────────────────────────────── */
  const tabBtns = document.querySelectorAll('.tab-btn');
  const newsCards = document.querySelectorAll('.news-cards-grid .news-card');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Toggle active tab class
      tabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filterValue = btn.getAttribute('data-filter');

      newsCards.forEach(card => {
        const category = card.getAttribute('data-category');
        // Hide extra news by default unless filtering/showing all
        const isExtra = card.classList.contains('extra-news');
        
        if (filterValue === 'all') {
          card.style.display = isExtra ? 'none' : 'flex';
        } else {
          if (category === filterValue) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        }
      });
    });
  });

  // Load More News Button
  const loadNewsBtn = document.getElementById('loadNewsBtn');
  let newsLoaded = false;

  loadNewsBtn?.addEventListener('click', () => {
    if (!newsLoaded) {
      document.querySelectorAll('.extra-news').forEach(card => {
        card.style.display = 'flex';
        // Force scroll reveal effect
        card.classList.add('visible');
      });
      loadNewsBtn.textContent = 'Đã tải toàn bộ tin tức';
      loadNewsBtn.disabled = true;
      newsLoaded = true;
    }
  });

  /* ── CONTACT FORM SUBMISSION ────────────────────────────────── */
  const coopForm = document.getElementById('coopForm');
  const submitFormBtn = document.getElementById('submitFormBtn');

  coopForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    submitFormBtn.disabled = true;
    submitFormBtn.innerHTML = `<span>Đang gửi thông tin...</span>`;

    setTimeout(() => {
      submitFormBtn.innerHTML = `<span>✓ Gửi yêu cầu thành công!</span>`;
      submitFormBtn.style.background = '#16a34a';
      submitFormBtn.style.boxShadow = '0 6px 20px rgba(22, 163, 74, 0.4)';
      coopForm.reset();

      setTimeout(() => {
        submitFormBtn.innerHTML = `Gửi Yêu Cầu Hợp Tác`;
        submitFormBtn.style.background = '';
        submitFormBtn.style.boxShadow = '';
        submitFormBtn.disabled = false;
      }, 3000);
    }, 1500);
  });

  /* ── AI CHATBOT SYSTEM (Slide 25, 26) ───────────────────────── */
  const chatbotBtn = document.getElementById('chatbotBtn');
  const chatbotBox = document.getElementById('chatbotBox');
  const chatClose = document.getElementById('chatClose');
  const chatMessages = document.getElementById('chatMessages');
  const chatInput = document.getElementById('chatInput');
  const chatSendBtn = document.getElementById('chatSendBtn');

  chatbotBtn?.addEventListener('click', () => {
    chatbotBox.classList.toggle('open');
  });

  chatClose?.addEventListener('click', () => {
    chatbotBox.classList.remove('open');
  });

  const botResponses = {
    'đầu tư': 'HOA LÂM - SHANGRILA đang mở rộng cơ hội đầu tư BOT, PPP hoặc liên doanh vào các phân khu:\n• Bệnh viện Chuyên khoa Tim mạch/Ung bướu (Slide 22)\n• Bệnh viện Phục hồi chức năng & Dưỡng lão\n• Trường Đào tạo y dược & Khu nghiên cứu.\nChúng tôi sẵn sàng kết nối hợp tác tài chính và vận hành y tế! 🤝',
    'bệnh viện': 'Hiện tại khu y tế có 2 bệnh viện tiêu chuẩn quốc tế đang hoạt động:\n1. Bệnh viện Quốc tế City (CIH) - Quy mô 320 giường bệnh.\n2. Bệnh viện Gia An 115 - Mô hình PPP đầu tiên tại miền Nam.\nCả 2 đều đạt chất lượng AACI (Hoa Kỳ) và đoạt nhiều giải thưởng quốc tế. 🏥',
    'con số': 'Những con số ấn tượng của dự án:\n• Tổng diện tích: 37,5 ha\n• Tổng vốn đầu tư: ~1 tỷ USD\n• Quy hoạch: 6 Bệnh viện chuẩn quốc tế\n• Nhân sự: 3.782 nhân viên, 597 bác sĩ, 1.626 điều dưỡng.\n• Điểm hài lòng NES: 85% 📊',
    'đặt lịch': 'Để đặt lịch làm việc với ban quản lý dự án HOA LÂM - SHANGRILA, xin vui lòng điền form Liên hệ ở bên dưới, hoặc gửi email đến: <strong>info@hoalam-shangrila.com</strong>. Hotline: <strong>(+84) 23 6381 9181</strong>. Chúng tôi sẽ liên hệ lại ngay! 📅',
    'default': 'Cảm ơn bạn đã trò chuyện! Tôi là trợ lý ảo hỗ trợ thông tin dự án Hoa Lâm - Shangrila. Bạn có thể hỏi tôi về các chuyên mục như: "cơ hội đầu tư", "thông tin bệnh viện", hoặc "các số liệu thống kê".'
  };

  function getResponse(text) {
    const input = text.toLowerCase();
    if (input.includes('đầu tư') || input.includes('hợp tác') || input.includes('invest')) return botResponses['đầu tư'];
    if (input.includes('bệnh viện') || input.includes('hospital') || input.includes('cih') || input.includes('gia an')) return botResponses['bệnh viện'];
    if (input.includes('con số') || input.includes('thống kê') || input.includes('số liệu') || input.includes('giường')) return botResponses['con số'];
    if (input.includes('lịch') || input.includes('gặp') || input.includes('email') || input.includes('phone') || input.includes('liên hệ')) return botResponses['đặt lịch'];
    return botResponses['default'];
  }

  function appendMessage(text, isUser = false) {
    const msgDiv = document.createElement('div');
    msgDiv.className = `chat-msg ${isUser ? 'user' : 'bot'}`;
    msgDiv.innerHTML = `<div class="msg-bubble">${text.replace(/\n/g, '<br>')}</div>`;
    chatMessages.appendChild(msgDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function sendChatMessage() {
    const text = chatInput.value.trim();
    if (!text) return;

    appendMessage(text, true);
    chatInput.value = '';

    // Show typing bubble
    const typingBubble = document.createElement('div');
    typingBubble.className = 'chat-msg bot';
    typingBubble.innerHTML = `<div class="chat-typing-bubble"><span></span><span></span><span></span></div>`;
    chatMessages.appendChild(typingBubble);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    setTimeout(() => {
      typingBubble.remove();
      const answer = getResponse(text);
      appendMessage(answer);
    }, 1000 + Math.random() * 500);
  }

  chatSendBtn?.addEventListener('click', sendChatMessage);
  chatInput?.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') sendChatMessage();
  });

  // Option quick replies
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('chat-opt-btn')) {
      const text = e.target.textContent.replace(/^[^\s]+\s/, ''); // strip emoji
      chatInput.value = text;
      sendChatMessage();
    }
  });

  /* ── INTERFACE MULTI-LANGUAGE TRANSLATOR (Slide 27) ─────────── */
  const langBox = document.getElementById('langBox');
  const langCurrent = document.getElementById('langCurrent');
  const langDropdown = document.getElementById('langDropdown');

  langCurrent?.addEventListener('click', (e) => {
    e.stopPropagation();
    langBox.classList.toggle('open');
    langCurrent.setAttribute('aria-expanded', langBox.classList.contains('open'));
  });

  // Click outside to close lang dropdown
  document.addEventListener('click', (e) => {
    if (!langBox?.contains(e.target)) {
      langBox?.classList.remove('open');
    }
  });

  // Language dictionary database
  const i18n = {
    vi: {
      toast: '🇻🇳 Đã chuyển đổi sang Tiếng Việt',
      navHome: 'Trang Chủ',
      navAbout: 'Giới Thiệu ▾',
      navEcosystem: 'Hệ Sinh Thái',
      navTour: 'Tour 3D',
      navPartners: 'Đối Tác',
      navNews: 'Tin Tức',
      navContact: 'Liên Hệ'
    },
    en: {
      toast: '🇺🇸 Switched to English',
      navHome: 'Home',
      navAbout: 'About Us ▾',
      navEcosystem: 'Ecosystem',
      navTour: '3D Tour',
      navPartners: 'Partners',
      navNews: 'News',
      navContact: 'Contact'
    },
    ja: {
      toast: '🇯🇵 日本語に切り替えました',
      navHome: 'ホーム',
      navAbout: '紹介 ▾',
      navEcosystem: 'エコシステム',
      navTour: '3Dツアー',
      navPartners: 'パートナー',
      navNews: 'ニュース',
      navContact: '連絡先'
    },
    zh: {
      toast: '🇨🇳 已切换至中文',
      navHome: '首页',
      navAbout: '集团介绍 ▾',
      navEcosystem: '医疗生态',
      navTour: '3D导览',
      navPartners: '合作伙伴',
      navNews: '新闻中心',
      navContact: '联系我们'
    }
  };

  document.querySelectorAll('.lang-opt').forEach(opt => {
    opt.addEventListener('click', () => {
      document.querySelectorAll('.lang-opt').forEach(o => o.classList.remove('active'));
      opt.classList.add('active');

      const lang = opt.getAttribute('data-lang');
      const flag = opt.getAttribute('data-flag');
      const code = opt.getAttribute('data-code');

      // Update button flag & code
      const flagEl = langCurrent.querySelector('.lang-flag');
      if (flagEl) flagEl.innerHTML = `<img src="https://flagcdn.com/w20/${flag}.png" alt="${flag}" width="20" style="vertical-align: middle; border-radius: 2px;" />`;
      const codeEl = langCurrent.querySelector('.lang-code');
      if (codeEl) codeEl.textContent = code;

      langBox.classList.remove('open');

      // Trigger translate function (Simple header transition translation demo)
      translateInterface(lang);

      // Google Translate Integration
      let googleLangCode = lang;
      if (lang === 'zh') googleLangCode = 'zh-CN';
      
      const selectEl = document.querySelector('.goog-te-combo');
      if (selectEl) {
        selectEl.value = googleLangCode;
        selectEl.dispatchEvent(new Event('change'));
      }

      // Show toast message
      const toastText = i18n[lang]?.toast || 'Language changed';
      const toast = document.createElement('div');
      toast.textContent = toastText;
      Object.assign(toast.style, {
        position: 'fixed',
        bottom: '120px',
        left: '50%',
        transform: 'translateX(-50%)',
        background: 'rgba(10, 25, 49, 0.95)',
        border: '1px solid rgba(255, 255, 255, 0.1)',
        color: 'white',
        padding: '10px 24px',
        borderRadius: '50px',
        fontSize: '0.85rem',
        fontWeight: '700',
        zIndex: '99999',
        boxShadow: '0 4px 20px rgba(0,0,0,0.3)',
        backdropFilter: 'blur(5px)',
        transition: 'opacity 0.3s'
      });
      document.body.appendChild(toast);
      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
      }, 2000);
    });
  });

  function translateInterface(lang) {
    const dict = i18n[lang];
    if (!dict) return;

    // Update navigation texts
    const linkHome = document.getElementById('link-home');
    const linkAbout = document.getElementById('link-about');
    const linkEcosystem = document.getElementById('link-ecosystem');
    const linkTour = document.getElementById('link-tour');
    const linkPartners = document.getElementById('link-partners');
    const linkNews = document.getElementById('link-news');
    const linkContact = document.getElementById('link-contact');

    if (linkHome) linkHome.textContent = dict.navHome;
    if (linkAbout) linkAbout.innerHTML = dict.navAbout;
    if (linkEcosystem) linkEcosystem.textContent = dict.navEcosystem;
    if (linkTour) linkTour.textContent = dict.navTour;
    if (linkPartners) linkPartners.textContent = dict.navPartners;
    if (linkNews) linkNews.textContent = dict.navNews;
    if (linkContact) linkContact.textContent = dict.navContact;
  }

  // Console greeting
  console.log('%c🏥 HOA LÂM - SHANGRILA Healthcare Park Website Demo', 'color:#E31E24;font-size:1.3em;font-weight:bold;');
  console.log('%cPowered by Antigravity AI', 'color:#0D568D;font-size:1.0em;');

  /* ── HERO SLIDER (Slide Transition like AIH) ───────────────── */
  const slides = document.querySelectorAll('.hero-slide');
  const prevBtn = document.querySelector('.slider-btn.prev');
  const nextBtn = document.querySelector('.slider-btn.next');
  let currentSlide = 0;
  let slideInterval;

  const heroContent = document.querySelector('.hero-content');

  function showSlide(index) {
    if (slides.length === 0) return;
    slides.forEach(s => s.classList.remove('active'));
    currentSlide = (index + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');

    if (heroContent) {
      if (currentSlide === 0) {
        heroContent.style.opacity = '1';
        heroContent.style.visibility = 'visible';
        heroContent.style.pointerEvents = 'auto';
      } else {
        heroContent.style.opacity = '0';
        heroContent.style.visibility = 'hidden';
        heroContent.style.pointerEvents = 'none';
      }
    }
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  function startInterval() {
    slideInterval = setInterval(nextSlide, 5000);
  }

  function resetInterval() {
    clearInterval(slideInterval);
    startInterval();
  }

  if (slides.length > 0) {
    prevBtn?.addEventListener('click', () => {
      prevSlide();
      resetInterval();
    });

    nextBtn?.addEventListener('click', () => {
      nextSlide();
      resetInterval();
    });

    startInterval();
  }

  // Prevent Google Translate from changing body top position
  const bodyStyleObserver = new MutationObserver(() => {
    if (document.body.style.top && document.body.style.top !== '0px' && document.body.style.top !== '0') {
      document.body.style.top = '0px';
    }
  });
  bodyStyleObserver.observe(document.body, { attributes: true, attributeFilter: ['style'] });
});
