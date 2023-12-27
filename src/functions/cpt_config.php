<?php

/** Custom post types  */
function register_cpt() {
	register_post_type(
		'uslugi',
		[
			'labels'        => [
				'name'          => 'Usługi',
				'singular_name' => 'Usługi',
				'add_new'       => 'Dodaj usługę',
			],
			'public'        => true,
			'menu_icon'     => 'dashicons-list-view',
			'menu_position' => 22,
			'hierarchical'  => true,
			'supports'      => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ],
			'has_archive'   => false,
			'rewrite'       => [
				'slug'       => 'oferta',
				'with_front' => false,
			],
		]
	);
	register_post_type(
		'specjalisci',
		[
			'labels'       => [
				'name'          => 'Specjaliści',
				'singular_name' => 'Specjaliści',
				'add_new'       => 'Dodaj specjalistę',
			],
			'menu_icon'    => 'dashicons-admin-users',
			'public'       => false,
			'hierarchical' => true,
			'show_ui'      => true,
			'supports'     => [ 'title', 'page-attributes' ],
		]
	);
	register_post_type(
		'cennik',
		[
			'labels'       => [
				'name'          => 'Cennik',
				'singular_name' => 'Cennik',
				'add_new'       => 'Dodaj cennik',
			],
			'menu_icon'    => 'dashicons-money',
			'public'       => false,
			'hierarchical' => true,
			'show_ui'      => true,
			'supports'     => [ 'title', 'page-attributes' ],
		]
	);
	register_post_type(
		'hero',
		[
			'labels'             => [
				'name'          => 'Strona tytułowa',
				'singular_name' => 'Strona tytułowa',
				'add_new'       => 'Dodaj stronę tytułową',
			],
			'public'             => false,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-admin-home',
			'menu_position'      => 22,
			'supports'           => [ 'title', 'thumbnail' ],
			'has_archive'        => false,
			'publicly_queryable' => false,
		]
	);
}
add_action( 'init', 'register_cpt' );
