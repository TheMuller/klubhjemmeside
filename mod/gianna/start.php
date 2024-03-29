<?php
/*
 *
 * Theme Gianna
 *
 * @author Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2012, Elggzone
 *
 * @link http://www.perjensen-online.dk/
 *
 */
 
elgg_register_event_handler('init','system','gianna_init');
 
function gianna_init() {

	$plugin = elgg_get_plugin_from_id('gianna');
		
	elgg_unregister_page_handler('register');
	elgg_unregister_page_handler('forgotpassword');
	elgg_unregister_page_handler('resetpassword');
	elgg_register_page_handler('register', 'gianna_user_account_page_handler');
	elgg_register_page_handler('forgotpassword', 'gianna_user_account_page_handler');
	elgg_register_page_handler('resetpassword', 'gianna_user_account_page_handler');
		
	elgg_register_page_handler('about', 'custom_expages_page_handler', 1000);
	elgg_register_page_handler('terms', 'custom_expages_page_handler', 1000);
	elgg_register_page_handler('privacy', 'custom_expages_page_handler', 1000);
	elgg_register_page_handler('expages', 'custom_expages_page_handler', 1000);
	
	elgg_register_css('background', '/css/background.css');
	if (elgg_get_context() != 'admin') {
		elgg_load_css('background');
	}
		
	elgg_register_event_handler('pagesetup', 'system', 'gianna_pagesetup_handler', 1000);
	
	elgg_register_plugin_hook_handler('view', 'navigation/breadcrumbs', 'gianna_breadcrumbs');
	
	$action_path = dirname(__FILE__) . '/actions';
	
	elgg_register_action("gianna/settings", "$action_path/settings.php", 'admin');
	elgg_register_action("gianna/background", "$action_path/background.php");
	
	elgg_register_admin_menu_item('configure', 'gianna', 'settings');

	elgg_extend_view('js/elgg', 'js/gianna/tabs');
	elgg_extend_view('js/elgg', 'js/gianna/theme');

	if ($plugin->show_thewire == 'yes'){
		elgg_register_action("gianna/add", "$action_path/add.php");
		elgg_extend_view('js/elgg', 'js/gianna/update');
	}	

	elgg_unextend_view('groups/tool_latest', 'discussion/group_module');
	elgg_extend_view('groups/tool_latest', 'discussion/group_module', 1);
		
	elgg_extend_view('page/elements/head', 'gianna/meta', 1);
	elgg_extend_view('css/elgg', 'gianna/css');
	elgg_extend_view('css/admin', 'gianna/admin');
	
	elgg_register_js('respond', 'mod/gianna/vendors/js/respond.js');
	elgg_load_js('respond');
	elgg_register_js('gianna', 'mod/gianna/vendors/js/gianna.js', 'footer');
	elgg_load_js('gianna');
	elgg_register_js('multiselect', 'mod/gianna/vendors/js/multiselect.min.js');
	elgg_load_js('multiselect');

	elgg_unregister_js('elgg.friendspicker');

	if ($plugin->gianna_index == 'gianna' && !elgg_is_active_plugin('custom_index')) {
		elgg_register_plugin_hook_handler('index', 'system', 'gianna_index_handler', 1);
	}
	if (elgg_is_logged_in()	&& $plugin->show_icon != 'no'){
		elgg_extend_view('page/elements/sidebar', 'page/elements/rivericon', '2');
	}
	if ($plugin->show_reg_text != 'no'){
		elgg_extend_view('help/register', 'page/elements/info_register');
	}

/*****
	if (elgg_is_logged_in()	&& elgg_get_context() == 'index'){
		if ($plugin->show_thewire == 'yes'){
			elgg_extend_view('page/layouts/content/header', 'page/elements/riverwire', 1);
		}
		if ($plugin->show_menu != 'no'){
			elgg_extend_view('page/elements/sidebar', 'page/elements/ownermenu', '502');
		}
		if ($plugin->show_friends != 'no'){
			elgg_extend_view('page/elements/sidebar', 'page/elements/friends', '503');
		}
		if ($plugin->show_latest_members != 'no'){
			elgg_extend_view('page/elements/sidebar', 'page/elements/latest_members', '504');
		}
		if ($plugin->show_latest_groups != 'no'){
			elgg_extend_view('page/elements/sidebar', 'page/elements/latest_groups', '505');
		}
	}
	if ((elgg_get_context() == 'activity') || (elgg_get_context() == 'thewire')){
		if ($plugin->show_tagcloud != 'no'){
			elgg_extend_view('page/elements/sidebar', 'page/elements/tagcloud_block', '507');
		}
		if ($plugin->show_custom != 'no'){
			elgg_extend_view('page/elements/sidebar', 'page/elements/custom_module', 506);
		}
	}
***/		
		expages_setup_sidebar_menu();
	
}

function expages_setup_sidebar_menu() {
	$pages = array('privacy', 'terms', 'about');
	foreach ($pages as $page) {		
		elgg_register_menu_item('page', array(
			'name' => $page,
			'href' => $page,
			'text' => elgg_echo("expages:$page"),
			'contexts' => $pages,
		));
	}
}

