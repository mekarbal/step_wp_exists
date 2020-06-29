<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package gucherry-blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gucherry_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
    $sidebar_position = gucherry_blog_sidebar_position();
	if ( ! is_active_sidebar( 'gucherry-blog-sidebar' ) || $sidebar_position == 'none' ) {
		$classes[] = 'no-sidebar';
	}
    
    if( get_background_image() || get_background_color() != 'ffffff'  ) {
        $classes[] = 'boxed';
    }

	return $classes;
}
add_filter( 'body_class', 'gucherry_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gucherry_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gucherry_blog_pingback_header' );

/**
 * Social links template
 */
if( ! function_exists( 'gucherry_blog_social_links_template' ) ) {
    
    function gucherry_blog_social_links_template( $position ) {
        
        $display_social_links = get_theme_mod( 'gucherry_blog_header_display_social_links', true );
        
        if( $position == 'header' ) {
            
            if( $display_social_links == true ) {
                
                $facebook_link = get_theme_mod( 'gucherry_blog_social_links_facebook_link' );
                $twitter_link = get_theme_mod( 'gucherry_blog_social_links_twitter_link' );
                $instagram_link = get_theme_mod( 'gucherry_blog_social_links_instagram_link' );

                if( !empty( $facebook_link ) ) { 
                ?>
                <li>
                    <a href="<?php echo esc_url( $facebook_link ); ?>">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </li>
                <?php
                }
                if( !empty( $twitter_link ) ) {
                ?>
                <li>
                    <a href="<?php echo esc_url( $twitter_link ); ?>">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </li>
                <?php
                }
                if( !empty( $instagram_link ) ) {
                ?>
                <li>
                    <a href="<?php echo esc_url( $instagram_link ); ?>">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </li>
                <?php
                }
            }
        }  
    }
}

/**
 * Selects banner template
 */
if( ! function_exists( 'gucherry_blog_banner_template' ) ) {
    
    function gucherry_blog_banner_template() {
        
        $display_banner = get_theme_mod( 'gucherry_blog_site_banner_display_banner', true );
        
        if( $display_banner == true ) {

            get_template_part( 'template-parts/banner/banner', 'one' );
            
        }
    
    }
}

/**
 * Post Format Icons
 */
if ( ! function_exists( 'gucherry_blog_post_format_icons' ) ) {
	
    function gucherry_blog_post_format_icons() {
        
        $format = array(
            'gallery',
            'audio',
            'video',
            'quote',
            'link'
        );
        
        if( has_post_format( $format ) ) {
        ?>
        <div class="is-post-format">
           <?php
            
            $format = get_post_format();
            if( $format == 'gallery' ) {
                
                $format_span_class = 'is-gallery';
                $format_icon_class = 'feather icon-image';
                
            }
            
            if( $format == 'audio' ) {
                
                $format_span_class = 'is-audio';
                $format_icon_class = 'feather icon-headphones';
                
            }
            
            if( $format == 'video' ) {
                
                $format_span_class = 'is-video';
                $format_icon_class = 'feather icon-video';
                
            }
            
            if( $format == 'quote' ) {
                
                $format_span_class = 'is-quote';
                $format_icon_class = 'ti-quote-left';
                
            }
            
            if( $format == 'link' ) {
                
                $format_span_class = 'is-link';
                $format_icon_class = 'feather icon-external-link';
                
            }
            ?>
            <span class="<?php echo esc_attr( $format_span_class ); ?>"><i class="<?php echo esc_attr( $format_icon_class ); ?>"></i></span>
        </div><!-- // is-post-format -->
        <?php
        } 
    }
}

/**
 * Post Format Getting Media 
 */
