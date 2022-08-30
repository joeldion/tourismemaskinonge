<?php 
/*
 * Ajax: Map Locations
 */

add_action( 'wp_ajax_tm_get_map_locations', 'tm_get_map_locations' );
add_action( 'wp_ajax_nopriv_tm_get_map_locations', 'tm_get_map_locations' );

function tm_get_map_locations() {

    if ( $_POST['post_type'] === 'attraction' ):

        $tax_query = [];
        $category = $_POST['category'];
        if ( isset( $category ) && $category > 0 ) {
            $tax_query = [
                            [
                                'taxonomy'  =>  'attraction_category',
                                'field'     =>  'term_id',
                                'terms'     =>  $_POST['category']
                            ]
                        ];
        }

        $args = [
            'post_type'         =>  'attraction',
            'post_status'       =>  'publish',
            'posts_per_page'    =>  -1,
            'order'             =>  'asc',
            'orderby'           =>  'title',
            'meta_key'          =>  '_tm_attract_coord',
            'meta_value'        =>  null,
            'meta_compare'      =>  'NOT LIKE',
            'tax_query'         =>  $tax_query
        ];

        $posts = new WP_Query( $args );
        $response = (object)[];
        $response->locations = [];

        while ( $posts->have_posts() ): $posts->the_post();

            $id = get_the_ID();
            $address = esc_html( get_post_meta( $id, '_tm_attract_address', true ) );
            $city = esc_html( get_post_meta( $id, '_tm_attract_city', true ) );
            $postal_code = esc_html( get_post_meta( $id, '_tm_attract_postal_code', true ) );
            $full_address = $address . ', ' . $city . ' ' . $postal_code;
            $gmap_url = esc_url( get_post_meta( $id, '_tm_attract_gmap_url', true ) );            
            $coord = explode(',', esc_html( get_post_meta( $id, '_tm_attract_coord', true ) ) );            
            $lat = $coord[0];
            $lng = $coord[1];
            $phone = esc_html( get_post_meta( $id, '_tm_attract_phone_1', true ) );
            $website = esc_url( get_post_meta( $id, '_tm_attract_website', true ) );
            if ( empty($website) ) $website = esc_html( get_post_meta( $id, '_tm_attract_facebook', true ) );

            $data = [
                'title'     =>  get_the_title(),
                'address'   =>  $full_address,
                'gmap'      =>  $gmap_url,
                'phone'     =>  $phone,
                'website'   =>  $website,
                'lat'       =>  $lat,
                'lng'       =>  $lng
            ];

            if ( !empty( $address ) ) array_push( $response->locations, $data );


        endwhile;

        echo json_encode($response);
        // return json_encode($response);

        exit();

    endif;

}