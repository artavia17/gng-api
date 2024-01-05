<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'gngapi' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '1234' );

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
define( 'AUTH_KEY',         'rv)2W-Um,x8S!VTZZmPW*H)GJwfVPy 1mOn+=ed_vi v}C/u`Ew &ot0eI,D_V/R' );
define( 'SECURE_AUTH_KEY',  '^9yo`=<[W^0@V^.f[)y*xep/8|nkg@AHk R_S$Gbb=UqBL?AE{#a3j+7s]yuM@)(' );
define( 'LOGGED_IN_KEY',    'QPkST1xvW1w. <S%pL(NX4AoqAM]p 6H]5){]s2|XQ$N0u~YuPZ(UqTC6K6KnR0`' );
define( 'NONCE_KEY',        'n4T^Q-A,3qSZOX81FaIc[F5k9w6?IgK44i9x8YR9,|Ri&+fWwZMH<36>Ye{GzM/F' );
define( 'AUTH_SALT',        'IAbG0}Q~{PWL;WRHTU]0@5/OCR|RE=UV^n<g0.!CN5:h365dDN7_/B5|~|KBg$C4' );
define( 'SECURE_AUTH_SALT', '/ EWHntCV]5_uepeCb<B[Y6XnN{N}iq]oIiOK/kgm~XOsYk>z|5B8={Uaqwe/A_e' );
define( 'LOGGED_IN_SALT',   'TXZ6E?-PR_asP;[YaKF:4(^%X?5^=,wgbl~G3{K{OQe?zeT;EbuzGOS06UGg9=b!' );
define( 'NONCE_SALT',       'U/d7n_MI/5$e}NUNMcZ|)[j9}>pK[8Y8*(N@[R}hL7?&qJXPgLi5M~BEC(*9eDBz' );

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