if ( ! function_exists( 'gucherry_blog_post_format_media' ) ) {
	
    function gucherry_blog_post_format_media() {
        
        global $post;
        
        
        $format = get_post_format();

        if( $format == 'audio' ) {
            
            $content = apply_filters( 'the_content', get_the_content() );
            $audio = false;
            // Only get audio from the content if a playlist isn't present.
            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
                $audio = get_media_embedded_in_content( $content, array( 'audio', 'iframe' ) );
            }
            // If not a single post, highlight the audio file.
            if ( ! empty( $audio ) ) {
            ?>
            <div class="mid-block is-post-format-block">
                <div class="is-audio-format">
                <?php
                echo $audio[0]; // WPCS xss ok.
                ?>
                </div><!-- // is-audio-format -->
            </div><!-- // mid-block -->
            <?php
            } else {
                gucherry_blog_post_thumbnail();
            }
        }

        if( $format == 'gallery' ) {
            
            $gallery_images_ids = array();
            
            if ( has_block( 'gallery', $post->post_content ) ) {
                
                $post_blocks = parse_blocks( $post->post_content );
                
                if( $post_blocks ) {
                    
                    foreach( $post_blocks as $block ) {
                        
                        if( $block['blockName'] == 'core/gallery' ) {
                            
                            $gallery_images_ids = $block['attrs']['ids'];
                            
                            break;
                        }
                    }
                }
            } else {
                gucherry_blog_post_thumbnail();
            }
            
            if( is_array( $gallery_images_ids ) ) {
                ?>
                <div class="mid-block is-post-format-block">
                    <figure class="thumb owl-carousel is-gallery-format">
                        <?php
                        foreach( $gallery_images_ids as $image_id ) {
                            
                            $image_src = wp_get_attachment_image_src( $image_id, 'gucherry-blog-thumbnail-one' );
                            
                            if( $image_src ) {
                                ?>
                                <div class="item" style="background-image:url(<?php echo esc_url( $image_src[0] ); ?>);"></div><!-- // item -->
                                <?php
                            }
                        }
                        ?>
                    </figure><!-- // thumb -->
                </div><!-- // mid-block -->
                <?php
            }
        }

        if( $format == 'quote' ) {
            
            if ( has_block( 'quote', $post->post_content ) ) {
                
                $post_blocks = parse_blocks( $post->post_content );
                
                if( $post_blocks ) {
                    
                    foreach( $post_blocks as $block ) {
                        
                        if( $block['blockName'] == 'core/quote' ) {
                            
                            $quote_string = $block['innerHTML'];
                            
                            break;
                        }
                    }
                }
            } else {
                gucherry_blog_post_thumbnail();
            }
            
            if( $quote_string ) {
                ?>
                <div class="mid-block is-post-format-block">
                <div class="is-quote-format">
                    <?php
                    echo wp_kses_post( $quote_string );
                    ?>
                </div><!-- // is-quote-format -->
            </div><!-- // mid-block -->
                <?php
            }
        }

        if( $format == 'video' ) {
            
            $content = apply_filters( 'the_content', get_the_content() );
            $video = false;

            // Only get video from the content if a playlist isn't present.
            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
                $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
            }
            // If not a single post, highlight the audio file.
            if ( ! empty( $video ) ) {
            ?>
            <div class="mid-block is-post-format-block">
                <div class="is-video-format">
                <?php
                echo $video[0]; // WPCS xss ok.
                ?>
                </div><!-- // is-audio-format -->
            </div><!-- // mid-block -->
            <?php
            } else {
                gucherry_blog_post_thumbnail();
            }
        }
        
    }
}

/**
 * Function to check position of sidebar.
 */
