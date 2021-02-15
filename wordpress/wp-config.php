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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '%Mw,?Nr9fu kFMHmA$}a/ATExm5J/b}nl5(A$33kZKjo)96(N? O^^ZBc@X#:A}y' );
define( 'SECURE_AUTH_KEY',  'p)!R/cTiOWQ6F:Vlp[,TJvQ1]~j!&~Z_Egr~Bw%3e1$_r%*j]QO,E.6.DXqlC:/M' );
define( 'LOGGED_IN_KEY',    '_FI%d5`j]wF>gFfz=`sfBD<U2%g[Q4K.Fm[0&zhYi9]u<OrS3|5tx?cJ{#mVs;ox' );
define( 'NONCE_KEY',        'HIe(pG/-k;F<``$ig.}7Iwq1L{@I8A7-%%dNpN:3AGGo^V&j`R57enk6V==b^{jT' );
define( 'AUTH_SALT',        'f&hYYN%tpO^T9PUdN4ZV{~*trqPyyuj9_y?Zjdl!Y-:ksSp+bb4;M00#T){.y,fh' );
define( 'SECURE_AUTH_SALT', 'b0-og&Nwq$u-+/5&TyW2$T,[mgj2pJSbK`1>2?oztuqBOKd|y>?]%,2{z5$la8*8' );
define( 'LOGGED_IN_SALT',   'OG~nY~vE5cI+*[A8?Hs}IHvNP(zgHYS++t`+{vcZi>`!,bO1v3F+1HeyC6u)S(da' );
define( 'NONCE_SALT',       '.)LD7_b3dh9MpQ4N*G[y/nh[s~CAtF8W[gBFAG*CQcjDBm~*HT`xs]q}Ef`5Jp]Z' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
