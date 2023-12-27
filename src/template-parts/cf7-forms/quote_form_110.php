<div class="q d-grid grid ais">
   <div class="q__col q__col--1 d-grid">
      <div class="q__h f-alt f-600">Informacje projektowe</div>

      [select* menu-project-type id:form-project-type class:q__se class:w-100 "---" "Strony internetowe" "Software house" "Marketing internetowy" "Inne"]
      [select* menu-budget id:form-budget class:q__se class:w-100 "---" "2 500 - 5 000zł" "5 000 - 10 000zł" "10 000 - 20 000zł" "20 000 - 30 000zł" "Powyżej 30 000zł"]
      [textarea textarea-comments id:form-comments class:q__ta class:w-100 placeholder "Uwagi dodatkowe"]

   </div>

   <div class="q__col q__col--2 d-grid">
      <div class="q__h f-alt f-600">Dane osobowe</div>

      [hidden form-site-url id:site-url]
      [text* input-name minlength:7 maxlength:35 id:form-name class:q__in class:w-100 autocomplete:name placeholder "Imię i nazwisko *"]
      [text* input-nip minlength:10 maxlength:25 id:form-nip class:q__in class:w-100 placeholder "NIP firmy *"]
      [tel* input-phone minlength:9 maxlength:15 id:form-phone class:q__in class:w-100 placeholder "Telefon kontaktowy *"]
      [email* input-email id:form-email class:q__in class:w-100 autocomplete:email placeholder "Adres e-mail *"]

   </div>

   <div class="q__col q__col--3 d-grid">
      [acceptance acceptance-rodo id:form-acceptance-rodo class:q__ch class:pos-rel] <span class="q__acc-l l-5">* Wyrażam zgodę na przetwarzanie przez Rekurencja.com Sp. z o.o. moich danych osobowych zawartych w powyższym formularzu w celach marketingowych.</span> [/acceptance]

      [acceptance acceptance-marketing id:form-acceptance-marketing class:q__ch class:pos-rel] <span class="q__acc-l l-5">* Wyrażam zgodę na prowadzenie przez Rekurencja.com Sp. z o.o. marketingu bezpośredniego, przy użyciu telekomunikacyjnych urządzeń końcowych oraz środkami komunikacji elektronicznej.</span> [/acceptance]

      [submit id:form-submit class:q__btn class:btn class:btn--def class:btn--big class:d-inline-flex class:aic class:c-white class:t-lo class:f-alt class:f-600 "Wyślij zapytanie"]
   </div>

   <script>
      document.getElementById('site-url').value = document.URL;
   </script>
</div>