<?php get_header();
/*
 * Template Name: Cartes et brochure
*/
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-brochure'); ?>>

    <?php echo get_slider( get_the_ID() ); ?>

    <section class="tm-brochure__title section">

        <div class="text-block text-block--right">
            <h1 class="text-block__small text-block__small--yellow-l"><?php the_title(); ?></h1>
            <h2 class="text-block__big text-block__big--yellow-d"><?php esc_html_e( get_post_meta( get_the_ID(), '_tm_page_subtitle', true ) ); ?></h2>
            <div class="text-block__body"><?php the_content(); ?></div>
        </div>

    </section>

    <section class="tm-brochure__post">

        <div class="tm-brochure__listing">

            <a href="<?php echo get_site_url(); ?>/wp-content/uploads/2022/06/mrc-maskinonge-carte-touristique-imagee.pdf?v=20220607" class="card card--brochure has-retina" style="background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2022/06/carte-touristique-imagee-1x.jpg)" data-image-2x="http://localhost/tourismemaskinonge/wp-content/uploads/2022/06/carte-touristique-imagee-2x.jpg" target="_blank">
                <div class="card__text">
                    <h4 class="card__text-1">Carte touristique imagée de la MRC de Maskinongé</h4>
                </div>
            </a>

            <a href="<?php echo get_site_url(); ?>/wp-content/uploads/2022/06/mrc-maskinonge-carte-velo-tourisme.pdf?v=20220607" class="card card--brochure" style="background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2022/04/carte-velo-2022.jpg)" target="_blank">
                <div class="card__text">
                    <h4 class="card__text-1">Carte des réseaux cyclables et entreprises touristiques dans la MRC de Maskinongé</h4>
                </div>
            </a>

        </div>

        <div class="tm-side-box__wrapper">
            <div class="tm-side-box__content">
                <div class="tm-side-box tm-side-box--blue">            
                    <div class="text-block">
                        <h4 class="text-block__small text-block__small--yellow-l">Cartes et brochures</h4>
                        <h3 class="text-block__big text-block__big--yellow-d">Vous préférez consulter une version papier ?</h3>
                        <a href="mailto:info@tourismemaskinonge.com" class="btn btn--yellow btn--cta">Commander</a>
                    </div>                
                </div>
            </div>            
        </div>

    </section>

</main>

<?php get_footer(); ?>
