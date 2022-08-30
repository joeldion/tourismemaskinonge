<?php get_header(); ?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-home'); ?>>

    <!-- <div class="slider">
        <div class="slide slide-01"></div>
    </div> -->
    <?php echo get_slider( get_the_ID() ); ?>

    <section class="tm-home__intro section">

        <div class="text-block">
            <?php /*<h3 class="text-block__small text-block__small--blue-l"><?php esc_html_e( get_option( 'home_intro_subtitle' ) ); ?></h3>*/ ?>
            <h1 class="text-block__big text-block__big--blue-d"><?php esc_html_e( get_option( 'home_intro_title' ) ); ?></h1>
            <div class="text-block__body">
                <?php echo wpautop( get_option( 'home_intro_text' ) ); ?>
            </div>
            <a href="<?php esc_html_e( get_option( 'home_intro_btn_link' ) ); ?>" class="btn btn--blue btn--more"><?php esc_html_e( get_option( 'home_intro_btn_text' ) ); ?></a>
        </div>

        <a href="<?php echo get_site_url(); ?>/categories-attraits/gourmand/" class="teaser teaser--blue teaser--gourmand">
            <h3 class="teaser__title teaser__title--blue">Gourmand</h3>
        </a>        
        <a href="<?php echo get_site_url(); ?>/categories-attraits/nature/" class="teaser teaser--green teaser--nature">
            <h3 class="teaser__title teaser__title--green">Nature</h3>
        </a>
        <a href="<?php echo get_site_url(); ?>/categories-attraits/dormir/" class="teaser teaser--yellow teaser--dormir">
            <h3 class="teaser__title teaser__title--yellow">Où dormir</h3>
        </a>
        <a href="<?php echo get_site_url(); ?>/categories-attraits/culture/" class="teaser teaser--yellow teaser--culture">
            <h3 class="teaser__title teaser__title--yellow">Culture</h3>
        </a>
        <a href="<?php echo get_site_url(); ?>/categories-attraits/manger/" class="teaser teaser--blue teaser--manger">
            <h3 class="teaser__title teaser__title--blue">Où manger</h3>
        </a>
             
    </section>

    <section class="tm-home__attractions section">
        
        <div class="text-block">
            <h3 class="text-block__small text-block__small--yellow-d">Attraits et activités</h3>
            <h1 class="text-block__big text-block__big--yellow-l">À la découverte de notre belle région&nbsp;!</h1>
            <p class="text-block__body">Agrotourisme, culture, plein air : les attraits et activités sont diversifiés dans la région. Que ce soit pour planifier son week-end ou pour prévoir ses vacances estivales, Maskinongé offre une panoplie d’activités et d’attraits à découvrir.</p>
            <a href="<?php echo get_site_url(); ?>/attraits/" class="btn btn--yellow btn--more">Voir plus</a>
        </div>

        <?php echo get_card_slider( 'attraction', 'yellow', 'right' ); ?>

    </section>

    <section class="tm-home__events section">

        <div class="text-block">
            <h3 class="text-block__small text-block__small--yellow-d">Événements</h3>
            <h1 class="text-block__big text-block__big--yellow-l">Plusieurs événements à venir bientôt&nbsp;!</h1>
            <p class="text-block__body">Pour demeurer au courant des événements et activités dans la région, consultez régulièrement notre site web. Restez à l’affût! Ça bouge dans Maskinongé!</p>
            <a href="<?php echo get_site_url(); ?>/evenements/" class="btn btn--yellow btn--more">Voir plus</a>
        </div>

        <div class="cards">
            <?php echo get_events_listing(3); ?>
        </div>

    </section>

    <section class="tm-home__blog section">

        <div class="text-block">
            <h3 class="text-block__small text-block__small--blue-l">Blogue</h3>
            <h1 class="text-block__big text-block__big--blue-d">Envie d'en apprendre plus sur notre région ?</h1>
            <p class="text-block__body">L’équipe de Tourisme Maskinongé vous fait plusieurs suggestions d’activités et de sorties pour vous inspirer et planifier votre prochaine visite dans la région.</p>
            <a href="<?php echo get_site_url(); ?>/blogue/" class="btn btn--blue btn--more">Voir plus</a>
        </div>

        <?php //echo get_card_slider( 'post', 'blue', 'left' ); ?>
        <?php echo get_card_slider( 'post', 'blue', 'right', 'date' ); ?>

    </section>

</main>
<?php get_footer(); ?>
