
<?php 
/*
 * Class: Card
 */

class TMCard {

    private $id;
    private $post_type;
    private $size;
    private $is_search;

    public function __construct( $id, $post_type = 'post', $size = '', $is_search = false, $is_business = false ) {

        $this->id = intval( $id );
        $this->post_type = $post_type;
        $this->size = $size;
        $this->is_search = $is_search;
        $this->is_business = $is_business;
        $this->title = get_the_title( $this->id );
        $this->max_char = $this->size === 'small' ? 40 : 50;
        $this->image_size = $this->size === 'xlarge' ? 'tm-post' : 'tm-card';
        $this->image_url = get_the_post_thumbnail_url( $this->id, $this->image_size );
        $this->image_thumb_url = get_the_post_thumbnail_url( $this->id, 'thumbnail' );
        if ( $this->is_business ) {
            $this->is_featured = get_post_meta( $this->id, '_tm_attract_business_featured', true );
            if ( $this->is_featured === 1 ) return false;
            $this->business_img_id = intval( get_post_meta( $this->id, '_tm_attract_business_image', true ) );
            if ( !empty( $this->business_img_id ) ) {
                $this->image_url = wp_get_attachment_image_url( $this->business_img_id, $this->image_size );
                $this->image_thumb_url = get_the_post_thumbnail_url( $this->business_img_id, 'thumbnail' );
            }            
        }
        $this->background_image = 'style="background-image: url(' . $this->image_url . ');"';
        $this->suffix = 'page';
        $this->surtitle = esc_html__( 'Information', TM_DOMAIN );
        $this->subtitle = '';
        
        switch ( $this->post_type ) {
            case 'attraction':
                $this->suffix = 'attract';
                $this->surtitle = get_attract_primary_cat( $this->id );
                $this->subtitle = get_post_meta( $this->id, '_tm_attract_city', true );
                break;
            case 'tm_event':
                $this->suffix = 'event';
                $this->surtitle = esc_html_x( 'Event', 'Event name', TM_DOMAIN );
                $this->location_id = get_post_meta( $this->id, '_tm_event_location_id', true );
                $this->subtitle = get_post_meta( $this->location_id, '_tm_event_location_city', true );
                $this->event_start_date = get_post_meta( $this->id, '_tm_event_start_date', true );
                $this->event_end_date = get_post_meta( $this->id, '_tm_event_end_date', true );
                $this->event_start_day = $this->format_day( $this->event_start_date ); 
                $this->event_end_day = $this->format_day( $this->event_end_date ); 
                $this->event_start_month = date_i18n( 'M', strtotime( $this->event_start_date ) );
                $this->event_end_month = date_i18n( 'M', strtotime( $this->event_end_date ) );
                $this->event_start_year = date_i18n( 'Y', strtotime( $this->event_start_date ) );                
                $this->event_end_year = date_i18n( 'Y', strtotime( $this->event_end_date ) );
                
                // $this->event_start_month = $this->format_month( $this->event_start_date );
                // $this->event_end_month = $this->format_month( $this->event_end_date );
                
                $this->has_multiple_dates = $this->event_start_date !== $this->event_end_date ? true : false;
                break;
            case 'post':
                $this->suffix = 'blog';
                $this->surtitle = esc_html__( 'Blog', TM_DOMAIN );
                $this->subtitle = get_blog_date( $this->id );
        }

        $this->long_text = strlen( $this->title ) > 40 && $this->subtitle !== '' ? ' card__text--large' : ''; 

        if ( $this->size === 'footer' ) {
            $this->background_image = '';
            $this->suffix = 'footer';
        }

        // $this->surtitle .= ' ' . $this->post_type;

        $this->image_width = wp_get_attachment_image_src( get_post_thumbnail_id( $this->id ), 'tm-card-2x' )[1];
        $this->has_retina = $this->image_width === 780 ? true : false;

        $this->classes = 'card card--' . $this->suffix;
        if ( $this->is_search ) $this->classes .= ' card--search';
        if ( $this->size !== '' ) $this->classes .= ' card--' . $this->size;
        
        $this->image_2x = '';
        if ( $this->has_retina ) {
            $this->classes .= ' has_retina';
            $this->image_2x = ' data-image-2x="' . get_the_post_thumbnail_url( $this->id, $this->image_size . '-2x' ) . '"';
        }

        $this->location_data = !empty( $this->location_id ) ? 'data-location="' . $this->location_id . '"' : '';

    }

    public function format_day( $date ) {
        return preg_replace( '/^(0?)(\d)$/', '$2', substr( $date, -2 ) );
    }

    public function format_month( $date ) {
        return date_i18n( 'M', strtotime( $date ) );
    }

    public function output() {

        ob_start();
        ?>
        <a href="<?php echo get_the_permalink( $this->id ); ?>" class="<?php echo $this->classes; ?>" <?php echo $this->image_2x; ?> <?php echo $this->background_image; ?> <?php echo $this->location_data; ?>>

            <?php if ( !empty( $this->event_start_date ) ): ?>
                <div class="card__date<?php echo $this->has_multiple_dates ? ' card__date--large' : ''; ?>">
                    <div class="card__date-wrapper">
                        <span class="card__date-number"><?php echo $this->event_start_day; ?></span>
                        <span class="card__date-month"><?php echo $this->event_start_month; ?></span>
                        <span class="card__date-year"><?php echo $this->event_start_year; ?></span>
                    </div>
                <?php if ( $this->has_multiple_dates ): ?>
                    <span class="card__date-separator"></span>
                    <div class="card__date-wrapper">
                        <span class="card__date-number"><?php echo $this->event_end_day; ?></span>
                        <span class="card__date-month"><?php echo $this->event_end_month; ?></span>
                        <span class="card__date-year"><?php echo $this->event_end_year; ?></span>
                    </div>
                <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( $this->size === 'footer' ): ?>
                <img class="card__image" src="<?php echo $this->image_thumb_url; ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>

            <div class="card__text<?php echo $this->long_text; ?>">

                <?php if ( ( $this->post_type === 'attraction' && !$this->is_business ) || $this->is_search ): ?>
                <h6 class="card__text-3"><?php echo $this->surtitle; ?></h6>
                <?php endif; ?>     

                <h4 class="card__text-1"><?php echo mb_strimwidth( $this->title, 0, $this->max_char, '...' ); ?></h4> 

                <?php if ( !empty( $this->subtitle ) ): ?>
                <h5 class="card__text-2"><?php esc_html_e( $this->subtitle ); ?></h5>
                <?php endif; ?>

            </div>
        </a>
        <?php
        return ob_get_clean();

    }    

}