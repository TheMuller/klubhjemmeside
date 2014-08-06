<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

// chech if user is loggedin
if (!elgg_is_logged_in()) forward();

$guid = get_input('guid');
$agora = get_entity($guid);

if (elgg_instanceof($agora, 'object', 'agora') && $agora->canEdit()) {
    $container = $agora->getContainerEntity();

	$prefix = "agora/".$guid;
		
	$tiny = $prefix."tiny.jpg";
	$small = $prefix."small.jpg";
	$medium = $prefix."medium.jpg";
	$large = $prefix."large.jpg";
	$master = $prefix.".jpg";
				
	if ($tiny) {
		$delfile = new ElggFile();
		$delfile->owner_guid = $owner->guid;
		$delfile->setFilename($tiny);
		$delfile->delete();
	}
	
	if ($small) {
		$delfile = new ElggFile();
		$delfile->owner_guid = $owner->guid;
		$delfile->setFilename($small);
		$delfile->delete();
	}

	if ($medium) {
		$delfile = new ElggFile();
		$delfile->owner_guid = $owner->guid;
		$delfile->setFilename($medium);
		$delfile->delete();
	}

	if ($large) {
		$delfile = new ElggFile();
		$delfile->owner_guid = $owner->guid;
		$delfile->setFilename($large);
		$delfile->delete();
	}

	if ($master) {
		$delfile = new ElggFile();
		$delfile->owner_guid = $owner->guid;
		$delfile->setFilename($master);
		$delfile->delete();
	}
				    
    if ($agora->delete()) {
        system_message(elgg_echo("agora:delete:success"));
        if (elgg_instanceof($container, 'group')) {
                forward("agora/group/$container->guid/all");
        } else {
                forward("agora/owner/$container->username");
        }
    }
}

register_error(elgg_echo("agora:delete:failed"));
forward(REFERER);
