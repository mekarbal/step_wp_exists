<?php
/**
 * The Schema Front Page Settings
 *
 * @package The_Schema
 */

function the_schema_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'the-schema' ),
            'description' => __( 'Static Home Page settings.', 'the-schema' ),
        ) 
    );
    
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'the-schema' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    
    /** Enable Banner Section */
    $wp_customize->add_setting( 
        'ed_banner_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new The_Schema_Toggle_Control( 
            $wp_customize,
            'ed_banner_section',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Enable Banner Area', 'the-schema' ),
                'description' => __( 'Enable to show Banner Area in home page.', 'the-schema' ),
                'priority' => 1,
            )
        )
    );
    
    if( the_schema_is_btnw_activated() ){
        
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'header_image',
                'label'       => __( 'Newsletter Shortcode', 'the-schema' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'the-schema' ),
            )
        );
        
        $wp_customize->add_setting(
            'newsletter_bottom_note',
            array(
                'default'           =>  __( 'One email per week. Zero spam or ads.', 'the-schema' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        
        $wp_customize->add_control(
            'newsletter_bottom_note',
            array(
                'type'        => 'text',
                'section'     => 'header_image',
                'label'       => __( 'Newsletter Short Note', 'the-schema' ),
            )
        );

        $wp_customize->selective_refresh->add_partial( 'newsletter_bottom_note', array(
            'selector' => '.newsletter-banner-note p',
            'render_callback' => 'the_schema_get_newsletter_note',
        ) );
                
    }else{
        /** Note */
        $wp_customize->add_setting(
            'newsletter_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new The_Schema_Note_Control( 
                $wp_customize,
                'newsletter_text',
                array(
                    'section'     => 'header_image',
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'the-schema' ), '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );
    }

    /** Slider Settings Ends */
    
    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'the-schema' ),
            'priority' => 77,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Blog Options */
    $wp_customize->add_setting(
        'ed_blog_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new The_Schema_Toggle_Control(
            $wp_customize,
            'ed_blog_section',
            array(
                'label'       => __( 'Enable Blog Section', 'the-schema' ),
                'description' => __( 'Enable to show blog section.', 'the-schema' ),
                'section'     => 'blog_section',
            )            
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Read our blog to sharpen your business and SEO skills.
', 'the-schema' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Title', 'the-schema' ),
            'type'    => 'text',
        )
    );

    /** Blog description */
    $wp_customize->add_setting(
        'blog_section_subtitle',
        array(
            'default'           => __( 'Get evidence-based collection of articles on a topic sent directly to you in one email.
', 'the-schema' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_subtitle',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Description', 'the-schema' ),
            'type'    => 'textarea',
        )
    ); 
    
    /** Readmore Label */
    $wp_customize->add_setting(
        'blog_readmore',
        array(
            'default'           => __( 'Continue Reading', 'the-schema' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_readmore',
        array(
            'label'           => __( 'Readmore Label', 'the-schema' ),
            'section'         => 'blog_section',
            'type'            => 'text',
        )
    );
}
add_action( 'customize_register', 'the_schema_customize_register_frontpage' );