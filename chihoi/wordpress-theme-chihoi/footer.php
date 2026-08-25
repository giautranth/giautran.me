  <!-- ========== FOOTER ========== -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="footer-brand-title">CHI HỘI BỆNH VIỆN TƯ NHÂN TP.HCM VÀ CÁC TỈNH PHÍA NAM</div>
          <p class="footer-brand-desc">
            Tổ chức đại diện cho khối cơ sở khám chữa bệnh tư nhân khu vực phía Nam. Cam kết nâng cao chất lượng phục vụ và an toàn sức khỏe cho người bệnh.
          </p>
          <div class="footer-contact-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" color="#27AAE1" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span><strong>Văn phòng:</strong> Số 3 Đường 17A, P. An Lạc, Q. Bình Tân, TP. Hồ Chí Minh</span>
          </div>
        </div>
        <div>
          <h4 class="footer-heading">Về Chi Hội</h4>
          <ul class="footer-links-list">
            <li><a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>">Về chúng tôi</a></li>
            <li><a href="<?php echo esc_url(home_url('/so-do-to-chuc/')); ?>">Sơ đồ tổ chức</a></li>
            <li><a href="<?php echo esc_url(home_url('/hoi-vien/')); ?>">Danh sách hội viên</a></li>
          </ul>
        </div>
        <div>
          <h4 class="footer-heading">Hoạt Động</h4>
          <ul class="footer-links-list">
            <li><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>">Khóa đào tạo CME</a></li>
            <li><a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>">Tin tức - Sự kiện</a></li>
          </ul>
        </div>
        <div>
          <h4 class="footer-heading">Liên Hệ Nhanh</h4>
          <p style="font-size:0.85rem;color:#cbd5e1;line-height:1.6;">
            Hotline: <strong>1900 8146</strong><br />
            Email: <strong>vanphong@chihoiyte.vn</strong>
          </p>
        </div>
      </div>
    </div>
    <div class="footer-bottom-strip">
      <div class="container">
        <p style="margin:0;font-size:0.82rem;color:#94a3b8;">
          © <?php echo date('Y'); ?> Chi hội Bệnh viện Tư nhân TP.HCM và các tỉnh phía Nam. All rights reserved.
        </p>
      </div>
    </div>
  </footer>

  <!-- News Modal Container -->
  <div class="news-modal-overlay" id="newsDetailModal">
    <div class="news-modal-box">
      <div class="modal-header">
        <span class="modal-badge-category" id="modalCategory">TIN TỨC</span>
        <button class="modal-close-btn" id="modalCloseBtn">&times;</button>
      </div>
      <div class="modal-body">
        <div class="modal-date-text" id="modalDate">19/08/2026</div>
        <h2 class="modal-article-title" id="modalTitle">Tiêu đề bài viết</h2>
        <div class="modal-article-content" id="modalContent">
          <p>Nội dung chi tiết bài viết sẽ được hiển thị tại đây...</p>
        </div>
      </div>
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>
