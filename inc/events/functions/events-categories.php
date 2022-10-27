<?php 
/*
 * Function: Get Events Categories
 */

function get_events_categories() {

    ob_start();

    $args = [
        'taxonomy'      =>  'tm_event_category',
        'orderby'       =>  'slug',
        'order'         =>  'asc',
        'hide_empty'    =>  true,
    ];
    $categories = get_terms( $args );

    if ( count( $categories ) === 1 ) return; // Don't show if 1 category only

    ?>
        <ul class="tm-search-small__categories">
        <?php 
            foreach ( $categories as $cat ):

                // Don't show category if it doesn't have upcoming events
                $args = [
                    'post_type'  =>  'tm_event',
                    'status'     =>  'publish',
                    'tax_query'  =>  [
                                        'relation'  =>  'AND',
                                        [
                                            'taxonomy'  =>  'tm_event_category',
                                            'field'     =>  'term_id',
                                            'terms'     =>  $cat->term_id
                                        ]                                        
                                     ],
                    'meta_query' =>  [
                                        'relation'  =>  'AND',
                                        [
                                            'key'   =>  '_tm_event_end_date',
                                            'value' =>  current_time( 'mysql' ),
                                            'compare'   =>  '>',
                                            'type'      =>  'DATETIME'
                                        ],
                                     ]
                ];
                $events = new WP_Query( $args );

                if ( $events->have_posts() ):
                ?>
                    <li>
                        <a href="#" class="tm-search-small__category tm-cat" data-catid="<?php echo $cat->term_id;?>"><?php echo $cat->name; ?></a>
                    </li>            
                <?php
                endif;

            endforeach; 
        ?>
        </ul>
    <?php

    return ob_get_clean();

}

function get_event_main_category( $post_id ) {

    ob_start();
    $cat = get_term( get_post_meta( $post_id, '_primary_term_tm_event_category', true ) );
    ?> 
    <a href="<?php echo get_term_link( $cat->term_id ); ?>">
        <?php echo $cat->name; ?>
    </a>
    <?php
    return ob_get_clean();

}