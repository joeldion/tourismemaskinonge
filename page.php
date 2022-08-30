<?php
    $id = get_the_ID();
    get_header(); 
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-default'); ?>>

    <?php echo get_slider( $id ); ?>

    <section class="tm-default__title tm-default__title--single section">

        <div class="text-block">
            <h2 class="text-block__small text-block__small--yellow-d">
                <?php esc_html_e( get_post_meta( $id, '_tm_page_subtitle', true ) ); ?>
            </h2>
            <h1 class="text-block__big text-block__big--yellow-l"><?php the_title(); ?></h3>
        </div>

    </section>

    <section class="tm-default__post section">
        <div class="tm-post">

            <picture class="tm-post__thumbnail">
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
                <?php the_content(); ?>
            </div>

            <div class="tm-post__sidebar">

                <div class="tm-post__share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" id="facebook-share" class="btn btn--yellow btn--facebook"><?php esc_html_e( 'Share', TM_DOMAIN ); ?></a>
                </div>
            
            </div>
        </div>
        
    </section>
    
</main>

<?php get_footer(); ?>
