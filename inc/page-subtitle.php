<?php 
/*
 * Page Subtitle Meta Box
 */

add_action( 'add_meta_boxes', 'tm_page_subtitle_meta_box' );
add_action( 'save_post', 'tm_page_subtitle_meta_box_save' );

function tm_page_subtitle_meta_box() {

    add_meta_box(
        'tm_page_subtitle',
        esc_html__( 'Subtitle', TM_DOMAIN ),
        'tm_page_subtitle_meta_box_callback',
        'page',
        'normal',
        'high'
    );

}

function tm_page_subtitle_meta_box_callback() {

    wp_nonce_field( 'tm_page_subtitle', 'tm_page_subtitle_nonce' );

    global $post;
    $subtitle = esc_html( get_post_meta( $post->ID, '_tm_page_subtitle', true ) );
    ?>
    <tr class="form-field">
        <td>
            <input type="text" size="100" id="tm-page-subtitle" name="tm-page-subtitle" value="<?php echo $subtitle; ?>">
        </td>
    </tr>
    <?php
}

function tm_page_subtitle_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'tm_page_subtitle_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'tm_page_subtitle_nonce' ];
    if (! wp_verify_nonce( $nonce, 'tm_page_subtitle' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_subtitle = sanitize_text_field( $_POST[ 'tm-page-subtitle' ] );
    update_post_meta( $post_id, '_tm_page_subtitle', $data_subtitle );

}