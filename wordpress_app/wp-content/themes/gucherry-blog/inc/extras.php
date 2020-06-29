<?php
/**
 * Extra Functions
 *
 */

/*
 * Function to get selected dynamic google fonts
 */
if( !function_exists( 'gucherry_blog_selected_fonts' ) ) {

	function gucherry_blog_selected_fonts() {

		$fonts = array();
        
        $site_typography_font_family = get_theme_mod( 'gucherry_blog_site_typography_font_family', 'Cormorant+Garamond:400,400i,500,500i,600,600i,700,700i&display=swap' );

        if( !empty( $site_typography_font_family ) ) {

        	$fonts[] = $site_typography_font_family;
        }

		$fonts = array_unique( $fonts );

		return $fonts;
	}
}


/**
 * Banner Posts Query
 */
if( !function_exists( 'gucherry_blog_banner_posts_query' ) ) {
    
    function gucherry_blog_banner_posts_query() {
        
        $banner_post_category = get_theme_mod( 'gucherry_blog_site_banner_post_category' );
        
        $banner_posts_no = get_theme_mod( 'gucherry_blog_site_banner_post_no', 5 );
        
        $banner_args = array(
          'post_type'      => 'post',  
        );
        
        if( !empty( $banner_post_category ) ) {
            $banner_args['category_name'] = $banner_post_category;
        }
        
        if( !empty( $banner_posts_no ) ) {
            $banner_args['posts_per_page'] = absint( $banner_posts_no );
        }
        
        $banner_query = new WP_Query( $banner_args );
        
        return $banner_query;
    }         
}

/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'gucherry_blog_recommended_plugins' ) ) :
    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function gucherry_blog_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'Everest Toolkit', 'gucherry-blog' ),
                'slug'     => 'everest-toolkit',
                'required' => false,
            ),
        );

        tgmpa( $plugins );
    }

endif;
add_action( 'tgmpa_register', 'gucherry_blog_recommended_plugins' );
