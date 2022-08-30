<?php 

/*
 *  Page Meta Boxes
 */

add_action( 'add_meta_boxes_page', 'tm_page_meta_boxes' );
add_action( 'save_post', 'tm_page_meta_boxes_save' );

function tm_page_meta_boxes_data() {

    $meta_boxes = [
        [
            'name'  =>  'subtitle',
            'label' =>  esc_html__( 'Subtitle', TM_DOMAIN )
        ],
        [
            'name'  =>  'button',
            'label' =>  esc_html__( 'Button', TM_DOMAIN )
        ]
    ];

    return $meta_boxes;

}

function tm_page_meta_boxes() {

    global $post;
    $meta_boxes = tm_page_meta_boxes_data();

    foreach ( $meta_boxes as $meta_box ) {
        
        add_meta_box(
            'page_' . $meta_box['name'],
            $meta_box['label'],
            'tm_page_' . $meta_box['name'] . '_callback',
            'page',
            'normal',
            'high'
        );

    }

}

function tm_page_subtitle_callback() {

    wp_nonce_field( 'tm_page_subtitle', 'tm_page_subtitle_nonce' );
    global $post;
    $subtitle = esc_html( get_post_meta( $post->ID, '_tm_page_subtitle', true ) );
    ?>
    <table class="form-table">
        <tbody> 
            <tr>
                <td>
                    <input type="text" id="tm-page-subtitle" name="tm-page-subtitle" value="<?php echo $subtitle; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php

}

function tm_page_button_callback() {

    wp_nonce_field( 'tm_page_button', 'tm_page_button_nonce' );
    global $post;
    $btn_text = esc_html( get_post_meta( $post->ID, '_tm_page_btn_text', true ) );
    $btn_link = esc_url( get_post_meta( $post->ID, '_tm_page_btn_link', true ) );
    ?>
    <table class="form-table">
        <tbody> 
            <tr>
                <th>
                    <label for="tm-page-btn-text">
                        <span class="option-title">
                            <?php esc_html_e( 'Button Text', TM_DOMAIN ); ?>
                        </span>
                    </label>
                </th>
                <td>
                    <input type="text" id="tm-page-btn-text" name="tm-page-btn-text"" value="<?php echo $btn_text; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="tm-page-btn-link">
                            <span class="option-title">
                                <?php esc_html_e( 'Button Link', TM_DOMAIN ); ?>
                            </span>
                    </label>
                </th>
                <td>
                    <input type="url" id="tm-page-btn-link" name="tm-page-btn-link"" value="<?php echo $btn_link; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php

}

function tm_page_meta_boxes_save( $post_id ) {

    $meta_boxes = tm_page_meta_boxes_data();

    foreach ( $meta_boxes as $meta_box ) {

        $name = $meta_box['name'];

        if (! isset($_POST[ 'tm_page_' . $name . '_nonce' ])) {
            return $post_id;
        }
        $nonce = $_POST[ 'tm_page_' . $name . '_nonce' ];
        if (! wp_verify_nonce( $nonce, 'tm_page_' . $name )) {
            return $post_id;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        if (! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        if ( $name === 'subtitle' ) {
            $data_subtitle = sanitize_text_field( $_POST['tm-page-subtitle'] );
            update_post_meta( $post_id, '_tm_page_subtitle', $data_subtitle );
        }

        if ( $name === 'button' ) {
            $data_btn_text = sanitize_text_field( $_POST['tm-page-btn-text'] );
            $data_btn_link = sanitize_url( $_POST['tm-page-btn-link'] );
            update_post_meta( $post_id, '_tm_page_btn_text', $data_btn_text );
            update_post_meta( $post_id, '_tm_page_btn_link', $data_btn_link );
        }

    }

}

// Page Templates Meta Boxes
require_once( TM_INC . '/meta-boxes/templates/meta-box-affaires.php' );
require_once( TM_INC . '/meta-boxes/templates/meta-box-chemin.php' );
require_once( TM_INC . '/meta-boxes/templates/meta-box-nous-joindre.php' );