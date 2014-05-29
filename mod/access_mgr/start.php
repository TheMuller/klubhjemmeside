<?php
/*Access manager plugin*/

elgg_register_event_handler('init', 'system', 'access_mgr_init');

function access_mgr_init($event, $type, $object) {
	
	//elgg_register_plugin_hook_handler('permissions_check:comment', 'object','access_discussion_comment_override');
	elgg_register_plugin_hook_handler('action', 'all', 'access_mgr_actions_permissions');
	elgg_register_plugin_hook_handler('route', 'all', 'access_mgr_pages_permissions');
	$action_path = elgg_get_plugins_path().'access_mgr/actions/access_mgr/settings';
	elgg_register_action("access_mgr/settings/save", "$action_path/save.php");
}

function access_discussion_comment_override($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'object', 'groupforumtopic')) {
		return false;
	}
}
function access_mgr_actions_permissions($hook, $type, $return_value, $params) {
$site = elgg_get_site_entity();

// Action restrict for site side...
	$plugin = elgg_get_plugin_from_id('access_mgr');	
	$selected_objects_str = $plugin->getSetting('selected_objects');
	$selected_objects = unserialize($selected_objects_str);
		if(!isadminloggedin()){
			foreach($selected_objects as $selected_object){
				//system_message($selected_object);
				if($selected_object == 'blog' AND $type =='blog/save'){
					$group_guid = get_input('container_guid');
					$group_entity = get_entity($group_guid);
					if(elgg_instanceof($group_entity, 'group')){
						//system_message("It's the group");
						return true;
					}else{
						//system_message("It's not the group");
					}
					//system_message('bloging denied...');
					register_error(elgg_echo('bloging denied...'));
					return false;
				}elseif($selected_object == 'file' AND $type =='file/upload'){
					system_message($selected_object."".$type);
					$group_guid = get_input('group_guid');
					$group_entity = get_entity($group_guid);
					if(elgg_instanceof($group_guid, 'group')){
						//system_message("It's the group");
						return true;
					}else{
						//system_message("It's not the group");
					}					
		
					//system_message('file denied...');
					register_error(elgg_echo('file denied...'));
					return false;
				}
			}
		}else{
			// Action restrict for plugins side...
			$server_action_path = parse_url($_SERVER['REQUEST_URI']);
			if($site->site_admin_guid != elgg_get_logged_in_user_guid()){
				if((strpos($server_action_path['path'],'admin/plugins/deactivate') !== false) OR (strpos($server_action_path['path'],'admin/plugins/activate') !== false) OR (strpos($server_action_path['path'],'action/admin/plugins/set_priority') != false)){
					//system_message('you are denied for action...');
					register_error(elgg_echo('you are denied for action...'));
					return false;
				}
			}
		}
		return $return_value;		
}
function access_mgr_pages_permissions($hook_name, $type, $return_value, $params) {
$plugin = elgg_get_plugin_from_id('access_mgr');
$server_page_path = parse_url($_SERVER['REQUEST_URI']);

	if(!isadminloggedin()){
		$selected_objects_str = $plugin->getSetting('selected_objects');
		$selected_objects = unserialize($selected_objects_str);
		foreach($selected_objects as $selected_object){
			//system_message($selected_object." And ".$type);
			if($selected_object == 'blog' AND strpos($server_page_path['path'],'blog/add') !== false){
					$group_entity = get_entity(end(explode("/",$server_page_path['path'])));
					if(elgg_instanceof($group_entity, 'group')){
						//system_message("It's the group page");
						return true;
					}else{
						//system_message("It's not the group pge");
					}					
				//system_message('blog page denied...');
				register_error(elgg_echo('blog page denied...'));
				forward(REFERRER);
				return false;
				break;
			}elseif($selected_object == 'file' AND strpos($server_page_path['path'],'file/add') !== false){
				$group_entity = get_entity(end(explode("/",$server_page_path['path'])));
					if(elgg_instanceof($group_entity, 'group')){
						system_message("It's the group page");
						return true;
					}else{
						system_message("It's not the group pge");
						forward(REFERRER);
						return false;
					}
			}
		}
	}

//Page restriction for the super admin...
    if(strpos($server_page_path['path'],'admin') !== false ){
		$super_admin_guid = $plugin->getSetting('super_admin_guid');
		$site = elgg_get_site_entity();
		if(($site->site_admin_guid != elgg_get_logged_in_user_guid()) AND ($super_admin_guid != elgg_get_logged_in_user_guid())){
			forward(REFERRER);
			register_error(elgg_echo('Denied For this page...'));
			//system_message('Denied For this page...');
			return false;
		}
	}
	return $return_value;		
} 
?>