function gianna_breadcrumbs($hook, $type, $returnvalue, $params) {

    if ($params['viewtype'] !== 'default') {
        return $returnvalue;
    }
    if (false === strpos($returnvalue, '<a ')) {
        return '';
    }
}

function gianna_user_account_page_handler($page_elements, $handler){
	
	$base_dir = elgg_get_root_path() . 'mod/gianna/pages/account';
	switch ($handler) {
		case 'forgotpassword':
			require_once("$base_dir/forgotten_password.php");
			break;
		case 'resetpassword':
			require_once("$base_dir/reset_password.php");
			break;
		case 'register':
			require_once("$base_dir/register.php");
			break;
		default:
			return false;
	}
	return true;
}

function custom_expages_page_handler($page, $handler) {
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

function gianna_index_handler($hook, $type, $return, $params) {
	if ($return == true) {
		return $return;
	}
	if (!include_once(dirname(__FILE__) . "/index.php")) {
		return false;
	}
	return true;
}

function gianna_pagesetup_handler() {

	$plugin = elgg_get_plugin_from_id('gianna');

	elgg_unregister_menu_item('topbar', 'dashboard');
	elgg_unregister_menu_item('topbar', 'elgg_logo');
	//elgg_unregister_menu_item('topbar', 'messages');
	elgg_unregister_menu_item('topbar', 'friends');

	/*** elgg_unextend_view('page/elements/header', 'search/header');
	if (elgg_is_logged_in()) {
		elgg_extend_view('page/elements/sidebar', 'search/header', '1');
	}
	if (!elgg_is_logged_in()) {	
		elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
	}
	***/

	$site = elgg_get_site_entity();
	$site_name = $site->name;
	$logo_url = elgg_get_site_url() . "mod/gianna/graphics/logo-topbar.png";
	if ($plugin->show_logo == 'yes'){
		$name = "<img src=\"$logo_url\" alt=\"$site_name\" width=\"87\" height=\"29\" />";
	} else {
		$name = $site_name;
	}
	elgg_register_menu_item('navbar', array(
		'name' => 'gianna_logo',
		'href' => elgg_get_site_url(),
		'text' => $name,
		'priority' => 1,
		'link_class' => 'elgg-topbar-logo',
	));
			
	// Extend footer with copyright
	$year = date('Y');	
	$href = "http://www.klubhjemmeside.dk";
	elgg_register_menu_item('footer', array(
		'name' => 'copyright_this',
		'href' => $href,
		'title' => elgg_echo('gianna:tooltip'),
		'text' => elgg_echo('gianna:copyright') . $year . elgg_echo(' Klubhjemmeside'),
		'priority' => 1,
		'section' => 'alt',
	));
	
	$href = "http://www.klubhjemmeside.dk";
	elgg_register_menu_item('footer', array(
		'name' => 'elgg',
		'href' => $href,
		'text' => elgg_echo('gianna:elgg'),
		'priority' => 2,
		'section' => 'alt',
	));
	/**
	if (elgg_is_admin_logged_in()) {		
		elgg_register_menu_item('topbar', array(
			'name' => 'themeadministration',
			'href' => 'admin/settings/gianna',
			'text' => elgg_echo('gianna:admin'),
			'priority' => 102,
			'section' => 'alt',
		));
	}
	**/
	if (elgg_is_logged_in()) {
		$user = elgg_get_logged_in_user_entity();
		
		if (elgg_is_active_plugin('messages') && $plugin->show_icon == 'no') {
			$num_messages = (int)messages_count_unread();
			if ($num_messages != 0) {
				$text .= "<span class=\"messages-new\">$num_messages</span>";
			}							
			elgg_register_menu_item('topbar', array(
				'name' => 'messages',
				'href' => 'messages/inbox/' . elgg_get_logged_in_user_entity()->username,
				'text' => $text . elgg_echo('messages'),
				'priority' => 1,
				'section' => 'alt',
			));
		}
		if ($plugin->show_icon == 'no') {	
			elgg_register_menu_item('topbar', array(
				'name' => 'friends',
				'text' => elgg_echo('friends'),
				'href' => "/friends/$user->username",
				'priority' => 2,
				'section' => 'alt',
			));	
		}
		if (elgg_is_active_plugin('dashboard')) {
			elgg_register_menu_item('site', array(
				'name' => 'dashboard',
				'href' => 'dashboard',
				'text' => elgg_echo('dashboard'),
			));
		}
		if (elgg_is_active_plugin('reportedcontent')) {
			elgg_unregister_menu_item('footer', 'report_this');
		
			$href = "javascript:elgg.forward('reportedcontent/add'";
			$href .= "+'?address='+encodeURIComponent(location.href)";
			$href .= "+'&title='+encodeURIComponent(document.title));";
				
			elgg_register_menu_item('extras', array(
				'name' => 'report_this',
				'href' => $href,
				'text' => elgg_view_icon('report-this'),
				'title' => elgg_echo('reportedcontent:this:tooltip'),
				'priority' => 100,
			));
		}	
	}
}
