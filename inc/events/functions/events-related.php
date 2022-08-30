<?php 
/*
 * Function: Get Related Events
 */

function get_related_events( $event_id, $category, $location_id = null ) {

    ob_start();

    $args = [
        'post__not_in'      =>  [ $event_id ],
        'post_type'         =>  'tm_event',
        'post_status'       =>  'publish',
        'order'             =>  'asc',
        'orderby'           =>  'meta_value',
        'posts_per_page'    =>  2,
        'tax_query'         =>  [
                                    'taxonomy'  =>  'tm_event_category',
                                    'field'     =>  'term_id',
                                    'terms'     =>  $category
                                ],
        'meta_query'        =>  [
                                    'relation'  =>  'AND',
                                    [
                                        'key'   =>  '_tm_event_end_date',
                                        'value' =>  current_time( 'mysql' ),
                                        'compare'   =>  '>',
                                        'type'      =>  'DATETIME'
                                    ],
                                    // [
                                    //     'key'   =>  'tm_event_location_id',
                                    //     'value' =>  $location_id
                                    // ]                                                             
                                ],
        
    ];

    $related_events = new WP_Query( $args );
    ?>

    <?php if ( $related_events->have_posts() ): ?>

    <div class="tm-post__related tm-post__related--bottom">
        <h4 class="small-header small-header--blue">À voir également</h4>
        <div class="cards cards--xlarge">            
            <div class="cards__listing cards__listing--xlarge">
                <?php 
                while ( $related_events->have_posts() ): $related_events->the_post(); 
                    $event = new TMCard( get_the_ID(), 'tm_event', 'xlarge' );
                    echo $event->output();
                endwhile; 
                ?>                          
            </div>
        </div> 
    </div>

    <?php endif; ?>

    <?php
    return ob_get_clean();

}