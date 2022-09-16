<?php 
/*
 * Function: Get Related Attractions 
 */


function get_related_attractions( $post_id ) {

    ob_start();

    $primary_cat_id = intval( get_post_meta( $post_id, '_primary_term_attraction_category', true ) );

    $args = [
        'post__not_in'      =>  [ $post_id ],
        'post_type'         =>  'attraction',
        'post_status'       =>  'publish',
        'orderby'           =>  'title',
        'order'             =>  'asc',
        'posts_per_page'    =>  2,
        'meta_key'          =>  '_primary_term_attraction_category',
        'meta_value'        =>  $primary_cat_id
    ];

    $related_attract = new WP_Query( $args );

    if ( $related_attract->have_posts() ): ?>

        <div class="tm-post__related tm-post__related--bottom">
            <h4 class="small-header small-header--blue"><?php esc_html_e( 'See also', TM_DOMAIN ); ?></h4>
            <div class="cards cards--xlarge">
                <div class="cards__listing cards__listing--xlarge">

                    <?php 
                        while ( $related_attract->have_posts() ) {
                            $related_attract->the_post();
                            $attract = new TMCard( get_the_ID(), 'attraction', 'xlarge' );
                            echo $attract->output();
                        }
                    ?>                   

                </div>                
            </div> 
        </div>

    <?php 
    endif;

    return ob_get_clean();

}