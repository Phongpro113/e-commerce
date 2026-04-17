# PROMPT 2 — SETUP SHOP CHUẨN BÁN HÀNG

> Yêu cầu: Đã hoàn thành cài đặt WordPress + WooCommerce (Prompt 1)  
> Mục tiêu: Cấu hình đầy đủ để bắt đầu bán hàng thực tế

---

## CHECKLIST SETUP SHOP

- [ ] Bước 1: Cấu hình tiền tệ VND
- [ ] Bước 2: Cấu hình thuế + địa chỉ shop
- [ ] Bước 3: Cài đặt phương thức thanh toán
- [ ] Bước 4: Cấu hình vận chuyển (Shipping)
- [ ] Bước 5: Tạo các trang cần thiết
- [ ] Bước 6: Cấu hình email thông báo

---

## BƯỚC 1 — CẤU HÌNH TIỀN TỆ VND

**WooCommerce > Settings > General**

| Trường | Giá trị |
|---|---|
| Selling location(s) | Vietnam |
| Default customer location | No location by default |
| Currency | Vietnamese Dong (₫) |
| Currency Position | Right (100.000₫) |
| Thousand Separator | . |
| Decimal Separator | , |
| Number of Decimals | 0 |

Bấm **Save changes**.

---

## BƯỚC 2 — CẤU HÌNH THUẾ + ĐỊA CHỈ SHOP

**WooCommerce > Settings > General**

```
Store Address:    Địa chỉ cửa hàng
City:             Hà Nội / TP HCM / ...
Country/State:    Vietnam
Postcode:         (bỏ trống nếu không có)
```

Phần **Tax** (thuế):
- Nếu không xuất hoá đơn VAT: tắt "Enable taxes" đi
- Nếu có xuất VAT: bật lên, vào tab Taxes cấu hình 10%

---

## BƯỚC 3 — CÀI ĐẶT PHƯƠNG THỨC THANH TOÁN

**WooCommerce > Settings > Payments**

### 3.1 — COD (Thanh toán khi nhận hàng)

COD có sẵn trong WooCommerce, chỉ cần bật lên:

```
1. WooCommerce > Settings > Payments
2. Tìm "Cash on delivery" -> bấm "Set up"
3. Enable: bật ON
4. Title: "Thanh toán khi nhận hàng (COD)"
5. Description: "Thanh toán bằng tiền mặt khi nhận được hàng."
6. Instructions: "Vui lòng chuẩn bị đủ tiền mặt khi nhận hàng."
7. Save changes
```

### 3.2 — VNPay

Dùng plugin **VNPay WooCommerce** (miễn phí trên WordPress.org):

```
1. Plugins > Add New > Tìm "VNPay WooCommerce"
   (Plugin của: "VNPay" hoặc "Thanh Toán VNPay")
2. Install > Activate
3. WooCommerce > Settings > Payments > VNPay
4. Điền thông tin lấy từ dashboard.vnpay.vn:
   - Terminal ID (vnp_TmnCode)
   - Secret Key (vnp_HashSecret)
5. Chọn môi trường: Sandbox (test) hoặc Production (thật)
6. Save
```

> Đăng ký tài khoản merchant VNPay tại: https://sandbox.vnpayment.vn/devreg (sandbox) hoặc liên hệ VNPay trực tiếp để mở tài khoản thật.

### 3.3 — MoMo

Dùng plugin **MoMo Payment Gateway for WooCommerce**:

```
1. Plugins > Add New > Tìm "MoMo Payment WooCommerce"
2. Install > Activate
3. WooCommerce > Settings > Payments > MoMo
4. Điền thông tin từ MoMo Business:
   - Partner Code
   - Access Key
   - Secret Key
5. Save
```

> Đăng ký MoMo Business tại: https://business.momo.vn

### 3.4 — ZaloPay (tuỳ chọn)

Plugin: **ZaloPay WooCommerce** — tương tự cách trên, lấy key từ developers.zalopay.vn

---

## BƯỚC 4 — CẤU HÌNH VẬN CHUYỂN (SHIPPING)

**WooCommerce > Settings > Shipping**

### 4.1 — Tạo Shipping Zone

```
1. Shipping > Shipping Zones > Add zone
2. Zone name: "Việt Nam"
3. Zone regions: Vietnam
4. Add shipping method:
   - Flat rate (phí cố định)
   - Free shipping (miễn phí vận chuyển)
5. Save
```

