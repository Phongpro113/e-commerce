<?php
defined('ABSPATH') || exit;

/* ── Theme setup ── */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus([
        'primary' => 'Danh mục',
    ]);

    load_theme_textdomain('shopee-clone', get_template_directory() . '/languages');
});

/* ── Enqueue ── */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('shopee-main', get_template_directory_uri() . '/assets/css/shopee.css', [], '1.0.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap', [], null);
    wp_enqueue_script('shopee-js', get_template_directory_uri() . '/assets/js/shopee.js', [], '1.0.0', true);
});

/* ── WooCommerce: remove default wrappers ── */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', function () {
    echo '<div class="sp-main"><div class="sp-section">';
}, 10);
add_action('woocommerce_after_main_content', function () {
    echo '</div></div>';
}, 10);

/* ── Helpers ── */
function sp_format_price(float $price): string {
    return number_format($price, 0, ',', '.') . '₫';
}

function sp_get_product_card(WC_Product $product): string {
    $link  = get_permalink($product->get_id());
    $name  = $product->get_name();
    $price = (float) $product->get_price();
    $sale  = $product->is_on_sale();
    $reg   = (float) $product->get_regular_price();
    $img   = wp_get_attachment_image($product->get_image_id(), 'woocommerce_thumbnail', false, ['loading' => 'lazy']);
    $discount = ($sale && $reg > 0) ? round((1 - $price / $reg) * 100) : 0;
    $rating   = $product->get_average_rating();
    $stars    = str_repeat('★', min(5, (int) round($rating))) . str_repeat('☆', max(0, 5 - (int) round($rating)));
    $sold     = (int) $product->get_total_sales();

    ob_start(); ?>
<a href="<?= esc_url($link) ?>" class="product-card">
    <div class="product-thumb">
        <?php if ($img): echo $img; else: ?><div class="no-img">🛍️</div><?php endif; ?>
        <?php if ($sale && $discount > 0): ?><span class="product-badge">-<?= $discount ?>%</span><?php endif; ?>
    </div>
    <div class="product-info">
        <div class="product-name"><?= esc_html($name) ?></div>
        <div class="product-pricing">
            <span class="product-price"><?= sp_format_price($price) ?></span>
            <?php if ($sale && $reg > 0): ?>
            <span class="product-old-price"><?= sp_format_price($reg) ?></span>
            <?php if ($discount > 0): ?><span class="product-discount"><?= $discount ?>% GIẢM</span><?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="product-meta">
            <span class="product-stars"><?= $stars ?></span>
            <span class="product-sold">Đã bán <?= $sold > 1000 ? round($sold/1000, 1) . 'k' : $sold ?></span>
        </div>
    </div>
</a>
    <?php return ob_get_clean();
}

/* ── Category icon mapping ── */
function sp_cat_icon(string $slug): string {
    $icons = [
        'ao-quan'           => '👔', 'thoi-trang-nam'    => '👔', 'thoi-trang-nu'     => '👗',
        'dien-thoai'        => '📱', 'phu-kien'          => '📱', 'thiet-bi-dien-tu'  => '📺',
        'may-tinh'          => '💻', 'laptop'            => '💻', 'may-anh'           => '📷',
        'dong-ho'           => '⌚', 'giay-dep'          => '👟', 'giay-dep-nam'      => '👟',
        'giay-dep-nu'       => '👠', 'tui-vi'            => '👜', 'trang-suc'         => '💍',
        'nha-cua'           => '🏠', 'do-gia-dung'       => '🍳', 'suc-khoe'          => '💊',
        'lam-dep'           => '💄', 'sac-dep'           => '💄', 'the-thao'          => '⚽',
        'du-lich'           => '✈️', 'xe-may'            => '🏍️', 'o-to'             => '🚗',
        'me-va-be'          => '🍼', 'do-choi'           => '🎮', 'sach'             => '📚',
        'thuc-pham'         => '🥘', 'bach-hoa'          => '🛒', 'van-phong'         => '✏️',
    ];
    return $icons[$slug] ?? '🏷️';
}

/* ── WooCommerce: use our archive template for shop ── */
add_filter('template_include', function ($template) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $custom = get_template_directory() . '/woocommerce/archive-product.php';
        if (file_exists($custom)) return $custom;
    }
    return $template;
});
