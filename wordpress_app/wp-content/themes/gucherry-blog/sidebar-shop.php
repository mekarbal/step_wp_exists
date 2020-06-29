<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Gucherry Blog
 */

if ( ! is_active_sidebar( 'gucherry-blog-sidebar-shop' ) ) {
	return;
}
?>
<div class="<?php gucherry_blog_sidebar_class(); ?>">
	<aside id="secondary" class="secondary-widget-area">
		<?php dynamic_sidebar( 'gucherry-blog-sidebar-shop' ); ?>
	</aside><!-- // aside -->
</div><!-- // col-lg-4 -->