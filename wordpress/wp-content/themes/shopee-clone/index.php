<?php get_header(); ?>

<main>
<div class="sp-main">
  <div class="sp-section">
    <div class="products-grid">
      <?php if (have_posts()):
        while (have_posts()): the_post();
          $p = wc_get_product(get_the_ID());
          if ($p) echo sp_get_product_card($p);
        endwhile;
      else: ?>
        <p style="grid-column:1/-1;text-align:center;color:#999;padding:40px 0">Không tìm thấy nội dung.</p>
      <?php endif; ?>
    </div>
    <div class="sp-pagination">
      <?php the_posts_pagination(['prev_text' => '‹', 'next_text' => '›']); ?>
    </div>
  </div>
</div>
</main>

<?php get_footer(); ?>
