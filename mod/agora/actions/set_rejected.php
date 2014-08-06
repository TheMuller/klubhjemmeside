<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');

$interest_guid = get_input('interest_guid');
if (!$interest_guid) {	// if not interest guid
	$errmsg = elgg_echo('agora:set_rejected:interest_guid_missing');
}

$interest = get_entity($interest_guid);
if (!elgg_instanceof($interest, 'object', 'agorainterest')) {	// if not agora interest entity
	$errmsg = elgg_echo('agora:set_rejected:interest_entity_missing');
}

// get classified entity
$classfd = get_entity($interest->int_ad_guid);
if (!elgg_instanceof($classfd, 'object', 'agora')) {	// if not agora interest entity
	$errmsg = elgg_echo('agora:set_rejected:agora_entity_missing');
}

if ($errmsg)	{
	register_error($errmsg);
}
else
{
	if ($classfd->canEdit())	{
		$interest->int_status = AGORA_INTEREST_REJECTED;
		
		if ($interest->save()) {
			system_message(elgg_echo("agora:set_rejected:success"));
		}
		else {
			register_error(elgg_echo("agora:set_rejected:failed"));
		}	
	}
	else  {
		register_error(elgg_echo("agora:set_rejected:novalidaccess"));
	}
}

forward(REFERER);
