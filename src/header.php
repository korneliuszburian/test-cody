<!DOCTYPE html>
<html <?php language_attributes(); ?> style="scroll-behavior:smooth;-webkit-text-size-adjust:100%;line-height:1.15;font-size: 14px;">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="format-detection" content="telephone=no">
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fonts/GeneralSans-Bold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fonts/GeneralSans-Medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fonts/GeneralSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fonts/Spartan-Bold.ttf" as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fonts/Spartan-Medium.ttf" as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fonts/Spartan-Regular.ttf" as="font" type="font/ttf" crossorigin>
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicon/favicon.ico" sizes="32x32">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicon/icon.svg" type="image/svg+xml">
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicon/apple-touch-icon.png">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicon/site.webmanifest">

	<?php
	/* "ht" variable declaration */
	try_attach_resource( 'js/updateHtmlNoJs.min.js' );
	try_attach_resource( 'js/utilities.min.js' );

	/* lazysizes + optimumx */
	try_attach_resource( 'lazysizes-5.3.2/lazysizes.min.js' );
	try_attach_resource( 'lazysizes-5.3.2/ls.optimumx.min.js' );

	/* critical css */
	try_attach_resource( 'css/critical.css', 'style' );

	if ( UTM_DEBUG ) {
		try_attach_resource( 'css/admin.css', 'style' );
	}
	?>

	<?php wp_head(); ?>
</head>

<body id="start" class="bd f-main pos-rel" style="margin:0; padding-top: 157px;">
	<?php
	try_attach_resource( 'js/getScrollbarWidth.min.js' );
	try_attach_resource( 'assets/img/logo.png' );
	get_template_part( 'template-parts/other/svg' );
	// get_template_part('template-parts/_old/mobile-bar');
	// get_template_part('template-parts/_old/cookies-bar');

	get_template_part( 'template-parts/other/wcag-main' );

	/* nav variable declaration */
	get_component( 'navigation' );
	?>
