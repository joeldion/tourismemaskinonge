<?php 
/*
 * Function: Get Event Contact Info
 */

function get_event_info() {

    ob_start();

    $date_format = function( $date ) {
        $formatted_date = date_i18n( 'l j F Y', strtotime( $date ) );
        $formatted_date = preg_replace( '/\s1\s/', ' 1er ', $formatted_date );
        return ucfirst( mb_strtolower( $formatted_date ) );
    };
    $time_format = function( $time ) {
        return preg_replace( [ '/^0/', '/:/' ], [ '', '&nbsp;h&nbsp;' ], $time );
    };
    $gmap_format = function( $data ) {
        return str_replace( ' ', '+', $data );
    };

    global $post;
    $id = $post->ID;
    $start_date = esc_attr( get_post_meta( $id, '_tm_event_start_date', true ) );
    $end_date = esc_attr( get_post_meta( $id, '_tm_event_end_date', true ) );
    $start_time = esc_attr( get_post_meta( $id, '_tm_event_start_time', true ) );
    $end_time = esc_attr( get_post_meta( $id, '_tm_event_end_time', true ) );
    $show_end_date = ( !empty( $end_date ) && $end_date !== $start_date ) ? true : false;    
    $show_end_time = ( !empty( $end_time ) && $end_time !== $start_time ) ? true : false;
    // $category = esc_html( get_post_meta( $id, '_tm_event_category', true ) );
    $loc_id = intval( get_post_meta( $id, '_tm_event_location_id', true ) );
    $loc_address = esc_html( get_post_meta( $loc_id, '_tm_event_location_address', true ) );
    $loc_city = esc_html( get_post_meta( $loc_id, '_tm_event_location_city', true ) );
    $loc_pc = esc_html( get_post_meta( $loc_id, '_tm_event_location_pc', true ) );
    $loc_gmap = esc_url( get_post_meta( $loc_id, '_tm_event_location_gmap', true ) );
    if ( empty( $loc_gmap ) ) {
        $loc_gmap = '//google.com/maps/place/' . $gmap_format( $loc_address . ' ' . $loc_city . ' ' . $loc_pc );
    } 
    
    ?>
    <ul class="tm-contact">
    <?php
        if ( !empty( $start_date ) ):
            ?>
                <li class="tm-contact__item tm-contact__date tm-contact__date--yellow">
                    <span>                   
                        <?php 
                            echo $date_format( $start_date );
                            if ( $show_end_date ) echo '&nbsp;-&nbsp;' . $date_format( $end_date );                       
                        ?>
                    </span>
                </li>
            <?php
        endif;

        if ( !empty( $start_time ) ):
            ?>
                <li class="tm-contact__item tm-contact__time tm-contact__time--yellow">
                    <span>
                        <?php 
                            echo $time_format( $start_time );
                            if ( $show_end_time ) echo '&nbsp;-&nbsp;' . $time_format( $end_time );                        
                        ?>
                    </span>             
                </li>
            <?php
        endif;

        if ( !empty( $loc_id ) && $loc_id !== 1  ):
            ?>
                <li class="tm-contact__item tm-contact__location tm-contact__location--yellow">
                    <span>
                        <a href="<?php echo $loc_gmap; ?>" class="tm-contact__gmap" target="_blank">
                            <h3 class="tm-contact__location-title"><?php echo get_the_title( $loc_id ); ?></h3>
                            <?php echo $loc_address; ?><br />
                            <?php echo $loc_city . '&nbsp;' . $loc_pc; ?>
                        </a>
                    </span>             
                </li>
            <?php
        endif;

        ?>
    </ul>
    <?php

    return ob_get_clean();
    
}