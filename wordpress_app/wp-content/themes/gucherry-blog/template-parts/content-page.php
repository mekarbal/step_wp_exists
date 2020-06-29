<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gucherry-blog
 */

?>

<div id="post-<?php the_ID(); ?>" class="default-page-entry">
    <div class="page-title">
        <h1><?php the_title(); ?></h1>
    </div><!-- // page-ttile -->
    <?php
    $display_page_featured_image = get_theme_mod( 'gucherry_blog_site_pages_page_single_display_page_featured_image', true );
    if( has_post_thumbnail() && $display_page_featured_image == true ) {
        gucherry_blog_post_thumbnail();
    }
    ?>
    <div class="default-page-content-area">
       <?php
        $drop_class = '';
        $enable_dropcap = get_theme_mod( 'gucherry_blog_site_pages_page_single_enable_drop_cap', true );
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
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
    </div><!-- // default-page-content-area -->
</div><!-- // default-page-entry -->
