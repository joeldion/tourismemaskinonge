<?php 

/*
 * Latest Blog Posts
 */

function get_latest_blog_posts( $post_id = 0, $limit = 6, $size = '', $is_search = false ) {

    ob_start();

    $args = [
        'post_type'         =>  'post',
        'post_status'       =>  'publish',
        'post__not_in'      =>  [ $post_id ],
        'order'             =>  'desc',
        'orderby'           =>  'date',
        'posts_per_page'    =>  $limit
    ];
    $posts = new WP_Query( $args );

    if ( $posts->have_posts() ):
        ?>    
        <div class="cards__listing" id="listing" data-post-type="post">
            <?php
                while ( $posts->have_posts() ): $posts->the_post();
                    $post = new TMCard( get_the_ID(), 'post', $size, $is_search );
                    echo $post->output();                    
                endwhile;
                wp_reset_query();
                wp_reset_postdata();
            ?>
        </div>
        <?php
    endif;

    return ob_get_clean();

}