<?php
/**
 * Page for resetting a forgotten password
 *
 * @package Elgg.Core
 * @subpackage Registration
 */

if (elgg_is_logged_in()) {
	forward();
}

$title = elgg_echo('resetpassword');

$user_guid = get_input('u');
$code = get_input('c');

$user = get_entity($user_guid);

// don't check code here to avoid automated attacks
if (!$user instanceof ElggUser) {
	register_error(elgg_echo('user:passwordreset:unknown_user'));
	forward();
}

$params = array(
	'guid' => $user_guid,
	'code' => $code,
);
$form = elgg_view_form('user/passwordreset', array('class' => 'elgg-form-account'), $params);

$module = elgg_view_module('aside', $title, $form);
$content = elgg_view_module('index', '', $module);

$body = elgg_view_layout('one_column', array('content' => $content));

echo elgg_view_page($title, $body);
