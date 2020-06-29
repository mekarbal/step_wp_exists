<?php
/**
 * The Schema Template Functions which enhance the theme by hooking into WordPress
 *
 * @package The_Schema
 */

if( ! function_exists( 'the_schema_doctype' ) ) :
/**
 * Doctype Declaration
*/
function the_schema_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'the_schema_doctype', 'the_schema_doctype' );

if( ! function_exists( 'the_schema_head' ) ) :
/**
 * Before wp_head 
*/
function the_schema_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'the_schema_before_wp_head', 'the_schema_head' );

if( ! function_exists( 'the_schema_page_start' ) ) :
/**
 * Page Start
*/
function the_schema_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'the-schema' ); ?></a>
    <?php
}
endif;
add_action( 'the_schema_before_header', 'the_schema_page_start', 20 );

if( ! function_exists( 'the_schema_header' ) ) :
/**
 * Header Start
*/
function the_schema_header(){ ?>

    <header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader">
		<div class="container">
            
            <div class="menu-toggle">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </div>
            
            <div class="site-branding logo-text">

                    <?php
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){ ?>
                    <div class="site-logo" itemscope itemtype="http://schema.org/Organization">
                        <?php the_custom_logo(); ?>
                    </div>
                    <?php } ?>

                <div class="site-text-wrap">
                    <?php
                    if( is_front_page() ){ ?>
                        <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php 
                    }else{ ?>
                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                    }
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ){ ?>
                        <p  itemprop="description" class="site-description"><?php echo $description; ?></p>
                    <?php

                    } ?>
                </div>

            </div>

            <div class="menu-wrap">
        		<nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <button class="menu-toggle">
                        <span class="toggle-bar"></span>
                        <span class="toggle-bar"></span>
                        <span class="toggle-bar"></span>
                    </button>
        			<?php
        				wp_nav_menu( array(
        					'theme_location' => 'primary',
        					'menu_id'        => 'primary-menu',
                            'menu_class'     => 'nav-menu',
                            'fallback_cb'    => 'the_schema_primary_menu_fallback',
        				) );
        			?>
        		</nav><!-- #site-navigation -->
                
                <?php
                $ed_header_search = get_theme_mod('ed_header_search',true);
                if( $ed_header_search ){ ?>
                    <div class="header-search">
                        <button class="search-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18"><defs><style>.a{fill:none;}</style></defs><g transform="translate(83 -7842)"><rect class="a" width="18" height="18" transform="translate(-83 7842)"/><path d="M18,16.415l-3.736-3.736a7.751,7.751,0,0,0,1.585-4.755A7.876,7.876,0,0,0,7.925,0,7.876,7.876,0,0,0,0,7.925a7.876,7.876,0,0,0,7.925,7.925,7.751,7.751,0,0,0,4.755-1.585L16.415,18ZM2.264,7.925a5.605,5.605,0,0,1,5.66-5.66,5.605,5.605,0,0,1,5.66,5.66,5.605,5.605,0,0,1-5.66,5.66A5.605,5.605,0,0,1,2.264,7.925Z" transform="translate(-83 7842)"/></g></svg>
                        </button>
                        <div class="header-search-form" style="display: none;">
                            <div class="container">
                                <?php get_search_form(); ?>
                                <button class="close"></button>
                            </div>
                        </div>
                    </div>
                <?php } ?>

        	</div>

        </div>		
	</header>
    <?php 
}
endif;
add_action( 'the_schema_header', 'the_schema_header', 20 );

if( !function_exists('the_schema_header_banner') ):
/** Home Banner **/
function the_schema_header_banner(){

    if( ( is_home() || is_front_page() ) && get_theme_mod( 'ed_banner_section', true ) ){
        get_template_part( 'sections/banner' );
    }

}
endif;
add_action( 'the_schema_header_banner_home', 'the_schema_header_banner', 20 );

if( ! function_exists( 'the_schema_content_start' ) ) :
/**
 * Content Start
*/
function the_schema_content_start(){ 
    if( ! is_home() && !is_front_page() ){ ?>
    <div id="content" class="site-content">
    <?php
        if( is_singular('post') && ! is_front_page() ){
            $image_header = wp_get_attachment_image_url( get_post_thumbnail_id(), 'the-schema-single-post' );
            if( empty($image_header) ){ $image_header = get_template_directory_uri() .'/images/the-schema-single-post.jpg'; } ?>
            <header class="page-header" style="background-image: url(<?php echo esc_url($image_header); ?>);">
                <div class="container">
                <?php
                    the_title( '<h1 class="page-title">', '</h1>' );
                ?>
                </div>
            </header>

        <?php } ?>

        <div class="container">
    <?php
    }
    $home_sections = the_schema_get_home_sections();
    if( empty($home_sections) && is_front_page() ){ ?>
        <div id="content" class="site-content">
        <div class="container">
    <?php 
    }

}
endif;
add_action( 'the_schema_content', 'the_schema_content_start' );


