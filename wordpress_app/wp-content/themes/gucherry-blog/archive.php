<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gucherry-blog
 */

get_header();
?>

	<section class="main-content-area-wrap">
        <div class="archive-page-wrap">
            <div class="archive-page-s1 layout-tweak">
                <div class="gc-container">
                    <?php gucherry_blog_breadcrumb(); ?>
                    <div id="primary" class="content-area">
                        <main class="site-main">
                            <div class="archive-inner">
                                <div class="row">
                                   <?php 
                                    $sidebar_position = get_theme_mod( 'gucherry_blog_site_pages_archive_page_sidebar_position', 'right' );
                                    if( $sidebar_position == 'left' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                                        get_sidebar();
                                    }
                                    ?>
                                    <div class="<?php gucherry_blog_main_container_class(); ?>">
                                        <div class="archive-entry">
                                            <?php

                                            $display_archive_title = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_archive_title', true );

                                            if( $display_archive_title == true ) {
                                                ?>
                                                <div class="page-title">
                                                   <?php
                                                    if( is_archive() ) {
                                                        the_archive_title( '<h1>', '</h1>' );
                                                    }
                                                    ?>
                                                </div><!-- // page-ttile -->
                                                <?php
                                            }

                                            $display_archive_description = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_archive_description', true );

                                            if( $display_archive_description == true ) {

                                                $archive_description = get_the_archive_description();
                                                if( !empty( $archive_description ) ) :
                                                ?>
                                                <div class="category-description">
                                                    <p><?php the_archive_description(); ?></p>
                                                </div><!-- // category-description -->
                                                <?php
                                                endif;
                                            }
                                            ?>
                                            <div class="archive-items-entry">
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
                                            </div><!-- // archive-items-entry -->
                                        </div><!-- // archive-entry -->
                                    </div><!-- // col -->
                                    <?php
                                    if( $sidebar_position == 'right' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                                        get_sidebar();
                                    }
                                    ?>
                                </div><!-- // row -->
                            </div><!-- // archive-inner -->
                        </main><!-- // site-main -->
                    </div><!-- // # primary -->
                </div><!-- // gc-container -->
            </div><!-- // archive-page-s1 layout-tweak -->
        </div><!-- // archive-page-wrap -->
    </section><!-- // main-content-area-wrap -->

<?php
get_footer();
