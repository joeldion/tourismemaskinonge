<?php 

/*
 * Get Page Slider
 */

function get_slider( $post_id = '' ) {

    ob_start();

    $slider_img_id = TM_DEFAULT_SLIDE;

    if ( !empty( $post_id ) ) {

        $slider_img_id = intval( get_post_meta( $post_id, '_tm_slider_image', true ) );

        if ( get_post_type( $post_id ) == 'attraction' ) {
            $primary_cat_id = intval( get_post_meta( $post_id, '_primary_term_attraction_category', true ) );
            $primary_cat_img_id = intval( get_term_meta( $primary_cat_id, '_cat_image_url', true ) );
            if ( empty( $slider_img_id ) ) $slider_img_id = $primary_cat_img_id;
        }

        if ( get_post_type( $post_id ) == 'tm_event' ) {
            $location_id = intval( get_post_meta( $post_id, '_tm_event_location_id', true ) );
            $location_img_id = intval( get_post_meta( $location_id, '_tm_slider_image', true ) );
            if ( empty( $slider_img_id ) && !empty( $location_img_id ) ) {
                $slider_img_id = $location_img_id;
            } else {
                $slider_img_id = TM_DEFAULT_SLIDE;
            }
        }

        if ( is_archive() ) {

            if ( !empty( get_term_meta( $post_id, '_cat_image_url', true ) ) ) {
                $slider_img_id = get_term_meta( $post_id, '_cat_image_url', true );
            }
            
        }

        if ( get_post_type( $post_id ) == 'post' || get_post_type( $post_id ) == 'page' ) {
            if ( empty( $slider_img_id ) ) $slider_img_id = TM_DEFAULT_SLIDE;
        }

    }

    $slider_img_url = wp_get_attachment_image_url( $slider_img_id, 'tm-slide' );
    $slider_img_url_2x = wp_get_attachment_image_url( $slider_img_id, 'tm-slide-2x' );
    $retina = $slider_img_url !== $slider_img_url_2x ? true : false;
    if ( is_mobile() ) $slider_img_url = wp_get_attachment_image_url( $slider_img_id, 'large' );
    ?>    
    <div class="slider">
        <div class="slide<?php echo $retina ? ' has_retina' : ''; ?>" id="slide" 
             data-image-id="<?php echo $slider_img_id; ?>" 
             data-image-2x="<?php echo $slider_img_url_2x; ?>"
             style="background-image: url(<?php echo $slider_img_url; ?>);">
        </div>
    </div>
    <?php
    
    return ob_get_clean();

}