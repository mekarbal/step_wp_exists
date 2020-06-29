<?php
/**
 * gucherry-blog Theme Customizer
 *
 * @package gucherry-blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gucherry_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /**
	 * Load custom customizer control for radio image control
	 */
	require get_template_directory() . '/inc/customizer/controls/class-customizer-radio-image-control.php';

	/**
	 * Load custom customizer control for toggle control
	 */
	require get_template_directory() . '/inc/customizer/controls/class-customizer-toggle-control.php';
    
    /**
	 * Load customizer functions for sanitization of input values of contol fields
	 */
	require get_template_directory() . '/inc/customizer/functions/sanitize-callback.php';
    
    // Upspell
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/upgrade-to-pro/upgrade.php';

	$wp_customize->register_section_type( 'GuCherry_Blog_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new GuCherry_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'GuCherry Blog Pro', 'gucherry-blog' ),
				'pro_text' => esc_html__( 'Buy Now', 'gucherry-blog' ),
				'pro_url'  => 'https://everestthemes.com/themes/gucherry-blog-pro/',
				'priority' => 1,
			)
		)
	);
    
    /**
	 * Load customizer functions for loading control field's choices, declaration of panel, section 
	 * and control fields
	 */
	require get_template_directory() . '/inc/customizer/functions/customizer-fields.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'gucherry_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'gucherry_blog_customize_partial_blogdescription',
		) );
	}
    
    /**
	 * Control Rearrange
	 */
    
    $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'gucherry-blog' );
    $wp_customize->get_control( 'background_color' )->section = 'background_image';
    $wp_customize->get_section( 'background_image' )->title = esc_html__( 'Site Background', 'gucherry-blog' );
    $wp_customize->get_control( 'header_image' )->priority = 30;
    
    $wp_customize->get_control( 'custom_logo' )->section = 'gucherry_blog_site_logo_section';
    $wp_customize->get_control( 'blogname' )->section = 'gucherry_blog_site_logo_section';
    $wp_customize->get_control( 'blogdescription' )->section = 'gucherry_blog_site_logo_section';
    $wp_customize->get_control( 'header_textcolor' )->section = 'gucherry_blog_site_logo_section';
    $wp_customize->get_control( 'display_header_text' )->section = 'gucherry_blog_site_logo_section';
    $wp_customize->get_control( 'site_icon' )->section = 'gucherry_blog_site_favicon_section';
    $wp_customize->get_control( 'header_image' )->section = 'gucherry_blog_main_header_section';
}
add_action( 'customize_register', 'gucherry_blog_customize_register' );

/**
 * Load active callback functions.
 */
require get_template_directory() . '/inc/customizer/functions/active-callback.php';

/**
 * Load option choices functions.
 */
require get_template_directory() . '/inc/customizer/functions/option-choices.php';

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gucherry_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gucherry_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Function to load dynamic styles.
 *
 * @since  1.0.0
 * @access public
 * @return null
 */
