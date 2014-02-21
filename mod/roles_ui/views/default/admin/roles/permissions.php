<?php

namespace Elgg\Roles\UI;

$role = elgg_extract('entity', $vars);

if (!elgg_instanceof($role, 'object', 'role')) {
	$name = get_input('role');
	$role = roles_get_role_by_name($name);
}

if (!elgg_instanceof($role, 'object', 'role')) {
	echo elgg_autop(elgg_echo(PLUGIN_ID . ':norole', array($name)));
	return;
}

echo elgg_view_title($role->title);

echo '<br />';

$extends = $role->extends;
if ($extends && !is_array($extends)) {
	$extends = array($extends);
}

if (count($extends)) {
	echo '<div class="roles-ui-extends">';
	echo '<h3>' . elgg_echo(PLUGIN_ID . ':extends') . '</h3>';
	echo '<ul class="elgg-list">';
	foreach ($extends as $rname) {
		echo '<li>';
		echo elgg_view('output/url', array(
			'text' => $rname,
			'href' => "admin/roles/permissions?role=$rname"
		));
		echo '</li>';
	}
	echo '</ul>';
	echo '</div>';
}

echo '<br />';

echo '<h3>' . elgg_echo(PLUGIN_ID . ':permissions') . '</h3>';
echo elgg_view_form('roles/permissions', array(), array('entity' => $role));


echo '<br />';

echo '<h3>' . elgg_echo(PLUGIN_ID . ':config') . '</h3>';
echo '<pre>';
var_export(unserialize($role->permissions));
echo '</pre>';
