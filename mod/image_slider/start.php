<?php
/**
 * Elgg Pages
 *
 * @package ElggPages
 */

elgg_register_event_handler('init', 'system', 'image_slider_init');

/**
 * Initialize the pages plugin.
 *
 */
function image_slider_init() {
		$action_path = elgg_get_plugins_path().'image_slider/actions/image_slider';
		elgg_register_admin_menu_item('configure', 'image_slider', 'appearance');
		elgg_register_action("image_slider/delete", "$action_path/delete.php");
}

