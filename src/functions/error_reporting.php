<?php
error_reporting( 0 );

if ( user_can( wp_get_current_user(), 'administrator' ) ) {
	define( 'UTM_GITHUB', 'https://github.com/Rekurencja/rekurencja-com/tree/landing/src' );

	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );

	$debug = true;
}

define( 'UTM_DEBUG', $debug );
define( 'UTM_SOURCE', 'utm_source=landing' );
