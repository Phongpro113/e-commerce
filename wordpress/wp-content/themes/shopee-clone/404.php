<?php get_header(); ?>

<main>
<div class="sp-main">
  <div class="sp-section" style="text-align:center;padding:80px 20px">
    <div style="font-size:80px">😕</div>
    <h1 style="font-size:24px;margin:16px 0 8px">Trang không tồn tại</h1>
    <p style="color:#757575;margin-bottom:24px">Xin lỗi, trang bạn tìm kiếm không tồn tại hoặc đã bị xóa.</p>
    <a href="<?= esc_url(home_url('/')) ?>" style="background:var(--orange);color:#fff;padding:12px 32px;border-radius:2px;display:inline-block;font-weight:500">
      Về trang chủ
    </a>
  </div>
</div>
</main>

<?php get_footer(); ?>
