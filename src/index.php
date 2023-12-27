<?php get_header(); ?>

<div id="glowna-tresc" class="wrapper c d-grid">
	<div class="wrapper__c d-grid ais jcs">
		<h1 class="nf__t m-0 h1 c-heading">Nie ustawiono strony głównej</h1>
		<div class="nf__feat feat f-alt f-300 l-5 pos-rel">Skontaktuj się z administratorem.</div>

		<a class="nf__btn btn btn--def f-alt f-600 t-lo d-inline-flex aic c-def" href="mailto:<?php echo get_field( 'gf_company_email', 'options' ); ?>" title="Napisz wiadomość" rel="noreferrer noopener">
			<span class="btn__label">Napisz do nas</span>
		</a>
	</div>
</div>

<?php
get_footer();
