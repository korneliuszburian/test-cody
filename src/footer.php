<?php
$data = get_field( 'footer', 'option' );
$logo = $data['logo'];

$menu_name     = 'footer-menu-1';
$footer_menu_1 = get_term_by( 'name', $menu_name, 'nav_menu' );

$menu_name_2   = 'footer-menu-2';
$footer_menu_2 = get_term_by( 'name', $menu_name_2, 'nav_menu' );

$menu_name_3   = 'footer-menu-3';
$footer_menu_3 = get_term_by( 'name', $menu_name_3, 'nav_menu' );
?>

<?php
/** TODO: cookie może być undefined */
// get_template_part(slug: 'template-parts/other/cookies-dialog', args: [
// 'cookies_accepted' => ($_COOKIE['cookies_accepted'] === 'T'),
// ]);
$img = new MiLossy( 'https://wilmed.rekurencja.com/wp-content/uploads/2023/12/logo.png', 'n__logo lazyload' )
// polityka prywatności
// ochrona danych osobowych
?>

<footer class="f c">
	<div class="f__wr grid pic">
		<?php
		if ( ! wp_get_nav_menu_object( $menu_name ) || $footer_menu_1 === null ) {
			if ( UTM_DEBUG ) {
				editor_notice( 'Menu "' . $menu_name . '" nie istnieje.' );
			}
			return;
		}
		?>
		<div class="f__add">
			<?php if ( $logo === 'svg' ) : ?>
				<a href="/#start" class="f__logo-wr pos-rel d-flex aic" style="flex-shrink:0" title="Powrót na górę strony">
					<?php $img->Draw(); ?>
				</a>
			<?php endif; ?>
			<?php if ( $infos = $data['infos'] ) : ?>
				<?php foreach ( $infos as $key => $info ) : ?>
					<div class="f__text l-5 f-alt reg"><?php echo get_with_globals( $info['info'] ); ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="f__add--b">
			<?php if ( $menu_name && ( ! isset( $args['no_menu'] ) || ! $args['no_menu'] ) ) : ?>
				<div class="f__add-menu d-grid">
					<nav class="f-nav nav" aria-label="">
						<?php wp_nav_menu( [ 'menu' => $menu_name, 'menu_class' => 'f__ul d-flex f-c f-w p-0 m-0', 'container' => null, 'walker' => new CustomNavMenu( 'f-nav', 'd-flex', 'c-black p' ) ] ); ?>
					</nav>
				</div>
				<div class="f__add-menu d-grid">
					<nav class="f-nav nav" aria-label="">
						<?php wp_nav_menu( [ 'menu' => $menu_name_2, 'menu_class' => 'f__ul d-flex f-c f-w p-0 m-0', 'container' => null, 'walker' => new CustomNavMenu( 'f-nav', 'd-flex', 'c-black p' ) ] ); ?>
					</nav>
				</div>
				<div class="f__add-menu d-grid">
					<nav class="f-nav nav" aria-label="">
						<?php wp_nav_menu( [ 'menu' => $menu_name_3, 'menu_class' => 'f__ul d-flex f-c f-w p-0 m-0', 'container' => null, 'walker' => new CustomNavMenu( 'f-nav', 'd-flex', 'c-black p' ) ] ); ?>
					</nav>
				</div>						
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
<!-- <div class="f__copy">
				<div class="f__text l-5 f-alt"><?php echo get_dev_display_year( 2023 ); ?> &copy; <?php echo get_field( 'gf_company_name', 'option' ); ?></div>
				<div class="f__text l-5 f-alt">Wszystkie prawa zastrzeżone</div>
			</div> -->
</html>
