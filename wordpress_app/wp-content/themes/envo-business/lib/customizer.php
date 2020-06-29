<?php
/**
 * Envo Business Theme Customizer
 *
 * @package Envo_Business
 */

$envo_business_sections = array( 'info', 'demo' );

foreach( $envo_business_sections as $s ){
    require get_template_directory() . '/lib/customizer/' . $s . '.php';
}

function envo_business_customizer_scripts() {
    wp_enqueue_style( 'envo-business-customize',get_template_directory_uri().'/lib/customizer/css/customize.css', '', 'screen' );
    wp_enqueue_script( 'envo-business-customize', get_template_directory_uri() . '/lib/customizer/js/customize.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'envo_business_customizer_scripts' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/lib/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/lib/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

$config_customizer = array(
	'recommended_plugins' => array( 
		'kingcomposer' => array(
			'recommended' => true,
			/* translators: %s: "KingComposer" string */
			'description' => sprintf( esc_html__( 'To take full advantage of all the features this theme has to offer, please install and activate the %s plugin.', 'envo-business' ), '<strong>KingComposer</strong>' ),
		),
		'envothemes-importer-kingcomposer' => array(
			'recommended' => true,
			'description' => esc_html__( 'Save time by importing our demo data: your website will be set up and ready to be customized in minutes.', 'envo-business' ),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended plugin', 'envo-business' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'envo-business' ),
	'activate_button_label'     => esc_html__( 'Activate', 'envo-business' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'envo-business' ),
);
Envo_Business_Customizer_Notice::init( apply_filters( 'envo_business_customizer_notice_array', $config_customizer ) );

