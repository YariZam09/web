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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'P.0p,of>*/h*?}&|=t3ML8xqcK;*&]Y?#ACX!=>j{NIr:,ta7f-#@cX#mTc>,fL/' );
define( 'SECURE_AUTH_KEY',  'PulMl$gP^k891*jxEKWEz0ARFHAr[6 @&R?-%>LlTU&vq7Yv=8fSG/3] TDMZIyQ' );
define( 'LOGGED_IN_KEY',    '+BJ^,adZ3(QVF$BpnS$u+T4Z[6NZ`%Y%Kg=?ar?7R@TAZz9QX{n`!WbK+H?oMG(.' );
define( 'NONCE_KEY',        '*pLu+)E%Wt$`xvV?7(I*Hpg|@zZW=KMm<d@uxA)}x ]. Ez+Y%u?%3d. GB=9wyK' );
define( 'AUTH_SALT',        ',0y7,K=mb .0!%]/%1!<M|t9%x}T#}rp@H)czU)99O3?HT,4tte*+j=ttuk_IU#&' );
define( 'SECURE_AUTH_SALT', 'cXM.|*{xqI]J_4^0l{=s8~wF&Gw*I}7?/%If7dS?9.0TT*ps3P51n7)Fg2jpR:0I' );
define( 'LOGGED_IN_SALT',   '#)^-[Q&Sl1TD-jqOEO6WSj:sBDSnvzq-~|{VGj3OAtxO!XF#2B^QvGI<sUq!~:Wx' );
define( 'NONCE_SALT',       'r L.{a4/PT{R#Sd4mu*TN%rP>?eT(+Bal0yH7z)|@r.y)eQOm`2uHrr<B}1&eKi?' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
