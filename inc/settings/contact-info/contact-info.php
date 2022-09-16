<?php
/*
 * Contact Info Settings
 */

add_action( 'admin_menu', 'tm_contact_info_admin_menu' );
add_action( 'admin_init', 'tm_contact_info_admin_init' );

function tm_contact_info_admin_menu() {

    add_menu_page(
        esc_html__( 'Contact Info Settings', TM_DOMAIN ),
        esc_html__( 'Contact Info', TM_DOMAIN ),
        'manage_options',
        'contact-info-settings-page',
        'tm_contact_info_settings',
        'dashicons-info',
        4
    );

}

function tm_contact_info_settings() {
    ?>
        <div id="contact-info-settings">
            <form action="options.php" method="post">
                <?php                   
                    do_settings_sections( 'contact-info-settings-page' );
                    settings_fields( 'contact-info-settings' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

function tm_contact_info_admin_init() {
    require_once( __DIR__ . '/contact-info-fields.php' );
}