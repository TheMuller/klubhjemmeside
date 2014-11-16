<?php
/**
 * Social login languages
 *
 * @package ElggPages
 */
$site = elgg_get_site_entity();

$danish = array(

        'option:yes' => 'Ja',
        'option:no' => 'Nej',
	'social:login' => "Eller registrer med:",
	'social:login:notify' => "Vil du indsætte en notifikation på LinkedIn og Facebook, når en bruger registrerer sig?",
	'social:register:title' => "Register nu",
	'social:register:description' => "Vær med på Sportens Trends. Find nye produkter, og sælg dette ikke længere bruger..",
	'social:register:joined' => "Jeg har nu tilmeldt mig <a href='$site->url'>$site->name</a>",

);

add_translation("da", $danish);
