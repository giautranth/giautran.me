  <!-- ========== FOOTER ========== -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-logo-col">
          <div class="footer-logo-wrapper">
            <img src="<?php echo esc_url(chihoi_get_option('footer_logo', get_template_directory_uri() . '/photo/logo/chihoi_2.png')); ?>" alt="Chi hội Bệnh viện Tư nhân TP.HCM" class="footer-logo-img" />
          </div>
          <div class="footer-affil-text"><?php echo esc_html(chihoi_get_option('footer_affil', 'Thuộc Hiệp hội Bệnh viện Tư nhân Việt Nam')); ?></div>
          <div class="footer-slogan-text"><?php echo esc_html(chihoi_get_option('footer_slogan', 'ĐOÀN KẾT - HỢP TÁC - PHÁT TRIỂN')); ?></div>
        </div>

        <div>
          <h4 class="footer-heading">LIÊN HỆ</h4>
          <div class="footer-contact-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" color="#27AAE1" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span><strong>Văn phòng:</strong> <?php echo esc_html(chihoi_get_option('footer_address', 'Số 5 Đường 17A, P. An Lạc, TP. HCM')); ?></span>
          </div>
          <div class="footer-contact-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" color="#27AAE1" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span><strong>Hotline:</strong> <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', chihoi_get_option('footer_phone', '19008146'))); ?>" style="color:inherit;text-decoration:none !important;"><?php echo esc_html(chihoi_get_option('footer_phone', '1900 8146')); ?></a></span>
          </div>
          <div class="footer-contact-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" color="#27AAE1" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span><strong>Email:</strong> <a href="mailto:<?php echo esc_attr(chihoi_get_option('footer_email', 'info@chihoibenhvien.com')); ?>" style="color:inherit;text-decoration:none !important;"><?php echo esc_html(chihoi_get_option('footer_email', 'info@chihoibenhvien.com')); ?></a></span>
          </div>
        </div>

        <div>
          <h4 class="footer-heading">ĐĂNG KÝ NHẬN TIN</h4>
          <p style="font-size:0.85rem;color:#ffffff;margin-bottom:12px;">
            <?php echo nl2br(esc_html(chihoi_get_option('footer_newsletter_desc', "Nhận thông báo về các khóa đào tạo,\nhội nghị và chính sách y tế mới nhất."))); ?>
          </p>
                    <form id="footer-newsletter-form" onsubmit="handleNewsletterSubmit(event)" novalidate>
            <div style="display:flex;gap:6px;">
              <input type="email" id="footer-newsletter-email" required placeholder="Nhập email của bạn" class="form-control footer-newsletter-input" style="background:#ffffff !important;border:1px solid #cbd5e1 !important;color:#1e293b !important;font-size:0.88rem;border-radius:50px;padding:8px 18px;flex:1;" oninput="clearNewsletterError()" />
              <button type="submit" id="footer-newsletter-btn" class="btn-primary-pill footer-newsletter-btn" style="background:#e22b27;border-color:#e22b27;color:#ffffff;padding:8px 20px;font-size:0.88rem;font-weight:700;font-family:inherit;white-space:nowrap;letter-spacing:normal;cursor:pointer;">Gửi</button>
            </div>
            <div id="footer-newsletter-msg" style="display:none;margin-top:8px;font-size:0.82rem;padding:7px 14px;border-radius:20px;font-weight:600;line-height:1.4;"></div>
          </form>

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

          function clearNewsletterError() {
            var msg = document.getElementById('footer-newsletter-msg');
            if (msg && msg.style.display !== 'none' && msg.style.color === 'rgb(185, 28, 28)') {
              msg.style.display = 'none';
            }
          }

          function validateClientEmail(email) {
            // Kiểm tra cấu trúc email chuẩn RFC 5322
            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
              return { valid: false, message: 'Địa chỉ email không đúng định dạng (Ví dụ đúng: bacsi@gmail.com).' };
            }

            var parts = email.split('@');
            var domain = parts[1].toLowerCase();

            // Bắt lỗi gõ nhầm tên miền phổ biến
            if (TYPO_DOMAINS[domain]) {
              var suggested = parts[0] + '@' + TYPO_DOMAINS[domain];
              return {
                valid: false,
                message: 'Có phải bạn muốn nhập: <strong>' + suggested + '</strong> không? Vui lòng kiểm tra lại chính tả.'
              };
            }

            return { valid: true };
          }

          function handleNewsletterSubmit(e) {
            e.preventDefault();
            var emailInput = document.getElementById('footer-newsletter-email');
            var btn = document.getElementById('footer-newsletter-btn');
            var msg = document.getElementById('footer-newsletter-msg');
            var email = emailInput.value.trim();

            if (!email) {
              msg.style.display = 'block';
              msg.style.background = '#fee2e2';
              msg.style.color = '#b91c1c';
              msg.innerHTML = '✕ Vui lòng nhập địa chỉ email của bạn.';
              return;
            }

            // Kiểm tra lỗi gõ nhầm / định dạng ngay trên máy người dùng
            var clientCheck = validateClientEmail(email);
            if (!clientCheck.valid) {
              msg.style.display = 'block';
              msg.style.background = '#fef3c7';
              msg.style.color = '#b45309';
              msg.innerHTML = '⚠️ ' + clientCheck.message;
              emailInput.focus();
              return;
            }

            btn.disabled = true;
            btn.textContent = '...';
            msg.style.display = 'none';

            fetch('<?php echo esc_url(rest_url("chihoi/v1/newsletter")); ?>', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ email: email })
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
              btn.disabled = false;
              btn.textContent = 'Gửi';
              msg.style.display = 'block';
              if (data.success) {
                msg.style.background = '#dcfce7';
                msg.style.color = '#15803d';
                msg.innerHTML = '✓ ' + data.message;
                emailInput.value = '';
              } else {
                msg.style.background = '#fee2e2';
                msg.style.color = '#b91c1c';
                msg.innerHTML = '✕ ' + (data.message || 'Lỗi đăng ký.');
              }
            })
            .catch(function() {
              btn.disabled = false;
              btn.textContent = 'Gửi';
              msg.style.display = 'block';
              msg.style.background = '#fee2e2';
              msg.style.color = '#b91c1c';
              msg.innerHTML = '✕ Không thể kết nối. Vui lòng thử lại sau.';
            });
          }
          </script>
        </div>
      </div>

      <div class="footer-bottom-row">
        <p class="footer-copyright-text"><?php echo esc_html(chihoi_get_option('footer_copyright', 'Bản quyền © 2026 thuộc về Chi hội Bệnh viện Tư nhân TP. HCM và các tỉnh, thành phía Nam.')); ?></p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
