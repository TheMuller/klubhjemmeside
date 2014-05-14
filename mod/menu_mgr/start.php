<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'menu_mgr_init');

function menu_mgr_init() {
///topbar menu
elgg_unregister_menu_item('topbar', 'elgg_logo');
//elgg_extend_view('page/elements/footer','page/elements/mysite/footerlink');

//site menu  
elgg_register_plugin_hook_handler('register', 'menu:site', 'menu_mgr_site_menu');
elgg_register_plugin_hook_handler('prepare', 'menu:site', 'menu_mgr_menu_priority');

elgg_register_plugin_hook_handler('register', 'menu:topbar', 'menu_mgr_top_menu');

elgg_register_admin_menu_item('configure', 'menu_mgr', 'appearance','100');
elgg_register_event_handler('pagesetup', 'system', 'menu_mgr_sidebar_menu');
elgg_extend_view("css/elgg", "menu_mgr/css/topbarsubmenu");
}

function menu_mgr_menu_priority($hook, $type, $return, $params) 
{
	$ordered = array();
	if(isset($return["default"])){
		foreach($return["default"] as $menu_item){
			$ordered[$menu_item->getPriority()] = $menu_item;
				
			if($children = $menu_item->getChildren()){
				// sort children
				$ordered_children = array();
	
				foreach($children as $child){
					$ordered_children[$child->getPriority()] = $child;
				}
				ksort($ordered_children);
	
				$menu_item->setChildren($ordered_children);
			}
		}
	}

	ksort($ordered);
	$return["default"] = $ordered;
	return $return;
}
//top bar
function menu_mgr_top_menu($hook, $type, $values) {
$site = elgg_get_site_entity();
$materials = unserialize($site->material);
	foreach($materials as $material){
		if($material[type]=='1'){
			if(($material[visibility]=='2') && (!elgg_is_logged_in()))		continue;
			if(($material[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
			$menu_options = array("name" => $material['name'],"text" => $material['name'], "href" => elgg_get_site_url().$material['url'],"id" => $material['name'],'priority'=>$material[priority]);
			 $values[] = ElggMenuItem::factory($menu_options);
			 
			 if(is_array($material[childs])){
				foreach($material[childs] as $itemc){
						if(($itemc[visibility]=='2') && (!elgg_is_logged_in()))		continue;
						if(($itemc[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
						$menu_options = array("name" => $itemc['name'],"text" => $itemc['name'], "href" => elgg_get_site_url().$itemc['url'],"id" => $itemc['name'],'priority'=>$itemc[priority],'parent_name' =>$material['name']);
						$values[] = ElggMenuItem::factory($menu_options);
				}
			}
		}

		}
		
 return $values;
}
//site menu
function menu_mgr_site_menu($hook, $type, $values) {
//If you use $values it will go at end.
$result = array();
$site = elgg_get_site_entity();
$materials = unserialize($site->material);
//var_dump($materials);
	foreach($materials as $material){
		if($material[type]=='2'){
			if(($material[visibility]=='2') && (!elgg_is_logged_in()))		continue;
			if(($material[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
			$menu_options = array("name" => $material['name'],"text" => $material['name'], "href" => elgg_get_site_url().$material['url'],"id" => $material['name'],'priority'=>$material[priority]);
			$result[] = ElggMenuItem::factory($menu_options);
			
			if(is_array($material[childs])){
				foreach($material[childs] as $itemc){
						if(($itemc[visibility]=='2') && (!elgg_is_logged_in()))		continue;
						if(($itemc[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
						$menu_options = array("name" => $itemc['name'],"text" => $itemc['name'], "href" => elgg_get_site_url().$itemc['url'],"id" => $itemc['name'],'priority'=>$itemc[priority],'parent_name' =>$material['name']);
						$result[] = ElggMenuItem::factory($menu_options);
				}
			}
		}
	}
return $result;

}
//side bar
function menu_mgr_sidebar_menu() {

	// Get the page owner entity
	
$site = elgg_get_site_entity();
$materials = unserialize($site->material);
	foreach($materials as $material){
		if($material[type]=='3'){
			if(($material[visibility]=='2') && (!elgg_is_logged_in()))		continue;
			if(($material[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
			$menu_options = array("name" => $material['name'],"text" => $material['name'], "href" => elgg_get_site_url().$material['url'],"id" => $material['name'],'priority'=>$material[priority]);
			$result[] = ElggMenuItem::factory($menu_options);
		}
	}
	$page_owner = elgg_get_page_owner_entity();
}

