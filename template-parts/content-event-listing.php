<?php 

get_header();

$post_id = get_the_ID();
$cat_id = 0;
$subtitle = get_the_title();
$title = esc_html( get_post_meta( $post_id, '_tm_page_subtitle', true ) );

if ( is_archive() ) {
    $post_id = get_queried_object_id();
    $cat = get_queried_object();
    $cat_id = $cat->term_id;
    $subtitle = _nx( 'Event', 'Events', 2, 'Event name', TM_DOMAIN ); 
    $title = $cat->name;
}
?>

<main id="post-<?php echo $post_id; ?>" <?php post_class('main tm-events'); ?>>

    <?php echo get_slider( $post_id ); ?>

    <section class="tm-events__title section">

        <div class="text-block text-block--right">
            <h2 class="text-block__small text-block__small--yellow-d"><?php echo $subtitle; ?></h2>
            <h1 class="text-block__big text-block__big--yellow-l"><?php echo $title; ?></h1>
            <div class="text-block__body">
                <?php if ( !is_archive() ) the_content(); ?>
            </div>
        </div>

    </section>

    <section class="tm-search-small tm-search-small--events">
 
        <div class="tm-search-small__sort">
            <a class="tm-search-small__select tm-search-small__select--large btn btn--yellow btn--selector">
                <select name="tm-search-small-sort-location" id="location-filter" data-post-type="tm_event">
                    <option value="" class="hidden" disabled="" selected="">Filtrer par municipalité</option>
                </select>
            </a>
        </div>
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="tm-search-small__form">
            <!-- <a href="#" class="tm-search-small__form-submit"></a> -->
            <input type="submit" class="tm-search-small__form-submit">
            <input type="text" class="tm-search-small__input" name="s" placeholder="Rechercher un événement">
            <input type="hidden" name="post_type" value="tm_event">
        </form>
        <?php echo get_events_categories(); ?>
     
    </section>

    <section class="tm-events__items">
        <div class="cards">
            <div class="cards__listing cards__listing--masonry" id="listing" data-post-type="tm_event" data-initial-cat="<?php echo $cat_id; ?>"></div>
            <input type="hidden" id="tm-events-cities" name="tm-events-cities">
            <?php echo get_load_more_btn( 'green', 'tm_event', $cat_id ); ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
