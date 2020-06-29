<?php
/**
 * Template part for displaying author detail
 *
 * @package gucherry-blog
 */

$display_related_posts_section = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_related_posts_section', true );

if( $display_related_posts_section == true ) :

    $related_posts_section_post_no = get_theme_mod( 'gucherry_blog_site_pages_post_single_related_posts_section_post_no', 4 );

    $related_posts_query_args = array(
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    );

    if( absint( $related_posts_section_post_no ) > 0 ) {
        $related_posts_query_args['posts_per_page'] = absint( $related_posts_section_post_no );
    } else {
        $related_posts_query_args['posts_per_page'] = 4;
    }

    $current_object = get_queried_object();

    if ( $current_object instanceof WP_Post ) {

        $current_id = $current_object->ID;

        if ( absint( $current_id ) > 0 ) {

            // Exclude current post.
            $related_posts_query_args['post__not_in'] = array( absint( $current_id ) );

            // Include current posts categories.
            $categories = wp_get_post_categories( $current_id );

            if ( ! empty( $categories ) ) {

                $related_posts_query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $categories,
                        'operator' => 'IN',
                    )
                );
            }
        }
    }

    $related_posts_query = new WP_Query( $related_posts_query_args );

    if( $related_posts_query->have_posts() ) :

        $related_posts_section_title = get_theme_mod( 'gucherry_blog_site_pages_post_single_related_posts_section_title', esc_html__( 'Related Posts', 'gucherry-blog' ) );

        $related_posts_section_display_post_meta = get_theme_mod( 'gucherry_blog_site_pages_post_single_related_posts_section_display_post_meta', esc_html__( 'post_date', 'gucherry-blog' ) );

        ?>
        <div class="related-posts">
            <div class="related-inner">
               <?php
                if( !empty( $related_posts_section_title ) ) :
                ?>
                <div class="section-title">
                    <h3><?php echo esc_html( $related_posts_section_title ); ?></h3>
                </div><!-- // section-title -->
                <?php
                endif;
                ?>
                <div class="related-entry">
                    <div class="row">
                    <?php
                    while( $related_posts_query->have_posts() ) :

                        $related_posts_query->the_post();
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <article class="hentry">
                                <div class="box">
                                <?php
                                if( has_post_thumbnail() ) :
                                    ?>
                                    <div class="left">
                                        <figure class="thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'gucherry-blog-thumbnail-two', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                            </a>
                                        </figure><!-- // thumb -->
                                    </div><!-- // left -->
                                    <?php
                                    endif;
                                    ?>
                                    <div class="right">
                                        <div class="post-content">
                                            <div class="post-title">
                                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            </div><!-- // post-title -->
                                            <div class="entry-metas">
                                                <ul>
                                                    <?php
                                                    if( $related_posts_section_display_post_meta == 'post_date' ) {
                                                        gucherry_blog_posted_on( true );
                                                    } else {
                                                        gucherry_blog_posted_by( true );
                                                    }
                                                    ?>
                                                </ul>
                                            </div><!-- // entry-metas -->
                                        </div><!-- // post-content -->
                                    </div><!-- // right -->
                                </div><!-- // box -->
                            </article><!-- // hentry -->
                        </div><!-- // col -->
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div><!-- // row -->
                </div><!-- // related-entry -->
            </div><!-- // related-inner -->
        </div><!-- // related-posts -->
        <?php
    endif;
endif;