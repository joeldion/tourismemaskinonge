<?php
/*
 * Teasers
 */

add_settings_section(
    'home-settings-teasers-section',
    esc_html( _nx( 'Teaser', 'Teasers', 2, 'Teasers name', TM_DOMAIN ) ),
    'home_teasers_settings_section_callback',
    'home-settings-page'
);

// Teasers
for ( $i = 1; $i <= 5; $i++ ) {

    add_settings_field(
      'home_teaser_' . $i,
      esc_html( _nx( 'Teaser', 'Teasers', 1, 'Teasers name', TM_DOMAIN ) ) . ' #' . $i,
      'home_teasers_markup',
      'home-settings-page',
      'home-settings-teasers-section',
      [ 'index' => $i ]
    );

    register_setting( 
        'home-settings', 
        'home_teaser_' . $i,
        [
            'sanitize_callback' =>  'home_teasers_sanitize'
        ]
    );
    
}

function home_teasers_sanitize( $input ) {

    $input = json_decode( $input, true );
    $clean_title = sanitize_text_field( $input['title'] );
    $clean_link = esc_url( $input['link'] );
    $clean_color = sanitize_text_field( $input['color'] );
    $input['title'] = $clean_title;
    $input['link'] = $clean_link;
    $input['color'] = $clean_color;
    return serialize( $input );

}

function home_teasers_settings_section_callback() {}

function home_teasers_markup( $args ) {

    $i = $args[ 'index' ];
    $teaser = unserialize( get_option( 'home_teaser_' . $i ) );
    $colors = [ 'blue', 'green', 'yellow' ];
    ?>  
    <div class="home-teaser">

        <?php get_image_media_uploader( $teaser['image'], 'home-teaser-image-' . $i ); ?>  

        <p><?php esc_html_e( 'Title' ); ?></p> 
        <input type="text" id="home-teaser-title-<?php echo $i; ?>" name="home_teaser_title_<?php echo $i; ?>" size="60" maxlength="10" value="<?php echo $teaser['title']; ?>"><br><br>

        <p><?php esc_html_e( 'Link' ); ?></p> 
        <input type="url" id="home-teaser-link-<?php echo $i; ?>" name="home_teaser_link_<?php echo $i; ?>" size="60" value="<?php echo $teaser['link']; ?>"><br><br>
        
        <p><?php esc_html_e( 'Color' ); ?></p> 
        <select id="home-teaser-color-<?php echo $i; ?>" name="home_teaser_color_<?php echo $i; ?>">
            <?php foreach ( $colors as $color ): ?>
                <option value="<?php echo $color; ?>" <?php selected( $color, $teaser['color'], true ); ?>>
                    <?php esc_html_e( ucfirst( $color ) ); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="hidden" id="home-teaser-<?php echo $i; ?>" name="home_teaser_<?php echo $i; ?>">

    </div>
    <?php
    
}