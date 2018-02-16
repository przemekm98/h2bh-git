<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
 //Added by WP-Cache Manager
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/var/www/vhosts/how2behealthy.nl/httpdocs/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
/** The name of the database for WordPress */
define('DB_NAME', 'hossein_wrdp2');


/** MySQL database username */
define('DB_USER', 'hossein_wrdp2');


/** MySQL database password */
define('DB_PASSWORD', '2Pc6vRXHUgAOIio');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');


/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FORCE_SSL_ADMIN', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'B*6?mu_6bPuGpp63HCtMzy52YgW#CSs$P=BTUjj\`70Xv9m=yl507@r4$5u2g(AKX5:;g\`*');
define('SECURE_AUTH_KEY',  '3a5w|?C8>ZF(|_X<|\`heq15-c>VM2Zk_G6_oZ\`y#2U#61|22@l3_\`pmv#r*U_@y(OWB');
define('LOGGED_IN_KEY',    '6AmX8N-^pXWMj^X=Q8w!AT;7v~(V\`fWeul_-#S~T:gHiFT1u8CL~BttAEPHl-g-I0;r7');
define('NONCE_KEY',        'aVKM8Lt0^@?93Wf^t2ayDR*Z7O\`-hFA(_3gRibzrpoJBtX31Rv#U6m28C-ah_6@I7)fW');
define('AUTH_SALT',        'B72O;n5cZ6a0jUUV2rbS|(i2k!H8->#MHxaB95xSO?uv0)C/efg7<_>fx?#Z@r3@7A)<Yq1zPH7');
define('SECURE_AUTH_SALT', 'YmN!e=7bF@f2A06m(xM9PsVGsbiMU~bH6ycoWqzm)#7a*ju8x3oL\`=~?W2)PHTYXuNI');
define('LOGGED_IN_SALT',   '82A1;~4?N!_N=5C*VGH8j!24Wbz=wT!ocHOha:7b#9cs)fAqFsc2uwT>;Go:E^T@');
define('NONCE_SALT',       '7<iotz7(D/#>bY6:ejCdH;?iR^2~*YfELAWPu5a7S|p80y!ebd<RR-=3gM4L30<gwrPT__n#/d^@');


/**#@-*/
define('AUTOSAVE_INTERVAL', 600 );
define('WP_POST_REVISIONS', 1);
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
define( 'WP_AUTO_UPDATE_CORE', true );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('DISABLE_WP_CRON', true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
