<?php
/**
 * Plugin Name: HT Slider For Elementor
 * Description: The Slider is a elementor addons for WordPress.
 * Plugin URI:  https://htplugins.com/
 * Author:      HT Plugins
 * Author URI:  https://profiles.wordpress.org/htplugins/
 * Version:     1.2.0
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ht-slider
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

define( 'HTSLIDER_VERSION', '1.2.0' );
define( 'HTSLIDER_ADDONS_PL_ROOT', __FILE__ );
define( 'HTSLIDER_PL_URL', plugins_url( '/', HTSLIDER_ADDONS_PL_ROOT ) );
define( 'HTSLIDER_PL_PATH', plugin_dir_path( HTSLIDER_ADDONS_PL_ROOT ) );
define( 'HTSLIDER_PL_ASSETS', trailingslashit( HTSLIDER_PL_URL.'assets' ) );
define( 'HTSLIDER_ADMIN_ASSETS', trailingslashit( HTSLIDER_PL_URL.'assets/admin') );
define( 'HTSLIDER_PL_INCLUDE', trailingslashit( HTSLIDER_PL_PATH .'include' ));
define( 'HTSLIDER_PLUGIN_BASE', plugin_basename( HTSLIDER_ADDONS_PL_ROOT ) );
// Required File
include( HTSLIDER_PL_INCLUDE.'/class.htslider.php' );
