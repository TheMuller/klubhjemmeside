<?php
/*
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 * 
 */

echo '<div class="ads_settings">'.elgg_echo('Ads:information').'</div>';

echo '<h3>'.elgg_echo('Ads:headerads').'</h3>';
echo '<div class="ads_settings">'.elgg_echo('Ads:header').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_header]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_header,
        ));
echo '<br />'.elgg_echo('Ads:header:view').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[view_ads_header]',
	'options_values' => array(
		'featured' => elgg_echo('Ads:featured'),
		'info' => elgg_echo('Ads:info'),
                'popup' => elgg_echo('Ads:popup'),
                'aside' => elgg_echo('Ads:aside')
	),
	'value' => $vars['entity']->view_ads_header,
        ));
echo '<br />'.elgg_echo('Ads:header:ads').'<br />';
echo elgg_view('input/plaintext', array(
        'name' => 'params[ads_header]',
        'value' => $vars['entity']->ads_header
        ));
echo '</div>';

echo '<h3>'.elgg_echo('Ads:sidebarads').'</h3>';
echo '<div class="ads_settings">'.elgg_echo('Ads:sidebar').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_sidebar]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_sidebar,
        ));
echo '<br />'.elgg_echo('Ads:sidebar:view').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[view_ads_sidebar]',
	'options_values' => array(
		'featured' => elgg_echo('Ads:featured'),
		'info' => elgg_echo('Ads:info'),
                'popup' => elgg_echo('Ads:popup'),
                'aside' => elgg_echo('Ads:aside')
	),
	'value' => $vars['entity']->view_ads_sidebar,
        ));
echo '<br />'.elgg_echo('Ads:sidebar:ads').'<br />';
echo elgg_view('input/plaintext', array(
        'name' => 'params[ads_sidebar]',
        'value' => $vars['entity']->ads_sidebar,
        ));
echo '</div>';

echo '<h3>'.elgg_echo('Ads:footerads').'</h3>';
echo '<div class="ads_settings">'.elgg_echo('Ads:footer').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_footer]]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_footer,
));
/*
echo '<br />'.elgg_echo('Ads:footer:view').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[view_ads_footer]',
	'options_values' => array(
		'featured' => elgg_echo('Ads:featured'),
		'info' => elgg_echo('Ads:info'),
                'popup' => elgg_echo('Ads:popup'),
                'aside' => elgg_echo('Ads:aside')
	),
	'value' => $vars['entity']->view_ads_footer,
        ));
 */
echo '<br />'.elgg_echo('Ads:footer:ads').'<br />';
echo elgg_view('input/plaintext', array(
        'name' => 'params[ads_footer]',
        'value' => $vars['entity']->ads_footer,
        ));
echo '</div>';


echo '<h3>'.elgg_echo('Ads:widgetads').'</h3>';
echo '<div class="ads_settings">'.elgg_echo('Ads:widget').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_widget]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_widget,
        ));

echo '<br />'.elgg_echo('Ads:widget:ads').'<br />';
echo elgg_view('input/plaintext', array(
        'name' => 'params[ads_widget]',
        'value' => $vars['entity']->ads_widget,
        ));
echo '</div>';

if (elgg_is_active_plugin('river_activity_3C')){

if (((elgg_get_plugin_setting('view_site', 'river_activity_3C') == "3C") or (elgg_get_plugin_setting('view_river', 'river_activity_3C') == "3C"))){
echo '<h3>'.elgg_echo('Ads:sidebaraltads').'</h3>';
echo '<div class="ads_settings">'.elgg_echo('Ads:sidebar_alt').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_sidebar_alt]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_sidebar_alt,
        ));
echo '<br />'.elgg_echo('Ads:sidebar_alt:view').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[view_ads_sidebar_alt]',
	'options_values' => array(
		'featured' => elgg_echo('Ads:featured'),
		'info' => elgg_echo('Ads:info'),
                'popup' => elgg_echo('Ads:popup'),
                'aside' => elgg_echo('Ads:aside')
	),
	'value' => $vars['entity']->view_ads_sidebar_alt,
        ));
echo '<br />'.elgg_echo('Ads:sidebar_alt:ads').'<br />';
echo elgg_view('input/plaintext', array(
        'name' => 'params[ads_sidebar_alt]',
        'value' => $vars['entity']->ads_sidebar_alt,
        ));
echo '</div>';
}

echo '<h3>'.elgg_echo('Ads:riverads').'</h3>';
echo '<div class="ads_settings">'.elgg_echo('Ads:river').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_river]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_river,
        ));
echo '<br />'.elgg_echo('Ads:river:header').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_river_header]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_river_header,
        ));
echo '<br />'.elgg_echo('Ads:river:sidebar').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_river_sidebar]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_river_sidebar,
        ));
echo '<br />'.elgg_echo('Ads:river:sidebar_alt').'  :  ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[showads_river_sidebar_alt]',
	'options_values' => array(
		'no' => elgg_echo('Ads:no'),
		'yes' => elgg_echo('Ads:yes')
	),
	'value' => $vars['entity']->showads_river_sidebar_alt,
        ));
}
echo "</div>";

echo '<div class="ads_settings">'.elgg_echo('Ads:controls').'</div>';

echo '<div class="ads_settings">'.elgg_echo('Ads:support').'</div>';
