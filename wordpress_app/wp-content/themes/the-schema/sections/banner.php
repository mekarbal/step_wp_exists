<?php
/**
 * Banner Section
 * 
 * @package The_Schema
 */
 
if( has_custom_header() ){

    $newsletter_bottom_note = get_theme_mod( 'newsletter_bottom_note', __( 'One email per week. Zero spam or ads.', 'the-schema' ) );?>
    <div id="banner_section" class="site-banner">
        <div class="banner-item">
            <?php the_custom_header_markup();
    
            if( the_schema_is_btnw_activated() ): ?>
    
                <div class="banner-caption center">
                    <div class="container">
                        <?php 
                            $newsletter_shortcode = get_theme_mod('newsletter_shortcode');
                            if( $newsletter_shortcode ){
                                echo do_shortcode( $newsletter_shortcode );
                            }
                        if( $newsletter_bottom_note ){ ?>
                            <div class="newsletter-banner-note"><?php echo wpautop( wp_kses_post( $newsletter_bottom_note ) ); ?></div>
                        <?php } ?>
                    </div>
                </div>
    
            <?php endif; ?>
        </div>
    </div>
    
<?php }