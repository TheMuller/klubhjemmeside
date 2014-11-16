<?php
/* 
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 */

$adssidebaralt  = elgg_get_plugin_setting('ads_sidebar_alt',  'Ads');
$view = elgg_get_plugin_setting('view_ads_sidebar_alt', 'Ads');
$title = elgg_echo('Ads:sponsor');

$body = '<div id="ads-sidebar-alt">'.$adssidebaralt.'</div>';

echo elgg_view_module($view, $title, $body);


