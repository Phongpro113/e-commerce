<?php get_header(); ?>

<main>
<div class="sp-main">
  <div class="sp-section">
    <?php while (have_posts()): the_post(); ?>
      <h1 style="font-size:22px;margin-bottom:16px"><?php the_title(); ?></h1>
      <div class="page-content"><?php the_content(); ?></div>
    <?php endwhile; ?>
  </div>
</div>
</main>

<?php get_footer(); ?>
