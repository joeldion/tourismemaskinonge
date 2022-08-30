<?php
    $id = get_the_ID();
    get_header(); 
?>
<main id="post-<?php echo $id; ?>" <?php post_class('main tm-attract tm-attract--single'); ?>>

    <?php echo get_slider( $id ); ?>

    <section class="tm-attract__title tm-attract__title--single section">

        <div class="text-block text-block--right">
            <h2 class="text-block__small text-block__small--blue-l"><?php echo get_attract_primary_cat( $id, true ); ?></h2>
            <h1 class="text-block__big text-block__big--blue-d"><?php the_title(); ?></h3>
            <?php echo get_post_contact_info( 'attraction', 'blue', 'yellow' ); ?>
        </div>

    </section>
    
    <section class="tm-attract__post section">
        <div class="tm-post tm-post--attract">

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
            
            <?php echo get_related_attractions( $id ); ?>

        </div>
        
    </section>

</main>

<?php get_footer(); ?>
