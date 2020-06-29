<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Schema
 */
    /**
     * Doctype Hook
     * 
     * @hooked the_schema_doctype
    */
    do_action( 'the_schema_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked the_schema_head
    */
    do_action( 'the_schema_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php
    wp_body_open();

    /**
     * Before Header
     * 
     * @hooked the_schema_page_start - 20 
    */
    do_action( 'the_schema_before_header' );
    
    /**
     * Header
     * 
     * @hooked the_schema_header - 20     
    */
    do_action( 'the_schema_header' );


    /**
     * Banner
     * 
     * @hooked the_schema_header_banner - 20     
    */
    do_action( 'the_schema_header_banner_home' );

    /**
     * Content
     * 
     * @hooked the_schema_content_start
    */
    do_action( 'the_schema_content' );