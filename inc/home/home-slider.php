<?php

/*
 * Home Slider Settings Section
 */

/*
add_settings_section(
   'home-slider-section',
   esc_html__( 'Slider', TM_DOMAIN ),
   'home_slider_settings_section_callback',
   'home-settings-page'
);

// Slides Images
for ($i = 1; $i <= TM_SLIDES_COUNT; $i++) {

    add_settings_field(
      'home_slide_' . $i,
      'Image #' . $i,
      'home_slide_markup',
      'home-settings-page',
      'home-slider-section',
      [ 'index' => $i ]
    );

    register_setting( 'home-settings', 'home_slide_' . $i );
    
}
*/

function home_slider_settings_section_callback() {}

function home_slide_markup( $args ) {

    $i = $args[ 'index' ];
    $slide_id = get_option( 'home_slide_' . $i );
    $slide_url = wp_get_attachment_image_url( $slide_id, 'medium' );

    ?>
        <input type="button" data-index="<?php echo $i; ?>" class="slide-upload button button-secondary" value="<?php esc_html_e( 'Choose an image', TM_DOMAIN ); ?>">
        <input type="hidden" id="slide-picture-<?php echo $i; ?>" name="home_slide_<?php echo $i; ?>" value="<?php echo $slide_id; ?>">
        <div id="slide-preview-<?php echo $i; ?>" class="slide-preview" style="background-image: url( <?php echo ( !empty( $slide_url ) ) ? $slide_url : ''; ?> );"></div>
        <span id="delete-slide-<?php echo $i; ?>" class="delete-slide dashicons dashicons-no-alt <?php echo ( !empty( $slide_url ) ) ? 'visible' : ''; ?>" data-index="<?php echo $i; ?>">
        </span>
    <?php

}

function tm_get_home_slider() {

    ob_start();

        ?>
            <div id="slider">
            <?php

                $output;

                for ($i = 1; $i <= TM_SLIDES_COUNT; $i++):

                    $image_id = intval( get_option( 'home_slide_' . $i ) );
                    $slide_count_class = 'slide-' . $i;                    
                    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                    $image_name = basename( get_attached_file( $image_id ) );
                    $image_caption = esc_html( get_option( 'home_slide_caption_' . $i ) );

                    if ( is_mobile() ) {

                        $base_url = get_bloginfo('url') . '/wp-content/uploads/';
                        $image_url_mobile = wp_get_attachment_image_url( $image_id, 'mrc-slide-mobile-2x' );
                        $image_name_mobile = str_replace( $base_url, '', $image_url_mobile );
                        $image_name = $image_name_mobile;

                    }

                    if ( !empty( $image_url ) ) {

                        $bg_image_output = 'data-image="' . $image_name . '"';
                        $classes = 'slide slide-' . $i;
                        // $image_data = $image_2x . $bg_image_output;                        
                        $data_index = 'data-index="' . $i . '"';
                        // $data_caption = 'data-caption="' . $image_caption . '"';
                        $data_caption = strlen( $image_caption ) > 0 ? 'data-caption="' . $image_caption . '"' : '';

                        $slide_output  = '<div class="' . $classes . '" ';
                        // $slide_output .= $image_data . ' ';
                        $slide_output .= $bg_image_output . ' ';
                        $slide_output .= $data_index . ' ';
                        $slide_output .= $data_caption . '></div>';
                        
                    }

                    $output .= $slide_output;

                endfor;

                echo $output;

            ?>
            </div>
        <?php

    return ob_get_clean();

}
