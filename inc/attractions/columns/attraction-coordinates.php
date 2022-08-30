<?php 
/*
 * Attraction Coordinates Column
 */

// add_filter( 'manage_attraction_posts_columns', 'tm_attract_coordinates_column_head', 100 );
// add_action( 'manage_attraction_posts_custom_column', 'tm_attract_coordinates_column_content', 10, 2 );

function tm_attract_coordinates_column_head( $columns ) {

    $columns[ 'coord' ] = esc_html__( 'Coordinates', TM_DOMAIN );
    return $columns;

}

function tm_attract_coordinates_column_content( $column_name, $post_id ) {

    if ( $column_name === 'coord' ) {
        esc_html_e( get_post_meta( $post_id, '_tm_attract_coord', true ) );
    }

}
