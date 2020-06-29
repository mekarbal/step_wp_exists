<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gucherry-blog
 */

get_header();
?>

	<section class="main-content-area-wrap">
        <div class="dafault-page-wrap">
            <div class="default-page-s1 layout-tweak">
                <div class="gc-container">
                    <?php gucherry_blog_breadcrumb(); ?>
                    <div id="primary" class="content-area">
                        <main class="site-main">
                            <div class="default-page-inner">
                                <div class="row">
                                    <?php 
                                    $sidebar_position = gucherry_blog_sidebar_position();
                                    do_action('page_sidebar_left', $sidebar_position);
                                    ?>
                                    <div class="<?php gucherry_blog_main_container_class(); ?>">
                                       <?php
                                        if( have_posts() ) :
                                        
                                            while( have_posts() ) :
                                                the_post();
                                        
                                                get_template_part( 'template-parts/content', 'page' );
                                        
                                            endwhile;
                                        
                                         

                                        else :
                                        
                                            get_template_part( 'template-parts/content', 'none' );
                                        
                                        endif;
                                        ?>
                                    </div><!-- // col -->
                                    <?php
                                    $sidebar_position = gucherry_blog_sidebar_position();
                                    do_action('page_sidebar_right', $sidebar_position);
                                    ?>
                                </div><!-- // row -->
                            </div><!-- // default-page-inner -->
                        </main><!-- // site-main -->
                    </div><!-- // # primary -->
                </div><!-- // gc-container -->
            </div><!-- // default-page-s1 layout-tweak -->
        </div><!-- // default-page-wrap -->
    </section><!-- // main-content-area-wrap -->

<?php
get_footer();
