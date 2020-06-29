<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Schema
 */

/**
 * #hooked the_schema_post_entry_content_start - 10
 * @hooked the_schema_entry_header   - 15 
 * @hooked the_schema_entry_content - 20
 * @hooked the_schema_entry_footer  - 30
 * @hooked the_schema_post_entry_content_end - 40
*/
do_action( 'the_schema_post_entry_content' );