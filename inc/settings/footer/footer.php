<?php
/*
 * Footer Settings
 */

add_action( 'admin_menu', 'tm_footer_admin_menu' );
add_action( 'admin_init', 'tm_footer_contact_admin_init' );
add_action( 'admin_init', 'tm_footer_blog_admin_init' );
add_action( 'admin_init', 'tm_footer_newsletter_admin_init' );

function tm_footer_admin_menu() {

    add_menu_page(
        esc_html__( 'Footer' ),
        esc_html__( 'Footer' ),
        'manage_options',
        'footer-settings-page',
        'tm_footer_settings',
        'dashicons-welcome-widgets-menus',
        4
    );

}

function tm_footer_settings() {
    ?>
        <h1><?php esc_html_e( 'Footer' ); ?></h1>
        <hr>
        <div id="footer-settings">
            <form action="options.php" method="post">
                <?php
                    submit_button();
                    do_settings_sections( 'footer-settings-page' );
                    settings_fields( 'footer-settings' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

function tm_footer_contact_admin_init() {
    require_once( __DIR__ . '/footer-contact.php' );
}

function tm_footer_blog_admin_init() {
    require_once( __DIR__ . '/footer-blog.php' );
}

function tm_footer_newsletter_admin_init() {
    require_once( __DIR__ . '/footer-newsletter.php' );
}