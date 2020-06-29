<?php

/**
 * Column per row
 */
add_filter('loop_shop_columns', 'gucherry_blog_loop_columns', 999);
if (!function_exists('gucherry_blog_loop_columns')) {
	function gucherry_blog_loop_columns() {
		return 3; // 3 products per row
	}
}