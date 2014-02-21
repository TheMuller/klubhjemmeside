<?php
	/*
		 Link to this view to display icon. Possible parameters are:
		 size: 'large','medium','small','tiny','master','topbar'
		 name: field name
		 showDefault: wether to show default icon in case standard icon is not found
		 guid: entity guid	 
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))))) . "/engine/start.php");
	
	global $CONFIG;
	$name = get_input('name',"image");
	$showDefault = get_input('showDefault',true);
	$entity_guid = get_input('guid');
	$size = get_input('size');

	$contents = vazco_tools::getImageContent($entity_guid, $size, $name, $showDefault);
	
	
	header("Content-type: image/jpg");
	header('Expires: ' . date('r',time() + 864000));
	header("Pragma: public");
	header("Cache-Control: public");
	header("Content-Length: " . strlen($contents));
	echo $contents;
?>