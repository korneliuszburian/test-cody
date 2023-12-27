<?php if ( ! isset( $args['heading'] ) ) {
	return;} ?>

<div class="hb hb--<?php echo $args['bg_theme']; ?> c--full c d-grid" <?php echo $args['bg_theme'] == 'gray' ? ' style="--bg:var(--grayColor)"' : null; ?>>
	<div class="hb__c d-flex f-c aic jcs">
		<div class="hb__wr d-flex aic">
		<svg class="hb__dec w-a h-a d-none" viewBox="0 0 112 64" width="112" height="64" xmlns="http://www.w3.org/2000/svg">
			<use xlink:href="#decoration_small"></use>
		</svg>
		<h2 class="h2 m-0 l-3 f-400 c-heading"><?php echo $args['heading']; ?></h2>
		</div>
		<div class="hb__feat feat f-alt f-300 l-5 pos-rel"><?php echo $args['label']; ?></div>
	</div>
</div>
