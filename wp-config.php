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
define( 'DB_NAME', 'ftpyypbls_87586' );

/** MySQL database username */
define( 'DB_USER', 'ftpyypbls_87586' );

/** MySQL database password */
define( 'DB_PASSWORD', 'be52b2ed8515920cb3c2b978720271fb' );

/** MySQL hostname */
define( 'DB_HOST', '10.30.88.59' );

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
define( 'AUTH_KEY',         'EO&0agm]]|#9}~,0PAzyTA&#>OD1NtP;~>+eN;=7{_73Ad~cb/B&$,Xw0hUe[]0f' );
define( 'SECURE_AUTH_KEY',  'oj?/<[qla:rKiFi5nb|o0IV4,B }2NJvVkoWaTA[e+YC=jmXmYZy|1:9_Sye ^yZ' );
define( 'LOGGED_IN_KEY',    '|-]-)MJ:n[tFYDvXkz(t>m2T|^-dV11:*vaUcTkWLZ:1:R]<E2c3yH6x[n4<V)A)' );
define( 'NONCE_KEY',        '(x)D;c!rormMTtiJGQ&.|~|U!p9HHSdOtdxTI>jwfY|9)_z~Q>L r9_nZO!CyATd' );
define( 'AUTH_SALT',        'eork[GZ>?Pd}U@Zs]@!Y>7xC/d53R{F~a/}t]jh;ZFM!SEpQo*[!E!jR(~kpdAki' );
define( 'SECURE_AUTH_SALT', '+Nvh>])*qr3DHM42]77=}69G{=>s00o!wWF;P[[uvTJN`Q06Nv8=DZuH@_^jC(ZY' );
define( 'LOGGED_IN_SALT',   'uQ[fq5/z.p=2i`(:$h<[/CPRC`kFgP.a*2]%T^_R#(x~Jq{$?(=cX+9PYd?lPD*]' );
define( 'NONCE_SALT',       'o>a(xs:HcGjYphy6WY*]V[RdwSf`3{SBMY,s&#hPgK/Nkwr0IPNqbuilo@JH_$3d' );

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
