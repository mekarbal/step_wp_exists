<?php
/**
 * Customizer Options Declaration
 *
 * @package gucherry-blog
 */

/*-----------------------------------------------------------------------------
							SITE TYPOGRAPHY SECTION OPTIONS 
-----------------------------------------------------------------------------*/

$fonts = gucherry_blog_fonts_array();
$pagination_type = gucherry_blog_pagination_type_array();

//Section Site Typography
$wp_customize->add_section( 'gucherry_blog_site_typography_section', array(
    'priority'     => 5,
    'title'        => esc_html__( 'Site Typography', 'gucherry-blog' ),
) );

//Option : Typography Font
$wp_customize->add_setting( 'gucherry_blog_site_typography_font_family', array( 
    'sanitize_callback'   => 'sanitize_text_field',
    'default'             => 'Cormorant+Garamond:400,400i,500,500i,600,600i,700,700i&display=swap',
) );

$wp_customize->add_control( 'gucherry_blog_site_typography_font_family', array(
    'label'                  => esc_html__( 'Font Family', 'gucherry-blog' ),
    'description'            => esc_html__( 'Note: Change font family according to your need. This option applies to headings titles & blockquote. Font options is limited in free version.', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_typography_section',
    'type'                   => 'select',
    'choices'                => $fonts,
) );

//Option : Line Height
$wp_customize->add_setting( 'gucherry_blog_site_typography_line_height', array(
    'sanitize_callback'   => 'sanitize_text_field',
    'default'             => '1.1',
) );

$wp_customize->add_control( 'gucherry_blog_site_typography_line_height', array(
    'label'                    => esc_html__('Line Height', 'gucherry-blog' ),
    'description'              => esc_html__( 'You can set line height in pixel or normal. Eg: 24px, 1.3 etc.', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_site_typography_section',
    'type'                     => 'text',
) );

//Option : Letter Spacing
$wp_customize->add_setting( 'gucherry_blog_site_typography_letter_spacing', array(
    'sanitize_callback'   => 'sanitize_text_field',
    'default'             => '0',
) );

$wp_customize->add_control( 'gucherry_blog_site_typography_letter_spacing', array(
    'label'                    => esc_html__('Letter Spacing', 'gucherry-blog' ),
    'description'              => esc_html__( 'You can set letter spacing in pixel. Eg: 1.8px.', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_site_typography_section',
    'type'                     => 'text',
) );


/*-----------------------------------------------------------------------------
							SITE HEADER PANEL OPTIONS 
-----------------------------------------------------------------------------*/

//Logo & Header Panel
$wp_customize->add_panel( 'gucherry_blog_site_header_panel_options', array(
    'title'        => esc_html__( 'Site Header', 'gucherry-blog' ),
    'priority'     => 10,
) );

/*-----------------------------------------------------------------------------
							SITE LOGO SECTION OPTIONS
-----------------------------------------------------------------------------*/

//Section Site Logo
$wp_customize->add_section( 'gucherry_blog_site_logo_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Site Logo', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_header_panel_options',
) );

/*-----------------------------------------------------------------------------
							SITE FAVICON SECTION OPTIONS
-----------------------------------------------------------------------------*/

//Section Site Logo
$wp_customize->add_section( 'gucherry_blog_site_favicon_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Site Favicon', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_header_panel_options',
) );


/*-----------------------------------------------------------------------------
							MAIN HEADER SECTION OPTIONS
-----------------------------------------------------------------------------*/

//Section Header Image
$wp_customize->add_section( 'gucherry_blog_main_header_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Main Header', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_header_panel_options',
) );

//Option : Display Social Links
$wp_customize->add_setting( 'gucherry_blog_header_display_social_links', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_header_display_social_links', array(
    'label'                  => esc_html__( 'Display Social Links', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_main_header_section',
    'type'                   => 'ios',
) ) );

//Option : Display Canvas Sidebar
$wp_customize->add_setting( 'gucherry_blog_header_display_canvas_sidebar', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_header_display_canvas_sidebar', array(
    'label'                  => esc_html__( 'Display Canvas Sidebar', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_main_header_section',
    'type'                   => 'ios',
) ) );

