<?php 
/*
 * Remove base url
 */

function tm_remove_base_url( $url ) {
    return str_replace( get_site_url(), '', $url ); 
}