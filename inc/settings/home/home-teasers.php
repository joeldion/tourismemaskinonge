<?php

/*
 * Teasers
 */

/*
add_settings_section(
    'home-settings-teasers-section',
    esc_html__( 'Teasers', TM_DOMAIN ),
    'home_teasers_settings_section_callback',
    'home-settings-page'
);

// Teasers
for ( $i = 1; $i <= 5; $i++ ) {

    add_settings_field(
      'home_teaser_' . $i,
      esc_html__( 'Teaser', TM_DOMAIN ) . ' #' . $i,
      'home_teasers_markup',
      'home-settings-page',
      'home-settings-teasers-section',
      [ 'index' => $i ]
    );

    register_setting( 'home-settings', 'home_teaser_' . $i );
    
}
*/

function home_teasers_settings_section_callback() {}

function home_teasers_markup( $args ) {

    $i = $args[ 'index' ];
    $teaser_id = get_option( 'home_teaser_' . $i );
    $teaser_image = wp_get_attachment_image_url( $teaser_id, 'medium' );
    $teaser_title = esc_html( get_option( 'home_teaser_title_' . $i ) );
    $teaser_link = esc_url( get_option( 'home_teaser_link_' . $i ) );

    ?>
        <input type="button" data-index="<?php echo $i; ?>" class="teaser-upload button button-secondary" value="<?php esc_html_e( 'Choose an image', TM_DOMAIN ); ?>">
        <input type="hidden" id="teaser-picture-<?php echo $i; ?>" name="home_teaser_<?php echo $i; ?>" value="<?php echo $teaser_id; ?>">
        <div id="teaser-preview-<?php echo $i; ?>" class="teaser-preview" style="background-image: url( <?php echo ( !empty( $teaser_image ) ) ? $teaser_image : ''; ?> );"></div>
        <span id="delete-teaser-<?php echo $i; ?>" class="delete-teaser dashicons dashicons-no-alt <?php echo ( !empty( $teaser_image ) ) ? 'visible' : ''; ?>" data-index="<?php echo $i; ?>">
        </span>
    <?php

}