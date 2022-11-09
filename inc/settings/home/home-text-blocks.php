<?php
/*
 * Home text blocks
 */

$sections = [
    [
        'name'  =>  'text_block',
        'label' =>  esc_html__( 'Intro Text', TM_DOMAIN )
    ],
    [
        'name'  =>  'attractions',
        'label' =>  esc_html__( 'Attractions', TM_DOMAIN )
    ],
    [
        'name'  =>  'events',
        'label' =>  esc_html__( 'Events', TM_DOMAIN )
    ],
    [
        'name'  =>  'blog',
        'label' =>  esc_html__( 'Blog' )
    ]
];

foreach ( $sections as $i => $section ):

    $name = $section['name'];
    $label = $section['label'];
    $args = [
        'index' =>  $i,
        'name'  =>  $name
    ];

    add_settings_section(
        'home-settings-' . $name . '-text-block',
        esc_html__( 'Section:', TM_DOMAIN ) . ' ' . $label,
        'home_text_block_settings_section_callback',
        'home-settings-page'
    );
    
    add_settings_field(
        'home_' . $name . '_title',
        esc_html__( 'Title' ),
        'home_text_block_title_markup' ,
        'home-settings-page',
        'home-settings-' . $name . '-text-block',
        $args
    );
    add_settings_field(
        'home_' . $name . '_subtitle',
        esc_html__( 'Subtitle', TM_DOMAIN ),
        'home_text_block_subtitle_markup' ,
        'home-settings-page',
        'home-settings-' . $name . '-text-block',
        $args
    );
    add_settings_field(
        'home_' . $name . '_text',
        esc_html__( 'Text' ),
        'home_text_block_text_markup' ,
        'home-settings-page',
        'home-settings-' . $name . '-text-block',
        $args
    );
    add_settings_field(
        'home_' . $name . '_btn_text',
        esc_html__( 'Button Text', TM_DOMAIN ),
        'home_text_block_btn_text_markup' ,
        'home-settings-page',
        'home-settings-' . $name . '-text-block',
        $args
    );
    add_settings_field(
        'home_' . $name . '_btn_link',
        esc_html__( 'Button Link', TM_DOMAIN ),
        'home_text_block_btn_link_markup' ,
        'home-settings-page',
        'home-settings-' . $name . '-text-block',
        $args
    );
    
    register_setting( 'home-settings', 'home_' . $name . '_text_block_title' );
    register_setting( 'home-settings', 'home_' . $name . '_text_block_subtitle' );
    register_setting( 'home-settings', 'home_' . $name . '_text_block_text' );
    register_setting( 'home-settings', 'home_' . $name . '_text_block_btn_text' );
    register_setting( 'home-settings', 'home_' . $name . '_text_block_btn_link' );
    
endforeach;


function home_text_block_settings_section_callback() {

    echo "<hr>";

}

function home_text_block_title_markup( $args ) {

    ?>
        <input type="text" size="60" maxlength="40" name="home_<?php echo $args['name']; ?>_text_block_title" value="<?php esc_html_e( get_option( 'home_' . $args['name'] . '_text_block_title' ) ); ?>">
    <?php

}

function home_text_block_subtitle_markup( $args ) {

    ?>
        <input type="text" size="60" maxlength="80" name="home_<?php echo $args['name']; ?>_text_block_subtitle" value="<?php esc_html_e( get_option( 'home_' . $args['name'] . '_text_block_subtitle' ) ); ?>">
    <?php

}

function home_text_block_text_markup( $args ) {

    wp_editor(
        get_option( 'home_' . $args['name'] . '_text_block_text' ),
        'home_' . $args['name'] . '_text_block_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 10
        ]
    );

}

function home_text_block_btn_text_markup( $args ) {

    ?>
        <input type="text" size="60" maxlength="30" name="home_<?php echo $args['name']; ?>_text_block_btn_text" value="<?php esc_html_e( get_option( 'home_' . $args['name'] . '_text_block_btn_text' ) ); ?>">
    <?php

}

function home_text_block_btn_link_markup( $args ) {

    ?>
        <input type="text" size="60" name="home_<?php echo $args['name']; ?>_text_block_btn_link" value="<?php esc_html_e( get_option( 'home_' . $args['name'] . '_text_block_btn_link' ) ); ?>">
    <?php

}