//Option : Display Search
$wp_customize->add_setting( 'gucherry_blog_header_display_search', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_header_display_search', array(
    'label'                  => esc_html__( 'Display Search Icon', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_main_header_section',
    'type'                   => 'ios',
) ) );


/*-----------------------------------------------------------------------------
							SITE BANNER SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Site Banner
$wp_customize->add_section( 'gucherry_blog_site_banner_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Site Banner', 'gucherry-blog' ),
) );

//Option : Display Site Banner
$wp_customize->add_setting( 'gucherry_blog_site_banner_display_banner', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_banner_display_banner', array(
    'label'                  => esc_html__( 'Display Banner', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_banner_section',
    'type'                   => 'ios',
) ) );

//Option : Banner Post Category
$wp_customize->add_setting( 'gucherry_blog_site_banner_post_category', array( 
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'uncategorized',
) );

$wp_customize->add_control( 'gucherry_blog_site_banner_post_category', array(
    'label'                  => esc_html__( 'Post Category', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_banner_section',
    'type'                   => 'select',
    'choices'                => gucherry_blog_categories_array(),
    'active_callback'        => 'gucherry_blog_active_banner',
) );

//Option : Banner Post Number
$wp_customize->add_setting( 'gucherry_blog_site_banner_post_no', array(
    'sanitize_callback'        => 'gucherry_blog_sanitize_range',
    'default'                  => 5,
) );

$wp_customize->add_control( 'gucherry_blog_site_banner_post_no', array(
    'label'                    => esc_html__( 'No of Posts Items', 'gucherry-blog' ),
    'description'              => esc_html__( 'Maximum 5 items and minimum 2 items can be set.', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_site_banner_section',
    'type'                     => 'number',
    'input_attrs'              => array(
        'min'  => 2,
        'max'  => 5,
    ),
    'active_callback'          => 'gucherry_blog_active_banner',
) );


/*-----------------------------------------------------------------------------
							SITE PAGES PANEL OPTIONS 
-----------------------------------------------------------------------------*/

//Section Site Pages Panel
$wp_customize->add_panel( 'gucherry_blog_site_pages_section', array(
    'priority'     => 15,
    'title'        => esc_html__( 'Site Pages', 'gucherry-blog' ),
) );

