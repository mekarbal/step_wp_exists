<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_app' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'D>eh_~T{l9{oHBi7wuWBtQoxk)s_%J07(xkMuH=:ahZs&*^ptRgmG6-TH6}e+oz}' );
define( 'SECURE_AUTH_KEY',  '#%Huuw-~=l6r>[6/uz[kwN<_Uz~vAS;=^@?d/q5zC<AtrIg.7o}Hc,2XM)+Nqzsr' );
define( 'LOGGED_IN_KEY',    '@&BJf9)r (mAWN#PR1`([Dl/rPraS0ip(t:w]mC9n9=tG>!=ljejZ&G+*!@7wV<&' );
define( 'NONCE_KEY',        'H:QZU]|TJ=C`q4=lQ|~:L]$2I-u.eR[i^?|.y#@Z,NUFo[!>i+:<twHNU6/Ot]2z' );
define( 'AUTH_SALT',        'UAw_bUy_L0VFKHz][$AWz7<(q`b[RX`XA1%DZ-6rvX%D943[vkN%<m,hNsC$!H{m' );
define( 'SECURE_AUTH_SALT', '1$5^HO@8J+S:0iV2wg#[Qdm.s)v.=4/L2%<-EXq u<]jr}YG/npSdE[(q1[vvlEO' );
define( 'LOGGED_IN_SALT',   '`jEGG4 sSZpuo-62U}U[VYB]f/(AzCR-J%~}9-%,r~aKrD?G%?xib)%y%e)AXC$T' );
define( 'NONCE_SALT',       'dJopX$r?_J~Ng9Bw3n=.5wy: <9MTaJG6hzlj2=sXQK+[|`X0Jb6<[6+DyYZfaZH' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pw_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
