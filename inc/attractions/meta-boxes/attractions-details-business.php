<?php

/*
 *  Meta Box: Attraction Details
*/

add_action( 'add_meta_boxes', 'tm_attract_details_business_meta_box' );
add_action( 'save_post', 'tm_attract_details_business_meta_box_save' );

function tm_attract_details_business_meta_box() {

    add_meta_box(
        'tm_attract_details_business',
        esc_html__( 'Business', TM_DOMAIN ),
        'tm_attract_details_business_callback',
        'attraction',
        'normal',
        'high'
    );

}

function tm_attract_details_business_callback() {

    wp_nonce_field( 'tm_attract_details_business', 'tm_attract_details_business_nonce' );

    global $post;
    $is_business = esc_attr( get_post_meta( $post->ID, '_tm_attract_business', true ) );
    $is_featured = esc_attr( get_post_meta( $post->ID, '_tm_attract_business_featured', true ) );
    $business_text = esc_html( get_post_meta( $post->ID, '_tm_attract_business_text', true ) );
    $business_link = esc_url( get_post_meta( $post->ID, '_tm_attract_business_link', true ) );
    $business_img_id = intval( get_post_meta( $post->ID, '_tm_attract_business_image', true ) );
    if ( $business_img_id > 0 ) $has_business_img = true;
    $image_preview = $has_business_img ? wp_get_attachment_image_url( $business_img_id, 'tm-thumb' ) : '';
    ?>

    <table class="form-table tm-meta-box">
        <tbody>
            <tr valign="top">
                <th>
                    <label for="tm-attract-business">
                        <span class="option-title">Inclure dans le tourisme d'affaires</span>                        
                    </label>
                </th>            
                <td>
                   <input type="checkbox" id="tm-attract-business" name="tm-attract-business" value="1" <?php checked( $is_business, '1', true ); ?>>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-business-featured">
                        <span class="option-title"><?php esc_html_e( 'Featured', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="checkbox" id="tm-attract-business-featured" name="tm-attract-business-featured" value="1" <?php checked( $is_featured, '1', true ); ?>>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-business">
                        <span class="option-title">Courte description</span>                        
                    </label>
                </th>            
                <td>
                   <textarea id="tm-attract-business-text" name="tm-attract-business-text" cols="80" rows="5"><?php echo $business_text; ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-business-link">
                        <span class="option-title"><?php esc_html_e( 'Link' ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="tm-attract-business-link" name="tm-attract-business-link" value="<?php echo $business_link; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-business-image">
                        <span class="option-title">Image</span>                        
                    </label>
                </th>            
                <td>
                    <a href="#" class="tm-media-upload" data-target="tm-attract-business-image"><?php esc_html_e( 'Upload'); ?>
                        <div class="tm-media-upload__preview <?php echo $has_business_img ? 'visible' : ''; ?>" id="tm-attract-business-image-preview" style="background-image: url(<?php echo $image_preview ; ?>);"></div>
                    </a>
                    <a href="#" class="tm-media-remove <?php echo $has_business_img ? 'visible' : ''; ?>" id="tm-attract-business-image-remove"><?php esc_html_e( 'Remove' ); ?></a>
                    <input type="hidden" name="tm-attract-business-image" id="tm-attract-business-image" value="<?php echo $has_business_img ? $business_img_id : ''; ?>">
                </td>
            </tr>
        </tbody>
    </table>

    <?php

}

function tm_attract_details_business_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'tm_attract_details_business_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'tm_attract_details_business_nonce' ];
    if (! wp_verify_nonce( $nonce, 'tm_attract_details_business' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_is_business = sanitize_text_field( $_POST[ 'tm-attract-business' ] );
    $data_is_featured = sanitize_text_field( $_POST[ 'tm-attract-business-featured' ] );
    $data_text = sanitize_text_field( $_POST[ 'tm-attract-business-text' ] );
    $data_link = sanitize_text_field( $_POST[ 'tm-attract-business-link' ] );
    $data_image = sanitize_text_field( $_POST[ 'tm-attract-business-image' ] );

    update_post_meta( $post_id, '_tm_attract_business', $data_is_business );
    update_post_meta( $post_id, '_tm_attract_business_featured', $data_is_featured );
    update_post_meta( $post_id, '_tm_attract_business_text', $data_text );
    update_post_meta( $post_id, '_tm_attract_business_link', $data_link );
    update_post_meta( $post_id, '_tm_attract_business_image', $data_image );
   
}