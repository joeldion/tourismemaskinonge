<?php 
/*
 * Function: Get Attractions Ids (used for random selection)
 */

function get_attract_ids() {

    $attract_ids = [];
    $args = [
        'post_type'         =>  'attraction',
        'post_status'       =>  'publish',
        'order'             =>  'asc',
        'orderby'           =>  'ID',
        'posts_per_page'    =>  -1
    ];
    $attractions = new WP_Query( $args );

    while ( $attractions->have_posts() ) {
        $attractions->the_post();
        array_push( $attract_ids, get_the_ID() );
    } 
    return $attract_ids;

}