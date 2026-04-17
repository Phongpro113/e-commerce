<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- TOP BAR -->
<div class="sp-topbar">
  <div class="container">
    <div class="topbar-left">
      <a href="#">Kênh Người Bán</a>
      <span class="topbar-divider">|</span>
      <a href="#">Trở thành Người bán Shopee</a>
      <span class="topbar-divider">|</span>
      <a href="#">Tải ứng dụng</a>
      <span class="topbar-divider">|</span>
      <span>Kết nối</span>
      <a href="#" aria-label="Facebook">&#xf09a;</a>
      <a href="#" aria-label="Instagram">&#xf16d;</a>
    </div>
    <div class="topbar-right">
      <a href="#">🔔 Thông Báo</a>
      <span class="topbar-divider">|</span>
      <a href="#">❓ Hỗ Trợ</a>
      <span class="topbar-divider">|</span>
      <a href="#">🌐 Tiếng Việt ▾</a>
      <span class="topbar-divider">|</span>
      <?php if (is_user_logged_in()): ?>
        <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>">
          👤 <?= esc_html(wp_get_current_user()->display_name) ?>
        </a>
      <?php else: ?>
        <a href="<?= esc_url(wp_registration_url()) ?>" class="sp-btn-reg">Đăng Ký</a>
        <a href="<?= esc_url(wp_login_url()) ?>" class="sp-btn-login">Đăng Nhập</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- MAIN HEADER -->
<header class="sp-header">
  <div class="container sp-header-inner">

    <!-- Logo -->
    <div class="sp-logo">
      <a href="<?= esc_url(home_url('/')) ?>">
        <div class="sp-logo-badge">S</div>
        <span class="sp-logo-text"><?= esc_html(get_bloginfo('name')) ?: 'Shopee' ?></span>
      </a>
    </div>

    <!-- Search -->
    <div class="sp-search">
      <form class="sp-search-bar" role="search" method="get" action="<?= esc_url(home_url('/')) ?>">
        <input type="search" name="s" placeholder="Shopee bao ship 0Đ – Đăng ký ngay!" value="<?= get_search_query() ?>" autocomplete="off">
        <input type="hidden" name="post_type" value="product">
        <button type="submit" aria-label="Tìm kiếm">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </form>
      <div class="sp-search-suggestions">
        <?php
        $hot_terms = get_terms(['taxonomy' => 'product_cat', 'number' => 8, 'hide_empty' => true]);
        if (!is_wp_error($hot_terms) && $hot_terms):
          foreach ($hot_terms as $term):
            echo '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
          endforeach;
        else:
          $defaults = ['Áo thun', 'Giày sneaker', 'Điện thoại', 'Laptop', 'Đồng hồ', 'Túi xách'];
          foreach ($defaults as $s): echo '<a href="#">' . esc_html($s) . '</a>'; endforeach;
        endif; ?>
      </div>
    </div>

    <!-- Cart -->
    <div class="sp-cart">
      <a href="<?= esc_url(wc_get_cart_url()) ?>" aria-label="Giỏ hàng">
        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        <?php
        $count = function_exists('WC') ? WC()->cart->get_cart_contents_count() : 0;
        if ($count > 0): ?>
        <span class="sp-cart-count"><?= $count ?></span>
        <?php endif; ?>
      </a>
    </div>

  </div><!-- /.sp-header-inner -->

  <!-- Category Nav -->
  <nav class="sp-cat-nav">
    <div class="container">
      <?php
      $nav_terms = get_terms(['taxonomy' => 'product_cat', 'number' => 14, 'hide_empty' => false, 'parent' => 0]);
      if (!is_wp_error($nav_terms) && $nav_terms):
        foreach ($nav_terms as $t):
          if ($t->name === 'Uncategorized') continue;
          echo '<a href="' . esc_url(get_term_link($t)) . '">' . esc_html($t->name) . '</a>';
        endforeach;
      else:
        $nav_cats = ['Kinh Gương', 'Áo Kiểu Babydoll', 'Ốp Lưng Đẹp', 'Dép Sục Crocs', 'Máy Quạt Cầm Tay', 'Quần Bó Ống Rộng', 'Đồ Ăn Bà Bầu Combo'];
        foreach ($nav_cats as $c): echo '<a href="#">' . esc_html($c) . '</a>'; endforeach;
      endif; ?>
    </div>
  </nav>

</header>
