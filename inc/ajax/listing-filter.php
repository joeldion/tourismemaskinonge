<?php 
/*
 * Ajax: Listing Filter
 */

add_action( 'wp_ajax_tm_listing_filter', 'tm_listing_filter' );
add_action( 'wp_ajax_nopriv_tm_listing_filter', 'tm_listing_filter' );

function tm_listing_filter() {

    $cities = [];
    $tax_query = [];
    $response = (object)[];
    
    if ( $_POST['category_id'] != 0 ) {
        $tax_query = [
            [
                'taxonomy'  =>  'tm_event_category',
                'field'     =>  'term_id',
                'terms'     =>  $_POST['category_id']
            ]
        ];
    }
    $args = [
        'post_type'     =>  'tm_event',
        'post_status'   =>  'publish',        
        'tax_query'     =>  $tax_query
    ];

    $events = new WP_Query( $args );

    if ( $events->have_posts() ):
    
        while ( $events->have_posts() ): $events->the_post();
            $city = get_post_meta( get_the_ID(), '_tm_event_city', true );
            if ( !in_array( $city, $cities ) && !empty( $city ) ) {
                array_push( $cities, $city );
            }
        endwhile;

        $response->html = '<option value="" class="hidden" disabled selected>Filtrer par municipalité</option>';
        $response->html .= '<option value="all">Tout</option>';

        foreach ( $cities as $city ) {
            $response->html .= '<option value="' . $city . '">' . $city . '</option>';
        }

    else:
        $response->html = false;
    endif;
    
    echo json_encode($response);
    exit();

}