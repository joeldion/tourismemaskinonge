<?php
/*
 * Home Page Settings
 */

add_action( 'admin_menu', 'tm_home_admin_menu' );
add_action( 'admin_init', 'tm_home_settings_slider_init' );
add_action( 'admin_init', 'tm_home_settings_intro_init' );
add_action( 'admin_init', 'tm_home_settings_teasers_init' );

function tm_home_admin_menu() {

    add_menu_page(
        esc_html__( 'Home Page Settings', TM_DOMAIN ),
        esc_html__( 'Home Page', TM_DOMAIN ),
        'manage_options',
        'home-settings-page',
        'tm_home_settings',
        'dashicons-admin-home',
        4
    );

}

function tm_home_settings() {
    ?>
        <h1><?php esc_html_e( 'Home Page', TM_DOMAIN ); ?></h1>
        <hr>
        <div id="home-settings">
            <form action="options.php" method="post">
                <?php
                    submit_button();
                    do_settings_sections( 'home-settings-page' );
                    settings_fields( 'home-settings' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

function tm_home_settings_slider_init() {
    require_once( __DIR__ . '/home-slider.php' );
}

function tm_home_settings_intro_init() {
    require_once( __DIR__ . '/home-intro.php' );
}

function tm_home_settings_teasers_init() {
    require_once( __DIR__ . '/home-teasers.php' );
}