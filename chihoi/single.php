<?php get_header(); ?>

<!-- ========== BREADCRUMB ========== -->
<div style="background:#f1f5f9;padding:14px 0;border-bottom:1px solid #e2e8f0;">
  <div class="container" style="font-size:0.88rem;color:#64748b;">
    <a href="<?php echo esc_url(home_url('/')); ?>" style="color:#2C3691;text-decoration:none;font-weight:600;">Trang chủ</a>
    <span style="margin:0 8px;color:#94a3b8;">/</span>
    <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="color:#2C3691;text-decoration:none;font-weight:600;">Tin tức & Sự kiện</a>
    <span style="margin:0 8px;color:#94a3b8;">/</span>
    <span style="color:#0f172a;font-weight:700;"><?php the_title(); ?></span>
  </div>
</div>

<main class="site-section" style="padding: 40px 0 60px; background: #f8fafc;">
  <div class="container" style="max-width: 980px;">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <article class="single-article-card" style="background:#ffffff;border-radius:16px;padding:40px;box-shadow:0 4px 20px rgba(0,0,0,0.04);border:1px solid #e2e8f0;">
        
        <!-- Post Date & Category -->
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
          <span style="background:#eff6ff;color:#1d4ed8;padding:4px 12px;border-radius:50px;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">TIN TỨC CHI HỘI</span>
          <span style="font-size:0.88rem;color:#64748b;display:inline-flex;align-items:center;gap:6px;">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <?php the_time('d/m/Y'); ?>
          </span>
        </div>

        <!-- Title -->
        <h1 style="color:#1e3a8a;font-size:2rem;font-weight:800;line-height:1.4;margin-bottom:24px;letter-spacing:-0.5px;">
          <?php the_title(); ?>
        </h1>

        <!-- Content -->
        <div class="entry-content article-rich-body" style="line-height:1.85;color:#334155;font-size:1.05rem;">
          <?php the_content(); ?>
        </div>

        <!-- Back to news button -->
        <div style="margin-top:40px;padding-top:24px;border-top:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;">
          <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" style="display:inline-flex;align-items:center;gap:8px;color:#2C3691;text-decoration:none;font-weight:700;font-size:0.95rem;">
            ← Quay lại danh sách tin tức
          </a>
        </div>

      </article>

    <?php endwhile; endif; ?>

  </div>
</main>

<style>
.article-rich-body img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  margin: 20px 0;
  display: block;
}
.article-rich-body p {
  margin-bottom: 18px;
}
@media (max-width: 640px) {
  .single-article-card {
    padding: 24px 18px !important;
  }
  .single-article-card h1 {
    font-size: 1.5rem !important;
  }
}
</style>

<?php get_footer(); ?>
