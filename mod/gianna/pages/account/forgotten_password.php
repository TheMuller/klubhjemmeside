<?php
/**
 * Assembles and outputs the forgotten password page.
 *
 * @package Elgg.Core
 * @subpackage Registration
 */

if (elgg_is_logged_in()) {
	forward();
}

$title = elgg_echo("user:password:lost");

$form = elgg_view_form('user/requestnewpassword', array(
	'class' => 'elgg-form-account',
));

$module = elgg_view_module('aside', $title, $form);

$content = '<div class="ez-content">';
	$content .= elgg_view('page/elements/logo');
	$content .= elgg_view_module('request', '', $module);
$content .= '</div>';

$body = elgg_view_layout("one_column", array('content' => $content));

echo elgg_view_page($title, $body);