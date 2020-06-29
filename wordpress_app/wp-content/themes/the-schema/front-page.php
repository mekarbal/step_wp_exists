<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Schema
 */
 
$home_sections = the_schema_get_home_sections();

if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page
    
    include( get_home_template() );

} elseif ( $home_sections ){ 
    get_header();
    
    foreach( $home_sections as $section ){
        get_template_part( 'sections/' . esc_attr( $section ) );  
    }
    
	get_footer();
    
} else {
    //If all section are disabled then this respective page template. 
    include( get_page_template() );
}
