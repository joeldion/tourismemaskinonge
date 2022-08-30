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
            <h3 class="tm-modal__title">Portes ouvertes chez les producteurs, artistes et artisans</h3> 
            <h4 class="tm-modal__subtitle">Plus de 40 arrêts, partout dans la MRC de Maskinongé</h4>
            <h5 class="tm-modal__title">24 et 25 septembre 2022<br /> 10&nbsp;h à 17&nbsp;h</h5>
        </div>        
        <div class="tm-modal__content">
            <div class="tm-modal__item">
                <img class="tm-modal__img" src="<?php echo TM_URL . '/img/logos/logo-tournee-bon-appetit-maski-modal-1x.png'; ?>" srcset="<?php echo TM_URL . '/img/logos/logo-tournee-bon-appetit-maski-modal-1x.png 1x, ' . TM_URL . '/img/logos/logo-tournee-bon-appetit-maski-modal.png 2x'; ?>" alt="Bon appétit Maski">
                <div class="tm-modal__desc">
                    <h4 class="tm-modal__title tm-modal__title--secondary">Tournée gourmande</h4>
                    <p>Dégustez et achetez frais directement de la ferme. Découvrez le savoir-faire de nos producteurs agroalimentaires.</p>
                    <p><a href="https://bonappetitmaski.com" class="tm-modal__cta" target="_blank" rel="noopener" aria-label="Bon appétit Maski">En savoir plus</a></p>                
                </div>
            </div>
            <div class="tm-modal__item">
                <img class="tm-modal__img" src="<?php echo TM_URL . '/img/logos/logo-hangarts-publics-modal-1x.png'; ?>" srcset="<?php echo TM_URL . '/img/logos/logo-hangarts-publics-modal-1x.png 1x, ' . TM_URL . '/img/logos/logo-hangarts-publics-modal.png 2x'; ?>" alt="HangARTS publics">
                <div class="tm-modal__desc">
                    <h4 class="tm-modal__title tm-modal__title--secondary">Route des arts</h4>
                    <p>Rencontrez des artistes inspirants dans leur atelier. Découvrez des créations originales.</p>
                    <p><a href="https://hangartspublics.com" class="tm-modal__cta" target="_blank" rel="noopener" aria-label="HangARTS publics">En savoir plus</a></p>                
                </div>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();

}