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
if (elgg_is_logged_in()) {
    
    $img_icon = elgg_get_logged_in_user_entity()->getIconURL('large');
    echo "<center><img src=\"".$img_icon."\" width=\"156px\" alt=\"".elgg_get_logged_in_user_entity()->name."\" title=\"".elgg_get_logged_in_user_entity()->name."\"/></center>";
		$membersince = elgg_echo('river_activity_3C:membersince');
                $memberdate = date("j, F Y", elgg_get_logged_in_user_entity()->time_created);
                $lastlogin = elgg_echo('river_activity_3C:lastlogin');
                $lastlogindate = date("j, F Y", elgg_get_logged_in_user_entity()->prev_last_login);


                if(elgg_is_active_plugin('profile_manager')){
                $today = date('m/d');
		$bday = elgg_get_plugin_setting('birth_day', 'river_activity_3C');
                $dob = strtotime(elgg_get_logged_in_user_entity()->$bday);
                $birthdate = date('m/d', $dob);
                $name = elgg_get_logged_in_user_entity()->name;
                if ($birthdate == $today){
			echo '<div id="dob">'.elgg_echo('river_activity_3C:welcome').'<br />'.sprintf($name).'!'.elgg_echo('river_activity_3C:birthdaywish').'</div>';
                }else{
			echo '<div id="welcome">'.elgg_echo('river_activity_3C:welcome').'<br /> '.sprintf($name).'!</div>';
                     }
                }else{
		$name = elgg_get_logged_in_user_entity()->name;
		echo '<div id="welcome">'.elgg_echo('river_activity_3C:welcome').'<br /> '.sprintf($name).'!</div>';
	}
               echo '<div id="mem"><div id="left">'.$membersince.' :</div><div id="right">'.$memberdate.'</div><div id="left">'.$lastlogin.' :</div><div id="right">'.$lastlogindate.'</div></div>';
        }
?>

<ul class="elgg-menu elgg-menu-page elgg-menu-page-default">

    <li class="elgg-menu"><a href="<?php echo $vars['url']; ?>profile/<?php echo $_SESSION['user']->username; ?>/edit/"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/settings.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:editprofile'); ?></a></li>
    <li class="elgg-menu"><a href="<?php echo $vars['url']; ?>avatar/edit/<?php echo $_SESSION['user']->username; ?>/"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/profile.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:editavatar'); ?></a></li>
    <?php if (elgg_is_active_plugin('messageboard')){ ?>
    <li class="elgg-menu"><a href="<?php echo $vars['url']; ?>messageboard/owner/<?php echo $_SESSION['user']->username; ?>"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/questions.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:messageboard'); ?></a></li>
    <?php } 

    if (elgg_is_active_plugin('messages')){
	$num_messages = messages_count_unread();
	if($num_messages){
		$num = $num_messages;
	} else {
		$num = 0;
	}
	if($num == 0){
?>

<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>messages/inbox/<?php echo $_SESSION['user']->username; ?>"><img src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/mail.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:inbox'); ?></a></li>
<?php } else { ?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>messages/inbox/<?php echo $_SESSION['user']->username; ?>"><img src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/mail.png" style="vertical-align: middle; "/><font color="red"><?php echo elgg_echo('river_activity_3C:inbox'); ?> [<?php echo $num; ?>]</font></a></li>
<?php  }} 
    if (elgg_is_active_plugin('friend_request')){
        $requests = array(
			"type" => "user",
			"relationship" => "friendrequest",
			"relationship_guid" => elgg_get_logged_in_user_guid(),
			"inverse_relationship" => true,
			"count" => true
		);

	$count = elgg_get_entities_from_relationship($requests);

	if(!empty($count)){
?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>friend_request/<?php echo $_SESSION['user']->username; ?>"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/friends.png" style="vertical-align: middle; "/><font color="red"><?php echo elgg_echo('river_activity_3C:friendrequest'); ?>[<?php echo $count; ?>]</font></a></li>
<?php } else { ?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>friend_request/<?php echo $_SESSION['user']->username; ?>"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/friends.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:friendrequest'); ?></a></li>
<?php }} if (elgg_is_active_plugin('members')){ ?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>invite/"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/home.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:invites'); ?></a></li>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>members/"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/members.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:members'); ?></a></li>
<?php } if (elgg_is_active_plugin('groups')){ ?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>groups/all?filter=discussion"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/groups.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:discussions'); ?></a></li>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>groups/invitations/<?php echo $_SESSION['user']->username; ?>"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/help.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:invitation'); ?></a></li>
<?php } if (elgg_is_active_plugin('bookmarks')){ ?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>bookmarks/all/"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/favorites.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:bookmarks'); ?></a></li>
<?php } ?>
<li class="elgg-menu"><a href="<?php echo $vars['url']; ?>settings/user/<?php echo $_SESSION['user']->username; ?>"><img alt=""  src="<?php echo $vars['url']; ?>mod/river_activity_3C/graphics/icons/task.png" style="vertical-align: middle; "/><?php echo elgg_echo('river_activity_3C:setting'); ?></a></li>
</ul>
