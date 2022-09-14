<?php
/*
 * Filter: Text
 */

add_filter( 'the_title', 'tm_text_format', 10, 2 );
add_filter( 'the_content', 'tm_text_format', 10, 2 );
add_filter( 'the_excerpt', 'tm_text_format', 10, 2 );

function tm_text_format( $str ) {

    $pattern = [
        '/«\s+(.+)\s+»/',
        '/\s+(!|\?)/',
        '/\s+([h|:|$|%]+)([\s|\.|\!|\?]+)/'
    ];
    $replace = [
        '«&nbsp;$1&nbsp;»',
        '&nbsp;$1',
        '&nbsp;$1$2'
    ];
    $str = preg_replace( $pattern, $replace, $str );

    return $str;

}