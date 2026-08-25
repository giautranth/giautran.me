<?php
/**
 * Template Name: Template Liên Hệ
 */
get_header(); ?>


  <!-- ========== MAIN CONTENT: LIÊN HỆ ========== -->
  <main class="site-section">
    <div class="container">
      
      <div class="page-title-banner">
        <h1 class="page-main-heading">LIÊN HỆ VĂN PHÒNG THƯỜNG TRỰC</h1>
      </div>

      <div class="contact-grid">
        
        <!-- Contact Information -->
        <div class="contact-info-card">
          <h2 style="color:#2C3691;font-size:1.25rem;font-weight:800;margin-bottom:20px;text-transform:uppercase;">
            Thông Tin Chi Hội
          </h2>

          <div class="contact-detail-row">
            <div class="contact-icon-circle">
              <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
              <strong style="color:#2C3691;display:block;margin-bottom:2px;">Trụ sở thường trực:</strong>
              <div style="color:#475569;font-size:0.92rem;line-height:1.5;">
                Số 3 Đường 17A, Phường An Lạc, Quận Bình Tân, Thành phố Hồ Chí Minh
              </div>
            </div>
          </div>

          <div class="contact-detail-row">
            <div class="contact-icon-circle">
              <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <div>
              <strong style="color:#2C3691;display:block;margin-bottom:2px;">Điện thoại liên hệ:</strong>
              <div style="color:#475569;font-size:0.92rem;">
                Hotline Thư ký: <strong>1900 8146</strong><br />
                Đường dây nóng Cấp cứu: <strong>028 6290 1155</strong>
              </div>
            </div>
          </div>

          <div class="contact-detail-row">
            <div class="contact-icon-circle">
              <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
              <strong style="color:#2C3691;display:block;margin-bottom:2px;">Hộp thư điện tử (Email):</strong>
              <div style="color:#475569;font-size:0.92rem;">
                vanphong@chihoiyte.vn | banthuky@chihoiyte.vn
              </div>
            </div>
          </div>

          <div class="contact-detail-row">
            <div class="contact-icon-circle">
              <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <strong style="color:#2C3691;display:block;margin-bottom:2px;">Thời gian làm việc văn phòng:</strong>
              <div style="color:#475569;font-size:0.92rem;">
                Thứ Hai – Thứ Sáu: 07:30 – 16:30<br />
                Thứ Bảy: 07:30 – 11:30 (Trực thường vụ)
              </div>
            </div>
          </div>

        </div>

        <!-- Contact Form -->
        <div class="contact-info-card">
          <h2 style="color:#2C3691;font-size:1.25rem;font-weight:800;margin-bottom:20px;text-transform:uppercase;">
            Gửi Tin Nhắn / Đăng Ký Hội Viên
          </h2>
          
          <form onsubmit="alert('Cảm ơn Quý đơn vị! Thư ký Chi hội đã tiếp nhận thông tin và sẽ phản hồi sớm nhất.'); event.preventDefault();">
            <div class="form-group">
              <label class="form-label">Họ và tên người liên hệ / Đại diện *</label>
              <input type="text" required class="form-control" placeholder="Nguyễn Văn A" />
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;" class="form-group">
              <div>
                <label class="form-label">Số điện thoại *</label>
                <input type="tel" required class="form-control" placeholder="0901234567" />
              </div>
              <div>
                <label class="form-label">Email *</label>
                <input type="email" required class="form-control" placeholder="example@hospital.vn" />
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Tên Bệnh viện / Phòng khám / Đơn vị công tác</label>
              <input type="text" class="form-control" placeholder="Bệnh viện Đa khoa Quốc tế..." />
            </div>

            <div class="form-group">
              <label class="form-label">Nội dung liên hệ / Đề xuất hợp tác *</label>
              <textarea required class="form-control" placeholder="Vui lòng nhập nội dung liên hệ hoặc nhu cầu tham gia hội viên, đăng ký khóa đào tạo CME..."></textarea>
            </div>

            <button type="submit" class="btn-primary-pill" style="width:100%;text-align:center;border-radius:6px;">GỬI THÔNG ĐIỆP</button>
          </form>
        </div>

      </div>

      <!-- Google Maps Embed -->
      <div style="margin-top:35px;border-radius:8px;overflow:hidden;border:1px solid #cbd5e1;box-shadow:var(--shadow-sm);">
        <iframe 
          title="Bản đồ vị trí Văn phòng Chi hội" 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954005187063!2d106.60838347570275!3d10.738029959900996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dd57b561c29%3A0xc48c081e604ec226!2zMyDEkC4gMTdBLCBBbiBM4bqhYywgQsOsbmggVMOibiwgSOG7kyBDaMOtIE1pbmgsIFZpZXRuYW0!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" 
          width="100%" 
          height="350" 
          style="border:0;display:block;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>