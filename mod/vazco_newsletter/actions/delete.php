<?php //ł ?><?php
	global $CONFIG;
	$guid = get_input('guid');//guid of entity that is going to be deleted
	$container=get_entity($entity->container_guid);//gets container ie. group or user 
	$entity = get_entity($guid);
	$user_guid=get_loggedin_userid();
	if(get_entity($container) instanceof ElggGroup){//if entity from group deleted forward to group listing
		$forward = ("{$CONFIG->wwwroot}pg/newsletter/grouplisting/{$entity->container_guid}");//forward to group listing of entities
	}else{
		if($entity->owner_guid == get_loggedin_userid()){//if you delete your own entity forward to your listing
			$forward = ("{$CONFIG->wwwroot}pg/newsletter/userlisting/{$user_guid}");//forward to  user listing of entities
		}else{//else its admin - deleted entity of differen user - forward to listing of all entities
			$forward = ("{$CONFIG->wwwroot}pg/newsletter/listing");//forward to  user listing of entities
		}
	}
	//set input guid
	elgg_view('vazco_newsletter/vazco_tools/actions/delete',array(
		'forward' => $forward,
		'subtype'=>'newsletter', 
		'messageSuccess' => elgg_echo('vazco_newsletter:deleted'),
		'messageFailure' => elgg_echo('vazco_newsletter:notdeleted'),
		)
	);
?>
