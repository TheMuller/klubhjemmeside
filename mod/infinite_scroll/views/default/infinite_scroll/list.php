<?php

$path = explode('/', $vars['path']);
array_shift($path);

if ($is_gallery = get_input('list_type')) {
	set_input('list_type', 'list');
}

// Check this when #4723 closed.
if ($path[0] == '') {
	$path[0] = 'activity';
}

ob_start();
elgg_set_viewtype('json');
page_handler(array_shift($path), implode('/', $path));
elgg_set_viewtype('default');
$out = ob_get_contents();
ob_end_clean();

$json = json_decode($out);
switch(get_input('items_type')){
	case 'entity':
		foreach ($json as $child) foreach ($child as $grandchild) $json = $grandchild;
		
		/* Removing duplicates
		   This is unnecessary when #4504 is fixed. */
		if (version_compare(get_version(true), '1.8.7', '<')) {
			$buggy = $json;
			$json = array();
			$guids = array();
			foreach ($buggy as $item) {
				$guids[] = $item->guid;
			}
			$guids = array_unique($guids);
			foreach (array_keys($guids) as $i) {
				$json[$i] = $buggy[$i];
			}
		}
		break;
	case 'annotation': 
		foreach ($json as $child) {
			$json = $child;
		}
		$json = elgg_get_annotations(array(
			'items' => $json->guid,
			'offset' => get_input('offset'),
			'limit' => 25,
		));
		break;
	case 'river':
		$json = $json->activity;
		break;
}

if (!is_array($json)) {
	exit();
}

$items = array();
foreach($json as $item) {
	switch(get_input('items_type')) {
		case 'entity':
			switch($item->type) {
				case 'site':
					$items[] = new ElggSite($item);
					break;
				case 'user':
					$items[] = new ElggUser($item);
					break;
				case 'group':
					$items[] = new ElggGroup($item);
					break;
				case 'object':
					$items[] = new ElggObject($item);
					break;
			}
			break;
		case 'annotation': 
			$items = $json;
			break;
		case 'river':
			$items[] = new ElggRiverItem($item);
			break;
	}
}
header('Content-type: text/plain');
if (!$is_gallery) {
	echo elgg_view('page/components/list', array("items" => $items));
} else {
	echo elgg_view('page/components/gallery', array("items" => $items));
}

