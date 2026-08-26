<?php
/**
 * Template Name: Template Đào Tạo CME
 */
get_header(); ?>


  <!-- ========== MAIN CONTENT: CHƯƠNG TRÌNH ĐÀO TẠO (Chuẩn AIH) ========== -->
  <main class="site-section">
    <div class="container">
      
      <div class="section-header-row">
        <div class="section-main-title">CHƯƠNG TRÌNH ĐÀO TẠO</div>
      </div>

      <!-- Filter Tabs -->
      <div class="filter-tabs-wrapper" style="margin-top:10px;">
        <button class="tab-btn training-tab-btn active" data-filter="all">Tất cả</button>
        <button class="tab-btn training-tab-btn" data-filter="chieu-sinh">Thông báo chiêu sinh</button>
        <button class="tab-btn training-tab-btn" data-filter="hoat-dong">Hoạt động đào tạo</button>
        <button class="tab-btn training-tab-btn" data-filter="giang-vien">Đội ngũ giảng viên</button>
        <button class="tab-btn training-tab-btn" data-filter="nghien-cuu">Nghiên cứu khoa học</button>
      </div>

            <!-- CME Training Cards Grid (3 Cards) -->
      <div class="training-cards-grid">
        <!-- Card 1: Tăng Cường Năng Lực Quản Lý Điều Dưỡng - Khóa 2 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-thumb-wrap" style="position:relative;height:160px;overflow:hidden;background:#f8fafc;">
            <img src="photo/dao-tao/cme_1_card.jpg" alt="Tăng cường năng lực quản lý điều dưỡng - Khóa 2" style="width:100%;height:100%;object-fit:cover;transition:transform 0.3s ease;" class="cme-card-thumb-img" />
            <span class="cme-header-tag" style="position:absolute;top:10px;left:10px;margin-bottom:0;box-shadow:0 2px 6px rgba(0,0,0,0.3);">THÔNG BÁO CHIÊU SINH</span>
          </div>
          <div class="cme-card-header" style="text-align:left;padding:14px 16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
              <span class="cme-course-type" style="margin-bottom:0;font-size:0.75rem;">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</span>
              <span class="cme-institute-seal" style="font-size:0.75rem;"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> CIH / HSA</span>
            </div>
            <div class="cme-course-name" style="font-size:0.96rem;line-height:1.4;">"TĂNG CƯỜNG NĂNG LỰC QUẢN LÝ ĐIỀU DƯỠNG"</div>
            <div class="cme-course-batch" style="font-size:0.8rem;color:#e22b27;font-weight:700;">KHÓA 2</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Chiêu sinh khóa đào tạo nâng cao kỹ năng lãnh đạo, quản trị nhân lực và chuẩn hóa quy trình chăm sóc dành cho điều dưỡng trưởng, điều dưỡng quản lý.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-1">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 2: An Toàn Người Bệnh - Khóa 4 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-thumb-wrap" style="position:relative;height:160px;overflow:hidden;background:#f8fafc;">
            <img src="photo/dao-tao/cme_2_card.jpg" alt="An toàn người bệnh - Khóa 4" style="width:100%;height:100%;object-fit:cover;transition:transform 0.3s ease;" class="cme-card-thumb-img" />
            <span class="cme-header-tag" style="position:absolute;top:10px;left:10px;margin-bottom:0;box-shadow:0 2px 6px rgba(0,0,0,0.3);">THÔNG BÁO CHIÊU SINH</span>
          </div>
          <div class="cme-card-header" style="text-align:left;padding:14px 16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
              <span class="cme-course-type" style="margin-bottom:0;font-size:0.75rem;">CẬP NHẬT KIẾN THỨC Y KHOA (CME)</span>
              <span class="cme-institute-seal" style="font-size:0.75rem;"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> CIH / HSA</span>
            </div>
            <div class="cme-course-name" style="font-size:0.96rem;line-height:1.4;">"AN TOÀN NGƯỜI BỆNH"</div>
            <div class="cme-course-batch" style="font-size:0.8rem;color:#e22b27;font-weight:700;">KHÓA 4</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                15/08/2026
              </div>
              <p class="cme-summary-text">
                Đào tạo cập nhật kiến thức phòng ngừa sự cố y khoa, quản lý rủi ro và xây dựng văn hóa an toàn người bệnh theo bộ tiêu chí chất lượng bệnh viện.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-2">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 3: Hồi Sinh Tim Phổi Cơ Bản - Khóa 3 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-thumb-wrap" style="position:relative;height:160px;overflow:hidden;background:#f8fafc;">
            <img src="photo/dao-tao/cme_3_card.jpg" alt="Hồi sinh tim phổi cơ bản - Khóa 3" style="width:100%;height:100%;object-fit:cover;transition:transform 0.3s ease;" class="cme-card-thumb-img" />
            <span class="cme-header-tag" style="position:absolute;top:10px;left:10px;margin-bottom:0;box-shadow:0 2px 6px rgba(0,0,0,0.3);">THÔNG BÁO CHIÊU SINH</span>
          </div>
          <div class="cme-card-header" style="text-align:left;padding:14px 16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
              <span class="cme-course-type" style="margin-bottom:0;font-size:0.75rem;">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</span>
              <span class="cme-institute-seal" style="font-size:0.75rem;"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> CIH / CIMER</span>
            </div>
            <div class="cme-course-name" style="font-size:0.96rem;line-height:1.4;">"HỒI SINH TIM PHỔI CƠ BẢN"</div>
            <div class="cme-course-batch" style="font-size:0.8rem;color:#e22b27;font-weight:700;">KHÓA 3</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                09/07/2026
              </div>
              <p class="cme-summary-text">
                Huấn luyện thực hành kỹ năng cấp cứu ngưng tuần hoàn hô hấp (BLS/CPR) và sử dụng máy khử rung tim tự động (AED) trên mô hình mô phỏng chuẩn AHA.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-3">Xem thêm →</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>