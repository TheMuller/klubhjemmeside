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

// Get the specified classfied post
$classfdguid = (int) get_input('classfdguid');

$classfd = get_entity($classfdguid);
if (!$classfd || $classfd->getSubtype() != "agora") {
	exit;
}


$classfd_img = elgg_view('output/url', array(
    'href' => "agora/view/{$classfd->guid}/" . elgg_get_friendly_title($classfd->title),
    'text' => elgg_view('agora/thumbnail', array(
        'classfdguid' => $classfd->guid,
        'size' => 'master',
        'class' => 'agora-image-popup',
    )),
));
			
echo "<p style='width: 600px;'>";
echo "<h3>{$classfd->title}</h3>";
echo $classfd_img;
echo "</p><br>";

