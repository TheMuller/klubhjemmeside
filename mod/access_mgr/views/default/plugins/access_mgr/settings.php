<?php
/**
 * Provide a way to manage pages
 *
 * @package Elgg
 * @subpackage Core
 */
$site = elgg_get_site_entity();
$site_admin = get_entity($site->site_admin_guid);
echo elgg_echo('access_mgr:settings:note')."(<font color=blue><b>".$site_admin->email."</b></font>).";

$plugin = $vars['entity'];
$super_admin_guid = $plugin->getSetting('super_admin_guid');

$selected_objects = unserialize($plugin->getSetting('selected_objects'));
$admins = elgg_get_admins(array('limit'=>0,));
foreach($admins as $admin){
$the_admins[$admin->guid]=$admin->username;
}

echo "<br><br><b>".elgg_echo('access_mgr:settings:super_admin')."</b>".
	elgg_view('input/dropdown',	array(
		'name' => 'super_admin_guid',
		'options_values' => $the_admins,
		'value' =>$super_admin_guid,
		'style'=>'width: 210px; height: 25px;',
	))."<br><br>";

echo "<b>".elgg_echo('access_mgr:settings:blocked_objects')."</b><br><br><div style='margin-left: 2cm;'>".
		elgg_view('input/checkboxes', array(
            'options' =>array('blog','file'),   
            'align' => 'horizontal',
			'value' => $selected_objects,   
			'name' => 'selected_objects',
        ))."</div>";
 ?>
