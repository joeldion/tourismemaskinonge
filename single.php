<?php
    $id = get_the_ID();
    get_header(); 
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-blog tm-blog--single'); ?>>

    <?php echo get_slider( $id ); ?>

    <section class="tm-blog__title tm-blog__title--single section">

        <div class="text-block">
            <h2 class="text-block__small text-block__small--yellow-d">
                <?php echo esc_html__( 'Blog', TM_DOMAIN ) . '&nbsp;-&nbsp;' . get_blog_date( get_the_ID() ); ?>
            </h2>
            <h1 class="text-block__big text-block__big--yellow-l"><?php the_title(); ?></h3>
        </div>

    </section>

    <section class="tm-blog__post section">
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
                
                <div class="tm-post__related">
                    <h4 class="small-header small-header--blue"><?php esc_html_e( 'Also Read', TM_DOMAIN ); ?></h4>
                    <div class="cards cards--side">                   
                        <?php echo get_latest_blog_posts( $id, 6, 'small' ); ?>                                                        
                    </div> 
                </div>
            
            </div>
        </div>
        
    </section>
    
    <?php /*
    <section class="tm-blog__search">
        <a href="#" class="btn btn--yellow btn--selector">Toutes les catégories</a>
        <form action="#" class="tm-blog__form">
            <a href="#" class="tm-blog__form-submit"></a>
            <input type="text" class="tm-blog__input" placeholder="Rechercher un article">
        </form>
        <ul class="tm-blog__categories">
            <li><a class="tm-blog__category" href="#">Agrotourisme</a></li>
            <li><a class="tm-blog__category" href="#">Culture</a></li>
            <li><a class="tm-blog__category" href="#">Plein air</a></li>
        </ul>
    </section>
    */ ?>

</main>

<?php get_footer(); ?>
