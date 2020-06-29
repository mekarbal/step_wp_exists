<?php
/**
 * The Schema functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Schema
 */

$theme_data = wp_get_theme();
if( ! defined( 'THE_SCHEMA_THEME_VERSION' ) ) define( 'THE_SCHEMA_THEME_VERSION', $theme_data->get( 'Version' ) );
if( ! defined( 'THE_SCHEMA_THEME_NAME' ) ) define( 'THE_SCHEMA_THEME_NAME', $theme_data->get( 'Name' ) );

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Performance
 */
require get_template_directory() . '/inc/performance.php';

/**
 * Plugin Hook And Filter
 */
require get_template_directory() . '/inc/plugins.php';


/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( the_schema_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}
