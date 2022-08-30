<?php 

/*
 * Latest Blog Posts : Footer
 */

 function get_latest_blog_posts_footer( $post_id ) {

    ob_start();

    $args = [
        'post_type'         =>  'post',
        'post_status'       =>  'publish',
        'post__not_in'      =>  [ $post_id ],
        'order'             =>  'desc',
        'orderby'           =>  'date',
        'posts_per_page'    =>  2
    ];

    $posts = new WP_Query( $args );

    while ( $posts->have_posts() ): $posts->the_post();   

        $post = new TMCard( get_the_ID(), 'post', 'footer' );
        echo $post->output();
        
    endwhile;

    return ob_get_clean();

 }