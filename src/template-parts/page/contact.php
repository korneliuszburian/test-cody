<?php

/**
 *
 */
// global informations
$gf_company_address_first  = get_field( 'gf_company_address_first', 'options' );
$gf_company_address_second = get_field( 'gf_company_address_second', 'options' );
$gf_company_hours          = get_field( 'gf_company_hours', 'options' ); // 08:00-20:00 - we'll need to split it
$gf_company_email          = get_field( 'gf_company_email', 'options' );
$social_media_links        = GetGlobalSectionValue( 'gf_social_media' );
$gf_map                    = get_field( 'gf_map', 'options' );
$hours                     = explode( '-', $gf_company_hours );
$starting_hour             = trim( $hours[0] );
$ending_hour               = trim( $hours[1] );
$description               = get_sub_field( 'desc' );
$small_heading             = get_sub_field( 'heading' );
$sdh                       = get_sub_field( 'small-desc-heading' );
$heading                   = get_sub_field( 'tiny_heading' );
$phone_number              = get_sub_field( 'phone_number' );
$map                       = get_sub_field( 'map' );
$phone_number_first        = get_field( 'gf_company_phone', 'options' );
$phone_number_sec          = get_field( 'gf_company_phone_second', 'options' );
?>

<section class="contact d-grid c pos-rel">
	<div class="contact__wr d-flex f-c" style="gap:44px">
		<div class="contact__h d-flex jcb aic">
			<div class="contact__h--l d-flex f-c" style="gap:24px">
				<?php if ( $description ) : ?>
					<p class="c-text"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>				
				<?php if ( $small_heading ) : ?>
					<p class="c-heading h2"><?php echo esc_html( $small_heading ); ?></p>
				<?php endif; ?>
			</div>
			<div class="contact__h--t d-flex f-c aie" style="gap:10px">
				<?php if ( isset( $heading ) ) : ?>
					<p class="c-heading h6"><?php echo esc_html( $heading ); ?></p>
				<?php endif; ?>
				<div class="contact__h--col d-flex aib" style="gap:4px">
					<?php if ( $phone_number ) : ?>
						<a href="tel:" class="h3 f-400 c-def"><?php echo esc_html( $phone_number_first ); ?></a>
						<p class="h5 c-heading f-400"> lub </p>
						<a href="tel:" class="h3 f-400 c-def"><?php echo esc_html( $phone_number_sec ); ?></a>
					<?php else : ?>
						<a href="tel:<?php echo esc_html( $phone_number_first ); ?>" class="h3 f-400 c-def"><?php echo esc_html( $phone_number_first ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php if ( $map ) : ?>
			<div class="contact__map w-100">
				<iframe class="w-100 lazyload lazy-load-map" id="mymap" src=<?php echo esc_url( $gf_map ); ?> width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		<?php endif; ?>
		<div class="contact__b">
			<div class="contact__b--col d-flex f-c">
				<p class="h6">Adres</p>
				<?php if ( $gf_company_address_first && $gf_company_address_second ) : ?>
					<p class="c-heading"><?php echo esc_html( $gf_company_address_first ); ?><br><?php echo esc_html( $gf_company_address_second ); ?></p>
				<?php endif; ?>
			</div>
			<div class="contact__b--col d-flex f-c">
				<p class="h6">Godziny otwarcia</p>
				<?php if ( $gf_company_hours ) : ?>
					<p class="c-heading">Od poniedziałku do piątku <br> w godzinach od <span class="f-500"><?php echo esc_html( $starting_hour ); ?></span> do <span class="f-500"><?php echo esc_html( $ending_hour ); ?></span></p>
				<?php endif; ?>
			</div>
			<div class="contact__b--col d-flex f-c">
				<p class="h6">Napisz do nas</p>
				<?php if ( $gf_company_email ) : ?>
					<a href="mailto:<?php echo esc_html( $gf_company_email ); ?>" class="c-heading"><?php echo esc_html( $gf_company_email ); ?></a>
					<a class="btn__p c-white m-0 f-alt f-400">Skorzystaj z formularza
						<svg class="icon" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#right-arrow"></use>
						</svg>
					</a>
				<?php endif; ?>
			</div>
			<div class="contact__b--col d-flex f-c">
				<p class="h6">Obserwuj nasze social media</p>
				<?php if ( $social_media_links ) : ?>
					<div class="contact__b--col--sm d-flex f-c" style="gap:10px">
						<?php if ( ! empty( $social_media_links['facebook'] ) ) : ?>
							<a href="<?php echo $social_media_links['facebook']; ?>" class="btn__e c-heading m-0 f-alt f-400"> 
								<svg class="icon" width="24" height="24" viewBox="0 0 24 24">
									<use xlink:href="#facebook"></use>
								</svg>
								Facebook
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $social_media_links['instagram'] ) ) : ?>
							<a href="<?php echo $social_media_links['instagram']; ?>" class="btn__e c-heading m-0 f-alt f-400"> 
								<svg class="icon" width="25" height="24" viewBox="0 0 25 24">
									<use xlink:href="#instagram"></use>
								</svg>							
								Instagram
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $social_media_links['tiktok'] ) ) : ?>
							<a href="<?php echo $social_media_links['tiktok']; ?>" class="btn__e c-heading m-0 f-alt f-400"> 
								<svg class="icon" width="22" height="24" viewBox="0 0 22 24">
									<use xlink:href="#tiktok"></use>
								</svg>
								Tiktok
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="contact__dec pos-abs"></div>
</section>
<script type="text/javascript" async>


</script>
