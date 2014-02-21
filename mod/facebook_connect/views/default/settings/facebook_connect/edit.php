<?php
$insert_view = elgg_view('facebooksettings/extend');

$consumer_key_string = elgg_echo('facebook_connect:consumer_key');
$consumer_key_view = elgg_view('input/text', array(
	'name' => 'params[consumer_key]',
	'value' => $vars['entity']->consumer_key,
	'class' => 'text_input',
));

$consumer_secret_string = elgg_echo('facebook_connect:consumer_secret');
$consumer_secret_view = elgg_view('input/text', array(
	'name' => 'params[consumer_secret]',
	'value' => $vars['entity']->consumer_secret,
	'class' => 'text_input',
));

$sign_on_with_facebook_string = elgg_echo('facebook_connect:login');
$sign_on_with_facebook_view = elgg_view('input/dropdown', array(
	'name' => 'params[sign_on]',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no'),
	),
	'value' => $vars['entity']->sign_on ? $vars['entity']->sign_on : 'yes',
));

$new_users_with_facebook = elgg_echo('facebook_connect:new_users');
$new_users_with_facebook_view = elgg_view('input/dropdown', array(
	'name' => 'params[new_users]',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no'),
	),
	'value' => $vars['entity']->new_users ? $vars['entity']->new_users : 'no',
));

$post_on_facebook = elgg_echo('facebook_connect:post_onfb');
$post_on_facebook_view = elgg_view('input/dropdown', array(
	'name' => 'params[post_onfb]',
	'options_values' => array(
		'yes' => elgg_echo('option:yes'),
		'no' => elgg_echo('option:no'),
	),
	'value' => $vars['entity']->post_onfb ? $vars['entity']->post_onfb : 'no',
));

$settings = <<<__HTML
<div>$insert_view</div>
<div>$consumer_key_string $consumer_key_view</div>
<div>$consumer_secret_string $consumer_secret_view</div>
<div>$sign_on_with_facebook_string $sign_on_with_facebook_view</div>
<div>$new_users_with_facebook $new_users_with_facebook_view</div>
<div>$post_on_facebook $post_on_facebook_view</div>
__HTML;

echo $settings;