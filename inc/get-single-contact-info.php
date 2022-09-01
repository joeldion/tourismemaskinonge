<?php

function get_post_contact_info( $post_type, $color_icon = '', $color_bg = '' ) {

    ob_start();

    global $post;
    $id = $post->ID;

    if ( $post_type === 'tm_event' ) {
        
        $contact = [
            'phone_1'     =>  esc_html( get_post_meta( $id, '_tm_event_phone', true ) ),
            'email'     =>  esc_html( get_post_meta( $id, '_tm_event_email', true ) ),
            'website'   =>  esc_url( get_post_meta( $id, '_tm_event_website', true ) )
        ];
        $social = [
            'facebook'  =>  esc_url( get_post_meta( $id, '_tm_event_facebook', true ) ),
            'instagram' =>  esc_url( get_post_meta( $id, '_tm_event_instagram', true ) )
        ];

    } else if ( $post_type === 'attraction' ) {

        $contact = [
            'address'       => esc_html( get_post_meta( $id, '_tm_attract_address', true ) ),
            'city'          => esc_html( get_post_meta( $id, '_tm_attract_city', true ) ),
            'postal_code'   => esc_html( get_post_meta( $id, '_tm_attract_postal_code', true ) ),
            'gmap_url'      => esc_url( get_post_meta( $id, '_tm_attract_gmap_url', true ) ),
            'phone_1'       => esc_html( get_post_meta( $id, '_tm_attract_phone_1', true ) ),
            'phone_2'       => esc_html( get_post_meta( $id, '_tm_attract_phone_2', true ) ),
            'email'         => esc_html( get_post_meta( $id, '_tm_attract_email', true ) ),
            'website'       => esc_url( get_post_meta( $id, '_tm_attract_website', true ) )
        ];
        $full_address = $contact['address'] . '&nbsp;<br>' . $contact['city'] . '&nbsp;(QC) ' . $contact['postal_code'];
    
        $social = [
            'facebook'  =>  esc_url( get_post_meta( $id, '_tm_attract_facebook', true ) ),
            'instagram' =>  esc_url( get_post_meta( $id, '_tm_attract_instagram', true ) )
        ];
        
        if ( !empty( $contact['gmap_url'] ) ) {
            $gmap_url = $contact['gmap_url'];
        } else {
            $gmap_url = 'https://www.google.ca/maps/place/' . preg_replace( '/\s+/', '+', $full_address );
        }

    }

    $passive_data = [ 'city', 'postal_code', 'gmap_url' ];
    $href_pattern = [ '(poste)', '/\-|\s+/' ]; // Phone
    $href_replace = [ ',', '' ];
    $output_pattern = [ '/\-+/' ];
    $output_replace = [ '&#8209;' ];
    // $output_pattern = [ '/\-+/', '/\s+/' ];
    // $output_replace = [ '&#8209;', '&nbsp;' ];
    
    // Contact output
    ?>
    <ul class="tm-contact<?php echo ( $post_type === 'tm_event' ) ? ' tm-contact--event' : ''; ?>">
    <?php 
        foreach ( $contact as $key => $data ):

            if ( !empty( $data ) && !in_array( $key, $passive_data ) ):

                switch ( $key ) {

                    case 'address':
                        $href = $gmap_url;
                        $output = $full_address;
                        $aria_label = esc_html__( 'Address', TM_DOMAIN );
                        break;    
                    case 'phone_1': 
                    case 'phone_2':
                        $href = 'tel:+1' . preg_replace( $href_pattern, $href_replace, $data ); 
                        $output = $data;
                        $aria_label = esc_html__( 'Phone', TM_DOMAIN );
                        break;
                    case 'email':
                        $href = 'mailto:' . $data;
                        $output = $post_type === 'attraction' ? 'Écrivez-nous' : esc_html__( 'Email', TM_DOMAIN );
                        $aria_label = esc_html__( 'Email' );
                        break;                
                    case 'website':
                        $href = $data;
                        $output = parse_url( $data )['host'];
                        $aria_label = esc_html__( 'Website' );                  
                        break;
                    case 'facebook':
                    case 'instagram':
                        $href = $data;
                        //$output = esc_html__( ucfirst( $key ), TM_DOMAIN );
                        $aria_label = ucfirst( $key );
                        break;                
                    default:
                        $href = $data;
                        $output = $data;

                }
                $output = preg_replace( $output_pattern, $output_replace, $output );

                // Default icon color = blue
                if ( empty( $color_icon ) ) $color_icon = 'blue';                  
                // Default background color = white
                if ( empty( $color_bg ) ) $color_bg = 'blue';               
                
                $classes = 'tm-contact__item tm-contact__' . $key . ' tm-contact__' . $key . '--' . $color_icon;
            ?>
                <li class="<?php echo $classes; ?>">
                    <a class="tm-contact__link<?php echo ( $post_type === 'tm_event' ) ? ' tm-contact__link--dark' : '';?>" 
                       href="<?php echo $href; ?>" 
                       target="_blank" 
                       aria-label="<?php echo $aria_label; ?>" 
                       rel="noopener">
                       <?php echo $output; ?>
                    </a>
                </li>
            <?php

            endif;

        endforeach;
    ?>
    </ul>
    <?php
  

    // Social output
    if ( !empty( $social['facebook'] ) || !empty( $social['instagram'] ) ):
        ?>
            <div class="tm-social tm-social--bg-<?php echo $color_icon; ?>">
            <?php 
                foreach ( $social as $key => $data ):
                    if ( !empty( $data ) ) :
                        $classes = 'tm-social__' . $key . ' tm-social__' . $key . '--' . $color_bg;
                        ?>
                        <a class="<?php echo $classes; ?>" 
                           href="<?php echo $data; ?>" 
                           target="_blank" 
                           aria-label="<?php echo ucfirst( $key ); ?>" 
                           rel="noopener"></a> 
                        <?php
                    endif;
                endforeach;
            ?>
            </div>
    <?php
    endif;

    return ob_get_clean();

}