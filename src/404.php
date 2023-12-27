<?php
/**
 * Get header.
 *
 * @package rekurencja
 */

get_header();

$frontpage_id = get_option( 'page_on_front' );
if ( $frontpage_id ) {
	$frontpage_fields  = get_fields( $frontpage_id );
	$realisations_data = GetDataByAcfFcLayoutName( $frontpage_fields, 'flexible-landing', 'realisations' );
	$cta_data          = GetDataByAcfFcLayoutName( $frontpage_fields, 'flexible-landing', 'cta' );
}
?>

<div id="glowna-tresc" class="wrapper wrapper--nf c d-grid">
	<div class="wrapper__c d-grid ais jcs">
		<h1 class="m-0 h1 c-heading">Błąd 404</h1>
		<div class="feat f-alt f-300 l-5 pos-rel">Strona której szukasz nie istnieje.</div>

		<a class="btn btn--def f-alt f-600 t-lo d-inline-flex aic c-def" href="/" title="Przejdź do formularza wyceny" rel="noreferrer noopener">
			<span class="btn__label">Powrót na stronę główną</span>
		</a>
	</div>
</div>

<?php
if ( $frontpage_id && $realisations_data && ! empty( $realisations_data ) ) {
	get_template_part( 'template-parts/landing/realisations', args: $realisations_data );
}

if ( $frontpage_id && $cta_data && ! empty( $cta_data ) ) {
	get_template_part( 'template-parts/landing/cta', args: $cta_data );
}

get_footer();
