<?php
/***************************************************************************
	*                            TwizaNex Smart Community Software
	*                            ---------------------------------
	*  Twizanex logout landing page Copyright at the body footer for Elgg 1.8.X
    *	
	*     begin                : Mon Mar 23 2011
	*     copyright            : (C) 2011 TwizaNex Group
	*     website              : http://www.TwizaNex.com/
	* This file is part of TwizaNex - Smart Community Software
	*
	* @package Twizanex
	* @link http://www.twizanex.com/
	* TwizaNex is free software. This work is licensed under a GNU Public License version 2. 
	* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
	* @author Tom Ondiba <twizanex@yahoo.com>
	* @copyright Twizanex Group 2011
	* TwizaNex is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
	* without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	* See the GNU Public License version 2 for more details. 
	* For any questions or suggestion write to write to twizanex@yahoo.com
	***************************************************************************/

// copyright section

$title = elgg_echo('signoffpage:rights:reserved');
$year = elgg_echo('signoffpage:copyright:year');
$sign = elgg_echo('signoffpage:copyright:sign');
$site = elgg_get_site_entity();
$site_name = $site->name;
echo elgg_view_menu('body', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

    	
?>

<a href="<?php echo $vars['url']; ?>"><?php echo $site_name; ?></a><?php echo $sign; ?><?php ?> <?php echo $year; ?><?php ?><?php echo $title; ?>