if( !function_exists( 'gucherry_blog_sidebar_position' ) ) {

    function gucherry_blog_sidebar_position() {

    	$sidebar_position = '';
        
        if( class_exists( 'WooCommerce' ) ) {
			if ( is_woocommerce() || is_checkout() || is_cart() && is_active_sidebar( 'gucherry-blog-sidebar-shop') ) {
				$sidebar_position = get_theme_mod( 'gucherry_blog_woocommerce_sidebar_position', esc_html__( 'right', 'gucherry-blog' ) );
				return $sidebar_position;
			}
		}

        if( is_active_sidebar( 'gucherry-blog-sidebar' ) ) {

            if( !is_singular() ) {

                if( is_archive() ) {

                    $sidebar_position = get_theme_mod( 'gucherry_blog_site_pages_archive_page_sidebar_position', 'right' );
                } 

                if( is_search() ) {

                    $sidebar_position = get_theme_mod( 'gucherry_blog_site_pages_search_page_sidebar_position', 'right' );
                } 

                if( is_home() ) {

                    $sidebar_position = get_theme_mod( 'gucherry_blog_site_pages_blog_page_sidebar_position', 'right' );
                }
            } else {

                $sidebar_position = get_post_meta( get_the_ID(), 'gucherry_blog_sidebar_position', true );
            }

            if( empty( $sidebar_position ) ) {

                $sidebar_position = 'right';
            }
        } else {

            $sidebar_position = 'none';
        }

    	return $sidebar_position;
    }
}

/**
 * Add custom class for main container containing posts.
 */
if( ! function_exists( 'gucherry_blog_main_container_class' ) ) {

	function gucherry_blog_main_container_class() {

		$container_class = '';
        
        $sidebar_position = gucherry_blog_sidebar_position();
        
		$sticky_enabled = get_theme_mod( 'gucherry_blog_site_sidebar_enable_sticky_sidebar', true );

		if( $sidebar_position == 'none' || !is_active_sidebar( 'gucherry-blog-sidebar' ) ) {
            
            $container_class = 'col-12';
	
		} else {

			$container_class = 'col-lg-8 col-md-12';
		}

		if( $sticky_enabled == true && $sidebar_position != 'none' ) {

			$container_class .= ' sticky-portion';
		}

		echo esc_attr( $container_class );
	}
}

/**
 * Add custom class for sidebar.
 */
if( ! function_exists( 'gucherry_blog_sidebar_class' ) ) {

	function gucherry_blog_sidebar_class() {

		$sidebar_class = 'col-lg-4 col-md-12';
		$sticky_enabled = get_theme_mod( 'gucherry_blog_site_sidebar_enable_sticky_sidebar', true );

		if( $sticky_enabled == true ) {
			$sidebar_class .= ' sticky-portion';
		}
        
		echo esc_attr( $sidebar_class );
	}
}

/**
 * Function that defines posts pagination.
 */
if( ! function_exists( 'gucherry_blog_pagination' ) ) {

	function gucherry_blog_pagination() {
        
        $pagination_type = get_theme_mod( 'gucherry_blog_site_pages_pagination_type', 'numeric' );
        
        if( $pagination_type == 'numeric' ) {
        
            ?>
            <div class="gc-pagination">
                <div class="pagination-entry">
                <?php

                the_posts_pagination( array(
                    'mid_size' => 0,
                    'prev_text' => esc_html__( 'Prev', 'gucherry-blog' ),
                    'next_text' => esc_html__( 'Next', 'gucherry-blog' ),
                ) );

                 ?>
                </div><!-- // pagination-entry -->
            </div><!-- // gc-pagination -->
            <?php
        } else {

            gucherry_blog_paginator( get_pagenum_link() );
        }
	}
}

/**
 * Add custom class for excerpt container.
 */
if( ! function_exists( 'gucherry_blog_dropcap_class' ) ) {

	function gucherry_blog_dropcap_class() {
        
        $enable_dropcap = false;
        
		if( is_home() ) {
			$enable_dropcap = get_theme_mod( 'gucherry_blog_site_pages_blog_page_enable_drop_cap', true );
		}
        
        if( is_archive() ) {
			$enable_dropcap = get_theme_mod( 'gucherry_blog_site_pages_archive_page_enable_drop_cap', true );
		}
        
        if( is_search() ) {
			$enable_dropcap = get_theme_mod( 'gucherry_blog_site_pages_search_page_enable_drop_cap', true );
		}
        
        if( $enable_dropcap == true ) {
            $dropcap_class = ' has-dropcap';
            echo esc_attr( $dropcap_class );
        }
	}
}

