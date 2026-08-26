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
        
        <!-- Card 1 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-header">
            <span class="cme-header-tag">THÔNG BÁO CHIÊU SINH</span>
            <span class="cme-institute-seal"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> MER / HCA</span>
            <div class="cme-course-type">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</div>
            <div class="cme-course-name">"HỒI SINH TIM PHỔI CƠ BẢN"</div>
            <div class="cme-course-batch">KHÓA 5</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Hồi sinh tim phổi cơ bản – khóa 5.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-1">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-header">
            <span class="cme-header-tag">THÔNG BÁO CHIÊU SINH</span>
            <span class="cme-institute-seal"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> MER / HCA</span>
            <div class="cme-course-type">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</div>
            <div class="cme-course-name">"CHĂM SÓC NGƯỜI BỆNH TOÀN DIỆN"</div>
            <div class="cme-course-batch">KHÓA 1</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Chăm sóc người bệnh toàn diện – khóa 1.
              </p>
            </div>
            <div class="cme-card-footer">
              <a href="#" class="link-read-more btn-cme-detail" data-cme-id="cme-2">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="cme-training-card" data-category="chieu-sinh">
          <div class="cme-card-header">
            <span class="cme-header-tag">THÔNG BÁO CHIÊU SINH</span>
            <span class="cme-institute-seal"><svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:2px;"><path d="M19 10.5h-5.5V5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v5.5H5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5h5.5V19c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-5.5H19c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5z"/></svg> MER / HCA</span>
            <div class="cme-course-type">KHÓA ĐÀO TẠO LIÊN TỤC (CME)</div>
            <div class="cme-course-name">"TĂNG CƯỜNG NĂNG LỰC QUẢN LÝ ĐIỀU DƯỠNG"</div>
            <div class="cme-course-batch">KHÓA 2</div>
          </div>
          <div class="cme-card-body">
            <div>
              <div class="cme-date-line">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                22/07/2026
              </div>
              <p class="cme-summary-text">
                Thông báo chiêu sinh khóa Đào tạo liên tục (CME) – Tăng cường năng lực quản lý điều dưỡng – khóa 2.
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