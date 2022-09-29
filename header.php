<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">  
        <link rel="icon" href="<?php echo get_home_url(); ?>/favicon.ico" type="image/x-icon" />       
        <?php wp_head(); ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-H710YVP99W"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-H710YVP99W');
        </script>
    </head>
    <body <?php body_class('container'); ?>>

        <?php
            // Modal for deprecated IE
            if ( is_IE() ) {
                echo tm_ie_modal();
                exit();
            }

            // Show modal on new session
            if ( !$_SESSION['tm-modal-202210'] ) {
                $_SESSION['tm-modal-202210'] = true;
                echo tm_get_modal();
            }
            // if ( current_user_can('administrator') ) {
            //     echo tm_get_modal();
            // }
        ?>

        <header class="header" role="banner">
            <div class="header__logo">
                <a href="<?php echo get_home_url(); ?>" aria-label="<?php esc_html_e('Home', 'tourismemaskinonge'); ?>">
                    <img src="<?php echo TM_URL; ?>/img/logos/logo-tourisme-maskinonge.svg" alt="Logo - Tourisme Maskinongé" height="105" width="306">
                </a>
            </div>
            <div class="header__nav" role="navigation">

                <div class="nav nav--small">
                    <?php
                        $args = [
                            'theme_location'        => 'main-menu-small',
                            'menu_id'               => 'main-menu-small',
                            'container'             => 'nav',
                            'container_class'       =>  'nav__list',
                            'container_aria_label'  =>  'Menu principal - petit'                            
                        ];
                        wp_nav_menu($args);
                    ?>
                    <div class="nav__icons">
                        <a class="nav__icon nav__icon--search" id="search-toggler" aria-label="<?php echo esc_html_x( 'Search', 'Search verb', TM_DOMAIN ); ?>" href="#"></a>
                        <?php /* <a class="nav__icon nav__icon--heart" aria-label="Coups de coeur" href="#"></a> */ ?>                    
                        <a class="nav__icon nav__icon--facebook hidden" aria-label="Facebook" href="<?php echo esc_url( get_option( 'contact_info_facebook' ) ); ?>" target="_label"></a>
                        <a class="nav__icon nav__icon--instagram hidden" aria-label="Instagram" href="<?php echo esc_url( get_option( 'contact_info_instagram' ) ); ?>" target="_label"></a>
                        <a class="nav__icon nav__icon--question" 
                           aria-label="<?php echo get_the_title( get_option( 'contact_info_page' ) ); ?>" 
                           href="<?php echo tm_remove_base_url( get_permalink( get_option( 'contact_info_page' ) ) ); ?>">
                        </a>
                    </div>
                    
                </div>
                
                <div class="nav nav--large">
                    <?php                        
                        $args = [
                            'theme_location'        => 'main-menu-large',
                            'menu_id'               => 'main-menu-large',
                            'container'             => 'nav',
                            'container_class'       =>  'nav__list',
                            'container_aria_label'  =>  'Menu principal - grand'                            
                        ];
                        wp_nav_menu($args);
                    ?>
                </div>

                <div class="nav nav__toggler"></div>
                
            </div>
        </header>

        <div class="tm-search-popup">
            <?php get_search_form(); ?>
        </div>
