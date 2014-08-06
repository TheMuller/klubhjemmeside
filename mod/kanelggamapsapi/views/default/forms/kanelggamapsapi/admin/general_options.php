<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

$plugin = elgg_get_plugin_from_id('kanelggamapsapi');

// Google API
$google = elgg_view('input/text', array('name' => 'params[google_api_key]', 'value' => $plugin->google_api_key));
$google .= "<div class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:google_api_key:clickhere') . "</div>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:google_api_key'), $google);   

// set default location
$defaultlocation = $plugin->map_default_location;
if(empty($defaultlocation)){
	$defaultlocation = CUSTOM_DEFAULT_LOCATION;
}

$defaultlocation = elgg_view('input/text', array('name' => 'params[map_default_location]', 'value' => $defaultlocation));
$defaultlocation .= "<div class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:defaultlocation:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:defaultlocation'), $defaultlocation);

// Default map zoom
$defaultzoomc = (int) $plugin->map_default_zoom;
if($defaultzoomc == ""){
	$defaultzoomc = CUSTOM_DEFAULT_ZOOM;
}

$defaultzoom = elgg_view('input/dropdown', array('name' => 'params[map_default_zoom]', 'value' => $defaultzoomc, 'options' => range(0, 19)));
$defaultzoom .= "<div class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:defaultzoom:note') . "</div>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:defaultzoom'), $defaultzoom);  

// Map width
$map_width = elgg_view('input/text', array('name' => 'params[map_width]', 'value' => $plugin->map_width));
$map_width .= "<div class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:map_width:how') . "</div>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:map_width'), $map_width);	

// Map height
$map_height = elgg_view('input/text', array('name' => 'params[map_height]', 'value' => $plugin->map_height));
$map_height .= "<div class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:map_height:how') . "</div>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:map_height'), $map_height);	 

// set if use map cluster or no
$cluster = $plugin->cluster;
if(empty($cluster)){
        $cluster = 'yes';
}    
$potential_cluster = array(
    "no" => elgg_echo('kanelggamapsapi:settings:no'),
    "yes" => elgg_echo('kanelggamapsapi:settings:yes'),
); 

$clusterfield = elgg_view('input/dropdown', array('name' => 'params[cluster]', 'value' => $cluster, 'options_values' => $potential_cluster));
$clusterfield .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:cluster:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:cluster'), $clusterfield);

// set unit of measurement for distance searching
$unitmeas = $plugin->unitmeas;
if(empty($unitmeas)){
        $unitmeas = 'meters';
}    
$potential_unitmeas = array(
    "meters" => elgg_echo('kanelggamapsapi:settings:unitmeas:meters'),
    "km" => elgg_echo('kanelggamapsapi:settings:unitmeas:km'),
    "miles" => elgg_echo('kanelggamapsapi:settings:unitmeas:miles'),
); 

$unit_of_measurement = elgg_view('input/dropdown', array('name' => 'params[unitmeas]', 'value' => $unitmeas, 'options_values' => $potential_unitmeas));
$unit_of_measurement .= "<span class='elgg-subtext'>" . elgg_echo('kanelggamapsapi:settings:unitmeas:note') . "</span>";
echo elgg_view_module("inline", elgg_echo('kanelggamapsapi:settings:unitmeas'), $unit_of_measurement);

echo elgg_view('input/submit', array('value' => elgg_echo("save")));
