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
elgg_register_plugin_hook_handler('register', 'menu:site', 'menu_builder_site_menu_register2');
elgg_register_plugin_hook_handler('register', 'menu:topbar', 'menu_builder_top_menu_register');
elgg_register_admin_menu_item('administer', 'settings', 'users','100');
elgg_register_event_handler('pagesetup', 'system', 'menu_mgr_setup_sidebar_menus');

}
//top bar
function menu_builder_top_menu_register($hook, $type, $values) {
$site = elgg_get_site_entity();
$materials = unserialize($site->material);
	foreach($materials as $material){
		if($material[type]=='1'){
			if(($material[visibility]=='2') && (!elgg_is_logged_in()))		continue;
			if(($material[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
			$menu_options = array("name" => $material['name'],"text" => $material['name'], "href" => $material['url'],"id" => $material['name'],'priority'=>'900');
			 $values[] = ElggMenuItem::factory($menu_options);
		}
		}
	elgg_register_admin_menu_item('configure', 'menu_mgr', 'appearance');
 return $values;
}
//site menu
function menu_builder_site_menu_register2($hook, $type, $values) {
//If you use $values it will go at end.
$result = array();
$site = elgg_get_site_entity();
$materials = unserialize($site->material);
	foreach($materials as $material){
		if($material[type]=='2'){
			if(($material[visibility]=='2') && (!elgg_is_logged_in()))		continue;
			if(($material[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
			$menu_options = array("name" => $material['name'],"text" => $material['name'], "href" => $material['url'],"id" => $material['name'],'priority'=>'50');
			$result[] = ElggMenuItem::factory($menu_options);
		}
	$result[] = ElggMenuItem::factory($menu_options);
	}
return $result;

}
//side bar
function menu_mgr_setup_sidebar_menus() {

	// Get the page owner entity
	
$site = elgg_get_site_entity();
$materials = unserialize($site->material);
	foreach($materials as $material){
		if($material[type]=='3'){
			if(($material[visibility]=='2') && (!elgg_is_logged_in()))		continue;
			if(($material[visibility]=='1') && (!elgg_is_admin_logged_in())) continue;
			$menu_options = array("name" => $material['name'],"text" => $material['name'], "href" => $material['url'],"id" => $material['name'],'priority'=>'50');
			$result[] = ElggMenuItem::factory($menu_options);
		}
	}
	$page_owner = elgg_get_page_owner_entity();
}

