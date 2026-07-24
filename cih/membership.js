// FAQ Accordion expansion logic
  function toggleFaq(btn) {
    const item = btn.parentElement;
    const content = btn.nextElementSibling;
    const isActive = item.classList.contains('faq-item--active');
    
    // Close other active items in the current active group
    const activeGroup = item.closest('.faq-group-content');
    if (activeGroup) {
      activeGroup.querySelectorAll('.faq-item').forEach(i => {
        if (i !== item) {
          i.classList.remove('faq-item--active');
          i.querySelector('.faq-content').style.maxHeight = null;
        }
      });
    } else {
      const container = item.closest('.faq-container');
      if (container) {
        container.querySelectorAll('.faq-item').forEach(i => {
          if (i !== item) {
            i.classList.remove('faq-item--active');
            i.querySelector('.faq-content').style.maxHeight = null;
          }
        });
      }
    }

    if (isActive) {
      item.classList.remove('faq-item--active');
      content.style.maxHeight = null;
    } else {
      item.classList.add('faq-item--active');
      content.style.maxHeight = content.scrollHeight + "px";
    }
  }

  // Member card expand/collapse logic
  function toggleMemberCard(card, event) {
    // If clicked on registration button, just follow the link, don't collapse/expand
    if (event.target.closest('.member-card__btn')) {
      return;
    }
    
    // Toggle active state
    const isExpanded = card.classList.contains('member-card--expanded');
    
    const details = card.querySelector('.member-card__details');
    const link = card.querySelector('.member-card__toggle-link');
    
    if (isExpanded) {
      card.classList.remove('member-card--expanded');
      if (details) details.style.maxHeight = null;
      if (link) link.innerHTML = 'Xem thêm ▾';
    } else {
      card.classList.add('member-card--expanded');
      if (details) details.style.maxHeight = details.scrollHeight + "px";
      if (link) link.innerHTML = 'Thu gọn ▴';
    }
  }

  // Banner Slider Logic
  let currentSlideIndex = 0;
  let slideTimer = null;
  
  function initSlider() {
    showSlides(currentSlideIndex);
    startSlideTimer();
  }
  
  function showSlides(n) {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    
    if (slides.length === 0) return;
    
    if (n >= slides.length) { currentSlideIndex = 0; }
    if (n < 0) { currentSlideIndex = slides.length - 1; }
    
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    slides[currentSlideIndex].classList.add('active');
    if (dots[currentSlideIndex]) {
      dots[currentSlideIndex].classList.add('active');
    }
  }
  
  function changeSlide(n) {
    stopSlideTimer();
    currentSlideIndex += n;
    showSlides(currentSlideIndex);
    startSlideTimer();
  }
  
  function setSlide(n) {
    stopSlideTimer();
    currentSlideIndex = n;
    showSlides(currentSlideIndex);
    startSlideTimer();
  }
  
  function startSlideTimer() {
    slideTimer = setInterval(() => {
      currentSlideIndex++;
      showSlides(currentSlideIndex);
    }, 5000); // auto slide every 5 seconds
  }
  
  function stopSlideTimer() {
    if (slideTimer) {
      clearInterval(slideTimer);
    }
  }
  
  // Call initSlider on load
  document.addEventListener('DOMContentLoaded', () => {
    initSlider();
    
    // Mobile membership slider navigation
    const prevBtn = document.getElementById('member-prev-btn');
    const nextBtn = document.getElementById('member-next-btn');
    const gridContainer = document.getElementById('dat-mua');
    
    if (prevBtn && nextBtn && gridContainer) {
      prevBtn.addEventListener('click', () => {
        const cards = gridContainer.querySelectorAll('.member-card');
        if (cards.length > 0) {
          const cardWidth = cards[0].offsetWidth;
          const step = cardWidth + 20; // card width + gap (gap: 1.25rem = 20px)
          const currentIndex = Math.round(gridContainer.scrollLeft / step);
          
          let targetIndex = currentIndex - 1;
          if (targetIndex < 0) {
            targetIndex = cards.length - 1; // loop to last card (Diamond)
          }
          
          gridContainer.scrollTo({
            left: targetIndex * step,
            behavior: 'smooth'
          });
        }
      });
      
      nextBtn.addEventListener('click', () => {
        const cards = gridContainer.querySelectorAll('.member-card');
        if (cards.length > 0) {
          const cardWidth = cards[0].offsetWidth;
          const step = cardWidth + 20; // card width + gap
          const currentIndex = Math.round(gridContainer.scrollLeft / step);
          
          let targetIndex = currentIndex + 1;
          if (targetIndex >= cards.length) {
            targetIndex = 0; // loop to first card (Silver)
          }
          
          gridContainer.scrollTo({
            left: targetIndex * step,
            behavior: 'smooth'
          });
        }
      });
    }

    // ── HEADER SCROLL EFFECT ──
    const header = document.getElementById('cih-header');
    if (header) {
      window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 40);
      }, { passive: true });
    }

    // ── HAMBURGER — MOBILE MENU ──
    const hamburgerBtn = document.getElementById('hamburger-btn');
    if (hamburgerBtn) {
      // Tạo mobile menu overlay nếu chưa có
      let mobileMenu = document.getElementById('cih-mobile-menu');
      if (!mobileMenu) {
        // Lấy các nav links từ custom-nav
        const navLinks = document.querySelectorAll('.custom-nav__item');
        let menuHTML = '<nav id="cih-mobile-menu" style="display:none;position:fixed;top:64px;left:0;right:0;bottom:0;background:#fff;z-index:9999;overflow-y:auto;padding:1rem 1.5rem;box-shadow:0 8px 32px rgba(0,0,0,0.15)">';
        menuHTML += '<ul style="list-style:none;margin:0;padding:0">';
        navLinks.forEach(item => {
          const link = item.querySelector('.custom-nav__link');
          if (link) {
            menuHTML += `<li style="border-bottom:1px solid #e2e8f0">
              <a href="${link.href || '#'}" style="display:block;padding:1rem 0;font-size:1rem;font-weight:700;color:#1a2332;text-transform:uppercase;letter-spacing:0.5px;text-decoration:none">
                ${link.querySelector('.custom-nav__arrow') ? link.innerHTML.replace(/<span[^>]*>.*?<\/span>/g, '') : link.textContent.trim()}
              </a>
            </li>`;
          }
        });
        // Thêm nút đặt lịch
        menuHTML += `<li style="margin-top:1.5rem">
          <a href="/dat-lich-hen/" style="display:block;text-align:center;background:#007da5;color:#fff;padding:0.875rem 1rem;border-radius:999px;font-weight:700;font-size:1rem;text-decoration:none">
            📅 Đặt Lịch Khám
          </a>
        </li>`;
        menuHTML += '</ul></nav>';
        document.body.insertAdjacentHTML('beforeend', menuHTML);
        mobileMenu = document.getElementById('cih-mobile-menu');
      }

      let menuOpen = false;
      hamburgerBtn.addEventListener('click', () => {
        menuOpen = !menuOpen;
        mobileMenu.style.display = menuOpen ? 'block' : 'none';
        // Đổi icon hamburger thành X khi mở
        hamburgerBtn.innerHTML = menuOpen
          ? '<span style="font-size:1.5rem;line-height:1;font-weight:300">&times;</span>'
          : '<span></span><span></span><span></span>';
        document.body.style.overflow = menuOpen ? 'hidden' : '';
      });

      // Đóng menu khi click link
      if (mobileMenu) {
        mobileMenu.querySelectorAll('a').forEach(a => {
          a.addEventListener('click', () => {
            menuOpen = false;
            mobileMenu.style.display = 'none';
            hamburgerBtn.innerHTML = '<span></span><span></span><span></span>';
            document.body.style.overflow = '';
          });
        });
      }
    }

    // ── SEARCH OVERLAY ──
    const searchBtn = document.getElementById('header-search-btn');
    if (searchBtn) {
      let searchOverlay = document.getElementById('cih-search-overlay');
      if (!searchOverlay) {
        document.body.insertAdjacentHTML('beforeend', `
          <div id="cih-search-overlay" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.7);z-index:10000;align-items:flex-start;justify-content:center;padding-top:80px">
            <div style="background:#fff;border-radius:16px;padding:1.25rem 1rem;width:90%;max-width:560px;box-shadow:0 20px 60px rgba(0,0,0,0.3)">
              <form action="https://cih.com.vn/" method="get" style="display:flex;gap:0.5rem;align-items:center">
                <input type="search" name="s" placeholder="Tìm kiếm bác sĩ, dịch vụ..." autofocus
                  style="flex:1;border:1.5px solid #e2e8f0;border-radius:12px;padding:0.75rem 1rem;font-size:1rem;outline:none;font-family:inherit">
                <button type="submit" style="background:#007da5;color:#fff;border:none;border-radius:12px;padding:0.75rem 1.25rem;font-size:1rem;cursor:pointer;font-weight:700">
                  🔍
                </button>
              </form>
              <button id="close-search-btn" style="margin-top:0.75rem;width:100%;background:none;border:none;color:#718096;font-size:0.875rem;cursor:pointer;padding:0.5rem">
                Đóng ✕
              </button>
            </div>
          </div>
        `);
        searchOverlay = document.getElementById('cih-search-overlay');
      }

      searchBtn.addEventListener('click', () => {
        searchOverlay.style.display = 'flex';
        const input = searchOverlay.querySelector('input[type="search"]');
        if (input) setTimeout(() => input.focus(), 100);
      });

      const closeSearchBtn = document.getElementById('close-search-btn');
      if (closeSearchBtn) {
        closeSearchBtn.addEventListener('click', () => {
          searchOverlay.style.display = 'none';
        });
      }

      searchOverlay.addEventListener('click', (e) => {
        if (e.target === searchOverlay) {
          searchOverlay.style.display = 'none';
        }
      });
    }
  });