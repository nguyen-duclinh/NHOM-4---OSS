# BẢNG KIỂM KÊ GIẤY PHÉP MÃ NGUỒN MỞ
## ĐỀ TÀI: WEBSITE CỬA HÀNG TRỰC TUYẾN TOPGEAR (NHÓM 4)

---

> **Mục tiêu:** Thực hiện theo đúng yêu cầu học phần *"Thống kê License: Lập bảng danh sách toàn bộ Theme/Plugin đã cài đặt kèm loại Giấy phép mã nguồn mở của chúng (GPLv2, GPLv3, MIT, Apache...)"*. Đảm bảo tính minh bạch, tuân thủ bản quyền phần mềm và tính pháp lý của hệ thống thương mại điện tử.

---

## 1. Kiểm kê Hệ quản trị nội dung (CMS Core)

| STT | Thành phần | Phiên bản | Nhà phát triển | Giấy phép mã nguồn mở | Liên kết Giấy phép |
| :---: | :--- | :---: | :--- | :--- | :--- |
| 1 | **WordPress Core** | 6.x / 7.x | WordPress Foundation | **GNU General Public License v2 or later** | [GNU GPLv2+](https://www.gnu.org/licenses/gpl-2.0.html) |

---

## 2. Kiểm kê Giao diện (Themes)

| STT | Tên Theme | Phiên bản | Tác giả / Tổ chức | Loại Giấy phép | Vai trò trong hệ thống |
| :---: | :--- | :---: | :--- | :--- | :--- |
| 1 | **Astra** *(Theme mẹ)* | 4.13.11 | Brainstorm Force | **GNU GPL v2 or later** | Theme nền tảng, chuẩn SEO, tối ưu tốc độ tải trang |
| 2 | **Astra Child - Nhom 4 TopGear** | 1.0.0 | Nhóm 4 E-commerce | **GNU GPL v2 or later** | Theme con chứa code tùy biến an toàn và hardening |
| 3 | **Trendy Storefront** | 1.5.6 | Apex Themes | **GNU GPL v2 or later** | Theme thương mại điện tử dự phòng |
| 4 | **Twenty Twenty-Five** | 1.0 | WordPress.org | **GNU GPL v2 or later** | Theme mặc định tiêu chuẩn của WordPress |
| 5 | **Twenty Twenty-Four** | Core | WordPress.org | **GNU GPL v2 or later** | Theme mặc định dự phòng |
| 6 | **Twenty Twenty-Three** | Core | WordPress.org | **GNU GPL v2 or later** | Theme mặc định dự phòng |

---

## 3. Kiểm kê Tiện ích mở rộng (Plugins)

| STT | Tên Plugin | Phiên bản | Tác giả / Tổ chức | Loại Giấy phép | Chức năng chi tiết trong dự án |
| :---: | :--- | :---: | :--- | :--- | :--- |
| 1 | **WooCommerce** | 11.1.0 | Automattic | **GNU GPL v3** | Nền tảng bán hàng cốt lõi (sản phẩm, giỏ hàng, quản lý kho, checkout) |
| 2 | **VietQR** | 3.5.3 | Casso Team | **GNU GPL v3.0** | Cổng thanh toán chuyển khoản tạo mã QR tự động kèm mã đơn hàng |
| 3 | **Customer Reviews for WooCommerce** | 5.120.0 | CusRev | **GNU GPL v3** | Hệ thống xếp hạng, đánh giá sản phẩm có đính kèm hình ảnh thực tế |
| 4 | **Variation Swatches for WooCommerce**| 1.0.14 | CartFlows | **GNU GPL v2** | Hiển thị biến thể màu sắc, RAM, SSD dưới dạng nút swatch trực quan |
| 5 | **CartFlows** | 3.2.0 | Brainstorm Force | **GNU GPL v2 or later** | Tối ưu hóa phễu thanh toán và giao diện đặt hàng |
| 6 | **Elementor Website Builder** | 4.2.4 | Elementor.com | **GNU GPL v3** | Trình thiết kế trang trực quan kéo thả kéo thả Atomic Editor |
| 7 | **Ultimate Addons for Elementor (UAE)**| 2.9.4 | Brainstorm Force | **GNU GPL v2 or later** | Tùy biến Header và Footer chuyên nghiệp cho website |
| 8 | **YITH WooCommerce Compare** | 3.14.0 | YITH | **GNU GPL v2** | Bảng so sánh thông số kỹ thuật giữa các sản phẩm laptop |
| 9 | **Starter Templates (Astra Sites)** | 4.7.6 | Brainstorm Force | **GNU GPL v2 or later** | Thư viện mẫu trang giao diện và demo layout |
| 10 | **W3 Total Cache** | 2.10.6 | BoldGrid | **GNU GPL v2 or later** | Bộ nhớ đệm nâng cao hiệu năng, nén CSS/JS và tối ưu tốc độ tải trang |

---

## 4. Phân tích Pháp lý & Tính tương thích (License Compatibility)

1. **Tính tương thích giấy phép:**
   * 100% Theme và Plugin sử dụng trong dự án đều tuân theo các phiên bản của **Giấy phép Công cộng GNU (GNU GPLv2, GPLv2+, GPLv3)**.
   * Các thành phần mang giấy phép GPLv2-or-later hoàn toàn tương thích và kết hợp hợp pháp với các thành phần mang giấy phép GPLv3 (như WooCommerce Core và VietQR).
2. **Quyền hạn của nhóm phát triển:**
   * Tự do nghiên cứu cấu trúc mã nguồn, tùy biến giao diện và phát triển thêm chức năng trong `functions.php` mà không vi phạm bản quyền thương mại.
   * Không bị phụ thuộc vào một nhà cung cấp độc quyền (No Vendor Lock-in).
3. **Trách nhiệm mã nguồn mở:**
   * Theme con `Astra Child` do Nhóm 4 xây dựng kế thừa từ theme mẹ Astra, được phát hành theo giấy phép **GNU GPL v2 or later**, đảm bảo tính kế thừa bản quyền theo đúng điều khoản Copyleft của GNU.

---
*Bảng kiểm kê được lập bởi Nhóm 4 — Đồ án Website Thương mại điện tử Mã nguồn mở TopGear.*
