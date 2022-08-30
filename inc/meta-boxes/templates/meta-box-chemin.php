<?php 

/*
 * Chemin du Roy Meta Boxes
 */

add_action( 'add_meta_boxes_page', 'tm_chemin_meta_box' );
add_action( 'save_post', 'tm_chemin_meta_box_save' );

function tm_chemin_meta_box() {

    global $post;
    if ( 'page-chemin.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {

        add_meta_box(
            'chemin_contact',
            esc_html__( 'Contact info', TM_DOMAIN ),
            'tm_chemin_meta_box_callback',
            'page',
            'normal',
            'high'
        );

    }

}

function tm_chemin_meta_box_callback() {

    wp_nonce_field( 'chemin_contact', 'chemin_contact_nonce' );
    global $post;
    $phone = esc_attr( get_post_meta( $post->ID, '_tm_chemin_phone', true ) );
    $email = esc_attr( get_post_meta( $post->ID, '_tm_chemin_email', true ) );
    $website = esc_url( get_post_meta( $post->ID, '_tm_chemin_website', true ) );
    $facebook = esc_url( get_post_meta( $post->ID, '_tm_chemin_facebook', true ) );
    $instagram = esc_url( get_post_meta( $post->ID, '_tm_chemin_instagram', true ) );
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th>
                    <label for="chemin-phone">
                        <span class="option-title"><?php esc_html_e( 'Phone', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" id="chemin-phone" name="chemin-phone" value="<?php echo $phone; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="chemin-email">
                        <span class="option-title"><?php esc_html_e( 'Email' ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="email" id="chemin-email" name="chemin-email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="chemin-website">
                        <span class="option-title"><?php esc_html_e( 'Website' ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="url" id="chemin-website" name="chemin-website" value="<?php echo $website; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="chemin-facebook">
                        <span class="option-title">Facebook</span>
                    </label>
                </th>
                <td>
                    <input type="url" id="chemin-facebook" name="chemin-facebook" value="<?php echo $facebook; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="chemin-instagram">
                        <span class="option-title">Instagram</span>
                    </label>
                </th>
                <td>
                    <input type="url" id="chemin-instagram" name="chemin-instagram" value="<?php echo $instagram; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

function tm_chemin_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'chemin_contact_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'chemin_contact_nonce' ];
    if (! wp_verify_nonce( $nonce, 'chemin_contact' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_phone = sanitize_text_field( $_POST['chemin-phone'] );
    $data_email = sanitize_email( $_POST['chemin-email'] );
    $data_website = esc_url_raw( $_POST['chemin-website'] );
    $data_facebook = esc_url_raw( $_POST['chemin-facebook'] );
    $data_instagram = esc_url_raw( $_POST['chemin-instagram'] );
    
    update_post_meta( $post_id, '_tm_chemin_phone', $data_phone );
    update_post_meta( $post_id, '_tm_chemin_email', $data_email );
    update_post_meta( $post_id, '_tm_chemin_website', $data_website );
    update_post_meta( $post_id, '_tm_chemin_facebook', $data_facebook );
    update_post_meta( $post_id, '_tm_chemin_instagram', $data_instagram );

}