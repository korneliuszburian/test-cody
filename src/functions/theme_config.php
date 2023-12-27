<?php

/** security headers */
add_action(
	'send_headers',
	function () {
		header( 'X-Content-Type-Options: nosniff' );
	}
);

/** disable gutenberg */
add_filter( 'use_block_editor_for_post', '__return_false' );
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
		wp_dequeue_style( 'global-styles' );
	},
	100
);

/** resources */
add_action(
	'wp_print_styles',
	function () {
		wp_deregister_script( 'jquery' );
	},
	1
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/style.css', ver: '1.0.0' );
		wp_dequeue_style( 'classic-theme-styles' );
	}
);

function defer_non_critical_css_loading( $html, $handle ) {
	$handles = array( 'theme' );
	if ( in_array( $handle, $handles ) ) {
		$html = str_replace( 'media=\'all\'', 'media=\'print\' onload="this.onload=null;this.media=\'all\'"', $html );
	}
	return $html;
}
add_filter( 'style_loader_tag', 'defer_non_critical_css_loading', 10, 2 );

/** wp-admin-bar fix for mobile */
function add_custom_admin_bar_style() {
	if ( is_user_logged_in() ) {
		echo '<style>#wpadminbar{position:fixed;}</style>';
	}
}
add_action( 'wp_head', 'add_custom_admin_bar_style' );

/** trailing slashes in wp_head */
function remove_trailing_slashes( $buffer ) {
	$buffer = preg_replace( '/<(meta|link)\s+(.*?)\s*\/>/i', '<$1 $2>', $buffer );
	return $buffer;
}

function start_buffering() {
	ob_start( 'remove_trailing_slashes' );
}
function end_buffering() {
	if ( ob_get_length() ) {
		ob_end_flush();
	}
}
add_action( 'wp_head', 'start_buffering', -1 );
add_action( 'wp_head', 'end_buffering', 999 );

/** theme support */
add_post_type_support( 'page', 'excerpt' );
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'script', 'style' ) );
	}
);

/** image sizes */
function remove_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes_to_remove = array( '2048x2048', '1536x1536' );

	foreach ( $sizes_to_remove as $size ) {
		if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			unset( $_wp_additional_image_sizes[ $size ] );
		}
	}
}

function remove_default_image_sizes( $sizes ) {
	$remove_sizes = array( 'thumbnail', 'medium', 'medium_large', 'large' );

	foreach ( $remove_sizes as $size ) {
		$key = array_search( $size, $sizes );
		if ( false !== $key ) {
			unset( $sizes[ $key ] );
		}
	}

	return $sizes;
}

add_action( 'init', 'remove_additional_image_sizes' );
add_filter( 'intermediate_image_sizes', 'remove_default_image_sizes' );
add_filter( 'big_image_size_threshold', '__return_false' );

function add_image_sizes() {
	add_image_size( 'thumbnail-150', 150 ); // min
	add_image_size( 'thumbnail-300', 300 ); // 3col 1140 = 285w
	add_image_size( 'medium-500', 500 ); // 4col 1140 = 380w
	add_image_size( 'medium-768', 768 ); // 6col 1140 = 570w
	add_image_size( 'medium-1024', 1024 ); // 1920/2 = 960w
	add_image_size( 'medium-1280', 1280 ); // 1140w
	add_image_size( 'big-1440', 1440 ); // wider 1140w containers
	add_image_size( 'big-1920', 1920 ); // full-width (max)
}
add_action( 'after_setup_theme', 'add_image_sizes', 999 );

function start_output_buffering() {
	global $pagenow;
	if ( 'options-media.php' === $pagenow ) {
		ob_start( 'modify_media_options_page' );
	}
}
add_action( 'admin_head', 'start_output_buffering' );

