# PROMPT 4 — THÊM SẢN PHẨM CHUẨN BÁN ĐƯỢC

> Yêu cầu: Đã có giao diện (Prompt 3)  
> Mục tiêu: Đăng sản phẩm đúng chuẩn SEO + conversion cao

---

## CHECKLIST ĐĂNG SẢN PHẨM

- [ ] Bước 1: Tạo danh mục sản phẩm
- [ ] Bước 2: Viết title chuẩn SEO
- [ ] Bước 3: Viết mô tả bán hàng
- [ ] Bước 4: Set giá + khuyến mãi
- [ ] Bước 5: Upload ảnh đúng chuẩn
- [ ] Bước 6: Cấu hình biến thể (nếu có)
- [ ] Bước 7: Cấu hình SEO on-page

---

## BƯỚC 1 — TẠO DANH MỤC SẢN PHẨM

**Products > Categories**

```
1. Tên danh mục: Ngắn gọn, rõ ràng (ví dụ: "Áo Thun", "Đầm Váy", "Phụ Kiện")
2. Slug: tự động tạo (hoặc tự đặt: ao-thun, dam-vay)
3. Ảnh danh mục: 600x400px, đẹp, đại diện cho cả nhóm hàng
4. Mô tả: 1-2 câu, có từ khoá chính
```

Ví dụ cấu trúc danh mục:
```
Sản phẩm
├── Quần áo nữ
│   ├── Áo
│   ├── Quần
│   └── Đầm váy
├── Quần áo nam
│   ├── Áo thun
│   └── Áo sơ mi
└── Phụ kiện
    ├── Túi xách
    └── Thắt lưng
```

---

## BƯỚC 2 — VIẾT TITLE SẢN PHẨM CHUẨN SEO

### Công thức Title

```
[Tên sản phẩm chính] + [Đặc điểm nổi bật] + [Thương hiệu / Chất liệu]

Ví dụ:
- Áo Thun Trơn Cotton 100% Cổ Tròn Nam - Basic Tee
- Đầm Váy Hoa Nhỏ Tay Phồng Nữ Du Lịch Hè 2024
- Giày Thể Thao Nữ Đế Cao 5cm Phong Cách Hàn Quốc
```

### Quy tắc viết title

| Quy tắc | Ví dụ đúng | Ví dụ sai |
|---|---|---|
| 50-70 ký tự | "Áo Thun Nam Cotton Thoáng Mát Mùa Hè" | "Áo" |
| Có từ khoá chính | "Áo thun nam", "mùa hè" | Chỉ có tên riêng |
| Không CAPS LOCK | "Áo Thun Nam" | "ÁO THUN NAM" |
| Không spam từ khoá | "Áo Thun Nam Cotton Thoáng Mát" | "Áo thun áo nam áo cotton áo rẻ" |

---

## BƯỚC 3 — VIẾT MÔ TẢ BÁN HÀNG

### Short Description (Hiển thị ngay trang sản phẩm)

Viết 3-5 dòng, ngắn gọn, tập trung vào lợi ích:

```
Template:
[Sản phẩm] được làm từ [chất liệu], giúp bạn [lợi ích chính].
Phù hợp với [đối tượng] yêu thích [phong cách/tình huống].
[Điểm nổi bật 1] | [Điểm nổi bật 2] | [Điểm nổi bật 3]

Ví dụ:
Áo thun trơn nam chất liệu cotton 100% thoáng mát, thở mồ hôi.
Thiết kế cổ tròn đơn giản, dễ phối đồ với mọi outfit hàng ngày.
Có: S / M / L / XL | Màu: 10 màu | Bảo hành: 6 tháng lỗi chỉ
```

### Long Description (Tab Mô tả)

Cấu trúc đầy đủ:

