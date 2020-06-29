<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package gucherry-blog
 */

get_header();
?>

	<section class="main-content-area-wrap">
        <div class="single-page-wrap">
            <div class="single-page-s1 layout-tweak">
                <div class="gc-container">
                    <?php gucherry_blog_breadcrumb(); ?>
                    <div id="primary" class="content-area">
                        <main class="site-main">
                            <div class="single-page-inner">
                                <div class="row">
                                   <?php 
                                    $sidebar_position = gucherry_blog_sidebar_position();
                                    if( $sidebar_position == 'left' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                                        get_sidebar();
                                    }
                                    ?>
                                    <div class="<?php gucherry_blog_main_container_class(); ?>">
                                        <?php
                                        if( have_posts() ) :
                                        
                                            while( have_posts() ) :
                                                the_post();
                                        
                                                get_template_part( 'template-parts/content', 'single' );
                                        
                                            endwhile;
                                        
                                         

                                        else :
                                        
                                            get_template_part( 'template-parts/content', 'none' );
                                        
                                        endif;
                                        ?>
                                    </div><!-- // col -->
                                    <?php 
                                    if( $sidebar_position == 'right' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                                        get_sidebar();
                                    }
                                    ?>
                                </div><!-- // row -->
                            </div><!-- // single-page-inner -->
                        </main><!-- // site-main -->
                    </div><!-- // # primary -->
                </div><!-- // gc-container -->
            </div><!-- // single-page-s1 layout-tweak -->
        </div><!-- // single-page-wrap -->
    </section><!-- // main-content-area-wrap -->

<?php
get_footer();
