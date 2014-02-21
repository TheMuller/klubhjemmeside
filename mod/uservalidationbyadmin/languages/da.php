<?php
/**
 * Email user validation plugin language pack.
 *
 * @package Elgg.Core.Plugin
 * @subpackage Elgguservalidationbyadmin
 */

$danish = array(
	'admin:users:unvalidated' => 'Ikke godkendte',
	
	'email:validate:subject' => "%s anmoder godkendelse af konto til %s!",
	'email:validate:body' => "Hej %s,

Et medlem med navnet %s anmoder om godkendelse af en medlemskonto.

Geolokation detaljer af bruger er
IP adresse: %s
Sandsynlig lokation: %s

Du kan godkende medlemmet ved at klikke på følgende link:

%s

Hvis du ikke kan klikke på linket, så kan du kopiere det og sætte det i din browser.

%s
%s
",

	'user:validate:subject' => "Tillykke %s! din konto er hermed aktiveret",
	'user:validate:body' => "Hej %s,

Denne mail sendes til dig for at fortælle dig, at din konto på %s er godkendt af administratoren.

Du kan nu logge ind på siden med:

Brugernavn : %s
Password : den du har opgivet ved din registrering

%s
%s
",

	'email:confirm:success' => "Medlemmet er nu godkendt",
	'email:confirm:fail' => "Medlemmetskontoen kunne ikke aktiveres...",

	'uservalidationbyadmin:registerok' => "Du modtager en godkendelsesmail fra administratoren, så snart du er godkendt.",
	'uservalidationbyadmin:login:fail' => "Din medlemskonto er ikke gyldig, så oprettelsen fejlede. Du skal vente på at administratoren godkender din konto.",

	'uservalidationbyadmin:admin:no_unvalidated_users' => 'Ingen medlemmer der skal godkendes.',

	'uservalidationbyadmin:admin:unvalidated' => 'Ikke godkendte',
	'uservalidationbyadmin:admin:user_created' => 'Registeret %s',
	'uservalidationbyadmin:admin:resend_validation' => 'Gensend anmodning',
	'uservalidationbyadmin:admin:validate' => 'Godkend',
	'uservalidationbyadmin:admin:delete' => 'Slet',
	'uservalidationbyadmin:confirm_validate_user' => 'Godkend %s?',
	'uservalidationbyadmin:confirm_resend_validation' => 'Gensend anmodnings email til %s?',
	'uservalidationbyadmin:confirm_delete' => 'Slet %s?',
	'uservalidationbyadmin:confirm_validate_checked' => 'Godkend du markede medlemmer?',
	'uservalidationbyadmin:confirm_resend_validation_checked' => 'Gensend anmodningen til markede medlemmer?',
	'uservalidationbyadmin:confirm_delete_checked' => 'slet markede medlemmer?',
	'uservalidationbyadmin:check_all' => 'Alle',

	'uservalidationbyadmin:errors:unknown_users' => 'Ukendte medlemmer',
	'uservalidationbyadmin:errors:could_not_validate_user' => 'Kunne ikke godkende medlem.',
	'uservalidationbyadmin:errors:could_not_validate_users' => 'Kunne ikke godkende alle markede medlemmer.',
	'uservalidationbyadmin:errors:could_not_delete_user' => 'Kunne ikke slette medlem.',
	'uservalidationbyadmin:errors:could_not_delete_users' => 'Kunne ikke slette alle markede medlemmer.',
	'uservalidationbyadmin:errors:could_not_resend_validation' => 'Kunne ikke gensende anmodningen.',
	'uservalidationbyadmin:errors:could_not_resend_validations' => 'Kunne ikke gensende anmodningen til alle markede medlemmer.',

	'uservalidationbyadmin:messages:validated_user' => 'Medlem godkendt.',
	'uservalidationbyadmin:messages:validated_users' => 'Alle markede medlemmer godkendt.',
	'uservalidationbyadmin:messages:deleted_user' => 'Medlem slettet.',
	'uservalidationbyadmin:messages:deleted_users' => 'Alle markede medlemmer slettet.',
	'uservalidationbyadmin:messages:resent_validation' => 'Anmodning gensendt.',
	'uservalidationbyadmin:messages:resent_validations' => 'Anmodning gensendt til alle markede medlemmer.'

);

add_translation("da", $danish);