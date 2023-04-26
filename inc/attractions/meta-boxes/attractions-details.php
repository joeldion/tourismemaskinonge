<?php

/*
 *  Meta Box: Attraction Details
*/

add_action( 'add_meta_boxes', 'tm_attract_details_meta_box' );
add_action( 'save_post', 'tm_attract_details_meta_box_save' );

function tm_attract_details_meta_box() {

    add_meta_box(
        'tm_attract_details',
        esc_html__( 'Information', TM_DOMAIN ),
        'tm_attract_details_callback',
        'attraction',
        'normal',
        'high'
    );

}

function tm_attract_details_callback() {

    wp_nonce_field( 'tm_attract_details', 'tm_attract_details_nonce' );

    global $post;
    $id = $post->ID;
    $address = esc_html( get_post_meta( $id, '_tm_attract_address', true ) );
    $city = esc_html( get_post_meta( $id, '_tm_attract_city', true ) );
    $postal_code = esc_html( get_post_meta( $id, '_tm_attract_postal_code', true ) );
    $gmap_url = esc_html( get_post_meta( $id, '_tm_attract_gmap_url', true ) );
    $full_address = $address . ' ' . $city . ' ' . $postal_code . ' QC Canada';
    $coord = esc_html( get_post_meta( $id, '_tm_attract_coord', true ) );
    $phone_1 = esc_html( get_post_meta( $id, '_tm_attract_phone_1', true ) );
    $phone_2 = esc_html( get_post_meta( $id, '_tm_attract_phone_2', true ) );
    $email = esc_html( get_post_meta( $id, '_tm_attract_email', true ) );
    $website = esc_html( get_post_meta( $id, '_tm_attract_website', true ) );
    $facebook = esc_html( get_post_meta( $id, '_tm_attract_facebook', true ) );
    $instagram = esc_html( get_post_meta( $id, '_tm_attract_instagram', true ) );
    ?>

    <table class="form-table tm-meta-box">
        <tbody>
            <tr valign="top">
                <th>
                    <label for="tm-attract-address">
                        <span class="option-title"><?php esc_html_e( 'Address', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>           
                <td>
                   <input type="text" id="tm-attract-address" name="tm-attract-address" value="<?php echo $address; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-city">
                        <span class="option-title"><?php esc_html_e( 'City', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>           
                <td>
                    <select name="tm-attract-city" id="tm-attract-city">
                    <?php foreach ( TM_MUNI as $muni ): ?>
                        <option value="<?php esc_html_e( $muni ); ?>" <?php selected($city, $muni); ?>>
                            <?php esc_html_e( $muni ); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-postal-code">
                        <span class="option-title"><?php esc_html_e( 'Postal Code', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="text" id="tm-attract-postal-code" name="tm-attract-postal-code" value="<?php echo $postal_code; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-gmap_url">
                        <span class="option-title"><?php esc_html_e( 'Google Map URL', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="tm-attract-gmap-url" name="tm-attract-gmap-url" value="<?php echo $gmap_url; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-phone-1">
                        <span class="option-title"><?php esc_html_e( 'Phone', TM_DOMAIN ); ?> 1</span>                        
                    </label>
                </th>            
                <td>
                   <input type="tel" id="tm-attract-phone-1" name="tm-attract-phone-1" value="<?php echo $phone_1; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-phone-2">
                        <span class="option-title"><?php esc_html_e( 'Phone', TM_DOMAIN ); ?> 2</span>                        
                    </label>
                </th>            
                <td>
                   <input type="tel" id="tm-attract-phone-2" name="tm-attract-phone-2" value="<?php echo $phone_2; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-email">
                        <span class="option-title"><?php esc_html_e( 'Email', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="email" id="tm-attract-email" name="tm-attract-email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-website">
                        <span class="option-title"><?php esc_html_e( 'Website', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="tm-attract-website" name="tm-attract-website" value="<?php echo $website; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-facebook">
                        <span class="option-title"><?php esc_html_e( 'Facebook', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>           
                <td>
                   <input type="url" id="tm-attract-facebook" name="tm-attract-facebook" value="<?php echo $facebook; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="tm-attract-instagram">
                        <span class="option-title"><?php esc_html_e( 'Instagram', TM_DOMAIN ); ?></span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="tm-attract-instagram" name="tm-attract-instagram" value="<?php echo $instagram; ?>">
                </td>
            </tr>                
        </tbody>
    </table>
    <input type="hidden" id="tm-attract-full-address" name="tm-attract-fulladdress" value="<?php echo $full_address; ?>"><br>
    <input type="hidden" id="tm-attract-coord" name="tm-attract-coord" value="<?php echo $coord; ?>">
    <?php

}

function tm_attract_details_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'tm_attract_details_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'tm_attract_details_nonce' ];
    if (! wp_verify_nonce( $nonce, 'tm_attract_details' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_address = sanitize_text_field( $_POST[ 'tm-attract-address' ] );
    $data_city = sanitize_text_field( $_POST[ 'tm-attract-city' ] );
    $data_postal_code = sanitize_text_field( $_POST[ 'tm-attract-postal-code' ] );
    $data_gmap_url = sanitize_text_field( $_POST[ 'tm-attract-gmap-url' ] );
    $data_phone_1 = sanitize_text_field( $_POST[ 'tm-attract-phone-1' ] );
    $data_phone_2 = sanitize_text_field( $_POST[ 'tm-attract-phone-2' ] );
    $data_email = sanitize_email( $_POST[ 'tm-attract-email' ] );
    $data_website = sanitize_text_field( $_POST[ 'tm-attract-website' ] );
    $data_facebook = sanitize_text_field( $_POST[ 'tm-attract-facebook' ] );
    $data_instagram = sanitize_text_field( $_POST[ 'tm-attract-instagram' ] );
    $data_coord = sanitize_text_field( $_POST[ 'tm-attract-coord' ] );

    update_post_meta( $post_id, '_tm_attract_address', $data_address );
    update_post_meta( $post_id, '_tm_attract_city', $data_city );
    update_post_meta( $post_id, '_tm_attract_postal_code', $data_postal_code );
    update_post_meta( $post_id, '_tm_attract_gmap_url', $data_gmap_url );
    update_post_meta( $post_id, '_tm_attract_phone_1', $data_phone_1 );
    update_post_meta( $post_id, '_tm_attract_phone_2', $data_phone_2 );
    update_post_meta( $post_id, '_tm_attract_email', $data_email );
    update_post_meta( $post_id, '_tm_attract_website', $data_website );
    update_post_meta( $post_id, '_tm_attract_facebook', $data_facebook );
    update_post_meta( $post_id, '_tm_attract_instagram', $data_instagram );
    update_post_meta( $post_id, '_tm_attract_coord', $data_coord );

}