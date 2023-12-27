<?php
/**
 * Services section with Splide carousel.
 *
 * @package rekurencja
 */

$heading      = get_sub_field( 'heading' ) ? get_sub_field( 'heading' ) : 'Usługi';
$tiny_heading = get_sub_field( 'tiny_heading' ) ? get_sub_field( 'tiny_heading' ) : 'Nasze';
$items        = get_sub_field( 'items' );

if ( empty( $items ) ) {
	if ( UTM_DEBUG ) {
		editor_notice( 'Zmienna <span style="color:red">$items</span> nie powinna być pusta' );
	}
	return;
}

if ( count( $items ) <= 6 ) {
	if ( UTM_DEBUG ) {
		editor_notice( 'Suma elementów zbyt mała. Dodaj przynajmniej sześć.' );
	}
	return;
}

$args = [
	'post_type'      => 'usluga',
	'posts_per_page' => 6,
	'order'          => 'ASC',
];

$query = new WP_Query( $args );

echo splide_script_async();
?>

<section class="s d-grid c">
	<div class="s__h d-flex f-c">
		<p class="c-text"><?php echo esc_html( $tiny_heading ); ?></p>
		<h2 class="h2 f-400 c-heading"><?php echo esc_html( $heading ); ?></h2>
	</div>
	<div class="s__i d-grid">
		<div class="s__splide splide d-grid">
			<div class="splide__track">
				<ul class="splide__list">
					<?php
					$total_items        = count( $items );
					$slots_per_page     = 8;
					$arrow_box_position = 4;
					$total_pages        = ceil( $total_items / ( $slots_per_page - 1 ) );
					$title              = get_the_title();

					$total_slots = $total_pages * $slots_per_page;
					for ( $i = 0; $i < $total_slots; $i++ ) {
						$page_number      = floor( $i / $slots_per_page );
						$position_on_page = $i % $slots_per_page;

						if ( $position_on_page === $arrow_box_position ) {
							?>
							<li class="s_btn--custom splide__slide btn__arr-wr">
								<div class="s_btn-decor"></div>
								<p>Przesuwaj <br> strzałkami</p>
								<div class="s_btn-wr d-flex">
									<button id="btnPrev" class="btn-swipe splide__custom-prev">
										<svg class="s-c__btn__swipe" width="16" height="16" viewBox="0 0 16 16">
											<use xlink:href="#left-arrow"></use>
										</svg>
									</button>
									<button id="btnNext" class="btn-swipe splide__custom-next">
										<svg class="s-c__btn__swipe" width="16" height="16" viewBox="0 0 16 16">
											<use xlink:href="#right-arrow"></use>
										</svg>
									</button>
								</div>
							</li>
							<?php
						} else {
							$content_key = $i - $page_number;

							if ( $content_key < $total_items ) {
								$item = $items[ $content_key ];

								setup_postdata( $item );
								$title = get_the_title( $item->ID );
								?>
								<div class="s-c d-flex f-c jcb afs splide__slide ">
									<div class="s-c__i">
										<svg class="icon" viewBox="0 0 48 48" width="48" height="48" xmlns="http://www.w3.org/2000/svg">
											<use xlink:href="#scalpel"></use>
										</svg>
									</div>
									<div class="s-c__h">
										<div class="s-c__c d-flex f-c">
											<p class="s-c__h f-400 h6 c-heading"><?php echo esc_html( $title ); ?></p>
										</div>
									</div>
									<div class="s-c__text"><?php the_excerpt(); ?></div>
									<div class="s-c__btn d-flex jcc aic">
										<a class="s-c__btn d-flex aic jcs" href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>">
											<p class="s-c__btn__p c-heading m-0 f-alt f-400">Więcej</p>
											<svg class="s-c__btn__ico" width="16" height="16" viewBox="0 0 16 16">
												<use xlink:href="#right-arrow"></use>
											</svg>
										</a>
									</div>
								</div>
								<?php
							} else {
								?>
								<li class="splide__slide splide__slide--empty"></li>
								<?php
							}
						}
					}
					wp_reset_postdata();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="s__btn d-flex jcc m-auto">
		<a class="btn__p c-white m-0 f-alt f-400">Zobacz wszystkie usługi <svg class="s__btn__ico" width="16" height="16" viewBox="0 0 16 16">
			<use xlink:href="#right-arrow"></use>
		</svg></a>
	</div>
</section>
<script>
	waitForSplide(() => {
		let splide = new Splide('.s__splide', {
			pagination: false,
			arrows: false,
			gap: '24px',
			grid: {
				dimensions: [
					[2, 4]
				],
				rows: 2,
				cols: 4,
				gap: {
					row: '24px',
					col: '24px'
				},
			},
			breakpoints: {
				'768': {
					grid: {
						dimensions: [
							[3, 2]
						],
						rows: 3,
						cols: 2,
					}
				},
			},
		
		}).mount(window.splide.Extensions);
		
		document.getElementById('btnPrev').addEventListener('click', function () {
			splide.go('-1');
		});

		document.getElementById('btnNext').addEventListener('click', function () {
			splide.go('+1');
		});

	}, '.s__splide');
</script>
