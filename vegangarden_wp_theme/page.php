<?php
get_header();
?>
<main class="default-page" style="padding: 60px 0; min-height: 50vh;">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
      <h1 class="serif-font" style="margin-bottom: 24px; color: var(--primary-green-dark);"><?php the_title(); ?></h1>
      <div class="page-content" style="line-height: 1.8; font-size: 1.05rem;">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
</main>
<?php
get_footer();
