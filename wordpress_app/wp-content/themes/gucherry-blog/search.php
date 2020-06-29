<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package gucherry-blog
 */

get_header();
?>

	<section class="main-content-area-wrap">
        <div class="search-page-wrap">
            <div class="search-page-s1 layout-tweak">
                <div class="gc-container">
                    <?php gucherry_blog_breadcrumb(); ?>
                    <div id="primary" class="content-area">
                        <main class="site-main">
                            <div class="search-inner">
                                <div class="row">
                                   <?php 
                                    $sidebar_position = get_theme_mod( 'gucherry_blog_site_pages_search_page_sidebar_position', 'right' );
                                    if( $sidebar_position == 'left' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                                        get_sidebar();
                                    }
                                    ?>
                                    <div class="<?php gucherry_blog_main_container_class(); ?>">
                                        <div class="search-entry">
                                            <div class="page-title">
                                                <h1>
                                                    <?php
                                                    /* translators: %s: search query. */
                                                    printf( esc_html__( 'Search Results for: %s', 'gucherry-blog' ), '<span>' . get_search_query() . '</span>' );
                                                    ?>
                                                </h1>
                                            </div><!-- // page-ttile -->
                                            <div class="search-items-entry">
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
                                            </div><!-- // search-items-entry -->
                                        </div><!-- // search-entry -->
                                    </div><!-- // col -->
                                    <?php
                                    if( $sidebar_position == 'right' && is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
                                        get_sidebar();
                                    }
                                    ?>
                                </div><!-- // row -->
                            </div><!-- // search-inner -->
                        </main><!-- // site-main -->
                    </div><!-- // # primary -->
                </div><!-- // gc-container -->
            </div><!-- // search-page-s1 layout-tweak -->
        </div><!-- // search-page-wrap -->
    </section><!-- // main-content-area-wrap -->

<?php
get_footer();
