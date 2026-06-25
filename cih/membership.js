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
  });