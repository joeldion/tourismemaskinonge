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
        <?php foreach ( $categories as $cat ): ?>
            <li>
                <a href="#" class="tm-search-small__category tm-cat" data-catid="<?php echo $cat->term_id;?>"><?php echo $cat->name; ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php

    return ob_get_clean();

}

function get_single_event_categories( $post_id ) {

    ob_start();
    $categories = get_the_terms( $post_id, 'tm_event_category' );

    // Show 1 category
    ?>
    <a href="<?php echo get_term_link( $categories[0]->term_id ); ?>">
        <?php echo $categories[0]->name; ?>
    </a>
    <?php

    // Show 2 categories
    /*
    $cat_count = sizeof($categories);
    for ( $i = 0; $i < $cat_count; $i++ ):
    ?>
        <a href="<?php echo get_term_link( $categories[$i]->term_id ); ?>">
            <?php echo $categories[$i]->name; ?>
        </a>
        <?php echo ( ( $i === 0 && $cat_count > 1 ) ? '&nbsp;-&nbsp;' : '' ); ?>
    <?php     
    endfor;
    */

    return ob_get_clean();

}