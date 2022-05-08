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
define('DB_NAME', 'sportco_blog');

/** MySQL database username */
define('DB_USER', 'sportco_blog');

/** MySQL database password */
define('DB_PASSWORD', '0{}Fn75ft1.P');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '?`C{FZB.T-}|vle>o)?kp0J#^-65G--9<2-E}&R&{tHyj>~|mqc[|W<[tJ=y>*_T');
define('SECURE_AUTH_KEY',  'Vl~2~X<Z-+X-0:!=%+:[Fcx1}j7cwouI>~xpKbpw|sZ01|leT.9*&1z$Q%O_jbQ7');
define('LOGGED_IN_KEY',    'X|y~AA-Bx.6ZSX[$8J+p!V|Q8*?>$&<q>lAm[lClA8Mty0fE_D-+;](Y|wy-S$@=');
define('NONCE_KEY',        '8h{-WbDFR?DIFX{PD=kdFg?.N6+oCp~h~-W%R96pUm,jvw_,H8%`C=f0l0XKWP+X');
define('AUTH_SALT',        '`P;]=&h: ?+sI8,]U8d2#ub[-cMAF?o8ZpGJ*5@K^%EcaA+z qBW >w@#W|C4}Ih');
define('SECURE_AUTH_SALT', '@;v]_-s<?El9NY=aD59WyhLc@hB)vh`!7t>AE-[o~I| O^^H3^:~iR#&**[(8{#7');
define('LOGGED_IN_SALT',   'tK>+fGYy<+}!)IXUmSauN`$sY~;7h&HjIW$&3f|.!02Hm[4hQxAUffg6Q~PA)|%y');
define('NONCE_SALT',       'd9y(eAFU^}h<G|BiF/@zA}mp}.Z%28?o<O!9yq_=zbiwVw$x K+~N AA.Rd-/R;k');

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
