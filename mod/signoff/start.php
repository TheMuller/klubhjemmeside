<?php
/***************************************************************************
	*                            TwizaNex Smart Community Software
	*                            ---------------------------------
	*  Twizanex logout landing page for Elgg 1.8.X
    *	
	*     begin                : Mon Mar 23 2011
	*     copyright            : (C) 2011 TwizaNex Group
	*     website              : http://www.TwizaNex.com/
	* This file is part of TwizaNex - Smart Community Software
	*
	* @package Twizanex
	* @link http://www.twizanex.com/
	* TwizaNex is free software. This work is licensed under a GNU Public License version 2. 
	* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
	* @author Tom Ondiba <twizanex@yahoo.com>
	* @copyright Twizanex Group 2011
	* TwizaNex is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
	* without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	* See the GNU Public License version 2 for more details. 
	* For any questions or suggestion write to write to twizanex@yahoo.com
	***************************************************************************/

	elgg_register_event_handler('logout', 'user', $user);
	elgg_register_event_handler('init','system','signoff_init');

function signoff_init() {  
    //  if the user is already logged in...No need to check or load the staff bellow.. 
	//this is designed with the site performance in mind :)
    if (elgg_is_logged_in()) return;

	// Register sigoff page to have nice url
	elgg_register_page_handler('signoff', 'signoff_page_handler');
	//	Set Context 'signoff'
	elgg_set_context ('signoff');
}		
    //extend some views CSS 
	elgg_extend_view('css/elements/modules', 'signoff_css/fbx_modul');
    elgg_extend_view('css/elgg', 'signoff_css/css');
	
	$event_logout = elgg_trigger_event('logout', 'user', $user) ;

function signoff_page_handler($page) {

	if (!$event_logout) {
	if (elgg_get_context() == 'signoff'){
	//Lets get the plugin settings set by admin
	$adverts_sigoffads_page = elgg_get_plugin_setting('show_sigoffads_page','signoff');
    $sigoffads_adverts_header = elgg_get_plugin_setting('show_sigoffads_header','signoff');
	$sigoffads_by_admin = elgg_get_plugin_setting('show_sigoffads_byadmin','signoff');
	$copyright_in_signoffpage = elgg_get_plugin_setting('show_copyright_sigoff','signoff');
	
	$site = elgg_get_site_entity();
	$site_name = $site->name;
	//grab the login form
	$login = elgg_view("core/account/login_box");
	// check if admin has allowed ads to run
	if ($adverts_sigoffads_page == yes) {
	if ($sigoffads_adverts_header == yes) {
	$signoffkichwa = elgg_view('page/elements/titles/headbodytitle'); //want this to be on top of all adverts of the list no matter what!
	}
	if ($sigoffads_by_admin == yes) {
	$signoffmwili = elgg_view('page/elements/signoff-ads-byadmin'); //Ad by from admin section!
	}
	$signoffonamwili = elgg_view('page/elements/load_ad/lodbody'); 
	if ($copyright_in_signoffpage == yes) {
    $jinausiguzeka = elgg_view('page/elements/copyright/body'); 
	}
    }
    $jinaletuduto = elgg_view('spring/elements/bodyfooter');
	$title = elgg_echo('signoffpage:logout:title');
	$body = '<div class="contentWrapper">' . elgg_echo('signoffpage:logout:description') . '</div>' ;
	$content = elgg_view_layout('one_sidebar', array(
	'title' =>  $site_name.$title,
	'content' => $body. $signoffkichwa. $signoffmwili. $signoffonamwili. $jinaletuduto. $jinausiguzeka,
	'sidebar' => $login,
    ));
	echo elgg_view_page($title, $content);
	
	// Logs a user out.
	// Triggers the "logout" event on the client
	return true;
	}}
	}
	
    // Here we are forcing the elgg action redirect page 'activity' or "Default or Homepage" to be overiden by our page....	
   // This one will make sure we are not getting paga not found error after the user has logged out of the site...
function signoffpage_init() {
	// Load system configuration
	//global $CONFIG;

    // If the user is already logged in...No need to check or load the staff bellow.. 
    //  this is designed with the site performance :)
    if (elgg_is_logged_in()) return;
	
	// Load the language files
	//register_translations($CONFIG->pluginspath . "signoff/languages/");
    }
    // override the default 'default homepage url for all Themes to view a signoff object :) This is fun!!!!!!!!!
	// register actions // TM: code
	$action_path = elgg_get_plugins_path() . 'signoff/actions';
	elgg_register_action('logout', "$action_path/logout.php");

	elgg_register_event_handler('init', 'system', 'signoffpage_init');