if(!function_exists('the_schema_before_posts_header')):
/** Author Header **/
function the_schema_before_posts_header(){
    global $wp_query;
    $page_current = ( get_query_var('paged') ? get_query_var('paged') : 1 ); 
    if( is_author() ){
        ?>
        <header class="page-header">
            <div class="author-img">
                <?php the_schema_gravatar( get_the_author_meta( 'ID' ), 130 ); ?>
            </div>
            <div class="author-content-wrap">
                <h1 class="page-title">
                    <span class="sub-title"><?php echo esc_html__( 'All Posts By','the-schema' ); ?></span>
                    <?php
                    echo esc_html( get_the_author() );
                    ?>
                </h1>
                <?php if( get_the_author_meta( 'description' ) ){ ?>
                    <div class="author-desc">
                        <?php echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); ?>
                    </div>
                <?php } ?>
            </div>    
        </header>
        <?php

    }elseif(is_search()){ 
        ?>
        <header class="page-header">
            <h1 class="page-title"><?php echo esc_html__( 'Search Results For:','the-schema' ); ?></h1>
            <?php get_search_form(); ?>
            <span class="total-result"><?php echo absint( $wp_query->found_posts ). esc_html__(' Results','the-schema'); ?></span>
        </header>
        <?php 

    }elseif( is_archive() && !is_author()){ ?>

        <header class="page-header">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
            <span class="total-result"><?php echo absint( $wp_query->found_posts ).esc_html__(' Results','the-schema'); ?></span>
        </header>
    <?php
    }

    if( is_author() || is_archive() ){
        echo '<div class="showing-result">'.esc_html__('Showing: ','the-schema').absint(($page_current-1)*$wp_query->query_vars['posts_per_page']+1).' - '.absint(($page_current-1)*$wp_query->query_vars['posts_per_page']+$wp_query->post_count).esc_html__(' of ','the-schema').absint( $wp_query->found_posts ).esc_html__(' Results','the-schema').'</div>';
    }
}
endif;
add_action( 'the_schema_before_posts_content','the_schema_before_posts_header',10 );

if( ! function_exists( 'the_schema_post_entry_content_start' ) ) :
/**
 * Entru Content Start
*/
function the_schema_post_entry_content_start(){
    echo '<div class="post-content-wrap">';/** post-content-wrap Start */
}
endif;
add_action( 'the_schema_post_entry_content', 'the_schema_post_entry_content_start', 10 );

