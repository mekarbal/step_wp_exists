<?php
/**
 * The Schema Layout Settings
 *
 * @package The_Schema
 */

function the_schema_customize_register_layout( $wp_customize ) {

    
    /** General Sidebar Layout */
    $wp_customize->add_section(
        'general_layout',
        array(
            'title'    => __( 'Layout Settings', 'the-schema' ),
            'priority' => 55,
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'the_schema_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Page Sidebar Layout', 'the-schema' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in repective page.', 'the-schema' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'the_schema_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Post Sidebar Layout', 'the-schema' ),
				'description' => __( 'This is the general sidebar layout for posts. You can override the sidebar layout for individual post in repective post.', 'the-schema' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Default Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'the_schema_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Default Sidebar Layout', 'the-schema' ),
				'description' => __( 'This is the general sidebar layout for whole site.', 'the-schema' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
}
add_action( 'customize_register', 'the_schema_customize_register_layout' );