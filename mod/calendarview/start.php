<?php
/**
 * @package ElggCalendarView
 * Elgg calendarview plugin
 */

elgg_register_event_handler('init', 'system', 'calendarview_init');

/**
 * CalendarView plugin initialization functions.
 */
function calendarview_init() {

	// register a library of helper functions
	elgg_register_library('elgg:calendarview', elgg_get_plugins_path() . 'calendarview/lib/calendarview.php');

	// Site navigation
	$item = new ElggMenuItem('calendarview', elgg_echo('calendarview'), 'calendarview/all');
	elgg_register_menu_item('site', $item); 
        
        // unregister event_calendar menu item.
        //elgg_unregister_menu_item('site', event_calendar);

	// Extend CSS
	elgg_extend_view('css/elgg', 'calendarview/css');

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('calendarview', 'calendarview_page_handler');
   
}

/**
 * Dispatches calendarview pages.
 * URLs take the form of
 * Events calendar:        calendarview/all
 *  
 * @param array $page
 * @return bool
 */

function calendarview_page_handler($page) {

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	$file_dir = elgg_get_plugins_path() . 'calendarview/pages/calendarview';

	$page_type = $page[0];
	switch ($page_type) {
		case 'owner':
                    include "$file_dir/owner.php";   
                    break; 
		case 'friends':
                    include "$file_dir/friends.php";
                    break;       
		case 'group':
                    include "$file_dir/owner.php";
                    break;     
		case 'all':
                    include "$file_dir/world.php";
                    break;  
		default:
			return false;
	}
	return true;
}
