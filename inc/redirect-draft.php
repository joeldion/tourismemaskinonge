<?php
/*
 * Redirect draft posts
 */

function tm_redirect_draft() {

    if ( !current_user_can( 'edit_pages' ) ) {

	    if ( is_404() ) {

	        global $wp_query, $wpdb;
	        $page_id = $wpdb->get_var( $wp_query->request );
	        $post_status = get_post_status( $page_id );
			
	        if ( $post_status == 'draft' ) {
	            wp_redirect( home_url(), 302 );
	            die();
	        }

	    }

	}

}
add_action( 'wp', 'tm_redirect_draft' );