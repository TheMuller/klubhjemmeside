<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

$object = $vars['item']->getObjectEntity();
$excerpt = elgg_get_excerpt($object->description);

$image = elgg_view('output/url', array(
	'href' => $object->getURL(),
	'text' => elgg_view('agora/thumbnail', array('classfdguid' => $object->guid, 'size' => 'small', 'tu' => $tu)),
));

$message = '<div style="float:left; margin-right: 5px;">'.$image.'</div>'.$excerpt;


echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $message,
	'attachments' => elgg_view('output/url', array('href' => $object->address)),
));

