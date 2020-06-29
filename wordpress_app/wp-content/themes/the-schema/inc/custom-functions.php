<?php
/**
 * The Schema Custom functions and definitions
 *
 * @package The_Schema
 */

if ( ! function_exists( 'the_schema_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function the_schema_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on The Schema, use a find and replace
	 * to change 'the-schema' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'the-schema', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'the-schema' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'the_schema_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 
        'custom-logo', 
        array( 
            'height'      => 70,
            'width'       => 70,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ) 
        ) 
    );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 'custom-header', apply_filters( 'the_schema_custom_header_args', array(
		'default-image' => '',
		'width'         => 1920, /** change width as per theme requirement */
		'height'        => 600, /** change height as per theme requirement */
		'header-text'   => false,
        'default-image' => get_template_directory_uri() . '/images/header-image.jpg',
	) ) );
    
    register_default_headers( array(
        'default-image' => array(
            'url'           => '%s/images/header-image.jpg',
            'thumbnail_url' => '%s/images/header-image.jpg',
            'description'   => __( 'Default Header Image', 'the-schema' ),
        ),
    ) );


    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'the-schema-schema', 600, 60 );
    add_image_size( 'the-schema-home-post', 780, 440, true );
    add_image_size( 'the-schema-single-post', 1920, 600, true );
    add_image_size( 'the-schema-home-post-full', 1170, 560, true );
    add_image_size( 'the-schema-related', 120, 80, true );
    add_image_size( 'the-schema-archive-full', 470, 250, true );
    
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array( 'home', 'blog' ),
        
        // Default to a static front page and assign the front and posts pages.
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),
        
        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus' => array(
            // Assign a menu to the "top" location.
            'primary' => array(
                'name' => __( 'Primary', 'the-schema' ),
                'items' => array(
                    'page_home',
                    'page_blog'
                )
            )
        ),
    );
    
    $starter_content = apply_filters( 'the_schema_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );
}
endif;
add_action( 'after_setup_theme', 'the_schema_setup' );

