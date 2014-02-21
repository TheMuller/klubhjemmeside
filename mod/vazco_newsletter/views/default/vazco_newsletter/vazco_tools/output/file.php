<?php 
	//this view is here, since paths in vazco_tools are replaced while being built
	global $CONFIG;
	$entity = $vars['entity'];
	$name = $vars['name'];
	$wrap = $vars['wrap'];
	$path = $CONFIG->wwwroot.'mod/vazco_tools/views/default/vazco_tools/output/file_content.php?guid='.$entity->guid.'&name='.$name;
	if ($wrap){
		if ($entity->$name){
			$title = sprintf(elgg_echo('vazco_tools:download'), $entity->$name);
			echo "<a class='tools_file' href='{$path}'>{$title}</a>";
			echo "<div class='clearfloat'></div>";
		}else{
			echo elgg_echo('vazco_tools:nofile');
		}
	}else{
		echo $path;
	}
?>