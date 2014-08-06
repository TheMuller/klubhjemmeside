<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author slyhne
 * @copyright slyhne 2010-2011
 * @link www.zurf.dk/elgg
  */

$classfdguid = $vars['classfdguid'];
$size =  $vars['size'];
$class = $vars['class'];
$tu = $vars['tu'];
$direct = $vars['direct'];

if ($direct) {
	echo elgg_get_site_url() . 'mod/agora/thumbnail.php?classfdguid='.$classfdguid.'&size='.$size.'&ut='.$tu;
}
else {
	//echo "<img src='" . elgg_get_site_url() . "mod/agora/thumbnail.php?classfdguid={$classfdguid}&size={$size}&ut={$tu}' class='elgg-photo $class'>";
	echo '<img src="' . elgg_get_site_url() . 'mod/agora/thumbnail.php?classfdguid='.$classfdguid.'&size='.$size.'&ut='.$tu.'" class="elgg-photo '.$class.'">';
}
