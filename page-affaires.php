<?php get_header();
/*
 * Template Name: Tourisme d'affaires
*/
$id = get_the_ID();
$subtitle = esc_html( get_post_meta( $id, '_tm_page_subtitle', true ) );
$btn_text = esc_html( get_post_meta( $id, '_tm_page_btn_text', true ) );
$btn_link = esc_url( get_post_meta( $id, '_tm_page_btn_link', true ) );
$section_featured_small_text = esc_html(get_post_meta( $id, '_tm_locations_featured_small_text', true ) );
$section_featured_big_text = esc_html( get_post_meta( $id, '_tm_locations_featured_big_text', true ) );
$section_featured_text = esc_html( get_post_meta( $id, '_tm_locations_featured_text', true ) );
$section_others_small_text = esc_html( get_post_meta( $id, '_tm_locations_others_small_text', true ) );
$section_others_big_text = esc_html( get_post_meta( $id, '_tm_locations_others_big_text', true ) );
$section_others_text = esc_html( get_post_meta( $id, '_tm_locations_others_text', true ) );
$section_others_btn_text = esc_html( get_post_meta( $id, '_tm_locations_others_btn_text', true ) );
$section_others_btn_link = esc_url( get_post_meta( $id, '_tm_locations_others_btn_link', true ) );
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-affaires'); ?>>

    <?php echo get_slider( get_the_ID() ); ?>

    <section class="tm-affaires__title section">

        <div class="text-block">
            <h1 class="text-block__small text-block__small--blue-d"><?php the_title(); ?></h1>
            <h2 class="text-block__big text-block__big--blue-d"><?php echo $subtitle; ?></h2>
            <div class="text-block__body"><?php the_content(); ?></div>
            <?php if ( !empty( $btn_link ) ): ?> 
                <a href="<?php echo $btn_link; ?>" class="btn btn--blue btn--more"><?php echo $btn_text; ?></a>
            <?php endif; ?>
        </div>

    </section>

    <section class="tm-affaires__post section">

        <div class="tm-post tm-post--affaires">

            <picture class="tm-post__thumbnail tm-post__thumbnail--right">

                <div class="bubble bubble--green bubble--bottom-left bubble--large">            
                   <ul class="bubble__content">
                        <?php
                            $bullets = unserialize( get_post_meta( get_the_ID(), '_tm_bullets', true ) );
                            foreach( $bullets as $bullet ) {
                                echo '<li>' . $bullet . '</li>';
                            }
                        ?>
                   </ul>
                </div>
                <?php 
                    the_post_thumbnail(
                        'tm-post',
                        [
                            'title'  => get_the_title(),
                            'srcset' => tm_srcset( $id )['post'],
                        ]
                    ); 
                ?>

            </picture>

            <div class="tm-post__content text">
                <div class="text-block">
                <h4 class="text-block__small text-block__small--yellow-d"><?php echo $section_featured_small_text; ?></h4>
                    <h3 class="text-block__big"><?php echo $section_featured_big_text; ?></h3>
                    <div class="text-block__body text-block__body--black">
                        <p><?php echo $section_featured_text; ?></p>
                    </div>
                </div>      
            </div>

        </div>

        <div class="features">

            <?php
                $args = [
                    'post_type'     =>  'attraction',
                    'post_status'   =>  'publish',
                    'orderby'       =>  'title',
                    'order'         =>  'asc',
                    'meta_query'    =>  [
                                            [
                                                'key'   =>  '_tm_attract_business_featured',
                                                'value' =>  '1'
                                            ],
                                        ],
                ];
                $posts = new WP_Query( $args );
                $featured_posts = [];

                while ( $posts->have_posts() ): $posts->the_post();

                    $id = get_the_ID();
                    $featured_img = intval( get_post_meta( $id, '_tm_attract_business_image', true ) );
                    $featured_text = esc_html( get_post_meta( $id, '_tm_attract_business_text', true ) );
                    $featured_link = esc_url( get_post_meta( $id, '_tm_attract_business_link', true ) );
                    array_push( $featured_posts, $id );

                ?>
                    <div class="feature">
                        <div class="feature__image" style="background-image: url(<?php echo wp_get_attachment_image_url( $featured_img, 'tm-card' ); ?>)" data-image-2x="<?php echo wp_get_attachment_image_url( $featured_img, 'tm-card-2x' ); ?>">
                        </div>
                        <div class="feature__text">
                            <p><?php echo $featured_text; ?></p>
                        </div>       
                        <a href="<?php echo $featured_link; ?>" target="_blank" class="feature__btn btn btn--yellow btn--more">En savoir plus</a>       
                    </div>
                <?php
                endwhile;
            ?>

        </div>

    </section>

    <section class="tm-affaires__title tm-affaires__title--secondary section">

        <div class="text-block text-block--right">
            <h4 class="text-block__small text-block__small--yellow-d"><?php echo $section_others_small_text; ?></h4>
            <h3 class="text-block__big text-block__big--yellow-l"><?php echo $section_others_big_text; ?></h3>
            <div class="text-block__body">
                <p><?php echo $section_others_text; ?></p>                
            </div>
            <a href="<?php echo $section_others_btn_link; ?>" class="btn btn--yellow btn--more"><?php echo $section_others_btn_text; ?></a>
        </div>

    </section>

    <section class="tm-affaires__items section">
        <div class="cards">
            <div class="cards__listing">
               <?php echo tm_load_listing( 'business', $featured_posts, false ); ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
