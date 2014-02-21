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


?>

/********************************
Signoutpage admin announcement
************************************/

#ads-sidebar-alt {
padding : 0px ;
text-align : center;
width : auto;
overflow: hidden;
}

/*************
sigoutpage Header
**************/
#ads-header {
width : auto;
height : auto;
padding : 3px ;
border : 1px solid black;
overflow: hidden;
position: relative;
}

/*****************************
 *
 ******************************/
 
.fboonex-juu-kushoto {
	margin-bottom: 1px;	
}
.fboonex-juu-kushoto > .fboonex-motwe {
	background-color: #F2F2F2;
	border-bottom: none;
	border-top: solid 1px #E2E2E2;
	padding: 4px 5px 5px;
	margin-bottom: 5px;	
}
.fboonex-juu-kushoto > .fboonex-motwe > h3 {
	font-size: 1em;
}

 /*****************************
 * twizakuja_signoutpage 
 ******************************/
 
.fboonex-juu-kando {
	margin-bottom: 1px;	
}
.fboonex-juu-kando > .fboonex-kichwa {
	background-color: #F2F2F2;
	border-bottom: none;
	border-top: solid 1px #E2E2E2;
	padding: 4px 5px 5px;
	margin-bottom: 5px;	
}

.fboonex-juu-kando > .fboonex-kichwa > h3 {
	font-size: 1em;
}

/*****************************
 * Aside : headtitle_ad_signoutpage:
 ******************************/
 
.fboonex-juu-hapa {
	margin-bottom: 1px;	
	
}
.fboonex-juu-hapa > .fboonex-omotwe {
	background-color: #F2F2F2;
	border-bottom: none;
	border-top: solid 1px #E2E2E2;
	padding: 1px 5px 1px;
	margin-bottom: 5px;	
}

.fboonex-juu-hapa > .fboonex-omotwe > h3 {
	font-size: 1em;
}
/* mwisho*/

/* ***************************************
	module : headtitle_signoutpage:
*************************************** */
.fboonex-right-sideads {
	border: 0px solid #fff;
	-webkit-border-radius: 1px;
	-moz-border-radius: 1px;
	border-radius: 1px;
}
.fboonex-right-sideads > .fboonex-motwee {
	/*padding: 5px;*/
	background-color: #fff;
}
.fboonex-right-sideads > .fboonex-motwee * {
	color: gray; 
	float: left;
	margin: 0.3em 0.25em 0.24em 0;
	list-style: none;
	font-weight:normal;
	font-size:11px;
}

/****************************************
* This is the line separator 
*******************************************/

a.tielok {
	margin: 0px;
	 height:1px;
	/*width: auto;*/
	/*color: #333;*/
	font-weight: normal;
	font-size: 11px;
	background: white url(<?php echo $vars['url']; ?>mod/signoff/graphics/bg-signoff.jpg);
	background-repeat:repeat-x;
	/*border: 1px solid #dedede;*/
	display:block;
}
a.tielok:hover {
	color: #333;
	text-decoration: none;
	border: 0px solid #333;
}

/****************************************
* TM: This is the signoffpage body font title 
*******************************************/

#is_signoff {
 background: #dedede;
 padding: 10px;
}
#is_signoff p {
 font-size: 12px;
}

a.is_signoff_support {
 margin: 5px;
 padding: 5px;
 float: right;
 clear: both;
 font-weight: bold;
 background: #f4f4f4;
 -webkit-border-radius: 6px;
 -moz-brder-radius: 6px;
 border-radius: 6px;
}