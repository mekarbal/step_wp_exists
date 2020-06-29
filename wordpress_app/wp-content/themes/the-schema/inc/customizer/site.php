<?php
/**
 * The Schema Customizer
 *
 * @package The_Schema
 */

function the_schema_customize_register( $wp_customize ) {
	
    /** Add postMessage support for site title and description */
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
	
    if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'the_schema_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'the_schema_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'the_schema_customize_register' );