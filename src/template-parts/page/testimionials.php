<?php

/**
 * Template part for displaying testimonials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

$hdd     = get_sub_field( 'heading-double-desc' );
$title   = get_field( 'testimonials-title', 'options' );
$opinion = get_field( 'testimonials-opinion', 'options' );
$star    = get_field( 'testimonials-star', 'options' );
$count   = get_field( 'testimonials-count', 'options' );
$url     = get_field( 'testimonials-url', 'options' );
$star_g  = get_field( 'testimonials-star-g', 'options' );
$count_g = get_field( 'testimonials-count-g', 'options' );
$url_g   = get_field( 'testimonials-url-g', 'options' );
?>

<?php echo esc_html( splide_script_async() ); ?>

<div class="tes c pos-rel d-grid">
	<div class="tes__wr grid">
		<div class="tes__h">
			<?php get_component( 'heading-double-desc', args: $hdd ); ?>
		</div>
		<div class="tes__l-col">
			<svg class="" width="170" height="28" viewBox="0 0 170 28">
				<use xlink:href="#znanyLekarz"></use>
			</svg>
			<p class="f-alt l-5 f-400">
				<?php echo esc_html( $title ); ?>
			</p>
			<div class="d-flex f-c" style="gap:5px;">
				<div class="stars">
					<?php
					for ( $i = 0; $i < $star; $i++ ) {
						echo '<svg width="16" height="16" viewBox="0 0 16 16"><use xlink:href="#star"></use></svg>';
					}
					?>
				</div>
				<p class="h5"><span><?php echo esc_html( $star ); ?></span>
					/ 5
				</p>
			</div>
		</div>
		<div class="tes__l-col d-flex f-c">
			<svg class="" width="295" height="73" viewBox="0 0 295 73">
				<use xlink:href="#kliniki"></use>
			</svg>
			<p class="f-alt l-5 f-400">
				<?php echo esc_html( $title ); ?>
			</p>
			<div class="d-flex f-c" style="gap:5px;">
				<div class="stars">
					<?php
					for ( $i = 0; $i < $star; $i++ ) {
						echo '<svg width="16" height="16" viewBox="0 0 16 16"><use xlink:href="#star"></use></svg>';
					}
					?>
				</div>
				<p class="h5"><span><?php echo esc_html( $star ); ?></span>
					/ 5
				</p>
			</div>
		</div>
		<!-- </div> -->
	</div>
	<div class="tes__dec pos-abs"></div>
</div>
