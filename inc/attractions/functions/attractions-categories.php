<?php 
/*
 * Function: Get Attractions Categories
 */

function get_attract_children_cat( $parent ) {

    $parents = [ 0, 7 ];
    $orderby = 'slug';
    $meta_key = '';

    if ( in_array( $parent, $parents ) ) {
        $orderby  = 'meta_value';
        $meta_key = '_cat_order';
    }

    $args = [
        'taxonomy'      =>  'attraction_category',
        'parent'        =>  $parent,
        'meta_key'      =>  $meta_key,
        'orderby'       =>  $orderby,
        'order'         =>  'asc',
        'hide_empty'    =>  true
    ];
    
    $categories = get_terms( $args );
    return $categories;

};

function get_attract_categories() {

    $cat_lvl1 = get_attract_children_cat(0);

    foreach ( $cat_lvl1 as $cat1 ):

        $cat_lvl2 = get_attract_children_cat( $cat1->term_id );
        ?>
        <ul class="filters__items filters__items--lvl-1">
            <li>
                <a href="#" class="filters__item filters__item--lvl-1 tm-cat" data-catid="<?php echo $cat1->term_id; ?>">
                    <?php echo $cat1->name; ?>
                </a>
                <?php if ( !empty( $cat_lvl2 ) ): ?>
                        <ul class="filters__items filters__items--lvl-2">
                            <?php foreach ( $cat_lvl2 as $cat2 ):
                                $cat_lvl3 = get_attract_children_cat( $cat2->term_id );
                                ?>
                                <li>
                                    <a href="#" class="filters__item filters__item--lvl-2 tm-cat" data-catid="<?php echo $cat2->term_id; ?>"><?php echo $cat2->name; ?></a>
                                    <?php if ( !empty( $cat_lvl3 ) ): ?>
                                        <ul class="filters__items filters__items--lvl-3">
                                        <?php foreach( $cat_lvl3 as $cat3 ): ?>
                                                <li>
                                                    <a href="#" class="filters__item filters__item--lvl-3 tm-cat" data-catid="<?php echo $cat3->term_id; ?>"><?php echo $cat3->name; ?></a>
                                                </li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                <?php endif; ?>
            </li>
        </ul>
        <?php
    endforeach;
    
}

function get_attract_primary_cat( $post_id, $output_link = false ) {

    $primary_cat_id = intval( get_post_meta( $post_id, '_primary_term_attraction_category', true ) );
    $primary_cat = get_term_by( 'id', $primary_cat_id, 'attraction_category' );

    // Get first category if no primary category is specified
    if ( empty( $primary_cat ) ) {
        $primary_cat = get_the_terms( $post_id, 'attraction_category' )[0];   
        $primary_cat_id = $primary_cat->term_id;
    }
    
    if ( $output_link ) {
        $output  = '<a href="' . get_term_link( $primary_cat_id ) . '"';
        $output .= ' title="' . $primary_cat->name . '"';
        $output .= ' aria-label="' . esc_html__( 'Attraction Category', TM_DOMAIN ) . ' - ' . $primary_cat->name . '">';
        $output .= $primary_cat->name . '</a>';
    } else {
        $output = $primary_cat->name;
    }
    
    return $output;

}