if( ! function_exists( 'the_schema_entry_header' ) ) :
/**
 * Entry Header
*/
function the_schema_entry_header(){ 

    $ed_post_date = get_theme_mod( 'ed_post_date', false) ;
    $ed_category = get_theme_mod( 'ed_category', false );
    $ed_post_author = get_theme_mod( 'ed_post_author', false );

    if( !is_single() ){ ?>
    <header class="entry-header">

        <div class="entry-meta">

            <?php if( !$ed_post_date ): ?>
                <span class="posted-on" itemprop="datePublished">
                         <?php the_schema_posted_on( true ); ?>
                </span>
            <?php endif;
            
            if( !$ed_category ) the_schema_category(); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>"><?php the_title('<h2 class="entry-title" itemprop="headline">','</h2>') ?></a>

    </header>
    <?php
    }else{ ?>
        <div id="sticky-inner-meta" class="entry-meta">
            <div class="sticky-inner" style="">
                <div class="sidebar__inner" style="position: relative;">
                    <?php
                    if( !$ed_post_author ) the_schema_posted_by();

                    if( !$ed_post_date ) the_schema_posted_on();

                    if( !$ed_category ) the_schema_category();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
endif;
add_action( 'the_schema_post_entry_content', 'the_schema_entry_header', 15 );


if ( ! function_exists( 'the_schema_page_entry_header' ) ) :
/**
 * Single Page Entry Header
 */
function the_schema_page_entry_header() {
    if( !is_front_page() ){ ?>
    <header class="page-header">
        <?php the_title('<h1 class="page-title">','</h1>'); ?>
    </header>
    <?php
    }
}
endif;
add_action( 'the_schema_before_page_entry_content', 'the_schema_page_entry_header', 15 );

if ( ! function_exists( 'the_schema_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function the_schema_post_thumbnail() {
	global $wp_query;
    $image_size  = 'thumbnail';
    $ed_featured = get_theme_mod( 'ed_featured_image', true );
    $sidebar     = the_schema_sidebar();
    
    if( is_home() || is_front_page() ){        
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" >';
        $image_size = ( $sidebar ) ? 'the-schema-home-post' : 'the-schema-home-post-full';
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            $home_sections = the_schema_get_home_sections();
            if( $home_sections ){
            echo '<img src="' . esc_url( get_template_directory_uri() . '/images/' . $image_size . '.jpg'  ) . '" alt="' . esc_attr( get_the_title() ) . '" itemprop="image" />';    
            }
        } 
        echo '</a></figure>';
    }elseif( is_archive() || is_search() ){
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" >';
        $image_size = ( $sidebar ) ? 'the-schema-home-post' : 'the-schema-archive-full';
        if( has_post_thumbnail() ){
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            echo '<img src="' . esc_url( get_template_directory_uri() . '/images/' . $image_size . '.jpg'  ) . '" alt="' . esc_attr( get_the_title() ) . '" itemprop="image" />';    
        } 
        echo '</a></figure>';
    }elseif( is_page() ){
        echo '<figure class="post-thumbnail">';
        $image_size = ( $sidebar ) ? 'the-schema-home-post' : 'the-schema-home-post-full';
        if( $ed_featured ){
            if( has_post_thumbnail() ){
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
            }
        }

        echo '</figure>';
    }
}
endif;
add_action( 'the_schema_before_page_entry_content', 'the_schema_post_thumbnail', 20);
add_action( 'the_schema_before_post_entry_content', 'the_schema_post_thumbnail', 15 );

if( ! function_exists( 'the_schema_entry_content' ) ) :
/**
 * Entry Content
*/
function the_schema_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content" itemprop="text">
		<?php
        $home_sections = the_schema_get_home_sections();
		if( ( empty( $home_sections ) && is_front_page() ) || ( !is_front_page() && ( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ) ) ){
            the_content();    
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-schema' ),
				'after'  => '</div>',
			) );
        }else{
            the_excerpt();
        }
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'the_schema_page_entry_content', 'the_schema_entry_content', 15 );
add_action( 'the_schema_post_entry_content', 'the_schema_entry_content', 20 );

if( ! function_exists( 'the_schema_entry_footer' ) ) :
/**
 * Entry Footer
*/
function the_schema_entry_footer(){

    $readmore = get_theme_mod( 'read_more_text', __( 'Continue Reading', 'the-schema' ) ); ?>
	<footer class="entry-footer">
		<?php
		if( is_single() ){
		    the_schema_tag();
		}
        $home_sections = the_schema_get_home_sections();
        if( ( !empty( $home_sections ) || !is_front_page() ) && ( is_front_page() || is_home() || is_archive() || is_search() ) ){
            echo '<a href="' . esc_url( get_the_permalink() ) . '" class="btn-readmore">' . esc_html( $readmore ) . '</a>';    
        }
            
        if( get_edit_post_link() ){
            edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'the-schema' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
        } ?>
            
	</footer><!-- .entry-footer -->

<?php
}
endif;
add_action( 'the_schema_page_entry_content', 'the_schema_entry_footer', 20 );
add_action( 'the_schema_post_entry_content', 'the_schema_entry_footer', 30 );

if( ! function_exists( 'the_schema_post_entry_content_end' ) ) :
/**
 * Entru Content End
*/
function the_schema_post_entry_content_end(){
    echo '</div>'; /** post-content-wrap end */
}
endif;
add_action( 'the_schema_post_entry_content', 'the_schema_post_entry_content_end', 40 );

