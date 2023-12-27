<?php
$heading_value = get_sub_field( 'heading' );
$menu_name     = get_sub_field( 'menu' );
$button_data   = get_sub_field( 'button' );

$google_partner_url = get_field( 'gf_google_partner', 'options' );

$social_media_options = get_field( 'gf_social_media', 'options' );
$has_social_media     = count( array_filter( $social_media_options ) ) > 0;

$args = [
	'post_type'      => 'hero',
	'posts_per_page' => -1,
];

$query = new WP_Query( $args );
?>
<?php
echo splide_script_async();
?>

<div class="h c small d-grid">
	<div class="breakout pos-rel">
		<?php
		if ( $query->have_posts() ) :
			?>
			<div class="splide c--full">
				<div class="splide__track">
					<div class="splide__progress">
						<div class="splide__progress__bar"></div>
					</div>
					<div class="splide__custom-navigation">
						<button class="splide__custom-prev m-0 p-0">Poprzedni</button>
						<button class="splide__custom-next m-0 p-0">Następny</button>
					</div>
					<ul class="splide__list">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							$tiny_heading = get_field( 'hero_tiny_heading' );
							$heading      = get_field( 'hero_heading' );
							$thumbnail    = get_the_post_thumbnail_url();
							$img          = new MiLossy( $thumbnail, 'wp-block-cover__image-background wp-image-70574 lazyload' );
							?>
							<li class="splide__slide">
								<div class="wp-block-cover has-background-dim-100 has-background-dim has-background-gradient"><span aria-hidden="true" class="wp-block-cover__gradient-background has-theme-slide-overlay-gradient-background"></span>
									<?php $img->Draw(); ?>
									<div class="wp-block-cover__inner-container breakout-dynamic d-grid">
										<div class="wp-block-columns ba-banner-columns">
											<div class="wp-block-column ba-banner-column-50">
												<div class="wp-block-column-heading">
													<p class="tiny-heading">
														<?php echo esc_html( $tiny_heading ); ?>
													</p>
													<h1 class="h1 f-500 has-x-large-font-size">
														<?php echo esc_html( $heading ); ?>
													</h1>
												</div>
												<div class="button">
													<a class="btn__p c-white m-0 f-alt f-400">Dowiedz się więcej<svg class="s__btn__ico" width="16" height="16" viewBox="0 0 16 16">
															<use xlink:href="#right-arrow"></use>
														</svg>
													</a>
												</div>
											</div>
											<div class="wp-block-column"></div>
										</div>
									</div>
								</div>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
			</div>
		<?php else : ?>
			<p>Nie ma zadnych zdjęć do wyświetlenia.</p>
		<?php endif; ?>
		<div class="h__buttons">
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
<script>
	let tweakApplied = false;

	waitForSplide(initBlockCarousel, '.splide');

	function initBlockCarousel() {
		let carouselContainer = document.querySelector('.splide');
		if (carouselContainer === null) {
			console.log('Carousel container missing.');
			return;
		}

		const splideHeadings = document.querySelectorAll('.splide h1, .splide h2, .splide h3');
		let splideHeadingsArr = [];
		if (splideHeadings) {
			splideHeadingsArr = Array.from(splideHeadings);
		}

		splideHeadingsArr.forEach(function(heading) {
			segmentHeading(heading);
		});

		var splide = new Splide('.splide', {
			type: 'fade',
			rewind: true,
			autoplay: true,
			interval: 8000,
			pauseOnHover: false,
			pauseOnFocus: false,
			resetProgress: false,
			arrows: false,
		});

		splide.on('pagination:mounted', function(data) {
			data.list.classList.add('splide__pagination--custom');

			data.items.forEach(function(item, index) {
				let buttonText = item.page + 1;
				let tinyHeadingText = '';

				if (splideHeadingsArr[item.page]) {
					buttonText = splideHeadingsArr[item.page].textContent;
					tinyHeadingText = document.querySelectorAll('.splide__slide')[index].querySelector('.tiny-heading').textContent;
				}

				item.button.innerHTML = '<span class="slide-tiny-heading c-white">' + String(tinyHeadingText) + '</span><br>' +
					'<span class="slide-preview-text">' + String(buttonText) + '</span>';
			});
		});

		splide.on('mounted', function() {
			window.setTimeout(function() {
				carouselContainer.classList.add('init-slide');
			}, 1);
		});

		const prevArrow = document.querySelector('.splide__custom-prev');
		const nextArrow = document.querySelector('.splide__custom-next');
		prevArrow.addEventListener('click', e => {
			splide.go('-1');
		});

		nextArrow.addEventListener('click', e => {
			splide.go('+1');
		});

		splide.mount();
		return splide;
	}

	function segmentHeading(heading) {
		heading.innerHTML = heading.innerHTML.replace(/(^|<\/?[^>]+>|\s+)([^\s<]+)/g, '$1<span><span class="word">$2</span></span>');
	}

	function offsetSlidePosX(slide, index) {
		slide.style.transform = 'translateX(' + (-100 * index) + '%)';
	}

	function showSnackbar(parent, message, carousel) {
		const snackbar = document.createElement('div');
		message = message.replace('toggled', status);

		snackbar.appendChild(document.createTextNode(message));
		snackbar.classList.add('snackbar');
		parent.appendChild(snackbar);

		window.setTimeout(() => snackbar.classList.add('active'), 50);
		window.setTimeout(() => snackbar.classList.add('dismiss'), 1500);
		window.setTimeout(() => snackbar.remove(), 2000);
	}
</script>
