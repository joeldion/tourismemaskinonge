<?php

/*
** Events: Details
*/

add_action( 'add_meta_boxes', 'tm_event_details_meta_box' );
add_action( 'save_post', 'tm_event_details_meta_box_save' );

function tm_event_details_meta_box() {

    add_meta_box(
        'event_details',
        'Information',
        'tm_event_details_callback',
        'tm_event',
        'normal',
        'high'
    );

}

function tm_event_details_callback() {

    wp_nonce_field( 'event_details', 'event_details_nonce' );

    global $post;
    $id = $post->ID;
    $start_date = esc_html( get_post_meta( $id, '_tm_event_start_date', true ) );
    $end_date = esc_html( get_post_meta( $id, '_tm_event_end_date', true ) );
    $start_time = esc_html( get_post_meta( $id, '_tm_event_start_time', true ) );
    $end_time = esc_html( get_post_meta( $id, '_tm_event_end_time', true ) );
    $location_id = intval( get_post_meta( $id, '_tm_event_location_id', true ) );
    $phone = esc_html( get_post_meta( $id, '_tm_event_phone', true ) );
    $email = esc_html( get_post_meta( $id, '_tm_event_email', true ) );
    $website = esc_html( get_post_meta( $id, '_tm_event_website', true ) );
    $facebook = esc_html( get_post_meta( $id, '_tm_event_facebook', true ) );
    $instagram = esc_html( get_post_meta( $id, '_tm_event_instagram', true ) );

    $location_list = new WP_Query([
        'post_type'         =>  'tm_event_location',
        'post_status'       =>  'publish',
        'orderby'           =>  'title',
        'order'             =>  'ASC',
        'posts_per_page'    =>  -1
    ]);
    wp_reset_postdata();
    ?>

    <table class="form-table">
        <tbody>

            <tr valign="top">
                <th>
                    <label for="event-start-date">
                        <span class="option-title"><?php esc_html_e( 'Start Date', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="date" id="event-start-date" name="event-start-date" value="<?php echo $start_date; ?>" >
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="event-end-date">
                        <span class="option-title"><?php esc_html_e( 'End Date', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="date" id="event-end-date" name="event-end-date" value="<?php echo $end_date; ?>" >
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label>
                        <span class="option-title"><?php echo esc_html_x( 'Time', 'Event time', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <label><?php esc_html_e( 'From:', TM_DOMAIN ); ?>&nbsp;</label>
                    <input type="time" id="event-start-time" name="event-start-time" value="<?php echo $start_time; ?>" >
                    <label><?php esc_html_e( 'To:', TM_DOMAIN ); ?>&nbsp;</label>
                    <input type="time" id="event-end-time" name="event-end-time" value="<?php echo $end_time; ?>" >
                </td>
            </tr>
    
            <tr valign="top">
                <th>
                    <label for="event-location">
                        <span class="option-title"><?php echo esc_html_x( 'Location', 'Location name', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <select id="event-location" name="event-location">                        
                        <option value="0" <?php selected( 1, $location_id, true ); ?>><?php esc_html_e( 'None' ); ?></option>
                        <?php for ( $i = 0; $i < count( $location_list->posts ); $i++ ): $loc = $location_list->posts; ?>
                                <option value="<?php echo $loc[$i]->ID; ?>" <?php selected( $loc[$i]->ID, $location_id, true ); ?>>
                                    <?php echo $loc[$i]->post_title; ?>
                                </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
       
            <tr valign="top">
                <th>
                    <label for="event-phone">
                        <span class="option-title"><?php esc_html_e( 'Phone', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="tel" id="event-phone" name="event-phone" value="<?php echo $phone; ?>">               
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="event-email">
                        <span class="option-title"><?php esc_html_e( 'Email' ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="tel" id="event-email" name="event-email" value="<?php echo $email; ?>">               
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="event-website">
                        <span class="option-title"><?php esc_html_e( 'Website' ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="tel" id="event-website" name="event-website" value="<?php echo $website; ?>">               
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="event-facebook">
                        <span class="option-title"><?php esc_html_e( 'Facebook', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="tel" id="event-facebook" name="event-facebook" value="<?php echo $facebook; ?>">               
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="event-instagram">
                        <span class="option-title"><?php esc_html_e( 'Instagram', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="tel" id="event-instagram" name="event-instagram" value="<?php echo $instagram; ?>">               
                </td>
            </tr>

        </tbody>
    </table>
    <?php

}

function tm_event_details_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'event_details_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'event_details_nonce' ];
    if (! wp_verify_nonce( $nonce, 'event_details' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_start_date = sanitize_text_field( $_POST[ 'event-start-date' ] );
    $data_end_date = sanitize_text_field( $_POST[ 'event-end-date' ] );
    if ( $data_end_date === '' ) $data_end_date = $data_start_date; // End date is start date if empty
    $data_start_time = sanitize_text_field( $_POST[ 'event-start-time' ] );
    $data_end_time = sanitize_text_field( $_POST[ 'event-end-time' ] );
    $data_phone = sanitize_text_field( $_POST[ 'event-phone' ] );
    $data_email = sanitize_text_field( $_POST[ 'event-email' ] );
    $data_website = sanitize_text_field( $_POST[ 'event-website' ] );
    $data_facebook = sanitize_text_field( $_POST[ 'event-facebook' ] );
    $data_instagram = sanitize_text_field( $_POST[ 'event-instagram' ] );
    $data_location_id = intval( $_POST[ 'event-location' ] );
    $has_location = $data_location_id > 0 ? true : false; // Location id 0 = no location
    if ( $has_location ) { // No city if no location
        $data_city = esc_html( get_post_meta( $data_location_id, '_tm_event_location_city', true ) );
    }

    update_post_meta( $post_id, '_tm_event_start_date', $data_start_date );
    update_post_meta( $post_id, '_tm_event_end_date', $data_end_date );
    update_post_meta( $post_id, '_tm_event_start_time', $data_start_time );
    update_post_meta( $post_id, '_tm_event_end_time', $data_end_time );
    update_post_meta( $post_id, '_tm_event_phone', $data_phone );
    update_post_meta( $post_id, '_tm_event_email', $data_email );
    update_post_meta( $post_id, '_tm_event_website', $data_website );
    update_post_meta( $post_id, '_tm_event_facebook', $data_facebook );
    update_post_meta( $post_id, '_tm_event_instagram', $data_instagram );

    if ( $has_location ) {
        // Update meta data if event has location
        update_post_meta( $post_id, '_tm_event_location_id', $data_location_id );
        update_post_meta( $post_id, '_tm_event_city', $data_city );
    } else {
        // Delete meta data if event doesn't have any location
        delete_post_meta( $post_id, '_tm_event_location_id' );
        delete_post_meta( $post_id, '_tm_event_city' );
    }

}