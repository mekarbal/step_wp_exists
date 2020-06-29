<?php

/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'gucherry_blog_fonts_url' ) ) :

    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function gucherry_blog_fonts_url() {

        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        $font_options = array();

        $font_options = gucherry_blog_selected_fonts();

        if( empty( $font_options ) ) {

            /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language.*/
            if ('off' !== _x('on', 'Cormorant Garamond: on or off', 'gucherry-blog')) {

                $font_options[] = 'Cormorant+Garamond:400,400i,500,500i,600,600i,700,700i&display=swap';
            }
            
        }
        
        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language.*/
        if ('off' !== _x('on', 'Poppins font: on or off', 'gucherry-blog')) {

            $font_options[] = 'Poppins:400,400i,500,600,700,700i';
        }

        $font_options = array_unique( $font_options );

        foreach ( $font_options as $f) {

            $f_family = explode(':', $f);

            $f_family = str_replace('+', ' ', $f_family);

            $font_family = ( !empty( $f_family[1]) ) ? $f_family[1] : '';

            $fonts[] = $f_family[0].':'.$font_family;

        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Fallback For Main Menu
 */
if ( !function_exists( 'gucherry_blog_navigation_fallback' ) ) {
	/**
     * Return unordered list.
     *
     * @since 1.0.0
     * @return unordered list.
     */
    function gucherry_blog_navigation_fallback() {
        ?>
        <ul class="primary-menu">
            <?php
            if( current_user_can( 'edit_theme_options' ) ) {
                ?>
                <li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Add Menu', 'gucherry-blog' ); ?></a></li>
                <?php
            } else {
                wp_list_pages( array( 'title_li' => '', 'depth' => 3 ) ); 
            }
            ?>
        </ul>
        <?php
    }
}

/**
 * Customize Readmore Link.
 */
function post_excerpt_more( $more ) {
  	return '...';
}
add_filter( 'excerpt_more', 'post_excerpt_more' );

/**
* Filter the except length to 40 words default.
*/
if( !function_exists( 'gucherry_blog_excerpt_length' ) ) {
   /*
    * Excerpt Length
    */
   function gucherry_blog_excerpt_length( $length ) {
       
       if( is_admin() ) {
           return $length;
       }

       $excerpt_length = get_theme_mod( 'gucherry_blog_excerpt_length', 40 );

       if( absint( $excerpt_length ) > 0 ) {
           $excerpt_length = absint( $excerpt_length );
       }
       return $excerpt_length;
   }
}
add_filter( 'excerpt_length', 'gucherry_blog_excerpt_length' );

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function gucherry_blog_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . home_url( '/' ) . '" >
    <label>
        <span class="screen-reader-text">' . _x( 'Search for:', 'label', 'gucherry-blog' ) . '</span>
        <input type="search" class="search-field" placeholder="' . esc_attr_x( 'Type Keywords &amp; Hit Enter', 'placeholder', 'gucherry-blog' ) . '" value="' . get_search_query() . '" name="s" />
    </label>
    
    <button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true">
    </i></button>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'gucherry_blog_search_form' );

add_action('wp_ajax_loadmore', 'gucherry_blog_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'gucherry_blog_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function gucherry_blog_loadmore_ajax_handler() {

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;
		gucherry_blog_paginator( $_POST['first_page'] );
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

function gucherry_blog_paginator( $first_page_url ){

	global $wp_query;

	$first_page_url = untrailingslashit( $first_page_url );

	$first_page_url_exploded = array();

	$first_page_url_exploded = explode( "/?", $first_page_url );

	$search_query = '';

	if( isset( $first_page_url_exploded[ 1 ] ) ) {

		$search_query = "/?" . $first_page_url_exploded[ 1 ];
		$first_page_url = $first_page_url_exploded[ 0 ];
	}

	$posts_per_page = (int) $wp_query->query_vars[ 'posts_per_page' ];

	$current_page = (int) $wp_query->query_vars[ 'paged' ];

	$max_page = $wp_query->max_num_pages;

	if( $max_page <= 1 ) {

        return;
    }

	if( empty( $current_page ) || $current_page == 0 ) {

        $current_page = 1;
    }

	$links_in_the_middle = 2;

	$links_in_the_middle_minus_1 = $links_in_the_middle - 1;

	$first_link_in_the_middle = $current_page - floor( $links_in_the_middle_minus_1 / 2 );

	$last_link_in_the_middle = $current_page + ceil( $links_in_the_middle_minus_1 / 2 );

	if( $first_link_in_the_middle <= 0 ) {

        $first_link_in_the_middle = 1;
    }

	if( ( $last_link_in_the_middle - $first_link_in_the_middle ) != $links_in_the_middle_minus_1 ) {

        $last_link_in_the_middle = $first_link_in_the_middle + $links_in_the_middle_minus_1;
    }

	if( $last_link_in_the_middle > $max_page ) {

        $first_link_in_the_middle = $max_page - $links_in_the_middle_minus_1;

        $last_link_in_the_middle = (int) $max_page;
    }

	if( $first_link_in_the_middle <= 0 ) {

        $first_link_in_the_middle = 1;
    }

	// begin to generate HTML of the pagination
	$pagination = '<div class="gc-pagination"><div class="pagination-entry"><nav id="gucherry_blog_pagination" class="navigation pagination" role="navigation"><div class="nav-links">';

	// when to display "..." and the first page before it
	if ( $first_link_in_the_middle >= 2 && $links_in_the_middle < $max_page ) {

		$pagination.= '<a href="'. $first_page_url . $search_query . '" class="page-numbers">1</a>'; // first page

		if( $first_link_in_the_middle != 2 ) {

			$pagination .= '<span class="page-numbers extend">...</span>';
        }
	}

	for( $i = $first_link_in_the_middle; $i <= $last_link_in_the_middle; $i++ ) {

		if( $i == $current_page ) {

			$pagination.= '<span class="page-numbers current">'.$i.'</span>';

		} else {

			$pagination .= '<a href="'. $first_page_url . '/page/' . $i . $search_query .'" class="page-numbers">'.$i.'</a>';
		}
	}

	if ( $last_link_in_the_middle < $max_page ) {

		if( $last_link_in_the_middle != ( $max_page-1 ) ) {

			$pagination .= '<span class="page-numbers extend">...</span>';
        }

		$pagination .= '<a href="'. $first_page_url . '/page/' . $max_page . $search_query .'" class="page-numbers">'. $max_page .'</a>';
	}

	// end HTML
	$pagination.= "</div></nav></div></div>\n";

	if( $current_page < $max_page ) {

		$pagination.= '<div class="permalink load_more_container"><a id="gucherry_blog_loadmore" class="gc-button-primary medium" href=""><span>Load more posts</span></a></div>';
    }

	// replace first page before printing it
	echo str_replace( array( "/page/1?", "/page/1\"" ), array( "?", "\"" ), $pagination );
}
