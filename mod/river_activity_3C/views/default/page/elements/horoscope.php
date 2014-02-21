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

$title = elgg_echo('river_activity_3C:horoscope');
$box_view = elgg_get_plugin_setting('view_riverbox', 'river_activity_3C');

$river_body = '<marquee direction="left" scrollamount="2" onmouseover="stop()" onmouseout="start()" style="overflow:hidden;"><iframe src="http://www.eastrolog.com/webmaster-new/daily-horoscope/webmaster-horoscope-1.php" name="Daily_Horoscopes_720x85" width="720" height="85" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" title="Daily Horoscopes 720x85"></iframe></marquee>';
echo elgg_view_module($box_view, $title, $river_body);
?>