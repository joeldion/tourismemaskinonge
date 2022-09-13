<?php

/*
** Locations: Details
*/

add_action( 'add_meta_boxes', 'tm_location_details_meta_box' );
add_action( 'save_post', 'tm_location_details_meta_box_save' );

function tm_location_details_meta_box() {

    add_meta_box(
        'location_details',
        'Information',
        'tm_location_details_callback',
        'tm_event_location',
        'normal',
        'high'
    );

}

function tm_location_details_callback() {

    wp_nonce_field( 'location_details', 'location_details_nonce' );

    global $post;
    $address = esc_html( get_post_meta( $post->ID, '_tm_event_location_address', true ) );
    $city = esc_attr( get_post_meta( $post->ID, '_tm_event_location_city', true ) );
    $postal_code = esc_html( get_post_meta( $post->ID, '_tm_event_location_pc', true ) );
    $gmap = esc_url( get_post_meta( $post->ID, '_tm_event_location_gmap', true ) ); 
    $args = [
        'post_type'     =>  'tm_event',
        'post_status'   =>  'publish',
        'order'         =>  'asc',
        'orderby'       =>  'meta_value',
        'meta_key'      =>  '_tm_event_start_date',
        'meta_query'    =>  [
                                [
                                    'key'   =>  '_tm_event_location_id',
                                    'value' =>  $post->ID
                                ],
                                [
                                    'key'   =>  '_tm_event_end_date',
                                    'value' =>  current_time( 'mysql' ),
                                    'compare'   =>  '>',
                                    'type'      =>  'DATETIME'
                                ],
                            ]
    ];
    $events = new WP_Query( $args );
    ?>
    <table class="form-table">
        <tbody>

            <tr valign="top">
                <th>
                    <label for="loc-address">
                        <span class="option-title"><?php esc_html_e( 'Address', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" id="loc-address" name="loc-address" value="<?php echo $address; ?>" style="min-width: 250px;">
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="loc-city">
                        <span class="option-title"><?php esc_html_e( 'City', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <select id="loc-city" name="loc-city">
                        <?php foreach( TM_MUNI as $muni ): ?>
                            <option value="<?php esc_attr_e( $muni ); ?>" <?php selected( $muni, $city ); ?>>
                                <?php esc_html_e( $muni ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="loc-pc">
                        <span class="option-title"><?php esc_html_e( 'Postal Code', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" id="loc-pc" name="loc-pc" value="<?php echo $postal_code; ?>" style="min-width: 250px;">
                </td>
            </tr>

            <tr valign="top">
                <th>
                    <label for="loc-gmap">
                        <span class="option-title"><?php esc_html_e( 'Google Maps URL', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" id="loc-gmap" name="loc-gmap" value="<?php echo $gmap; ?>" style="min-width: 500px;">
                </td>
            </tr>
            <?php
                if ( $address !== '' && $city !== '' && $postal_code !== '' ) {

                    $google_query  = str_replace( ' ', '+', $address );
                    $google_query .= '+' . $city;
                    $google_query .= '+' . str_replace( ' ', '+', $postal_code );
                    ?>
                    <tr valign="top">
                        <td>
                            <span class="dashicons dashicons-location"></span>
                            <a href="//google.com/maps/place/<?php echo $google_query; ?>" target="_blank">
                                <?php esc_html_e( 'Locate', TM_DOMAIN ); ?>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
            <tr valign="top">
                <th>
                    <label for="loc-events">
                        <span class="option-title"><?php esc_html_e( 'Upcoming Events', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <?php 
                        if ( $events->have_posts() ) {    

                            while ( $events->have_posts() ): $events->the_post();                          
                                $id = get_the_ID();
                                $start_date = strtotime( get_post_meta( $id, '_tm_event_start_date', true ) );
                                $start_time = esc_html( get_post_meta( $id, '_tm_event_start_time', true ) );
                                $output  = '<p>';
                                $output .= '<a href="' . get_edit_post_link() . '">'. get_the_title() .'</a>';
                                $output .= ' - ' . date_i18n( 'l j F Y', $start_date );
                                if ( !empty( $start_time ) ) $output .= ', ' . $start_time;
                                $output .= '</p>';                                                 
                            endwhile;

                        } else {
                            $output = '<p>' . esc_html__( 'None' ) . '</p>';
                        }                        
                        echo $output;
                    ?>                        
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

function tm_location_details_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'location_details_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'location_details_nonce' ];
    if (! wp_verify_nonce( $nonce, 'location_details' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_address = sanitize_text_field( $_POST[ 'loc-address' ] );
    $data_city = sanitize_text_field( $_POST[ 'loc-city' ] );
    $data_postal_code = sanitize_text_field( $_POST[ 'loc-pc' ] );
    $data_gmap = sanitize_text_field( $_POST[ 'loc-gmap' ] );

    update_post_meta( $post_id, '_tm_event_location_address', $data_address );
    update_post_meta( $post_id, '_tm_event_location_city', $data_city );
    update_post_meta( $post_id, '_tm_event_location_pc', $data_postal_code );
    update_post_meta( $post_id, '_tm_event_location_gmap', $data_gmap );

}