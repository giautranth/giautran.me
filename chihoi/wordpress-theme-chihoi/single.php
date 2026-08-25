<?php get_header(); ?>
<main class="site-section">
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="white-box-card">
        <div style="font-size:0.86rem;color:#27AAE1;font-weight:700;margin-bottom:8px;"><?php the_time('d/m/Y'); ?></div>
        <h1 style="color:#2C3691;font-size:1.8rem;font-weight:900;margin-bottom:20px;"><?php the_title(); ?></h1>
        <div class="entry-content" style="line-height:1.8;color:#334155;">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; endif; ?>
  </div>
</main>
<?php get_footer(); ?>
