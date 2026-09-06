<?php
/**
 * Title: Khối Tin Tức & Hoạt Động Chi Hội
 * Slug: chihoi/news-featured
 * Categories: chihoi, featured
 * Description: Các bài viết tin tức, sự kiện và hoạt động nổi bật của Chi hội
 * Keywords: tin tức, sự kiện, hoạt động, báo chí
 */
?>
<!-- wp:group {"className":"site-section","layout":{"type":"constrained"}} -->
<section class="site-section">
  <div class="container">
    <div class="section-header-row">
      <div class="section-main-title">TIN TỨC & SỰ KIỆN NỔI BẬT</div>
    </div>
    <div class="news-cards-grid">
      <div class="news-card">
        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="news-card-thumb-link">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/photo/news/news-dien-dan-y-te-2026.jpg" alt="Diễn đàn y tế" class="news-thumbnail-img" />
        </a>
        <div class="news-card-body" style="padding:16px 18px 14px;">
          <h3 class="news-card-title"><a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>">Diễn đàn phát triển y tế tư nhân Việt Nam năm 2026</a></h3>
          <p class="news-card-desc" style="color:#64748b;font-size:0.9rem;">Kết nối và phát huy tiềm năng to lớn của mạng lưới y tế tư nhân trên cả nước.</p>
        </div>
      </div>
      <div class="news-card">
        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="news-card-thumb-link">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/photo/news/news-cih-madam-lam.webp" alt="Madam Lâm" class="news-thumbnail-img" />
        </a>
        <div class="news-card-body" style="padding:16px 18px 14px;">
          <h3 class="news-card-title"><a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>">Kết nối sức mạnh y tế tư nhân phía Nam: Madam Trần Thị Lâm giữ vai trò Chủ tịch</a></h3>
          <p class="news-card-desc" style="color:#64748b;font-size:0.9rem;">Sứ mệnh tập hợp và phát triển hệ sinh thái y tế chất lượng cao tại TP.HCM và các tỉnh lân cận.</p>
        </div>
      </div>
      <div class="news-card">
        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="news-card-thumb-link">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/photo/news/news-cih-ra-mat-bch.webp" alt="Ra mắt BCH" class="news-thumbnail-img" />
        </a>
        <div class="news-card-body" style="padding:16px 18px 14px;">
          <h3 class="news-card-title"><a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>">Ra mắt Ban Chấp hành Chi hội Bệnh viện Tư nhân TP.HCM</a></h3>
          <p class="news-card-desc" style="color:#64748b;font-size:0.9rem;">Kiện toàn bộ máy lãnh đạo với sự tham gia của các chuyên gia quản trị y tế hàng đầu.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /wp:group -->\n