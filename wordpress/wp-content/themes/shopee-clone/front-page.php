<?php get_header(); ?>

<main>
<div class="sp-main">

  <!-- ── HERO: Slider + Side banners ── -->
  <div class="sp-hero">

    <!-- Slider -->
    <div class="sp-slider">
      <div class="slider-track">
        <div class="slider-slide">
          <div class="slide-fallback" style="background:linear-gradient(135deg,#ee4d2d 0%,#f63 50%,#ff8c00 100%)">
            <div class="slide-title">🎉 SIÊU SALE MỞ ĐẦU THÁNG</div>
            <div class="slide-sub">Giảm đến 80% – Miễn phí vận chuyển</div>
          </div>
        </div>
        <div class="slider-slide">
          <div class="slide-fallback" style="background:linear-gradient(135deg,#1a9de3 0%,#0c6daa 100%)">
            <div class="slide-title">📱 ĐIỆN TỬ CHÍNH HÃNG</div>
            <div class="slide-sub">iPhone, Samsung, Xiaomi – Giá tốt nhất</div>
          </div>
        </div>
        <div class="slider-slide">
          <div class="slide-fallback" style="background:linear-gradient(135deg,#6c3483 0%,#a569bd 100%)">
            <div class="slide-title">👗 THỜI TRANG MỚI VỀ</div>
            <div class="slide-sub">Hàng ngàn mẫu mới – Cập nhật hàng ngày</div>
          </div>
        </div>
        <div class="slider-slide">
          <div class="slide-fallback" style="background:linear-gradient(135deg,#1e8449 0%,#27ae60 100%)">
            <div class="slide-title">🏠 NHÀ CỬA & ĐỜI SỐNG</div>
            <div class="slide-sub">Trang trí nhà đẹp – Giá hợp lý</div>
          </div>
        </div>
      </div>
      <button class="slider-arrow prev" aria-label="Trước">&#8249;</button>
      <button class="slider-arrow next" aria-label="Sau">&#8250;</button>
      <div class="slider-dots"></div>
    </div>

    <!-- Side banners -->
    <div class="sp-side-banners">
      <div class="side-banner">
        <div class="side-banner-fallback" style="background:linear-gradient(135deg,#e74c3c,#c0392b)">
          <div class="banner-tag">SIÊU SALE</div>
          <div>SHOP MỚI<br>Giảm 50%</div>
        </div>
      </div>
      <div class="side-banner">
        <div class="side-banner-fallback" style="background:linear-gradient(135deg,#f39c12,#e67e22)">
          <div class="banner-tag">SHOPEE FOOD</div>
          <div>Deal Giảm<br>30.000₫</div>
        </div>
      </div>
    </div>

  </div><!-- /.sp-hero -->

  <!-- ── PROMO ICONS ── -->
  <div class="sp-promos">
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#fff0ed">🏷️</div>
      <div class="promo-label">Deal Từ 1.000Đ</div>
    </a>
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#fff8e1">⭐</div>
      <div class="promo-label">Shopee Xử Lý</div>
    </a>
    <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>" class="promo-item">
      <div class="promo-icon" style="background:#e8f5e9">🎨</div>
      <div class="promo-label">Shopee Style<br>Voucher 30%</div>
    </a>
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#fce4ec">💎</div>
      <div class="promo-label">Khách Hàng<br>Thân Thiết</div>
    </a>
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#e3f2fd">🎫</div>
      <div class="promo-label">Mã Giảm Giá</div>
    </a>
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#f3e5f5">💳</div>
      <div class="promo-label">Shopee Pay<br>0Đ</div>
    </a>
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#e8f5e9">🚚</div>
      <div class="promo-label">Freeship<br>Xtra</div>
    </a>
    <a href="#" class="promo-item">
      <div class="promo-icon" style="background:#fff0ed">🎰</div>
      <div class="promo-label">Vòng Quay<br>May Mắn</div>
    </a>
  </div>

  <!-- ── DANH MỤC ── -->
  <div class="sp-section">
    <div class="sp-section-header">
      <h2 class="sp-section-title">📋 Danh Mục</h2>
      <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>" class="sp-section-more">Xem tất cả ›</a>
    </div>
    <div class="categories-grid">
      <?php
      $cats = get_terms([
          'taxonomy'   => 'product_cat',
          'hide_empty' => false,
          'parent'     => 0,
          'number'     => 20,
      ]);
      if (!is_wp_error($cats) && $cats):
        foreach ($cats as $cat):
          if ($cat->name === 'Uncategorized') continue;
          $icon  = sp_cat_icon($cat->slug);
          $thumb = get_term_meta($cat->term_id, 'thumbnail_id', true);
          $img   = $thumb ? wp_get_attachment_image($thumb, [60,60], false, ['loading'=>'lazy']) : '';
          ?>
          <a href="<?= esc_url(get_term_link($cat)) ?>" class="cat-item">
            <div class="cat-icon">
              <?= $img ?: '<span>' . $icon . '</span>' ?>
            </div>
            <span class="cat-label"><?= esc_html($cat->name) ?></span>
          </a>
        <?php endforeach;
      else:
        // Fallback demo categories
        $demo_cats = [
          ['👔','Thời Trang Nam'], ['👗','Thời Trang Nữ'], ['📱','Điện Thoại & PK'],
          ['📺','Thiết Bị Điện Tử'], ['💻','Máy Tính & Laptop'], ['📷','Máy Ảnh & Quay Phim'],
          ['⌚','Đồng Hồ'], ['👟','Giày Dép Nam'], ['🏠','Thiết Bị Gia Dụng'], ['⚽','Thể Thao & Du Lịch'],
          ['🏍️','Ô Tô & Xe Máy'], ['🍼','Mẹ & Bé'], ['🍳','Nhà Cửa & Đời Sống'], ['💄','Sắc Đẹp'],
          ['💊','Sức Khỏe'], ['👠','Giày Dép Nữ'], ['👜','Túi Ví Nữ'], ['💍','Phụ Kiện & Trang Sức'],
          ['🛒','Bách Hóa Online'], ['📚','Nhà Sách Online'],
        ];
        foreach ($demo_cats as [$ico, $label]):
          echo "<a href=\"" . esc_url(wc_get_page_permalink('shop')) . "\" class=\"cat-item\">
            <div class=\"cat-icon\"><span>{$ico}</span></div>
            <span class=\"cat-label\">" . esc_html($label) . "</span>
          </a>";
        endforeach;
      endif; ?>
    </div>
  </div>

  <!-- ── FLASH SALE ── -->
  <?php
  $sale_args = [
      'post_type'      => 'product',
      'posts_per_page' => 6,
      'meta_query'     => [['key' => '_sale_price', 'value' => '', 'compare' => '!=']],
      'orderby'        => 'rand',
  ];
  $sale_query = new WP_Query($sale_args);
  if ($sale_query->have_posts()): ?>
  <div class="sp-section">
    <div class="sp-section-header">
      <div style="display:flex;align-items:center;gap:20px">
        <h2 class="sp-section-title">⚡ Flash Sale</h2>
        <div class="flash-timer" data-end="<?= esc_attr(strtotime('tomorrow midnight') * 1000) ?>">
          <span class="timer-label">KẾT THÚC TRONG</span>
          <span class="timer-block timer-h">00</span>
          <span class="timer-colon">:</span>
          <span class="timer-block timer-m">00</span>
          <span class="timer-colon">:</span>
          <span class="timer-block timer-s">00</span>
        </div>
      </div>
      <a href="<?= esc_url(add_query_arg('on_sale', 1, wc_get_page_permalink('shop'))) ?>" class="sp-section-more">Xem tất cả ›</a>
    </div>
    <div class="flash-products">
      <?php while ($sale_query->have_posts()): $sale_query->the_post();
        $product = wc_get_product(get_the_ID());
        if (!$product) continue;
        $price = (float) $product->get_price();
        $reg   = (float) $product->get_regular_price();
        $disc  = ($reg > 0) ? round((1 - $price / $reg) * 100) : 0;
        $sold  = (int) $product->get_total_sales();
        $pct   = min(100, max(10, $sold));
        $img   = wp_get_attachment_image($product->get_image_id(), 'woocommerce_thumbnail', false, ['loading'=>'lazy']);
        ?>
        <div class="flash-product-card">
          <a href="<?= esc_url(get_permalink()) ?>">
            <div class="flash-thumb">
              <?= $img ?: '<div class="no-img">🏷️</div>' ?>
              <?php if ($disc > 0): ?><span class="product-badge">-<?= $disc ?>%</span><?php endif; ?>
            </div>
            <div class="flash-info">
              <div class="flash-price"><?= sp_format_price($price) ?></div>
              <?php if ($reg > 0): ?><div class="flash-old"><?= sp_format_price($reg) ?></div><?php endif; ?>
            </div>
            <div class="flash-discount-bar">
              <div class="flash-progress">
                <span>Đã bán <?= $sold ?></span>
              </div>
            </div>
          </a>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ── GỢI Ý HÔM NAY ── -->
  <div class="sp-section">
    <div class="sp-section-header">
      <h2 class="sp-section-title">🛍️ Gợi Ý Hôm Nay</h2>
      <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>" class="sp-section-more">Xem thêm ›</a>
    </div>
    <div class="products-grid">
      <?php
      $args = ['post_type' => 'product', 'posts_per_page' => 12, 'orderby' => 'date', 'order' => 'DESC'];
      $query = new WP_Query($args);
      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
          $p = wc_get_product(get_the_ID());
          if ($p) echo sp_get_product_card($p);
        endwhile;
        wp_reset_postdata();
      else: ?>
        <p style="grid-column:1/-1;text-align:center;color:#999;padding:40px 0">
          Chưa có sản phẩm nào. <a href="<?= admin_url('edit.php?post_type=product') ?>" style="color:var(--orange)">Thêm sản phẩm</a>.
        </p>
      <?php endif; ?>
    </div>
  </div>

  <!-- ── SẢN PHẨM BÁN CHẠY ── -->
  <?php
  $popular = new WP_Query([
      'post_type'      => 'product',
      'posts_per_page' => 12,
      'meta_key'       => 'total_sales',
      'orderby'        => 'meta_value_num',
      'order'          => 'DESC',
  ]);
  if ($popular->have_posts()): ?>
  <div class="sp-section">
    <div class="sp-section-header">
      <h2 class="sp-section-title">🔥 Bán Chạy</h2>
      <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>" class="sp-section-more">Xem thêm ›</a>
    </div>
    <div class="products-grid">
      <?php while ($popular->have_posts()): $popular->the_post();
        $p = wc_get_product(get_the_ID());
        if ($p) echo sp_get_product_card($p);
      endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
  <?php endif; ?>

</div><!-- /.sp-main -->
</main>

<?php get_footer(); ?>
