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
<p align="justify"><?php echo elgg_echo('river_activity_3C:thankyou'); ?></p>
<br />
<table width="80%">
<tr>
<td><?php echo elgg_echo('river_activity_3C:riverbox'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[view_riverbox]">
<option value="featured" <?php if ($vars['entity']->view_riverbox == "featured") echo " selected=\"featured\" ";?>><?php echo elgg_echo('river_activity_3C:featured'); ?></option>
<option value="info" <?php if ($vars['entity']->view_riverbox == "info") echo " selected=\"featured\" ";?>><?php echo elgg_echo('river_activity_3C:info'); ?></option>
<option value="aside" <?php if ($vars['entity']->view_riverbox == "aside") echo " selected=\"featured\" ";?>><?php echo elgg_echo('river_activity_3C:aside'); ?></option>
<option value="popup" <?php if ($vars['entity']->view_riverbox == "popup") echo " selected=\"featured\" ";?>><?php echo elgg_echo('river_activity_3C:popup'); ?></option>
</select>
</td>
</tr>
    
<tr>
<td><?php echo elgg_echo('river_activity_3C:status'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_status]">
<option value="yes" <?php if ($vars['entity']->show_status == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_status == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td>
<?php echo elgg_echo('river_activity_3C:startdate'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/date', array('name' => "params[start_date]", 'value' => $vars['entity']->start_date));
?>
</td>
</tr>
<?php if (elgg_is_active_plugin('bookmarks')){ ?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:showbookamrk'); ?></td>
<td width="2%"> : </td>
<td><select name="params[show_bookmark]">
<option value="yes" <?php if ($vars['entity']->show_bookmark == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_bookmark == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_bookmark]", 'value' => $vars['entity']->num_bookmark));
?>
</td>
</tr>

<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actbook').'</b></font><br />';}
if (elgg_is_active_plugin('file')){ 
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:files'); ?>
</td>
<td width="2%"> : </td>
<td>
<select name="params[show_file]">
<option value="yes" <?php if ($vars['entity']->show_file == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_file == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?>
</td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_file]", 'value' => $vars['entity']->num_file));
?>
</td>
</tr>
<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actfile').'</b></font><br />';}
if (elgg_is_active_plugin('blog')){ 
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:blogs'); ?>
</td>
<td width="2%"> : </td>
<td>
<select name="params[show_blog]">
<option value="yes" <?php if ($vars['entity']->show_blog == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_blog == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?>
</td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_blog]", 'value' => $vars['entity']->num_blog));
?>
</td>
</tr>
<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actblog').'</b></font><br />';}
if (elgg_is_active_plugin('pages')){ 
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:pages'); ?>
</td>
<td width="2%"> : </td>
<td>
<select name="params[show_page]">
<option value="yes" <?php if ($vars['entity']->show_page == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_page == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_page]", 'value' => $vars['entity']->num_page));
?>
</td>
</tr>
<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actpage').'</b></font><br />';}
if (elgg_is_active_plugin('groups')){ 
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:featuredgroup'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_featured_group]">
<option value="yes" <?php if ($vars['entity']->show_featured_group == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_featured_group == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_featured]", 'value' => $vars['entity']->num_featured));
?>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:latestgroup'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_latest_group]">
<option value="yes" <?php if ($vars['entity']->show_latest_group == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_latest_group == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_newgroup]", 'value' => $vars['entity']->num_newgroup));
?>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:groupmem'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_group_membership]">
<option value="yes" <?php if ($vars['entity']->show_group_membership == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_group_membership == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_membership]", 'value' => $vars['entity']->num_membership));
?>
</td>
</tr>
<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actgroup').'</b></font><br />';}
if (elgg_is_active_plugin('members')){ 
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:resentmem'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_recent_members]">
<option value="yes" <?php if ($vars['entity']->show_recent_members == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_recent_members == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_new]", 'value' => $vars['entity']->num_new));
?>
</td>
</tr>
<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actmem').'</b></font><br />';}
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:showfriends'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_friends]">
<option value="yes" <?php if ($vars['entity']->show_friends == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_friends == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:number'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[num_friends]", 'value' => $vars['entity']->num_friends));
?>
</td>
</tr>

<?php if (elgg_is_active_plugin('profile_manager')){  ?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:birthday'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_birthday]">
<option value="yes" <?php if ($vars['entity']->show_birthday == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_birthday == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:bdaypar'); ?></td>
<td width="2%"> : </td>
<td>
<?php
echo elgg_view('input/text', array('name' => "params[birth_day]", 'value' => $vars['entity']->birth_day));
?>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:viewbday'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[view_birthday]">
<option value="icon" <?php if ($vars['entity']->view_birthday == "icon") echo " selected=\"icon\" ";?>><?php echo elgg_echo('river_activity_3C:icon'); ?></option>
<option value="list" <?php if ($vars['entity']->view_birthday == "list") echo " selected=\"icon\" ";?>><?php echo elgg_echo('river_activity_3C:list'); ?></option>
</select>
</td>
</tr>


<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actprofile').'</b></font><br />';}
if (elgg_is_active_plugin('thewire')){ 
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:wireform'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_wire]">
<option value="yes" <?php if ($vars['entity']->show_wire == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_wire == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>
<?php
}else {echo '<font color="red"><b>'.elgg_echo('river_activity_3C:actwire').'</b></font><br />';}
?>
<tr>
<td><?php echo elgg_echo('river_activity_3C:showhoro'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_horoscope]">
<option value="yes" <?php if ($vars['entity']->show_horoscope == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_horoscope == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:onlinemem'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_online_members]">
<option value="yes" <?php if ($vars['entity']->show_online_members == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_online_members == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:onlinefriends'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_friends_online]">
<option value="yes" <?php if ($vars['entity']->show_friends_online == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_friends_online == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:profile'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_profile]">
<option value="yes" <?php if ($vars['entity']->show_profile == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_profile == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:sysmsg'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[show_system_messages]">
<option value="yes" <?php if ($vars['entity']->show_system_messages == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->show_system_messages == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
<td>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:sysmsgext'); ?></td>
<td width="2%"> : </td>
<td>
<select name="params[extend_sitemsg]">
<option value="yes" <?php if ($vars['entity']->extend_sitemsg == "yes") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:yes'); ?></option>
<option value="no" <?php if ($vars['entity']->extend_sitemsg == "no") echo " selected=\"yes\" ";?>><?php echo elgg_echo('river_activity_3C:no'); ?></option>
</select>
</td>
<td>
</td>
</tr>

<tr>
<td><?php echo elgg_echo('river_activity_3C:sysmsgtxt'); ?></td>
<td width="2%"> : </td>
<td>
 
</td>
</tr>
</table>
<br />
<p align="justify">
<?php echo elgg_echo('river_activity_3C:sysmsginfo'); ?></td>
</p>
<?php
echo elgg_view("input/plaintext", array("name" => "params[system_messages]", "value" => $vars['entity']->system_messages));
?>
<p align ="justify"><?php echo elgg_echo('river_activity_3C:support'); ?></p>
