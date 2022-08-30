<?php 

function tm_bem_nav_menu_css_class( $classes ) {

    // Reset all default classes and start adding custom classes to array.
    $_classes = [ 'menu__item' ];

    // Add 'has-children' class if menu element contains sub-menu
    if (in_array('menu-item-has-children', $classes) ){
        array_push( $_classes, 'has-children');
    }

    return $_classes;

}
add_filter( 'nav_menu_css_class', 'tm_bem_nav_menu_css_class', 10, 4 );
