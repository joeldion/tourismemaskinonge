<?php

/*
 * Footer Settings Section : Blog
 */

add_settings_section(
    'footer-blog-settings-section',
    esc_html__( 'Blog', TM_DOMAIN ),
    'footer_blog_settings_section_callback',
    'footer-settings-page'
);

// Title
add_settings_field(
    'footer_blog_title',
    esc_html__( 'Title' ),
    'footer_blog_title_markup',
    'footer-settings-page',
    'footer-blog-settings-section'
);
register_setting( 'footer-settings', 'footer_blog_title' );

function footer_blog_settings_section_callback() {}

function footer_blog_title_markup() {

    ?>
       <input type="text" size="60" maxlength="40" name="footer_blog_title" value="<?php esc_html_e( get_option( 'footer_blog_title' ) ); ?>">
    <?php

}
