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
define( 'DB_NAME', 'parezapa_invoices' );

/** MySQL database username */
define( 'DB_USER', 'parezapa_dbuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'DT{jwLqAS;l.' );

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
define( 'AUTH_KEY',         'j{wd;xIUV[RWN8|l5%ECH@8=>C+q80vXxIAW%q={O+I5VI-LIB+azVwr!k<}`~Vy' );
define( 'SECURE_AUTH_KEY',  'wQ=g!TyQB&n6|@aO~]WW*2@?>H,X^Z]wR@7oDUEtNs6$ji$^G^Q?VBfQtQO7UF0r' );
define( 'LOGGED_IN_KEY',    'o?y#)g 6fCKTlr0kg}0pCbZ%Ko`x.k%$QyCRn4ybEEKeGZOCD7><%]|_;ctQs(?Y' );
define( 'NONCE_KEY',        'k#`J59QAzNNi_ZQLmnF].C5c85=U24#o}3r($ `{Ch+c)J}67WTK5(7|9MGSAC0s' );
define( 'AUTH_SALT',        'u!%&:P)KU5I{Pj1)H=,tl]a=-Ta7j//0g9Ydi@ks0-^oz+99izRLD}ln!>C<+q~*' );
define( 'SECURE_AUTH_SALT', '&$L@2;U}$&wAAlT:-i+lD9AsMrKBfw-z Q!0rDqny~g p}3jb|ald[:-cR=DUbfU' );
define( 'LOGGED_IN_SALT',   '?)>SoAOltT5:`_uoo,_nP.7V6&5]?pAhm3;;|f4e0+3gMi%Bl0g4d]um+#m8*.9$' );
define( 'NONCE_SALT',       'u!k$Yd#<PB^jL}I68noFRF;w4.`Xz3=SH{A9.b26S&YCo]/jAt<,CB6rl26NU?~h' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_pi_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
