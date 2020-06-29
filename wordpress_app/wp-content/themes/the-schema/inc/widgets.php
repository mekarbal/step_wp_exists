<?php
/**
 * The Schema Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package The_Schema
 */

function the_schema_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'the-schema' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'the-schema' ),
        ),
        'the-schema-about'   => array(
            'name'        => __( 'About Section', 'the-schema' ),
            'id'          => 'the-schema-about', 
            'description' => __( 'Add "Rara: A Featured Page" widget for about section.', 'the-schema' ),
        ),
        'the-schema-client' => array(
            'name'        => __( 'Client Section', 'the-schema' ),
            'id'          => 'the-schema-client', 
            'description' => __( 'Add "Rara: Client Logo" for Call to Action section.', 'the-schema' ),
        ),
        'the-schema-service' => array(
            'name'        => __( 'Service Section', 'the-schema' ),
            'id'          => 'the-schema-service', 
            'description' => __( 'Add "Text" widget for service section title and "Rara: Icon Text" widget For content.', 'the-schema' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'the-schema' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'the-schema' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'the-schema' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'the-schema' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'the-schema' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'the-schema' ),
        ),
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
}
add_action( 'widgets_init', 'the_schema_widgets_init' );