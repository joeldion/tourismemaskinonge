<?php

/*
 * Custom Image Sizes
*/
function tm_image_sizes() {
    add_image_size( 'tm-slide', 1920, 1190, true );
    add_image_size( 'tm-slide-2x', 3840, 2380, true );
    add_image_size( 'tm-post', 720, 720, true );
    add_image_size( 'tm-post-2x', 1440, 1440, true );
    add_image_size( 'tm-card', 390, 570, true );
    add_image_size( 'tm-card-2x', 780, 1140, true );
    add_image_size( 'tm-thumb', 140, 140, true );
    add_image_size( 'tm-thumb-2x', 280, 280, true );
    
    add_filter('big_image_size_threshold', '__return_false');
}
add_action('after_setup_theme', 'tm_image_sizes');

function remove_default_image_sizes() {
    remove_image_size('thumbnail');
    remove_image_size('medium');
    remove_image_size('medium_large');
    // remove_image_size('large');
}
add_action('init', 'remove_default_image_sizes');


function tm_srcset( $post_id, $img_ext = '' ) {

    $id = get_post_thumbnail_id($post_id);
    $srcset;
    $webp = $img_ext === 'webp' ? '.webp' : '';

    $srcset_thumb   = wp_get_attachment_image_src($id, 'tm-thumb')[0] . $webp . ' 1x, ';
    $srcset_thumb  .= wp_get_attachment_image_src($id, 'tm-thumb-2x')[0] . $webp . ' 2x, ';

    $srcset_card    = wp_get_attachment_image_src($id, 'tm-card')[0] . $webp . ' 1x, ';
    $srcset_card   .= wp_get_attachment_image_src($id, 'tm-card-2x')[0] . $webp . ' 2x, ';

    $srcset_post    = wp_get_attachment_image_src($id, 'tm-post')[0] . $webp . ' 1x, ';
    $srcset_post   .= wp_get_attachment_image_src($id, 'tm-post-2x')[0] . $webp . ' 2x, ';

    $srcset_slide    = wp_get_attachment_image_src($id, 'tm-slide')[0] . $webp . ' 1x, ';
    $srcset_slide   .= wp_get_attachment_image_src($id, 'tm-slide-2x')[0] . $webp . ' 2x ';

    $srcset = [
        'thumb' => $srcset_thumb,
        'card'  => $srcset_card,
        'post'  => $srcset_post,
        'slide' => $srcset_slide
    ];

    return $srcset;
}
