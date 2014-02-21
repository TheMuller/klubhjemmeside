<?php
/**
 * An english language definition file
 */

$danish = array(
	'facebook_connect' => 'Facebook Services',

	'facebook_connect:requires_oauth' => 'Facebook Services requires the OAuth Libraries plugin to be enabled.',

	'facebook_connect:consumer_key' => 'Application Key',
	'facebook_connect:consumer_secret' => 'Application Secret',

	'facebook_connect:settings:instructions' => 'You must obtain a client id and secret from <a href="http://www.facebook.com/developers/" target="_blank">Facebook</a>. Most of the fields are self explanatory, the one piece of data you will need is the callback url which takes the form http://[yoursite]/action/facebooklogin/return - [yoursite] is the url of your Elgg network.',

	'facebook_connect:usersettings:description' => "Link din %s konto med din Facebook konto.",
	'facebook_connect:usersettings:request' => "Du skal først <a href=\"%s\">godkende</a> %s adgang til din Facebook konto.",
	'facebook_connect:authorize:error' => 'Det er desværre ikke muligt at godkende Facebook.',
	'facebook_connect:authorize:success' => 'Facebook adgangen er hermed godkendt.',

	'facebook_connect:usersettings:authorized' => "Du har givet %s adgang til din Facebook konto: @%s.",
	'facebook_connect:usersettings:revoke' => 'Klik <a href="%s">her</a> for at fjerne denne adgang.',
	'facebook_connect:revoke:success' => 'Facebook adgang er fjernet.',

	'facebook_connect:login' => 'Tillad eksisterende brugere, som har forbundet deres Facebook konto til at logge ind med Facebook?',
	'facebook_connect:new_users' => 'Giv nye brugere tilladelse til at blive oprettet med deres Facebook konto, også selvom manuel registrering er deaktiveret?',
	'facebook_connect:login:success' => 'Du er nu lukket ind.',
	'facebook_connect:login:error' => 'Du kunne desværre ikke logges ind ved hjælp af Facebook.',
	'facebook_connect:login:email' => "Du skal skriv en gyldig email adresse til din nye %s konto.",
	'facebook_connect:email:subject' => 'Du har hermed oprettet en %s konto',
	'facebook_connect:email:body' => '
Hej %s,

Tillykke! Du er hermed registreret. Besøg venligst %s %s for at logge ind.

Your login details are-

Brugernavn: %s
Email: %s
Adgangskode: %s

Du kan logge ind ved brug af enten din email adresse eller dit brugernavn.

%s
%s'
	
	);

add_translation('da', $danish);
