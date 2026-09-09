<?php

// 1. Cho phép Form đánh giá nhận file upload
add_action( 'comment_form_top', 'ms_wc_review_support_upload' );
function ms_wc_review_support_upload() {
    if ( is_product() ) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var form = document.getElementById("commentform");
                if (form) { form.setAttribute("enctype", "multipart/form-data"); }
            });
        </script>';
    }
}

// 2. Thêm trường chọn ảnh vào Form
add_action( 'comment_form_logged_in_after', 'ms_add_review_image_field' );
add_action( 'comment_form_after_fields', 'ms_add_review_image_field' );
function ms_add_review_image_field() {
    if ( is_product() ) {
        echo '<p class="comment-form-image" style="margin: 15px 0;">
                <label for="review_image" style="display:block; font-weight:600;">Đính kèm hình ảnh sản phẩm (PNG, JPG, JPEG):</label>
                <input type="file" name="review_image" id="review_image" accept="image/png, image/jpeg, image/jpg" />
              </p>';
    }
}

// 3. Xử lý lưu ảnh an toàn
add_action( 'comment_post', 'ms_save_review_image_meta', 10, 3 );
function ms_save_review_image_meta( $comment_id, $comment_approved, $commentdata ) {
    if ( isset( $_FILES['review_image'] ) && ! empty( $_FILES['review_image']['name'] ) ) {
        $allowed_types = array( 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png' );
        $file_info = wp_check_filetype( basename( $_FILES['review_image']['name'] ), $allowed_types );

        if ( in_array( $file_info['type'], $allowed_types ) ) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

            $attachment_id = media_handle_upload( 'review_image', 0 );

            if ( ! is_wp_error( $attachment_id ) ) {
                add_comment_meta( $comment_id, 'review_image_id', intval( $attachment_id ) );
            }
        }
    }
}

// 4. Hiển thị ảnh ra ngoài đánh giá
add_action( 'woocommerce_review_after_comment_text', 'ms_display_review_image', 10, 1 );
function ms_display_review_image( $comment ) {
    $image_id = get_comment_meta( $comment->comment_ID, 'review_image_id', true );
    if ( $image_id ) {
        $image_url = wp_get_attachment_image_url( intval( $image_id ), 'medium' );
        if ( $image_url ) {
            echo '<div class="review-attached-image" style="margin-top: 10px;">';
            echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( 'Ảnh đánh giá sản phẩm' ) . '" style="max-width: 150px; border-radius: 6px; border: 1px solid #ddd; padding: 3px;" />';
            echo '</div>';
        }
    }
}