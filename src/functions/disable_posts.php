<?php
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit.php' );
	}
);

add_action(
	'admin_bar_menu',
	function ( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'new-post' );
	},
	999
);

add_action(
	'wp_dashboard_setup',
	function () {
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	},
	999
);
