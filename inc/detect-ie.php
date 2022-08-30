<?php
/*
 * Internet Explorer Detection
 */

function is_IE() {
    if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
        return true;
    }
}

function is_old_safari() {
    
    $browser = get_browser(null, true);
    $browser_name = $browser['browser'];
    $browser_version = intval( $browser['version'] );

    if ( $browser_name === 'Safari' && $browser_version < 13 ) {
        //...
    }

}

function tm_ie_modal() {

    ob_start();
    ?>
    <style>
        body.is_ie { 
            overflow: hidden; 
            display: flex;
            justify-content: center;
        }
    </style>
    <div class="ie-modal">
        <h3>Votre navigateur est désuet</h3>
        <p>Pour voir cette page, vous devez utiliser un navigateur moderne tel que <a href="https://www.google.com/intl/fr_CA/chrome/" rel="noopener" target="_blank">Google Chrome</a>, <a href="https://www.mozilla.org/fr/firefox/new/" rel="noopener" target="_blank">Mozilla Firefox</a> ou <a href="https://www.microsoft.com/fr-fr/edge" rel="noopener" target="_blank">Microsoft Edge</a>.</p>
    </div>
    <div class="ie-modal__overlay"></div>
    <?php
    return ob_get_clean();
    
}

function tm_ie_body_class( $classes ) {

    if ( is_IE() ) {
        $classes[] = 'is_ie';
    }
    return $classes;

}
add_filter( 'body_class', 'tm_ie_body_class' );

