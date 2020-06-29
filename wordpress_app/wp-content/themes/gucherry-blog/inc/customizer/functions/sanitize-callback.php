<?php
/**
 * Collection of functions to sanitize customizer field values.
 *
 * @package gucherry-blog
 */


/**
 * Sanitization callback function for number field with value in range.
 */
if ( ! function_exists( 'gucherry_blog_sanitize_range' ) ) {

    function gucherry_blog_sanitize_range( $input, $setting ) {

        if(  $input <= $setting->manager->get_control( $setting->id )->input_attrs['max'] ) {

            if( $input >= $setting->manager->get_control( $setting->id )->input_attrs['min'] ) {

                return absint( $input );
            }
        }
    }
}


/**
 * Sanitization callback function for number field.
 */
if ( ! function_exists( 'gucherry_blog_sanitize_number' ) ) {

    function gucherry_blog_sanitize_number( $input, $setting ) {

        return absint( $input );
    }
}


/**
 * Sanitization callback function for select field.
 */
if ( !function_exists('gucherry_blog_sanitize_select') ) {

    function gucherry_blog_sanitize_select( $input, $setting ) {

        $input = sanitize_key( $input );
        
        $choices = $setting->manager->get_control( $setting->id )->choices;
        
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
}


/**
 * Sanitization Function - Copyright & Credit
 *
 * @param $input
 * @return sanitized output
 *
 */
if ( !function_exists('gucherry_blog_sanitize_copyright_credit') ) :

    function gucherry_blog_sanitize_copyright_credit( $input ) {

        $allowed_tags = array(
            'a' => array(
                'href' => array(),
                'title' => array(),
                '_target' => array(),
            ),
            'span' => array(),
        );

        return wp_kses( $input, $allowed_tags );
    }
    
endif;