function modify_media_options_page( $content ) {
	global $_wp_additional_image_sizes;
	$registered_sizes = wp_get_registered_image_subsizes();
	$all_sizes        = array_merge( $registered_sizes, $_wp_additional_image_sizes );

	uasort(
		$all_sizes,
		function ( $a, $b ) {
			return $a['width'] - $b['width'];
		}
	);

	$replace_content = '<ul class="ul-disc">';

	foreach ( $all_sizes as $key => $value ) {
		$replace_content .= "<li>{$key} ({$value['width']}px szerokości)</li>";
	}
	$replace_content .= '</ul>';
	$replace_content .= '<p>Powyższe rozmiary obrazków ustawiane są przez deweloperów Rekurencja.com specjalnie na potrzeby strony internetowej.</p>';

	$plugins                      = get_plugins();
	$regenerate_thumbnails_plugin = 'regenerate-thumbnails/regenerate-thumbnails.php';
	$webp_avif_plugin             = 'webp-avif-converter-main/web-avif-converter.php';

	if ( array_key_exists( $regenerate_thumbnails_plugin, $plugins ) && is_plugin_active( $regenerate_thumbnails_plugin ) ) {
		$replace_content .= '<p><a href="/wp-admin/tools.php?page=regenerate-thumbnails#/">Regeneruj miniaturki</a></p>';
	}
	if ( array_key_exists( $webp_avif_plugin, $plugins ) && is_plugin_active( $webp_avif_plugin ) ) {
		$replace_content .= '<p><a href="/wp-admin/options-general.php?page=webp_avif_bulk_convert">Ustawienia WEBP/AVIF</a></p>';
	}

	$content = preg_replace( '/<table class="form-table" role="presentation">.*?<\/table>/s', $replace_content, $content, 1 );

	return $content;
}

/** removal of some backend options */
add_action(
	'admin_head',
	function () {
		/* password */
		echo '<style>input#visibility-radio-password,label[for="visibility-radio-password"],label[for="visibility-radio-password"]+br{display:none!important;visibility:hidden!important}</style>';

		/* menu_order */
		echo '<style>label[for="menu_order"],input[name="menu_order"]{display:none!important;visibility:hidden!important}</style>';
	}
);

/** ga4 **/
// function add_ga4_data()
// {
// wp_enqueue_script('ga4', get_stylesheet_directory_uri() . '/assets/js/runGtag.min.js');
// $ga_4_data = get_field('ga_4', 'options');
// $privacy_policy_url = get_privacy_policy_url();

// wp_localize_script('ga4', 'ga4', ["data" => $ga_4_data, "policy_page_url" => $privacy_policy_url]);
// }
// add_action('wp_enqueue_scripts', 'add_ga4_data');


function plugin_mce_css( $mce_css ) {
	if ( ! empty( $mce_css ) ) {
		$mce_css .= ',';
	}
	$mce_css .= get_template_directory_uri() . '/assets/css/admin_wysiwyg.css';
	return $mce_css;
}
add_filter( 'mce_css', 'plugin_mce_css' );

function myTinyMceScript() {
	wp_enqueue_script( 'my-qtag-script', get_template_directory_uri() . '/assets/js/custom-tinymce-text.js', array( 'quicktags' ) );
}
add_action( 'admin_print_footer_scripts', 'myTinyMceScript' );

add_action(
	'admin_head',
	function () {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', 'myprefix_add_tinymce_plugin' );
			add_filter( 'mce_buttons', 'myprefix_register_mce_button' );
		}
	}
);

function myprefix_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button']  = get_template_directory_uri() . '/assets/js/custom-tinymce-visual.js';
	$plugin_array['style_selector'] = get_template_directory_uri() . '/assets/js/custom-tinymce-text.js';
	$plugin_array['apply_style']    = get_template_directory_uri() . '/assets/js/apply-style.js';
	return $plugin_array;
}

function myprefix_register_mce_button( $buttons ) {
	array_push( $buttons, 'my_mce_button' );
	array_push( $buttons, 'style_selector' );
	array_push( $buttons, 'apply_style' );
	return $buttons;
}

function my_acf_input_admin_footer() {
	?>
	<script type="text/javascript">
		(function($) {
		acf.add_filter('wysiwyg_tinymce_settings', function(mceInit, id) {
			mceInit.toolbar1 += ',my_mce_button';
			mceInit.toolbar1 += ',style_selector';
			mceInit.toolbar1 += ',apply_style';

			mceInit.external_plugins = mceInit.external_plugins || {};
			mceInit.external_plugins['my_mce_button'] = '<?php echo get_template_directory_uri(); ?>/assets/js/custom-tinymce-visual.js';

			return mceInit;
		});
		})(jQuery);
	</script>
	<?php
}
add_action( 'acf/input/admin_footer', 'my_acf_input_admin_footer' );
