<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The_Schema
 */

get_header(); ?>

	<div id="primary" class="content-area sticky-meta">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
        
        <?php
        /**
         * @hooked the_schema_navigation    - 15 
         * @hooked the_schema_author        - 20
         * @hooked the_schema_related_posts - 30
         * @hooked the_schema_comment       - 40
        */
        do_action( 'the_schema_after_post_content' );
        ?>
        
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
