<?php
/**
 * Gianna custom index page
 * 
 */

if (elgg_is_logged_in()) {
	forward('dashboard');
}

elgg_push_context('main');

$login = elgg_view("core/account/login_box");

elgg_pop_context();

$params = array(
	'login' => $login,
);
$body = elgg_view_layout('gianna_index', $params);

global $autofeed;
$autofeed = FALSE;

echo elgg_view_page(null, $body);
