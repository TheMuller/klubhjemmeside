<?php
	/*
	 
	 Launch this view in a file you want to use as an icon file. Use the following code:
	  
	 require_once(dirname(dirname(__FILE__)) . "/engine/start.php"); //here use the proper path to the start file  
	 echo elgg_view($pluginName.'/tools/output/icon'); 
	 
	 Later, invoke the icon by a link:
	   
	 www.yoursitepath.com/pathtoyouriconfile?guid=GUIDOFICONSENTITY&size=POSSIBLESIZE
	 
	 where possible sizes are: 'large','medium','small','tiny','master','topbar'
	 
	 */

	require_once(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))))) . "/engine/start.php");

	global $CONFIG;
	$name = get_input('name','image');
	$num = get_input('num',null);
	if ($num){
		$fullname = $name.'_'.$num;
	}else{
		$fullname = $name;
	}
	$guid = get_input('guid');
	$entity = get_entity($guid);
	$size = get_input('size','large');

	$pic = elgg_view('vazco_newsletter/vazco_tools/output/icon',array('entity'=>$entity,'name' => $fullname ,'size'=>$size));
	$filehandler = vazco_tools::getFilehandler($guid, $fullname, $size);

	$path = $filehandler->getFilenameOnFilestore();	
	list($width, $height, $type, $attr) = getimagesize($path);

	$title = elgg_translate($entity,'title');
	if (!$title){
		$title = elgg_translate($entity,'name');
	}
	if (!$title)
		$title = "";
	$title = "{$title}: {$fullname}";
	$pic="<img alt='{$title}' title='{$title}' border=\"0\" src=\"{$pic}\"/ style='width:{$width}px;height:{$height}px;'>";
	echo "<div>".$pic."</div>";

?>
