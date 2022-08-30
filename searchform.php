<?php
/*
 * Search Form
 * use "get_search_form()" to show form
 */
?>
<form id="search-form" class="tm-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
    <span id="tm-search-close" class="tm-search-close">&#43;</span>
    <input type="submit" id="tm-search-submit" class="tm-search-submit" value="" aria-label="<?php esc_html_e( 'Send', TM_DOMAIN ); ?>">
    <input type="text" id="tm-search-input" class="tm-search-input" name="s" placeholder="<?php esc_html_e( 'Search', TM_DOMAIN ); ?>"
    value="<?php echo get_search_query(); ?>">               
</form>