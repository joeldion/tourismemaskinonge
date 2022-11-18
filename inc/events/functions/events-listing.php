<?php 
/*
 * Function: Get Events Listing
 */

add_action( 'wp_ajax_get_events_listing', 'get_events_listing' );
add_action( 'wp_ajax_nopriv_get_events_listing', 'get_events_listing' );

function get_events_listing( $limit = 9 ) {

    ob_start();
    // $limit = !isset($limit) ? 9 : $limit;

    $location_filter = '';
    if ( isset( $_POST['location_filter'] ) ) {
        $location_filter = [
            'key'   =>  '_tm_event_city',
            'value' =>  $_POST['location_filter']
        ];
    }

    $args = [
        // 'post__not_in'      =>  [ $event_id ],
        'post_type'         =>  'tm_event',
        'post_status'       =>  'publish',
        'order'             =>  'asc',
        'orderby'           =>  'meta_value',
        'posts_per_page'    =>  $limit,
        'meta_query'        =>  [
                                    'relation'  =>  'AND',
                                    [
                                        'key'   =>  '_tm_event_end_date',                                        
                                        'value' =>  date( 'Y-m-d H:i:s', strtotime( '-1 day' ) ),
                                        'compare'   =>  '>',
                                        'type'      =>  'DATETIME'
                                    ],
                                    $location_filter
                                ],
    ];

    $events = new WP_Query( $args );

    if ( $events->have_posts() ): 
        ?>
        
        <div class="cards__listing cards__listing--masonry" id="listing" data-post-type="tm_event">   
            <?php 
                while ( $events->have_posts() ) : $events->the_post();
                    $event = new TMCard( get_the_ID(), 'tm_event' );
                    echo $event->output();
                endwhile; 
            ?>            
        </div>
        <!-- <input type="hidden" id="tm-events-cities" name="tm-events-cities"> -->
    <?php 
    endif;


    return ob_get_clean();

}