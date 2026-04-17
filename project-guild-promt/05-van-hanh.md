# PROMPT 5 — VẬN HÀNH THỰC TẾ

> Yêu cầu: Đã setup xong shop, có sản phẩm  
> Mục tiêu: Vận hành hàng ngày hiệu quả, xử lý đơn hàng, scale lên

---

## CHECKLIST VẬN HÀNH HÀNG NGÀY

- [ ] Kiểm tra đơn hàng mới
- [ ] Xử lý thanh toán / xác nhận COD
- [ ] Tạo vận đơn, theo dõi ship
- [ ] Xử lý khiếu nại / huỷ đơn
- [ ] Kiểm tra tồn kho

---

## 1 — QUẢN LÝ ĐƠN HÀNG

### Luồng xử lý đơn cơ bản

```
Khách đặt hàng
    |
    v
[Pending] -> Kiểm tra thông tin + thanh toán
    |
    v
[Processing] -> Đóng gói, tạo vận đơn
    |
    v
[Shipped] -> Gửi mã vận đơn cho khách
    |
    v
[Completed] -> Đơn hoàn thành
```

### Các trạng thái đơn hàng trong WooCommerce

| Trạng thái | Ý nghĩa | Hành động cần làm |
|---|---|---|
| Pending payment | Chờ thanh toán | Kiểm tra COD / chuyển khoản |
| Processing | Đã thanh toán, đang xử lý | Đóng gói, tạo vận đơn |
| On hold | Tạm giữ (cần kiểm tra) | Liên hệ khách xác nhận |
| Shipped | Đã giao cho ĐVVC | Gửi tracking cho khách |
| Completed | Hoàn thành | Không cần làm gì |
| Cancelled | Đã huỷ | Hoàn tiền nếu cần |
| Refunded | Đã hoàn tiền | Kiểm tra kho hàng |

### Xem đơn hàng

```
WooCommerce > Orders
- Lọc theo trạng thái: Processing, Pending
- Tìm kiếm theo tên / SĐT / mã đơn
- Bấm vào đơn để xem chi tiết
```

---

## 2 — XỬ LÝ THANH TOÁN COD

### Quy trình COD

```
1. Đơn mới -> trạng thái "Pending payment"
2. Kiểm tra thông tin: tên, SĐT, địa chỉ -> hợp lệ?
3. Nếu OK: Chuyển sang "Processing" (bắt đầu đóng gói)
4. Giao hàng -> shipper thu tiền mặt
5. Shipper báo lại tiền -> Chuyển đơn sang "Completed"
```

### Xử lý COD thủ công

```
WooCommerce > Orders > [Chọn đơn]
- Nút "Processing": xác nhận bắt đầu xử lý
- Thêm ghi chú nội bộ: "Đã xác nhận qua ĐT lúc 10:00 17/04"
- Thêm ghi chú cho khách: "Đơn hàng của bạn đang được chuẩn bị, dự kiến giao 1-3 ngày"
```

### Phòng tránh rủi ro COD

```
ĐƠN CÓ RỦI RO CAO:
- Địa chỉ quá chung chung (không có số nhà / hẻm)
- SĐT không liên lạc được
- Giá trị đơn > 1 triệu mà khách mới
- Đơn duplicate (cùng tên + SĐT đặt nhiều lần)

XỬ LÝ:
- Gọi điện xác nhận trước khi đóng gói
- Yêu cầu đặt cọc 30-50% với đơn giá trị cao
- Ghi blacklist SĐT/địa chỉ các đơn bị từ chối nhận hàng
```

---

## 3 — TẠO VẬN ĐƠN VÀ THEO DÕI SHIP

### GHN (Giao Hàng Nhanh)

**Nếu dùng plugin GHN đã cấu hình (Prompt 2):**
```
1. WooCommerce > Orders > [Chọn đơn đang Processing]
2. Tab "GHN Shipping": Bấm "Tạo vận đơn"
3. Chọn dịch vụ: Express (1-2 ngày) / Standard (2-4 ngày)
4. In vận đơn -> Dán vào kiện hàng
5. Mã vận đơn tự động gửi cho khách qua email
```

**Thủ công trên app/web GHN:**
```
1. Đăng nhập: khachhang.ghn.vn
2. Tạo đơn hàng mới:
   - Người nhận: Tên, SĐT, Địa chỉ
   - Kiện hàng: Cân nặng, kích thước
   - Thu tiền hộ (COD): nhập số tiền cần thu
3. In vận đơn, dán vào kiện
4. Copy mã vận đơn vào ghi chú đơn WooCommerce
```

### GHTK (Giao Hàng Tiết Kiệm)

