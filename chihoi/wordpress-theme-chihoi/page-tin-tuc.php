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
        <button class="tab-btn news-tab-btn" data-filter="chi-hoi">Tin tức chi hội</button>
        <button class="tab-btn news-tab-btn" data-filter="su-kien">Sự kiện</button>
        </div>

      <!-- News Grid -->
      <div class="section-slider-container">
        <button type="button" class="section-slider-arrow prev" onclick="scrollSectionCards('news-cards-grid', -1)" aria-label="Xem tin trước">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <div class="news-cards-grid" id="news-cards-grid">
        <!-- Card 1: Madam Trần Thị Lâm giữ vai trò Chủ tịch Chi hội -->
        <div class="news-article-card" data-category="chi-hoi">
          <a href="tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam/" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="photo/news/news-cih-madam-lam.webp" alt="Madam Trần Thị Lâm giữ vai trò Chủ tịch Chi hội" class="news-thumbnail-img" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>21/07/2026</div>
              <h3 class="news-card-title">
                <a href="tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam/" style="color:inherit;text-decoration:none;">
                  Kết Nối Sức Mạnh Y Tế Tư Nhân Phía Nam: Madam Trần Thị Lâm Giữ Vai Trò Chủ Tịch Chi Hội
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="tin-tuc/ket-noi-suc-manh-y-te-tu-nhan-phia-nam/" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 2: Ra mắt Ban Chấp hành Chi hội -->
        <div class="news-article-card" data-category="su-kien">
          <a href="tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm/" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="photo/news/news-cih-ra-mat-bch.webp" alt="Ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP.HCM" class="news-thumbnail-img" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>19/08/2026</div>
              <h3 class="news-card-title">
                <a href="tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm/" style="color:inherit;text-decoration:none;">
                  Ra Mắt Ban Chấp Hành Chi Hội Bệnh Viện Tư Nhân TP.HCM Và Các Tỉnh, Thành Phía Nam
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="tin-tuc/ra-mat-ban-chap-hanh-chi-hoi-benh-vien-tu-nhan-tp-hcm/" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>

        <!-- Card 3: Diễn đàn Phát triển Y tế tư nhân Việt Nam năm 2026 -->
        <div class="news-article-card" data-category="su-kien">
          <a href="tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026/" class="news-card-thumbnail-wrap" style="display:block;">
            <img src="photo/news/news-dien-dan-y-te-2026.jpg" alt="Diễn đàn Phát triển Y tế tư nhân Việt Nam năm 2026" class="news-thumbnail-img" />
          </a>
          <div class="news-card-body">
            <div>
              <div class="news-publish-date"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>21/08/2026</div>
              <h3 class="news-card-title">
                <a href="tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026/" style="color:inherit;text-decoration:none;">
                  Diễn Đàn Phát Triển Y Tế Tư Nhân Việt Nam Năm 2026 (Lần Thứ II) Thành Công Tốt Đẹp
                </a>
              </h3>
            </div>
            <div class="news-card-footer">
              <a href="tin-tuc/dien-dan-phat-trien-y-te-tu-nhan-viet-nam-2026/" class="link-read-more">Xem thêm →</a>
            </div>
          </div>
        </div>
      </div>
        <button type="button" class="section-slider-arrow next" onclick="scrollSectionCards('news-cards-grid', 1)" aria-label="Xem tin tiếp theo">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  
<?php get_footer(); ?>