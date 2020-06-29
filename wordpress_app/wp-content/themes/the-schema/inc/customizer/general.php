<?php
/**
 * The Schema General Settings
 *
 * @package The_Schema
 */

function the_schema_customize_register_general( $wp_customize ) {
	
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 85,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'the-schema' ),
            'description' => __( 'Customize Header, Social, SEO, Post/Page settings.', 'the-schema' ),
        ) 
    );
    
    
    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'the-schema' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Header Search */
    $wp_customize->add_setting( 
        'ed_header_search', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_header_search',
			array(
				'section'     => 'header_settings',
				'label'	      => __( 'Enable Header Search', 'the-schema' ),
                'description' => __( 'Enable to show Search button in header.', 'the-schema' ),
			)
		)
	);
    
    /** Header Settings Ends */
    
    /** Social Media Settings */
    $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'the-schema' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'     => 'social_media_settings',
				'label'	      => __( 'Enable Social Links', 'the-schema' ),
                'description' => __( 'Enable to show social links at footer.', 'the-schema' ),
			)
		)
	);
    
    $wp_customize->add_setting( 
        new The_Schema_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'The_Schema_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_media_settings',				
				'label'	  => __( 'Social Links', 'the-schema' ),
				'fields'  => array(
                    'text' => array(
                        'type'        => 'text',
                        'label'       => __( 'Link Label', 'the-schema' ),
                        'description' => __( 'Example: Facebook', 'the-schema' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'the-schema' ),
                        'description' => __( 'Example: https://facebook.com', 'the-schema' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'the-schema' ),
                    'field' => 'link'
                ),
                'choices'   => array(
                    'limit' => 10
                )                        
			)
		)
	);
    /** Social Media Settings Ends */
    
    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'the-schema' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'the-schema' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'the-schema' ),
			)
		)
	);       
    /** SEO Settings Ends */
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'the-schema' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'the-schema' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'the-schema' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 25,
            'sanitize_callback' => 'the_schema_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'the-schema' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'the-schema' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				),
                'active_callback' => 'the_schema_ed_excerpt_ac',
			)
		)
	);
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'Continue Reading', 'the-schema' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'the-schema' ),
            'active_callback' => 'the_schema_ed_excerpt_ac',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'the_schema_get_read_more',
    ) );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new The_Schema_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
				'description' => __( '<hr/>These options affect your individual posts.', 'the-schema' ),
			)
		)
    );
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author Section', 'the-schema' ),
                'description' => __( 'Enable to hide author section.', 'the-schema' ),
			)
		)
	);
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'the-schema' ),
                'description' => __( 'Enable to show related posts in single page.', 'the-schema' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'Recommended Articles', 'the-schema' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Related Posts Section Title', 'the-schema' ),
            'active_callback' => 'the_schema_ed_recommend_posts_ac',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.additional-posts .title',
        'render_callback' => 'the_schema_get_related_title',
    ) );
    
    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_category',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Category', 'the-schema' ),
                'description' => __( 'Enable to hide category.', 'the-schema' ),
			)
		)
	);
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_post_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Post Author', 'the-schema' ),
                'description' => __( 'Enable to hide post author.', 'the-schema' ),
			)
		)
	);
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'the_schema_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new The_Schema_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'the-schema' ),
                'description' => __( 'Enable to hide posted date.', 'the-schema' ),
			)
		)
	);


    /** Footer Newsletter **/

    if( the_schema_is_btnw_activated() ){

        $wp_customize->add_section(
            'footer_newsletter_settings',
            array(
                'title'    => __( 'Footer Newsletter', 'the-schema' ),
                'priority' => 100,
                'panel'    => 'general_settings',
            )
        );

        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'footer_newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'footer_newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'footer_newsletter_settings',
                'label'       => __( 'Newsletter Shortcode', 'the-schema' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'the-schema' ),
            )
        );
        
                
    }else{
        /** Note */
        $wp_customize->add_setting(
            'footer_newsletter_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new The_Schema_Note_Control( 
                $wp_customize,
                'footer_newsletter_text',
                array(
                    'section'     => 'footer_newsletter_settings',
                    'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'the-schema' ), '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank">', '</a>' )
                )
            )
        );
    }
}
add_action( 'customize_register', 'the_schema_customize_register_general' );