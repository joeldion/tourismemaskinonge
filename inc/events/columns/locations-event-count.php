<?php
/*
 * Column: Locations Event Count
 */

add_filter( 'manage_tm_event_location_posts_columns', 'tm_event_location_event_count_column_head', 100 );
add_action( 'manage_tm_event_location_posts_custom_column', 'tm_event_location_event_count_column_content', 10, 2 );

function tm_event_location_event_count_column_head( $columns ) {

    $columns[ 'tm_event_location_event_count' ] = esc_html__( 'Event Count', TM_DOMAIN );
    return $columns;

}

function tm_event_location_event_count_column_content( $column_name, $location_id ) {

    if ( $column_name === 'tm_event_location_event_count' ) {       

        $args = [
            'post_type'     =>  'tm_event',
            'post_status'   =>  'publish',
            'meta_key'      =>  '_tm_event_location_id',
            'meta_value'    =>  $location_id
        ];
        $events = new WP_Query( $args );
        echo $events->found_posts;   

    }

}