<?php
/**
 * inviteregonly Plugin
 */

//register the plugin hook handler
elgg_register_event_handler('init', 'system', 'inviteregonly_init');

/**
 * plugin init function
 */
function inviteregonly_init() {
	// register form check action when the user registration takes place
	elgg_register_plugin_hook_handler('action', 'register', 'inviteregonly_check_form');
}

/**
 * @param $hook
 * @param $type
 * @param $returnvalue
 * @param $params
 *
 * @return bool
 *
 * this hook is triggered for the action = "register"
 * this hooks is called before the default "register" action handler at /actions/register.php
 */

function inviteregonly_check_form($hook, $type, $returnvalue, $params) {

    // retain entered form values and re-populate form fields if validation error
    elgg_make_sticky_form('register');

	if (!$_POST["invitecode"] || $_POST["friend_guid"] == 0) {
		register_error(elgg_echo('inviteregonly:noinvite'));
		forward(REFERER);
	} else if ($friend_user = get_user($_POST["friend_guid"])) {
		if ($_POST["invitecode"] != generate_invite_code($friend_user->username)) {
			register_error(elgg_echo('inviteregonly:badcode'));
			forward(REFERER);
		}
	} else {
		register_error(elgg_echo('inviteregonly:nouser'));
		forward(REFERER);
	}
	return true;
}