<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gucherry-blog
 */

if ( ! function_exists( 'gucherry_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function gucherry_blog_posted_on( $display_meta ) {
        
        if( $display_meta == true && get_post_type() == 'post' ) {
            
            $posted_on = sprintf(
                /* translators: %s: post date. */
                esc_html_x( '%s ago', '%s = human-readable time difference', 'gucherry-blog' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
            );

            echo '<li class="posted-time"><span>' . $posted_on . '</span></li>'; // WPCS: XSS OK.
        }
	}
endif;

if ( ! function_exists( 'gucherry_blog_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function gucherry_blog_posted_by( $display_meta ) {
        
        if( $display_meta == true && get_post_type() == 'post' ) {
            
            $byline = sprintf(
                /* translators: %s: post author. */
                esc_html_x( 'by %s', 'post author', 'gucherry-blog' ),
                '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
            );

            echo '<li class="author">' . $byline . '</li>'; // WPCS: XSS OK.
        }
	}
endif;

if ( ! function_exists( 'gucherry_blog_comments_no_meta' ) ) :
	/**
	 * Prints HTML with meta information for no of comments.
	 */
	function gucherry_blog_comments_no_meta( $display_meta ) {

		if( $display_meta == true && get_post_type() === 'post' ) {

        	if( ( comments_open() || get_comments_number() ) ) {
        		?>
        		<li class="comment">
        			<a href="<?php the_permalink(); ?>">
        				<?php 
        				if( get_comments_number() <= 1 ) {
        					if( get_comments_number() == 0 ) {
        						echo esc_html__( 'Leave a comment', 'gucherry-blog' );
        					} else {
		        				/* translators: %s: comments number. */
		        				printf( esc_html__( "%s comment", 'gucherry-blog' ), absint( get_comments_number() ) ); 
		        			}
	        			} else {
	        				/* translators: %s: comments number. */
	        				printf( esc_html__( "%s comments", 'gucherry-blog' ), absint( get_comments_number() ) ); 
	        			}
        				?>
        			</a>
        		</li>
	          	<?php
	        }
	    }
	}
endif;

if( ! function_exists( 'gucherry_blog_categories_meta' ) ) :
	/*
	 * Prints HTML with meta information for post categories.
	 */
	function gucherry_blog_categories_meta( $display_meta ) {

		if( $display_meta == true ) {

			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {

				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list();

				if ( $categories_list ) {
					echo '<div class="entry-cats">' . wp_kses_post( $categories_list ) . '</div>'; // WPCS: XSS OK.
				}
			}
		}
	}
endif;

if( ! function_exists( 'gucherry_blog_post_read_time' ) ) :
	/*
	 * Prints HTML with meta information for post read time.
	 */
	function gucherry_blog_post_read_time( $display_meta ) {

		if( $display_meta == true && get_post_type() == 'post' ) {
            
            $post_id = get_the_ID();
            $post_object = get_post( $post_id );
            $content = $post_object->post_content;
            $word_count = str_word_count( strip_tags( $content ) );

            $per_min_words = absint( 240 );
            $total_time = round( ($word_count)/($per_min_words) );

            if( $total_time > 1 ) {
                $time_unit = esc_html__( ' minutes', 'gucherry-blog' );
            } else {
                $time_unit = esc_html__( ' minute', 'gucherry-blog' );
            }

            echo '<li class="read-time">' . esc_html__( 'Read Time: ', 'gucherry-blog' ) . '<span>' . esc_html( $total_time ) . esc_html( $time_unit ) . '</span></li>';
        }
	}
endif;

if( ! function_exists( 'gucherry_blog_tags_meta' ) ) :
	/*
	 * Prints HTML with meta information for post categories.
	 */
	function gucherry_blog_tags_meta( $display_meta ) {

		if( $display_meta == true  ) {

			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();

				if ( $tags_list ) {
					echo '<div class="entry-tags"><div class="post-tags">' . wp_kses_post( $tags_list ) . '</div></div>'; // WPCS: XSS OK.
				}
			}
		}
	}
endif;


if ( ! function_exists( 'gucherry_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function gucherry_blog_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() || is_page() ) {
			?>

			<figure class="thumb featured-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			</figure><!-- // thumb featured-image -->

		<?php
        } else {
            
            $display_featured_image = true;
            
            if( is_home() ) {
                $display_featured_image = get_theme_mod( 'gucherry_blog_site_pages_blog_page_display_post_featured_image', true );
            }
            
            if( is_search() ) {
                $display_featured_image = get_theme_mod( 'gucherry_blog_site_pages_search_page_display_post_featured_image', true );
            }
            
            if( is_archive() ) {
                $display_featured_image = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_post_featured_image', true );
            }
            
            if( $display_featured_image == true ) {    
            ?>
            <div class="mid-block is-post-format-block">
                <figure class="thumb is-standard">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'gucherry-blog-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                    </a> 
                </figure><!-- // thumb -->
            </div><!-- // mid-block -->
            <?php   
            }
        }
	}
endif;
