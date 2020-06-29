<?php
/**
 * Performance Related Functions
 *
 * @package the_schema
 */

if( ! function_exists( 'the_schema_image_lazy_load_attr' ) ) :
/**
 * Add data-layzr attribute to featured image ( for lazy load )
 *
 * @param array $attr
 * @param WP_Post $attachment
 * @param string|array $size
 *
 * @return array
 */
function the_schema_image_lazy_load_attr( $attr, $attachment, $size ) {
	$ed_lazyload = get_theme_mod( 'ed_lazy_load', false );
    
    if( is_admin() || is_feed() || ( function_exists ( 'is_cart' ) && is_cart() ) ) return $attr;
	
    if( $ed_lazyload && !is_page_template( 'templates/portfolio.php' ) ){
		$attr['data-layzr'] = $attr['src'];
		$attr['src'] = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
		if ( isset( $attr['srcset'] ) ) {
			$attr['data-layzr-srcset'] = $attr['srcset'];
			$attr['srcset'] = '';
		}
	}

	return $attr;
}
endif;
add_filter( 'wp_get_attachment_image_attributes', 'the_schema_image_lazy_load_attr', 10, 3 );

if( ! function_exists( 'the_schema_content_image_lazy_load_attr' ) ) :
/**
 * Add data-layzr attribute to post content images ( for lazy load )
 *
 * @param string $content
 * @return string
 */
function the_schema_content_image_lazy_load_attr( $content ) {
	$ed_lazyload_content = get_theme_mod( 'ed_lazy_load_cimage', false );
	
    if ( $ed_lazyload_content && ! empty( $content ) ) {
		$content = preg_replace_callback(
			'/<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>/',
			'the_schema_content_image_lazy_load_attr_callback',
			$content
		);
	}

	return $content;
}
endif;
add_filter( 'the_content', 'the_schema_content_image_lazy_load_attr' );

if( ! function_exists( 'the_schema_content_image_lazy_load_attr_callback' ) ) :
/**
 * Callback to move src to data-src and replace it with a 1x1 tranparent image.
 *
 * @param $matches
 * @return string
 */
function the_schema_content_image_lazy_load_attr_callback( $matches ) {
	$transparent_img = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
	if ( preg_match( '/ data-lazy *= *"false" */', $matches[0] ) ) {
		return '<img' . $matches[1] . 'src="' . $matches[2] . '"' . $matches[3] . '>';
	} else {
		return '<img' . $matches[1] . 'src="' . $transparent_img . '" data-layzr="' . $matches[2] . '"' . str_replace( 'srcset=', 'data-layzr-srcset=', $matches[3]). '>';
	}
}
endif;

if( ! function_exists( 'the_schema_gravatar' ) ) :
/**
 * returns the gravatar for author.
*/
function the_schema_gravatar( $id, $image_size ){
    $ed_lazyload_gravatar = get_theme_mod( 'ed_lazyload_gravatar', false );
    if( $ed_lazyload_gravatar ){
        $avatar_url = get_avatar_url( $id, array( 'size' => $image_size ) );
        if( $avatar_url ){ ?>
            <img class="avatar" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-layzr="<?php echo esc_url( $avatar_url ); ?>" alt="" />
            <?php
        }
    }else{
        echo get_avatar( $id, $image_size );        
    }    
} 
endif;