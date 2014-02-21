<?php
$user = elgg_get_logged_in_user_entity();

if (!$user) {
  return;
}

echo '<h1>' . elgg_echo('notifications_email_disable:subject') . '</h1>';
echo elgg_echo('notifications_email_disable:disabled:notice');

echo '<br><br>';
echo elgg_view('output/url', array(
	'href' => elgg_get_site_url() . 'settings/user/' . $user->username,
	'text' => elgg_echo('notifications_email_disable:settingslink')
));

echo '<br><br>';
echo elgg_view('input/submit', array(
	'value' => elgg_echo('notifications_email_disable:acknowledge'),
	'class' => 'notifications-email-disable'
));