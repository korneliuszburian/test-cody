<?php
$term = get_queried_object();

// TODO: dodać do rekurencja.com
if ( ! $args || empty( $args ) ) {
	if ( UTM_DEBUG ) {
		editor_notice( 'Nie podano argumentu dla flexible <span style="color:red">$args</span>. Użyto domyślnego "page" (flexible-page).' );
	}
}

$templateName = ! empty( $args ) ? $args : 'page';
$flexibleName = 'flexible-' . $templateName;
$flexiblePath = 'template-parts/' . $templateName . '/';

// $flexible = get_field($flexibleName, $term);

// if (!$flexible || empty($flexible)) {
// if (UTM_DEBUG) editor_notice('Nie znaleziono pola, bądź jest puste: <span style="color:red">' . $flexibleName . '</span>');
// return;
// }

if ( have_rows( $flexibleName, $term ) ) : ?>

	<?php
	while ( have_rows( $flexibleName, $term ) ) {
		the_row();
		// $filePath;
		$filePath = $flexiblePath . get_row_layout();

		if ( empty( locate_template( $filePath . '.php' ) ) ) {
			if ( UTM_DEBUG ) {
				editor_notice( 'Brakujący plik: <span style="color:red">"' . $filePath . '.php"</span>' );
			}
		}

		get_template_part( $filePath );
	}
	?>

	<?php
endif;
