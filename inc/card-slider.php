<?php
/*
 * Card Slider
 */

function get_card_slider( $post_type, $color, $direction = 'right', $orderby = 'title' ) {

    ob_start();

    $order = $orderby === 'title' ? 'asc' : 'desc';
    $args = [
        'post_type'    =>  $post_type,
        'post_status'  =>  'publish',
        'order'        =>  $order,
        'orderby'      =>  $orderby,
        //'post__in'     =>  array_rand( array_flip( get_attract_ids() ), 6 ) 
    ];

    if ( $post_type === 'attraction' ) { 
        $args['post__in'] = array_rand( array_flip( get_attract_ids() ), 6 );
    } else {
        $args['posts_per_page'] = 6;
    }

    $cards = new WP_Query( $args );
    $position = $direction === 'right' ? 0 : 3; 
    //$offset = $direction === 'right' ? 0 : -100;

    if ( $cards->have_posts() ):
    ?>
        <div class="cards cards--has-slider">
            <a href="#" class="nav-icon nav-icon--<?php echo $color; ?> nav-icon--left<?php echo $direction === 'left' ? ' active' : ''; ?>"></a>   
            <div class="cards__slider<?php echo $direction === 'left' ? ' cards__slider--left' : ''; ?>" 
                 data-position="" data-direction="<?php echo $direction; ?>">
                <?php
                    while ( $cards->have_posts() ) {
                        $cards->the_post();
                        $card = new TMCard( get_the_ID(), $post_type );
                        echo $card->output();
                    }
                ?>            
            </div>
            <a href="#" class="nav-icon nav-icon--<?php echo $color; ?> nav-icon--right<?php echo $direction === 'right' ? ' active' : ''; ?>"></a>
        </div>        
    <?php
    endif;

    return ob_get_clean();

}