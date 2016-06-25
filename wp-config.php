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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~|@e0}1j?c<xu[>DbmfX&Op:ysm8)?EwwG[?x(X$M%?@z*~%3#I7cfF8;;wb>wV`');
define('SECURE_AUTH_KEY',  '7z]nhAPVv?uJu PZK&a?d)YY.[k:(7)k$`]OMpJz_/io!*Am+*yl1CZajUS-5)eN');
define('LOGGED_IN_KEY',    'l~f:&I&Y3Dj?!Y`0h<e9-CsN?_ehEH}0>j]~kuW-Wq3]!6^3O>Qd+igz>di5i9^b');
define('NONCE_KEY',        'x2L;%dNG`%6eJx 3f~4J=>BKT,?Vr$kjcg)UQ|-Szxd/,nQz[V&*9R|8!1&F?]w}');
define('AUTH_SALT',        'gCY{5A;Cf;o,gyOG}g{<x&mnR_m7Rr>[>u2Z0}Mm^$T+|*_[|u[0`}Wb7tV02s!}');
define('SECURE_AUTH_SALT', '1O>uL,H[j.NcV3sL<Y6^;QZPpJSVk3B8zj<Vs4[3%Q X>prvI?q*^<s Z`L:q|v}');
define('LOGGED_IN_SALT',   'gS>aVqoK>gST>sKnH>oQ{y}qMv:Hh=Zg=koR6Z=u_=Y?U EC=cbCDHn4`m@;{kd)');
define('NONCE_SALT',       '?[,AosDtt+s)`V!Ms?I#pPR4,:CoK*~-{Kzj%P&nB)9v?Gb#%>@[UWzab-X+&^N:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