/**
 * Breadcrumb declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'gucherry_blog_breadcrumb' ) ) :

 	function gucherry_blog_breadcrumb() {

 		$display_breadcrumb = get_theme_mod( 'gucherry_blog_site_breadcrumb_enable_breadcrumb', true ); 

 		if( $display_breadcrumb == true ) {
 			?>
 			<div class="gc-breadcrumb">
                <div class="breadcrumb-entry">
                    <?php everestthemes_breadcrumb_trail(); ?>
                </div><!-- // breadcrumb-entry -->
            </div><!-- // gc-breadcrumb -->
 			<?php
 		}  		
 	}
endif;

/**
 * Function that defines pages links.
 */
if( ! function_exists('gucherry_blog_pages_links') ) {

function gucherry_blog_pages_links() {

        $pages_links_args = array(
            'before'    => '<div class="page-links">' . esc_html__( 'Pages:', 'gucherry-blog' ),
            'after'     => '</div>',
        );

        wp_link_pages( $pages_links_args );
    }
}

/**
 * Function that defines post navigation.
 */
if( ! function_exists( 'gucherry_blog_post_navigation' ) ) {

	function gucherry_blog_post_navigation() {
		
		$next_post = get_next_post();

	    $previous_post = get_previous_post();
        
        ?>
        <div class="post-navigation">
            <div class="nav-links">
              <?php
               if (!empty( $previous_post )):
                ?>
                <div class="nav-previous">
                    <span><?php echo esc_html__( 'Prev post', 'gucherry-blog' ); ?></span>
                    <a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>"><?php echo esc_attr( $previous_post->post_title ); ?></a>
                </div>
                <?php
                endif;
        
               if (!empty( $next_post )):
                ?>
                <div class="nav-next">
                    <span><?php echo esc_html__( 'Next post', 'gucherry-blog' ); ?></span>
                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo esc_attr( $next_post->post_title ); ?></a>
                </div>
                <?php
                endif;
                ?>
            </div><!-- // nav-links -->
        </div><!-- // post-navigation -->
        <?php
	}
}

/**
 * Check WooCommerce WooCommerce pages
 *
 * @return bol.
 */
function gucherry_blog_is_woocommerce_page() {

	if ( !class_exists( 'WooCommerce' ) ) {
		return false;
	}

	if( is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ) {
		return true;
	}

	return false;

}

/**
 * Page left sidebar
 *
 * @param $sidebar_position left | right.
 */
function gucherry_blog_page_sidebar_left( $sidebar_position ) {

	if( true == gucherry_blog_is_woocommerce_page() ) {
		if ( ('left' === $sidebar_position) && is_active_sidebar( 'gucherry-blog-sidebar-shop') ) {
			get_sidebar('shop');
		}
	} else {
		if ( is_page() && ('left' === $sidebar_position) && is_active_sidebar( 'gucherry-blog-sidebar') ) {
			get_sidebar();
		}
	}

}
add_action( 'page_sidebar_left', 'gucherry_blog_page_sidebar_left', 10, 1 );

/**
 * Page right sidebar
 *
 * @param $sidebar_position left | right.
 */
function gucherry_blog_page_sidebar_right( $sidebar_position ) {

	if( true === gucherry_blog_is_woocommerce_page() ) {
		if ( ('right' === $sidebar_position) && is_active_sidebar( 'gucherry-blog-sidebar-shop') ) {
			get_sidebar('shop');
		}
	} else {
		if ( is_page() && ('right' === $sidebar_position) && is_active_sidebar( 'gucherry-blog-sidebar') ) {
			get_sidebar();
		}
	}

}
add_action( 'page_sidebar_right', 'gucherry_blog_page_sidebar_right', 10, 1 );
