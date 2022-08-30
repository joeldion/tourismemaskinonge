<?php

/*
 * Home Intro Settings Section
 */

add_settings_section(
    'home-settings-intro-section',
    esc_html__( 'Intro Text', TM_DOMAIN ),
    'home_intro_settings_section_callback',
    'home-settings-page'
);

add_settings_field(
    'home_intro_title',
    esc_html__( 'Title' ),
    'home_intro_title_markup',
    'home-settings-page',
    'home-settings-intro-section'
);
add_settings_field(
    'home_intro_subtitle',
    esc_html__( 'Subtitle', TM_DOMAIN ),
    'home_intro_subtitle_markup',
    'home-settings-page',
    'home-settings-intro-section'
);
add_settings_field(
    'home_intro_text',
    esc_html__( 'Text' ),
    'home_intro_text_markup',
    'home-settings-page',
    'home-settings-intro-section'
);
add_settings_field(
    'home_intro_btn_text',
    esc_html__( 'Button Text', TM_DOMAIN ),
    'home_intro_btn_text_markup',
    'home-settings-page',
    'home-settings-intro-section'
);
add_settings_field(
    'home_intro_btn_link',
    esc_html__( 'Button Link', TM_DOMAIN ),
    'home_intro_btn_link_markup',
    'home-settings-page',
    'home-settings-intro-section'
);

register_setting( 'home-settings', 'home_intro_title' );
register_setting( 'home-settings', 'home_intro_subtitle' );
register_setting( 'home-settings', 'home_intro_text' );
register_setting( 'home-settings', 'home_intro_btn_text' );
register_setting( 'home-settings', 'home_intro_btn_link' );

function home_intro_settings_section_callback() {}

function home_intro_title_markup() {

   ?>
       <input type="text" size="60" maxlength="40" name="home_intro_title" value="<?php esc_html_e( get_option( 'home_intro_title' ) ); ?>">
   <?php

}

function home_intro_subtitle_markup() {

    ?>
        <input type="text" size="60" maxlength="40" name="home_intro_subtitle" value="<?php esc_html_e( get_option( 'home_intro_subtitle' ) ); ?>">
    <?php
 
 }

function home_intro_text_markup() {

       wp_editor(
           get_option( 'home_intro_text' ),
           'home_intro_text',
           [
               'media_buttons' => false,
               'drag_drop_upload' => false,
               'textarea_rows' => 10
           ]
       );

}

function home_intro_btn_text_markup() {

   ?>
       <input type="text" size="60" maxlength="30" name="home_intro_btn_text" value="<?php esc_html_e( get_option( 'home_intro_btn_text' ) ); ?>">
   <?php

}

function home_intro_btn_link_markup() {

   ?>
       <input type="text" size="60" name="home_intro_btn_link" value="<?php esc_html_e( get_option( 'home_intro_btn_link' ) ); ?>">
   <?php

}
