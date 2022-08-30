<?php 

/*
 * Slider Meta Box
 */

add_action( 'add_meta_boxes', 'tm_slider_meta_box' );
add_action( 'save_post', 'tm_slider_meta_box_save' );

function tm_slider_meta_box() {

    $post_types = [ 'post', 'page', 'attraction', 'tm_event', 'tm_event_location' ];

    foreach( $post_types as $post_type ) {

        add_meta_box(
            'tm_slider',
            esc_html__( 'Big Image', TM_DOMAIN ),
            'tm_slider_callback',
            $post_type,
            'side',
            'low'
        );

    }

}

function tm_slider_callback() {

    wp_nonce_field( 'tm_slider', 'tm_slider_nonce' );

    global $post;
    $slider_img_id = intval( get_post_meta( $post->ID, '_tm_slider_image', true ) );
    if ( $slider_img_id > 0 ) $has_slider = true;
    $slider_preview = $has_slider ? wp_get_attachment_image_url( $slider_img_id, 'tm-thumb' ) : '';
    ?>
    <table class="form-table tm-meta-box">
        <tbody>
            <tr valign="top">                
                <td>
                    <a href="#" class="tm-media-upload" data-target="tm-slider-image"><?php esc_html_e( 'Upload' ); ?>
                        <div class="tm-media-upload__preview <?php echo $has_slider ? 'visible' : ''; ?>" id="tm-slider-image-preview" style="background-image: url(<?php echo $slider_preview ; ?>);"></div>
                    </a>
                    <a href="#" class="tm-media-remove <?php echo $has_slider ? 'visible' : ''; ?>" id="tm-slider-image-remove"><?php esc_html_e( 'Remove' ); ?></a>
                    <input type="hidden" name="tm-slider-image" id="tm-slider-image" value="<?php echo $has_slider ? $slider_img_id : ''; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

function tm_slider_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'tm_slider_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'tm_slider_nonce' ];
    if (! wp_verify_nonce( $nonce, 'tm_slider' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $slider_id = intval( $_POST[ 'tm-slider-image' ] );
    update_post_meta( $post_id, '_tm_slider_image', $slider_id );

}