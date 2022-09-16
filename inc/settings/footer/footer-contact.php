<?php

/*
 * Footer Settings Section: Contact
 */

add_settings_section(
    'footer-contact-settings-section',
    esc_html__( 'Contact Info', TM_DOMAIN ),
    'footer_contact_settings_section_callback',
    'footer-settings-page'
);

// Title
add_settings_field(
    'footer_contact_title',
    esc_html__( 'Title' ),
    'footer_contact_title_markup',
    'footer-settings-page',
    'footer-contact-settings-section'
);
register_setting( 'footer-settings', 'footer_contact_title' );

// Subtitles (3)
for ($i = 1; $i <= 3; $i++) {
    add_settings_field(
        'footer_contact_subtitle_' . $i,
        esc_html__( 'Subtitle', TM_DOMAIN ) . ' ' . $i,
        'footer_contact_subtitle_markup',
        'footer-settings-page',
        'footer-contact-settings-section',
        [ 'index' => $i ]
    );
    register_setting( 'footer-settings', 'footer_contact_subtitle_' . $i );
}

// Location name
add_settings_field(
    'footer_contact_location_name',
    esc_html__( 'Location name', TM_DOMAIN ),
    'footer_contact_location_name_markup',
    'footer-settings-page',
    'footer-contact-settings-section'
);
register_setting( 'footer-settings', 'footer_contact_location_name' );

function footer_contact_settings_section_callback() {}

function footer_contact_title_markup() {

    ?>
       <input type="text" size="60" maxlength="40" name="footer_contact_title" value="<?php esc_html_e( get_option( 'footer_contact_title' ) ); ?>">
    <?php

}

function footer_contact_subtitle_markup( $args ) {

    ?>
       <input type="text" size="60" maxlength="40" name="footer_contact_subtitle_<?php echo $args['index']; ?>" value="<?php esc_html_e( get_option( 'footer_contact_subtitle_' . $args['index'] ) ); ?>">
    <?php

}

function footer_contact_location_name_markup() {

    ?>
       <input type="text" size="60" maxlength="40" name="footer_contact_location_name" value="<?php esc_html_e( get_option( 'footer_contact_location_name' ) ); ?>">
    <?php

}


