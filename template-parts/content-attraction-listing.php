<?php 

get_header();

$post_id = get_the_ID();
$cat_id = 0;
$subtitle = 'Attraits et activités';
$title = 'À la découverte de notre belle région!';
$mode = $_GET['mode'];
$active_map = $mode === 'carte' ? true : false;

if ( is_archive() ) {
    $post_id = get_queried_object_id();
    $cat = get_queried_object();
    $cat_id = $cat->term_id;
    // $post_type = ucfirst( $post->post_type );
    // $post_type = _nx( $post_type, $post_type . 's', 2, 'Attraction name', TM_DOMAIN );
    // $subtitle = $post_type;
    $title = $cat->name;
}

?>
<main id="post-<?php echo $post_id; ?>" <?php post_class('main tm-attract'); ?>>

    <?php echo get_slider( $post_id ); ?>

    <section class="tm-attract__title section">

        <div class="text-block text-block--right">
            <h2 class="text-block__small text-block__small--yellow-l"><?php echo $subtitle; ?></h2>
            <h1 class="text-block__big text-block__big--yellow-d"><?php echo $title; ?></h1>
            <?php if ( !is_archive() ): ?>
                <div class="text-block__body"><?php the_content(); ?></div>
            <?php endif; ?>
        </div>

    </section>

    <section class="tm-attract__filters filters">        
        <div class="filters__header">
            <ul class="filters__modes">
                <li class="filters__mode filters__mode--cards<?php echo !$active_map ? ' active' : ''; ?>" id="filters-mode-cards" data-target="#tm-attract-cards" aria-label="Afficher la liste des attraits"></li>
                <li class="filters__mode filters__mode--map<?php echo $active_map ? ' active' : ''; ?>" id="filters-mode-map" data-target="#tm-attract-map" aria-label="Afficher les attraits sur la carte"></li>
            </ul>
            <p class="filters__results" id="results-count"></p>
            <a href="#" class="filters__toggler" id="filters-toggler"></a>
        </div>
        <div class="filters__content" id="filters-content">
            <?php echo get_attract_categories(); ?>
        </div>  
    </section>

    <section class="tm-attract__items">        
        <div class="tm-attract__item cards<?php echo !$active_map ? ' active' : ''; ?>" id="tm-attract-cards">
            <div class="cards__listing" id="listing" data-post-type="attraction" data-initial-cat="<?php echo $cat_id; ?>"></div>
            <?php echo get_load_more_btn( 'blue', 'attraction', $cat_id ); ?>
        </div>         
        <div class="tm-attract__item tm-map<?php echo $active_map ? ' active' : ''; ?>" id="tm-attract-map"></div>   
    </section>

</main>

<?php get_footer(); ?>