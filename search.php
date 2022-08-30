<?php get_header();
/*
 * Search Results
*/

$query = "s=$s&showposts=-1";
$post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : null;
if ( !empty( $post_type ) ) $query .= "&post_type=" . $post_type;
$search = new WP_Query("s=$s&showposts=-1");
// $key = esc_html( $s, 1 ); 
$count = $search->post_count; 
$results_text = _nx( 'result for', 'results for', $count, 'default search results', TM_DOMAIN ); 

switch ( $post_type ) {
    case 'post':
        $results_text = _nx( 'post with', 'posts with', $count, 'posts search results', TM_DOMAIN ); 
        break;
    case 'tm_event':
        $results_text = _nx( 'event with', 'events with', $count, 'events search results', TM_DOMAIN );
        break; 
    case 'attraction':
        $results_text = _nx( 'attraction with', 'attractions with', $count, 'attractions search results', TM_DOMAIN );
        break; 
}

if ( $count === 0 ) $count = esc_html_x( 'No', 'no results', TM_DOMAIN );
wp_reset_query(); 
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-search'); ?>>

    <?php echo get_slider(); ?>

    <section class="tm-search__title section">

        <div class="text-block">
            <h1 class="text-block__small text-block__small--yellow-l"><?php esc_html_e( 'Search', TM_DOMAIN ); ?></h1>
            <h2 class="text-block__big text-block__big--yellow-d">
                <?php echo $count . '&nbsp;' . esc_html( $results_text ); ?> «&nbsp;<?php echo wp_trim_words( get_search_query(), 5, '...' ); ?>&nbsp;»
            </h2>
        </div>

    </section>

    <section class="tm-search__results section">
        <?php echo get_search_results_listing(); ?>
    </section>

</main>

<?php get_footer(); ?>