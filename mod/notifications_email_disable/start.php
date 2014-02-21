<?php

elgg_register_event_handler('init', 'system','email_disable_init');

function email_disable_init() {
  elgg_extend_view('js/admin', 'notifications_email_disable/js/admin');
  elgg_extend_view('js/elgg', 'notifications_email_disable/js/site');
  
  elgg_register_widget_type('notifications_email_disable', elgg_echo("notifications_email_disable"), elgg_echo("email_disable:widget:description"), 'admin');
  
  
  if (elgg_is_logged_in()) {
	if (elgg_get_logged_in_user_entity()->notifications_email_disabled) {
	  // only display the message once
	  // use system message so as not to overwrite other messages
	  $system_message = elgg_get_plugin_setting('system_message', 'notifications_email_disable');
	  $lightbox = elgg_get_plugin_setting('lightbox', 'notifications_email_disable');
	  
	  // no sense using lightbox AND system message - lightbox is very in your face
	  // so use lightbox if set, otherwise use system message if set
	  if ($lightbox == 'yes' && get_input('handler') != 'settings') {
		elgg_extend_view('page/elements/foot', 'notifications_email_disable/lightbox');
	  }
	  else {
		if ($system_message != 'no') {
		  system_message(elgg_echo('notifications_email_disable:disabled:notice'));
		  
		  if ($lightbox != 'yes') {
			elgg_get_logged_in_user_entity()->notifications_email_disabled = 0;
		  }
		}
	  }
	}
  }
  
  elgg_register_action('notifications_email_disable', elgg_get_plugins_path() . 'notifications_email_disable/actions/disable.php', 'admin');
  elgg_register_action('notifications_email_disable/acknowledge', elgg_get_plugins_path() . 'notifications_email_disable/actions/acknowledge.php');
  
  elgg_register_plugin_hook_handler('action', 'usersettings/save', 'notifications_email_disable_usersettings');
  
  elgg_register_ajax_view('notifications_email_disable/acknowledge');
}


function notifications_email_disable_usersettings($hook, $type, $return, $params) {
  $guid = get_input('guid');
  $user = get_user($guid);
  
  if (!$user) {
	return $return;
  }
  
  if ($user->notifications_email_disabled) {
	$email = get_input('email');
	if ($user->email != $email && validate_email_address($email)) {
	  // email is updated to something new
	  $user->notifications_email_disabled = 0;
	}
  }
}