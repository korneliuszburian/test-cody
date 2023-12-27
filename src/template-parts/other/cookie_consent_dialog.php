<dialog tabindex="-1" id="ccd" style="z-index:99999999" class="ccd d-flex jcc aic w-100 h-100">
	<div class="ccd__wr d-grid">
		<div class="ccd__h feat f-alt f-600">Wybierz ustawienia cookies</div>
		<div class="ccd__desc l-5 f-alt">Za pomocą ciasteczek oraz powiązanych z nimi technologii oraz poprzez analizę Twoich danych, jesteśmy w stanie dostosować prezentowane Ci materiały. Dowiedz się więcej: <a class="ccd__privacy-link" href="/polityka-prywatnosci/">polityka prywatności</a></div>

		<div id="cookie-law-settings" class="ccd__set d-none ais jce f-c">
			<label class="cct cct--dis d-flex aic jcs" for="necessary">
				<input class="cct__in d-none" type="checkbox" id="necessary" checked disabled>
				<span class="cct__wr cct__wr--dis pos-rel d-inline-flex aic">
					<span class="cct__sl pos-abs"></span>
				</span>
				Niezbędne (zawsze aktywne)
			</label>

			<label class="cct d-flex aic jcs" for="marketing" tabindex="0">
				<input class="cct__in d-none" type="checkbox" id="marketing" checked>
				<span class="cct__wr pos-rel d-inline-flex aic">
					<span class="cct__sl pos-abs"></span>
				</span>
				Marketingowe
			</label>
			<button id="save-settings" class="ccd__btn ccd__btn--save t-lo btn btn--def d-inline-flex f-alt c-white f-600 ccd--e">Zapisz</button>
		</div>

		<div class="ccd__actions d-flex ais jce f-w">
			<button id="settings-button" name="adjust" class="ccd__link t-lo" aria-label="Dostosuj">Dostosuj</button>
			<button id="decline-all" name="decline" class="ccd__link t-lo" aria-label="Nie zgadzam się">Nie zgadzam się</button>
			<button id="accept-all" name="accept" class="ccd__btn btn btn--def d-inline-flex t-lo f-alt c-white f-600 ccd--e" aria-label="Akceptuję ciasteczka">Akceptuję ciasteczka</button>
		</div>
	</div>
</dialog>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/cookieConsentBar.min.js"></script>