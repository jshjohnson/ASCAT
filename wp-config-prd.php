<?php
    define('DB_NAME', 'tarvaDB');
    define('DB_USER', 'jshjohnson');
    define('DB_PASSWORD', 'kerching27');
    define('DB_HOST', 'localhost');
    define('DB_CHARSET', 'utf8');
    define('DB_COLLATE', ''); 
	define('WPLANG', '');

	$table_prefix  = 'wp_';

	define('AUTH_KEY',         '');
	define('SECURE_AUTH_KEY',  '');
	define('LOGGED_IN_KEY',    '');
	define('NONCE_KEY',        '');
	define('AUTH_SALT',        '');
	define('SECURE_AUTH_SALT', '');
	define('LOGGED_IN_SALT',   '');
	define('NONCE_SALT',       '');

	define('WP_HOME','http://localhost:8888/TARVA');
	define('WP_SITEURL','http://localhost:8888/TARVA/wordpress');

	define('WP_CONTENT_URL', 'http://localhost:8888/TARVA/content');
	define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/TARVA/content' );

	if ( !defined('ABSPATH') )
	        define('ABSPATH', dirname(__FILE__) . '/');

	require_once(ABSPATH . 'wp-settings.php');