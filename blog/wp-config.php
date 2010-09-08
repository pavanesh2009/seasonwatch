<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
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
define('AUTH_KEY',         'm:y,o(~/R,+Y5Q|Gu#<[Qd ^=mZ|*p&or8yOq>i[R 46wN*a+l?/!qaFRg2eDUN*');
define('SECURE_AUTH_KEY',  'Z,_2az-HAb+9uD:9i`#dimD,a(-_jf-[%#I-!J6A*T4]I_{F|A}L!8S[.a&T-IS{');
define('LOGGED_IN_KEY',    'I[4{dsB!G,N}id^?b3iMODOQ |zP7I7+Ku7h:2t2s*G5Wy(-b.;Jv*N}MOlB2acr');
define('NONCE_KEY',        'i|7f[fWl9uyWkU1X+Ui<l:q-m>|YYn=-q|-r$drV)_V}Zdq>+>_HyO]V;]Y#/AuB');
define('AUTH_SALT',        'y6P_u^4]0Iz-hJ}yaHkW&QT|W)O(P(s2WpAs-CR14i64+3:vIUm%?LfA[XT|vW+e');
define('SECURE_AUTH_SALT', 'J&oS-nc?BZuDjk -7s=}C#T#d,DmIxs36]TP/l9+#nxh7_*P}rod>M&PJo^4)$cR');
define('LOGGED_IN_SALT',   '1NT^*?pd%{|6d/g]lK4p,#!S9r(88TmVI2HvS?A=(`<|-E-tWSl}Dh<!$|5:f|JM');
define('NONCE_SALT',       'FrXK25XFe%3}nH@OEmba-Vequ(zA{l1dcEt4!a/Xh7s$y6LgpNaN_My3>OC0KRvf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
