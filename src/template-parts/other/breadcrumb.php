<?php $white = isset( $args['white'] ) ? $args['white'] : false; ?>
<div class="bc<?php echo $white ? ' bc--white' : ''; ?>">
	<div class="bc__row d-flex aic">
		<div class="bc__el d-flex aic">
			<?php echo do_shortcode( '[wpseo_breadcrumb]' ); ?>
		</div>
	</div>
</div>