<?php
/**
 * ?Image display
 *
 * @package ElggGroups
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

global $CONFIG;
	$img_name = get_input('filename','');
	$location = $CONFIG->dataroot."image_slider/".$img_name;
	$contents = @file_get_contents($location);

header("Content-type: image/jpeg");
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+10 days")), true);
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: " . strlen($contents));
echo $contents;