```
1. Đăng nhập: khachhang.giaohangtietkiem.vn
2. Quản lý đơn hàng > Tạo đơn
3. Nhập thông tin tương tự GHN
4. In nhãn dán
```

### Gửi thông tin vận đơn cho khách

Thêm vào ghi chú đơn (Note for customer):
```
Đơn hàng của bạn đã được gửi đi!
Mã vận đơn: [MÃ_VẬN_ĐƠN]
Đơn vị vận chuyển: GHN / GHTK
Theo dõi: [link theo dõi]
Dự kiến nhận hàng: [ngày]
Mọi thắc mắc: [SĐT / Zalo]
```

Hoặc dùng plugin **WooCommerce Shipment Tracking**:
```
Plugins > Add New > "WooCommerce Shipment Tracking"
-> Tự động thêm tracking number vào email và trang My Account
```

---

## 4 — XỬ LÝ KHÁCH HUỶ ĐƠN / KHIẾU NẠI

### Khách huỷ đơn trước khi giao

```
1. WooCommerce > Orders > [Đơn cần huỷ]
2. Chuyển trạng thái: Cancelled
3. Hoàn trả tồn kho: WooCommerce tự động hoàn nếu bật "Restore stock"
4. Hoàn tiền:
   - COD: không cần hoàn (chưa thu tiền)
   - Chuyển khoản / VNPay: Hoàn qua nguồn gốc hoặc chuyển khoản tay
```

### Khách không nhận hàng (COD bị từ chối)

```
1. Liên hệ khách tìm hiểu lý do
2. Nếu khách muốn đặt lại: đổi địa chỉ / thời gian
3. Nếu khách không muốn: huỷ đơn, hoàn kho
4. Ghi lại SĐT vào blacklist nếu là đơn ác ý
```

Chặn đơn ác ý:
```
Tạo file: wp-content/mu-plugins/block-orders.php
Ghi lại danh sách SĐT bị chặn
Kết hợp plugin "WooCommerce Order Blocker" để tự động chặn
```

### Khách đổi trả hàng

Quy trình đổi trả chuẩn:
```
1. Khách liên hệ trong 7 ngày (theo chính sách)
2. Yêu cầu ảnh chụp lỗi / video mở hàng
3. Xác nhận lỗi do shop: chấp nhận đổi / trả
4. Khách gửi hàng về (shop trả phí ship nếu lỗi do shop)
5. Kiểm tra hàng nhận lại
6. Gửi hàng mới hoặc hoàn tiền trong 2-3 ngày
```

---

## 5 — THEO DÕI TỒN KHO

### Bật quản lý kho

```
WooCommerce > Settings > Products > Inventory:
- Enable stock management: ON
- Hold stock (minutes): 60 (giữ hàng 60 phút khi có người đang checkout)
- Notifications: nhập email nhận cảnh báo hết hàng
- Low stock threshold: 5 (cảnh báo khi còn 5 cái)
- Out of stock threshold: 0
- Out of stock visibility: Hide (ẩn khỏi shop)
```

### Cập nhật tồn kho nhanh

```
Products > [Chọn nhiều sản phẩm] > Quick Edit
Hoặc:
WooCommerce > Reports > Stock -> xem tổng quan kho
```

### Plugin quản lý kho nâng cao

**ATUM Inventory Management** (miễn phí):
```
Plugins > Add New > "ATUM"
- Xem tất cả sản phẩm + tồn kho 1 màn hình
- Cảnh báo re-order
- Báo cáo nhập / xuất kho
```

---

## 6 — BÁO CÁO & THEO DÕI DOANH THU

### Báo cáo có sẵn trong WooCommerce

```
WooCommerce > Reports:
- Orders: Doanh thu theo ngày / tuần / tháng
- Products: Sản phẩm bán chạy nhất
- Categories: Danh mục bán chạy
- Customers: Khách mua nhiều nhất
```

### Cài Google Analytics 4

```
1. Plugin: "MonsterInsights" hoặc "GA Google Analytics"
2. Kết nối với tài khoản GA4
3. Bật eCommerce tracking: theo dõi doanh thu, funnel mua hàng
```

### Chỉ số cần theo dõi hàng ngày

| Chỉ số | Cách xem | Mục tiêu |
|---|---|---|
| Đơn mới | WooCommerce > Orders | Tăng dần |
| Doanh thu | WooCommerce > Reports | Tăng >= 10%/tháng |
| Tỉ lệ hoàn thành đơn | Completed / Total | > 85% |
| Tỉ lệ huỷ đơn | Cancelled / Total | < 10% |
| Sản phẩm hết hàng | WooCommerce > Stock | = 0 |

---

