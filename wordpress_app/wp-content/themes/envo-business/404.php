<?php get_header(); ?>

<!-- start content container -->
<div class="row">
	<div class="main-content-area col-md-<?php envo_business_main_content_width_columns(); ?>">
		<div class="main-content-page">
			<div class="error-template text-center">
				<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'envo-business' ); ?></h1>
				<p class="error-details">
					<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'envo-business' ); ?>
				</p>
				<div class="error-actions">
					<?php get_search_form(); ?>    
				</div>
			</div>
		</div>
	</div>

	<?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
