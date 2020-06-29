<?php

/*=======================================================
*    Register Post type
* =======================================================*/

if ( ! function_exists('htslider_register_custom_post') ) {
    
    function htslider_register_custom_post() {
    
        // Register Header Post type
        $labels = array(
            'name'                  => _x( 'Slider', 'Post Type General Name', 'ht-slider' ),
            'singular_name'         => _x( 'Slider', 'Post Type Singular Name', 'ht-slider' ),
            'menu_name'             => esc_html__( 'Slider', 'ht-slider' ),
            'name_admin_bar'        => esc_html__( 'Slider', 'ht-slider' ),
            'archives'              => esc_html__( 'Item Archives', 'ht-slider' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'ht-slider' ),
            'all_items'             => esc_html__( 'All Sliders', 'ht-slider' ),
            'add_new_item'          => esc_html__( 'Add New Slider', 'ht-slider' ),
            'add_new'               => esc_html__( 'Add New Slider', 'ht-slider' ),
            'new_item'              => esc_html__( 'New Item', 'ht-slider' ),
            'edit_item'             => esc_html__( 'Edit Item', 'ht-slider' ),
            'update_item'           => esc_html__( 'Update Item', 'ht-slider' ),
            'view_item'             => esc_html__( 'View Item', 'ht-slider' ),
            'search_items'          => esc_html__( 'Search Item', 'ht-slider' ),
            'not_found'             => esc_html__( 'Not found', 'ht-slider' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'ht-slider' ),
            'featured_image'        => esc_html__( 'Featured Image', 'ht-slider' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'ht-slider' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'ht-slider' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'ht-slider' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'ht-slider' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'ht-slider' ),
            'items_list'            => esc_html__( 'Items list', 'ht-slider' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'ht-slider' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'ht-slider' ),
        );

        $args = array(
            'label'                 => esc_html__( 'Slider', 'ht-slider' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor' ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => 'htslider_page',
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-welcome-view-site',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,       
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => false,
            'capability_type'       => 'page',
        );

        register_post_type( 'htslider_slider', $args );    

    }
    add_action( 'init', 'htslider_register_custom_post', 0 );

}

/*=======================================================
*    Register Custom Taxonomy
* =======================================================*/

if(! function_exists('htslider_custom_taxonomy')){

    function htslider_custom_taxonomy(){
        $labels = array(
            'name'                       => _x( 'Slider Categories', 'Taxonomy General Name', 'ht-slider' ),
            'singular_name'              => _x( 'Slider Category', 'Taxonomy Singular Name', 'ht-slider' ),
            'menu_name'                  => __( 'Slider Category', 'ht-slider' ),
            'all_items'                  => __( 'All Item Categories', 'ht-slider' ),
            'parent_item'                => __( 'Parent Item', 'ht-slider' ),
            'parent_item_colon'          => __( 'Parent Item:', 'ht-slider' ),
            'new_item_name'              => __( 'New Item Category', 'ht-slider' ),
            'add_new_item'               => __( 'Add New Item', 'ht-slider' ),
            'edit_item'                  => __( 'Edit Item', 'ht-slider' ),
            'update_item'                => __( 'Update Item', 'ht-slider' ),
            'view_item'                  => __( 'View Item', 'ht-slider' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'ht-slider' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'ht-slider' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'ht-slider' ),
            'popular_items'              => __( 'Popular Items', 'ht-slider' ),
            'search_items'               => __( 'Search Items', 'ht-slider' ),
            'not_found'                  => __( 'Not Found', 'ht-slider' ),
            'no_terms'                   => __( 'No items', 'ht-slider' ),
            'items_list'                 => __( 'Items list', 'ht-slider' ),
            'items_list_navigation'      => __( 'Items list navigation', 'ht-slider' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'htslider_category', array( 'htslider_slider' ), $args );

    }

    add_action( 'init', 'htslider_custom_taxonomy', 0 );

}