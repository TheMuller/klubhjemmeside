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
                                
 admin_gatekeeper();  // just to be sure...
 
?>
<p align="justify">
<br />
<b>Introducing a powerful and faster logout page for Elgg sites just like facebook. It works for almost all themes for elgg 1.8. It is a major boost for AdSense and Adsese ads</b>
<br /><br />

<b><font color="blue"> Site Announcement by Admin in signoff Page is good for short site Announcements, like site maintenance, terms and privacy changes and many more.</font></b>
<br /><br />

Do you want to show your Ads on signoff Page ? : <select name="params[show_sigoffads_page]">
<option value="yes" <?php if ($vars['entity']->show_sigoffads_page == "yes") echo " selected=\"yes\" "; ?>>Yes</option>
<option value="no" <?php if ($vars['entity']->show_sigoffads_page == "no") echo " selected=\"yes\" "; ?>>No</option>
</select>
<!-- TM: hapa mwisho                     -->
<br /><br />
Do you want to show Ads Title in signoff Page ? : <select name="params[show_sigoffads_header]">
<option value="yes" <?php if ($vars['entity']->show_sigoffads_header == "yes") echo " selected=\"yes\" "; ?>>Yes</option>
<option value="no" <?php if ($vars['entity']->show_sigoffads_header == "no") echo " selected=\"yes\" "; ?>>No</option>
</select>
<br />

<br /><br />
Do you want to show Site Announcement by Admin in signoff Page ?: <select name="params[show_sigoffads_byadmin]">
<option value="yes" <?php if ($vars['entity']->show_sigoffads_byadmin == "yes") echo " selected=\"yes\" "; ?>>Yes</option>
<option value="no" <?php if ($vars['entity']->show_sigoffads_byadmin == "no") echo " selected=\"yes\" "; ?>>No</option>
</select>
<br />
If your answer to show Site Announcement by Admin in signoff Page was YES, you can put, paste or type Your Announcement here to show in signoff Page: <br />
<?php
echo elgg_view('input/plaintext', array('name' => "params[sigoff_ads_byadmin]", 'value' => $vars['entity']->sigoff_ads_byadmin));
?>
<br /><br />

<br /><br />
Do you want to show Copyright and All rights reserved in in the logout page footer ?:<select name="params[show_copyright_sigoff]">
<option value="yes" <?php if ($vars['entity']->show_copyright_sigoff == "yes") echo " selected=\"yes\" "; ?>>Yes</option>
<option value="no" <?php if ($vars['entity']->show_copyright_sigoff == "no") echo " selected=\"yes\" "; ?>>No</option>
</select>
<br />
<br /><br />

<b><font color="green">If this pluggin is helpful to you, please do a recommendation so that it can be useful to others.</font></b>
<br /><br />
<br> Elgg website pages can now load as much as a second faster than before.Your visitors will experience a noticeable improvement in the loading speed of your webpages!<br />
<b><font color="green"> And it doesn&rsquo;t stop here, as we&rsquo;ll keep working to make things even faster. Continue to grow your site and AdSense inventory. Swift and sure, we&rsquo;ll do our best to keep up..</font></b>
<br /><br />
<b><font color="red">&ldquo;As we enjoy great advantages from inventions of others, we should be glad of an opportunity to serve others by any invention of ours; and this we should do freely and generously.&rdquo; Benjamin Franklin.</font></b>
<br /></p>