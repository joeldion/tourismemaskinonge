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

// Location Address
add_settings_field(
    'contact_info_address',
    '<span class="dashicons dashicons-location"></span>&nbsp;' . esc_html__( 'Address', TM_DOMAIN ),
    'contact_info_address_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_address' );

// Phone
add_settings_field(
    'contact_info_phone',
    '<span class="dashicons dashicons-smartphone"></span>&nbsp;' . esc_html__( 'Phone', TM_DOMAIN ),
    'contact_info_phone_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_phone' );

// Email
add_settings_field(
    'contact_info_email',
    '<span class="dashicons dashicons-email"></span>&nbsp;' . esc_html__( 'Email' ),
    'contact_info_email_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_email' );

// Facebook
add_settings_field(
    'contact_info_facebook',
    '<span class="dashicons dashicons-facebook-alt"></span>&nbsp;Facebook',
    'contact_info_facebook_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_facebook' );

// Instagram
add_settings_field(
    'contact_info_instagram',
    '<span class="dashicons dashicons-instagram"></span>&nbsp;Instagram',
    'contact_info_instagram_markup',
    'contact-info-settings-page',
    'contact-info-settings-section'
);
register_setting( 'contact-info-settings', 'contact_info_instagram' );

function contact_info_settings_section_callback() {}

function contact_info_address_markup() {

    ?>
       <input type="text" size="80" maxlength="150" name="contact_info_address" value="<?php esc_html_e( get_option( 'contact_info_address' ) ); ?>">
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