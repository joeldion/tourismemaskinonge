<?php
/*
 * Filter: Search
 */

// add_filter( 'get_search_query', 'tm_search_exclusions', 10, 2 );

function tm_search_exclusions( $query ) {

    $str = preg_replace( '/^(l\'|l’)?[a-z]+/gmi', '', $str );
    return $str;

}