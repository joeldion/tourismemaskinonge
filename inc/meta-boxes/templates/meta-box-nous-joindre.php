<?php 

/*
 * Nous joindre Meta Boxes
 */

add_action( 'add_meta_boxes_page', 'tm_nous_joindre_meta_boxes' );
add_action( 'save_post', 'tm_nous_joindre_meta_boxes_save' );

function tm_nous_joindre_meta_boxes_data() {

    $meta_boxes = [
        [
            'name'  =>  'bit_mrc',
            'label' =>  'BIT - MRC de Maskinongé',
            'type'  =>  'primary'
        ],
        [
            'name'  =>  'bat_st_alexis',
            'label' =>  'BAT - Saint-Alexis-des-Monts',
            'type'  =>  'primary'
        ],
        [
            'name'  =>  'bat_st_elie',
            'label' =>  'BAT - Saint-Élie-de-Caxton',
            'type'  =>  'primary'
        ],
        [
            'name'  =>  'relais_st_mathieu',
            'label' =>  'Relais d\'information touristique - Saint-Mathieu-du-Parc',
            'type'  =>  'secondary'
        ],
        [
            'name'  =>  'parc_ursulines',
            'label' =>  'Parc des Ursulines - Louiseville',
            'type'  =>  'secondary'
        ],
        [
            'name'  =>  'relais_st_edouard',
            'label' =>  'Relais d\'information touristique - Saint-Édouard-de-Maskinongé',
            'type'  =>  'secondary'
        ],
        [
            'name'  =>  'relais_st_paulin',
            'label' =>  'Relais d\'information touristique - Saint-Paulin',
            'type'  =>  'secondary'
        ],
    ];

    return $meta_boxes;

}

function tm_nous_joindre_meta_boxes( $post ) {

    // global $post;
    if ( 'page-nous-joindre.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {

        $meta_boxes = tm_nous_joindre_meta_boxes_data();

        foreach ( $meta_boxes as $meta_box ) {

            add_meta_box(
                'nous_joindre_' . $meta_box['name'],
                $meta_box['label'],
                'tm_nous_joindre_meta_boxes_callback',
                'page',
                'normal',
                'high',
                [ 
                    'name' => $meta_box['name'],
                    'type' => $meta_box['type']
                ]
            );

        }

    }

}

function tm_nous_joindre_meta_boxes_callback( $post, $meta_box_args ) {

    wp_nonce_field( 'nous_joindre', 'nous_joindre_nonce' );
    $id = $post->ID;
    $args = $meta_box_args['args'];
    $name = $args['name'];
    $type = $args['type'];

    $small_text = esc_html( get_post_meta( $id, '_tm_' . $name . '_small_text', true ) );
    $big_text = esc_html( get_post_meta( $id, '_tm_' . $name . '_big_text', true ) );
    $address = esc_html( get_post_meta( $id, '_tm_' . $name . '_address', true ) );
    $map_url = esc_url( get_post_meta( $id, '_tm_' . $name . '_map_url', true ) );
    $phone = esc_attr( get_post_meta( $id, '_tm_' . $name . '_phone', true ) );
    $email = esc_attr( get_post_meta( $id, '_tm_' . $name . '_email', true ) );
    $website = esc_url( get_post_meta( $id, '_tm_' . $name . '_website', true ) );

    $fields = [
        [
            'name'         =>  'small-text',
            'label'        =>  esc_html__( 'Small Text', TM_DOMAIN ),
            'value'        =>  $small_text,
            'input_type'   => 'text',
        ],
        [
            'name'         =>  'big-text',
            'label'        =>  esc_html__( 'Big Text', TM_DOMAIN ),
            'value'        =>  $big_text,
            'input_type'   => 'text',
        ],
        [
            'name'         =>  'address',
            'label'        =>  esc_html__( 'Address', TM_DOMAIN ),
            'value'        =>  $address,
            'input_type'   => 'text',
        ],
        [
            'name'         =>  'map-url',
            'label'        =>  esc_html__( 'Google Map URL', TM_DOMAIN ),
            'value'        =>  $map_url,
            'input_type'   => 'url',
        ],
        [
            'name'         =>  'phone',
            'label'        =>  esc_html__( 'Phone', TM_DOMAIN ),
            'value'        =>  $phone,
            'input_type'   => 'tel',
        ],
        [
            'name'         =>  'email',
            'label'        =>  esc_html__( 'Email' ),
            'value'        =>  $email,
            'input_type'   => 'email',
        ],
        [
            'name'         =>  'website',
            'label'        =>  esc_html__( 'Website' ),
            'value'        =>  $website,
            'input_type'   => 'url',
        ],
    ];
    $primary_only_fields = [ 'email', 'website' ];

    ?>
    <table class="form-table">
        <tbody>
            <?php foreach ( $fields as $field ): ?>
                <?php if ( in_array( $field['name'], $primary_only_fields ) && $type === 'secondary' ) continue; // No email/website for secondary meta box ?>
                <tr>
                    <th>
                        <label for="<?php echo $name . '-' . $field['name']; ?>">
                            <span class="option-title"><?php echo $field['label']; ?></span>
                        </label>
                    </th>
                    <td>
                        <input type="<?php echo $field['input_type']; ?>" id="<?php echo $name; ?>-<?php echo $field['name']; ?>" name="<?php echo $name . '-' . $field['name']; ?>" value="<?php echo $field['value']; ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    
}


function tm_nous_joindre_meta_boxes_save( $post_id ) {

    if (! isset($_POST[ 'nous_joindre_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'nous_joindre_nonce' ];
    if (! wp_verify_nonce( $nonce, 'nous_joindre' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $meta_boxes = tm_nous_joindre_meta_boxes_data();

    foreach ( $meta_boxes as $meta_box ) {

        $name = $meta_box['name'];
        $type = $meta_box['type'];

        $data_small_text = sanitize_text_field( $_POST[ $name . '-small-text' ] );
        $data_big_text = sanitize_text_field( $_POST[ $name . '-big-text' ] );
        $data_address = sanitize_text_field( $_POST[ $name . '-address' ] );
        $data_map_url = esc_url_raw( $_POST[ $name . '-map-url' ] );
        $data_phone = sanitize_text_field( $_POST[ $name . '-phone' ] );
        $data_email = sanitize_email( $_POST[ $name . '-email' ] );
        $data_website = esc_url_raw( $_POST[ $name . '-website' ] );

        update_post_meta( $post_id, '_tm_' . $name . '_small_text', $data_small_text );
        update_post_meta( $post_id, '_tm_' . $name . '_big_text', $data_big_text );
        update_post_meta( $post_id, '_tm_' . $name . '_address', $data_address );
        update_post_meta( $post_id, '_tm_' . $name . '_map_url', $data_map_url );
        update_post_meta( $post_id, '_tm_' . $name . '_phone', $data_phone );
        if ( $type === 'primary' ) {
            update_post_meta( $post_id, '_tm_' . $name . '_email', $data_email );
            update_post_meta( $post_id, '_tm_' . $name . '_website', $data_website );
        }

    }

}