<?php
/***************************************************************************
	*                            TwizaNex Smart Community Software
	*                            ---------------------------------
	*  Twizanex logout landing page for Elgg 1.8.X
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

	// The Context the user will be forwarded to
	$forwardpls_path =  'signoff';
	// Log out function
	$result = logout();
	// Set the system_message as appropriate
	
	if ($result)
	{
	system_message(elgg_echo('logoutok'));
	
    // forward the user to the new url
	forward(elgg_get_site_url() ."$forwardpls_path");

	// prevent code execution after the forward
    exit;
	}
	else
	{
	register_error(elgg_echo('logouterror'));
	}
