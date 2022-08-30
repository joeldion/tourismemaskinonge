<?php 
/*
 * Attraction Category Order (archive filter)
 * For parent categories only
 */
add_action( 'attraction_category_edit_form_fields', 'attraction_category_order', 10, 2 );
add_action( 'edited_attraction_category', 'attraction_category_order_save', 10, 2 );

function attraction_category_order( $term, $taxonomy ) {

    $parents = [ 0, 7 ];
   
    if ( !in_array( $term->parent, $parents ) ) return; // 7 = Quoi faire
    
    $cat_order = intval( get_term_meta( $term->term_id, '_cat_order', true ) ); 

    $args = [
        'taxonomy'      =>  'attraction_category',
        'parent'        =>  $term->parent,
    ];
    $categories = get_terms( $args );

    ?> 
    <tr class="form-field">
        <th>
            <label for="category-order">Ordre d'apparition</label>
        </th>
        <td>
            <select name="category-order" id="category-order">
                <option value="0">Par défaut</option>
                <?php for ( $i = 0; $i < count($categories); $i++ ): ?>               
                    <option value="<?php echo $i+1; ?>" <?php selected( $cat_order, $i+1, true ); ?>><?php echo $i+1; ?></option>
                <?php endfor; ?>
            </select>
            <p class="description">Ordre d'apparition de la catégorie dans les filtres des attraits.</p>
        </td>
    </tr>
    <?php

}

function attraction_category_order_save( $term, $taxonomy ) {

    $cat = get_term( $term );
    $order_data = intval( $_POST['category-order'] );

    if ( $order_data !== 0 ) {
        update_term_meta( $cat->term_id, '_cat_order', $order_data );
    } else {
        delete_term_meta( $cat->term_id, '_cat_order' );
    }

}