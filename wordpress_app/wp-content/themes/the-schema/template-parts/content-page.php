<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Schema
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
        /**
         * Post Thumbnail
         * @hooked the_schema_page_entry_header
         * @hooked the_schema_post_thumbnail
        */
        do_action( 'the_schema_before_page_entry_content' );
    
        /**
         * Entry Content
         * 
         * @hooked the_schema_entry_content - 15
         * @hooked the_schema_entry_footer  - 20
        */
        do_action( 'the_schema_page_entry_content' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
