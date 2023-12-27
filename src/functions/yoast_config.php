<?php

add_filter(
	'wpseo_breadcrumb_separator',
	function ( $separator ) {
		return '<span class="bc__sep">' . $separator . '</span>';
	}
);
