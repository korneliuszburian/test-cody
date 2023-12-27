<?php

require_once 'html-compression/FLHM_HTML_Compression.php';
add_action(
	'get_header',
	function () {
		ob_start( fn ( $html ) => new FLHM_HTML_Compression( $html ) );
	}
);
