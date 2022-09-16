<?php

/*
 * Footer Settings: Newsletter
 */

add_settings_section(
    'footer-newsletter-settings-section',
    esc_html__( 'Newsletter', TM_DOMAIN ),
    'footer_newsletter_settings_section_callback',
    'footer-settings-page'
);

// Title
add_settings_field(
    'footer_newsletter_title',
    esc_html__( 'Title' ),
    'footer_newsletter_title_markup',
    'footer-settings-page',
    'footer-newsletter-settings-section'
);
register_setting( 'footer-settings', 'footer_newsletter_title' );

// Description
add_settings_field(
    'footer_newsletter_desc',
    esc_html__( 'Description' ),
    'footer_newsletter_desc_markup',
    'footer-settings-page',
    'footer-newsletter-settings-section'
);
register_setting( 'footer-settings', 'footer_newsletter_desc' );

function footer_newsletter_settings_section_callback() {}

function footer_newsletter_title_markup() {

    ?>
        <input type="text" size="60" maxlength="40" name="footer_newsletter_title" value="<?php esc_html_e( get_option( 'footer_newsletter_title' ) ); ?>">
    <?php

}

function footer_newsletter_desc_markup() {

    ?>
        <textarea name="footer_newsletter_desc" cols="80" rows="5"><?php esc_html_e( get_option( 'footer_newsletter_desc' ) ); ?></textarea>
    <?php

}

