<?php 
/*
 * Class: Side Box
 */

class TMSideBox {

    private $id;
    private $name;
    private $color;
    private $position;

    public function __construct( $id, $name, $color, $position = '' ) {

        $this->id    = $id;
        $this->name  = $name;
        $this->color = $color;

        switch ( $this->color ) {
            case 'green':
                $this->color_primary = 'yellow-d';
                $this->color_secondary = 'yellow';
                break;
            case 'blue':
                $this->color_primary = 'yellow';
                $this->color_secondary = 'yellow-d';
                break;
            case 'yellow':
                $this->color_primary = 'blue-d';
                $this->color_secondary = 'blue';
                break;
            default:
                $this->color_primary = 'blue-d';
                $this->color_secondary = 'blue';
        }

        $this->position_class   = $position !== '' ? ' tm-side-box__content--' . $position : '';
        $this->small_text       = esc_html( get_post_meta( $id, '_tm_' . $this->name . '_small_text', true ) );
        $this->big_text         = esc_html( get_post_meta( $id, '_tm_' . $this->name . '_big_text', true ) );
        $this->address          = esc_html( get_post_meta( $id, '_tm_' . $this->name . '_address', true ) );
        $this->map_url          = esc_url( get_post_meta( $id, '_tm_' . $this->name . '_map_url', true ) );
        $this->phone            = esc_attr( get_post_meta( $id, '_tm_' . $this->name . '_phone', true ) );
        $this->email            = esc_html( get_post_meta( $id, '_tm_' . $this->name . '_email', true ) );
        $this->email_label      = 'Écrivez-nous pour plus d\'informations';
        $this->website          = esc_url( get_post_meta( $id, '_tm_' . $this->name . '_website', true ) );

    }

    public function output() {

        ob_start();
        ?>
        <div class="tm-side-box__wrapper tm-side-box__wrapper--large">
            <div class="tm-side-box__content<?php echo $this->position_class; ?>">
                <div class="tm-side-box tm-side-box--large tm-side-box--<?php echo $this->color_secondary; ?>">            
                    <div class="text-block">
                        <h4 class="text-block__small text-block__small--<?php echo $this->color_secondary; ?>"><?php echo $this->small_text; ?></h4>
                        <h3 class="text-block__big text-block__big--<?php echo $this->color_primary; ?>"><?php echo $this->big_text; ?></h3>
                        <ul class="text-block__contact tm-contact">
                            <li class="tm-contact__item tm-contact__address tm-contact__address--<?php echo $this->color_primary; ?>">
                                <a href="<?php echo $this->map_url; ?>" class="tm-contact__link" target="_blank"><?php echo $this->address; ?></a>
                            </li>                          
                            <li class="tm-contact__item tm-contact__phone_1 tm-contact__phone_1--<?php echo $this->color_primary; ?>">
                                <a href="<?php tm_format_phone( $this->phone, 'href' ); ?>" class="tm-contact__link"><?php tm_format_phone( $this->phone ); ?></a>
                            </li>
                            <li class="tm-contact__item tm-contact__email tm-contact__email--<?php echo $this->color_primary; ?>">
                                <a href="mailto:<?php echo $this->email; ?>" class="tm-contact__link"><?php echo $this->email_label; ?></a>
                            </li>                           
                        </ul>
                    </div>      
                    <div class="tm-side-box__map"></div>
                </div>
            </div>    
        </div>
        <?php
        return ob_get_clean();

    }

}