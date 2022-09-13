<?php
/*
 * Column: Event Location
 */

add_filter( 'manage_tm_event_posts_columns', 'tm_event_location_column_head', 100 );
add_filter( 'manage_edit-tm_event_sortable_columns', 'tm_event_location_sortable_column', 100 );
add_action( 'manage_tm_event_posts_custom_column', 'tm_event_location_column_content', 10, 2 );
add_action( 'pre_get_posts', 'tm_event_location_column_sort' );

function tm_event_location_column_head( $columns ) {

    $columns[ 'tm_event_location' ] = esc_html_x( 'Location', 'Location name', TM_DOMAIN );
    return $columns;

}

function tm_event_location_sortable_column( $columns ) {

    $columns[ 'tm_event_location' ] = 'tm_event_location';
    return $columns;

}

function tm_event_location_column_content( $column_name, $post_id ) {

    if ( $column_name === 'tm_event_location' ) {       
        $location_id = intval( get_post_meta( $post_id, '_tm_event_location_id', true ) );
        ?>
        <a href="<?php echo get_edit_post_link( $location_id ); ?>"><?php echo get_the_title( $location_id ); ?></a>
        <?php       
    }

}

function tm_event_location_column_sort( $query ) {

    if ( !is_admin() ) return;

    $orderby = $query->get( 'orderby' );

    // Make events sortable by location id
    if ( 'tm_event_location' == $orderby ) {
        $query->set( 'meta_key', '_tm_event_location_id' );
        $query->set( 'orderby', 'meta_value_num' );
    }

}