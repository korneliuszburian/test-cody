<?php
if ( empty( $args ) ) {
	if ( UTM_DEBUG ) {
		editor_notice( 'Pusta zawartość zmiennej, przekazanych do komponentu <span style="color:red">$args</span>', true );
	}
	return;
}
?>

<div class="gm d-grid grid">
	<div class="gm__wr d-flex f-c aic jcc">
		<img loading="lazy" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/img/g-maps.svg" alt="Logo Google Maps">

		<div class="gm__feat feat f-alt f-300 l-5 pos-rel"><?php echo $args['desc']; ?></div>

		<?php
		$button = Buttonable::FromButton( $args['button'] );
		echo "<{$button->tag} class='btn--big {$button->GetButtonClasses()}' {$button->GetLinkAttributes()}><span class='btn__label'>{$button->label}</span></{$button->tag}>";
		?>
	</div>
</div>
