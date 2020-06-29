<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package gucherry-blog
 */

get_header();
?>

	<section class="main-content-area-wrap">
        <div class="error-404-page-wrap">
            <div class="gc-container">
                <div id="primary" class="content-area">
                    <main class="site-main">
                        <div class="error-page-entry">
                            <div class="error-header">
                                <h1><?php esc_html_e( '404', 'gucherry-blog' ); ?></h1>
                            </div><!-- // error-header -->
                            <div class="error-subtitle">
                                <h3><?php esc_html_e( 'Error 404. Page not found', 'gucherry-blog' ); ?></h3>
                            </div><!-- // error-subtitle -->
                            <div class="error-message">
                                <p><?php esc_html_e( "The post or page that you are looking for either has just moved or doesn't exists in this server.", 'gucherry-blog' ); ?></p>
                            </div><!-- // error-message -->
                            <div class="permalink">
                                <a class="gc-button-primary big" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return to homepage', 'gucherry-blog' ); ?></a>
                            </div><!-- // permalink -->
                        </div><!-- // error-page-entry -->
                    </main><!-- // site-main -->
                </div><!-- // # primary -->
            </div><!-- // gc-container -->
        </div><!-- // error-404-page-wrap -->
    </section><!-- // main-content-area-wrap -->

<?php
get_footer();
