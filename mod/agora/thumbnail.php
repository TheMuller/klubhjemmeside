<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author slyhne
 * @copyright slyhne 2010-2011
 * @link www.zurf.dk/elgg
  */

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get file GUID
$classfdguid = (int) get_input('classfdguid', 0);

$classfd = get_entity($classfdguid);
if (!$classfd || $classfd->getSubtype() != "agora") {
	exit;
}
//print_r($classfd);

// Get owner
$owner = $classfd->getOwnerEntity();

//print_r($owner);

// Get the size
$size = strtolower(get_input('size'));
if (!in_array($size,array('large','medium','small','tiny','master'))) {
    $size = "medium";
}

// Use master if we need the full size
if ($size == "master") {
    $size = "";
}

// Try and get the icon
$filehandler = new ElggFile();
$filehandler->owner_guid = $owner->guid;
$filehandler->setFilename("agora/" . $classfd->guid . $size . ".jpg");
		
$success = false;
if ($filehandler->open("read")) {
    if ($contents = $filehandler->read($filehandler->size())) {
        $success = true;
    } 
}


if (!$success) {
	$path = elgg_get_site_url() . "mod/agora/graphics/noimage{$size}.png";
	header("Location: $path");
	exit;
}

header("Content-type: image/jpeg");
header('Expires: ' . date('r',time() + 864000));
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: " . strlen($contents));

$splitString = str_split($contents, 1024);

foreach($splitString as $chunk) {
	echo $chunk;
}

