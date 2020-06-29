<?php
/**
 * Customizer Options Choices
 *
 * @package gucherry-blog
 */


if( !function_exists( 'gucherry_blog_categories_array' ) ) :
	/*
	 * Function to get blog categories
	 */
	function gucherry_blog_categories_array() {

		$post_taxonomy = 'category';
		$post_terms = get_terms( $post_taxonomy );
		$post_categories = array();
		foreach( $post_terms as $post_term ) {
			$post_categories[$post_term->slug] = $post_term->name;
		}

		return $post_categories;

	}
endif;

if( !function_exists( 'gucherry_blog_sidebar_position_array' ) ) :
	/*
	 * Function to get blog categories
	 */
	function gucherry_blog_sidebar_position_array() {

		$sidebar_positions = array(
            'left'  => get_template_directory_uri() . '/inc/customizer/assets/images/sidebar_left.png',
            'right' => get_template_directory_uri() . '/inc/customizer/assets/images/sidebar_right.png',
            'none'  => get_template_directory_uri() . '/inc/customizer/assets/images/sidebar_none.png',
        );
        
        return $sidebar_positions;

	}
endif;

if( !function_exists( 'gucherry_blog_pagination_type_array' ) ) :
	/*
	 * Function to get select pagination style
	 */
	function gucherry_blog_pagination_type_array() {

		$alignment = array(
            'numeric'             => esc_html__( 'Numeric', 'gucherry-blog' ),
            'button_click_load'   => esc_html__( 'Button Click Load', 'gucherry-blog' ),
        );
        
        return $alignment;

	}
endif;

if( !function_exists( 'gucherry_blog_post_meta_array' ) ) :
	/*
	 * Function to get select post meta
	 */
	function gucherry_blog_post_meta_array() {

		$alignment = array(
            'post_date'        => esc_html__( 'Display Posted Time', 'gucherry-blog' ),
            'post_author'      => esc_html__( 'Display Post Author', 'gucherry-blog' ),
        );
        
        return $alignment;

	}
endif;

if( !function_exists( 'gucherry_blog_fonts_array' ) ) :
	/**
	 * Function to load choices of google font family.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function gucherry_blog_fonts_array() {

		$fonts = array(
            'Cormorant+Garamond:400,400i,500,500i,600,600i,700,700i&display=swap' => esc_html__( 'Cormorant Garamond', 'gucherry-blog' ),
            'Caveat:400,700' => esc_html( 'Caveat' ),
            'Dancing+Script:400,700' => esc_html( 'Dancing Script' ),
            'Heebo:400,500,700,800' => esc_html( 'Heebo' ),
            'Kelly+Slab' => esc_html( 'Kelly Slab' ),
            'Lato:400,400i,700,700i' => esc_html( 'Lato' ),
            'Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i' => esc_html( 'Montserrat' ),
            'Nunito+Sans:400,400i,600,600i,700,700i' => esc_html__( 'Nunito Sans', 'gucherry-blog' ),
            'Open+Sans:400,400i,600,600i,700,700i,800,800i' => esc_html( 'Open Sans' ),
            'Oswald:400,500,600,700' => esc_html( 'Oswald' ),
            'Pacifico' => esc_html( 'Pacifico' ),
            'Playfair+Display:400,400i,700,700i' => esc_html( 'Playfair Display' ),
            'Poppins:400,400i,500,500i,600,600i,700,700i,800,800i' => esc_html( 'Poppins' ),
            'Ubuntu:400,400i,500,500i,700,700i' => esc_html( 'Ubuntu' ),
        );
        
        return $fonts;

	}
endif;
