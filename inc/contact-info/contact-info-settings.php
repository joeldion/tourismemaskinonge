<?php

/*
 * Contact Info Settings Section
 */


// Section title
add_settings_section(
    'contact-info-settings-section',
    esc_html__( 'Contact Info', TM_DOMAIN ),
    'contact_info_settings_section_callback',
    'contact-info-settings-page'
);

// Subtitles
for ($i = 1; $i <= 3; $i++) {
    add_settings_field(
        'contact_info_subtitle_' . $i,
        esc_html__( 'Subtitle', TM_DOMAIN ) . ' ' . $i,
        'contact_info_subtitle_markup',
        'contact-info-settings-page',
        'contact-info-settings-section',
        [ 'index' => $i ]
    );
    register_setting( 'contact-info-settings', 'contact_info_subtitle_' . $i );
}

// Location name
add_settings_field(
    'contact_info_location_name',
    esc_html__( 'Location name', TM_DOMAIN ),
    'contact_info_location_name_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_location_name' );

// Location Address
add_settings_field(
    'contact_info_location_address',
    esc_html__( 'Address' ),
    'contact_info_location_address_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_location_address' );

// Phone
add_settings_field(
    'contact_info_phone',
    esc_html__( 'Phone' ),
    'contact_info_phone_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_phone' );

// Email
add_settings_field(
    'contact_info_email',
    esc_html__( 'Email' ),
    'contact_info_email_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_email' );

// Facebook
add_settings_field(
    'contact_info_facebook',
    'Facebook',
    'contact_info_facebook_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_facebook' );

// Instagram
add_settings_field(
    'contact_info_instagram',
    'Instagram',
    'contact_info_instagram_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_instagram' );

function contact_info_settings_section_callback() {}

function contact_info_location_name_markup() {

    ?>
       <input type="text" size="60" maxlength="40" name="contact_info_location_name" value="<?php esc_html_e( get_option( 'contact_info_location_name' ) ); ?>">
    <?php

}

function contact_info_subtitle_markup( $args ) {

    ?>
       <input type="text" size="60" maxlength="40" name="contact_info_subtitle_<?php echo $args['index']; ?>" value="<?php esc_html_e( get_option( 'contact_info_subtitle_' . $args['index'] ) ); ?>">
    <?php

}

function contact_info_location_address_markup() {

    ?>
       <input type="text" size="80" maxlength="150" name="contact_info_location_address" value="<?php esc_html_e( get_option( 'contact_info_location_address' ) ); ?>">
    <?php

}

function contact_info_phone_markup() {

    ?>
       <input type="tel" size="30" maxlength="40" name="contact_info_phone" value="<?php esc_html_e( get_option( 'contact_info_phone' ) ); ?>">
    <?php

}

function contact_info_email_markup() {

    ?>
       <input type="email" size="40" maxlength="80" name="contact_info_email" value="<?php esc_html_e( get_option( 'contact_info_email' ) ); ?>">
    <?php

}

function contact_info_facebook_markup() {

    ?>
       <input type="url" size="80" maxlength="200" name="contact_info_facebook" value="<?php echo esc_url( get_option( 'contact_info_facebook' ) ); ?>">
    <?php

}

function contact_info_instagram_markup() {

    ?>
       <input type="url" size="80" maxlength="200" name="contact_info_instagram" value="<?php echo esc_url( get_option( 'contact_info_instagram' ) ); ?>">
    <?php

}