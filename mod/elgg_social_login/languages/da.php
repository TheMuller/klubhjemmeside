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
	'social:login:notify' => "Vil du inds�tte en notifikation p� LinkedIn og Facebook, n�r en bruger registrerer sig?",
	'social:register:title' => "Register nu",
	'social:register:description' => "V�r med p� Sportens Trends. Find nye produkter, og s�lg dette ikke l�ngere bruger..",
	'social:register:joined' => "Jeg har nu tilmeldt mig <a href='$site->url'>$site->name</a>",

);

add_translation("da", $danish);
