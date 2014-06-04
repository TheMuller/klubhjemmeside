<?php
/*Access manager plugin*/

elgg_register_event_handler('init', 'system', 'access_mgr_init');

function access_mgr_init($event, $type, $object) {
	
	//elgg_register_plugin_hook_handler('permissions_check:comment', 'object','access_discussion_comment_override');
	elgg_register_plugin_hook_handler('action', 'all', 'access_mgr_actions_permissions');
	elgg_register_plugin_hook_handler('route', 'all', 'access_mgr_pages_permissions');
	$action_path = elgg_get_plugins_path().'access_mgr/actions/access_mgr/settings';
	elgg_register_action("access_mgr/settings/save", "$action_path/save.php");
	elgg_extend_view('forms/groups/edit','input/access_mgr');
	elgg_register_event_handler('update', 'all', 'access_mgr_save');
    elgg_register_event_handler('create', 'all', 'access_mgr_save');
}
function access_mgr_save($event, $object_type, $group) {
    	if ($group instanceof ElggGroup) {
			$group->member_allow=get_input('member_allow','');
		}
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
			//foreach($selected_objects as $selected_object){
				//system_message($selected_objects);
				if($type =='blog/save' AND $selected_objects[0] == 'blog'){
					$group_guid = get_input('container_guid');
					$group_entity = get_entity($group_guid);
					if(elgg_instanceof($group_entity, 'group')){
						if(($group_entity->member_allow == 'yes') OR ($group_entity->owner_guid == elgg_get_logged_in_user_guid())){
							//system_message("It's the group");
							return true;
						}else{register_error(elgg_echo('access_mgr:error:msg'));
								return false;}
					}else{
						//system_message('bloging denied...');
						register_error(elgg_echo('access_mgr:error:msg'));
						return false;
					}
				}elseif($type =='file/upload' AND $selected_objects[1] == 'file'){
					//system_message($selected_objects[1]."__".$type);
					$group_guid = get_input('container_guid');
					$group_entity = get_entity($group_guid);
					if(elgg_instanceof($group_entity, 'group')){
						if(($group_entity->member_allow == 'yes') OR ($group_entity->owner_guid == elgg_get_logged_in_user_guid())){
							//system_message("It's the group");
							return true;
						}else{register_error(elgg_echo('access_mgr:error:msg'));
								return false;}
					}else{
						//system_message('file denied...');
						register_error(elgg_echo('access_mgr:error:msg'));
						return false;
					}
				}elseif($type =='bookmarks/add' AND $selected_objects[2] == 'bookmarks'){
					//system_message($selected_objects."".$type);
					$group_guid = get_input('container_guid');
					$group_entity = get_entity($group_guid);
					if(elgg_instanceof($group_entity, 'group')){
						if(($group_entity->member_allow == 'yes') OR ($group_entity->owner_guid == elgg_get_logged_in_user_guid())){
							//system_message("It's the group");
							return true;
						}else{register_error(elgg_echo('access_mgr:error:msg'));
								return false;}
					}else{
						//system_message('file denied...');
						register_error(elgg_echo('access_mgr:error:msg'));
						return false;
					}
				}
			//}
		}else{
			// Action restrict for plugins side...
			$server_action_path = parse_url($_SERVER['REQUEST_URI']);
			if($site->site_admin_guid != elgg_get_logged_in_user_guid()){
				if((strpos($server_action_path['path'],'admin/plugins/deactivate') !== false) OR (strpos($server_action_path['path'],'admin/plugins/activate') !== false) OR (strpos($server_action_path['path'],'action/admin/plugins/set_priority') != false)){
					//system_message('you are denied for action...');
					register_error(elgg_echo('access_mgr:error:msg'));
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
		//foreach($selected_objects as $selected_object){
			
			if((strpos($server_page_path['path'],'blog/add') !== false) AND $selected_objects[0] == 'blog'){
			//system_message($selected_objects[0]." And ".$server_page_path['path']);
					$group_entity = get_entity(end(explode("/",$server_page_path['path'])));
					if(elgg_instanceof($group_entity, 'group')){
						if(($group_entity->member_allow == 'yes') OR ($group_entity->owner_guid == elgg_get_logged_in_user_guid())){
						//system_message("It's the group page");
						return ;
						}else{
							register_error(elgg_echo('access_mgr:error:msg'));
							forward(REFERRER);
							return ;
							//system_message('blog member allow...');
						}
					}else{
						//system_message('blog page denied...');
						register_error(elgg_echo('access_mgr:error:msg'));
						forward(REFERRER);
						return ;
					}					
			}if(strpos($server_page_path['path'],'file/add') !== false AND $selected_objects[1] == 'file'){
				$group_entity = get_entity(end(explode("/",$server_page_path['path'])));
					if(elgg_instanceof($group_entity, 'group')){
						if(($group_entity->member_allow == 'yes') OR ($group_entity->owner_guid == elgg_get_logged_in_user_guid())){
						//system_message("It's the group page");
						return ;
						}else{
							register_error(elgg_echo('access_mgr:error:msg'));
							forward(REFERRER);
							return ;
							//system_message('blog member allow...');
						}
					}else{
						//system_message("It's not the group pge");
						register_error(elgg_echo('access_mgr:error:msg'));
						forward(REFERRER);
						return ;
					}
			}elseif(strpos($server_page_path['path'],'bookmarks/add') !== false AND $selected_objects[2] == 'bookmarks'){
				$group_entity = get_entity(end(explode("/",$server_page_path['path'])));
					if(elgg_instanceof($group_entity, 'group')){
						if(($group_entity->member_allow == 'yes') OR ($group_entity->owner_guid == elgg_get_logged_in_user_guid())){
						//system_message("It's the group page");
						return ;
						}else{
							register_error(elgg_echo('access_mgr:error:msg'));
							forward(REFERRER);
							return ;
							//system_message('blog member allow...');
						}
					}else{
						//system_message("It's not the group pge");
						register_error(elgg_echo('access_mgr:error:msg'));
						forward(REFERRER);
						return ;
					}
			}
		//}
	}

//Page restriction for the super admin...
    if(strpos($server_page_path['path'],'admin') !== false ){
		$super_admin_guid = $plugin->getSetting('super_admin_guid');
		$site = elgg_get_site_entity();
		if(($site->site_admin_guid != elgg_get_logged_in_user_guid()) AND ($super_admin_guid != elgg_get_logged_in_user_guid())){
			forward(REFERRER);
			register_error(elgg_echo('access_mgr:error:msg'));
			//system_message('Denied For this page...');
			return false;
		}
	}
	return $return_value;		
} 
?>