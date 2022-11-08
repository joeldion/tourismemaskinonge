<?php 
/*
 * Slider per category Meta box 
 */

$taxomonies = [ 'attraction_category', 'tm_event_category', 'category' ];

foreach ( $taxomonies as $tax_slug ) {
    add_action( $tax_slug . '_edit_form_fields', 'slider_image_per_category', 10, 2 );
    add_action( 'edited_' . $tax_slug, 'slider_image_per_category_save', 10, 2 );
}

function slider_image_per_category( $term, $taxonomy ) {
    
    $cat_image = get_term_meta( $term->term_id, '_cat_image_url', true );
    $preview = !empty( $cat_image ) ? wp_get_attachment_image_url( $cat_image, 'tm-thumb' ) : '';
    $visible = !empty( $cat_image ) ? ' visible' : '';
    ?> 
    <tr class="form-field">
        <th>
            <label for="tm-category-image"><?php esc_html_e( 'Category image', TM_DOMAIN ); ?></label>
        </th>
        <td>
            <?php get_image_media_uploader( $cat_image, 'tm-category-image' ); ?>
        </td>
    </tr>
    <?php

}

function slider_image_per_category_save( $term, $taxonomy ) {

    $cat = get_term( $term );
    $cat_img_data = intval( $_POST['tm-category-image'] );

    if ( $cat_img_data !== 0 ) {
        update_term_meta( $cat->term_id, '_cat_image_url', $cat_img_data );
    } else {
        delete_term_meta( $cat->term_id, '_cat_image_url' );
    }

}