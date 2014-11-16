<?php
/**
 * Social login languages
 *
 * @package ElggPages
 */
$site = elgg_get_site_entity();

$english = array(

        'option:yes' => 'Yes',
        'option:no' => 'No',
	'social:login' => "Or you can use:",
	'social:login:notify' => "Do you want to put a notification on LinkedIn and Facebook when a new user registers ?",
	'social:register:title' => "Register now!",
	'social:register:description' => "Increase your business network",
	'social:register:joined' => "I just joined <a href='$site->url'>$site->name</a>",

);

add_translation("en", $english);
