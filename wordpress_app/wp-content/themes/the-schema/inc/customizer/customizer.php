<?php
/**
 * The Schema Theme Customizer
 *
 * @package The_Schema
 */

/**
 * Requiring customizer panels & sections
*/
$the_schema_panels = array( 'info', 'site', 'appearance', 'layout', 'general', 'frontpage', 'footer','performance' );

foreach( $the_schema_panels as $p ){
    require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';


/**
 * Active Callback
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_schema_customize_preview_js() {
	wp_enqueue_script( 'the-schema-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), THE_SCHEMA_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'the_schema_customize_preview_js' );

function the_schema_customize_script(){
    wp_enqueue_style( 'the-schema-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), THE_SCHEMA_THEME_VERSION );
    wp_enqueue_script( 'the-schema-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), THE_SCHEMA_THEME_VERSION, true );

    $array = array(
        'home'     => get_home_url(),
    );
    wp_localize_script( 'the-schema-customize', 'the_schema_customize_data', $array );

}
add_action( 'customize_controls_enqueue_scripts', 'the_schema_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

$config_customizer = array(
	'recommended_plugins' => array(
		//change the slug for respective plugin recomendation
        'raratheme-companion' => array(
			'recommended' => true,
			'description' => sprintf(
				/* translators: %s: plugin name */
				esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'the-schema' ), '<strong>Raratheme Companion</strong>'
			),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'the-schema' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'the-schema' ),
	'activate_button_label'     => esc_html__( 'Activate', 'the-schema' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'the-schema' ),
);
The_Schema_Customizer_Notice::init( apply_filters( 'the_schema_customizer_notice_array', $config_customizer ) );