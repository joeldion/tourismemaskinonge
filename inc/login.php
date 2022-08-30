<?php
/*
 * Login Logo
*/

function tm_custom_login_logo() {
    ?>
    <style type="text/css">
        body {
            background: #fff !important;
        }
        h1 a {
            background-image:url(<?php echo TM_URL . '/img/logos/logo-tourisme-maskinonge.svg' ?>) !important;
            background-size: 100% !important;
            width: 200px !important;
            height: 80px !important;
        }
    </style>
    <?php
}
add_filter( 'login_head', 'tm_custom_login_logo' );
