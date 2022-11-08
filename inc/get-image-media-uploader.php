<?php 
/*
 * Image Media Uploader
 */

function get_image_media_uploader( $image_id, $input_id ) {
    
    $preview = !empty( $image_id ) ? wp_get_attachment_image_url( $image_id, 'tm-thumb' ) : '';
    $visible = !empty( $image_id ) ? ' visible' : '';
    // $input_name = str_replace( '-', '_', $input_id );

    ob_start();
    ?>
    <a href="#" class="tm-media-upload button button-secondary" data-target="<?php echo $input_id; ?>"><?php esc_html_e( 'Choose an image', TM_DOMAIN ); ?></a>
    <div class="tm-media-upload__preview">
        <div class="tm-media-upload__preview-image<?php echo $visible; ?>" id="<?php echo $input_id; ?>-preview" style="background-image: url(<?php echo $preview; ?>);"></div>                
        <span id="<?php echo $input_id; ?>-remove" class="tm-media-upload__preview-remove dashicons dashicons-no-alt<?php echo $visible_class; ?>">
        </span>
        <input type="hidden" name="<?php echo $input_id; ?>" id="<?php echo $input_id; ?>" value="<?php echo $image_id; ?>">
    </div> 
    <?php
    echo ob_get_clean();

}