```markdown
## Giới thiệu sản phẩm

[1-2 đoạn mô tả tổng quan, có từ khoá SEO]

## Đặc điểm nổi bật

- Chất liệu: Cotton 100%, dày 200gsm, không xơ, không nhung
- Thiết kế: Cổ tròn, tay ngắn, form regular fit
- Màu sắc: Có sẵn 10 màu cơ bản và thời trang
- Kích cỡ: S / M / L / XL / XXL (xem bảng size phía dưới)

## Hướng dẫn chọn size

| Size | Chiều cao | Cân nặng | Vòng ngực |
|------|-----------|----------|-----------|
| S    | 155-160cm | 45-52kg  | 82-86cm   |
| M    | 160-165cm | 52-60kg  | 86-90cm   |
| L    | 165-170cm | 60-68kg  | 90-96cm   |
| XL   | 170-175cm | 68-78kg  | 96-102cm  |

## Hướng dẫn bảo quản

- Giặt máy với nước lạnh, chế độ nhẹ
- Không dùng chất tẩy mạnh
- Phơi trong mát, tránh ánh nắng trực tiếp
- Ủi ở nhiệt độ thấp

## Chính sách đổi trả

- Đổi trả trong 7 ngày nếu lỗi sản phẩm
- Sản phẩm còn nguyên tag, chưa qua sử dụng
- Liên hệ: [số điện thoại / fanpage]
```

### Prompt AI để viết mô tả nhanh

Copy prompt này vào ChatGPT / Claude:

```
Viết mô tả sản phẩm WooCommerce cho:
- Tên sản phẩm: [tên]
- Chất liệu: [chất liệu]
- Đặc điểm: [các đặc điểm]
- Đối tượng: [khách hàng mục tiêu]
- Phong cách: [phong cách thiết kế]

Yêu cầu:
- Short description: 3-4 câu, ngắn gọn, lợi ích rõ ràng
- Long description: đầy đủ theo cấu trúc HTML, có bảng size, hướng dẫn bảo quản
- Từ khoá SEO chính: [từ khoá]
- Ngôn ngữ: Tiếng Việt tự nhiên, thân thiện, bán hàng
```

---

## BƯỚC 4 — SET GIÁ + KHUYẾN MÃI

**Products > Add New > Product data > General**

### Giá thông thường

```
Regular Price: 299000  (không cần dấu . hay , WooCommerce tự format)
```

### Giá khuyến mãi (Sale)

```
Sale Price: 199000
Bấm lịch (Schedule): đặt thời gian bắt đầu / kết thúc khuyến mãi
```

Hiển thị trên frontend:
```
~~299.000₫~~  199.000₫  (-33%)
```

### Cách tính giá hợp lý

```
Giá bán = Giá vốn x (1 + % lợi nhuận) x (1 + % chi phí)

Ví dụ:
- Giá vốn: 80.000₫
- Lợi nhuận mong muốn: 50%
- Chi phí ship + vận hành: 20%
- Giá bán: 80.000 x 1.5 x 1.2 = 144.000₫ -> bán 149.000₫

Giá sale (khuyến mãi): 20-30% giảm so với giá gốc
```

---

## BƯỚC 5 — UPLOAD ẢNH ĐÚNG CHUẨN

### Kích thước ảnh

| Vị trí | Kích thước | Định dạng |
|---|---|---|
| Ảnh chính sản phẩm | 800x800px | JPG / WebP |
| Ảnh gallery phụ | 800x800px | JPG / WebP |
| Ảnh danh mục | 600x400px | JPG / WebP |

### Quy tắc ảnh bán hàng

```
NÊN:
- Nền trắng hoặc xám nhạt (professional)
- Chụp nhiều góc: trước, sau, chi tiết, đang mặc
- Ảnh thực tế / người mặc (tăng tin tưởng)
- Ảnh so sánh kích thước (dễ hiểu)
- Tất cả ảnh cùng nền, cùng kiểu

KHÔNG NÊN:
- Ảnh mờ, vàng, tối
- Logo / watermark che sản phẩm
- Ảnh copy từ web khác (vi phạm bản quyền)
- Mỗi ảnh 1 kiểu nền khác nhau
```

