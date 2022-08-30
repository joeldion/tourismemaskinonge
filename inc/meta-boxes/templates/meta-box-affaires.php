<?php 

/*
 * Tourisme d'affaires Meta Boxes
 */

add_action( 'add_meta_boxes_page', 'tm_affaires_meta_boxes' );
add_action( 'save_post', 'tm_affaires_meta_boxes_save' );

function tm_affaires_meta_boxes_data() {

    $meta_boxes = [ 
        [
            'name'      => 'bullets',
            'label'     =>  esc_html__( 'Bullet List', TM_DOMAIN )
        ],
        [
            'name'  => 'locations_featured',
            'label' =>  esc_html__( 'Section: Featured Locations', TM_DOMAIN )
        ],
        [
            'name'  => 'locations_others',
            'label' =>  esc_html__( 'Section: Other Locations', TM_DOMAIN )
        ],
    ];
    
    return $meta_boxes;

}

function tm_affaires_meta_boxes() {

    global $post;
    if ( 'page-affaires.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
        
        $meta_boxes = tm_affaires_meta_boxes_data();
        foreach ( $meta_boxes as $meta_box ) {
    
            add_meta_box(
                'affaires_' . $meta_box['name'],
                $meta_box['label'],
                'tm_affaires_' . $meta_box['name'] . '_callback',
                'page',
                'normal',
                'high'
            );
    
        }

    }

}

function tm_affaires_bullets_callback() {

    wp_nonce_field( 'affaires_bullets', 'affaires_bullets_nonce' );
    global $post;
    $bullets = unserialize( get_post_meta( $post->ID, '_tm_bullets', true ) ); 
    ?>
    <table class="form-table">
        <tbody>          
            <?php for ( $i = 0; $i <= 2; $i++ ): ?>
                    <tr>
                        <th>
                            <label for="bullets-<?php echo $i; ?>">
                                <span class="option-title">
                                    <?php echo esc_html__( 'Bullet', TM_DOMAIN ) . ' ' . ($i + 1); ?> 
                                </span>
                            </label>
                        </th>
                        <td>
                            <input type="text" id="bullets-<?php echo $i; ?>" name="bullets-<?php echo $i; ?>" value="<?php echo $bullets[$i]; ?>">
                        </td>
                    </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <?php
}

function tm_affaires_locations_featured_callback() {

    wp_nonce_field( 'affaires_locations_featured', 'affaires_locations_featured_nonce' );
    global $post;
    $id = $post->ID;
    $small_text = esc_html( get_post_meta( $id, '_tm_locations_featured_small_text', true ) );
    $big_text = esc_html( get_post_meta( $id, '_tm_locations_featured_big_text', true ) );
    $text = esc_html( get_post_meta( $id, '_tm_locations_featured_text', true ) );
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th>
                    <label for="locations_featured-small-text">
                        <span class="option-title"><?php esc_html_e( 'Small Text', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" size="80" id="locations_featured-small-text" name="locations_featured-small-text" value="<?php echo $small_text; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="locations_featured-big-text">
                        <span class="option-big-text"><?php esc_html_e( 'Big Text', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" size="80" id="locations_featured-big-text" name="locations_featured-big-text" value="<?php echo $big_text; ?>">
                </td>
            </tr>            
            <tr>
                <th>
                    <label for="locations_featured-text">
                        <span class="option-title"><?php esc_html_e( 'Text' ); ?></span>
                    </label>
                </th>
                <td>
                    <textarea name="locations_featured-text" id="locations_featured-text" cols="80" rows="5"><?php echo $text; ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <?php

}

function tm_affaires_locations_others_callback() {

    wp_nonce_field( 'affaires_locations_others', 'affaires_locations_others_nonce' );
    global $post;
    $id = $post->ID;
    $small_text = esc_html( get_post_meta( $id, '_tm_locations_others_small_text', true ) );
    $big_text = esc_html( get_post_meta( $id, '_tm_locations_others_big_text', true ) );
    $text = esc_html( get_post_meta( $id, '_tm_locations_others_text', true ) );
    $btn_text = esc_html( get_post_meta( $id, '_tm_locations_others_btn_text', true ) );
    $btn_link = esc_url( get_post_meta( $id, '_tm_locations_others_btn_link', true ) );
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th>
                    <label for="locations_others-small-text">
                        <span class="option-title"><?php esc_html_e( 'Small Text', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" id="locations_others-small-text" name="locations_others-small-text" value="<?php echo $small_text; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="locations_others-big-text">
                        <span class="option-title"><?php esc_html_e( 'Big Text', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                    <input type="text" id="locations_others-big-text" name="locations_others-big-text" value="<?php echo $big_text; ?>">
                </td>
            </tr>            
            <tr>
                <th>
                    <label for="locations_others-text">
                        <span class="option-title"><?php esc_html_e( 'Text' ); ?></span>
                    </label>
                </th>
                <td>
                    <textarea name="locations_others-text" id="locations_others-text" cols="80" rows="5"><?php echo $text; ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="locations_others-btn-text">
                        <span class="option-title"><?php esc_html_e( 'Button Text', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                   <input type="text" id="locations_others-btn-text" name="locations_others-btn-text" value="<?php echo $btn_text; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="locations_others-btn-link">
                        <span class="option-title"><?php esc_html_e( 'Button Link', TM_DOMAIN ); ?></span>
                    </label>
                </th>
                <td>
                   <input type="url" id="locations_others-btn-link" name="locations_others-btn-link" value="<?php echo $btn_link; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php

}

function tm_affaires_meta_boxes_save( $post_id ) {

    $meta_boxes = tm_affaires_meta_boxes_data();

    foreach ( $meta_boxes as $meta_box ) {

        $name = $meta_box['name'];
        $fields = [];

        if (! isset($_POST[ 'affaires_' . $name . '_nonce' ])) {
            return $post_id;
        }
        $nonce = $_POST[ 'affaires_' . $name . '_nonce' ];
        if (! wp_verify_nonce( $nonce, 'affaires_' . $name )) {
            return $post_id;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        if (! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        if ( $name === 'bullets' ) {
            for ( $i = 0; $i < 3; $i++ ) {
                $fields[$i] = addslashes( sanitize_text_field( $_POST[ $name . '-' . $i ] ) );
            }
            $data = serialize( $fields );        
            update_post_meta( $post_id, '_tm_' . $name, $data );
        } else {
            $data_big_text = sanitize_text_field( $_POST[ $name . '-big-text' ] );
            $data_small_text = sanitize_text_field( $_POST[ $name . '-small-text' ] );
            $data_text = wp_kses_post( $_POST[ $name . '-text' ] );
            $data_btn_text = sanitize_text_field( $_POST[ $name . '-btn-text' ] );
            $data_btn_link = sanitize_text_field( $_POST[ $name . '-btn-link' ] );
            update_post_meta( $post_id, '_tm_' . $name . '_big_text', $data_big_text );
            update_post_meta( $post_id, '_tm_' . $name . '_small_text', $data_small_text  );
            update_post_meta( $post_id, '_tm_' . $name . '_text', $data_text );
            update_post_meta( $post_id, '_tm_' . $name . '_btn_text', $data_btn_text );
            update_post_meta( $post_id, '_tm_' . $name . '_btn_link', $data_btn_link );
        }

    }

}