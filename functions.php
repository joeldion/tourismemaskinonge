<?php 

setlocale(LC_ALL, 'fr_CA');

// Theme Support
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support( 'html5', [ 'search-form' ] );
add_theme_support('menus');
add_theme_support('widgets');

// Nav menus
register_nav_menus([
    'main-menu-small'         => 'Principal (petit)',
    'main-menu-large'         => 'Principal (grand)',
]);

// Theme Text Domain
defined( 'TM_DOMAIN' ) or define( 'TM_DOMAIN', 'tourismemaskinonge' );
// Theme Directory Path
defined( 'TM_DIR' ) or define( 'TM_DIR', get_template_directory() );
// Theme Inc Path
defined( 'TM_INC' ) or define( 'TM_INC', get_template_directory() . '/inc/' );
// Theme Directory URL
defined( 'TM_URL' ) or define( 'TM_URL', get_template_directory_uri() );
// Theme Version
defined( 'TM_VERSION' ) or define( 'TM_VERSION', '1.5.8' );

// Slides number
defined( 'TM_SLIDES_COUNT' ) or define( 'TM_SLIDES_COUNT', 4 );

// Default slide id (will be replaced by admin setting eventually)
// defined( 'TM_DEFAULT_SLIDE' ) or define( 'TM_DEFAULT_SLIDE', 430 );
defined( 'TM_DEFAULT_SLIDE' ) or define( 'TM_DEFAULT_SLIDE', 2475 );

// Municipalités
defined( 'TM_MUNI' ) or define( 'TM_MUNI', 
    [
        'Charette',
        'Louiseville',
        'Maskinongé',
        'Saint-Alexis-des-Monts',
        'Saint-Barnabé',
        'Saint-Boniface',
        'Sainte-Angèle-de-Prémont',
        'Saint-Édouard-de-Maskinongé',
        'Saint-Élie-de-Caxton',
        'Saint-Étienne-des-Grès',
        'Sainte-Ursule',
        'Saint-Justin',
        'Saint-Léon-le-Grand',
        'Saint-Mathieu-du-Parc',
        'Saint-Paulin',
        'Saint-Sévère',
        'Yamachiche',
        'MRC de Maskinongé'
    ]
);

// Google reCAPTCHA Key
defined( 'TM_CAPTCHA_KEY' ) or define( 'TM_CAPTCHA_KEY', '6LcUUeUgAAAAAC3cOK5kyOgX5C1RdtYl3raRPtkI' );

// Google Maps API Key
defined( 'TM_GMAP_API' ) or define( 'TM_GMAP_API', 'AIzaSyDstOhGvliYV88yU24zUUNxDDA0sKzV6ng' );

// Google Maps Style
$color_white = "#ffffff";
$color_gray_l = "#f7f7f7";
$color_gray_d = "#9a9a9a";
$gmap_style = [
    [
        "featureType" => "landscape.natural",
        "elementType" => "geometry",
        "stylers" => [
            [
                "color" => $color_gray_l
            ],
        ],
    ],
    [
        "featureType" => "road",
        "elementType" => "geometry",
        "stylers" => [
            [
                "color" => $color_white
            ],
        ],
    ],
    [
        "featureType" => "poi",
        "elementType" => "all",
        "stylers" => [
            [
                "visibility" => "off"
            ],
        ],
    ],
    [
        "featureType" => "transit",
        "elementType" => "all",
        "stylers" => [
            [
                "visibility" => "off"
            ],
        ],
    ],
    [
        "featureType" => "administrative",
        "elementType" => "all",
        "stylers" => [
            [
                "visibility" => "off"
            ],
        ],
    ],
    [
        "featureType" => "administrative.locality",
        "elementType" => "labels",
        "stylers" => [
            [
                "visibility" => "on"
            ],
        ],
    ],
    [
        "featureType" => "administrative.locality",
        "elementType" => "labels.text.fill",
        "stylers" => [
            [
                "color" => $color_gray_d
            ],
        ],
    ],
    [
        "featureType" => "administrative.locality",
        "elementType" => "labels.text.stroke",
        "stylers" => [
            [
                "color" => $color_gray_l
            ],
        ],
    ],
    [
        "featureType" => "water",
        "elementType" => "geometry",
        "stylers" => [
            [
                "color" => $color_gray_l
            ],
        ],
    ],
    [
        "featureType" => "water",
        "elementType" => "labels.text.fill",
        "stylers" => [
            [
                "color" => $color_gray_d
            ],
        ],
    ],
    [
        "featureType" => "water",
        "elementType" => "labels.text.stroke",
        "stylers" => [
            [
                "color" => $color_gray_l
            ],
        ],
    ],
];
defined( 'TM_GMAP_STYLE' ) or define( 'TM_GMAP_STYLE', $gmap_style );

/* Includes Level 1 */
require_once( TM_INC . 'bem-menu.php');
require_once( TM_INC . 'card-slider.php');
require_once( TM_INC . 'detect-mobile.php');
require_once( TM_INC . 'detect-ie.php');
require_once( TM_INC . 'enqueue.php');
require_once( TM_INC . 'format-phone.php');
require_once( TM_INC . 'get-single-contact-info.php');
require_once( TM_INC . 'get-image-media-uploader.php');
require_once( TM_INC . 'image-sizes.php');
require_once( TM_INC . 'login.php');
require_once( TM_INC . 'redirect-draft.php');
require_once( TM_INC . 'remove-base-url.php');
require_once( TM_INC . 'template-body-class.php');
require_once( TM_INC . 'trim-text.php');

/* Includes Level 2 */
require_once( TM_INC . 'ajax/listing-filter.php');
require_once( TM_INC . 'ajax/listing-load.php');
require_once( TM_INC . 'ajax/map-locations.php');
require_once( TM_INC . 'attractions/attractions.php');
require_once( TM_INC . 'blog/blog.php');
require_once( TM_INC . 'classes/class-card.php');
require_once( TM_INC . 'classes/class-side-box.php');
require_once( TM_INC . 'components/btn-load-more.php');
require_once( TM_INC . 'components/modal.php');
require_once( TM_INC . 'events/events.php');
require_once( TM_INC . 'filters/filters.php');
require_once( TM_INC . 'settings/settings.php');
require_once( TM_INC . 'meta-boxes/meta-boxes.php');
require_once( TM_INC . 'search/search.php');
require_once( TM_INC . 'shortcodes/shortcodes.php');
require_once( TM_INC . 'slider/slider.php');

// Redirection temporaire 
function redirect_if_user_not_logged_in() {

    if ( !is_user_logged_in() && !in_array( $GLOBALS['pagenow'], ['wp-login.php'], true ) ) {
        wp_redirect( get_site_url() . '/wp-login.php' ); 
        exit;
    }

}
// add_action( 'init', 'redirect_if_user_not_logged_in' );

// Redirect empty archives
function redirect_if_empty_archive() {

    if ( is_archive() ) {
        if ( get_queried_object()->count === 0 ) {
            wp_redirect( get_site_url(), 302 );
            exit();
        }
    }

}
add_action( 'template_redirect', 'redirect_if_empty_archive' );