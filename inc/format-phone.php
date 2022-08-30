<?php 
/*
 * Format Phone Number
 */

function tm_format_phone( $number, $format = '' ) {

    if ( $format === 'href' ) {
        $pattern = [ '/^1?\s+/', '/\-|\s+/', '(poste)' ];
        $replace = [ '', '', ',' ];
    } else {
        $pattern = [ '/\-+/', '/\s+/' ];
        $replace = [ '&#8209;', '&nbsp;' ];
    }

    $output = preg_replace( $pattern, $replace, $number );
    if ( $format === 'href' ) $output = 'tel:+1' . $output;

    echo $output;

}