        <footer class="footer">
            <div class="footer__wrapper">
                <div class="footer__logos">
                    <div class="footer__logo">
                        <a href="https://mrcmaskinonge.ca/" target="_blank" rel="noopener" aria-label="MRC de Maskinongé"><img src="<?php echo TM_URL; ?>/img/logos/logo-mrc-maskinonge-blanc.svg" alt="Logo - MRC de Maskinongé"></a>
                    </div>
                    <div class="footer__logo">
                    <a href="https://www.facebook.com/culturemaskinonge/" target="_blank" rel="noopener" aria-label="Culture Maskinongé"><img src="<?php echo TM_URL; ?>/img/logos/logo-culture-maskinonge-blanc.svg" alt="Logo - Culture Maskinongé"></a>
                    </div>
                </div>
                <div class="footer__content">
                    
                    <div class="footer__item footer__item--contact">
                        <h3 class="footer__title"><?php esc_html_e( 'Contact Info', TM_DOMAIN ); ?></h3>
                        <p class="footer__text"><?php esc_html_e( get_option( 'footer_contact_subtitle_1' ) ); ?></p>
                        <p class="footer__text"><?php esc_html_e( get_option( 'footer_contact_subtitle_2' ) ); ?></p>
                        <p class="footer__text"><?php esc_html_e( get_option( 'footer_contact_subtitle_3' ) ); ?></p>
                        <address class="address">
                            <p class="address__title"><?php esc_html_e( get_option( 'footer_contact_location_name' ) ); ?></p>
                            <a class="address__street" href="https://goo.gl/maps/iE9VGvLfFJMSEfb7A" target="_blank" rel="noopener">
                                <?php esc_html_e( get_option( 'contact_info_address' ) ); ?>
                            </a>
                            <a class="address__phone" href="<?php tm_format_phone( get_option( 'contact_info_phone' ), 'href' ); ?>">
                                <?php esc_html_e( get_option( 'contact_info_phone' ) ); ?>
                            </a>
                            <a class="address__email" href="mailto:<?php esc_html_e( get_option( 'contact_info_email' ) ); ?>">
                                <?php esc_html_e( get_option( 'contact_info_email' ) ); ?>
                            </a>
                        </address>                       
                        <div class="footer__social tm-social tm-social--bg-yellow">
                            <a href="<?php echo esc_url( get_option( 'contact_info_facebook' ) ); ?>" target="_blank" title="Facebook" class="tm-social__facebook tm-social__facebook--green" rel="noopener"></a>
                            <a href="<?php echo esc_url( get_option( 'contact_info_instagram' ) ); ?>" target="_blank" title="Instagram" class="tm-social__instagram tm-social__instagram--green" rel="noopener"></a>
                        </div>                       
                    </div>

                    <div class="footer__item footer__item--blog">
                        <h3 class="footer__title"><?php esc_html_e( get_option( 'footer_blog_title' ) ); ?></h3>
                        <div class="footer__blog">
                            <?php echo get_latest_blog_posts_footer( get_the_ID() ); ?>
                        </div>
                    </div>    
                    
                    <div class="footer__item footer__item--newsletter">
                        <h3 class="footer__title"><?php esc_html_e( get_option( 'footer_newsletter_title' ) ); ?></h3>
                        <p class="footer__text"><?php esc_html_e( get_option( 'footer_newsletter_desc' ) ); ?></p>   
                        <div id="mc_embed_signup" class="newsletter">                            
                            <form action="https://quebec.us3.list-manage.com/subscribe/post?u=4cb2a8156baa181aada61ceaa&amp;id=8c73675c6b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form form" class="validate" target="_blank" novalidate>
                                <div class="form__input form__input--yellow">
                                    <input type="email" id="mce-EMAIL" value="" name="EMAIL" class="required email" placeholder="Adresse courriel">                                    
                                </div>
                                <div class="hidden">
                                    <input type="text" value="f" name="FNAME" class="required" id="mce-FNAME">
                                    <input type="text" value="l" name="LNAME" class="required" id="mce-FNAME">
                                </div>
                                <div id="mce-responses" class="clear">
                                    <p class="footer__text response" id="mce-error-response" style="display:none"></p>
                                    <p class="footer__text response" id="mce-success-response" style="display:none"></p>
                                </div> 
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4cb2a8156baa181aada61ceaa_8c73675c6b" tabindex="-1" value=""></div>
                                <input type="submit" class="newsletter__submit"
                                       data-sitekey="<?php echo TM_CAPTCHA_KEY; ?>" 
                                       data-callback="newsletterSubmit" 
                                       data-action="submit">
                            </form>
                        </div> 

                    </div>

                    <div class="footer__item footer__item--links">
                        <ul class="footer__links">
                            <li class="footer__link"><a href="<?php echo get_site_url(); ?>/tourisme-affaires/">Tourisme d'affaires</a></li>
                            <li class="footer__link "><a href="<?php echo get_site_url(); ?>/cartes-et-brochures/">Cartes et brochures</a></li>
                        </ul>
                    </div>
                    
                </div>
                <div class="footer__colophon">
                    <p class="footer__copyright">&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;-&nbsp;Tous droits réservés MRC de Maskinongé</p>
                </div>
            </div>
        </footer>
        <div id="tm-back-to-top" class="tm-back-to-top"></div>
        <?php wp_footer(); ?>
    </body>
</html>