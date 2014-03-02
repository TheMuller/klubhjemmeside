<?php
/**
 * Infinite scroll plugin settings
 */

$logged_in_user = elgg_get_logged_in_user_guid();

// set default value
if (!($pagination_type = elgg_get_plugin_user_setting('pagination_type', $logged_in_user, 'infinite_scroll'))) {
	$pagination_type = 'button';
}

echo '<div>';
echo elgg_echo('infinite_scroll:settings:pagination_type');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[pagination_type]',
	'options_values' => array(
		'classic' => elgg_echo('infinite_scroll:settings:pagination:classic'),
		'button' => elgg_echo('infinite_scroll:settings:pagination:button'),
		'automatic' => elgg_echo('infinite_scroll:settings:pagination:automatic')
	),
	'value' => $pagination_type,
));
echo '</div>';
