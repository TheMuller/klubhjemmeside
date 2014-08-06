<?php
/*
 *
 * Elgg Admin Panel
 *
 * @author Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2014, Elggzone
 *
 * @link http://www.perjensen-online.dk/
 *
 */

elgg_register_event_handler('init','system','admin_panel_init');
 
function admin_panel_init() {
		
	elgg_register_event_handler('pagesetup', 'system', 'admin_panel_pagesetup_handler', 1000);
}

/**
 * Handles meta required for admin panel
 *
 */
function admin_panel_pagesetup_handler() {
	
	if (elgg_in_context('admin')) {
		elgg_extend_view('page/elements/head', 'admin_panel/meta', 1);
	}
}
