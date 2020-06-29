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
 * @package WordPress
 * @subpackage Gucherry Blog
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
									if ( ('left' === $sidebar_position) && is_active_sidebar( 'gucherry-blog-sidebar-shop') ) {
										get_sidebar('shop');
									}
									?>
									<div class="<?php gucherry_blog_main_container_class(); ?>">
										<?php woocommerce_content(); ?>
									</div><!-- // col -->
									<?php
									$sidebar_position = gucherry_blog_sidebar_position();
									if ( ('right' === $sidebar_position) && is_active_sidebar( 'gucherry-blog-sidebar-shop') ) {
										get_sidebar('shop');
									}
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
