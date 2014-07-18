<?php
/*Checklist plugin*/

elgg_register_event_handler('init', 'system', 'checklist_init');

function checklist_init($event, $type, $object) {
	elgg_register_page_handler('checklist', 'checklist_page_handler');
}

function checklist_page_handler($page) {
	
		include elgg_get_plugins_path()."checklist/views/default/page/cat_list.php";
		$body = elgg_view_layout('one_column', array('content' => $content));
		echo elgg_view_page('Checklist', $body);
	return true;
}
?>