<?php 
/*
 * Trim Text
 */

function tm_trim_text( $text, $limit = 40 ) {
    return mb_strimwidth( $text, 0, $limit, '...' );
}