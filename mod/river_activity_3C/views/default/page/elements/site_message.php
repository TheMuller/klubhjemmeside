<?php 
	/*
	 * 3 Column River Acitivity
	 *
	 * @package ElggRiverDash
	 * Full Creadit goes to ELGG Core Team for creating a beautiful social networking script
	 *
         * Modified by Satheesh PM, BARC, Mumbai, India..
         * http://satheesh.anushaktinagar.net
         *
	 * @author ColdTrick IT Solutions
	 * @copyright Coldtrick IT Solutions 2009
	 * @link http://www.coldtrick.com/
	 * @version 1.0
         *
         */

?>

<?php
$messages  = elgg_get_plugin_setting('system_messages',  'river_activity_3C');
$title = elgg_echo('river_activity_3C:system_message');

$river_body = '<div id="site_messages">'.$messages.'</div>';
$river_body .= elgg_view('page/elements/controls');

echo elgg_view_module('popup', $title, $river_body);
?>
