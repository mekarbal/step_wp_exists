<?php
add_action( 'after_setup_theme', 'envo_business_setup' );

if ( !function_exists( 'envo_business_setup' ) ) :

	/**
	 * Global functions
	 */
	function envo_business_setup() {

		// Theme lang.
		load_theme_textdomain( 'envo-business', get_template_directory() . '/languages' );

		// Add Title Tag Support.
		add_theme_support( 'title-tag' );

		// Register Menus.
		register_nav_menus(
			array(
				'main_menu' => esc_html__( 'Main menu', 'envo-business' ),
			)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'envo-business-single', 1170, 460, true );

		// Add Custom Background Support.
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		add_theme_support( 'custom-logo', array(
			'height'		 => 60,
			'width'			 => 200,
			'flex-height'	 => true,
			'flex-width'	 => true,
			'header-text'	 => array( 'site-title', 'site-description' ),
		) );

		// Adds RSS feed links to for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// WooCommerce support.
		add_theme_support( 'woocommerce' );
		
		// Recommend plugins.
		add_theme_support( 'recommend-plugins', array(
			'kingcomposer' => array(
				'name'				 => esc_html__( 'KingComposer', 'envo-business' ),
				'active_filename'	 => 'kingcomposer/kingcomposer.php',
				/* translators: %1$s "KingComposer" string */
				'description' => sprintf( esc_html__( 'To take full advantage of all the features this theme has to offer, please install and activate the %s plugin.', 'envo-business' ), '<strong>KingComposer</strong>' ),
			),
			'envothemes-importer-kingcomposer' => array(
				'name'				 => esc_html__( 'EnvoThemes Demo Importer for KingComposer', 'envo-business' ),
				'active_filename'	 => 'envothemes-importer-kingcomposer/envothemes-importer-kingcomposer.php',
				'description' => esc_html__( 'Save time by importing our demo data: your website will be set up and ready to be customized in minutes.', 'envo-business' ),
			),
		) );
		// Define KC attachment expiration.
		// define('KC_ATTACHS_XML_EXPIRATION', 14*DAY_IN_SECONDS);
	}

endif;

/**
 * Set Content Width
 */
function envo_business_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'envo_business_content_width', 1170 );
}

add_action( 'after_setup_theme', 'envo_business_content_width', 0 );

/**
 * Register custom fonts.
 */
function envo_business_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto Condensed, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto_condensed = _x( 'on', 'Roboto Condensed font: on or off', 'envo-business' );

	if ( 'off' !== $roboto_condensed ) {
		$font_families = array();

		$font_families[] = 'Roboto Condensed:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function envo_business_theme_stylesheets() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'envo-business-fonts', envo_business_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );
	// Theme stylesheet.
	wp_enqueue_style( 'envo-business-stylesheet', get_stylesheet_uri(), array('bootstrap'), '1.0.5'  );
}

add_action( 'wp_enqueue_scripts', 'envo_business_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function envo_business_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'envo-business-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), '1.0.5', true );
}

add_action( 'wp_enqueue_scripts', 'envo_business_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php' );

/**
 * Register Custom Metaboxes
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/metaboxes.php' );

/**
 * Register Theme Info Page
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/dashboard.php' );

/**
 * Register PRO notify
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/customizer.php' );

add_action( 'widgets_init', 'envo_business_widgets_init' );

/**
 * Register the Sidebar(s)
 */
function envo_business_widgets_init() {
	register_sidebar(
		array(
			'name'			 => esc_html__( 'Right sidebar', 'envo-business' ),
			'id'			 => 'envo-business-right-sidebar',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<h3 class="widget-title">',
			'after_title'	 => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'			 => __( 'Footer section', 'envo-business' ),
			'id'			 => 'envo-business-footer-area',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-3">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<h3 class="widget-title">',
			'after_title'	 => '</h3>',
		)
	);
}

function envo_business_main_content_width_columns() {

	$columns = '12';

	if ( is_active_sidebar( 'envo-business-right-sidebar' ) ) {
		$columns = $columns - 3;
	}

	echo absint( $columns );
}

