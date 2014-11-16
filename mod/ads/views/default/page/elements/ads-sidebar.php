<?php
/* 
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 */

$adssidebar  = elgg_get_plugin_setting('ads_sidebar',  'Ads');
$view = elgg_get_plugin_setting('view_ads_sidebar', 'Ads');
$title = elgg_echo('Ads:sponsor');

$body = '<div id="ads-sidebar">'.$adssidebar.'</div>';

echo elgg_view_module($view, $title, $body);
