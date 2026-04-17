# PROMPT 3 — GIAO DIỆN BÁN HÀNG

> Yêu cầu: Đã hoàn thành setup shop (Prompt 2)  
> Mục tiêu: Giao diện đẹp, mobile-friendly, load nhanh, chuyển đổi cao

---

## CHECKLIST GIAO DIỆN

- [ ] Bước 1: Chọn và cài theme
- [ ] Bước 2: Cấu hình theme cơ bản
- [ ] Bước 3: Xây dựng Homepage chuẩn e-commerce
- [ ] Bước 4: Tối ưu tốc độ
- [ ] Bước 5: Kiểm tra mobile

---

## BƯỚC 1 — CHỌN THEME

### So sánh các theme phổ biến

| Theme | Giá | Ưu điểm | Nhược điểm |
|---|---|---|---|
| **Astra** | Miễn phí / $59/năm | Nhẹ nhất (~50KB), nhiều starter templates, tích hợp tốt WooCommerce | Phải mua Pro để có tính năng nâng cao |
| **Flatsome** | $59 (một lần) | Đẹp sẵn, có UX Builder, nhiều demo bán hàng | Trả phí, nặng hơn Astra |
| **OceanWP** | Miễn phí / $43/năm | Nhiều extension, linh hoạt | Khó cấu hình hơn Astra |
| **Storefront** | Miễn phí | Chính hãng WooCommerce, nhẹ | Giao diện đơn giản, cần child theme |

**Khuyến nghị: Dùng Astra** — nhẹ nhất, nhiều demo chọn sẵn, miễn phí đủ dùng.

### Cài Astra

```
1. Appearance > Themes > Add New
2. Tìm "Astra"
3. Install > Activate
```

### Import Starter Template (Quan Trọng)

```
1. Plugins > Add New > Tìm "Starter Templates"
   (Plugin chính thức của Astra)
2. Install > Activate
3. Appearance > Starter Templates
4. Chọn page builder: Elementor (khuyến nghị) hoặc Block Editor
5. Bộ lọc: WooCommerce -> chọn template bán hàng đẹp
6. Preview -> Import Complete Site
7. Lưu ý: sẽ ghi đè Settings, Widgets, Trang -> Bấm "Import"
```

Template WooCommerce tốt trong Astra:
- **Fashion Store** — bán quần áo
- **Online Shop** — shop tổng hợp
- **Accessories Store** — phụ kiện
- **Organic Store** — thực phẩm

---

## BƯỚC 2 — CẤU HÌNH THEME CƠ BẢN

**Appearance > Customize**

### 2.1 — Global Colors (Màu sắc thương hiệu)

```
Global > Colors:
- Primary Color:   màu chính (ví dụ: #E74C3C đỏ, #2C3E50 xanh đậm)
- Secondary Color: màu phụ
- Accent Color:    màu nổi bật (nút bấm, link)
```

Màu gợi ý cho shop bán hàng Việt Nam:
```
Thời trang:  Primary #1A1A2E | Accent #E94560
Đồ gia dụng: Primary #2C3E50 | Accent #E67E22
Mỹ phẩm:    Primary #6C5CE7 | Accent #FD79A8
```

### 2.2 — Typography (Font chữ)

```
Global > Typography:
- Body Font:     Be Vietnam Pro (Google Font, hỗ trợ tiếng Việt tốt)
- Heading Font:  Be Vietnam Pro hoặc Montserrat
- Font Size:     16px (body), 28-36px (h1), 22-24px (h2)
```

Thêm Google Font Be Vietnam Pro:
```
1. Appearance > Customize > Global > Typography
2. Chọn font "Be Vietnam Pro"
3. Hoặc dùng plugin "Google Fonts Typography"
```

### 2.3 — Header

```
Header Builder (Astra):
- Logo: upload logo 200x60px (PNG nền trong)
- Layout: Logo trái | Menu giữa | Cart icon + Search phải
- Sticky header: Bật (hiển thị khi scroll)
- Mobile: Hamburger menu
```

### 2.4 — Footer

```
Footer Builder:
- Hàng 1: Copyright text + Link chính sách
- Tối giản, không nhiều widget
```

---

## BƯỚC 3 — XÂY DỰNG HOMEPAGE CHUẨN E-COMMERCE

Cấu trúc homepage chuẩn chuyển đổi cao:

```
[1] HERO BANNER
[2] DANH MỤC SẢN PHẨM
[3] SẢN PHẨM NỔI BẬT / MỚI NHẤT
[4] BANNER KHUYẾN MÃI
[5] SẢN PHẨM BÁN CHẠY
[6] ĐIỂM MẠNH (USP)
[7] REVIEW KHÁCH HÀNG
[8] FOOTER
```

### Dùng Elementor để build (nếu dùng Astra + Elementor)

Cài Elementor:
```
Plugins > Add New > "Elementor" > Install > Activate
```

**[1] Hero Banner**
```
- Widget: Section full-width
- Background: ảnh sản phẩm đẹp / ảnh banner (1920x800px)
- Overlay: màu tối nhẹ (opacity 40%)
- Text: Tiêu đề lớn + mô tả ngắn + nút CTA ("Mua Ngay", "Xem Sản Phẩm")
- Nút CTA màu nổi bật, padding 15px 40px
```

