# Hướng Dẫn Cài Đặt Dự Án

Hướng dẫn cài đặt và chạy website e-commerce WordPress + WooCommerce trên máy local bằng Docker.

---

## Yêu cầu hệ thống

| Phần mềm | Phiên bản tối thiểu | Kiểm tra |
|---|---|---|
| Docker | 20.10+ | `docker --version` |
| Docker Compose | 2.0+ | `docker compose version` |
| Git | bất kỳ | `git --version` |
| RAM | 2GB trống | — |
| Disk | 5GB trống | — |

Cài Docker: https://docs.docker.com/get-docker/

---

## Cài đặt nhanh (5 phút)

### Bước 1 — Clone dự án

```bash
git clone <repository-url> e-commerce
cd e-commerce
```

### Bước 2 — Tạo file môi trường

```bash
cp .env.example .env
```

Mở file `.env` và đổi các giá trị mật khẩu:

```env
MYSQL_ROOT_PASSWORD=change_me_root_password   # <-- đổi
MYSQL_DATABASE=wordpress
MYSQL_USER=wp_user
MYSQL_PASSWORD=change_me_db_password          # <-- đổi

WORDPRESS_TABLE_PREFIX=wc_
WORDPRESS_SITE_URL=http://localhost:8080

WP_ADMIN_USER=admin
WP_ADMIN_PASSWORD=change_me_admin_password    # <-- đổi
WP_ADMIN_EMAIL=your@email.com                 # <-- đổi

WP_PORT=8080
PMA_PORT=8081
```

> **Quan trọng:** Không commit file `.env` lên git. File này đã được thêm vào `.gitignore`.

### Bước 3 — Khởi động Docker

```bash
docker compose up -d
```

Lần đầu chạy sẽ tự động tải image (~500MB), đợi khoảng 2-3 phút.

Kiểm tra các container đã chạy:

```bash
docker compose ps
```

Kết quả mong đợi:

```
NAME            STATUS
ecommerce_db    Up
ecommerce_wp    Up
ecommerce_pma   Up
```

### Bước 4 — Cài đặt WordPress + WooCommerce

```bash
# Cài WP-CLI vào container
docker exec ecommerce_wp bash -c "
  curl -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
  chmod +x /usr/local/bin/wp
"

# Cài đặt WordPress (đọc thông tin từ .env)
source .env
docker exec ecommerce_wp wp core install \
  --url="${WORDPRESS_SITE_URL}" \
  --title="${WP_SITE_TITLE}" \
  --admin_user="${WP_ADMIN_USER}" \
  --admin_password="${WP_ADMIN_PASSWORD}" \
  --admin_email="${WP_ADMIN_EMAIL}" \
  --locale='vi' \
  --allow-root

# Cài WooCommerce
docker exec ecommerce_wp wp plugin install woocommerce --activate --allow-root

# Cấu hình tiền tệ VND
docker exec ecommerce_wp bash -c "
  wp option update woocommerce_currency 'VND' --allow-root
  wp option update woocommerce_currency_pos 'right' --allow-root
  wp option update woocommerce_price_thousand_sep '.' --allow-root
  wp option update woocommerce_price_decimal_sep ',' --allow-root
  wp option update woocommerce_price_num_decimals '0' --allow-root
"

# Tạo các trang WooCommerce (Shop, Cart, Checkout, My Account)
docker exec ecommerce_wp wp wc tool run install_pages --user=admin --allow-root
```

### Bước 5 — Truy cập website

Mở trình duyệt:

| URL | Mô tả |
|---|---|
| `http://localhost:8080` | Website frontend |
| `http://localhost:8080/wp-admin` | Trang quản trị WordPress |
| `http://localhost:8081` | phpMyAdmin — quản lý database |

Đăng nhập admin bằng `WP_ADMIN_USER` / `WP_ADMIN_PASSWORD` đã đặt trong `.env`.

---

## Cài đặt đầy đủ (Khuyến nghị)

Sau khi hoàn thành các bước trên, chạy thêm:

### Cài theme Astra

```bash
docker exec ecommerce_wp wp theme install astra --activate --allow-root
```

### Cài plugin cần thiết

```bash
docker exec ecommerce_wp wp plugin install \
  wps-hide-login \
  updraftplus \
  litespeed-cache \
  wordpress-seo \
  --activate --allow-root
```

### Bật thanh toán COD

```bash
docker exec ecommerce_wp wp option update woocommerce_cod_settings \
  '{"enabled":"yes","title":"Thanh toán khi nhận hàng (COD)","description":"Thanh toán bằng tiền mặt khi nhận được hàng."}' \
  --format=json --allow-root
```

### Tạo Shipping Zone Việt Nam

```bash
docker exec ecommerce_wp wp wc shipping_zone create \
  --name='Việt Nam' \
  --user=admin --allow-root
```

---

## Cấu hình biến môi trường

File `.env.example` chứa toàn bộ biến với giá trị mẫu — đây là file duy nhất được commit lên git.

