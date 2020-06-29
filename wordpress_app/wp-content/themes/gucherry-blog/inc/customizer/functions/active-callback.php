<?php
/**
 * Collection of active callback functions for customizer fields.
 *
 * @package gucherry-blog
 */

/**
 * Active callback function for when banner is active.
 */
if( ! function_exists( 'gucherry_blog_active_banner' ) ) {

	function gucherry_blog_active_banner( $control ) {

		if ( $control->manager->get_setting( 'gucherry_blog_site_banner_display_banner' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}

/**
 * Active callback function for when banner is active.
 */
if( ! function_exists( 'gucherry_blog_active_footer_logo' ) ) {

	function gucherry_blog_active_footer_logo( $control ) {

		if ( $control->manager->get_setting( 'gucherry_blog_site_footer_display_footer_logo' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}

/**
 * Active callback function for when related posts section is active.
 */
if( ! function_exists( 'gucherry_blog_active_related_posts_section' ) ) {

	function gucherry_blog_active_related_posts_section( $control ) {

		if ( $control->manager->get_setting( 'gucherry_blog_site_pages_post_single_display_related_posts_section' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}