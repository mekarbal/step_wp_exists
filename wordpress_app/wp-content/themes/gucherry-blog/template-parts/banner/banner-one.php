<?php

/**
 * The template for banner one
 *
 * @package gucherry-blog
 */

$banner_query = gucherry_blog_banner_posts_query();
if( $banner_query -> have_posts() ) {

?>
       
       <section class="mastbanner gc-banner-s1">
        <div class="banner-inner">
            <div class="gc-container">
                <div class="banner-entry">
                    <div class="owl-carousel gc-banner-slider-s1">
                   <?php
                    while( $banner_query -> have_posts() ) {
                        
                        $banner_query -> the_post();
                        
                        $banner_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        
                        if( !empty( $banner_image_url ) ) {
                        ?>
                        <div class="item">
                            <article class="hentry">
                                <div class="gc-row">
                                    <div class="gc-col left">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure class="thumb standard" style="background-image:url(<?php echo esc_url( $banner_image_url ); ?>);">
                                            <?php gucherry_blog_post_format_icons(); ?>
                                            </figure><!-- // thumb -->
                                        </a>
                                    </div><!-- // gc-col -->
                                    <div class="gc-col right">
                                        <div class="post-content">
                                            <?php gucherry_blog_categories_meta( true ); ?>
                                            <div class="post-title">
                                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            </div><!-- // post-title -->
                                            <div class="entry-metas">
                                                <ul>
                                                    <?php gucherry_blog_posted_on( true ); ?>
                                                    <?php gucherry_blog_post_read_time( true ); ?>
                                                </ul>
                                            </div><!-- // entry-metas -->
                                            <div class="permalink">
                                                <a class="read-more-button" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'gucherry-blog' ); ?></a>
                                            </div><!-- // permalink -->
                                        </div><!-- // post-content -->
                                    </div><!-- // gc-col -->
                                </div><!-- // gc-row -->
                            </article>
                            <!--// hentry -->
                        </div><!-- // item -->
                    <?php
                        } //end of banner image
                    } //end of while loop
                    wp_reset_postdata();
                    ?>
                    </div><!-- // owl-carosel -->
                </div><!-- // banner-entry -->
            </div><!-- // gc-container -->
        </div><!-- // banner-inner -->
    </section><!-- // mastbanner gc-banner-s1 -->
    
<?php
}