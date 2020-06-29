<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package The_Schema
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Uh-Oh...', 'the-schema' ); ?></h1>
					<div class="page-desc">
						<?php esc_html_e( 'The page you are looking for may have been moved, deleted, or possibly never existed.', 'the-schema' ); ?>
					</div>
				</header><!-- .page-header -->
				<div class="page-content">
					<div class="error-num"><?php esc_html_e( '404', 'the-schema' ); ?></div>
					<a class="bttn" href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'Take me to the home page', 'the-schema' ); ?></a>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
    
    <?php
    /**
     * @see the_schema_latest_posts
    */
    do_action( 'the_schema_latest_posts' );

get_footer();