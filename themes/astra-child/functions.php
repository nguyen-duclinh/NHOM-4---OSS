<?php
/**
 * Astra Child Theme - functions.php
 * Đề tài: Nhóm 4 - Cửa hàng trực tuyến Laptop TopGear (E-commerce)
 * 
 * Tệp cấu hình các hàm tùy biến mã nguồn mở và lập trình an toàn căn bản.
 * Áp dụng đầy đủ các kỹ thuật:
 * 1. Data Sanitization / Validation (Lọc & kiểm tra dữ liệu đầu vào)
 * 2. Data Escaping (Xử lý dữ liệu đầu ra chống XSS)
 * 3. System Hardening (Gia cố bảo mật qua hook và filter WordPress)
 * 
 * @package Astra_Child_Nhom4
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Chống truy cập trực tiếp file
}

/* ==========================================================================
   1. ENQUEUE SCRIPTS & STYLES (Kế thừa CSS từ theme cha Astra)
   ========================================================================== */

function nhom4_enqueue_child_theme_styles() {
    // Nạp style của theme mẹ (Astra)
    wp_enqueue_style(
        'astra-parent-theme-css',
        get_template_directory_uri() . '/style.css',
        array(),
        defined( 'ASTRA_THEME_VERSION' ) ? ASTRA_THEME_VERSION : '1.0.0'
    );

    // Nạp style của theme con (Astra Child)
    wp_enqueue_style(
        'nhom4-child-theme-css',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-parent-theme-css' ),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'nhom4_enqueue_child_theme_styles', 15 );


/* ==========================================================================
   2. TÙY BIẾN MÃ NGUỒN: CUSTOM SHORTCODE [nhom4_store_notice]
   Áp dụng kỹ thuật Lập trình an toàn căn bản:
   - Sanitization/Validation: sanitize_text_field(), esc_url_raw(), in_array()
   - Escaping: esc_html(), esc_attr(), esc_url()
   ========================================================================== */

/**
 * Shortcode hiển thị banner thông báo khuyến mãi / chính sách cửa hàng
 * Cách dùng: [nhom4_store_notice text="Giảm giá 10% cho Laptop Gaming" badge="HOT DEAL" link="https://nhom4ecom.gt.tc/cua-hang" type="warning"]
 * 
 * @param array $atts Các thuộc tính truyền vào shortcode
 * @return string Đoạn mã HTML hiển thị an toàn
 */
function nhom4_store_notice_shortcode( $atts ) {
    // 1. Thiết lập giá trị mặc định và trích xuất tham số
    $raw_atts = shortcode_atts(
        array(
            'badge' => 'KHUYẾN MÃI',
            'text'  => 'Chào mừng quý khách đến với TopGear Laptop Shop! Miễn phí vận chuyển toàn quốc cho đơn hàng từ 10.000.000đ.',
            'link'  => '',
            'type'  => 'info', // Hỗ trợ: info, success, warning
        ),
        $atts,
        'nhom4_store_notice'
    );

    // 2. KỸ THUẬT AN TOÀN 1: DATA SANITIZATION & VALIDATION (LỌC DỮ LIỆU ĐẦU VÀO)
    // Loại bỏ các ký tự nguy hiểm, mã độc HTML/Script từ input
    $clean_badge = sanitize_text_field( $raw_atts['badge'] );
    $clean_text  = sanitize_text_field( $raw_atts['text'] );
    
    // Kiểm tra & làm sạch URL an toàn
    $clean_link = ! empty( $raw_atts['link'] ) ? esc_url_raw( trim( $raw_atts['link'] ) ) : '';

    // Whitelist Validation: Chỉ chấp nhận các loại type hợp lệ trong danh sách cho phép
    $allowed_types = array( 'info', 'success', 'warning' );
    $clean_type = in_array( strtolower( $raw_atts['type'] ), $allowed_types, true ) ? strtolower( $raw_atts['type'] ) : 'info';

    // 3. KỸ THUẬT AN TOÀN 2: DATA ESCAPING (XỬ LÝ DỮ LIỆU ĐẦU RA CHỐNG XSS)
    // esc_attr(): Dùng cho các giá trị thuộc tính HTML (class, id, title)
    // esc_html(): Dùng cho phần text hiển thị ra trình duyệt
    // esc_url(): Dùng cho đường dẫn href
    ob_start();
    ?>
    <div class="nhom4-store-notice-banner type-<?php echo esc_attr( $clean_type ); ?>" role="alert">
        <?php if ( ! empty( $clean_badge ) ) : ?>
            <span class="nhom4-store-notice-badge"><?php echo esc_html( $clean_badge ); ?></span>
        <?php endif; ?>

        <span class="nhom4-store-notice-content"><?php echo esc_html( $clean_text ); ?></span>

        <?php if ( ! empty( $clean_link ) ) : ?>
            <a href="<?php echo esc_url( $clean_link ); ?>" class="nhom4-store-notice-link">
                <?php echo esc_html__( 'Xem chi tiết &rarr;', 'astra-child' ); ?>
            </a>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'nhom4_store_notice', 'nhom4_store_notice_shortcode' );


/* ==========================================================================
   3. TÙY BIẾN TÍNH NĂNG: NÚT CUỘN LÊN ĐẦU TRANG (BACK TO TOP)
   Tự động chèn nút Back To Top mượt mà vào chân trang mà không cần cài thêm plugin nặng
   ========================================================================== */

function nhom4_render_back_to_top_button() {
    ?>
    <button id="nhom4-back-to-top" title="<?php echo esc_attr__( 'Cuộn lên đầu trang', 'astra-child' ); ?>" aria-label="<?php echo esc_attr__( 'Cuộn lên đầu trang', 'astra-child' ); ?>">
        &#8679;
    </button>
    <script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('nhom4-back-to-top');
            if (!btn) return;
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    btn.style.display = 'flex';
                } else {
                    btn.style.display = 'none';
                }
            });
            btn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'nhom4_render_back_to_top_button' );


