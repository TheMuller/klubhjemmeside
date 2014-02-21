<?php
elgg_load_css('worldweatheronline_css');

$apiKey = elgg_get_plugin_setting("apiKey", "worldweatheronline");
$location = $vars['entity']->location;
$temperatureFormat = $vars['entity']->temperatureFormat;
$numberOfDays = $vars['entity']->numberOfDays;

echo '<b>' . $location.'</b><br/>';
try 
{
	$proxy = new WorldWeatherOnlineProxy($apiKey);
	echo '<div class="weatherContainer">';
	foreach ($proxy->getItems($location, $numberOfDays) as $item)
	{
		$item->display($temperatureFormat);
	}
	echo '</div>';
}
catch (Exception $e)
	{
		echo elgg_echo("worldweatheronline:widget:error");
	}