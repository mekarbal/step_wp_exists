<?php get_header(); ?>

<!-- start content container -->
<div class="row">   
	<article class="main-content-area col-md-<?php envo_business_main_content_width_columns(); ?>">  
        <div class="woocommerce">
			<?php do_action( 'envo_business_generate_woo_breadcrumbs' ); ?> 
			<?php woocommerce_content(); ?>
        </div>
	</article>       
	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->

<?php 
get_footer();
