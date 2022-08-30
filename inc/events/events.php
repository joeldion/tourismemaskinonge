<?php

require_once( TM_DIR . '/inc/events/meta-boxes/events-details.php' );
require_once( TM_DIR . '/inc/events/meta-boxes/events-locations-details.php' );
require_once( TM_DIR . '/inc/events/functions/events-listing.php' );
require_once( TM_DIR . '/inc/events/functions/events-contact.php' );
require_once( TM_DIR . '/inc/events/functions/events-categories.php' );
require_once( TM_DIR . '/inc/events/functions/events-related.php' );

/*
 *  Events CPT
 */
function tm_event_cpt() {

    $args = [
            'labels'    =>  [
                    'name'                  => _nx( 'Event', 'Events', 2, 'Event name', TM_DOMAIN ),
                    'singular_name'         => _nx( 'Event', 'Events', 1, 'Event name', TM_DOMAIN ),
                    'add_new_item'          => esc_html__( 'Add Event', TM_DOMAIN ),
                    'edit_item'             => esc_html__( 'Edit Event', TM_DOMAIN ),
                    'new_item'              => esc_html__( 'New Event', TM_DOMAIN ),
                    'all_items'             => esc_html__( 'All Events', TM_DOMAIN ),
                    'view_item'             => esc_html__( 'View Event', TM_DOMAIN ),
                    'search_items'          => esc_html__( 'Search Events', TM_DOMAIN ),
                    'not_found'             => esc_html__( 'No Events found', TM_DOMAIN ),
                    'not_found_in_trash'    => esc_html__( 'No Events found in trash', TM_DOMAIN )
            ],
            'rewrite'               => [ 'slug' => _nx( 'event', 'events', 1, 'Event slug', TM_DOMAIN ) ],
            'supports'              => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
            'public'                => true,
            'show_ui'               => true,
            'menu_position'         => 15,
            'menu_icon'             => 'dashicons-calendar-alt'
    ];

    register_post_type( 'tm_event', $args );

}
add_action( 'init', 'tm_event_cpt', 9 );


/*
** Event Categories Taxonomy
*/
function tm_event_categories() {

    $args = array(
            'hierarchical'          => true,
            'public'                => true,
            'show_admin_column'     => true,
            'rewrite'               => [ 'slug' => _nx( 'event-category', 'event-categories', 2, 'Event category slug', TM_DOMAIN ) ], 
			'labels' => [
    			        'name'                  => _nx( 'Event Category', 'Event Categories', 2, 'Event category name', TM_DOMAIN ),
    			        'singular_name'         => _nx( 'Event Category', 'Event Categories', 1, 'Event category name', TM_DOMAIN ),
    			        'add_new_item'          => esc_html__( 'Add New Event Category', TM_DOMAIN ),
    					'new_item_name'         => esc_html__( 'New Event Category', TM_DOMAIN ),
    			        'edit_item'             => esc_html__( 'Edit Event Category', TM_DOMAIN ),
    			        'new_item'              => esc_html__( 'New Event Category', TM_DOMAIN ),
    			        'all_items'             => esc_html__( 'All Event Categories', TM_DOMAIN ),
    					'parent_item'           => esc_html__( 'Parent Event Category', TM_DOMAIN ),
    					'parent_item_colon'     => esc_html__( 'Parent Event Category:', TM_DOMAIN ),
    			        'view_item'             => esc_html__( 'View Event Category', TM_DOMAIN ),
    					'update_item'           => esc_html__( 'Update Event Category', TM_DOMAIN ),
    			        'search_items'          => esc_html__( 'Search Event Categories', TM_DOMAIN ),
    			        'not_found'             => esc_html__( 'No Event Categories found', TM_DOMAIN ),
			],
    );
    register_taxonomy( 'tm_event_category', 'tm_event', $args );

}
add_action( 'init', 'tm_event_categories' );

/*
 *  Event Locations CPT
 */
function tm_event_location_cpt() {

    $args = [
            'labels'    =>  [
                    'name'                  => _nx( 'Location', 'Locations', 2, 'Location name', TM_DOMAIN ),
                    'singular_name'         => _nx( 'Location', 'Locations', 1, 'Location name', TM_DOMAIN ),
                    'add_new_item'          => esc_html__( 'Add Location', TM_DOMAIN ),
                    'edit_item'             => esc_html__( 'Edit Location', TM_DOMAIN ),
                    'new_item'              => esc_html__( 'New Location', TM_DOMAIN ),
                    'all_items'             => esc_html__( 'All Locations', TM_DOMAIN ),
                    'view_item'             => esc_html__( 'View Location', TM_DOMAIN ),
                    'search_items'          => esc_html__( 'Search Locations', TM_DOMAIN ),
                    'not_found'             => esc_html__( 'No Locations found', TM_DOMAIN ),
                    'not_found_in_trash'    => esc_html__( 'No Locations found in trash', TM_DOMAIN )
            ],
            'rewrite'               => [ 'slug' => _nx( 'location', 'locations', 1, 'Location slug', TM_DOMAIN ) ],
            'supports'              => [ 'title' ],
            'show_ui'               => true,
            'show_in_menu'          => 'edit.php?post_type=tm_event'
    ];

    register_post_type( 'tm_event_location', $args );

}
add_action( 'init', 'tm_event_location_cpt', 9 );

/*
** Event Admin Column
*/
function tm_event_admin_column_head( $columns ) {

    $columns[ 'tm_event_start_date' ] = esc_html__( 'Event Start Date', TM_DOMAIN );
    return $columns;

}
add_filter( 'manage_tm_event_posts_columns', 'tm_event_admin_column_head' );

function tm_event_admin_column_content( $column_name, $post_id ) {

    if ( $column_name == 'tm_event_start_date' ) {

        $start_date = strtotime( get_post_meta( $post_id, '_tm_event_start_date', true ) );
        $start_time = esc_html( get_post_meta( $post_id, '_tm_event_start_time', true ) );

        if ( $start_date !== '' ) {
            echo date_i18n( 'l j F Y', $start_date ) . ', ' . $start_time;
        }

    }

}
add_action( 'manage_tm_event_posts_custom_column', 'tm_event_admin_column_content', 1, 2 );
