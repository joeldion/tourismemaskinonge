<?php 
/*
 * Column: Event Dates
 */

add_filter( 'manage_tm_event_posts_columns', 'tm_event_dates_column_head', 100 );
add_filter( 'manage_edit-tm_event_sortable_columns', 'tm_event_dates_sortable_columns', 100 );
add_action( 'manage_tm_event_posts_custom_column', 'tm_event_dates_column_content', 1, 2 );
add_action( 'pre_get_posts', 'tm_event_dates_column_sort' );

function tm_event_dates_column_head( $columns ) {

    $columns[ 'date' ] = esc_html__( 'Publication Date', TM_DOMAIN );
    $columns[ 'tm_event_start_date' ] = esc_html__( 'Start Date', TM_DOMAIN );
    $columns[ 'tm_event_end_date' ] = esc_html__( 'End Date', TM_DOMAIN );
    return $columns;

}

function tm_event_dates_sortable_columns( $columns ) {

    $columns[ 'tm_event_start_date' ] = 'tm_event_start_date';
    $columns[ 'tm_event_end_date' ] = 'tm_event_end_date';
    return $columns;

}

function tm_event_dates_column_content( $column_name, $post_id ) {

    if ( $column_name == 'tm_event_start_date' ) {

        $start_date = strtotime( get_post_meta( $post_id, '_tm_event_start_date', true ) );
        $start_time = esc_html( get_post_meta( $post_id, '_tm_event_start_time', true ) );

        if ( $start_date !== '' ) {
            echo date_i18n( 'l j F Y', $start_date ) . ', ' . $start_time;
        }

    }

    if ( $column_name == 'tm_event_end_date' ) {

        $end_date = strtotime( get_post_meta( $post_id, '_tm_event_end_date', true ) );
        $end_time = esc_html( get_post_meta( $post_id, '_tm_event_end_time', true ) );

        if ( $end_date !== '' ) {
            echo date_i18n( 'l j F Y', $end_date ) . ', ' . $end_time;
        }

    }

}

function tm_event_dates_column_sort( $query ) {

    if ( !is_admin() ) return;

    $orderby = $query->get( 'orderby' );

    if ( 'tm_event_start_date' == $orderby ) $meta_key = '_tm_event_start_date';
    if ( 'tm_event_end_date' == $orderby ) $meta_key = '_tm_event_end_date';
    
    if ( isset( $meta_key ) ) {
        $query->set( 'meta_key', $meta_key );
        $query->set( 'orderby', 'meta_value' );
    }

}