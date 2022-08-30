<?php 
/*
 * Ajax: Load More Content
 */

add_action( 'wp_ajax_tm_load_listing', 'tm_load_listing' );
add_action( 'wp_ajax_nopriv_tm_load_listing', 'tm_load_listing' );

function tm_load_listing( $option = '', $exclude = [], $ajax = true, $city = '' ) {
    
    $post_type   = isset( $_POST['post_type'] )    ? $_POST['post_type']   : 'post';
    $cat_id      = isset( $_POST['category_id'] )  ? $_POST['category_id'] : 0;
    $page        = isset( $_POST['page'] )         ? $_POST['page']        : 1;
    $city        = isset( $_POST['city'] )         ? $_POST['city']        : null;    
    $is_business = false;
    $meta_query_city = '';
    $location_ids = [];
    
    if ( $option === 'business' ) {
        $is_business = true;
        $post_type = 'attraction';
        $meta_query =   [
                            [
                                'key'   =>  '_tm_attract_business',
                                'value' =>  '1'
                            ]
                        ];
    }

    if ( !empty( $city ) ) {

        $args = [
            'post_type'     =>  'tm_event_location',
            'post_status'   =>  'publish',
            'orderby'       =>  'meta_value',
            'order'         =>  'asc',
            'meta_key'      =>  '_tm_event_location_city',
            'meta_value'    =>  $city
        ];

        $locations = new WP_Query( $args );

        while ( $locations->have_posts() ): $locations->the_post();
            array_push( $location_ids, get_the_ID() );
        endwhile;

        $meta_query_city = [
                                'key'       =>  '_tm_event_location_id',
                                'value'     =>  $location_ids,
                                'compare'   =>  'IN'
                           ];

        if ( $city === 'all' ) $meta_query_city = '';

    }

    switch ( $post_type ) {

        case 'post':
            $order = 'desc';
            $orderby = 'date';
            break;
        case 'tm_event':
            $order = 'asc';
            $orderby = 'meta_value';
            $meta_key = '_tm_event_start_date';
            $meta_query = [
                                'relation'  =>  'AND',
                                [
                                    'key'     =>  '_tm_event_end_date',
                                    'value'   =>  current_time( 'mysql' ),
                                    'compare' =>  '>',
                                    'type'    =>  'DATETIME'
                                ],
                                $meta_query_city
                            ];
            $tax_query =  [
                                [
                                    'taxonomy'  =>  'tm_event_category',
                                    'field'     =>  'term_id',
                                    'terms'     =>  $cat_id
                                ]
                          ];
            break;
        case 'attraction':
            $order = 'asc';
            $orderby = 'title';
            $tax_query = [
                                [
                                    'taxonomy'  =>  'attraction_category',
                                    'field'     =>  'term_id',
                                    'terms'     =>  $cat_id
                                ]
                         ];
            break;

    }

    $args = [
        'post_type'         =>  $post_type,
        'post_status'       =>  'publish',
        'order'             =>  $order,
        'orderby'           =>  $orderby,
        'posts_per_page'    =>  9,
        'post__not_in'      =>  $exclude,
        'paged'             =>  $page      
    ];

    if ( isset($meta_query) ) $args['meta_query'] = $meta_query;
    if ( isset($meta_key) ) $args['meta_key'] = $meta_key;
    if ( isset($tax_query) && $cat_id != 0 ) $args['tax_query'] = $tax_query;

    $posts = new WP_Query( $args );
    $response = (object)[];
    $response->html = '';

    if ( $posts->have_posts() ):

        while ( $posts->have_posts() ): $posts->the_post();
            $post = new TMCard( get_the_ID(), $post_type, '', false, $is_business );
            $response->html .= $post->output();
        endwhile;

        $count = $posts->found_posts;         
        $response->results_count = $count . '&nbsp;' . _nx( 'result', 'results', $count, 'results', TM_DOMAIN );
        $response->title = !empty( $cat_id ) ? get_term( $cat_id )->name : '';
        $response->slug = !empty( $cat_id ) ? get_term( $cat_id )->slug : '';
        $response->max = $posts->max_num_pages;
        $response->cat_slide_id = get_term_meta( $cat_id, '_cat_image_url', true );
        if ( empty( $response->cat_slide_id ) ) {
            $response->cat_slide_id = TM_DEFAULT_SLIDE;
        }
        $response->cat_slide_url = wp_get_attachment_image_url( $response->cat_slide_id, 'tm-slide' );

    endif;

    if ( $ajax ) {
        echo json_encode($response);
    } else {
        return $response->html;
    }
    
    exit();

}