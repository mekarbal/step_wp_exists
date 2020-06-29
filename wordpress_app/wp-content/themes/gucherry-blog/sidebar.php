<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gucherry-blog
 */

if ( ! is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
	return;
}
?>
<div class="<?php gucherry_blog_sidebar_class(); ?>">
    <aside id="secondary" class="secondary-widget-area">
        <?php dynamic_sidebar( 'gucherry-blog-sidebar' ); ?>
    </aside><!-- // aside -->
</div><!-- // col-lg-4 -->