<?php
/**
 * Members index
 *
 */
 
 admin_gatekeeper();

$num_members = get_number_users();

$title = elgg_echo('adduser');

$content = elgg_view_form('useradd', array(), array('show_admin' => true));

$params = array(
	'content' => $content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $title,
	'filter' => '',
	'show_admin' =>true
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
