<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gucherry-blog
 */

get_header();

    // Banner Template
    gucherry_blog_banner_template();

    // Top Widget Area
    if( is_active_sidebar( 'gucherry-blog-top-widget' ) ) {
    ?>
    <section class="gc-top-widget-area primary-widget-area">
       <div class="widget-area-inner">
            <div class="gc-container">
                <div class="widget-area-entry">
                <?php
                dynamic_sidebar( 'gucherry-blog-top-widget' );
                ?>
                </div><!-- // widget-area-entry -->
            </div><!-- // gc-container -->
        </div><!-- // widget-area-inner -->
    </section><!-- // gc-top-widget-area -->
    <?php
    }
    ?>
    <section class="gc-mid-widget-area main-content-area-wrap">
        <div class="widget-area-inner">
            <div class="gc-container">
                <div class="row">
                   <?php 
                    $sidebar_position = get_theme_mod( 'gucherry_blog_site_pages_blog_page_sidebar_position', 'right' );
                    if( $sidebar_position == 'left' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                        get_sidebar();
                    }
                    ?>
                    <div class="<?php gucherry_blog_main_container_class(); ?>">
                        <div id="primary" class="content-area">
                            <main class="site-main">
                               <?php
                                if( have_posts() ) :
                                ?>
                                <div class="gc-blog-lists gc-blog-list-s1">
                                   <?php
                                    
                                    /* Start the Loop */
										while ( have_posts() ) :

											the_post();

											/*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
											
											get_template_part( 'template-parts/content', get_post_format() );

										endwhile;
                                    
                                        gucherry_blog_pagination();
                                    ?>                                    
                                </div><!-- // gc-blog-lists gc-blog-list-s1 -->
                                <?php
                                
                                else :
                                
                                    get_template_part( 'template-parts/content', 'none' );
                                endif;
                                ?>
                            </main><!-- // site-main -->
                        </div><!-- // # primary -->
                    </div><!-- // col-lg-8 -->
                    <?php
                    if( $sidebar_position == 'right' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                        get_sidebar();
                    }
                    ?>
                </div><!-- // row -->
            </div><!-- // gc-container -->
        </div><!-- // widget-area-inner -->
    </section><!-- // main-content-area-wrap -->
    <?php 
    // Bottom Widget Area
    if( is_active_sidebar( 'gucherry-blog-bottom-widget' ) ) {
    ?>
    <section class="gc-bottom-widget-area primary-widget-area">
        <div class="widget-area-inner">
            <div class="gc-container">
                <div class="widget-area-entry">
                <?php
                dynamic_sidebar( 'gucherry-blog-bottom-widget' );
                ?>
                </div><!-- // widget-area-entry -->
            </div><!-- // gc-container -->
        </div><!-- // widget-area-inner -->
    </section><!-- // gc-bottom-widget-area -->
<?php
    }
get_footer();
