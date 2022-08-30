<?php 
/*
 * Component: Load More Button
 */

function get_load_more_btn( $color, $post_type = 'post', $category = 0 ) {

    ob_start();

    ?>
    <div class="cards__cta cards__cta--<?php echo $post_type; ?>">
        <a href="#" id="loadmore" class="btn btn--<?php echo $color; ?> btn--more" data-catid="<?php echo $category; ?>">
            Voir plus
            <span id="btn-loading" class="btn__loading"></span>
        </a>
    </div>
    <?php

    return ob_get_clean();

}