if ( !function_exists( 'envo_business_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function envo_business_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'envo-business' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . envo_business_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}

endif;


if ( !function_exists( 'envo_business_time_link' ) ) :

	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function envo_business_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date() );

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
		/* translators: %s: post date */
		__( 'Posted on %s', 'envo-business' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}

endif;

if ( !function_exists( 'envo_business_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function envo_business_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'envo-business' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $categories_list || $tags_list ) {

			echo '<div class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( $categories_list || $tags_list ) {

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<div class="cat-links"><span class="space-right">' . esc_html__( 'Category:', 'envo-business' ) . '</span>' . $categories_list . '</div>';
					}

					if ( $tags_list ) {
						echo '<div class="tags-links"><span class="space-right">' . esc_html__( 'Tagged', 'envo-business' ) . '</span>' . $tags_list . '</div>';
					}
				}
			}
			if ( comments_open() ) :
				echo '<div class="comments-template">';
				comments_popup_link( esc_html__( 'Leave a comment', 'envo-business' ), esc_html__( 'One comment', 'envo-business' ), esc_html__( '% comments', 'envo-business' ), 'comments-link', esc_html__( 'Comments are closed for this post', 'envo-business' ) );
				echo '</div>';
			endif;

			edit_post_link();

			echo '</div>';
		}
	}

endif;

if ( !function_exists( 'envo_business_generate_construct_footer' ) ) :
	/**
	 * Build footer
	 */
	add_action( 'envo_business_generate_footer', 'envo_business_generate_construct_footer' );

	function envo_business_generate_construct_footer() {
		?>
		<p class="footer-credits-text text-center">
			<?php 
			printf( 
			/* Translators: Link to WordPress.org */
			__( 'Proudly powered by %s', 'envo-business' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'envo-business' ) ) . '">WordPress</a>' ); 
			?>
			<span class="sep"> | </span>
			<?php 
			printf( 
			/* Translators: Link to theme homepage */ 
			__( 'Theme: %1$s', 'envo-business' ), '<a href="http://envothemes.com/">Envo Business</a>' ); 
			?>
		</p> 
		<?php
	}

endif;

if ( !function_exists( 'envo_business_custom_class' ) ) :
	/**
	 * Add body class to homepage template
	 */
	add_filter( 'body_class', 'envo_business_custom_class' );

	function envo_business_custom_class( $classes ) {
		global $post;

		if ( !empty( $post ) ) {
			if ( is_page_template( 'template-parts/template-homepage.php' ) ) {
				$transparent = get_post_meta( $post->ID, 'header_options_transparent-header', true );
				if ( $transparent == '1' ) {
					$classes[] = 'transparent-header';
				}
			}
		}
		return $classes;
	}
	
endif;

if ( !function_exists( 'envo_business_custom_head_color' ) ) :
	/**
	 * Generate color for homepage header
	 */

	add_action( 'wp_head', 'envo_business_custom_head_color', 1 );

	function envo_business_custom_head_color() {
		global $post;

		if ( !empty( $post ) ) {
			if ( is_page_template( 'template-parts/template-homepage.php' ) ) {
				$color = get_post_meta( $post->ID, 'header_options_header-font-color', true );
				if ( $color != '' ) {
					?>
					<style type="text/css">
						.transparent-header .site-title a, .transparent-header .site-title a:hover, .transparent-header #site-navigation p.site-description { color: <?php echo esc_attr( $color ); ?> }
						.transparent-header.openNav .site-title a, .transparent-header.openNav .site-title a:hover, .transparent-header.openNav #site-navigation p.site-description { color: initial; }
						@media (min-width: 768px) {
							.transparent-header #site-navigation .navbar-nav > li > a, .transparent-header #site-navigation:not(.shrink) #mega-menu-wrap-main_menu #mega-menu-main_menu > li.mega-menu-item > a.mega-menu-link {
								color: <?php echo esc_attr( $color ); ?>;
							}
						}
					</style>
					<?php
				}
			}
		}
	}

endif;
