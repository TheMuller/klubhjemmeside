<?php
/*
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 */

$adsheader  = elgg_get_plugin_setting('ads_header',  'Ads');
$view = elgg_get_plugin_setting('view_ads_header', 'Ads');
$title = elgg_echo('Ads:sponsor');

$body = '<div id="ads-header">'.$adsheader.'</div>';

echo elgg_view_module($view, $title, $body);