if( ! function_exists( 'the_schema_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function the_schema_content_width() {

    $GLOBALS['content_width'] = apply_filters( 'the_schema_content_width', 780 );
}
endif;
add_action( 'after_setup_theme', 'the_schema_content_width', 0 );

if( ! function_exists( 'the_schema_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function the_schema_template_redirect_content_width(){
	$sidebar = the_schema_sidebar();
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 780;
	}else{
        if( is_singular() ){
            if( the_schema_sidebar( true ) === 'full-width centered' ){
                $GLOBALS['content_width'] = 780;
            }else{
                $GLOBALS['content_width'] = 1170;
            }                
        }else{
            $GLOBALS['content_width'] = 1170;
        }
	}
}
endif;
add_action( 'template_redirect', 'the_schema_template_redirect_content_width' );

if( ! function_exists( 'the_schema_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */

function the_schema_scripts(){
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    $the_schema_font_query_args = array('family' => 'Abhaya+Libre:400,500,600,700,800|Nunito+Sans:400,400i,600,600i,700,700i');
    wp_enqueue_style('the-schema-google-fonts', add_query_arg($the_schema_font_query_args, "//fonts.googleapis.com/css"));

    if( the_schema_is_woocommerce_activated() )
    wp_enqueue_style( 'the-schema-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array(), THE_SCHEMA_THEME_VERSION );

    wp_enqueue_style( 'the-schema', get_stylesheet_uri(), array(), THE_SCHEMA_THEME_VERSION );

    if( get_theme_mod('ed_jquery_combined',false) ){

        wp_enqueue_script( 'the-schema', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), THE_SCHEMA_THEME_VERSION, true );
        
    }else{
    	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', false );

        wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', false );

        if( ( get_theme_mod( 'ed_lazy_load', true ) || get_theme_mod( 'ed_lazy_load_cimage', true ) ) && !is_page_template( 'templates/portfolio.php' ) )
            
        wp_enqueue_script( 'layzr', get_template_directory_uri() . '/js' . $build . '/layzr' . $suffix . '.js', array( 'jquery' ), '5.0.13', true );

        wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/js' . $build . '/sticky-kit' . $suffix . '.js', array( 'jquery' ), '5.0.13', true );

    	wp_enqueue_script( 'the-schema', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), THE_SCHEMA_THEME_VERSION, true );
    }
    $array = array(
        'rtl'       => is_rtl(),
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
    );
    
    wp_localize_script( 'the-schema', 'the_schema_data', $array );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'the_schema_scripts' );

if( ! function_exists( 'the_schema_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function the_schema_admin_scripts(){
    wp_enqueue_style( 'the-schema-admin', get_template_directory_uri() . '/inc/css/admin.css', '', THE_SCHEMA_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'the_schema_admin_scripts' );

if( ! function_exists( 'the_schema_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function the_schema_body_classes( $classes ) {

    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    $classes[] = the_schema_sidebar( true );
    
    if( is_archive() || is_search()){
        $classes[] = 'list-view';
    }

    
	return $classes;
}
endif;
add_filter( 'body_class', 'the_schema_body_classes' );

if( ! function_exists( 'the_schema_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function the_schema_post_classes( $classes ){
    
    if( is_archive() || is_search()){
        $classes[] = 'post';
    }
    
    return $classes;
}
endif;
add_filter( 'post_class', 'the_schema_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function the_schema_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'the_schema_pingback_header' );

if( ! function_exists( 'the_schema_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function the_schema_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'the-schema' ) : __( 'Name', 'the-schema' ) );
    $email    = ( $req ? __( 'Email*', 'the-schema' ) : __( 'Email', 'the-schema' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'the-schema' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'the-schema' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'the-schema' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'the-schema' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'the_schema_change_comment_form_default_fields' );

if( ! function_exists( 'the_schema_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function the_schema_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'the-schema' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'the-schema' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'the_schema_change_comment_form_defaults' );

if ( ! function_exists( 'the_schema_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function the_schema_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'the_schema_excerpt_more' );

if ( ! function_exists( 'the_schema_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function the_schema_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 25 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'the_schema_excerpt_length', 999 );

if( ! function_exists( 'the_schema_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function the_schema_get_the_archive_title( $title ){

    if ( is_category() ) {

        $title = wp_kses(
            single_cat_title( '<span class="sub-title">'.esc_html__('Category','the-schema').'</span>', false ),
            array(
                'span' => array(
                    'class' => array(),
            ),
        ));

    }elseif ( is_tag() ) {

        $title = wp_kses(
            single_tag_title( '<span class="sub-title">'.esc_html__('Tags','the-schema').'</span>', false ),
            array(
                'span' => array(
                    'class' => array(),
            ),
        ));

    }elseif ( is_year() ) {
        $title = get_the_date( __( 'Y', 'the-schema' ) );
    }elseif ( is_month() ) {
        $title = get_the_date( __( 'F Y', 'the-schema' ) );
    }elseif ( is_day() ) {
        $title = get_the_date( __( 'F j, Y', 'the-schema' ) );
    }elseif ( is_post_type_archive() ) {

        $title = wp_kses(
            post_type_archive_title( '<span class="sub-title">'.esc_html__('Archive','the-schema').'</span>', false ),
            array(
                'span' => array(
                    'class' => array(),
            ),
        ));

    }elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        $title = single_term_title( '', false );
    }
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'the_schema_get_the_archive_title' );

if( ! function_exists( 'the_schema_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function the_schema_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'the-schema-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = the_schema_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( the_schema_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "http://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"  => esc_html( get_the_title( $post->ID ) ),
            "image"     => array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => the_schema_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "publisher" => array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">';
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        } else {
            echo wp_json_encode( $args );
        }
        echo '</script>';
    }
}
endif;
add_action( 'wp_head', 'the_schema_single_post_schema' );

if( ! function_exists( 'the_schema_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function the_schema_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'the_schema_get_comment_author_link', 10, 3 );

if( ! function_exists( 'the_schema_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function the_schema_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'the_schema_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'the-schema' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'the-schema' ), $name ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=the-schema-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'the-schema' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?the_schema_admin_notice=1"><?php esc_html_e( 'Dismiss', 'the-schema' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'the_schema_admin_notice' );

if( ! function_exists( 'the_schema_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function the_schema_update_admin_notice(){
    if ( isset( $_GET['the_schema_admin_notice'] ) && $_GET['the_schema_admin_notice'] = '1' ) {
        update_option( 'the_schema_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'the_schema_update_admin_notice' );

if( ! function_exists( 'the_schema_restore_admin_notice' ) ) :
/**
 * Restoring admin notice on theme switch
 */
function the_schema_restore_admin_notice(){
    update_option( 'the_schema_admin_notice', false );
}
endif;
add_action( 'after_switch_theme', 'the_schema_restore_admin_notice' );