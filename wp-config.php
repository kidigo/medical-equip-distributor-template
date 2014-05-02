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
define('AUTH_KEY',         '(E]/Z(Q4Fh;z+f!nUWN?~8v@yW=z]Gi;7[%H{uMA[*h?eS|D|t6TobcI5Ft_Wnd4');
define('SECURE_AUTH_KEY',  'q!dY>lfhoy/]td&WOYc10k-^_wj5{^r~IiSP|{ta/7w5R$`-]W.tsbnCK!$b802v');
define('LOGGED_IN_KEY',    '8tdX7!Y9!EN(o-cs+i&JIZZYH]=]t=RlB}-$WpD?vx|KE?vAhlAU]{lUhv!9P*IO');
define('NONCE_KEY',        'P2KhA[8@zz6VR54N2eXR0[wfj~dbn:8q<paQ{3l0l<OLIH9p^M7+~ff1O:6_R]q4');
define('AUTH_SALT',        'c$ggaV.+{p>Cp<q~@(+e/X-{z,T8}=+bRO WQxc,jz}se=2~E:ceRx,h71SMC(!c');
define('SECURE_AUTH_SALT', '/sx)u/+cu& 3N[$LqOSnOl]@{z5NJuF*ICAQ+ lX{>y`_=Rb!YMg:.A8=S+2.:#m');
define('LOGGED_IN_SALT',   '2xNj[Q>3V*xFiJT?mC}x5;Xe}B4~K%.fls#|k,y{b/M$B~=0~> C,<w<tOz~URV9');
define('NONCE_SALT',       ')BQu`Yxq-{dk8Qp`YKGF+}/9SFO<r@WVA]}Na+|(IT|2oG?7meL%)B7iP;&efjm2');

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
