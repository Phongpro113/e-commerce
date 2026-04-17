<?php get_header(); ?>

<main>
<div class="sp-main">
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <?php if (function_exists('woocommerce_content') && get_post_type() === 'product'): ?>
      <div class="sp-product-page"><?php the_content(); ?></div>
    <?php else: ?>
      <div class="sp-section">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    <?php endif; ?>
  <?php endwhile; endif; ?>
</div>
</main>

<?php get_footer(); ?>
