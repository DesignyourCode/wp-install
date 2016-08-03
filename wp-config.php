<?php

// ===================================================
// Load database info and local development parameters
// ===================================================
require(dirname( __FILE__ ) . '/vendor/autoload.php');

$config = spyc_load_file(dirname( __FILE__ ) . '/app/config/parameters.yml');
$var = $config['parameters'];

if ($var['heroku'] === false) {
    define( 'DB_NAME', $var['db_name'] );
    define( 'DB_USER', $var['db_user'] );
    define( 'DB_PASSWORD', $var['db_password'] );
    define( 'DB_HOST', $var['db_host'] );
} else {
    define( 'DB_NAME', '%%DB_NAME%%' );
    define( 'DB_USER', '%%DB_USER%%' );
    define( 'DB_PASSWORD', '%%DB_PASSWORD%%' );
    define( 'DB_HOST', '%%DB_HOST%%' );
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );

// =================================
// Setup S3 parameters for wp-offload
// ==================================
define('DBI_AWS_ACCESS_KEY_ID', '%%DBI_AWS_ACCESS_KEY_ID%%');
define('DBI_AWS_SECRET_ACCESS_KEY', '%%DBI_AWS_SECRET_ACCESS_KEY%%');

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==========================================
// Salts, for security
// These are generate from 'composer compile'
// ==========================================
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

// ===========
// Hide errors
// ===========
// ini_set( 'display_errors', 1 );
// define( 'WP_DEBUG_DISPLAY', true );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
if (
    !file_exists( dirname( __FILE__ ) . '/local-config.php' ) &&
    !getenv('WP_DEBUG')
) {
    define( 'WP_DEBUG', false );
    define( 'SCRIPT_DEBUG', false );
} else {
    define( 'WP_DEBUG', true );
    define( 'SCRIPT_DEBUG', true );
}

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) ) {
    $memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );
}

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}
require_once( ABSPATH . 'wp-settings.php' );
