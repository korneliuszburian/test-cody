<?php
$img        = isset( $args['img'] ) ? $args['img'] : '';
$title      = isset( $args['title'] ) ? $args['title'] : '';
$excerpt    = isset( $args['excerpt'] ) ? $args['excerpt'] : '';
$link       = isset( $args['link'] ) ? $args['link'] : '';
$id         = isset( $args['id'] ) ? $args['id'] : '';
$post_date  = isset( $args['post_date'] ) ? $args['post_date'] : '';
$text       = isset( $args['text'] ) ? $args['text'] : '';
$base_class = isset( $args['base_class'] ) ? $args['base_class'] : 'item_tile';

// Define the full class names using the base class
$tile_class     = $base_class . ' d-flex f-c';
$image_class    = $base_class . '__image d-flex';
$box_class      = $base_class . '__box';
$wrapper_class  = $base_class . '__wrapper';
$heading_class  = $base_class . '__box__heading';
$excerpt_class  = $base_class . '__excerpt';
$see_more_class = $base_class . '__see-more';

?>

<?php if ( $link ) : ?>
	<a href="<?php echo esc_url( $link ); ?>" class="<?php echo esc_attr( $tile_class ); ?>" aria-label="<?php echo esc_attr( $title ); ?>" id="<?php echo esc_attr( $id ); ?>">
	<?php else : ?>
		<div class="<?php echo esc_attr( $tile_class ); ?>" id="<?php echo esc_attr( $id ); ?>">
		<?php endif; ?>

		<div class="<?php echo esc_attr( $image_class ); ?>">
			<?php
			$image = new MiLossy( $img );
			$image->Draw();
			?>
		</div>
		<div class="<?php echo esc_attr( $box_class ); ?>">
			<div class="<?php echo esc_attr( $wrapper_class ); ?>">
				<div class="<?php echo esc_attr( $heading_class ); ?>">
					<?php if ( $post_date ) : ?>
						<span class="post_date f-400 l-7"><?php echo esc_html( $post_date ); ?></span>
					<?php endif; ?>
					<h5 class="title f-600 l-2 c-heading" style="text-align:start"><?php echo esc_html( $title ); ?></h5>
				</div>
				<?php if ( $excerpt ) : ?>
					<div class="<?php echo esc_attr( $excerpt_class ); ?>">
						<p class="excerpt f-400 l-7"><?php echo esc_html( $excerpt ); ?></p>
					</div>
				<?php endif; ?>
				<?php if ( $link ) : ?>
					<div class="<?php echo esc_attr( $see_more_class ); ?>">
						<?php
						get_template_part(
							slug: 'template-parts/components/button',
							args: array(
								'url'   => get_permalink( $post->ID ),
								'label' => $text,
								'class' => 'button__small',
								'icon'  => '<svg class="" width="5" height="9" viewBox="0 0 5 9""><use xlink:href="#min-arrow"></use></svg>',
							)
						);
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $link ) : ?>
	</a>
<?php else : ?>
	</div>
<?php endif; ?>
