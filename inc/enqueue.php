<?php

add_action( 'wp_enqueue_scripts', 'tm_enqueue' );
add_action( 'admin_enqueue_scripts', 'tm_admin_enqueue' );


function tm_enqueue() {

    $version = current_user_can('administrator') ? time() : TM_VERSION;

    /*
     * Enqueue Stylesheets  
    */
    wp_register_style(
        'tm-style',
        TM_URL . '/assets/css/tm-style.css',
        [],
        $version,
        'all'
    );
    wp_enqueue_style('tm-style');

    /*
     * Enqueue Scripts
    */
    wp_register_script(
        'tm-gmap',
        TM_URL . '/assets/js/tm-gmap.js',
        [],
        $version,
        true
    );

    wp_register_script(
        'google-maps',
        'https://maps.googleapis.com/maps/api/js?key=' . TM_GMAP_API . '&v=weekly',
        ['tm-gmap'],
        '1.0',
        true
    );

    wp_register_script(
        'mailchimp-validate',
        'https://s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js',
        ['jquery'],
        '1.9.0',
        true
    );
    
    wp_register_script(
        'tm-script',
        TM_URL . '/assets/js/tm-script.js',
        ['jquery', 'mailchimp-validate'],
        $version,
        true
    );

    wp_register_script(
        'recaptcha',
        'https://www.google.com/recaptcha/api.js',
        [],
        '1.0',
        true
    );

    wp_enqueue_script('mailchimp-validate');
    wp_enqueue_script('tm-script');
    // wp_enqueue_script('recaptcha');

    if ( is_page_template( [ 'page-attractions.php', 'page-nous-joindre.php' ] ) || is_tax( 'attraction_category' ) ) {
        wp_enqueue_script('tm-gmap');
        wp_enqueue_script('google-maps');
    }

    wp_localize_script(
        'tm-gmap',
        'tm_gmap_globals',
        [
            'ajax_url'            =>  admin_url('admin-ajax.php'),
            'nonce'               =>  wp_create_nonce('nonce_tm'),
            'dir_icons'           =>  TM_URL . '/img/icons/',
            'gmap_style'          =>  json_encode( TM_GMAP_STYLE )
        ]
    );

    wp_localize_script(
        'tm-script',
        'tm_globals',
        [
            'base_url'            =>  get_site_url(),
            'ajax_url'            =>  admin_url('admin-ajax.php'),
            'nonce'               =>  wp_create_nonce('nonce_tm'),
            'default_slide'       =>  TM_DEFAULT_SLIDE,
            'attraction_cat_slug' =>  _nx( 'attraction-category', 'attraction-categories', 2, 'Attraction category slug', TM_DOMAIN ),
            'tm_event_cat_slug'   =>  _nx( 'event-category', 'event-categories', 2, 'Event category slug', TM_DOMAIN ),
            'dir_icons'           =>  TM_URL . '/img/icons/',
            'gmap_style'          =>  json_encode( TM_GMAP_STYLE ),
            'recaptcha_key'       =>  TM_CAPTCHA_KEY,
            'choose_an_image'     =>  esc_html__( 'Choose an image', TM_DOMAIN ),
            'choose_this_image'   =>  esc_html__( 'Choose this image', TM_DOMAIN ),
            // 'no_content_found'    =>  esc_html__( "We're sorry. This category is currently empty.", TM_DOMAIN ),
        ]
    );

}

function tm_admin_enqueue() {

    // Admin Styles
    wp_enqueue_style(
        'tm-admin-style',
        TM_URL . '/assets/css/tm-style-admin.css',
        [],
        time()
    );

    // Media Uploader
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_media();

    // Admin Scripts
    wp_enqueue_script(
        'tm-admin',
        TM_URL . '/assets/js/tm-script-admin.js',
        ['jquery'],
        time(),
        true
    );

    // Google Maps
    wp_enqueue_script(
        'google-maps',
        'https://maps.googleapis.com/maps/api/js?key=' . TM_GMAP_API . '&v=weekly',
        [],
        '1.0',
        true
    );

    wp_localize_script(
        'tm-admin',
        'tm_admin_globals',
        [
            'choose_an_image'     =>  esc_html__( 'Choose an image', TM_DOMAIN ),
            'choose_this_image'   =>  esc_html__( 'Choose this image', TM_DOMAIN ),
        ]
    );

}