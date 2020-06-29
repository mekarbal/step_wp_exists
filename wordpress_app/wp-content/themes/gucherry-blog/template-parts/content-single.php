<?php
/**
 * Template part for displaying page content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gucherry-blog
 */
$display_post_featured_image = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_featured_image', true );
$display_post_category = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_category', true );
$display_post_date = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_date', true );
$display_post_author = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_author', true );
$display_post_read_time = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_read_time', true );
$display_post_comment_no = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_comment_no', true );
$display_post_tags = get_theme_mod( 'gucherry_blog_site_pages_post_single_display_post_tags', true );
?>

<div id="post-<?php the_ID(); ?>" class="single-page-entry">
        <?php gucherry_blog_categories_meta( $display_post_category ); ?>
    <div class="page-title">
        <h1><?php the_title(); ?></h1>
    </div><!-- // page-ttile -->
    <div class="entry-metas">
        <ul>
            <?php gucherry_blog_posted_on( $display_post_date ); ?>
            <?php gucherry_blog_post_read_time( $display_post_read_time ); ?>
            <?php gucherry_blog_posted_by( $display_post_author ); ?>
            <?php gucherry_blog_comments_no_meta( $display_post_comment_no ); ?>
        </ul>
    </div><!-- // entry-metas -->
    <?php
    if( has_post_thumbnail() && $display_post_featured_image == true ) {
        gucherry_blog_post_thumbnail();
    }
    ?>
    <div class="single-page-content-area">
       <?php
        $drop_class = '';
        $enable_dropcap = get_theme_mod( 'gucherry_blog_site_pages_post_single_enable_drop_cap', true );
        if( $enable_dropcap == true ) {
            $drop_class = ' dropcap';
        }
        ?>
        <div class="editor-entry<?php echo esc_attr( $drop_class ); ?>">
            <?php
            
            the_content();
            
            gucherry_blog_pages_links();
            
            if ( get_edit_post_link() ) :

                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'gucherry-blog' ),
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
            endif;
            ?>
        </div><!-- // editor-entry -->
        <?php
        gucherry_blog_tags_meta( $display_post_tags );
        
        gucherry_blog_post_navigation();
        
        get_template_part( 'template-parts/content', 'author' );
        
        get_template_part( 'template-parts/content', 'related' );
        
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
    </div><!-- // default-page-content-area -->
</div><!-- // single-page-content-area -->