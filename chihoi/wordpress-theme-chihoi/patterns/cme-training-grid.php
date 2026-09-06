<?php
/**
 * Title: Khối Khóa Học Đào Tạo CME
 * Slug: chihoi/cme-training-grid
 * Categories: chihoi, featured
 * Description: Danh sách các khóa đào tạo y khoa liên tục kèm nút xem chi tiết và lọc chuyên khoa
 * Keywords: đào tạo, cme, y khoa, chiêu sinh
 */
?>
<!-- wp:group {"className":"site-section","layout":{"type":"constrained"}} -->
<section class="site-section">
  <div class="container">
    <div class="section-header-row">
      <div class="section-main-title">CHƯƠNG TRÌNH ĐÀO TẠO LIÊN TỤC (CME)</div>
    </div>
    <div class="training-cards-grid" id="training-cards-grid">
      <div class="cme-training-card">
        <a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="cme-card-thumb-link">
          <div class="cme-card-thumb-wrap">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/photo/dao-tao/13.png" alt="CME Quản lý điều dưỡng" class="cme-card-thumb-img" />
          </div>
        </a>
        <div class="cme-card-body" style="padding:16px 18px 14px;">
          <h3 class="cme-card-title"><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>">Tăng cường năng lực quản lý điều dưỡng – Khóa 2</a></h3>
          <div class="cme-card-footer"><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="link-read-more">Xem chi tiết →</a></div>
        </div>
      </div>
      <div class="cme-training-card">
        <a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="cme-card-thumb-link">
          <div class="cme-card-thumb-wrap">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/photo/dao-tao/11.png" alt="CME An toàn người bệnh" class="cme-card-thumb-img" />
          </div>
        </a>
        <div class="cme-card-body" style="padding:16px 18px 14px;">
          <h3 class="cme-card-title"><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>">An toàn người bệnh – Khóa 4</a></h3>
          <div class="cme-card-footer"><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="link-read-more">Xem chi tiết →</a></div>
        </div>
      </div>
      <div class="cme-training-card">
        <a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="cme-card-thumb-link">
          <div class="cme-card-thumb-wrap">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/photo/dao-tao/12.png" alt="CME Hồi sinh tim phổi" class="cme-card-thumb-img" />
          </div>
        </a>
        <div class="cme-card-body" style="padding:16px 18px 14px;">
          <h3 class="cme-card-title"><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>">Hồi sinh tim phổi cơ bản – Khóa 3</a></h3>
          <div class="cme-card-footer"><a href="<?php echo esc_url(home_url('/dao-tao/')); ?>" class="link-read-more">Xem chi tiết →</a></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /wp:group -->\n