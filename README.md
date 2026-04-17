# 🛒 E-Commerce — WordPress + WooCommerce

Website bán hàng trực tuyến xây dựng trên nền tảng WordPress và WooCommerce, chạy hoàn toàn bằng Docker.

---

## Tổng quan

| Thông tin | Chi tiết |
|---|---|
| **Nền tảng** | WordPress 6.9.4 |
| **Plugin bán hàng** | WooCommerce 10.7.0 |
| **Theme** | Astra 4.13.0 |
| **PHP** | 8.3.30 |
| **Database** | MySQL 8.0 |
| **Tiền tệ** | VND (₫) |
| **Ngôn ngữ** | Tiếng Việt |

---

## Truy cập

| URL | Mô tả |
|---|---|
| `http://localhost:8080` | Website frontend |
| `http://localhost:8080/wp-admin` | Trang quản trị WordPress |
| `http://localhost:8080/shop` | Trang danh sách sản phẩm |
| `http://localhost:8081` | phpMyAdmin — quản lý database |

### Tài khoản mặc định

| Tài khoản | Thông tin |
|---|---|
| **Admin WordPress** | `admin` / `Admin@12345` |
| **Database user** | `wp_user` / `wp_pass123` |
| **MySQL root** | `root` / `rootpass123` |
| **phpMyAdmin** | `wp_user` / `wp_pass123` |

> ⚠️ Đổi mật khẩu trước khi deploy lên production.

---

## Cấu trúc dự án

```
e-commerce/
├── docker-compose.yml        # Định nghĩa các service Docker
├── .env                      # Biến môi trường (không commit lên git)
├── README.md                 # File này
├── INSTALLATION.md           # Hướng dẫn cài đặt chi tiết
├── wp-content/               # Thư mục nội dung WordPress (mount vào container)
│   ├── plugins/              # Plugin đã cài đặt
│   ├── themes/               # Theme đã cài đặt
│   └── uploads/              # Ảnh và media upload
└── project-guild/            # Tài liệu hướng dẫn cho dev
    ├── README.md
    ├── 01-khoi-tao-project.md
    ├── 02-setup-shop.md
    ├── 03-giao-dien.md
    ├── 04-san-pham.md
    └── 05-van-hanh.md
```

---

## Các service Docker

| Service | Image | Port | Mô tả |
|---|---|---|---|
| `wordpress` | `wordpress:latest` | `8080` | Web server + PHP |
| `db` | `mysql:8.0` | _(nội bộ)_ | Database MySQL |
| `phpmyadmin` | `phpmyadmin:latest` | `8081` | Giao diện quản lý DB |

---

## Plugin đã cài đặt

| Plugin | Version | Mục đích |
|---|---|---|
| WooCommerce | 10.7.0 | Core bán hàng |
| Yoast SEO | 27.4 | Tối ưu SEO |
| LiteSpeed Cache | 7.8.1 | Tăng tốc website |
| UpdraftPlus | 1.26.2 | Backup tự động |
| WPS Hide Login | 1.9.18 | Bảo mật trang đăng nhập |

---

## Cấu hình WooCommerce

| Cài đặt | Giá trị |
|---|---|
| Tiền tệ | Vietnamese Dong (VND) |
| Hiển thị giá | `199.000₫` |
| Vị trí ký hiệu | Bên phải |
| Phương thức thanh toán | COD (Thanh toán khi nhận hàng) |
| Vận chuyển | Shipping zone Việt Nam |

---

## Lệnh thường dùng

```bash
# Khởi động
docker compose up -d

# Dừng
docker compose down

# Khởi động lại
docker compose restart

# Xem log realtime
docker compose logs -f wordpress

# Truy cập shell container WordPress
docker exec -it ecommerce_wp bash

# Chạy WP-CLI
docker exec ecommerce_wp wp [lệnh] --allow-root

# Backup database
docker exec ecommerce_db mysqldump -u wp_user -pwp_pass123 wordpress > backup.sql

# Restore database
docker exec -i ecommerce_db mysql -u wp_user -pwp_pass123 wordpress < backup.sql
```

---

## Tài liệu tham khảo

- [Hướng dẫn cài đặt](./INSTALLATION.md)
- [Hướng dẫn vận hành](./project-guild/05-van-hanh.md)
- [Hướng dẫn thêm sản phẩm](./project-guild/04-san-pham.md)
- [WordPress Documentation](https://wordpress.org/documentation/)
- [WooCommerce Documentation](https://woocommerce.com/documentation/)
