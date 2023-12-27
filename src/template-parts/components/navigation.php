<?php
$menu_name    = 'header-menu';
$header_menu  = get_term_by( 'name', $menu_name, 'nav_menu' );
$buttons      = get_field( 'buttons', 'term_' . $header_menu->term_id );
$img          = 'https://wilmed.rekurencja.com/wp-content/uploads/2023/12/logo.webp';
$phone_number = get_field( 'gf_company_phone', 'options' );
$email        = get_field( 'gf_company_email', 'options' );
$avatar       = get_field( 'avatar', 'options' );
$tiny_avatar  = new MiLossy( $avatar, 'n__c--i lazyload' );
$medi_raty    = get_field( 'mediraty', 'options' );
$medi_logo    = new MiLossy( $medi_raty, 'lazyload' );
?>

<header class="n d-grid w-100 c pos-fix" style="z-index:10;left:0">
	<div class="n__c-wr m-auto w-100 breakout d-flex aic jcb">
		<div class="n__t pos-rel d-flex">
			<a href="<?= home_url(); ?>" class="n__logo-wr d-inline-flex aic" style="flex-shrink:0" title="Powrót na stronę główną">
				<img class="n__logo" width="180" height="58" src="<?php echo esc_html( $img ); ?>" alt="Logo Wilmed">
			</a>
			<div class="n__dec"></div>
			<div class="n__c d-flex aic w-100 jca">
				<div class="n__c--h d-flex aic">
					<p class="d-flex aic" style="gap: 16px;">
						<?php $tiny_avatar->Draw(); ?>
						Skontaktuj się z nami
					</p>
					<p class="f-400 c-heading d-flex" style="gap:12px; ">
						<svg class="c-def" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#phone"></use>
						</svg>
						<?php echo esc_html( $phone_number ); ?>
					</p>
					<p class="f-400 c-heading d-flex" style="gap:12px;">
						<svg class="" width="17" height="16" viewBox="0 0 16 16">
							<use xlink:href="#email"></use>
						</svg>
						<?php echo esc_html( $email ); ?>
					</p>
				</div>
				<div class="n__c--dec"></div>
				<div class="n__c--b d-flex aic" style="gap:16px">
					<p>
						Możliwość płatności ratalnych
					</p>
					<a href="https://www.mediraty.pl/" target="_blank" rel="noopener noreferrer">
						<?php $medi_logo->Draw(); ?>
					</a>
				</div>
				<div class="n__c--b d-flex aic" style="gap:32px">
					<p class="d-flex" style="gap:4px;align-items: baseline;">
						<a href="#" data-font-size="12px" class="size_S" onclick="changeFontSize(event)">A</a>
						<a href="#" data-font-size="14px" class="size_M" onclick="changeFontSize(event)">A</a>
						<a href="#" data-font-size="16px" class="size_L" onclick="changeFontSize(event)">A</a>
					</p>
					<p><span class="contrast">A</span></p>
				</div>
				<div class="n__c--btn">
					<a class="btn__g c-white m-0 f-alt f-400"><svg class="s__btn__ico" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#phone"></use>
						</svg>Zadzwoń
					</a>
					<a class="btn__w c-heading m-0 f-alt f-400">Konsultacja<svg class="s__btn__ico" width="16" height="16" viewBox="0 0 16 16" style="color:#1AAA55">
							<use xlink:href="#right-arrow"></use>
						</svg>
					</a>
				</div>
			</div>
		</div>
		<div class="n__left d-flex aic jcb w-100">
			<?php
			if ( ! wp_get_nav_menu_object( $menu_name ) || $header_menu == null ) {
				if ( UTM_DEBUG ) {
					editor_notice( 'Menu "' . $menu_name . '" nie istnieje.' );
				}
			}
			?>
			<?php
			if ( $header_menu && has_nav_menu( $header_menu->name ) ) :
				?>
				<div class="n__nav--wr">
					<svg class="n-hb cp hamRotate" viewBox="0 0 100 100" width="50">
						<path fill="none" class="n-hb__line top" stroke-dasharray="40 160" d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
						<path fill="none" class="n-hb__line middle" stroke-dasharray="40 142" d="m 30,50 h 40" />
						<path fill="none" class="n-hb__line bottom" stroke-dasharray="40 85" d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
					</svg>
					<nav class="n-nav nav pos-abs d-flex f-c aic a-hover" aria-label="Menu kontekstowe">
						<?php
						wp_nav_menu( [ 'menu' => $header_menu, 'menu_class' => 'n-nav__ul d-flex f-c m-0 p-0', 'container' => null, 'walker' => new CustomNavMenu( 'n-nav', aClass: 'd-flex f-500', submenuSupport: true ) ] );
						?>
					</nav>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
	try_attach_resource( 'js/menuHamburger.js' );
	?>
</header>

<?php
try_attach_resource( 'js/navigationScripts.min.js' );
?>

