<?php
/*
 * Attractions
 */


require_once( TM_DIR . '/inc/attractions/functions/attractions-categories.php' );
// require_once( TM_DIR . '/inc/attractions/functions/attractions-listing.php' );
require_once( TM_DIR . '/inc/attractions/functions/attractions-related.php' );
require_once( TM_DIR . '/inc/attractions/functions/attractions-ids.php' );
require_once( TM_DIR . '/inc/attractions/meta-boxes/attractions-details.php' );
require_once( TM_DIR . '/inc/attractions/meta-boxes/attractions-details-business.php' );
require_once( TM_DIR . '/inc/attractions/meta-boxes/attractions-category-order.php' );
require_once( TM_DIR . '/inc/attractions/columns/attraction-coordinates.php' );


// add_action( 'admin_menu', 'tm_attract_admin_menu' );

// function tm_attract_admin_menu() {

//     add_menu_page(
//         esc_html__( 'Attractions Settings', TM_DOMAIN ),
//         esc_html__( 'Attractions', TM_DOMAIN ),
//         'manage_options',
//         'attractions-settings-page',
//         'tm_attract_settings',
//         'dashicons-location-alt',
//         3
//     );

// }

/*
 * Attraction CPT
 */

function tm_attract_cpt() {

    $args = [
        'labels'    =>  [
            'name'                  => _nx( 'Attraction', 'Attractions', 2, 'Attraction name', TM_DOMAIN ),
            'singular_name'         => _nx( 'Attraction', 'Attractions', 1, 'Attraction name', TM_DOMAIN ),
            'add_new_item'          => esc_html__( 'Add new attraction', TM_DOMAIN ),
            'edit_item'             => esc_html__( 'Edit attraction', TM_DOMAIN ),
            'new_item'              => esc_html__( 'New attraction', TM_DOMAIN ),
            'all_items'             => esc_html__( 'All attractions', TM_DOMAIN ),
            'view_item'             => esc_html__( 'View attraction', TM_DOMAIN ),
            'search_items'          => esc_html__( 'Search attractions', TM_DOMAIN ),
            'not_found'             => esc_html__( 'No attractions found', TM_DOMAIN ),
            'not_found_in_trash'    => esc_html__( 'No attractions found in trash', TM_DOMAIN ),
            'menu_item'             => esc_html__( 'Attractions', TM_DOMAIN )
        ],
        // 'rewrite'               => [ 'slug' => esc_html__( 'attraction', TM_DOMAIN ) ],
        'rewrite'               => [ 'slug' => _nx( 'attraction', 'attractions', 2, 'Attraction slug', TM_DOMAIN ) ],
        'supports'              => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'public'                => true,        
        'show_ui'               => true,
        'menu_position'         => 15,
        'menu_icon'             => 'dashicons-location-alt'
    ];

    register_post_type( 'attraction', $args );

}
add_action( 'init', 'tm_attract_cpt', 9 );

/*
 * Attraction Category Taxonomy
 */
function tm_attract_categories() {

    $args = array(
        'hierarchical'          => true,
        'public'                => true,
        'show_admin_column'     => true,
        'rewrite'               => [ 'slug' => _nx( 'attraction-category', 'attraction-categories', 2, 'Attraction category slug', TM_DOMAIN ) ], 
        // 'rewrite'               => [ 'slug' =>  'categories-attraits' ], 
        'labels' => [
                    'name'                  => _nx( 'Attraction Category', 'Attraction Categories', 2, 'Attraction category name', TM_DOMAIN ),
                    'singular_name'         => _nx( 'Attraction Category', 'Attraction Categories', 1, 'Attraction category name', TM_DOMAIN ),
                    'add_new_item'          => esc_html__( 'Add New Attraction Category', TM_DOMAIN ),
                    'new_item_name'         => esc_html__( 'New Attraction Category', TM_DOMAIN ),
                    'edit_item'             => esc_html__( 'Edit Attraction Category', TM_DOMAIN ),
                    'new_item'              => esc_html__( 'New Attraction Category', TM_DOMAIN ),
                    'all_items'             => esc_html__( 'All Attraction Categories', TM_DOMAIN ),
                    'parent_item'           => esc_html__( 'Parent Attraction Category', TM_DOMAIN ),
                    'parent_item_colon'     => esc_html__( 'Parent Attraction Category:', TM_DOMAIN ),
                    'view_item'             => esc_html__( 'View Attraction Category', TM_DOMAIN ),
                    'update_item'           => esc_html__( 'Update Attraction Category', TM_DOMAIN ),
                    'search_items'          => esc_html__( 'Search Attraction Categories', TM_DOMAIN ),
                    'not_found'             => esc_html__( 'No Attraction Categories found', TM_DOMAIN ),
        ],
    );
    register_taxonomy( 'attraction_category', 'attraction', $args );

}
add_action( 'init', 'tm_attract_categories' );