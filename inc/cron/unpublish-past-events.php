<?php 
/*
** Cron Job: Unpublish past events
*/

date_default_timezone_set('America/New_York');

require_once( '/var/www/html/tourismemaskinonge/wp-load.php' );

/* 
 * Unpublish events the day after their end date 
 */
$args = [
    'post_type'     =>  'tm_event',
    'post_status'   =>  'publish',
    'meta_query'    =>  [
                            'relation'  =>  'AND',
                            [
                                'key'       =>  '_tm_event_end_date',
                                //'value'     =>  current_time( 'mysql' ) + 86400, // Tomorrow
                                //'compare'   =>  '<',
                                'value'     =>  date( 'Y-m-d', strtotime( '-1 day' ) ),
                                'compare'   =>  '<',
                                'type'      =>  'DATETIME'
                            ]
                        ]
];
$expired_events = new WP_Query( $args );

while ( $expired_events->have_posts() ): $expired_events->the_post();
    wp_update_post([
        'ID'            =>  get_the_ID(),
        'post_status'   =>  'draft'
    ]);
endwhile;