### Tên file ảnh chuẩn SEO

```
SAI:  IMG_20240101.jpg
ĐÚNG: ao-thun-nam-cotton-trang-size-M.jpg

Format: [từ-khoá-sản-phẩm]-[màu]-[size-nếu-có].jpg
```

### Alt text cho ảnh

Trong phần upload ảnh, điền Alt text:
```
"Áo thun nam cotton trắng cổ tròn size M - Shop Tên"
```

---

## BƯỚC 6 — CẤU HÌNH BIẾN THỂ (VARIABLE PRODUCTS)

Dùng cho sản phẩm có nhiều màu / size.

```
1. Products > Add New
2. Product type: Variable product (thay vì Simple product)
3. Tab "Attributes":
   - Add attribute: "Màu sắc" -> giá trị: Đỏ | Xanh | Trắng | Đen
   - Add attribute: "Size" -> giá trị: S | M | L | XL
   - Tích: "Used for variations"
4. Tab "Variations":
   - "Generate variations" -> tự động tạo tất cả tổ hợp
   - Set giá / ảnh / kho riêng cho từng biến thể nếu cần
```

Biến thể ví dụ:
```
- Biến thể Trắng-M: ảnh áo trắng, giá 199k, kho: 50
- Biến thể Đỏ-L:    ảnh áo đỏ,   giá 199k, kho: 30
- Biến thể Đen-XL:  hết hàng -> WooCommerce tự ẩn
```

---

## BƯỚC 7 — CẤU HÌNH SEO ON-PAGE

Dùng plugin **Rank Math** hoặc **Yoast SEO**:

```
Cài: Plugins > Add New > "Rank Math SEO" > Install > Activate
```

Trên trang chỉnh sửa sản phẩm, cuộn xuống phần Rank Math:

```
SEO Title:    Áo Thun Nam Cotton Thoáng Mát - [Tên Shop] | Giao Hàng Nhanh
Meta Desc:    Áo thun nam cotton 100% thoáng mát, 10 màu, size S-XXL.
              Giá chỉ [giá]. Giao hàng toàn quốc. Đổi trả 7 ngày.
Focus Keyword: áo thun nam cotton
```

**Checklist SEO từng sản phẩm:**
- [ ] Title có từ khoá chính, 50-70 ký tự
- [ ] Meta description có từ khoá, 150-160 ký tự, có giá / CTA
- [ ] URL slug ngắn gọn: `/ao-thun-nam-cotton`
- [ ] Alt text cho tất cả ảnh
- [ ] Có internal link đến danh mục hoặc sản phẩm liên quan
- [ ] Schema Product (Rank Math tự thêm tự động)

---

## TEMPLATE CHECKLIST ĐĂNG 1 SẢN PHẨM

```
Sản phẩm: ___________________

[ ] Tên sản phẩm (50-70 ký tự, có từ khoá)
[ ] Short description (3-5 dòng, lợi ích rõ ràng)
[ ] Long description (đầy đủ: mô tả, size chart, bảo quản, đổi trả)
[ ] Giá gốc + Giá sale (nếu có)
[ ] Ảnh chính 800x800px (nền trắng)
[ ] Ảnh gallery (3-5 ảnh: góc khác nhau, chi tiết, đang mặc)
[ ] Tên file ảnh có từ khoá
[ ] Alt text cho từng ảnh
[ ] Danh mục phù hợp
[ ] Tags (3-5 tag liên quan)
[ ] SKU (mã sản phẩm nội bộ)
[ ] Tồn kho (số lượng)
[ ] Cân nặng (để tính phí ship)
[ ] SEO title + Meta description (Rank Math)
[ ] URL slug ngắn gọn
```

---

**Bước tiếp theo:** [PROMPT 5 — Vận Hành Thực Tế](./05-van-hanh.md)