## 7 — SCALE LÊN NHIỀU SẢN PHẨM

### Import sản phẩm hàng loạt

```
WooCommerce > Products > Import
- File CSV theo mẫu: WooCommerce > Products > Export (lấy mẫu trước)
- Điền thông tin vào CSV
- Import -> map các cột
```

Mẫu CSV cơ bản:
```csv
ID,Name,Regular price,Sale price,Categories,Tags,Images,Description,Short description,SKU,Stock
,Áo thun nam trắng,199000,149000,Áo thun nam,cotton áo nam,http://...,Mô tả dài,...,AT-001,50
```

### Cấu trúc tổ chức khi nhiều sản phẩm

```
> 50 sản phẩm:
  - Danh mục rõ ràng, có ảnh đẹp
  - Dùng attributes để filter (màu, size, chất liệu)
  - Bổ sung tag để tìm kiếm

> 200 sản phẩm:
  - Thuê người nhập liệu
  - Dùng ATUM quản lý kho
  - Cài WooCommerce Product Bundles (bán combo)

> 500 sản phẩm:
  - Xem xét cài Elasticsearch (WooCommerce Product Search)
  - Cache mạnh hơn (Redis)
  - Xem xét nâng cấp hosting
```

### Tự động hoá việc vận hành

| Việc | Công cụ tự động |
|---|---|
| Email xác nhận đơn | WooCommerce có sẵn |
| Email nhắc giỏ hàng bỏ | Plugin: CartFlows hoặc Abandoned Cart |
| Đăng bài Facebook tự động | Plugin: AutomateWoo hoặc Zapier |
| Backup hàng ngày | UpdraftPlus (schedule hàng ngày) |
| Báo cáo doanh thu | WooCommerce + GA4 |

---

## LỊCH TRÌNH VẬN HÀNH HÀNG NGÀY

```
SÁNG (8:00 - 9:00):
[ ] Kiểm tra đơn mới qua đêm
[ ] Xác nhận đơn COD (gọi điện nếu cần)
[ ] Tạo vận đơn, chuẩn bị kiện hàng
[ ] Trả lời tin nhắn khách hàng

CHIỀU (14:00 - 15:00):
[ ] Kiểm tra đơn mới buổi sáng
[ ] Theo dõi trạng thái ship các đơn đang giao
[ ] Cập nhật tồn kho nếu có hàng nhập về
[ ] Xử lý khiếu nại (nếu có)

TỐI (20:00 - 21:00):
[ ] Tổng kết đơn trong ngày
[ ] Chuẩn bị đơn cho ngày mai
[ ] Đăng bài sản phẩm mới / khuyến mãi (nếu có)
[ ] Kiểm tra review mới -> rep comment
```

---

## XỬ LÝ TÌNH HUỐNG THƯỜNG GẶP

### Khách nói chưa nhận được hàng

```
1. Kiểm tra trạng thái vận đơn trên web GHN/GHTK
2. Nếu đang "đang giao": báo khách chờ thêm 1-2 ngày
3. Nếu "giao thất bại": liên hệ ĐVVC tìm hiểu lý do
4. Nếu quá 7 ngày chưa có tin: yêu cầu ĐVVC điều tra
5. Nếu mất hàng: bồi thường theo chính sách ĐVVC, gửi hàng mới cho khách
```

### Đơn bị trùng lặp

```
1. Huỷ 1 trong 2 đơn (giữ lại đơn khách muốn)
2. Hoàn kho tự động
3. Thông báo khách
4. Kiểm tra lỗi hệ thống (nguyên nhân duplicate)
```

### Website bị chậm / lỗi

```
1. Kiểm tra: tools.pingdom.com hoặc gtmetrix.com
2. Kiểm tra Hosting: CPU / RAM / Disk usage
3. Xoá cache: LiteSpeed Cache > Purge All
4. Tắt plugin vừa cài (thường là nguyên nhân)
5. Liên hệ hosting support
```

---

## PLUGIN HỖ TRỢ VẬN HÀNH

| Plugin | Chức năng | Phí |
|---|---|---|
| WooCommerce Shipment Tracking | Thêm mã vận đơn vào đơn hàng | Miễn phí |
| ATUM Inventory Management | Quản lý kho nâng cao | Miễn phí |
| Abandoned Cart Lite | Nhắc khách giỏ hàng bỏ | Miễn phí |
| WooCommerce PDF Invoices | In hoá đơn PDF | Miễn phí |
| AutomateWoo | Tự động hoá marketing | Trả phí |

---

**Toàn bộ hệ thống đã sẵn sàng. Chúc bạn bán hàng hiệu quả!**

Xem lại từ đầu: [README.md](./README.md)
