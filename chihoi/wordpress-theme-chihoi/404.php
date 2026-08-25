<?php get_header(); ?>
<main class="site-section">
  <div class="container" style="text-align:center;padding:80px 20px;">
    <h1 style="color:#e22b27;font-size:4rem;font-weight:900;margin-bottom:10px;">404</h1>
    <h2 style="color:#2C3691;font-size:1.5rem;margin-bottom:20px;">Không Tìm Thấy Trang</h2>
    <p style="color:#64748b;margin-bottom:30px;">Trang bạn đang tìm kiếm không tồn tại hoặc đã được chuyển sang địa chỉ mới.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary-pill">Về Trang Chủ</a>
  </div>
</main>
<?php get_footer(); ?>
