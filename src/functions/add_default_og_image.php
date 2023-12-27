<?php

add_action(
	'wp_head',
	function () {
		{
		$post_id = get_the_ID();

		$maybe_og_image_url = get_post_meta( $post_id, '_yoast_wpseo_opengraph-image', true );
		if ( $maybe_og_image_url || has_post_thumbnail( $post_id ) ) {
			return;
		}

		if ( $maybe_default_og_image = get_field( 'og_image', 'options' ) ) {
			echo '<meta property="og:image" content="' . esc_url( $maybe_default_og_image['url'] ) . '">';
		}
		}
	}
);