### 4.2 — Flat Rate (Phí Vận Chuyển Cố Định)

```
1. Bấm vào "Flat rate" trong zone vừa tạo
2. Method title: "Giao hàng toàn quốc"
3. Tax status: None
4. Cost: 30000  (30.000 VND)
5. Save
```

Công thức phí linh hoạt theo giỏ hàng:
```
# Phí theo số lượng sản phẩm
[qty] * 5000 + 20000

# Miễn phí nếu giỏ hàng > 500k
(sử dụng "Free Shipping" với điều kiện minimum order amount: 500000)
```

### 4.3 — Tích hợp GHN (Giao Hàng Nhanh)

Plugin: **GHN Shipping for WooCommerce** (miễn phí)

```
1. Plugins > Add New > Tìm "GHN Shipping"
2. Install > Activate
3. WooCommerce > Settings > Shipping > GHN
4. Điền thông tin từ developer.ghn.vn:
   - Token API
   - Shop ID
   - Province / District / Ward (địa chỉ lấy hàng)
5. Save
```

> Đăng ký tài khoản GHN Developer: https://dev.ghn.vn

### 4.4 — Tích hợp GHTK (Giao Hàng Tiết Kiệm)

Plugin: **GHTK Shipping for WooCommerce**

```
1. Plugins > Add New > Tìm "GHTK"
2. Nhập API Token từ khach.ghtk.vn > Quản lý > API
3. Cấu hình địa chỉ lấy hàng
4. Save
```

---

## BƯỚC 5 — TẠO CÁC TRANG CẦN THIẾT

WooCommerce tự động tạo các trang này khi cài lần đầu. Kiểm tra tại:

**WooCommerce > Status > Pages**

Đảm bảo các trang này tồn tại:

| Trang | URL | Mô tả |
|---|---|---|
| Shop | /shop | Danh sách sản phẩm |
| Cart | /cart | Giỏ hàng |
| Checkout | /checkout | Thanh toán |
| My Account | /my-account | Quản lý tài khoản khách |
| Terms & Conditions | /dieu-khoan | Điều khoản (tuỳ chọn) |

### Nếu trang bị mất / lỗi

```
1. Pages > Add New
2. Tạo trang tên "Shop"
3. Thêm shortcode: [woocommerce_shop] hoặc chọn template từ WooCommerce
4. WooCommerce > Settings > Advanced > Page Setup
5. Gán trang vào đúng slot
```

### Tạo trang Homepage

```
1. Pages > Add New
2. Tên: "Trang chủ"
3. Template: Full Width (hoặc tuỳ theme)
4. Settings > Reading > Homepage displays: A static page > chọn "Trang chủ"
```

---

## BƯỚC 6 — CẤU HÌNH EMAIL THÔNG BÁO

**WooCommerce > Settings > Emails**

Bật các email quan trọng:

| Email | Gửi đến | Nên bật? |
|---|---|---|
| New order | Admin | Bật (có đơn mới) |
| Cancelled order | Admin | Bật |
| Processing order | Khách hàng | Bật (xác nhận đặt hàng) |
| Completed order | Khách hàng | Bật (đã giao hàng) |
| Customer invoice | Khách hàng | Tuỳ chọn |

Cấu hình sender:
```
WooCommerce > Settings > Emails > Email sender options:
- "From" name:    Tên shop của bạn
- "From" address: no-reply@domain.cua.ban
```

---

## PLUGIN ĐÃ CÀI ĐẶT SAU PROMPT 2

| Plugin | Chức năng |
|---|---|
| WooCommerce | Core |
| VNPay WooCommerce | Thanh toán VNPay |
| MoMo Payment Gateway | Thanh toán MoMo |
| GHN Shipping | Vận chuyển GHN |
| GHTK Shipping | Vận chuyển GHTK |

---

## KIỂM TRA TRƯỚC KHI MỞ HÀNG

- [ ] Đặt thử 1 đơn COD -> kiểm tra email thông báo
- [ ] Giỏ hàng tính phí ship đúng
- [ ] Trang Checkout hiển thị đủ phương thức thanh toán
- [ ] Trang My Account khách đăng ký / đăng nhập được
- [ ] Giá hiển thị đúng định dạng VND (100.000₫)

---

**Bước tiếp theo:** [PROMPT 3 — Giao Diện Bán Hàng](./03-giao-dien.md)
