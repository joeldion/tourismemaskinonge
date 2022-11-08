<?php

/*
 * Teasers
 */

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


function home_teasers_settings_section_callback() {}

function home_teasers_markup( $args ) {

    $i = $args[ 'index' ];
    $teaser_id = get_option( 'home_teaser_' . $i );
    $teaser_image = wp_get_attachment_image_url( $teaser_id, 'thumb' );
    $teaser_title = esc_html( get_option( 'home_teaser_title_' . $i ) );
    $teaser_link = esc_url( get_option( 'home_teaser_link_' . $i ) );
    $teaser_data = esc_html( get_option( 'home_teaser_data_' . $i ) );
    ?>  
        <?php get_image_media_uploader( $teaser_id, 'home-teaser-' . $i ); ?>  
        <p><?php esc_html_e( 'Title' ); ?></p> 
        <input type="text" id="home-teaser-title-<?php echo $i; ?>" name="home_teaser_title_<?php echo $i; ?>" size="60" maxlength="10"><br><br>
        <p><?php esc_html_e( 'Link' ); ?></p> 
        <input type="url" id="home-teaser-link-<?php echo $i; ?>" name="home_teaser_link_<?php echo $i; ?>" size="60">
        <input type="hidden" id="home-teaser-data" name="home_teaser_data" value="<?php echo $teaser_data; ?>">
    <?php
}