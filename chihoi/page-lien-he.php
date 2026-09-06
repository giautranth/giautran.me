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
                <p><a href="tel:19008146">1900 8146</a></p>
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
                <p><a href="mailto:info@chihoibenhvien.com">info@chihoibenhvien.com</a></p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Cột phải: Form liên hệ chuẩn thiết kế CIH -->
        <div>
          <div class="contact-form-card">
            
            <h2 class="contact-form-title">LIÊN HỆ</h2>

            <form id="contact-custom-form" novalidate onsubmit="handleContactSubmit(event)">
              
              <!-- Row 1: Họ tên & Số điện thoại -->
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1rem;">
                <div>
                  <label style="display: block; font-size: 0.9rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">Họ tên <span style="color: #e22b27;">*</span></label>
                  <input type="text" id="contact-name" class="form-input-custom" placeholder="" onfocus="clearFieldError('name')" />
                  <div id="err-name" class="form-error-msg">Vui lòng nhập họ tên của bạn.</div>
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

              <!-- Status Message Box -->
              <div id="contact-form-status" style="display:none;margin-bottom:1.25rem;padding:12px 16px;border-radius:8px;font-size:0.95rem;font-weight:600;"></div>

              <!-- Row 4: Button Gửi -->
              <button type="submit" id="btn-submit-contact" class="btn-submit-contact">Gửi</button>

            </form>
          </div>
        </div>

      </div>

    </div>
  </main>

  <script>
  const TYPO_DOMAINS = {
    'gmaill.com': 'gmail.com',
    'gamil.com': 'gmail.com',
    'gmial.com': 'gmail.com',
    'gmai.com': 'gmail.com',
    'gmaik.com': 'gmail.com',
    'gmal.com': 'gmail.com',
    'gmai.vn': 'gmail.com',
    'yaho.com': 'yahoo.com',
    'yahooo.com': 'yahoo.com',
    'yaho.com.vn': 'yahoo.com.vn',
    'hotmial.com': 'hotmail.com',
    'hotmai.com': 'hotmail.com',
    'outlok.com': 'outlook.com',
    'outloo.com': 'outlook.com',
    'icoud.com': 'icloud.com'
  };

  function clearFieldError(field) {
    var err = document.getElementById('err-' + field);
    if (err) err.style.display = 'none';
  }

  // Tự động xóa khoảng trắng khi gõ hoặc paste, chỉ cho viết liền (hỗ trợ dấu + ở đầu cho quốc tế/WhatsApp)
  function formatPhoneInput(el) {
    var val = el.value.replace(/\s+/g, '');
    if (val.startsWith('+')) {
      val = '+' + val.substring(1).replace(/[^0-9]/g, '');
    } else {
      val = val.replace(/[^0-9]/g, '');
    }
    el.value = val;
  }

  function validateContactPhone(phone) {
    var clean = phone.replace(/\s+/g, '');
    if (!clean) {
      return { valid: false, message: 'Vui lòng nhập số điện thoại.' };
    }

    // Ngoại lệ cho số Quốc tế / WhatsApp (Bắt đầu bằng dấu + hoặc 00)
    if (clean.startsWith('+') || clean.startsWith('00')) {
      var digits = clean.replace(/[^0-9]/g, '');
      if (digits.length < 8) {
        return { valid: false, message: 'Số điện thoại quốc tế / WhatsApp quá ngắn (tối thiểu 8 chữ số).' };
      }
      if (digits.length > 15) {
        return { valid: false, message: 'Số điện thoại quốc tế / WhatsApp quá dài (tối đa 15 chữ số).' };
      }
      return { valid: true };
    }

    // Số điện thoại Việt Nam
    if (!clean.startsWith('0')) {
      return { valid: false, message: 'Số điện thoại trong nước phải bắt đầu bằng số 0 (hoặc nhập mã quốc tế dạng +84...).' };
    }

    if (clean.length < 10) {
      return { valid: false, message: 'Số điện thoại đang bị thiếu số (' + clean.length + '/10 số). Số điện thoại Việt Nam phải đủ 10 chữ số.' };
    }
    if (clean.length > 10) {
      return { valid: false, message: 'Số điện thoại quá dài (' + clean.length + ' số). Số điện thoại Việt Nam chỉ gồm 10 chữ số.' };
    }

    var prefix = clean.substring(0, 2);
    var validPrefixes = ['02', '03', '05', '07', '08', '09'];
    if (!validPrefixes.includes(prefix)) {
      return { valid: false, message: 'Đầu số "' + prefix + '" không hợp lệ tại Việt Nam. Vui lòng kiểm tra lại.' };
    }

    return { valid: true };
  }

  function validateContactEmail(email) {
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
      return { valid: false, message: 'Địa chỉ email không đúng định dạng (Ví dụ đúng: bacsi@gmail.com).' };
    }

    var parts = email.split('@');
    var domain = parts[1].toLowerCase();

    if (TYPO_DOMAINS[domain]) {
      var suggested = parts[0] + '@' + TYPO_DOMAINS[domain];
      return {
        valid: false,
        message: 'Có phải bạn muốn nhập: <strong>' + suggested + '</strong> không? Vui lòng kiểm tra lại chính tả.'
      };
    }

    return { valid: true };
  }

  function handleContactSubmit(e) {
    e.preventDefault();
    var name = document.getElementById('contact-name').value.trim();
    var phone = document.getElementById('contact-phone').value.trim();
    var email = document.getElementById('contact-email').value.trim();
    var message = document.getElementById('contact-message').value.trim();
    var statusBox = document.getElementById('contact-form-status');
    var btn = document.getElementById('btn-submit-contact');

    var errName = document.getElementById('err-name');
    var errPhone = document.getElementById('err-phone');
    var errEmail = document.getElementById('err-email');
    var errMessage = document.getElementById('err-message');

    var hasError = false;
    if (!name) { 
      errName.textContent = 'Vui lòng nhập họ tên của bạn.';
      errName.style.display = 'block'; 
      hasError = true; 
    }

    var phoneCheck = validateContactPhone(phone);
    if (!phoneCheck.valid) {
      errPhone.textContent = phoneCheck.message;
      errPhone.style.display = 'block';
      hasError = true;
    }

    var emailCheck = validateContactEmail(email);
    if (!emailCheck.valid) {
      errEmail.innerHTML = emailCheck.message;
      errEmail.style.display = 'block';
      hasError = true;
    }

    if (!message) { 
      errMessage.textContent = 'Vui lòng nhập nội dung liên hệ.';
      errMessage.style.display = 'block'; 
      hasError = true; 
    }

    if (hasError) return;

    btn.disabled = true;
    btn.textContent = 'Đang gửi...';
    statusBox.style.display = 'none';

    fetch('<?php echo esc_url(rest_url("chihoi/v1/contact")); ?>', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name: name, phone: phone, email: email, message: message, page: window.location.href })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      btn.disabled = false;
      btn.textContent = 'Gửi';
      if (data.success) {
        statusBox.style.display = 'block';
        statusBox.style.background = '#dcfce7';
        statusBox.style.color = '#15803d';
        statusBox.style.border = '1px solid #86efac';
        statusBox.innerHTML = '✓ ' + (data.message || 'Cảm ơn bạn! Thông tin liên hệ đã được gửi thành công.');
        document.getElementById('contact-custom-form').reset();
      } else {
        statusBox.style.display = 'block';
        statusBox.style.background = '#fee2e2';
        statusBox.style.color = '#b91c1c';
        statusBox.style.border = '1px solid #fca5a5';
        statusBox.innerHTML = '✕ ' + (data.message || 'Đã có lỗi xảy ra. Vui lòng thử lại.');
      }
    })
    .catch(function(err) {
      btn.disabled = false;
      btn.textContent = 'Gửi';
      statusBox.style.display = 'block';
      statusBox.style.background = '#fee2e2';
      statusBox.style.color = '#b91c1c';
      statusBox.style.border = '1px solid #fca5a5';
      statusBox.innerHTML = '✕ Không thể kết nối máy chủ. Vui lòng thử lại.';
    });
  }
  </script>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>