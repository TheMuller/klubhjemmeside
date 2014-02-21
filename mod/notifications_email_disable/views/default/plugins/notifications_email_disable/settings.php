<?php

// options for notifying the user

// system message
echo elgg_view('input/dropdown', array(
	'name' => 'params[system_message]',
	'value' => $vars['entity']->system_message ? $vars['entity']->system_message : 'yes',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no')
	)
));

echo ' ' . elgg_echo('notifications_email_disable:setting:system_message') . '<br><br>';


// site notification
if (elgg_is_active_plugin('messages')) {
  echo elgg_view('input/dropdown', array(
	'name' => 'params[site_notification]',
	'value' => $vars['entity']->site_notification ? $vars['entity']->site_notification : 'yes',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no')
	)
  ));


  echo ' ' . elgg_echo('notifications_email_disable:setting:site_notification') . '<br><br>';
}


// lightbox
echo elgg_view('input/dropdown', array(
	'name' => 'params[lightbox]',
	'value' => $vars['entity']->lightbox ? $vars['entity']->lightbox : 'no',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no')
	)
));

echo ' ' . elgg_echo('notifications_email_disable:setting:lightbox') . '<br><br>';