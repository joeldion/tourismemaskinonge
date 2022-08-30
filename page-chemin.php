<?php get_header();
/*
 * Template Name: Chemin du Roy
*/

$id = get_the_ID();
$subtitle = esc_html( get_post_meta( $id, '_tm_page_subtitle', true ) );
$phone = esc_attr( get_post_meta( $id, '_tm_chemin_phone', true ) );
$email = esc_attr( get_post_meta( $id, '_tm_chemin_email', true ) );
$website = esc_url( get_post_meta( $id, '_tm_chemin_website', true ) );
$facebook = esc_url( get_post_meta( $id, '_tm_chemin_facebook', true ) );
$instagram = esc_url( get_post_meta( $id, '_tm_chemin_instagram', true ) );
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('main tm-chemin'); ?>>

    <?php echo get_slider( get_the_ID() ); ?>

    <section class="tm-chemin__title section">

        <div class="text-block">
            <h1 class="text-block__small text-block__small--yellow-d"><?php the_title(); ?></h1>
            <h2 class="text-block__big text-block__big--yellow-l"><?php echo $subtitle; ?></h2>
            <ul class="text-block__contact tm-contact">
                <li class="tm-contact__item tm-contact__phone_1 tm-contact__phone_1--yellow">
                    <a href="tel:+<?php echo preg_replace( '/\-|\s+/', '', $phone ); ?>" class="tm-contact__link"><?php echo str_replace( ' ', '&nbsp;', $phone ); ?></a>
                </li>
                <li class="tm-contact__item tm-contact__email tm-contact__email--yellow">
                    <a href="mailto:<?php echo $email; ?>" class="tm-contact__link">Écrivez-nous pour plus d'informations</a>
                </li>
                <li class="tm-contact__item tm-contact__website tm-contact__website--yellow">
                    <a href="<?php echo $website; ?>" class="tm-contact__link" target="_blank"><?php echo parse_url( $website )['host']; ?></a>
                </li>
            </ul>
            <div class="tm-social tm-social--bg-yellow-l">
                <a class="tm-social__facebook tm-social__facebook--blue" href="<?php echo $facebook; ?>" target="_blank" aria-label="Facebook"></a>
                <a class="tm-social__instagram tm-social__instagram--blue" href="<?php echo $instagram; ?>" target="_blank" aria-label="Instagram"></a>
            </div>
        </div>

    </section>

    <section class="tm-chemin__post section">

        <div class="tm-post">

            <picture class="tm-post__thumbnail">
                <?php 
                    the_post_thumbnail(
                        'tm-post',
                        [
                            'title'  => get_the_title(),
                            'srcset' => tm_srcset( $id )['post'],
                        ]
                    ); 
                ?>
            </picture>

            <div class="bubble bubble--yellow bubble--bottom-right">            
                <img src="<?php echo TM_URL; ?>/img/logos/logo-chemin-du-roy-blanc.svg" alt="Logo - Tourisme Maskinongé" height="160" width="274">
            </div>

            <div class="tm-post__content text">
                <?php the_content(); ?>               
            </div>

            <div class="tm-post__sidebar">

                <div class="tm-post__share">
                    <a href="https://goo.gl/maps/CerMg8cpKEBhiCAY6" class="btn btn--yellow btn--marker" target="_blank">Localiser</a>
                </div>                
            
            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
