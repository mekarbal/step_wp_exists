<?php
/**
 * The Schema Standalone Functions.
 *
 * @package The_Schema
 */

if ( ! function_exists( 'the_schema_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function the_schema_posted_on( $class = false ) {
	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    $posted_on_text = '';
    if( !$class ) $posted_on_text = '<span class="meta-title">'.esc_html__('Published On','the-schema').'</span>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time></time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
            if( !$class ) $on = __( 'updated on ', 'the-schema' );		  
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    $posted_on = sprintf( '%1$s %2$s',$posted_on_text, '<a href="' . esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))) . '" rel="bookmark">' . $time_string . '</a>' );

	
	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'the_schema_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function the_schema_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'Written By %s', 'post author', 'the-schema' ),
		'<span itemprop="name"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url">' . esc_html( get_the_author() ) . '</a></span>' 
    );
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person">' . $byline . '</span>';
}
endif;

if( ! function_exists( 'the_schema_comment_count' ) ) :
/**
 * Comment Count
*/
function the_schema_comment_count(){
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments"><i class="far fa-comment"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'the-schema' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}    
}
endif;

if ( ! function_exists( 'the_schema_category' ) ) :
/**
 * Prints categories
 */
function the_schema_category(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
            if(is_single()){
			    echo '<span class="category" itemprop="about"><span class="meta-title">'.esc_html__('Category','the-schema').'</span>' . $categories_list . '</span>';
            }else{
                echo '<span class="category" itemprop="about">' . $categories_list . '</span>';
            }
		}
	}
}
endif;

if ( ! function_exists( 'the_schema_tag' ) ) :
/**
 * Prints tags
 */
function the_schema_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="tags" itemprop="about">' . esc_html__( '%1$sTags:%2$s %3$s', 'the-schema' ) . '</div>', '<span>', '</span>', $tags_list );
		}
	}
}
endif;

if( ! function_exists( 'the_schema_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function the_schema_get_posts_list( $status ){
    global $post;
    
    $args = array(
        'post_type'           => 'post',
        'posts_status'        => 'publish',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 4;
        $title                  = __( 'Recommended Articles', 'the-schema' );
        $class                  = 'recent-posts';
        $image_size             = 'the-schema-related';
        break;
        
        case 'related':
        $args['posts_per_page'] = 3;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'Recommended Articles', 'the-schema' ) );
        $class                  = 'related-posts';
        $image_size             = 'the-schema-popular';        
        $cats                   = get_the_category( $post->ID );        
        if( $cats ){
            $c = array();
            foreach( $cats as $cat ){
                $c[] = $cat->term_id; 
            }
            $args['category__in'] = $c;
        }        
        break;
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?> 
    <div class="additional-posts">

            <?php if( $title ) echo '<h2 class="title">' . esc_html( $title ) . '</h2>'; ?> 

            <div class="block-wrap">

                <?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <div class="block clearfix">
                        <div class="entry-meta">
                            <span class="posted-on" itemprop="datePublished">
                                    <?php the_schema_posted_on( true ); ?>
                            </span>
                        </div>

                        <?php if( get_the_title() ): ?>
                            <header class="entry-header">
                                <h3 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>                        
                            </header><!-- .entry-header -->
                        <?php endif; ?>

                        <figure class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">

                                <?php if( has_post_thumbnail() ){ 
                                    the_post_thumbnail( 'the-schema-related', array( 'itemprop' => 'image' ) ); 
                                }else{
                                    echo '<img src="' . esc_url( get_template_directory_uri() . '/images/the-schema-related.jpg'  ) . '" alt="' . esc_attr( get_the_title() ) . '" itemprop="image" />';    
                                }  ?>

                            </a>
                        </figure><!-- .post-thumbnail -->
                        
                    </div>
                <?php } ?>

            </div><!-- .block-wrap -->
        </div>
        <?php
        wp_reset_postdata();
    }
}
endif;

if( ! function_exists( 'the_schema_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function the_schema_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'the-schema' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'the_schema_social_links' ) ) :
/**
 * Social Links 
*/
function the_schema_social_links( $echo = true ){ 
    $social_links = get_theme_mod( 'social_links' );
    $ed_social    = get_theme_mod( 'ed_social_links', false ); 
    
    if( $ed_social && $social_links && $echo ){ ?>
    <div class="footer-social">
        <ul class="social-list">
        	<?php 
            foreach( $social_links as $link ){
        	   if( $link['link'] ){ ?>
                <li>
                    <a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank" rel="nofollow noopener">
                        <?php echo esc_html( $link['text'] ); ?>
                    </a>
                </li>  	   
                <?php
                } 
            } 
            ?>
    	</ul>
    </div>
    <?php    
    }elseif( $ed_social && $social_links ){
        return true;
    }else{
        return false;
    }
    ?>
    <?php                                
}
endif;

if( ! function_exists( 'the_schema_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function the_schema_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) the_schema_gravatar( $comment, $args['avatar_size'] ); ?>
               <?php echo '<b class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">'.wp_kses_post(get_comment_author_link()).'</b>'; ?>
        	</div><!-- .comment-author vcard -->

            <div class="comment-metadata commentmetadata">
                <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'the-schema' ), get_comment_date(),  get_comment_time() ); ?></time>
                </a>
            </div>

            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'the-schema' ); ?></em>
                <br />
            <?php endif; ?>

        </footer>
        <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>

        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    	</div>

        
	<?php if ( 'div' != $args['style'] ) : ?>
    </div><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;



if( ! function_exists( 'the_schema_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function the_schema_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_the_schema_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_the_schema_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }
    }elseif( !is_search() && the_schema_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'shop-sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }elseif( is_404() ){
        $return = $class ? 'full-width' : false;
    }else{
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'sidebar';    
            }                         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }    
    return $return; 
}
endif;

if( ! function_exists( 'the_schema_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function the_schema_get_home_sections(){
    $ed_banner = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    
    $sections = array( 
        'about'   => array( 'sidebar' => 'the-schema-about' ),
        'client'  => array( 'sidebar' => 'the-schema-client' ),
        'service' => array( 'sidebar' => 'the-schema-service' ),
        'blog'    => array( 'section' => 'blog' ) 
    );
    
    $enabled_section = array();
    
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $k );
        }else{
            if( get_theme_mod( 'ed_' . $v['section'] . '_section', true ) ) array_push( $enabled_section, $v['section'] );
        }
    }  
    
    return apply_filters( 'the_schema_home_sections', $enabled_section );
}
endif;

if( ! function_exists( 'the_schema_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function the_schema_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function the_schema_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is Raratheme Companion active or not
*/
function the_schema_is_raratheme_companion(){
    return class_exists( 'Raratheme_Companion' ) ? true : false;        
}

/**
 * Query WooCommerce activation
 */
function the_schema_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}