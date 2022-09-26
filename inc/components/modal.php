<?php 
/*
 * Component: Modal
 */

function tm_get_modal() {
    
    ob_start();

    ?>
    <div class="tm-overlay"></div>
    <div class="tm-modal">
        <div class="tm-modal__close" id="modal-close"></div>
        <div class="tm-modal__header">
            <h3 class="tm-modal__title">Bon appétit Maski</h3> 
            <h4 class="tm-modal__subtitle">Événement gourmand en restaurant</h4>
            <h5 class="tm-modal__title">Du 20 au 30 octobre 2022</h5>
        </div>        
        <div class="tm-modal__content tm-modal__content--single">
            <div class="tm-modal__item tm-modal__item--single">
                <img class="tm-modal__img" src="<?php echo TM_URL . '/img/logos/logo-bon-appetit-maski-modal-resto-1x.png'; ?>" srcset="<?php echo TM_URL . '/img/logos/logo-bon-appetit-maski-modal-resto-1x.png 1x, ' . TM_URL . '/img/logos/logo-bon-appetit-maski-modal-resto.png 2x'; ?>" alt="Bon appétit Maski" height="235" width="300">
                <div class="tm-modal__desc">
                    <?php /* <h4 class="tm-modal__title tm-modal__title--secondary">Tournée gourmande</h4> */ ?>
                    <p>Produits locaux en vedette dans des tables d’hôte trois services au prix unique de 45$. </p>
                    <p>Certains restaurateurs offrent la table d’hôte pour emporter. </p>
                    <p>Réservez votre repas auprès des restaurateurs participants.</p>
                    <p><a href="https://bonappetitmaski.com/#restaurants" class="tm-modal__cta" target="_blank" rel="noopener" aria-label="Bon appétit Maski">En savoir plus</a></p>                
                </div>
            </div>
            <?php /*
            <div class="tm-modal__item">
                <img class="tm-modal__img" src="<?php echo TM_URL . '/img/logos/logo-hangarts-publics-modal-1x.png'; ?>" srcset="<?php echo TM_URL . '/img/logos/logo-hangarts-publics-modal-1x.png 1x, ' . TM_URL . '/img/logos/logo-hangarts-publics-modal.png 2x'; ?>" alt="HangARTS publics">
                <div class="tm-modal__desc">
                    <h4 class="tm-modal__title tm-modal__title--secondary">Route des arts</h4>
                    <p>Rencontrez des artistes inspirants dans leur atelier. Découvrez des créations originales.</p>
                    <p><a href="https://hangartspublics.com" class="tm-modal__cta" target="_blank" rel="noopener" aria-label="HangARTS publics">En savoir plus</a></p>                
                </div>
            </div>
            <div class="tm-modal__item">
                <img class="tm-modal__img" src="<?php echo TM_URL . '/img/logos/logo-escapade-mauricie-modal-1x.png'; ?>" srcset="<?php echo TM_URL . '/img/logos/logo-escapade-mauricie-modal-1x.png 1x, ' . TM_URL . '/img/logos/logo-escapade-mauricie-modal.png 2x'; ?>" alt="Escapade Mauricie">
                <div class="tm-modal__desc">
                    <h4 class="tm-modal__title tm-modal__title--secondary">Escapade Mauricie</h4>
                    <p>Faites la tournée des artistes et producteurs confortablement assis en autobus au départ de Trois-Rivières.</p>
                    <p><a href="https://www.escapademauricie.com/fr-ca/arts-et-tournee-gourmande-maskinonge" class="tm-modal__cta" target="_blank" rel="noopener" aria-label="Escapade Mauricie">En savoir plus</a></p>                
                </div>
            </div>
            */ ?>
        </div>
    </div>
    <?php

    return ob_get_clean();

}