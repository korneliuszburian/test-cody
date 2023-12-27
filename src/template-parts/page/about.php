<?php
$sdh         = get_sub_field( 'small-desc-heading' );
$hidb        = get_sub_field( 'heading-img-desc-btn' );
$notes       = get_sub_field( 'notes' );
$box_heading = get_sub_field( 'box' );
$box_desc    = get_sub_field( 'box_desc' );
$img         = get_sub_field( 'img' );
?>

<div id="o-firmie" class="ab c d-grid">
	<?php get_component( 'small-desc-heading', args: $sdh ); ?>
	<?php get_component( 'heading-img-desc-btn', args: $hidb ); ?>
	<?php if ( $notes && count( $notes ) > 1 ) : ?>
		<div class="ab__wr d-grid grid pos-rel" style="--gtc: none;">
			<div class="ab__box d-flex ais jcc">
				<div class="ab__box__c d-flex f-c">
					<h3 class="ab__box__h c-white h4 m-0 l-3 f-400 c-heading"><?php echo $box_heading; ?></h3>
					<p class="ab__box__d f-alt c-white l-5 f-300"><?php echo $box_desc; ?></p>
				</div>
			</div>
			<div class="splide w-100 notes-slider">
				<div class="splide__track">
					<ul class="splide__list grid">
						<?php foreach ( $notes as $key => $note ) : ?>
							<li class="splide__slide">
								<div class="ab__i d-flex ais jcs">
									<div class="ab__c d-grid">
										<div class="s_btn-decor"></div>
										<p class="ab__d m-0 f-alt l-5"><?php echo $note['desc']; ?></p>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<li class="s_btn--custom splide__slide btn__arr-wr splide__arrows">
				<div class="s_btn-decor"></div>
				<p>Przesuwaj <br> strzałkami</p>
				<div class="s_btn-wr d-flex">
					<button id="btnPrev" class="splide__arrows--prev splide_prev">
						<svg class="s-c__btn__swipe" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#left-arrow"></use>
						</svg>
					</button>
					<button id="btnNext" class="splide__arrows--next splide_next">
						<svg class="s-c__btn__swipe" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#right-arrow"></use>
						</svg>
					</button>
				</div>
			</li>
		</div>
	<?php endif; ?>
</div>

<script>
	waitForSplide(() => {
		var splideInstance = new Splide('.notes-slider', {

			type: 'loop',
			perPage: 2,
			focus: 'center',
			autoWidth: true,
			arrows: false,
			pagination: false,
			padding: {
				right: '2rem'
			},
			breakpoints: {
				1081: {
					destroy: true,
				},
				767: {
					perPage: 2,
				}
			},
			mediaQuery: 'min'
		}).mount();
		console.log(splideInstance);

		document.getElementById('btnNext').addEventListener('click', function() {
			splideInstance.go('+1');
		});

		document.getElementById('btnPrev').addEventListener('click', function() {
			splideInstance.go('-1');
		});

	}, '.notes-slider');
</script>
