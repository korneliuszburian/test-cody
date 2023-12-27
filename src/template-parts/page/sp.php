<?php
/**
 * Main page flexible part for displaying specialists section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

$args = [
	'post_type'      => 'specjalisci',
	'posts_per_page' => 6,
	'order'          => 'ASC',
];

$query   = new WP_Query( $args );
$heading = get_sub_field( 'heading' );
$sdh     = get_sub_field( 'small-desc-heading' );

?>

<?php echo esc_html( splide_script_async() ); ?>

<section class="sp c d-grid">
	<div class="sp__wr d-flex f-c">
		<div class="tile_box">
			<?php
			if ( $query->have_posts() ) :
				?>
				<div class="splide sp__splide" role="region" aria-label="Slider z członkami zespołu">
					<div class="splide__track">
						<div class="splide__list">
							<div class="splide__slide sp__h d-flex" id="splide03-slide01-col01">
								<?php get_component( 'small-desc-heading', args: $sdh ); ?>
							</div>
							<?php
							while ( $query->have_posts() ) :
								$query->the_post();
								$proffesion = get_field( 'proffesion' );
								$major      = get_field( 'major' );
								$name       = get_field( 'name' );
								?>
								<div class="splide__slide sp__i d-flex">
									<div class="sp__i-img">
										<?php
										$image = new MiLossy( get_field( 'avatar' ), 'h-100' );
										$image->Draw();
										?>
									</div>
									<div class="sp__i-desc">
										<div class="sp__i-desc-t d-grid">
											<p class="f-400 c-altHeading">
												<?php echo esc_html( $proffesion ); ?>
											</p>
											<p class="h6 f-400 c-heading">
												<?php echo esc_html( $name ); ?>
											</p>
										</div>
										<div class="sp__i-desc-b d-grid">
											<p class="f-400 c-altHeading">
												<?php echo esc_html( $major ); ?>
											</p>
											<a href="<?php the_permalink(); ?>" class="btn__min c-black m-0 f-alt f-400 d-flex aic" style="gap:12px;">
												Przejdź dalej
												<svg class="s__btn__ico" width="16" height="16" viewBox="0 0 16 16">
													<use xlink:href="#right-arrow" style="color:var(--defColor);"></use>
												</svg>
											</a>
										</div>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="sp__btn d-flex jcb">
			<div class="btn__arr d-inline-flex aic">
				<p>Przesuwaj <br> strzałkami</p>
				<div class="btn__arr-wr d-flex">
					<button id="btnPrev" class="splide_prev btn-swipe">
						<svg class="btn__arr-l" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#left-arrow"></use>
						</svg>
					</button>
					<button id="btnNext" class="splide_next btn-swipe">
						<svg class="btn__arr-r" width="16" height="16" viewBox="0 0 16 16">
							<use xlink:href="#right-arrow"></use>
						</svg>
					</button>
				</div>
			</div>
			<a class="btn__e d-flex aic jcs c-black" href="<?php echo esc_url( get_post_type_archive_link( 'specjalisci' ) ); ?>">
				Poznaj wszystkich specjalistów
				<svg class="icon" width="16" height="16" viewBox="0 0 16 16">
					<use xlink:href="#right-arrow"></use>
				</svg>
			</a>
		</div>

</section>
<script>
	function waitForElement(selector, callback) {
		var element = document.querySelector(selector);
		if (element) {
			callback(element);
		} else {
			setTimeout(function() {
				waitForElement(selector, callback);
			}, 100); // check every 100ms
		}
	}

	document.addEventListener("DOMContentLoaded", function() {
		var hdSmElement = document.querySelector('.sp__h .hd__sm'); // Replace with the correct selector for your hd_sm element
		var splideList = document.querySelector('.sp .splide__list'); // Your Y
		var hdElWrapper = document.querySelector('.sp__h'); // Your WRAPPER
		var wrapper = document.querySelector('.sp__wr'); // Your WRAPPER
		var firstColumn = document.querySelector(".sp__i"); // Your first column
		var testTest = document.querySelector(".splide__slide__row");
		var element = document.querySelector('#splide03-slide01.splide__slide.is-active.is-visible');
		var slide = document.querySelector('#splide03-slide01');
		var firstHdElWrapperElement = document.querySelector('.sp__h').firstElementChild;
		var originalParent = hdSmElement.parentElement;
		console.log(firstHdElWrapperElement);
		console.log(hdSmElement);
		console.log(wrapper);

		function moveHdSmElement() {
			console.log("Checking elements...");
			if (!hdSmElement) {
				console.error('hdSmElement not found');
				return;
			}
			if (!splideList) {
				console.error('splideList not found');
				return;
			}
			if (!wrapper) {
				console.error('wrapper not found');
				return;
			}

			if (window.innerWidth < 1200) {
				wrapper.appendChild(hdSmElement);
				splideList.append(hdElWrapper);
			} else if (window.innerWidth >= 1200) {
				originalParent.appendChild(hdSmElement);
			}

		}

		waitForElement('.sp__h .hd__sm .splide__slide__row .sp__wr', function(){
			console.log("Found element");
			moveHdSmElement();
		});
		
		window.addEventListener('resize', moveHdSmElement);
	});

	waitForSplide(() => {
		let splide = new Splide('.sp__splide', {
			classes: {
				pagination: 'splide__pagination pagination',
			},
			arrows: false,
			slideSize: '490px',
			grid: {
				rows: 2,
				cols: 2,
			},
			breakpoints: {
				1200: {
					grid: {
						rows: 1,
						cols: 1,
					},
					perPage: 2,
					perSlide: 2,
				},
			}
		}).mount(window.splide.Extensions);
	}, '.sp__splide');
</script>
