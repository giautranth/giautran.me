<?php
/**
 * Template Name: Template Tin Tức Sự Kiện
 */
get_header(); ?>


  <!-- ========== MAIN CONTENT: TIN TỨC & SỰ KIỆN (Chuẩn AIH) ========== -->
  <main class="site-section">
    <div class="container">
      
      <div class="section-header-row">
        <div class="section-main-title">TIN TỨC</div>
      </div>

      <!-- Filter Tabs -->
      <div class="filter-tabs-wrapper">
        <button class="tab-btn news-tab-btn active" data-filter="all">Tất cả</button>
        <button class="tab-btn news-tab-btn" data-filter="van-ban">Văn bản & Quyết định</button>
        <button class="tab-btn news-tab-btn" data-filter="chi-hoi">Tin tức chi hội</button>
        <button class="tab-btn news-tab-btn" data-filter="su-kien">Sự kiện</button>
        </div>

      <!-- News Grid -->
      <div class="news-cards-grid">
        
        <!-- Card 1 -->
        <div class="news-article-card" data-category="su-kien">
          <div class="news-card-thumbnail-wrap">
            <img src="photo/news/event-photo-1.webp" alt="Ra mắt ban chấp hành chi hội" class="news-thumbnail-img" />
          </div>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>19/08/2026</div>
              <h3 class="news-card-title">
                Hiệp hội Bệnh viện Tư nhân Việt Nam ra mắt Ban Chấp hành Chi hội TP.HCM và các tỉnh phía Nam (Nhiệm kỳ 2026 – 2029)
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="#" class="link-read-more btn-news-detail" data-news-title="Hiệp hội Bệnh viện Tư nhân Việt Nam ra mắt Ban Chấp hành Chi hội TP.HCM và các tỉnh phía Nam (Nhiệm kỳ 2026 – 2029)" data-news-cat="SỰ KIỆN" data-news-date="19/08/2026">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="news-article-card" data-category="chi-hoi">
          <div class="news-card-thumbnail-wrap">
            <img src="photo/news/event-photo-49.jpg" alt="Bộ Y tế phát biểu tại hội nghị" class="news-thumbnail-img" />
          </div>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>19/08/2026</div>
              <h3 class="news-card-title">
                Bộ Y tế: Khối y tế tư nhân phía Nam đóng vai trò then chốt trong chăm sóc và bảo vệ sức khỏe nhân dân
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="#" class="link-read-more btn-news-detail" data-news-title="Bộ Y tế: Khối y tế tư nhân phía Nam đóng vai trò then chốt trong chăm sóc sức khỏe nhân dân" data-news-cat="TIN TỨC" data-news-date="19/08/2026">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="news-article-card" data-category="chi-hoi">
          <div class="news-card-thumbnail-wrap">
            <img src="photo/news/event-photo-50.jpg" alt="GS.VS Nguyễn Văn Đệ phát biểu" class="news-thumbnail-img" />
          </div>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>19/08/2026</div>
              <h3 class="news-card-title">
                GS.VS Nguyễn Văn Đệ: Chi hội phía Nam sẽ quy tụ nguồn lực và nâng tầm vị thế y tế tư nhân
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="#" class="link-read-more btn-news-detail" data-news-title="GS.VS Nguyễn Văn Đệ: Chi hội phía Nam sẽ quy tụ nguồn lực và nâng tầm vị thế y tế tư nhân" data-news-cat="CHI HỘI" data-news-date="19/08/2026">Xem thêm →</a>
            </div>
          </div>
        </div>

      </div></div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>