<?php
/*
 *
 * Elgg Handheld
 *
 * @author Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2013, Elggzone
 *
 * @link http://www.perjensen-online.dk/
 *
 */
  
elgg_register_event_handler('init','system','handheld_init'); 

function handheld_init(){

	$action_path = dirname(__FILE__) . '/actions';	
	elgg_register_action("handheld/settings", "$action_path/settings.php", 'admin');  

	elgg_extend_view('css/admin', 'handheld/admin');
	
	elgg_register_page_handler('about', 'handheld_expages_page_handler');
	elgg_register_page_handler('terms', 'handheld_expages_page_handler');
	elgg_register_page_handler('privacy', 'handheld_expages_page_handler');

	elgg_register_css('elgg.default', '/css/default.css');
	elgg_register_css('elgg.blue', '/css/blue.css');
	elgg_register_css('elgg.handheld', '/css/handheld.css');
		
	elgg_register_admin_menu_item('configure', 'handheld', 'settings');		
	elgg_extend_view('js/elgg', 'js/handheld/tabs');
				
	detectmobile();	
	$mobile = detectmobile();
		
	if($mobile == true) {
	
		elgg_set_viewtype('mobile');
				
		$theme = elgg_get_plugin_setting('active_theme', 'handheld');
	
		if (elgg_get_context() != 'admin') {			
			if ($theme == 'blue') {
				elgg_load_css('elgg.blue');
			} else {
				elgg_load_css('elgg.default');
			}
		}	
		elgg_load_css('elgg.handheld');

		if (!elgg_is_active_plugin('custom_index')) {
			elgg_register_plugin_hook_handler('index', 'system', 'handheld_index_handler', 0);
		}
		
		if (elgg_is_logged_in()	&& elgg_get_context() == 'activity'){	
			if (elgg_get_plugin_setting('show_thewire', 'handheld') == 'yes'){
				elgg_extend_view('page/layouts/content/header', 'page/elements/riverwire', 1);
			}
		} 

		elgg_unregister_js('elgg.friendspicker');		
		elgg_unregister_js('elgg.tinymce');	
		elgg_extend_view('page/elements/head','handheld/meta', 1);
		elgg_extend_view('page/elements/sidebar','page/elements/close', 0);

		if (elgg_in_context('admin')) {
			elgg_unregister_css('elgg.handheld');			
		} else {			
			elgg_unregister_js('jquery');		
			elgg_register_js('jquery-1.8.2.min', 'mod/handheld/vendors/js/jquery-1.8.2.min.js', 'head');
			elgg_load_js('jquery-1.8.2.min');
		}

		elgg_register_js('jPanelMenu', 'mod/handheld/vendors/js/jPanelMenu-1.1.0.min.js', 'footer');
		elgg_load_js('jPanelMenu');		
		elgg_register_js('handheld', 'mod/handheld/vendors/js/handheld.js', 'footer');
		elgg_load_js('handheld');		
				
		elgg_register_event_handler('pagesetup', 'system', 'handheld_setup_handler', 1000);
	}
	elgg_register_viewtype_fallback('mobile'); 
}

function handheld_index_handler($hook, $type, $return, $params) {

	if ($return == true) {
		return $return;
	}
	if (!include_once(dirname(__FILE__) . "/index.php")) {
		return false;
	}
	return true;
	
}

function handheld_expages_page_handler($page, $handler) {

	if ($handler == 'expages') {
		expages_url_forwarder($page[1]);
	}
	$type = strtolower($handler);

	$title = elgg_echo("expages:$type");
	$content = elgg_view_title($title);

	$object = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => $type,
		'limit' => 1,
	));
	if ($object) {
		$content .= elgg_view('output/longtext', array('value' => $object[0]->description));
	} else {
		$content .= elgg_echo("expages:notset");
	}
	$body = elgg_view_layout('one_sidebar', array('content' => $content));
	echo elgg_view_page($title, $body);

	return true;
}

function detectmobile(){
	if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	} else {
		return false;
	}
}