if( ! function_exists( 'the_schema_navigation' ) ) :
/**
 * Navigation
*/
function the_schema_navigation(){
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<i class="fas fa-chevron-left"></i>' . esc_html__( 'Previous Article', 'the-schema' ) . '',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',esc_html__( 'Next Article', 'the-schema' ) . '<i class="fas fa-chevron-right"></i>',
    		false,
    		'',
    		'category'
    	); 
        
        if( $previous || $next ){?>            
            <nav class="navigation posts-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'the-schema' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'the-schema' ),
            'next_text'          => __( 'Next', 'the-schema' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'the-schema' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'the_schema_after_post_content', 'the_schema_navigation', 20 );
add_action( 'the_schema_after_posts_content', 'the_schema_navigation' );

if( ! function_exists( 'the_schema_author' ) ) :
/**
 * Author Section
*/
function the_schema_author(){
    $ed_author = get_theme_mod( 'ed_author', false );
    if( empty($ed_author) ){ ?>
    <div class="author-profile">
		<div class="author-img"><?php the_schema_gravatar( get_the_author_meta( 'ID' ), 130 ); ?></div>
		<div class="author-content-wrap">
			<?php 
                echo '<h2 class="page-title">' . esc_html( get_the_author() ) . '</h2>';
                echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) );
            ?>		
		</div>
	</div>
    <?php
    }
}
endif;
add_action( 'the_schema_after_post_content', 'the_schema_author', 15 );

if( ! function_exists( 'the_schema_related_posts' ) ) :
/**
 * Related Posts 
*/
function the_schema_related_posts(){
    $ed_related_post = get_theme_mod( 'ed_related', true );
    if( $ed_related_post ){
        the_schema_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'the_schema_after_post_content', 'the_schema_related_posts', 30 );

if( ! function_exists( 'the_schema_latest_posts' ) ) :
/**
 * Latest Posts
*/
function the_schema_latest_posts(){ 
    the_schema_get_posts_list( 'latest' );
}
endif;
add_action( 'the_schema_latest_posts', 'the_schema_latest_posts' );

if( ! function_exists( 'the_schema_comment' ) ) :
/**
 * Comments Template 
*/
function the_schema_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
endif;
add_action( 'the_schema_after_post_content', 'the_schema_comment', 40 );
add_action( 'the_schema_after_page_content', 'the_schema_comment' );

if( ! function_exists( 'the_schema_content_end' ) ) :
/**
 * Content End
*/
function the_schema_content_end(){ 
    if( !is_home() && !is_front_page() ){?>
        </div><!-- .site-content -->
    <?php
    }
    $home_sections = the_schema_get_home_sections();
    if( empty($home_sections) && is_front_page() ){ ?>
        </div><!-- .site-content -->
        </div><!-- .site-container -->
    <?php 
    }
}
endif;
add_action( 'the_schema_before_footer', 'the_schema_content_end', 20 );

if( ! function_exists( 'the_schema_footer_start' ) ) :
/**
 * Footer Start
*/
function the_schema_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'the_schema_footer', 'the_schema_footer_start', 20 );

if( ! function_exists( 'the_schema_footer_newsletter' ) ) :
/**
 * Footer Start
*/
function the_schema_footer_newsletter(){
    if( the_schema_is_btnw_activated() ): ?>

        <div class="newsletter-section">
            <?php 
            $footer_newsletter_shortcode = get_theme_mod('footer_newsletter_shortcode');
            if( $footer_newsletter_shortcode ){
                echo do_shortcode( $footer_newsletter_shortcode );
            } ?>
        </div>

    <?php endif;
}
endif;
add_action( 'the_schema_footer', 'the_schema_footer_newsletter', 25 );

if( ! function_exists( 'the_schema_footer_top' ) ) :
/**
 * Footer Top
*/
function the_schema_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="top-footer">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }   
}
endif;
add_action( 'the_schema_footer', 'the_schema_footer_top', 30 );

if( ! function_exists( 'the_schema_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function the_schema_footer_bottom(){ ?>
    <div class="bottom-footer">
		<div class="container">
			<div class="copyright">            
            <?php
                the_schema_get_footer_copyright();
                esc_html_e( 'The Schema | Developed By ', 'the-schema' );
                echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Themes', 'the-schema' ) . '</a>.';
                
                printf( esc_html__( ' Powered by %s', 'the-schema' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'the-schema' ) ) .'" target="_blank">WordPress</a>. ' );
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            
            <?php the_schema_social_links(); ?>
		</div>
	</div>
    <?php
}
endif;
add_action( 'the_schema_footer', 'the_schema_footer_bottom', 40 );

if( ! function_exists( 'the_schema_footer_end' ) ) :
/**
 * Footer End 
*/
function the_schema_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'the_schema_footer', 'the_schema_footer_end', 50 );

if( ! function_exists( 'the_schema_page_end' ) ) :
/**
 * Page End
*/
function the_schema_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'the_schema_after_footer', 'the_schema_page_end', 20 );
