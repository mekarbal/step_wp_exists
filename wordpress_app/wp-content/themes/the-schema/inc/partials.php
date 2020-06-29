<?php
/**
 * The Schema Customizer Partials
 *
 * @package The_Schema
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function the_schema_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function the_schema_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'the_schema_get_newsletter_note' ) ) :
/**
 * Display blog readmore button
*/
function the_schema_get_newsletter_note(){
    return esc_html( get_theme_mod( 'newsletter_bottom_note', esc_html__( 'One email per week. Zero spam or ads.', 'the-schema' ) ) );
}
endif;

if( ! function_exists( 'the_schema_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function the_schema_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', esc_html__( 'Continue Reading', 'the-schema' ) ) );    
}
endif;

if( ! function_exists( 'the_schema_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function the_schema_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', esc_html__( 'Recommended Articles', 'the-schema' ) ) );
}
endif;

if( ! function_exists( 'the_schema_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function the_schema_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright-text">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'the-schema' );
        echo date_i18n( esc_html__( 'Y', 'the-schema' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'the-schema' );
    }
    echo '</span>'; 
}
endif;