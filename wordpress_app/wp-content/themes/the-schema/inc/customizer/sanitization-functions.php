<?php
/**
 * The Schema Sanitization Functions
 * 
 * @package The_Schema
*/

function the_schema_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function the_schema_sanitize_select( $value ){    
    if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = sanitize_text_field( $subvalue );
		}
		return $value;
	}
	return sanitize_text_field( $value );    
}

function the_schema_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );
    
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

function the_schema_sanitize_radio( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}