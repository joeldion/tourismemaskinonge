<?php
/*
** Detect Mobile Devices
*/
function is_mobile() {

    $agent = $_SERVER[ 'HTTP_USER_AGENT' ];
    $is_mobile = false;

    if ( strpos( $agent, 'Mobile' ) !== false
        // many mobile devices (all iPhone, iPad, etc.)
        || strpos( $agent, 'Android' ) !== false
        || strpos( $agent, 'Silk/' ) !== false
        || strpos( $agent, 'Kindle' ) !== false
        || strpos( $agent, 'BlackBerry' ) !== false
        || strpos( $agent, 'Opera Mini' ) !== false
        || strpos( $agent, 'Opera Mobi' ) !== false) {

        $is_mobile = true;

    }

    return $is_mobile;

}
