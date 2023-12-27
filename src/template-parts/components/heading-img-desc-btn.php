<?php

$img = new MiLossy( $args['img'], 'lazyload' );

?>


<div class="hd__idb">
	<div class="hd__idb-img">
		<?php $img->Draw(); ?>
		<!-- <img class="w-100 h-100" src="<?php echo $args['img']; ?>"> -->
	</div>
	<div class="hd__idb-c d-flex f-c">
		<h4 class="hd__idb-h h6 c-heading m-0 l-3 f-400 c-heading"><?php echo $args['heading']; ?></h4>

		<?php if ( isset( $args['desc'] ) ) : ?>
			<div class="hd__idb-desc f-alt l-5 f-300"><?php echo $args['desc']; ?></div>
		<?php endif; ?>

		<div class="hd__idb-btn d-flex jcc">
			<a class="btn__e c-heading m-0 f-alt f-400"><?php echo $args['btn']; ?><svg class="icon" width="16" height="16" viewBox="0 0 16 16">
					<use xlink:href="#right-arrow"></use>
				</svg>
			</a>
		</div>
	</div>
</div>
