<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// Ce paramètre est requis pour garantir le bon traitement des mises à jour WordPress dans WordPress Toolkit. Supprimez cette ligne si ce site Web WordPress n'est plus géré par WordPress Toolkit.
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'inoovins_site' );

/** MySQL database username */
define( 'DB_USER', 'inoovins' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Inoovins@2020' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '6l4qxXvIRanUU2B3;45h~r4]EBWHP!62Rb7iSV|To%9!C%%-:)zT14wclH3M2|0c');
define('SECURE_AUTH_KEY', '61fG0i5(%U4vpu7362!R~D04JooY0QRBf*mjdcgGxs%ENT;12ZUy6O/*19N;lDvd');
define('LOGGED_IN_KEY', 'rzzpw9s(WMBG2_:G-_h0UeC|42|3#6%Yl&H_&75A@1iMbYE8~juw4:AJ6ga|6zeE');
define('NONCE_KEY', '1i1N3+QZy8:U#2P[&~46ZM8M[mB*/kCSp~J2ue7a!0u28!856wrsk6L24y761)20');
define('AUTH_SALT', '-8QZ7#3*2x)f8DfQf9wk%48y2LC5;/v3WIKSFu*W:7mm%Qi+6TVW:b[_3@mGM%*r');
define('SECURE_AUTH_SALT', 'uSwT#uD[DX_nL]/3#~/e7;F7H]b8T*j;02z#6gM]OV7:+m3@rZ]4d7q2!|1|]*7:');
define('LOGGED_IN_SALT', '!Wo-OdU/30GL0++s&9)516F8q4]#tCWe9]%i9gzV5[5oCA)1#A4E]d@f&3I:)3CU');
define('NONCE_SALT', '&ZjL3nxyB][F&3z!yX-+%Ab+G~rIe(5d;G8oT4-G!4)CFU8j0zg3R/I8B&_EHy%o');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'B59tzct_';


define('WP_ALLOW_MULTISITE', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
