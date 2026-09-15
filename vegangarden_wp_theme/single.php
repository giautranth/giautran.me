<?php
get_header();
?>
<main class="single-article-page" style="padding: 60px 0; background-color: var(--bg-cream); min-height: 60vh;">
  <div class="container" style="max-width: 860px;">
    <?php while (have_posts()) : the_post(); ?>
      <article class="article-detail" style="background: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
        <header style="margin-bottom: 28px;">
          <h1 class="serif-font" style="font-size: 2.4rem; color: var(--primary-green-dark); margin-bottom: 12px;"><?php the_title(); ?></h1>
          <div style="font-size: 0.85rem; color: var(--text-muted);">
            <span>Veröffentlicht am <?php echo get_the_date(); ?></span>
          </div>
        </header>
        <?php if (has_post_thumbnail()) : ?>
          <div style="margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; display: block;')); ?>
          </div>
        <?php endif; ?>
        <div class="article-content" style="line-height: 1.85; font-size: 1.05rem; color: var(--text-dark);">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>
<?php
get_footer();
