<?php
/*
 *
 * Plugin Elgg Responsive
 *
 * @author Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2013, Elggzone
 *
 * @link http://www.perjensen-online.dk/
 *
 */
 
elgg_register_event_handler('init','system','responsive_init');
 
function responsive_init() {

	elgg_register_event_handler('pagesetup', 'system', 'responsive_pagesetup_handler', 1000);

	elgg_extend_view('page/elements/head','responsive/meta', 1);
	elgg_extend_view('css/elgg', 'responsive/css');
	elgg_extend_view('css/walled_garden', 'responsive/css');
	
	elgg_register_js('respond', 'mod/responsive/vendors/js/respond.js');
	elgg_load_js('respond');
	elgg_register_js('responsive', 'mod/responsive/vendors/js/responsive.js', 'footer');
	elgg_load_js('responsive');

	elgg_unregister_js('elgg.friendspicker');
}

function responsive_pagesetup_handler() {
	
	// Extend footer with copyright
	$year = date('Y');	
	$href = "http://www.perjensen-online.dk";
	elgg_register_menu_item('footer', array(
		'name' => 'copyright_this',
		'href' => $href,
		'title' => elgg_echo('responsive:tooltip'),
		'text' => elgg_echo('responsive:copyright') . $year . elgg_echo(' Elggzone'),
		'priority' => 1,
		'section' => 'alt',
	));
}
