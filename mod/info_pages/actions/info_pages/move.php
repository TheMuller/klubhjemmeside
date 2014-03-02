<?php
/**
 * Change the position of a page
 *
 * @package ElggPages
 */

elgg_load_library('elgg:info_pages');

$direction = get_input('direction');

$page_guid = get_input('page_guid');

$page = get_entity($page_guid);


if(info_pages_change_order($page_guid, $direction)){
	
	system_message(elgg_echo('info_pages:saved'));


	forward(REFERER);
	
} else {
	register_error(elgg_echo('info_pages:error:no_save'));
	forward(REFERER);
}

//if below, we haveto +1 to the 'orderno' of each page BELOW this one

//if above, we have to -1 to the 'orderno' of each page ABOVE this one