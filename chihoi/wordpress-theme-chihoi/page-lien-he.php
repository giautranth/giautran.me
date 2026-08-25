<?php
/**
 * Template Name: Template Liên Hệ
 */
get_header(); ?>


  <!-- ========== MAIN CONTENT: LIÊN HỆ (LAYOUT CIH STANDARD) ========== -->
  <main class="site-section" style="padding-top: 30px; padding-bottom: 60px;">
    <div class="container">
      
      <div class="contact-layout-grid">
        
        <!-- Cột trái: Hình ảnh flycam & các thẻ thông tin -->
        <div class="contact-left-col">
          <!-- 1. Hình ảnh flycam bệnh viện Gia An 115 & Khu Y tế kỹ thuật cao -->
          <img src="photo/giaan/flycam.jpg" alt="Văn phòng Chi hội Bệnh viện Tư nhân Phía Nam" class="contact-banner-img" loading="lazy" />
          
          <!-- 2. Thẻ Địa chỉ -->
          <div class="contact-card-white">
            <div class="contact-icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <div class="contact-card-body">
              <h3>Địa chỉ</h3>
              <p>Số 5 Đường 17A, P. An Lạc, TP. HCM</p>
            </div>
          </div>
          
          <!-- 3. Hai thẻ dưới (Điện thoại & Email) -->
          <div class="contact-grid-bottom">
            <!-- Thẻ Điện thoại -->
            <div class="contact-card-white">
              <div class="contact-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.87 2 2 0 0 1 3.59 2.68h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l.76-.76a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 17z"></path>
                </svg>
              </div>
              <div class="contact-card-body">
                <h3>Điện thoại</h3>
                <p style="font-size: 0.85rem; line-height: 1.5; margin: 0; white-space: nowrap;">
                  <a href="tel:19008146">1900 8146</a><br />
                  <span style="white-space: nowrap;">Hotline Thư ký: <a href="tel:02862901155">(028) 6290 1155</a></span>
                </p>
              </div>
            </div>
            
            <!-- Thẻ Email -->
            <div class="contact-card-white">
              <div class="contact-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
              </div>
              <div class="contact-card-body">
                <h3>Email</h3>
                <p><a href="mailto:info@chihoibenhvientu.com">info@chihoibenhvientu.com</a></p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Cột phải: Form liên hệ chuẩn thiết kế CIH -->
        <div>
          <div class="contact-form-card">
            
            <h2 class="contact-form-title">Liên hệ</h2>

            <form id="contact-custom-form" novalidate onsubmit="handleContactSubmit(event)">
              
              <!-- Row 1: Họ tên & Số điện thoại -->
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1rem;">
                <div>
                  <label style="display: block; font-size: 0.9rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">Họ tên <span style="color: #e22b27;">*</span></label>
                  <input type="text" id="contact-name" class="form-input-custom" placeholder="" onfocus="clearFieldError('name')" />
                  <div id="err-name" class="form-error-msg">Vui lòng nhập họ và tên của bạn.</div>
                </div>
                <div>
                  <label style="display: block; font-size: 0.9rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">Số điện thoại <span style="color: #e22b27;">*</span></label>
                  <input type="tel" id="contact-phone" class="form-input-custom" placeholder="" oninput="formatPhoneInput(this)" onfocus="clearFieldError('phone')" />
                  <div id="err-phone" class="form-error-msg">Vui lòng nhập số điện thoại hợp lệ.</div>
                </div>
              </div>

              <!-- Row 2: Email -->
              <div style="margin-bottom: 1rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">Email <span style="color: #e22b27;">*</span></label>
                <input type="email" id="contact-email" class="form-input-custom" placeholder="" onfocus="clearFieldError('email')" />
                <div id="err-email" class="form-error-msg">Vui lòng nhập địa chỉ email hợp lệ.</div>
              </div>

              <!-- Row 3: Nội dung -->
              <div style="margin-bottom: 1.75rem;">
                <label style="display: block; font-size: 0.9rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">Nội dung <span style="color: #e22b27;">*</span></label>
                <textarea id="contact-message" rows="4" class="form-input-custom" style="resize: vertical;" placeholder="" onfocus="clearFieldError('message')"></textarea>
                <div id="err-message" class="form-error-msg">Vui lòng nhập nội dung liên hệ.</div>
              </div>

              <!-- Row 4: Button Gửi -->
              <button type="submit" class="btn-submit-contact">Gửi</button>

            </form>
          </div>
        </div>

      </div>

      

    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>