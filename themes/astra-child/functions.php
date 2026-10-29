<?php
/**
 * Astra Child Theme Functions and Definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// --- 1. TẠO NÚT LÊN ĐẦU VÀ NÚT CHAT ZALO -------------------
function topgear_nut_lien_he_footer() {
    // Escaping link Zalo để chống lỗi XSS theo yêu cầu
    $link_zalo = esc_url( home_url('/lien-he-zalo-topgear') );
    ?>
    
    <div class="topgear-float-box">
        <a href="#" id="nut-back-top" class="topgear-btn nut-den"><?php echo esc_html('Lên đầu'); ?></a>
        <a href="<?php echo $link_zalo; ?>" target="_blank" class="topgear-btn nut-do"><?php echo esc_html('Chat Zalo'); ?></a>
    </div>

    <style>
        .topgear-float-box {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }
        .topgear-btn {
            display: block;
            padding: 8px 14px;
            margin-top: 8px;
            color: #fff !important;
            text-decoration: none !important;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .nut-den { 
            background: #000; 
            display: none; /* Cuộn xuống mới hiện */
        }
        .nut-do { 
            background: #d32f2f; 
        }
    </style>

    <script>
        // Cuộn chuột quá 150px thì hiện nút Top
        window.onscroll = function() {
            var btn = document.getElementById('nut-back-top');
            if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
                btn.style.display = 'block';
            } else {
                btn.style.display = 'none';
            }
        };

        // Bấm nút thì cuộn lên đầu
        document.getElementById('nut-back-top').onclick = function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
    <?php
}
add_action('wp_footer', 'topgear_nut_lien_he_footer');


// --- 2. SHORTCODE THÔNG BÁO TƯ VẤN (CÓ AN TOÀN DỮ LIỆU) ---
function topgear_tao_shortcode_thongbao($atts) {
    $a = shortcode_atts(array(
        'sdt' => '0900000000',
        'noidung' => 'Liên hệ TopGear để nhận ưu đãi Laptop!',
    ), $atts);

    // Kỹ thuật Sanitization: Lọc dữ liệu đầu vào chống chèn mã độc
    $sdt_sach = sanitize_text_field($a['sdt']);
    $noidung_sach = sanitize_text_field($a['noidung']);

    // Kỹ thuật Escaping: Làm sạch trước khi in ra giao diện HTML
    $sdt_hien_thi = esc_html($sdt_sach);
    $noidung_hien_thi = esc_html($noidung_sach);
    $url_zalo = esc_url( home_url('/lien-he-zalo-topgear') );

    // Ghép HTML
    $out = '<div style="border: 2px dashed #d32f2f; padding: 12px; background: #fff5f5; margin: 10px 0; border-radius: 5px;">';
    $out .= '<b>THÔNG BÁO: ' . $noidung_hien_thi . '</b><br>';
    $out .= 'SĐT: <strong>' . $sdt_hien_thi . '</strong> - <a href="' . $url_zalo . '" target="_blank">Chat Zalo TopGear</a>';
    $out .= '</div>';

    return $out;
}
add_shortcode('topgear_notice', 'topgear_tao_shortcode_thongbao');