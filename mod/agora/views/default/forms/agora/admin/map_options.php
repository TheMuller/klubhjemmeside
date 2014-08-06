<?php
/**
 * Elgg Agora Classifieds plugin
 * @package agora
 */

elgg_load_library('elgg:agora');

$plugin = elgg_get_plugin_from_id('agora');

// enable/disable ads geolocation
$ads_geolocation = $plugin->ads_geolocation;
if(empty($ads_geolocation)){
        $ads_geolocation = 'yes';
}    
$potential_ads_geolocation = array(
    "no" => elgg_echo('agora:settings:no'),
    "yes" => elgg_echo('agora:settings:yes'),
); 
$ads_geolocation_output = elgg_view('input/dropdown', array('name' => 'params[ads_geolocation]', 'value' => $ads_geolocation, 'options_values' => $potential_ads_geolocation));
$ads_geolocation_output .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:ads_geolocation:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:ads_geolocation'), $ads_geolocation_output);

// set default icon
$markericon = $plugin->markericon;
if(empty($markericon)){
        $markericon = 'smiley';
}    
$potential_icon = array(
	"ad_image" => elgg_echo('agora:settings:markericon:ad_image'),
    "agora_blue" => elgg_echo('agora:settings:markericon:agora_blue'),
    "agora_royal_blue" => elgg_echo('agora:settings:markericon:agora_royal_blue'),
    "agora_forest_green" => elgg_echo('agora:settings:markericon:agora_forest_green'),
    "agora_grey" => elgg_echo('agora:settings:markericon:agora_grey'),
    "agora_orange" => elgg_echo('agora:settings:markericon:agora_orange'),
    "agora_pink" => elgg_echo('agora:settings:markericon:agora_pink'),
    "agora_purple" => elgg_echo('agora:settings:markericon:agora_purple'),
    "agora_red" => elgg_echo('agora:settings:markericon:agora_red'),
    "agora_violet_red" => elgg_echo('agora:settings:markericon:agora_violet_red'),
    "agora_yellow" => elgg_echo('agora:settings:markericon:agora_yellow'),
); 

$map_icon = elgg_view('input/dropdown', array('name' => 'params[markericon]', 'value' => $markericon, 'options_values' => $potential_icon));
$map_icon .= "<span class='elgg-subtext'>" . elgg_echo('agora:settings:markericon:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('agora:settings:markericon'), $map_icon);

echo elgg_view('input/submit', array('value' => elgg_echo("save")));
