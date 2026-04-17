# PROMPT 1 — KHỞI TẠO WORDPRESS + WOOCOMMERCE TỪ ZERO

> Stack: WordPress + WooCommerce  
> Mục tiêu: Tạo website e-commerce hoàn chỉnh từ folder trống

---

## CHECKLIST TỔNG QUAN

- [ ] Bước 1: Chuẩn bị môi trường (Hosting / VPS / Local)
- [ ] Bước 2: Tạo database MySQL
- [ ] Bước 3: Tải và giải nén WordPress
- [ ] Bước 4: Cấu hình wp-config.php
- [ ] Bước 5: Chạy trình cài đặt WordPress
- [ ] Bước 6: Cài plugin WooCommerce
- [ ] Bước 7: Chạy WooCommerce Setup Wizard

---

## BƯỚC 1 — CHUẨN BỊ MÔI TRƯỜNG

### Option A: Dùng Hosting Có Sẵn (Shared Hosting)
Yêu cầu tối thiểu:
- PHP >= 7.4 (khuyến nghị PHP 8.1+)
- MySQL >= 5.7 hoặc MariaDB >= 10.3
- HTTPS (SSL certificate)
- Disk: tối thiểu 2GB

Hosting phổ biến cho WordPress Việt Nam:
| Nhà cung cấp | Giá / tháng | Ghi chú |
|---|---|---|
| Tinohost | ~50k | Giá rẻ, hỗ trợ tiếng Việt |
| Vietnix | ~99k | Performance tốt |
| DigitalOcean VPS | ~$6 | Tự quản lý, linh hoạt |
| Cloudways | ~$11 | Managed VPS, dễ dùng |

### Option B: Cài Local để Test (XAMPP / LocalWP)
```
1. Tải LocalWP: https://localwp.com
2. Cài đặt -> Create new site
3. Chọn PHP version (8.1+)
4. Site sẽ tự động có WordPress
```

### Option C: VPS Trắng (Ubuntu 22.04)
Cài LEMP stack:
```bash
# Cập nhật server
sudo apt update && sudo apt upgrade -y

# Cài Nginx, MySQL, PHP
sudo apt install nginx mysql-server php8.1-fpm php8.1-mysql \
  php8.1-curl php8.1-gd php8.1-mbstring php8.1-xml \
  php8.1-zip php8.1-intl -y

# Kiểm tra
nginx -v
mysql --version
php -v
```

---

## BƯỚC 2 — TẠO DATABASE MYSQL

### Trên Shared Hosting (cPanel)
```
1. Đăng nhập cPanel
2. Tìm "MySQL Databases"
3. Tạo database mới: tên_db (ví dụ: shop_db)
4. Tạo user mới: tên_user / mật_khẩu_mạnh
5. Add user vào database -> chọn ALL PRIVILEGES
6. Lưu lại 4 thông tin:
   - Database name: shop_db
   - Username: shop_user
   - Password: xxxxxxxxx
   - Host: localhost
```

### Trên VPS (command line)
```bash
# Đăng nhập MySQL
sudo mysql -u root -p

# Tạo database
CREATE DATABASE shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Tạo user
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'MatKhauManh@123';

# Cấp quyền
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## BƯỚC 3 — TẢI VÀ GIẢI NÉN WORDPRESS

### Tải bản mới nhất
```bash
# Tải WordPress tiếng Việt (khuyến nghị)
wget https://vi.wordpress.org/latest-vi.zip

# Hoặc bản tiếng Anh
wget https://wordpress.org/latest.zip

# Giải nén
unzip latest-vi.zip