**[2] Danh mục sản phẩm**
```
- Widget: WooCommerce Product Categories
- Layout: Grid 3-4 cột
- Hiển thị: Ảnh + Tên danh mục
- Khoảng cách đều, góc bo tròn (border-radius: 8px)
```

**[3] Sản phẩm nổi bật**
```
- Widget: WooCommerce Products
- Filter: Featured products hoặc Latest products
- Layout: Grid 4 cột (desktop) / 2 cột (mobile)
- Hiển thị: Ảnh, Tên, Giá, Nút "Thêm vào giỏ"
```

**[4] Banner khuyến mãi**
```
- Section 2 cột: ảnh trái, text phải
- Background màu sáng
- Text: % giảm giá + thời gian khuyến mãi
- Nút: "Xem ngay"
```

**[5] Sản phẩm bán chạy**
```
- Widget: WooCommerce Products
- Filter: Best selling
- Layout: Horizontal list hoặc Grid
```

**[6] USP (Điểm mạnh)**
```
- Section 4 cột icon:
  [icon xe] Giao hàng toàn quốc
  [icon khiên] Bảo hành chính hãng
  [icon hoàn tiền] Đổi trả 7 ngày
  [icon headset] Hỗ trợ 24/7
```

**[7] Review khách hàng**
```
- Plugin: WooCommerce Reviews hoặc "Customer Reviews for WooCommerce"
- Hiển thị 3-4 review nổi bật
- Có tên + ảnh đại diện + số sao
```

---

## BƯỚC 4 — TỐI ƯU TỐC ĐỘ

### Cài plugin cache

```
Nếu dùng Shared Hosting / VPS Nginx:
  Plugin: LiteSpeed Cache (tốt nhất cho LiteSpeed server)

Nếu dùng server khác:
  Plugin: WP Super Cache (đơn giản) hoặc W3 Total Cache (nâng cao)
```

Cấu hình LiteSpeed Cache cơ bản:
```
LiteSpeed Cache > Cache > Enable Cache: ON
LiteSpeed Cache > Page Optim > CSS/JS Minify: ON
LiteSpeed Cache > Image Optim > Bật WebP
```

### Tối ưu ảnh

```
Plugin: Imagify hoặc ShortPixel
- Tự động nén ảnh khi upload
- Chuyển sang WebP
- Mức nén: Normal (không mất chất lượng nhìn thấy)
```

### Kích thước ảnh chuẩn

| Vị trí | Kích thước |
|---|---|
| Banner trang chủ | 1920 x 800px |
| Ảnh sản phẩm | 800 x 800px (vuông) |
| Thumbnail danh mục | 600 x 400px |
| Logo | 200 x 60px (PNG trong suốt) |

### Tắt plugin không cần thiết

Chỉ giữ plugin đang dùng. Mỗi plugin thừa làm chậm site.

---

## BƯỚC 5 — KIỂM TRA MOBILE

**Công cụ kiểm tra:**
- Chrome DevTools: F12 > Toggle device toolbar (Ctrl+Shift+M)
- Google Mobile-Friendly Test: search.google.com/test/mobile-friendly

**Checklist mobile:**
- [ ] Menu hamburger hoạt động tốt
- [ ] Ảnh không bị tràn ra ngoài
- [ ] Nút "Thêm vào giỏ" dễ bấm (tối thiểu 44x44px)
- [ ] Font chữ đọc được (tối thiểu 14px)
- [ ] Checkout dùng được trên mobile
- [ ] Tốc độ load < 3 giây (test bằng PageSpeed Insights)

**Cấu hình WooCommerce mobile:**
```
WooCommerce > Settings > Products > General:
- Shop page display: Show products (hiển thị sản phẩm)
- Default product sorting: Sort by popularity
```

---

## CẤU TRÚC FILE GIAO DIỆN ĐÃ CHỈNH SỬA

```
wp-content/
├── themes/
│   ├── astra/              # Theme gốc (không chỉnh sửa)
│   └── astra-child/        # Child theme (chỉnh sửa ở đây)
│       ├── style.css
│       ├── functions.php
│       └── woocommerce/    # Override WooCommerce templates
├── plugins/
│   ├── elementor/
│   └── starter-templates/
```

### Tạo Child Theme (Bắt Buộc Trước Khi Chỉnh CSS)

```
1. Plugins > Add New > Tìm "Child Theme Configurator"
2. Tools > Child Themes > Chọn "astra" -> Create
3. Activate child theme
```

---

## KẾT QUẢ SAU PROMPT 3

- [x] Theme Astra cài và import template
- [x] Màu sắc + font thương hiệu
- [x] Homepage: Hero > Danh mục > Sản phẩm > USP > Review
- [x] Tốc độ tối ưu: cache + nén ảnh
- [x] Mobile-friendly

---

**Bước tiếp theo:** [PROMPT 4 — Thêm Sản Phẩm Chuẩn Bán Được](./04-san-pham.md)
