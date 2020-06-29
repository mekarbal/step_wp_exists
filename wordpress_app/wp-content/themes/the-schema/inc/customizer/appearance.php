<?php
/**
 * The Schema Appearance Settings
 *
 * @package The_Schema
 */

function the_schema_customize_register_appearance( $wp_customize ) {
    
    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'the-schema' ),
            'description' => __( 'Customize Typography, Background Image & Color.', 'the-schema' ),
        ) 
    );
    
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 10;
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 15;
    
}
add_action( 'customize_register', 'the_schema_customize_register_appearance' );