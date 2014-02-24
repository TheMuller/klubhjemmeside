<?php
/**
 *
 * Gianna background
 *
 */

$plugin = elgg_get_plugin_from_id('gianna');
$selected = $plugin->background;
$selected = explode(",", $selected);

$number = count($selected);

if($number > 1) {
	$rand = array_rand($selected);
	$image = $selected[$rand];
} else {
	$image = $plugin->background;
}

$background = "url(" . elgg_get_site_url() . "mod/gianna/graphics/backgrounds/" . $image . ") no-repeat center center fixed";
$cover = "cover";

echo <<<CSS

html {
	background: $background;
	
	-webkit-background-size: $cover;
	-moz-background-size: $cover;
	-o-background-size: $cover;
	background-size: $cover;
}

CSS;

?>

