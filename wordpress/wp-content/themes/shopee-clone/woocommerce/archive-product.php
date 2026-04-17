<?php get_header(); ?>

<main>
<div class="sp-main">

  <!-- Shop header -->
  <div class="sp-shop-header">
    <h1 class="sp-shop-title">
      <?php
      if (is_product_category()) {
          $cat = get_queried_object();
          echo esc_html($cat->name);
          if ($cat->description) echo ' <small style="color:#757575;font-size:13px;font-weight:400">– ' . esc_html($cat->description) . '</small>';
      } else {
          echo 'Tất cả sản phẩm';
      }
      ?>
    </h1>
    <div class="sp-sort">
      <label>Sắp xếp:</label>
      <form method="get">
        <?php foreach ($_GET as $k => $v): if ($k !== 'orderby'): ?>
          <input type="hidden" name="<?= esc_attr($k) ?>" value="<?= esc_attr($v) ?>">
        <?php endif; endforeach; ?>
        <select name="orderby" onchange="this.form.submit()">
          <option value="menu_order" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'menu_order') ?>>Nổi bật</option>
          <option value="popularity" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'popularity') ?>>Bán chạy</option>
          <option value="rating"     <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'rating')     ?>>Đánh giá cao</option>
          <option value="date"       <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date')       ?>>Mới nhất</option>
          <option value="price"      <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price')      ?>>Giá thấp → cao</option>
          <option value="price-desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price-desc') ?>>Giá cao → thấp</option>
        </select>
      </form>
    </div>
  </div>

  <!-- Products -->
  <div class="sp-section">
    <?php if (woocommerce_product_loop()): ?>
      <div class="products-grid">
        <?php while (have_posts()): the_post();
          $p = wc_get_product(get_the_ID());
          if ($p) echo sp_get_product_card($p);
        endwhile; ?>
      </div>
      <!-- Pagination -->
      <div class="sp-pagination">
        <?php echo paginate_links(['prev_text' => '‹', 'next_text' => '›']); ?>
      </div>
    <?php else: ?>
      <p style="text-align:center;padding:60px;color:#999">Không tìm thấy sản phẩm nào.</p>
    <?php endif; ?>
  </div>

</div><!-- /.sp-main -->
</main>

<?php get_footer(); ?>
