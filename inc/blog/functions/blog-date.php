<?php 

/*
 * Blog Date
 */

function get_blog_date( $post_id ) {

    // return get_the_date( 'j F Y', $post_id );
    return mb_strtolower( preg_replace( '/^1 /', '1er ', get_the_time('j F Y') ) );

}