<?php 
get_header(); 
$id = get_option( 'page_for_posts' );
?>

<main id="post-<?php echo $id; ?>" <?php post_class('main tm-blog'); ?>>

    <?php echo get_slider( $id ); ?>

    <section class="tm-blog__title section">

        <div class="text-block">
            <h1 class="text-block__small text-block__small--blue-l"><?php esc_html_e( 'Blog', TM_DOMAIN ); ?></h1>
            <h2 class="text-block__big text-block__big--blue-d"><?php esc_html_e( get_post_meta( $id, '_tm_page_subtitle', true ) ); ?></h2>  
        </div>

    </section>

    <section class="tm-search-small">
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="tm-search-small__form">
            <input type="submit" class="tm-search-small__form-submit">
            <input type="text" class="tm-search-small__input" name="s" placeholder="Rechercher un article">
            <input type="hidden" name="post_type" value="post">
        </form>
    </section>

    <section class="tm-blog__items">
        <div class="cards">
            <?php 
                echo get_latest_blog_posts( 0, 9 ); 
                echo get_load_more_btn( 'yellow' );
            ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
