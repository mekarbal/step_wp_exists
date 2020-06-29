<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Schema
 */
    
    /**
     * After Content
     * 
     * @hooked the_schema_content_end - 20
    */
    do_action( 'the_schema_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked the_schema_footer_start  - 20
     * @hooked the_schema_footer_newsletter - 25
     * @hooked the_schema_footer_top    - 30
     * @hooked the_schema_footer_bottom - 40
     * @hooked the_schema_footer_end    - 50
    */
    do_action( 'the_schema_footer' );
    
    /**
     * After Footer
     * 
     * @hooked the_schema_page_end - 20
    */
    do_action( 'the_schema_after_footer' );

    wp_footer(); ?>

</body>
</html>
