<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lpmindustria' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qDCP_Jpzssh*Y]ZJJ]h_lULHQ!!<E<Q=YOZ3wMP%O_0Cy5#gcdziu6[j 76$:_+/' );
define( 'SECURE_AUTH_KEY',  'ows- |WCt a!*QQfUgM7H6bA4e}&#l$J/~Tr%?i%@Lp=e }[U@ww2C./9k?#/4uP' );
define( 'LOGGED_IN_KEY',    'YQqYH$#6N mE[rcW8KjR-|6K82HW Jz@Jl ek{SXOm2o5jqB(xnkamH&P:N81E8S' );
define( 'NONCE_KEY',        'g}183,)15zkc|6})I2_JzyAk*Ks*p.rd>eq4N2okD,V&;z4bK;M~`0/%Qi)[Jz(G' );
define( 'AUTH_SALT',        ')x:^|9 (Gz|Mo7f~_Ce>%;dy?#{5rVOV@[Z<+FfiHH.N^vf=sfAa[@|R0X.= %t/' );
define( 'SECURE_AUTH_SALT', 'qRID?]EOB axhnc3Pr<P@KBr6FF4{gRNU=vS:!?OQi?X?AoEg9J2!@E^ymUCCGL6' );
define( 'LOGGED_IN_SALT',   'um#aEDWq|rxC9GQ;5x&?Tg|`7*q(C?)pT{_-qrSWK8`~5*pq |,dG2nPiWEEu9.|' );
define( 'NONCE_SALT',       'nSVs&0H8^{jOP41#){Yb8+#O8YC6%`|l}<_h,~PFXms`i/C|]rx^4pm/Gvy:WT45' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
