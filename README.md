# HƯỚNG DẪN CÀI ĐẶT & TRIỂN KHAI HỆ THỐNG
# WEBSITE CỬA HÀNG TRỰC TUYẾN TOPGEAR (NHÓM 4)

* **Website trực tuyến của nhóm:** [https://nhom4ecom.gt.tc/?i=1](https://nhom4ecom.gt.tc/?i=1)

---

## 1. Yêu cầu môi trường hệ thống

Để website hoạt động ổn định và đầy đủ chức năng, máy chủ cục bộ (Localhost) cần đáp ứng các thông số sau:

* **Phần mềm máy chủ cục bộ:** XAMPP, Laragon, WampServer hoặc Docker (LAMP / LEMP Stack).
* **Phiên bản PHP:** Khuyến nghị **PHP 7.4 đến 8.2** (hỗ trợ đầy đủ các tiện ích mở rộng: `mysqli`, `curl`, `mbstring`, `gd`, `openssl`, `zip`).
* **Hệ quản trị CSDL:** **MySQL 5.7+** hoặc **MariaDB 10.4+**.
* **Web Server:** Apache (đã kích hoạt module `mod_rewrite`) hoặc Nginx.
* **Trình duyệt web:** Google Chrome, Microsoft Edge, Firefox, Safari phiên bản mới.

---

## 2. Các bước cài đặt chi tiết trên Localhost (XAMPP / Laragon)

### Bước 1: Tải mã nguồn vào thư mục Web Root

1. Tải về hoặc giải nén toàn bộ thư mục dự án.
2. Đổi tên thư mục thành `nhom4ecom` và sao chép vào thư mục gốc của Web Server:
   * **Nếu dùng XAMPP:**
     ```
     C:\xampp\htdocs\nhom4ecom
     ```
     *(hoặc `D:\xampp\htdocs\nhom4ecom` tùy vào ổ đĩa cài đặt XAMPP của bạn)*
   * **Nếu dùng Laragon:**
     ```
     C:\laragon\www\nhom4ecom
     ```
3. Mở bảng điều khiển **XAMPP Control Panel** (hoặc Laragon) và bấm **Start** cả 2 dịch vụ: **Apache** và **MySQL**.

---

### Bước 2: Tạo Cơ sở dữ liệu trong phpMyAdmin

1. Mở trình duyệt web, truy cập vào đường dẫn:
   ```
   http://localhost/phpmyadmin
   ```
2. Nhấp vào mục **Databases (Cơ sở dữ liệu)** ở thanh menu phía trên.
3. Tại ô **Create database (Tạo cơ sở dữ liệu)**:
   * Nhập tên CSDL: `nhom4ecom_db`
   * Chọn bảng mã (Collation): `utf8mb4_unicode_ci` (hoặc `utf8mb4_general_ci`)
4. Bấm nút **Create (Tạo)**.

---

### Bước 3: Nhập (Import) tệp database.sql

1. Nhấp chọn cơ sở dữ liệu `nhom4ecom_db` vừa tạo ở danh sách bên trái.
2. Chọn thẻ **Import (Nhập)** trên thanh điều hướng.
3. Tại phần **File to import**, bấm **Choose File (Chọn tệp)** và duyệt tới tệp `database.sql` nằm ở thư mục gốc của dự án:
   ```
   C:\xampp\htdocs\nhom4ecom\database.sql
   ```
4. Giữ nguyên các thiết lập mặc định và cuộn xuống dưới bấm nút **Import (Thực hiện)**.
5. Đợi từ 10 - 30 giây cho đến khi hệ thống báo dòng chữ màu xanh:
   `"Import has been successfully finished..."`

> 💡 **Mẹo:** Nếu gặp thông báo lỗi giới hạn dung lượng tải lên (Upload limit exceeded), xem mục [5. Khắc phục sự cố](#5-khắc-phục-các-sự-cố-thường-gặp-troubleshooting) ở cuối tài liệu.

---

### Bước 4: Cấu hình tệp wp-config.php

> ⚠️ **LƯU Ý ĐẶC BIỆT VỀ TIỀN TỐ BẢNG (TABLE PREFIX):**
> Trong tệp `database.sql`, các bảng dữ liệu được lưu với tiền tố là `SERVMASK_PREFIX_` (ví dụ: `SERVMASK_PREFIX_options`, `SERVMASK_PREFIX_posts`, `SERVMASK_PREFIX_users`).
> Vì vậy, trong tệp `wp-config.php`, bắt buộc phải cấu hình đúng tiền tố `$table_prefix = 'SERVMASK_PREFIX_';`.

#### Hướng dẫn tạo và cấu hình:
1. Mở thư mục dự án `C:\xampp\htdocs\nhom4ecom`.
2. Kiểm tra xem đã có tệp `wp-config.php` chưa:
   * Nếu chưa có, nhân bản tệp `wp-config-sample.php` (hoặc tạo một tệp mới) và đặt tên là `wp-config.php`.
3. Mở tệp `wp-config.php` bằng phần mềm soạn thảo (VS Code, Notepad++, Sublime Text...) và cập nhật nội dung như sau:

```php
<?php
// ** 1. CẤU HÌNH THÔNG SỐ CƠ SỞ DỮ LIỆU MYSQL ** //
define( 'DB_NAME', 'nhom4ecom_db' );   // Tên CSDL đã tạo ở Bước 2
define( 'DB_USER', 'root' );           // Tài khoản MySQL mặc định của XAMPP là 'root'
define( 'DB_PASSWORD', '' );           // Mật khẩu MySQL mặc định của XAMPP để rỗng
define( 'DB_HOST', 'localhost' );      // Địa chỉ máy chủ CSDL
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// ** 2. TIỀN TỐ BẢNG CƠ SỞ DỮ LIỆU (BẮT BUỘC KHỚP VỚI DATABASE IMPORT) ** //
$table_prefix = 'SERVMASK_PREFIX_';

// ** 3. CHẾ ĐỘ DEBUG (Có thể bật false để ẩn cảnh báo) ** //
define( 'WP_DEBUG', false );

// ** 4. CẤU HÌNH TỰ ĐỘNG NHẬN DIỆN ĐƯỜNG DẪN TRÊN LOCALHOST ** //
define( 'WP_HOME', 'http://localhost/nhom4ecom' );
define( 'WP_SITEURL', 'http://localhost/nhom4ecom' );

/* Đó là tất cả thiết lập, ngừng chỉnh sửa ở dưới! Chúc bạn đăng bài vui vẻ. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
```

4. Lưu lại tệp `wp-config.php`.

---

### Bước 5: Cập nhật đường dẫn website (Site URL & Home URL)

Tệp dữ liệu gốc ban đầu sử dụng tên miền `https://nhom4ecom.gt.tc`. Khi chuyển về chạy dưới máy cục bộ, cần chuyển URL về `http://localhost/nhom4ecom`.

#### Thực hiện câu lệnh SQL trong phpMyAdmin:
1. Trong `phpMyAdmin`, nhấp chọn database `nhom4ecom_db`.
2. Bấm vào tab **SQL** ở thanh trên cùng.
3. Dán đoạn mã sau vào khung nhập lệnh:
   ```sql
   UPDATE `SERVMASK_PREFIX_options` 
   SET `option_value` = 'http://localhost/nhom4ecom' 
   WHERE `option_name` IN ('siteurl', 'home');
   ```
4. Bấm nút **Go (Thực hiện)**. Kết quả hiển thị `2 rows affected` là thành công.

---

### Bước 6: Cấu hình tệp .htaccess (Chống lỗi 404 đường dẫn tĩnh)

Để các trang sản phẩm, giỏ hàng, thanh toán và bài viết không bị lỗi `404 Not Found`, hãy đảm bảo trong thư mục gốc `C:\xampp\htdocs\nhom4ecom` có tệp `.htaccess` với nội dung chuẩn của WordPress:

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /nhom4ecom/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /nhom4ecom/index.php [L]
</IfModule>
# END WordPress
```

*(Lưu ý: Nếu tên thư mục của bạn không phải là `nhom4ecom`, hãy đổi `/nhom4ecom/` thành tên thư mục tương ứng).*

---

### Bước 7: Kích hoạt Astra Child Theme

1. Mở trình duyệt và truy cập trang quản trị WordPress:
   ```
   http://localhost/nhom4ecom/wp-admin
   ```
2. Đăng nhập bằng tài khoản Quản trị viên (xem thông tin ở [Mục 3](#3-thông-tin-tài-khoản-quản-trị-demo-accounts)).
3. Tại menu bên trái, chọn **Giao diện (Appearance)** -> **Giao diện (Themes)**.
4. Tìm theme con có tên **Astra Child - Nhom 4 TopGear** và bấm **Kích hoạt (Activate)**.
5. Truy cập lại trang chủ `http://localhost/nhom4ecom` để chiêm ngưỡng giao diện hoàn chỉnh cùng thanh thông báo khuyến mãi và nút cuộn lên đầu trang (Back-to-top).

---

## 3. Thông tin tài khoản quản trị (Demo Accounts)

Hệ thống có sẵn tài khoản Administrator để chấm bài và kiểm thử:

* **Đường dẫn đăng nhập:** `http://localhost/nhom4ecom/wp-admin`
* **Tên đăng nhập (Username):** `nhom4ecom`
* **Email:** `iconic3028@gmail.com`

#### Hướng dẫn đặt lại (Reset) mật khẩu quản trị nếu quên:
Nếu không đăng nhập được mật khẩu cũ, bạn chỉ cần vào **phpMyAdmin** -> chọn database `nhom4ecom_db` -> chọn thẻ **SQL** và chạy lệnh:
```sql
UPDATE `SERVMASK_PREFIX_users` 
SET `user_pass` = MD5('Admin@123456') 
WHERE `user_login` = 'nhom4ecom';
```
Sau khi thực thi câu lệnh trên, bạn có thể đăng nhập ngay với:
* **Username:** `nhom4ecom`
* **Mật khẩu mới:** `Admin@123456`

---

## 4. Kiểm thử các chức năng E-commerce sau cài đặt

Sau khi hoàn tất 7 bước trên,có thể kiểm thử toàn bộ quy trình mua sắm:

1. **Xem danh sách sản phẩm:**
   * Truy cập trang Cửa hàng (`/shop` hoặc `/cua-hang`).
   * Xem chi tiết các mẫu laptop thực tế: *Laptop Lenava XZ-9180QW*, *Laptop ASAS Gaming A15 (RTX 5050 / Ryzen 7)*, *Laptop Neonspace Gaming A17*, *Laptop Sell 16*...
2. **Chọn biến thể sản phẩm (Swatches):**
   * Vào xem chi tiết một sản phẩm, bấm chọn các biến thể Màu sắc, RAM (16GB / 32GB), Ổ cứng SSD (512GB / 1TB).
3. **Quy trình Giỏ hàng & Thanh toán (Checkout):**
   * Bấm **Thêm vào giỏ hàng (Add to Cart)** -> Chuyển đến trang **Thanh toán (Checkout)**.
   * Điền thông tin giao hàng giả định.
4. **Kiểm tra Cổng thanh toán giả lập / Sandbox (VietQR):**
   * Tại trang thanh toán, chọn phương thức **Chuyển khoản ngân hàng qua mã VietQR**.
   * Bấm **Đặt hàng (Place Order)**.
   * Hệ thống tự động tạo mã QR động chứa sẵn: Số tài khoản, Ngân hàng thụ hưởng, Số tiền chính xác và Mã đơn hàng `#ID`.
5. **Kiểm tra tính năng Đánh giá sản phẩm đính kèm hình ảnh (CusRev):**
   * Kéo xuống tab **Đánh giá (Reviews)** dưới chân trang chi tiết sản phẩm.
   * Thử để lại đánh giá số sao (1-5 sao) và đính kèm hình ảnh chụp thực tế từ máy tính.
6. **Kiểm tra tính năng tùy biến của Child Theme:**
   * Nút cuộn lên đầu trang (Back to top) nổi ở góc dưới bên phải khi cuộn trang xuống.
   * Thanh thông báo khuyến mãi an toàn hoạt động qua shortcode `[nhom4_store_notice]`.

---

## 5. Khắc phục các sự cố thường gặp (Troubleshooting)

### 1. Lỗi "Error establishing a database connection"
* **Nguyên nhân:** Tên database, tài khoản hoặc mật khẩu trong `wp-config.php` chưa khớp với MySQL.
* **Cách xử lý:** 
  - Mở lại file `wp-config.php`.
  - Đảm bảo `DB_NAME` đúng là `nhom4ecom_db`.
  - Đối với XAMPP, `DB_USER` là `'root'` và `DB_PASSWORD` là `''` (để rỗng).
  - Đảm bảo dịch vụ MySQL trong XAMPP Control Panel đang ở trạng thái màu xanh (**Running**).

### 2. Lỗi bảng trắng hoặc thông báo "Table not found"
* **Nguyên nhân:** Khai báo sai tiền tố bảng (Table Prefix).
* **Cách xử lý:** Mở `wp-config.php` và kiểm tra dòng 21:
  ```php
  $table_prefix = 'SERVMASK_PREFIX_';
  ```
  Phải đảm bảo giá trị này khớp chính xác với tiền tố các bảng trong phpMyAdmin.

### 3. Lỗi 404 Not Found khi bấm vào sản phẩm hoặc giỏ hàng
* **Nguyên nhân:** Apache chưa bật module `mod_rewrite` hoặc chưa cập nhật đường dẫn tĩnh.
* **Cách xử lý:**
  - Vào trang quản trị WordPress: `Cài đặt (Settings)` -> `Đường dẫn tĩnh (Permalinks)`.
  - Chọn cấu hình **Tiêu đề bài viết (Post name)** và bấm nút **Lưu thay đổi (Save Changes)** để WordPress tự động cập nhật lại file `.htaccess`.

### 4. Lỗi "Upload limit exceeded" khi Import database.sql trong phpMyAdmin
* **Nguyên nhân:** Dung lượng file `database.sql` (~6MB) vượt quá giới hạn mặc định (2MB) của một số phiên bản XAMPP.
* **Cách xử lý:**
  - Mở file `php.ini` (trong XAMPP Control Panel: bấm nút **Config** cạnh Apache -> chọn `PHP (php.ini)`).
  - Tìm và tăng 2 giá trị sau:
    ```ini
    upload_max_filesize = 64M
    post_max_size = 64M
    memory_limit = 256M
    ```
  - Lưu file `php.ini` và **Restart** lại dịch vụ Apache.

---
*Chúc cài đặt và triển khai thành công hệ thống website Nhóm 4!*
