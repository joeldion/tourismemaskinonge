        <footer class="footer">
            <div class="footer__wrapper">
                <div class="footer__logos">
                    <div class="footer__logo">
                        <a href="https://mrcmaskinonge.ca/" target="_blank" rel="noopener"><img src="<?php echo TM_URL; ?>/img/logos/logo-mrc-maskinonge-blanc.svg" alt="Logo - MRC de Maskinongé"></a>
                    </div>
                    <div class="footer__logo">
                    <a href="https://www.facebook.com/culturemaskinonge/" target="_blank" rel="noopener"><img src="<?php echo TM_URL; ?>/img/logos/logo-culture-maskinonge-blanc.svg" alt="Logo - Culture Maskinongé"></a>
                    </div>
                </div>
                <div class="footer__content">
                    
                    <div class="footer__item footer__item--contact">
                        <h3 class="footer__title">Coordonnées</h3>
                        <p class="footer__text">Tourisme Maskinongé</p>
                        <p class="footer__text">Bureau d'information touristique</p>
                        <p class="footer__text">Boutique terroir et artisans</p>
                        <address class="address">
                            <p class="address__title">Aire de service de la Baie-de-Maskinongé</p>
                            <a class="address__street" href="https://goo.gl/maps/iE9VGvLfFJMSEfb7A" target="_blank" rel="noopener">161, autoroute 40 Est, Maskinongé (QC) J0K 1N0</a>
                            <a class="address__phone" href="tel:+18772272413">1 877-227-2413</a>
                            <a class="address__email" href="mailto:info@tourismemaskinonge.com">info@tourismemaskinonge.com</a>
                        </address>
                        <div class="footer__social tm-social">
                            <a href="https://www.facebook.com/tourismemaskinonge" target="_blank" title="Facebook" class="tm-social__facebook tm-social__facebook--yellow-green" rel="noopener"></a>
                            <a href="https://www.instagram.com/tourismemaskinonge" target="_blank" title="Instagram" class="tm-social__instagram tm-social__instagram--yellow-green" rel="noopener"></a>
                            <a href="<?php echo get_site_url() . '/nous-joindre'; ?>" target="_blank" title="Nous joindre" class="tm-social__question tm-social__question--yellow-green"></a>
                        </div> 
                        <!-- <div class="footer__social">
                            <a href="#" class="footer__icon footer__icon--facebook"></a>
                            <a href="#" class="footer__icon footer__icon--instagram"></a>
                            <a href="#" class="footer__icon footer__icon--question"></a>
                        </div> -->
                    </div>

                    <div class="footer__item footer__item--blog">
                        <h3 class="footer__title">Blogue</h3>
                        <div class="footer__blog">
                            <?php echo get_latest_blog_posts_footer( get_the_ID() ); ?>
                        </div>
                    </div>    
                    
                    <div class="footer__item footer__item--newsletter">
                        <h3 class="footer__title">Infolettre</h3>
                        <p class="footer__text">Abonnez-vous à notre infolettre et recevez gratuitement nos brochures et documents touristique.</p>   
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