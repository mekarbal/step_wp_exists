<?php
/**
 * Template part for displaying quote post format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gucherry-blog
 */
if( is_home() ) {
    
    $display_post_category = get_theme_mod( 'gucherry_blog_site_pages_blog_page_display_post_category', true );
    $display_post_date = get_theme_mod( 'gucherry_blog_site_pages_blog_page_display_post_date', true );
    $display_post_author = get_theme_mod( 'gucherry_blog_site_pages_blog_page_display_post_author', true );
    $display_post_read_time = get_theme_mod( 'gucherry_blog_site_pages_blog_page_display_post_read_time', true );
    $display_post_comment_no = get_theme_mod( 'gucherry_blog_site_pages_blog_page_display_post_comment_no', true );

}

if( is_archive() ) {

    $display_post_category = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_post_category', true );
    $display_post_date = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_post_date', true );
    $display_post_author = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_post_author', true );
    $display_post_read_time = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_post_read_time', true );
    $display_post_comment_no = get_theme_mod( 'gucherry_blog_site_pages_archive_page_display_post_comment_no', true );

}

if( is_search() ) {

    $display_post_category = get_theme_mod( 'gucherry_blog_site_pages_search_page_display_post_category', true );
    $display_post_date = get_theme_mod( 'gucherry_blog_site_pages_search_page_display_post_date', true );
    $display_post_author = get_theme_mod( 'gucherry_blog_site_pages_search_page_display_post_author', true );
    $display_post_read_time = get_theme_mod( 'gucherry_blog_site_pages_search_page_display_post_read_time', true );
    $display_post_comment_no = get_theme_mod( 'gucherry_blog_site_pages_search_page_display_post_comment_no', true );

}
?>
<article class="hentry">
    <div class="post-content">
        <div class="top-block">
            <?php gucherry_blog_categories_meta( $display_post_category ); ?>
            <div class="post-title">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div><!-- // post-title -->
            <div class="entry-metas">
                <ul>
                    <?php gucherry_blog_posted_on( $display_post_date ); ?>
                    <?php gucherry_blog_post_read_time( $display_post_read_time ); ?>
                    <?php gucherry_blog_posted_by( $display_post_author ); ?>
                    <?php gucherry_blog_comments_no_meta( $display_post_comment_no ); ?>
                </ul>
            </div><!-- // entry-metas -->
        </div><!-- // top-block -->
        <?php gucherry_blog_post_format_media(); ?>
        <div class="bottom-block">
            <div class="excerpt<?php gucherry_blog_dropcap_class(); ?>">
            <?php the_excerpt(); ?>
            </div><!-- // excerpt -->
            <div class="permalink">
                <a class="gc-button-primary medium" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Continue reading', 'gucherry-blog' ); ?></a>
            </div><!-- // permalink -->
        </div><!-- // bottom-block -->
    </div><!-- // post-content -->
</article><!-- // hentry -->