/*-----------------------------------------------------------------------------
							BLOG PAGE SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Blog Page 
$wp_customize->add_section( 'gucherry_blog_site_pages_blog_page_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Blog Page', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_pages_section',
) );

//Option : Display Blog Page Post Featured Image
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_display_post_featured_image', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_display_post_featured_image', array(
    'label'                  => esc_html__( 'Display Post Featued Image', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Blog Page Post Category
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_display_post_category', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_display_post_category', array(
    'label'                  => esc_html__( 'Display Post Category', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Blog Page Post Date 
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_display_post_date', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_display_post_date', array(
    'label'                  => esc_html__( 'Display Post Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Blog Page Post Author 
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_display_post_author', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_display_post_author', array(
    'label'                  => esc_html__( 'Display Post Author', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Blog Page Post Read Time 
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_display_post_read_time', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_display_post_read_time', array(
    'label'                  => esc_html__( 'Display Post Read Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Blog Page Post Comment No
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_display_post_comment_no', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_display_post_comment_no', array(
    'label'                  => esc_html__( 'Display Post Comment No', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Enable Blog Page Post Drop Cap
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_enable_drop_cap', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_enable_drop_cap', array(
    'label'                  => esc_html__( 'Enable Drop Cap', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'ios',
) ) );

//Option : Blog Page Sidebar Position
$wp_customize->add_setting( 'gucherry_blog_site_pages_blog_page_sidebar_position', array( 
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'right',
) );

$wp_customize->add_control( new GuCherry_Blog_Radio_Image_Control ( $wp_customize, 'gucherry_blog_site_pages_blog_page_sidebar_position', array(
    'section'                => 'gucherry_blog_site_pages_blog_page_section',
    'type'                   => 'select',
    'choices'                => gucherry_blog_sidebar_position_array(),
) ) );

/*-----------------------------------------------------------------------------
							ARCHIVE PAGE SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Archive Page 
$wp_customize->add_section( 'gucherry_blog_site_pages_archive_page_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Archive Page', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_pages_section',
) );

//Option : Display Archive Page Title
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_archive_title', array(
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_archive_title', array(
    'label'                  => esc_html__( 'Display Archive Title', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Description
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_archive_description', array(
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_archive_description', array(
    'label'                  => esc_html__( 'Display Archive Description', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Post Featured Image
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_post_featured_image', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_post_featured_image', array(
    'label'                  => esc_html__( 'Display Post Featued Image', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Post Category
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_post_category', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_post_category', array(
    'label'                  => esc_html__( 'Display Post Category', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Post Date 
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_post_date', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_post_date', array(
    'label'                  => esc_html__( 'Display Post Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Post Author 
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_post_author', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_post_author', array(
    'label'                  => esc_html__( 'Display Post Author', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Post Read Time 
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_post_read_time', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_post_read_time', array(
    'label'                  => esc_html__( 'Display Post Read Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Archive Page Post Comment No
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_display_post_comment_no', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_display_post_comment_no', array(
    'label'                  => esc_html__( 'Display Post Comment No', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Enable Archive Page Post Drop Cap
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_enable_drop_cap', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_enable_drop_cap', array(
    'label'                  => esc_html__( 'Enable Drop Cap', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'ios',
) ) );

//Option : Archive Page Sidebar Position
$wp_customize->add_setting( 'gucherry_blog_site_pages_archive_page_sidebar_position', array( 
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'right',
) );

$wp_customize->add_control( new GuCherry_Blog_Radio_Image_Control ( $wp_customize, 'gucherry_blog_site_pages_archive_page_sidebar_position', array(
    'section'                => 'gucherry_blog_site_pages_archive_page_section',
    'type'                   => 'select',
    'choices'                => gucherry_blog_sidebar_position_array(),
) ) );

/*-----------------------------------------------------------------------------
							SEARCH PAGE SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Search Page 
$wp_customize->add_section( 'gucherry_blog_site_pages_search_page_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Search Page', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_pages_section',
) );

//Option : Display Search Page Post Featured Image
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_display_post_featured_image', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_display_post_featured_image', array(
    'label'                  => esc_html__( 'Display Post Featued Image', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Search Page Post Category
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_display_post_category', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_display_post_category', array(
    'label'                  => esc_html__( 'Display Post Category', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Search Page Post Date 
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_display_post_date', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_display_post_date', array(
    'label'                  => esc_html__( 'Display Post Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Search Page Post Author 
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_display_post_author', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_display_post_author', array(
    'label'                  => esc_html__( 'Display Post Author', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Search Page Post Read Time 
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_display_post_read_time', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_display_post_read_time', array(
    'label'                  => esc_html__( 'Display Post Read Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Display Search Page Post Comment No
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_display_post_comment_no', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_display_post_comment_no', array(
    'label'                  => esc_html__( 'Display Post Comment No', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Enable Search Page Post Drop Cap
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_enable_drop_cap', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_enable_drop_cap', array(
    'label'                  => esc_html__( 'Enable Drop Cap', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'ios',
) ) );

//Option : Search Page Sidebar Position
$wp_customize->add_setting( 'gucherry_blog_site_pages_search_page_sidebar_position', array( 
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'right',
) );

$wp_customize->add_control( new GuCherry_Blog_Radio_Image_Control ( $wp_customize, 'gucherry_blog_site_pages_search_page_sidebar_position', array(
    'section'                => 'gucherry_blog_site_pages_search_page_section',
    'type'                   => 'select',
    'choices'                => gucherry_blog_sidebar_position_array(),
) ) );

/*-----------------------------------------------------------------------------
							POST SINGLE SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Post Single 
$wp_customize->add_section( 'gucherry_blog_site_pages_post_single_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Post Single', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_pages_section',
) );

//Option : Display Post Single Featured Image
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_featured_image', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_featured_image', array(
    'label'                  => esc_html__( 'Display Featued Image', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Category
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_category', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_category', array(
    'label'                  => esc_html__( 'Display Category', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Date 
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_date', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_date', array(
    'label'                  => esc_html__( 'Display Posted Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Author 
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_author', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_author', array(
    'label'                  => esc_html__( 'Display Post Author', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Read Time 
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_read_time', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_read_time', array(
    'label'                  => esc_html__( 'Display Post Read Time', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Comment No
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_comment_no', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_comment_no', array(
    'label'                  => esc_html__( 'Display Comment No', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Tags
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_tags', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_tags', array(
    'label'                  => esc_html__( 'Display Tags', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Enable Post Single Drop Cap
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_enable_drop_cap', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => false,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_enable_drop_cap', array(
    'label'                  => esc_html__( 'Enable Drop Cap', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Author Section
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_post_author_section', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_post_author_section', array(
    'label'                  => esc_html__( 'Display Section', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Display Post Single Related Posts Section
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_display_related_posts_section', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_post_single_display_related_posts_section', array(
    'label'                  => esc_html__( 'Display Section', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'ios',
) ) );

//Option : Related Posts Section Title
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_related_posts_section_title', array(
    'sanitize_callback'        => 'sanitize_text_field',
    'default'                  => 'Related Posts',
) );

$wp_customize->add_control( 'gucherry_blog_site_pages_post_single_related_posts_section_title', array(
    'label'                    => esc_html__( 'Section Title', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_site_pages_post_single_section',
    'type'                     => 'text',
    'active_callback'          => 'gucherry_blog_active_related_posts_section',
) );

//Option : Related Posts Section Display option
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_related_posts_section_display_post_meta', array( 
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'post_date',
) );

$wp_customize->add_control( 'gucherry_blog_site_pages_post_single_related_posts_section_display_post_meta', array(
    'label'                  => esc_html__( 'Post Content', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_post_single_section',
    'type'                   => 'select',
    'choices'                => gucherry_blog_post_meta_array(),
    'active_callback'        => 'gucherry_blog_active_related_posts_section',
) );

//Option : Related Posts Section Post Number
$wp_customize->add_setting( 'gucherry_blog_site_pages_post_single_related_posts_section_post_no', array(
    'sanitize_callback'        => 'gucherry_blog_sanitize_range',
    'default'                  => 4,
) );

$wp_customize->add_control( 'gucherry_blog_site_pages_post_single_related_posts_section_post_no', array(
    'label'                    => esc_html__( 'No of Posts', 'gucherry-blog' ),
    'description'              => esc_html__( 'Maximum 4 items and minimum 1 items can be set.', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_site_pages_post_single_section',
    'type'                     => 'number',
    'input_attrs'              => array(
        'min'  => 1,
        'max'  => 4,
    ),
    'active_callback'          => 'gucherry_blog_active_related_posts_section',
) );


/*-----------------------------------------------------------------------------
							PAGE SINGLE SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Page Single
$wp_customize->add_section( 'gucherry_blog_site_pages_page_single_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Page Single', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_pages_section',
) );

//Option : Display Page Single Featured Image
$wp_customize->add_setting( 'gucherry_blog_site_pages_page_single_display_page_featured_image', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_page_single_display_page_featured_image', array(
    'label'                  => esc_html__( 'Display Featued Image', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_page_single_section',
    'type'                   => 'ios',
) ) );

//Option : Enable Page Single Drop Cap
$wp_customize->add_setting( 'gucherry_blog_site_pages_page_single_enable_drop_cap', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => false,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_pages_page_single_enable_drop_cap', array(
    'label'                  => esc_html__( 'Enable Drop Cap', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_page_single_section',
    'type'                   => 'ios',
) ) );


/*-----------------------------------------------------------------------------
							PAGE PAGINATION SECTION OPTIONS
-----------------------------------------------------------------------------*/

