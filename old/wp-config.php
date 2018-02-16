<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db18855_wp');

/** MySQL database username */
define('DB_USER', 'db18855_wp');

/** MySQL database password */
define('DB_PASSWORD', 'huXenaT3');

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
define('AUTH_KEY',         '{Dq5GoA)+(tE+MGc=stdK&>?cuAVlMsuHTLotT5M[-)!H5q/+zc@!mNd.?/j%7uN');
define('SECURE_AUTH_KEY',  'jk2q .Z+={+q:[-)U@R#8Ro5eK8_>I5pQ+OR}8Iq:mmB3(S}$#C`jEL2r<|5gr}V');
define('LOGGED_IN_KEY',    'acM|4[A_LQ2_1[Ohl4gtb<:sr.@1-U{.a] TlayYtoKaDDU,+:|R1R&)v]C@.ipI');
define('NONCE_KEY',        'mHT2#p%U-U.9Uu}A^7x/P1?BVw#V,yD|vDYSD`3@-6kHB|Q0lnm#q8(.V|Y7qwtX');
define('AUTH_SALT',        'hXPSAcWcBtI]16SF#|)AB!V;Hcn)QNr!A2r0u+y=P3S28n|2psi(l];Zr+jeu6O#');
define('SECURE_AUTH_SALT', '~~6R~z1<M{M**5V|7`[-j]m?ro#sL%oxF^Y$}Aoh[[mWpIh^xY:BQ6v:-(q|Jqiu');
define('LOGGED_IN_SALT',   'Y=#O1|CoyKH#au6g2+b#FH#9$Xi:L~Wx--9/< 7}p}kB,=y%WlK|0,$!}l)`PI f');
define('NONCE_SALT',       '1E3et-%v}L0<}8]A8WMAU&+#C&T/#>B]}nj-/M0<c4R/]Q020O|(Uf^WkRpTIW,I');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_de34yrthfsgh';

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
