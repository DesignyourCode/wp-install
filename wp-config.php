<?php

// ===================================================
// Load database info and local development parameters
// ===================================================
require(dirname( __FILE__ ) . '/vendor/autoload.php');
require(dirname( __FILE__ ) . '/bin/populate-db.php');

$parameters = dirname( __FILE__ ) . '/app/config/parameters.yml';

$config = spyc_load_file($parameters);
$var = $config['parameters'];

if (!file_exists($parameters)) {
    define( 'DB_NAME', $db );
    define( 'DB_USER', $user );
    define( 'DB_PASSWORD', $pass );
    define( 'DB_HOST', $host );
} else {
    define( 'DB_NAME', $var['db_name'] );
    define( 'DB_USER', $var['db_user'] );
    define( 'DB_PASSWORD', $var['db_password'] );
    define( 'DB_HOST', $var['db_host'] );
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ===========================================
// Salts, for security
// These are generated from 'composer compile'
// ===========================================
if ( file_exists( __DIR__ . '/salt.php' ) ) {
    require __DIR__ . '/salt.php';
}

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// =================================
// Setup S3 parameters for wp-offload
// ==================================
if (!file_exists($parameters)) {
    define( 'DBI_AWS_ACCESS_KEY_ID', getenv('DBI_AWS_ACCESS_KEY_ID') );
    define( 'DBI_AWS_SECRET_ACCESS_KEY', getenv('DBI_AWS_SECRET_ACCESS_KEY') );
} else {
    define( 'DBI_AWS_ACCESS_KEY_ID', $var['dbi_aws_access_key_id'] );
    define( 'DBI_AWS_SECRET_ACCESS_KEY', $var['dbi_aws_secret_access_key'] );
}

// ====================================================================
// Debug mode
// Enable these in app/config/paramters.yml or on heroku in config vars
// ====================================================================
if (!file_exists($parameters)) {
    if (getenv('DEBUG') === 'true' || getenv('DEBUG') === true) {
        $debug = true;
    } else {
        $debug = false;
    }

    define( 'WP_DEBUG', $debug );
    define( 'SCRIPT_DEBUG', $debug );
} else {
    define( 'WP_DEBUG', $var['debug'] );
    define( 'SCRIPT_DEBUG', $var['debug'] );
}

// =======================================
// WordPress SMTP server
// Enable mailing on Heroku using sendgrid
// =======================================
if (!file_exists($parameters)) {
    define( 'WP_SMTP_HOST', 'smtp.sendgrid.net' );
    define( 'WP_SMTP_PORT', 25 );
    define( 'WP_SMTP_ENCRYPTION', 'tls' );
    define( 'WP_SMTP_USER', getenv('SENDGRID_USERNAME') );
    define( 'WP_SMTP_PASSWORD', getenv('SENDGRID_PASSWORD') );
}

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}
require_once( ABSPATH . 'wp-settings.php' );