//Section Site pagination
$wp_customize->add_section( 'gucherry_blog_site_pages_pagination_section', array(
    'priority'     => 10,
    'title'        => esc_html__( 'Site Pagination', 'gucherry-blog' ),
    'panel'        => 'gucherry_blog_site_pages_section',
) );

//Option : Pagination options
$wp_customize->add_setting( 'gucherry_blog_site_pages_pagination_type', array(
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'numeric',
) );

$wp_customize->add_control( 'gucherry_blog_site_pages_pagination_type', array(
    'label'                  => esc_html__( 'Pagination Type', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_pages_pagination_section',
    'type'                   => 'select',
    'choices'                => $pagination_type,
) );


/*-----------------------------------------------------------------------------
							BREADCRUMB SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Site Sidebar 
$wp_customize->add_section( 'gucherry_blog_site_breadcrumb_section', array(
    'priority'     => 20,
    'title'        => esc_html__( 'Breadcrumb', 'gucherry-blog' ),
) );

//Option : Enable Sticky Sidebar
$wp_customize->add_setting( 'gucherry_blog_site_breadcrumb_enable_breadcrumb', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_breadcrumb_enable_breadcrumb', array(
    'label'                  => esc_html__( 'Display Breadcrumb', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_breadcrumb_section',
    'type'                   => 'ios',
) ) );


/*-----------------------------------------------------------------------------
							SITE SIDEBAR SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Site Sidebar 
$wp_customize->add_section( 'gucherry_blog_site_sidebar_section', array(
    'priority'     => 20,
    'title'        => esc_html__( 'Site Sidebar', 'gucherry-blog' ),
) );

//Option : Enable Sticky Sidebar
$wp_customize->add_setting( 'gucherry_blog_site_sidebar_enable_sticky_sidebar', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_sidebar_enable_sticky_sidebar', array(
    'label'                  => esc_html__( 'Enable Sticky Sidebar', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_sidebar_section',
    'type'                   => 'ios',
) ) );

/*-----------------------------------------------------------------------------
							SITE FOOTER SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Site Footer 
$wp_customize->add_section( 'gucherry_blog_site_footer_section', array(
    'priority'     => 20,
    'title'        => esc_html__( 'Site Footer', 'gucherry-blog' ),
) );

//Option : Display Footer Logo
$wp_customize->add_setting( 'gucherry_blog_site_footer_display_footer_logo', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_footer_display_footer_logo', array(
    'label'                  => esc_html__( 'Display Footer Logo', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_footer_section',
    'type'                   => 'ios',
) ) );

//Option : Upload Footer Logo
$wp_customize->add_setting( 'gucherry_blog_site_footer_upload_footer_logo', array( 
    'sanitize_callback'   => 'esc_url_raw',
    'default'             => '',
) );

$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'gucherry_blog_site_footer_upload_footer_logo', array(
    'label'               => esc_html__( 'Footer Logo', 'gucherry-blog' ),
    'section'             => 'gucherry_blog_site_footer_section',
    'active_callback'     => 'gucherry_blog_active_footer_logo',
) ) );

//Option : Display Back To Top
$wp_customize->add_setting( 'gucherry_blog_site_footer_display_back_to_top', array( 
    'sanitize_callback'   => 'wp_validate_boolean',
    'default'             => true,
) );

$wp_customize->add_control( new GuCherry_Blog_Customizer_Toggle_Control ( $wp_customize, 'gucherry_blog_site_footer_display_back_to_top', array(
    'label'                  => esc_html__( 'Display Scroll Top', 'gucherry-blog' ),
    'description'            => esc_html__( 'This option lets you to display or hide scroll to top link floating at right corner.', 'gucherry-blog' ),
    'section'                => 'gucherry_blog_site_footer_section',
    'type'                   => 'ios',
) ) );

//Option : Footer Copyright Text
$wp_customize->add_setting( 'gucherry_blog_site_footer_copyright_text', array(
    'sanitize_callback'        => 'gucherry_blog_sanitize_copyright_credit',
    'default'                  => '',
) );

$wp_customize->add_control( 'gucherry_blog_site_footer_copyright_text', array(
    'label'                    => esc_html__( 'Copyright Text', 'gucherry-blog' ),
    'description'		       => esc_html__( 'You can use <a> & <span> tags with the copyright and credit text.', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_site_footer_section',
    'type'                     => 'text',
) );


/*-----------------------------------------------------------------------------
							SOCIAL LINKS SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Social Links
$wp_customize->add_section( 'gucherry_blog_social_links_section', array(
    'priority'     => 20,
    'title'        => esc_html__( 'Social Links', 'gucherry-blog' ),
) );

// Option - Facebook Link
$wp_customize->add_setting( 'gucherry_blog_social_links_facebook_link', array(
	'sanitize_callback'	=> 'esc_url_raw',
	'default'			=> '#',
) );

$wp_customize->add_control( 'gucherry_blog_social_links_facebook_link', array(
	'label'				=> esc_html__( 'Facebook Link', 'gucherry-blog' ),
	'section'			=> 'gucherry_blog_social_links_section',
	'type'				=> 'url',
) );

// Option - Twitter Link
$wp_customize->add_setting( 'gucherry_blog_social_links_twitter_link', array(
	'sanitize_callback'	=> 'esc_url_raw',
	'default'			=> '#',
) );

$wp_customize->add_control( 'gucherry_blog_social_links_twitter_link', array(
	'label'				=> esc_html__( 'Twitter Link', 'gucherry-blog' ),
	'section'			=> 'gucherry_blog_social_links_section',
	'type'				=> 'url',
) );

// Option - Instagram Link
$wp_customize->add_setting( 'gucherry_blog_social_links_instagram_link', array(
	'sanitize_callback'	=> 'esc_url_raw',
	'default'			=> '#',
) );

$wp_customize->add_control( 'gucherry_blog_social_links_instagram_link', array(
	'label'				=> esc_html__( 'Instagram Link', 'gucherry-blog' ),
	'section'			=> 'gucherry_blog_social_links_section',
	'type'				=> 'url',
) );


/*-----------------------------------------------------------------------------
							EXCERPT LENGTH SECTION OPTIONS 
-----------------------------------------------------------------------------*/

//Section Excerpt Length
$wp_customize->add_section( 'gucherry_blog_excerpt_length_section', array(
    'priority'     => 20,
    'title'        => esc_html__( 'Excerpt Length', 'gucherry-blog' ),
) );

//Option : Banner Post Number
$wp_customize->add_setting( 'gucherry_blog_excerpt_length', array(
    'sanitize_callback'        => 'gucherry_blog_sanitize_range',
    'default'                  => 40,
) );

$wp_customize->add_control( 'gucherry_blog_excerpt_length', array(
    'label'                    => esc_html__( 'Excerpt Length', 'gucherry-blog' ),
    'description'              => esc_html__( 'Maximum excerpt length 40 and minimum excerpt length 20 can be set.', 'gucherry-blog' ),
    'section'                  => 'gucherry_blog_excerpt_length_section',
    'type'                     => 'number',
    'input_attrs'              => array(
        'min'  => 20,
        'max'  => 40,
    ),
) );


/*-----------------------------------------------------------------------------
						WOOCOMMERCE SIDEBAR OPTIONS
-----------------------------------------------------------------------------*/

// Section - Woocommerce Sidebar
$wp_customize->add_section( 'gucherry_blog_woocommerce_sidebar_section', array(
	'title'			=> esc_html__( 'Woocommerce Sidebar', 'gucherry-blog' ),
	'panel'			=> 'woocommerce'
) );

//Option : Woocommerce Shop Page Sidebar
$wp_customize->add_setting( 'gucherry_blog_woocommerce_sidebar_position', array( 
    'sanitize_callback'   => 'gucherry_blog_sanitize_select',
    'default'             => 'right',
) );

$wp_customize->add_control( new Gucherry_Blog_Radio_Image_Control ( $wp_customize, 'gucherry_blog_woocommerce_sidebar_position', array(
    'section'                => 'gucherry_blog_woocommerce_sidebar_section',
    'type'                   => 'select',
    'choices'                => gucherry_blog_sidebar_position_array(),
) ) );
