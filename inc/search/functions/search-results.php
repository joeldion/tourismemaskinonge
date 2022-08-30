<?php
/*
 * Search Results
*/

function get_search_results_listing() {    

    ob_start();

    if ( have_posts() ) : 
    ?>
        <div class="cards">
            <div class="cards__listing">
                <?php 
                    while ( have_posts() ) {
                        the_post();
                        $id = get_the_ID();
                        $post_type = get_post_type( $id );
                        $result = new TMCard( $id, $post_type, false, true );
                        echo $result->output();
                    }
                ?>
            </div>
        </div>      
    <?php 
    endif;

    return ob_get_clean();
    
}