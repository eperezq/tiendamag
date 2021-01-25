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
define( 'DB_NAME', 'tiendameg' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'y{c>amm<bJa_@Do5RgxT=3@2-><8}I8Y1_!B=c-3hW;tn^OaoB_]xMI~T5H22#9?' );
define( 'SECURE_AUTH_KEY',  ',0n_}68(T9/6>s(+/*K=8XRQ&T^>i97(6(n0B1=$KQ(M,O,G!D9)}W2 U;aLJ+$?' );
define( 'LOGGED_IN_KEY',    'lG?mFH/DE4(g@>Y/jV}Ymy;Rocd4!^hisKJg}UWdFT?$`l(<(g@y.mlG%Z!;[![G' );
define( 'NONCE_KEY',        '4zG4b.Q6kcRa6WgQ[V,,xm{@F,[H(%bQb_E#tK(J({ID/JQG?>H:xf42mEpvKHR%' );
define( 'AUTH_SALT',        'cu9@n^7,PB:S0:Dkmz%Vy&v1?L*UR!q%G-14O[Kh=Gelc:0t@[;4TASbJ5vpmWA$' );
define( 'SECURE_AUTH_SALT', 'R@)M;j?k=qH31_hK#_$f9#7n_*lcgs71qdF.k7s{:D/SUlixLwwrt=L-}Ypy!D3D' );
define( 'LOGGED_IN_SALT',   'B(lWez)L0(?*krhgSC?g^i@T^x.Hg~BVTW;S*#b`9,[%pg.%O`ve=VU/fI]dFc8p' );
define( 'NONCE_SALT',       'BAK$/Baiw?[Ra[,GC3<>guxwAiKWN=QVzNP6vAXh}!O6Op3C?/d+9)fI$; <F<?I' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wffaseawd_';

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