function handheld_setup_handler() {

	// remove more menu dropdown
	elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');
			
	elgg_unextend_view('page/elements/header', 'search/header');
	elgg_extend_view('page/elements/sidebar', 'search/header', 2);
	
	elgg_unregister_menu_item('footer', 'report_this');
	elgg_unregister_menu_item('topbar', 'elgg_logo');
	elgg_unregister_menu_item('topbar', 'administration');
	elgg_unregister_menu_item('topbar', 'dashboard');
		
	// Extend footer with copyright
	$year = date('Y');	
	$href = "http://www.perjensen-online.dk";
	elgg_register_menu_item('footer', array(
		'name' => 'copyright_this',
		'href' => $href,
		'title' => elgg_echo('handheld:tooltip'),
		'text' => elgg_echo('handheld:copyright') . $year . elgg_echo(' Elggzone'),
		'priority' => 1,
		'section' => 'alt',
	));

	if (elgg_is_logged_in()) {
		elgg_register_menu_item('topbar', array(
			'name' => 'sidebar',
			'href' => '#',
			'text' => elgg_view_icon('nav-btn'),
			'id' => 'elgg-button-open',
			'link_class' => 'elgg-open'
		));
			
		if (elgg_is_active_plugin('dashboard')) {			
			elgg_register_menu_item('site', array(
				'name' => 'dashboard',
				'href' => '/dashboard',
				'text' => elgg_echo('dashboard'),
			));
		}
				
		$user = elgg_get_logged_in_user_entity();
		
		elgg_register_menu_item('footer', array(
			'name' => 'logout',
			'href' => '/action/logout',
			'is_action' => TRUE,
			'text' => elgg_echo('logout'),
			'priority' => 100,
			'section' => 'alt',
		));
		elgg_register_menu_item('footer', array(
			'name' => 'usersettings',
			'href' => "/settings/user/$user->username",
			'text' => elgg_echo('settings'),
			'priority' => 101,
			'section' => 'alt',
		));
		
		elgg_unregister_menu_item('topbar', 'friends');
		elgg_register_menu_item('site', array(
			'name' => 'friends',
			'text' => elgg_echo('friends'),
			'href' => "/friends/$user->username",
		));
		elgg_unregister_menu_item('topbar', 'usersettings');
		elgg_register_menu_item('topbar', array(
			'name' => 'usersettings',
			'href' => "settings/user/{$viewer->username}",
			'text' => elgg_view_icon('settings'),
			'priority' => 500,
			'section' => 'alt',
		));
		elgg_register_menu_item('topbar', array(
			'name' => 'logout',
			'href' => "action/logout",
			'text' => elgg_view_icon('logout'),
			'is_action' => TRUE,
			'priority' => 1000,
			'section' => 'alt',
		));
		
		if (elgg_is_active_plugin('profile')) {
			elgg_unregister_menu_item('topbar', 'profile');
			$name = "<span>$user->name</span>";			
			elgg_register_menu_item('topbar-dark', array(
				'name' => 'profile',
				'href' => $user->getURL(),
				'text' => elgg_view('output/img', array(
					'src' => $user->getIconURL('topbar'),
					'alt' => $user->name,
					'title' => elgg_echo('profile'),
					'class' => 'elgg-border-plain elgg-transition',
				)) . $name,
				'priority' => 100,
				'link_class' => 'elgg-topbar-avatar',
			));
		}
		if (elgg_is_active_plugin('messages')) {	
			elgg_unregister_menu_item('topbar', 'messages');			
			$num_messages = (int)messages_count_unread();
			if ($num_messages != 0) {
				$text .= "<span class=\"messages-new\">$num_messages</span>";
			}							
			elgg_register_menu_item('site', array(
				'name' => 'messages',
				'href' => 'messages/inbox/' . elgg_get_logged_in_user_entity()->username,
				'text' => elgg_echo('messages') . $text,
			));
		}
	}	
	if (elgg_is_admin_logged_in()) {		
		elgg_register_menu_item('footer', array(
			'name' => 'administration',
			'href' => 'admin',
			'text' => elgg_echo('admin'),
			'priority' => 102,
			'section' => 'alt',
		));
	}
}
