<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gucherry-blog
 */
?>
        <?php
        $display_back_to_top = get_theme_mod( 'gucherry_blog_site_footer_display_back_to_top', true );
        if( $display_back_to_top == true ) {
        ?>
        <div id="gc-backtotop">
            <a href="#" class="caption"><?php echo esc_html__( 'Back to top', 'gucherry-blog' ); ?></a>
        </div><!-- // gc-backtotop -->
        <?php
        }
        ?>
        <footer class="footer secondary-widget-area">
            <div class="footer-inner">
                <div class="footer-entry">
                   <?php
                    $display_footer_logo = get_theme_mod( 'gucherry_blog_site_footer_display_footer_logo', true );
                    if( $display_footer_logo == true ) {
                    ?>
                    <div class="gc-container">
                        <div class="footer-top">
                            <div class="site-identity">
                               <?php
                                $footer_logo = get_theme_mod( 'gucherry_blog_site_footer_upload_footer_logo' );
                                if( !empty( $footer_logo ) ) {
                                ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                                </a>
                                <?php
                                }
                                ?>
                            </div><!-- // site-identity -->
                        </div><!-- // footer-top -->
                    </div><!-- // gc-container -->
                    <?php
                    }
                    
                    if( is_active_sidebar( 'gucherry-blog-footer-left' ) || is_active_sidebar( 'gucherry-blog-footer-middle' ) || is_active_sidebar( 'gucherry-blog-footer-right' ) ) :
                    ?>
                    <div class="gc-container">
                        <div class="footer-mid">
                            <div class="gc-row column-3">
                                <div class="gc-col column">
                                    <?php
                                    if( is_active_sidebar( 'gucherry-blog-footer-left' ) ) {
                                        dynamic_sidebar( 'gucherry-blog-footer-left' );
                                    }
                                    ?>
                                </div><!-- // gc-col -->
                                <div class="gc-col column">
                                    <?php
                                    if( is_active_sidebar( 'gucherry-blog-footer-middle' ) ) {
                                        dynamic_sidebar( 'gucherry-blog-footer-middle' );
                                    }
                                    ?>
                                </div><!-- // gc-col -->
                                <div class="gc-col column">
                                    <?php
                                    if( is_active_sidebar( 'gucherry-blog-footer-right' ) ) {
                                        dynamic_sidebar( 'gucherry-blog-footer-right' );
                                    }
                                    ?>
                                </div><!-- // gc-col -->
                            </div><!-- // gc-row -->
                        </div><!-- // footer-mid -->
                    </div><!-- // gc-container -->
                    <?php 
                    endif;
                    ?>
                    <div class="footer-bottom">
                        <div class="gc-container">
                            <div class="copyright-info">
                                <p>
                                <?php 
                                $footer_copyright_text = get_theme_mod( 'gucherry_blog_site_footer_copyright_text' );
                                if( !empty( $footer_copyright_text ) ) {
                                    /* translators: 1: Copyright Text 2: Theme name, 3: Theme author. */
                                    printf( esc_html__( '%1$s %2$s by %3$s','gucherry-blog' ), $footer_copyright_text, 'GuCherry Blog', '<a href="'. esc_url( 'https://everestthemes.com' ) . '">Everestthemes</a>' );
                                } else {
                                    /* translators: 1: Theme name, 2: Theme author. */
                                    printf( esc_html__( '%1$s by %2$s', 'gucherry-blog' ), 'GuCherry Blog', '<a href="'. esc_url( 'https://everestthemes.com' ) . '">Everestthemes</a>' );
                                }
                                ?> 
				                </p>
                            </div><!-- // copyright-info -->
                        </div><!-- // gc-container -->
                    </div><!-- // footer-bottom -->
                </div><!-- // footer-entry -->
            </div><!-- // footer-inner -->
        </footer><!-- // footer -->

    </div><!-- // page-wrap -->

<?php wp_footer(); ?>

</body>

</html>