/* ==========================================================================
   4. GIA CỐ HỆ THỐNG (SYSTEM HARDENING) QUA MÃ NGUỒN functions.php
   - Ẩn thông tin nhạy cảm (Version WordPress)
   - Tắt tính năng pingback XML-RPC phòng chống tấn công khuếch đại DDoS
   - Tùy biến bảo mật trang đăng nhập
   ========================================================================== */

/**
 * 4.1. Ẩn số phiên bản WordPress khỏi thẻ <head>, RSS feed và mã nguồn
 * Giảm thiểu rủi ro bị hacker rà quét phiên bản có lỗ hổng CVE đã biết.
 */
function nhom4_hide_wordpress_version() {
    return '';
}
add_filter( 'the_generator', 'nhom4_hide_wordpress_version' );
remove_action( 'wp_head', 'wp_generator' );

/**
 * 4.2. Vô hiệu hóa pingback XML-RPC để chống khai thác DDoS Pingback Reflection
 */
function nhom4_disable_xmlrpc_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
add_filter( 'wp_headers', 'nhom4_disable_xmlrpc_pingback' );

add_filter( 'xmlrpc_methods', function( $methods ) {
    unset( $methods['pingback.ping'] );
    unset( $methods['pingback.extensions.getPingbacks'] );
    return $methods;
});

/**
 * 4.3. Đổi liên kết trang đăng nhập: Trỏ về trang chủ website TopGear
 * Tránh để lộ liên kết mặc định ra WordPress.org
 */
function nhom4_custom_login_header_url() {
    return esc_url( home_url( '/' ) );
}
add_filter( 'login_headerurl', 'nhom4_custom_login_header_url' );

function nhom4_custom_login_header_text() {
    return esc_html( get_bloginfo( 'name' ) . ' - Laptop E-commerce Store' );
}
add_filter( 'login_headertext', 'nhom4_custom_login_header_text' );

/**
 * 4.4. Thay đổi thông điệp báo lỗi khi đăng nhập sai
 * Tránh tiết lộ cho kẻ tấn công biết username có tồn tại hay không (chống Username Enumeration)
 */
function nhom4_obscure_login_errors() {
    return esc_html__( 'Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại tài khoản hoặc mật khẩu.', 'astra-child' );
}
add_filter( 'login_errors', 'nhom4_obscure_login_errors' );
