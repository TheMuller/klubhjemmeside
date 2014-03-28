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

}
function menu_builder_top_menu_register($hook, $type, $values) {
 $user = elgg_get_logged_in_user_entity();
 if($user) {
  $myprojecturl = elgg_get_site_url()."projects/users/".$user->username;
  $menu_options = array("name" => 'myproject',"text" => '<b>My projects</b>', "href" => '#','priority' => '900',"id" => 'myproject',);
  $values[] = ElggMenuItem::factory($menu_options);

   $myprojecturl = elgg_get_site_url()."projects/users/".$user->username;
   $menu_options = array("name" => 'listproject',"text" => 'List projects', "href" => $myprojecturl,'priority' => '100',"id" => 'listproject',"parent_name" =>'myproject');
   $values[] = ElggMenuItem::factory($menu_options);  
   
   $url = elgg_get_site_url()."project/create/".$user->guid;
   $menu_options = array("name" => 'createproject',"text" => 'Create project', "href" => $url,'priority' => '100',"id" => 'createproject',"parent_name" =>'myproject');
   $values[] = ElggMenuItem::factory($menu_options);


  
  $menu_options = array("name" => 'NGO',"text" => 'NGO', "href" => "/grps/ngo/all","id" => 'groups-NGO',"parent_name" =>'Groups','priority'=>50);
 $result[] = ElggMenuItem::factory($menu_options);
   
 }
 return $values;
}

function menu_builder_site_menu_register2($hook, $type, $values) {
//If you use $values it will go at end.
$result = array();

$menu_options = array("name" => 'Home',"text" => 'Home', "href" => "/","id" => 'home','priority'=>50);
$result[] = ElggMenuItem::factory($menu_options);

if(!elgg_is_logged_in()){
	$menu_options = array("name" => 'MyPage',"text" => 'MyPage', "href" => "/mypage","id" => 'mypage','priority'=>51);
	$result[] = ElggMenuItem::factory($menu_options);
	}

$menu_options = array("name" => 'Projects',"text" => 'Projects', "href" => "/projects/all","id" => 'Projects','priority'=>52);
$result[] = ElggMenuItem::factory($menu_options);
	
$menu_options = array("name" => 'Groups',"text" => 'Groups', "href" => "/grps/Nonprofit/all","id" => 'Groups','priority'=>53);
$result[] = ElggMenuItem::factory($menu_options);

$menu_options = array("name" => 'members',"text" => 'Members', "href" => "/members","id" => 'members','priority'=>54);
$result[] = ElggMenuItem::factory($menu_options);
	


return $result;

}

