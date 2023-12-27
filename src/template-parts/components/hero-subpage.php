<?php
$buttons   = get_field( 'buttons' );
$image     = get_field( 'image' );
$has_image = has_post_thumbnail();

$maybe_heading = get_field( 'heading' );
$heading       = $maybe_heading ? $maybe_heading : get_the_title();
?>

<div class="h h--s h--even <?= $has_image ? 'h--img' : 'h--no-img'; ?> c d-grid" id="glowna-tresc">
	<div class="h__main d-grid grid">

		<div class="h__c d-grid">

			<div class="h__bread f-500 h6 c-green">
				<?= do_shortcode( '[wpseo_breadcrumb]' ); ?>
			</div>

			<h1 class="h__t m-0 h2 f-700"><?= esc_html( $heading ); ?></h1>

			<?php if ( $desc = get_field( 'desc' ) ) : ?>
				<div class="p f-500 c-black-700"><?= esc_html( $desc ); ?></div>
			<?php endif; ?>

			<?php if ( $buttons && ! empty( $buttons ) ) : ?>
				<div class="h__btns d-flex f-c-m">

					<?php foreach ( $buttons as $key => $button_data ) : ?>

						<?php
						$button = Buttonable::FromButton( $button_data['button'] );
						echo "<{$button->tag} class='btn--high btn--full {$button->GetButtonClasses()}' {$button->GetLinkAttributes()}>";
						echo "<span class='btn__label'>{$button->label}</span>";
						echo "<svg class='btn__ico w-a' width='16' height='16' viewBox='0 0 16 16'>";
						echo "<use xlink:href='#arrow-right'></use>";
						echo '</svg>';
						echo "</{$button->tag}>";
						?>

					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $has_image && $image = get_the_post_thumbnail_url() ) : ?>
			<div class="h__img--wr w-100">
				<?php
				$img = new MiLossy( $image, 'h__img' );
				$img->Draw();
				?>
			</div>

			<!-- decoration-hero.svg -->
		<?php endif; ?>
	</div>

</div>
