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
//define('DB_NAME', 'sportco_publish_WP');

/** MySQL database username */
//define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', '');

/** MySQL hostname */
//define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
//define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
//define('DB_COLLATE', '');


//define( 'FS_METHOD', 'direct' );



    define('DB_NAME', 'sportco_publish_WP');
    define('DB_USER', 'sw_dev');
    define('DB_PASSWORD', 'swpROz2t6UP2Oduz2BuprAfr_JIk43w1dOQoDdev');
    define('DB_HOST', 'sportswizz-dev.cutipgkbtoea.ap-south-1.rds.amazonaws.com');
    define('DB_CHARSET', 'utf8mb4');
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
define('AUTH_KEY',         '0{0%</k[$bk.@sugsdU`q@w6_wCG^C4KitYU>-xGDm#dux?2U9iR-u:5,JcIAG=e');
define('SECURE_AUTH_KEY',  'S+[aA-+|hwWJwTeL`rt_|F&*kBc{oYG)-aBCE1BjQ+3-c0Zp3pIKSw-$o~Y|<l+u');
define('LOGGED_IN_KEY',    'da9S95fb;m;b~2/=o:,DB?$%xe5H)j&3Xnasx69AI]bFQ2z0 uBzV=Y`vc.LO+]F');
define('NONCE_KEY',        'eGEiF_BV^q.`-/RMQZ.mb$~W~z#i7z70Jc@dITH=yD0/&M|<!NPyudfa7]HAdYQ>');
define('AUTH_SALT',        'cWIOi_$ikN1<3|90v3,DV7E*.kJ3AgXqld[SV;BaYM_;,0XU[sD:hIr<5 Zg**Y}');
define('SECURE_AUTH_SALT', '?3U)4P0Ejf%%},?qSzkyU<^8>]}t5M@8|}4#M`br-~EDn4d7lM3IHx,ofFVoE}%}');
define('LOGGED_IN_SALT',   ',k8lxkeqARZ?-YJ3X2>g=@zuPnI[!=/+=&+0<ZgOq:Y6ru-<9)i>#}^a4&i  C`{');
define('NONCE_SALT',       'egL 6&L(Ql;:DxIPnxv+{@|c73z|1aYsJh`63KHUtP~V9rogINB0/>su01 VNuX(');

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

