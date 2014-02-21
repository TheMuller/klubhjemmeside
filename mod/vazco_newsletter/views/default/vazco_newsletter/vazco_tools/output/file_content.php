<?php
	/**
	 * Elgg file download.
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) . "/engine/start.php");

	// Get the guid
	$guid = get_input('guid');
	$name = get_input('name');
	$entity = get_entity($guid);
	
	$filehandler = vazco_tools::getFileFilehandler($entity, $name);
	
	if ($filehandler) {
		$mime = $filehandler->getMimeType();
		if (!$mime) {
			$mime = "application/octet-stream";			
		}
		
		$filename = $entity->$name;
		
		// fix for IE https issue 
		header("Pragma: public");
		header("Content-type: $mime");
		if (strpos($mime, "image/")!==false)
			header("Content-Disposition: inline; filename=\"$filename\"");
		else
			header("Content-Disposition: attachment; filename=\"$filename\"");

		$contents = $filehandler->grabFile();
		$splitString = str_split($contents, 8192);
		foreach($splitString as $chunk)
			echo $chunk;
		exit;
	} else {
		register_error(elgg_echo("file:downloadfailed"));
		forward($_SERVER['HTTP_REFERER']);
	}
?>