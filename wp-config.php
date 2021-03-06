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
$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services,true);
$mysql_config = $services_json["mysql-5.1"][0]["credentials"];

$tes = getenv('OPENSHIFT_APP_NAME');
if ( isset($tes) AND $tes !== FALSE )
{
	$mysql_config['name']		=	getenv('OPENSHIFT_MYSQL_DB_NAME');
	$mysql_config['user']		=	getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$mysql_config['password']	=	getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$mysql_config['hostname']	=	getenv('OPENSHIFT_MYSQL_DB_HOST');
	$mysql_config['port']		=	getenv('OPENSHIFT_MYSQL_DB_PORT');
	
}


// ** MySQL settings from resource descriptor ** //
define('DB_NAME', $mysql_config["name"]);
define('DB_USER', $mysql_config["user"]);
define('DB_PASSWORD', $mysql_config["password"]);
define('DB_HOST', $mysql_config["hostname"]);
define('DB_PORT', $mysql_config["port"]);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'gB{P8m|dkN*/1oj5|&aKfaA+K@v#|LH+E|~~:XmTTI}Cxh8yR!`zA^>i+Y4T8h}v');
define('SECURE_AUTH_KEY',  'eBny=kA5>K*/C~NSV3UK:Xq-68a-LESG3F+^C+{hHfb`R2rXh@Tt)qbW3JI`3KO|');
define('LOGGED_IN_KEY',    'YakYv=d/B,In>z/q?8,{+%`-`MrY^&=tlHL+2ZNG[,sTeC5+M)+Udf7nJC3*P8:Y');
define('NONCE_KEY',        '[;lmy{_!_-@q*<DqXOiNVtjcUV+KAM]WV>[v:!>Q||ksW=eTJyy7k(}^S6-aW2B{');
define('AUTH_SALT',        'n1L40`sT~PelH/O+a3m_%,M_43(@3C/[{DJ,<5:{+btyS8|~__)P2ASn6Oh/TeTv');
define('SECURE_AUTH_SALT', '(%_a/+iQRu?!-F`iC/a0*dN.soiyci210^}_xL3oK52(u-:lhUDP$@?TAu17I%UD');
define('LOGGED_IN_SALT',   '$+<OIO=OBG$0FW=+gZt/~v@6c1Qc|SEWn=],MIo72^SLz*`~+2fCo:M{Xe,ewNXf');
define('NONCE_SALT',       '6N,d=>/r Y7EUSWcRR0AR_t.%rV!j/OtzNFS%xW]YY|<.-vbR*}H1O-C{B|QRK7|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'jhcshop_';

// addtional EDITING 
define( 'WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/jhcshop' );
define( 'WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] . '/jhcshop' );
define( 'WP_MEMORY_LIMIT', '64M' );



/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

// define('RELOCATE',true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
