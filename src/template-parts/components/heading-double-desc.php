<?php
/**
 * @param string $heading
 * @param string $tiny_title
 * @param string $desc
 */
?>
<div class="hd__dd d-flex aifs f-c afs">
	<div class="hd__dd-t">
		<p class="w-100 h-100"><?php echo $args['tiny_title']; ?></p>
	</div>
	<div class="hd__dd-c d-flex f-c">
		<h4 class="hd__dd-h h4 m-0 l-3 f-400 c-heading"><?php echo $args['heading']; ?></h4>
	</div>
	<?php if ( isset( $args['desc'] ) ) : ?>
		<div class="hd__dd-desc f-alt l-5 f-300"><?php echo $args['desc']; ?></div>
	<?php endif; ?>
</div>
