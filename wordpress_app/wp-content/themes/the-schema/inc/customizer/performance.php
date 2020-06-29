<?php
/**
 * Performance Settings
 *
 * @package the_schema
 */

function the_schema_customize_register_general_performance( $wp_customize ) {
    
    /** Performance Settings */
    $wp_customize->add_section(
        'performance_settings',
        array(
            'title'      => __( 'Performance Settings', 'the-schema' ),
            'priority'   => 90,
            'capability' => 'edit_theme_options',
            'panel'      => 'general_settings'
        )
    );
    
    /** Lazy Load */
    $wp_customize->add_setting(
        'ed_lazy_load',
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_lazy_load',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Lazy Load', 'the-schema' ),
				'description'	=> __( 'Enable lazy loading of featured images.', 'the-schema' ),
			)
		)
	);
    
    /** Lazy Load Content Images */
    $wp_customize->add_setting(
        'ed_lazy_load_cimage',
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_lazy_load_cimage',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Lazy Load Content Images', 'the-schema' ),
				'description'	=> __( 'Enable lazy loading of images inside page/post content.', 'the-schema' ),
			)
		)
	);
    
    /** Lazy Load Gravatar */
    $wp_customize->add_setting(
        'ed_lazyload_gravatar',
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_lazyload_gravatar',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Lazy Load Gravatar', 'the-schema' ),
				'description'	=> __( 'Enable lazy loading of gravatar image.', 'the-schema' ),
			)
		)
	);

    /** All js combined Header */
    $wp_customize->add_setting(
        'ed_jquery_combined',
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new The_Schema_Toggle_Control( 
            $wp_customize,
            'ed_jquery_combined',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Enable Combined Jquery', 'the-schema' ),
                'description'   => __( 'All jquery library minified on one file.', 'the-schema' ),
            )
        )
    );
    
}
add_action( 'customize_register', 'the_schema_customize_register_general_performance' );