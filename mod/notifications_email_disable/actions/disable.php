<?php

$emails_input = get_input('emails');

if (empty($emails_input)) {
  register_error(elgg_echo('notifications_email_disable:empty'));
  forward();
}

$emails = explode("\n", $emails_input);

$invalid_emails = array();
foreach ($emails as $email) {
  $user = get_user_by_email(trim($email));
  $user = $user[0];
  
  if (!elgg_instanceof($user, 'user')) {
	$invalid_emails[] = trim($email);
	continue;
  }
  
  $user->notifications_email_disabled = 1;
  $attribute = 'notification:method:email';
  $user->$attribute = 0; // turns off site notifications
  
  // comment tracker notifications
  add_entity_relationship($user->guid, 'block_comment_notifyemail', elgg_get_config('site_guid'));
  
  // individual notifications
  remove_entity_relationships($user->guid, 'notifyemail');
  
  // collections notifications
  $user->collections_notifications_preferences_email = NULL;
  
  // notify the user via site message?
  $notify = elgg_get_plugin_setting('site_notification', 'notifications_email_disable');
  if (elgg_is_active_plugin('messages') && $notify != 'no') {
	notify_user(
			$user->guid,
			elgg_get_site_entity()->guid,
			elgg_echo('notifications_email_disable:subject'),
			elgg_echo('notifications_email_disable:disabled:notice'),
			array(),
			'site'
	);
  }
}

// sort out the message to send back
if (count($invalid_emails)) {
  register_error(elgg_echo('notifications_email_disable:invalid:emails'));
  $return = implode("\n", $invalid_emails);
  echo $return;
  forward();
}

// no errors
system_message(elgg_echo('notifications_email_disable:action:success'));

forward();