function dynamic_style() {
    
    ?>
    <style type="text/css">  
    <?php
        
    /*-----------------------------------------------------------------------------
                                SITE TYPOGRAPHY OPTIONS
    -----------------------------------------------------------------------------*/

    $fonts = gucherry_blog_fonts_array();

    $site_typography_font_family = get_theme_mod( 'gucherry_blog_site_typography_font_family', 'Cormorant+Garamond:400,400i,500,500i,600,600i,700,700i&display=swap' );    
    
    ?>   
        q,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6, 
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        blockquote,
        .site-title {

        <?php
                                   
            if( !empty( $site_typography_font_family ) ) {
                
            ?>
                font-family: <?php echo esc_attr( $fonts[ $site_typography_font_family ] ); ?>;
            <?php 
            
            }
                                   
            ?>
        }
    <?php
    
    $site_typography_line_height = get_theme_mod( 'gucherry_blog_site_typography_line_height', '1.1' );
    $site_typography_letter_spacing = get_theme_mod( 'gucherry_blog_site_typography_letter_spacing', '0' );
    
    ?>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6, 
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6
        {
        <?php
                                   
            if( !empty( $site_typography_line_height ) ) {
                
            ?>
            line-height: <?php echo esc_attr( $site_typography_line_height ); ?>;
            <?php 
            
            }
    
            if( !empty( $site_typography_letter_spacing ) ) {
                
            ?>
            letter-spacing: <?php echo esc_attr( $site_typography_letter_spacing ); ?>;
            <?php 
            
            }
                                   
            ?>
        }
    
    </style>
        
    <?php  
}
add_action( 'wp_head', 'dynamic_style' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gucherry_blog_customize_preview_js() {
	wp_enqueue_script( 'gucherry-blog-customizer', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'gucherry_blog_customize_preview_js' );

/**
 * Enqueue Customizer Scripts and Styles
 */
function gucherry_blog_enqueues() {

	wp_enqueue_style( 'gucherry-blog-customizer-style', get_template_directory_uri() . '/inc/customizer/assets/css/customizer-style.css' );
    
    wp_enqueue_style( 'gucherry-blog-upgrade', get_template_directory_uri() . '/inc/customizer/assets/css/upgrade.css' );
    
    wp_enqueue_script( 'gucherry-blog-upgrade', get_template_directory_uri() . '/inc/customizer/assets/js/upgrade.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    // Register the script
    wp_register_script( 'gucherry-blog-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-script.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ) , true );

    // Localize the script with new data
    $title_array = array(
        'custom_logo' => esc_html__( 'Logo Setup', 'gucherry-blog' ),
        'site_icon' => esc_html__( 'Favicon', 'gucherry-blog' ),
        'background_color' => esc_html__( 'Body Background', 'gucherry-blog' ),
        'header_image' => esc_html__( 'Header Image', 'gucherry-blog' ),
        'gucherry_blog_header_display_social_links' => esc_html__( 'Header Menu', 'gucherry-blog' ),
        'gucherry_blog_site_banner_post_category' => esc_html__( 'Banner Content', 'gucherry-blog' ),
        'gucherry_blog_site_pages_blog_page_display_post_featured_image' => esc_html__( 'Post Content', 'gucherry-blog' ),
        'gucherry_blog_site_pages_blog_page_sidebar_position' => esc_html__( 'Sidebar Position', 'gucherry-blog' ),
        'gucherry_blog_site_pages_archive_page_display_post_featured_image' => esc_html__( 'Post Content', 'gucherry-blog' ),
        'gucherry_blog_site_pages_archive_page_sidebar_position' => esc_html__( 'Sidebar Position', 'gucherry-blog' ),
        'gucherry_blog_site_pages_search_page_display_post_featured_image' => esc_html__( 'Post Content', 'gucherry-blog' ),
        'gucherry_blog_site_pages_search_page_sidebar_position' => esc_html__( 'Sidebar Position', 'gucherry-blog' ),
        'gucherry_blog_site_pages_post_single_display_post_featured_image' => esc_html__( 'Post Content', 'gucherry-blog' ),
        'gucherry_blog_site_pages_post_single_display_post_author_section' => esc_html__( 'Author Section', 'gucherry-blog' ),
        'gucherry_blog_site_pages_post_single_display_related_posts_section' => esc_html__( 'Related Posts Section', 'gucherry-blog' ),
        'gucherry_blog_site_footer_upload_footer_logo' => esc_html__( 'Upload Logo', 'gucherry-blog' ),
    );
    wp_localize_script( 'gucherry-blog-customizer-script', 'gucherry_blog', $title_array );

    // Enqueued script with localized data.
    wp_enqueue_script( 'gucherry-blog-customizer-script' );
}
add_action( 'customize_controls_enqueue_scripts', 'gucherry_blog_enqueues' );