| Biến | Mô tả | Giá trị mặc định |
|---|---|---|
| `MYSQL_ROOT_PASSWORD` | Mật khẩu root MySQL | _(phải đổi)_ |
| `MYSQL_DATABASE` | Tên database | `wordpress` |
| `MYSQL_USER` | User MySQL cho WordPress | `wp_user` |
| `MYSQL_PASSWORD` | Mật khẩu MySQL | _(phải đổi)_ |
| `WORDPRESS_TABLE_PREFIX` | Tiền tố bảng DB | `wc_` |
| `WORDPRESS_SITE_URL` | URL website | `http://localhost:8080` |
| `WP_ADMIN_USER` | Tên đăng nhập admin | `admin` |
| `WP_ADMIN_PASSWORD` | Mật khẩu admin | _(phải đổi)_ |
| `WP_ADMIN_EMAIL` | Email admin | _(phải đổi)_ |
| `WP_SITE_TITLE` | Tiêu đề website | `Shop Bán Hàng` |
| `WP_PORT` | Port website | `8080` |
| `PMA_PORT` | Port phpMyAdmin | `8081` |

### Đổi port nếu bị xung đột

Chỉnh trong `.env`:

```env
WP_PORT=3000
PMA_PORT=3001
```

Sau đó cập nhật URL WordPress:

```bash
source .env
docker exec ecommerce_wp bash -c "
  wp option update siteurl '${WORDPRESS_SITE_URL}' --allow-root
  wp option update home '${WORDPRESS_SITE_URL}' --allow-root
"
```

---

## Backup & Restore

### Backup

```bash
source .env

# Backup database
docker exec ecommerce_db \
  mysqldump -u ${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} \
  > backup_$(date +%Y%m%d_%H%M).sql

# Backup wp-content (plugin, theme, uploads)
tar -czf wp-content_$(date +%Y%m%d_%H%M).tar.gz ./wp-content
```

### Restore

```bash
source .env

# Restore database
docker exec -i ecommerce_db \
  mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} \
  < backup_20240101_1200.sql

# Restore wp-content
tar -xzf wp-content_20240101_1200.tar.gz
```

---

## Xử lý sự cố thường gặp

### Container không khởi động được

```bash
# Xem log lỗi
docker compose logs db
docker compose logs wordpress

# Khởi động lại toàn bộ
docker compose down && docker compose up -d
```

### Lỗi "Error establishing a database connection"

Database chưa sẵn sàng khi WordPress khởi động. Đợi thêm 10-15 giây rồi thử lại:

```bash
docker compose restart wordpress
```

### Lỗi biến môi trường không nhận

```bash
# Kiểm tra .env đã tồn tại chưa
ls -la .env

# Kiểm tra giá trị biến có đúng không
docker compose config
```

### Trang trắng / lỗi 500

```bash
# Bật debug mode
docker exec ecommerce_wp wp config set WP_DEBUG true --raw --allow-root
docker exec ecommerce_wp wp config set WP_DEBUG_LOG true --raw --allow-root

# Xem log lỗi
docker exec ecommerce_wp tail -f /var/www/html/wp-content/debug.log
```

### Không truy cập được phpMyAdmin (port 8081)

```bash
# Kiểm tra container phpmyadmin có chạy không
docker ps | grep pma

# Khởi động lại
docker compose restart phpmyadmin
```

### Reset mật khẩu admin

```bash
docker exec ecommerce_wp wp user update admin \
  --user_pass='MatKhauMoi@123' --allow-root
```

### Xoá toàn bộ và cài lại từ đầu

```bash
# Dừng và xoá container + volume
docker compose down -v

# Xoá wp-content đã mount
rm -rf ./wp-content/plugins/* ./wp-content/themes/* ./wp-content/uploads/*

# Khởi động lại
docker compose up -d
```

---

## Cài đặt trên server thật (Production)

### Yêu cầu server

- Ubuntu 22.04 LTS trở lên
- RAM: tối thiểu 2GB (khuyến nghị 4GB)
- Disk: tối thiểu 20GB
- Đã mở port 80 và 443

### Checklist trước khi deploy

- [ ] Đổi tất cả mật khẩu trong `.env` (không dùng giá trị mặc định)
- [ ] Đặt `WORDPRESS_SITE_URL=https://yourdomain.com` trong `.env`
- [ ] Cài SSL với Certbot
- [ ] Cấu hình Nginx reverse proxy
- [ ] Tắt hoặc giới hạn IP truy cập phpMyAdmin
- [ ] Bật backup tự động qua UpdraftPlus

### Nginx reverse proxy

```nginx
# /etc/nginx/sites-available/shop.example.com
server {
    listen 80;
    server_name shop.example.com;

    location / {
        proxy_pass http://localhost:8080;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/shop.example.com /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

### Cài SSL tự động

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d shop.example.com
```

---

## Tài liệu liên quan

- [README.md](./README.md) — Tổng quan dự án
- [project-guild-promt/01-khoi-tao-project.md](./project-guild-promt/01-khoi-tao-project.md) — Cài đặt thủ công (không Docker)
- [project-guild-promt/02-setup-shop.md](./project-guild-promt/02-setup-shop.md) — Cấu hình shop
- [project-guild-promt/03-giao-dien.md](./project-guild-promt/03-giao-dien.md) — Thiết kế giao diện
- [project-guild-promt/04-san-pham.md](./project-guild-promt/04-san-pham.md) — Thêm sản phẩm
- [project-guild-promt/05-van-hanh.md](./project-guild-promt/05-van-hanh.md) — Vận hành thực tế
