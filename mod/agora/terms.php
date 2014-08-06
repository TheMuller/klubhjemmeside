<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$terms_of_use = elgg_get_plugin_setting('terms_of_use', 'agora');

echo "<h3>".elgg_echo('agora:settings:terms_of_use')."</h3>";
echo "<div style='width:300px;'>".$terms_of_use."</div>";
echo "<br/>";
?>

