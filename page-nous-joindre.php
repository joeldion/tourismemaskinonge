<?php get_header();
/*
 * Template Name: Nous joindre
*/
$id = get_the_ID();
$side_box_items = [ 
    [
        'name'      =>  'bit_mrc',
        'color'     =>  'green',
    ],
    [
        'name'      =>  'bat_st_alexis',
        'color'     =>  'blue',
        'position'  =>  'right'
    ],
    [
        'name'      =>  'bat_st_elie',
        'color'     =>  'yellow',
    ]

    // 'relais_st_mathieu',
    // 'parc_ursulines',
    // 'relais_st_edouard',
    // 'relais_st_paulin'
];
// $meta_boxes = tm_nous_joindre_meta_boxes_data();

?>

<main id="post-<?php echo $id; ?>" <?php post_class('main tm-joindre'); ?>>

    <?php echo get_slider( $id ); ?>

    <section class="tm-joindre__title section">

        <div class="text-block text-block--right">
            <h1 class="text-block__small text-block__small--blue-l"><?php the_title(); ?></h1>
            <h2 class="text-block__big text-block__big--blue-d"><?php esc_html_e( get_post_meta( $id, '_tm_page_subtitle', true ) ); ?></h2>
            <div class="text-block__body"><?php the_content(); ?></div>
        </div>

    </section>

    <section class="tm-joindre__post">

        <?php
            // foreach ( $side_box_items as $box ) {
            //     $side_box = new TMSideBox( $id, $box['name'], $box['color'] );
            //     echo $side_box->output();
            // }
        ?>

        <div class="tm-side-box__wrapper tm-side-box__wrapper--large">
            <div class="tm-side-box__content">
                <div class="tm-side-box tm-side-box--large tm-side-box--green">            
                    <div class="text-block">
                        <h4 class="text-block__small text-block__small--yellow-l"><?php esc_html_e( get_post_meta( $id, '_tm_bit_mrc_small_text', true ) ); ?></h4>
                        <h3 class="text-block__big text-block__big--yellow-d"><?php esc_html_e( get_post_meta( $id, '_tm_bit_mrc_big_text', true ) ); ?></h3>                     
                        <ul class="text-block__contact tm-contact">                          
                            <li class="tm-contact__item tm-contact__address tm-contact__address--yellow-d">
                                <a href="<?php echo esc_url( get_post_meta( $id, '_tm_bit_mrc_map_url', true ) ); ?>" class="tm-contact__link" target="_blank"><?php esc_html_e( get_post_meta( $id, '_tm_bit_mrc_address', true ) ); ?></a>
                            </li>                          
                            <li class="tm-contact__item tm-contact__phone_1 tm-contact__phone_1--yellow-d">
                                <a href="<?php tm_format_phone( esc_html( get_post_meta( $id, '_tm_bit_mrc_phone', true ) ), 'href' ); ?>" class="tm-contact__link"><?php tm_format_phone( esc_html( get_post_meta( $id, '_tm_bit_mrc_phone', true ) ) ); ?></a>
                            </li>
                            <li class="tm-contact__item tm-contact__email tm-contact__email--yellow-d">
                                <a href="mailto:<?php esc_html_e( get_post_meta( $id, '_tm_bit_mrc_email', true ) ); ?>" class="tm-contact__link">Écrivez-nous pour plus d'informations</a>
                            </li>                           
                        </ul>
                    </div>      
                    <div class="tm-side-box__map"></div>
                </div>
            </div>    
        </div>

        <div class="tm-side-box__wrapper tm-side-box__wrapper--large">
            <div class="tm-side-box__content tm-side-box__content--right">
                <div class="tm-side-box tm-side-box--large tm-side-box--blue tm-side-box--right">           
                    
                    <div class="text-block">
                        <h4 class="text-block__small text-block__small--yellow-d"><?php esc_html_e( get_post_meta( $id, '_tm_bat_st_alexis_small_text', true ) ); ?></h4>
                        <h3 class="text-block__big text-block__big--yellow-l"><?php esc_html_e( get_post_meta( $id, '_tm_bat_st_alexis_big_text', true ) ); ?></h3>
                        <ul class="text-block__contact tm-contact">                         
                            <li class="tm-contact__item tm-contact__address tm-contact__address--yellow-d">
                                <a href="<?php echo esc_url( get_post_meta( $id, '_tm_bat_st_alexis_map_url', true ) ); ?>" class="tm-contact__link" target="_blank"><?php esc_html_e( get_post_meta( $id, '_tm_bat_st_alexis_address', true ) ); ?></a>
                            </li>                          
                            <li class="tm-contact__item tm-contact__phone_1 tm-contact__phone_1--yellow-d">
                                <a href="tel:+18192654110" class="tm-contact__link">819&nbsp;265-4110</a>
                            </li>
                            <li class="tm-contact__item tm-contact__email tm-contact__email--yellow-d">
                                <a href="mailto:tourisme@saint-alexis-des-monts.ca" class="tm-contact__link">Écrivez-nous pour plus d'informations</a>
                            </li>  
                            <li class="tm-contact__item tm-contact__website tm-contact__website--yellow-d">
                                <a href="https://www.saint-alexis-des-monts.ca/fr/tourisme/bureau-d-accueil-touristique" class="tm-contact__link" target="_blank">saint-alexis-des-monts.ca</a>
                            </li>                         
                        </ul>
                    </div>   
                    <div class="tm-side-box__map"></div>   
                </div>
            </div>    
        </div>

        <div class="tm-side-box__wrapper tm-side-box__wrapper--large">
            <div class="tm-side-box__content">
                <div class="tm-side-box tm-side-box--large tm-side-box--yellow">            
                    <div class="text-block">
                        <h4 class="text-block__small text-block__small--blue-l">Saint-Élie-de-Caxton</h4>
                        <h3 class="text-block__big text-block__big--blue-d">Bureau d'accueil touristique</h3>
                        <ul class="text-block__contact tm-contact">                         
                            <li class="tm-contact__item tm-contact__address tm-contact__address--blue">
                                <a href="https://goo.gl/maps/fJHaygKpExVY9tu18" class="tm-contact__link" target="_blank">2191, rue Principale, Saint-Élie-de-Caxton (QC) G0X 2N0</a>
                            </li>                          
                            <li class="tm-contact__item tm-contact__phone_1 tm-contact__phone_1--blue">
                                <a href="tel:+18192212839" class="tm-contact__link">819&nbsp;221-2839</a>
                            </li>
                            <li class="tm-contact__item tm-contact__email tm-contact__email--blue">
                                <a href="mailto:tourisme@st-elie-de-caxton.ca" class="tm-contact__link">Écrivez-nous pour plus d'informations</a>
                            </li>
                            <li class="tm-contact__item tm-contact__website tm-contact__website--blue">
                                <a href="http://culturetourisme.st-elie-de-caxton.ca/" class="tm-contact__link" target="_blank">culturetourisme.st-elie-de-caxton.ca</a>
                            </li>                            
                        </ul>
                    </div>      
                    <div class="tm-side-box__map"></div>
                </div>
            </div>    
        </div>
        
        <div class="tm-directory">

            <div class="tm-directory__item">
                <div class="text-block">
                    <h4 class="text-block__small text-block__small--green-l">Saint-Mathieu-du-Parc</h4>
                    <h3 class="text-block__big text-block__big--green-d">Relais d'information touristique</h3>
                    <ul class="text-block__contact tm-contact">
                        <li class="tm-contact__item tm-contact__address tm-contact__address--green-d">
                            <a href="https://goo.gl/maps/V7wM7zBtuQF2" class="tm-contact__link tm-contact__link--green" target="_blank">600, chemin de l'Esker, Saint-Mathieu-du-Parc (QC) G0X 1N0</a>
                        </li>
                        <li class="tm-contact__item tm-contact__phone tm-contact__phone_1--green-d">
                            <a href="tel:+18192212839" class="tm-contact__link tm-contact__link--green">819 221-2839</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tm-directory__item">
                <div class="text-block">
                    <h4 class="text-block__small text-block__small--green-l">Louiseville</h4>
                    <h3 class="text-block__big text-block__big--green-d">Parc des Ursulines</h3>
                    <ul class="text-block__contact tm-contact">
                        <li class="tm-contact__item tm-contact__address tm-contact__address--green-d">
                            <a href="https://goo.gl/maps/FEkfjNwLMuQ2" class="tm-contact__link tm-contact__link--green" target="_blank">50, avenue Saint-Laurent, Louiseville (QC), J5V 1J4</a>
                        </li>
                        <li class="tm-contact__item tm-contact__phone tm-contact__phone_1--green-d">
                            <a href="tel:+18192282744" class="tm-contact__link tm-contact__link--green">819 228-2744</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tm-directory__item">
                <div class="text-block">
                    <h4 class="text-block__small text-block__small--green-l">Saint-Édouard-de-Maskinongé</h4>
                    <h3 class="text-block__big text-block__big--green-d">Relais d'information touristique</h3>
                    <ul class="text-block__contact tm-contact">
                        <li class="tm-contact__item tm-contact__address tm-contact__address--green-d">
                            <a href="https://goo.gl/maps/XaUzS9QdUT42" class="tm-contact__link tm-contact__link--green" target="_blank">3860, rue Notre-Dame, Saint-Édouard-de-Maskinongé (QC) J0K 1H0</a>
                        </li>
                        <li class="tm-contact__item tm-contact__phone tm-contact__phone_1--green-d">
                            <a href="tel:+18192212839" class="tm-contact__link tm-contact__link--green">819 228-2744</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tm-directory__item">
                <div class="text-block">
                    <h4 class="text-block__small text-block__small--green-l">Saint-Paulin</h4>
                    <h3 class="text-block__big text-block__big--green-d">Relais d'information touristique</h3>
                    <ul class="text-block__contact tm-contact">
                        <li class="tm-contact__item tm-contact__address tm-contact__address--green-d">
                            <a href="https://goo.gl/maps/KE3aPQTrUx32" class="tm-contact__link tm-contact__link--green" target="_blank">Jonction des rues Laflèche et Lottinville (QC) Saint-Paulin, J0K 3G0</a>
                        </li>
                        <li class="tm-contact__item tm-contact__phone tm-contact__phone_1--green-d">
                            <a href="tel:+18192212839" class="tm-contact__link tm-contact__link--green">819 228-2744</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
