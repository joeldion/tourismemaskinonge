<?php
$id = get_the_ID();
$categories = get_the_terms( $id, 'tm_event_category' );
get_header(); 
?>

<main id="post-<?php echo $id; ?>" <?php post_class('main tm-event tm-event--single'); ?>>

    <?php echo get_slider( $id ); ?>

    <section class="tm-event__title tm-event__title--single section">

        <div class="text-block">
            <h2 class="text-block__small text-block__small--yellow-l"><?php echo get_single_event_categories( $id ); ?></h2>
            <h1 class="text-block__big text-block__big--yellow-d"><?php the_title(); ?></h3>
            <?php echo get_event_info(); ?>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" id="facebook-share" class="btn btn--yellow btn--facebook">Partager</a>
        </div>
    </section>
    
    <section class="tm-event__post section">
        <div class="tm-post tm-post--event">

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
                <h5>Information :</h5>           
                <?php echo get_post_contact_info( 'tm_event', 'blue', 'white' ); ?>            
            </div>
              
            <?php echo get_related_events( $id, $categories[0] ); ?>
            
        </div>
        
    </section>

</main>

<?php get_footer(); ?>
