<?php get_header();
/*
 * 404
*/
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-404'); ?>>

    <?php  echo get_slider(); ?>

    <section class="tm-404__title section">
        <div class="text-block">
            <h2 class="text-block__small text-block__small--yellow-l">404</h2>
            <h1 class="text-block__big text-block__big--yellow-d">Contenu introuvable</h1>
            <p class="text-block__body">Nous sommes désolés. Aucun contenu n'a été trouvé.</p>
            <p class="text-block__body">Vous pouvez essayer le formulaire de recherche suivant :</p>
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="tm-search-small__form tm-search-small__form--404">
                <input type="submit" class="tm-search-small__form-submit">
                <input type="text" class="tm-search-small__input" name="s" placeholder="Rechercher">
            </form>
        </div>        
    </section>

</main>

<?php get_footer(); ?>
