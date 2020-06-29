<?php
/**
 * Envo Business Demo Content Information
 *
 * @package lawyer_landing_page
 */

function envo_business_customizer_demo_content( $wp_customize ) {
	
    $wp_customize->add_section( 
        'theme_demo_content',
        array(
            'title'    => __( 'One Click Demo Import', 'envo-business' ),
            'priority' => 7,
		)
    );
        
    $wp_customize->add_setting(
		'demo_content_instruction',
		array(
			'sanitize_callback' => 'wp_kses_post'
		)
	);
	/* translators: %s: "Click here" string */
	$demo_content_description = sprintf( __( 'You can import the demo content with just one click. For step-by-step video tutorial, see %1$s', 'envo-business' ), '<a class="documentation" href="' . esc_url( 'https://envothemes.com/envo-business/envo-business-documentation/#importing-the-sample-data' ) . '" target="_blank">' . esc_html__( 'documentation', 'envo-business' ) . '</a>' );

	$wp_customize->add_control(
		new Envo_Business_Info_Text( 
			$wp_customize,
			'demo_content_instruction',
			array(
				'section'	  => 'theme_demo_content',
				'description' => $demo_content_description
			)
		)
	);
    
	$theme_demo_content_desc = '';

	$theme_demo_content_desc .= '<p><a class="button button-primary" href="' . esc_url( admin_url( 'themes.php?page=et_envo-business&tab=import_data' ) ) . '" title="">' . esc_html__( 'Import demo data', 'envo-business' ) . '</a></p>';

	$wp_customize->add_setting( 
        'theme_demo_content_info',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
		)
    );

	// Demo content 
	$wp_customize->add_control( 
        new Envo_Business_Info_Text( 
            $wp_customize,
            'theme_demo_content_info',
            array(
                'section'     => 'theme_demo_content',
                'description' => $theme_demo_content_desc
    		)
        )
    );

}
add_action( 'customize_register', 'envo_business_customizer_demo_content' );