# Chuyển vào thư mục web (VPS)
sudo cp -r wordpress/* /var/www/html/

# Phân quyền
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
```

### Trên Shared Hosting
```
1. Tải file zip WordPress về máy
2. Upload qua File Manager hoặc FTP (FileZilla)
3. Giải nén vào thư mục public_html
4. Đảm bảo các file WordPress nằm thẳng trong public_html/
   (không phải public_html/wordpress/)
```

Kiểm tra cấu trúc đúng:
```
public_html/
├── wp-admin/
├── wp-content/
├── wp-includes/
├── index.php
├── wp-config-sample.php
└── ...
```

---

## BƯỚC 4 — CẤU HÌNH WP-CONFIG.PHP

```bash
# Copy file mẫu
cp wp-config-sample.php wp-config.php
nano wp-config.php   # hoặc mở bằng text editor
```

Sửa các dòng sau:
```php
// Thông tin database
define( 'DB_NAME', 'shop_db' );              // <-- Tên database
define( 'DB_USER', 'shop_user' );            // <-- Username MySQL
define( 'DB_PASSWORD', 'MatKhauManh@123' );  // <-- Password MySQL
define( 'DB_HOST', 'localhost' );            // <-- Giữ nguyên

// Ngôn ngữ (thêm vào nếu chưa có)
define( 'WPLANG', 'vi' );

// Security Keys (lấy từ: https://api.wordpress.org/secret-key/1.1/salt/)
define( 'AUTH_KEY',         'xxx...' );
define( 'SECURE_AUTH_KEY',  'xxx...' );
// ... (thay hết bằng key mới từ link trên)

// Tắt debug khi lên production
define( 'WP_DEBUG', false );
```

> QUAN TRỌNG: Truy cập https://api.wordpress.org/secret-key/1.1/salt/ để lấy Security Keys mới, copy-paste vào wp-config.php thay thế phần cũ.

---

## BƯỚC 5 — CHẠY TRÌNH CÀI ĐẶT WORDPRESS

1. Mở trình duyệt, truy cập domain (hoặc `localhost/tên-site`)
2. Chọn ngôn ngữ: **Tiếng Việt**
3. Nhập thông tin:
   - **Tiêu đề website**: Tên shop của bạn (ví dụ: "Shop Áo Đẹp")
   - **Tên đăng nhập**: `admin` (đổi thành tên khác để bảo mật)
   - **Mật khẩu**: Dùng mật khẩu mạnh (lưu lại cẩn thận)
   - **Email**: Email quản trị
4. Bấm **"Cài đặt WordPress"**
5. Đăng nhập vào `/wp-admin`

---

## BƯỚC 6 — CÀI PLUGIN WOOCOMMERCE

Từ WordPress Admin:
```
1. Plugins > Add New Plugin
2. Tìm kiếm: "WooCommerce"
3. Chọn plugin của "Automattic"
4. Bấm "Install Now" -> "Activate"
```

Sau khi kích hoạt, WooCommerce sẽ hỏi có chạy Setup Wizard không -> Bấm **"Yes, please"**.

---

## BƯỚC 7 — WOOCOMMERCE SETUP WIZARD

WooCommerce sẽ hiển thị hướng dẫn setup từng bước:

### 7.1 — Store Details
```
- Country / Region: Vietnam
- Address: Địa chỉ shop
- City: Thành phố
- Postcode: Mã bưu điện
```

### 7.2 — Industry
Chọn ngành phù hợp (ví dụ: Clothing & accessories, Electronics, ...)

### 7.3 — Product Types
Tích: **Physical products** (sản phẩm vật lý)
Optional: Downloads (nếu bán hàng số)

### 7.4 — Business Details
- Số sản phẩm hiện tại: Chọn mức phù hợp
- Đang bán ở đâu khác: Không (no)

### 7.5 — Theme
Có thể chọn theme sau, bấm **"Continue with my active theme"**

### 7.6 — Kết thúc
Bấm **"Visit Dashboard"** để vào trang quản trị.

---

## SAU KHI HOÀN THÀNH

Kiểm tra các mục này trong WooCommerce > Settings:

| Mục | Giá trị cần đặt |
|---|---|
| Currency | Vietnamese Dong (VND) |
| Currency Position | Right (100.000₫) |
| Thousand Separator | . (dấu chấm) |
| Decimal Separator | , (dấu phẩy) |
| Number of Decimals | 0 |

Điều hướng: **WooCommerce > Settings > General > Currency Options**

---

## CẤU TRÚC THƯ MỤC SAU KHI CÀI

```
public_html/
├── wp-admin/              # Khu vực quản trị (không chỉnh sửa)
├── wp-content/
│   ├── plugins/
│   │   └── woocommerce/   # Plugin WooCommerce
│   ├── themes/            # Theme cài đặt
│   └── uploads/           # Ảnh sản phẩm, media
├── wp-includes/           # Core WordPress (không chỉnh sửa)
└── wp-config.php          # File cấu hình chính
```

---

## LƯU Ý BẢO MẬT QUAN TRỌNG

- [ ] Đổi URL đăng nhập mặc định `/wp-admin` bằng plugin WPS Hide Login
- [ ] Cài plugin bảo mật: **Wordfence Security** hoặc **iThemes Security**
- [ ] Backup thường xuyên: **UpdraftPlus**
- [ ] Bật HTTPS / SSL (Let's Encrypt miễn phí)
- [ ] Đổi tên đăng nhập `admin` thành tên khác
- [ ] Đặt mật khẩu mạnh cho tài khoản admin

---

## PLUGIN TỐI THIỂU PHẢI CÓ

| Plugin | Mục đích | Miễn phí? |
|---|---|---|
| WooCommerce | Core bán hàng | Có |
| WPS Hide Login | Ẩn trang login | Có |
| UpdraftPlus | Backup tự động | Có (bản có phí thêm tính năng) |
| WP Super Cache / LiteSpeed Cache | Tăng tốc | Có |
| Yoast SEO / Rank Math | SEO | Có |

---

**Bước tiếp theo:** Sau khi hoàn thành Bước 1-7, tiến hành [PROMPT 2 — Setup Shop Chuẩn Bán Hàng](./02-setup-shop.md)
