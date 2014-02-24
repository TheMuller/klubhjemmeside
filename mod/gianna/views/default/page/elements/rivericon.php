<?php
/**
 * Icon module
 *
 */

$user = elgg_get_logged_in_user_entity();

$icon = elgg_view_entity_icon($user, 'medium', array('use_hover' => false));
$title = elgg_echo('gianna:welcome', array($user->name));

$num_messages = (int)messages_count_unread();
if ($num_messages != 0) {
	$text .= "<span class=\"messages-new\"> $num_messages</span>";
}							
$message = elgg_view('output/url', array(
	'href' => 'messages/inbox/' . $user->username,
	'text' => elgg_echo('messages') . $text,
	'is_trusted' => true,
));

$friends = elgg_view('output/url', array(
	'href' => "/friends/$user->username",
	'text' => elgg_echo('friends'),
	'is_trusted' => true,
));

$body = $icon;
$body .= '<ul class="profile-menu">';
	$body .= "<li>$message</li>";
	$body .= "<li>$friends</li>";
$body .= '</ul>';

echo elgg_view_module('aside', $title, $body);
