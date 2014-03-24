<?php
$myurl_approve= elgg_get_site_url()."action/member/approve";
$myurl_delete= elgg_get_site_url()."action/member/delete";

/**
 * Elgg user display
 *
 * @uses $vars['entity'] ElggUser entity
 * @uses $vars['size']   Size of the icon
 */
 
if($vars['admin_view']   == true){
$user = $vars['entity'];
$myurl_approve .="?user_guid=".$user->guid;
	$myurl_approve=elgg_add_action_tokens_to_url($myurl_approve);
	$myurl_delete .="?user_guid=".$user->guid;
	$myurl_delete=elgg_add_action_tokens_to_url($myurl_delete);
$approve = elgg_view('output/url', array(
				'href' => $myurl_approve,
				'text' => "Approve",
				'type' => 'button',
			));
	$delete = elgg_view('output/url', array(
				'href' => $myurl_delete,
				'text' => "Remove",
				'type' => 'button',
			));
echo "<div class='me_div_as_td'>";
 echo   elgg_view('output/url', array(
                                  'text' => "",
                                  'title' => elgg_echo('mail'),
                                  'href' => elgg_get_site_url()."messages/compose?send_to=".$user->guid,
                                  'class' => "elgg-icon elgg-icon-mail-alt",
                                  ));
echo "</div><div class='me_div_as_td' style='vertical-align:top;'>";
	$sugested_groupids = unserialize($user->suggestedgroupids);
    $options = array(
                    'type' => 'group',
                    'relationship' => 'member',
                    'relationship_guid' => $user->guid,
                    'inverse_relationship' => false,
                    );
    $groups = elgg_get_entities_from_relationship($options);
    $last_dates = unserialize($user->last_dates);
    foreach($groups as $group)
    {
        if($last_dates and ($group->group_paid_flag =='yes')){
            $last_date = $last_dates[$group->guid];
            if(!$last_date or $last_date ==''){
                $inactivegroupids[]=$group->guid;
				continue;
            }
        }

        if(in_array($group->guid,$sugested_groupids))
        {
            $greengroupids[]=$group->guid;
        }
        else {
            $redgroupids[]=$group->guid;
        }
    }
   
    $yellowgroupids = array_diff($sugested_groupids, $greengroupids);

			foreach($yellowgroupids as $yellowgroupid)
			{
				if(in_array($yellowgroupid,$inactivegroupids))
				{
					$addcolor = "tcell_blue";
				}
				$group= get_entity($yellowgroupid);
				echo "<div class='me_div_as_td tcell_icon $addcolor'>";
				$icon_yellow = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				));
				echo $icon_yellow;echo "</div>";
			}
			if(count($yellowgroupids))
				echo "<br><br>".$approve;
				echo "</div>";
			
			echo "<div class='me_div_as_td' style='vertical-align:top;'>";
			foreach($redgroupids as $redgroupid)
			{
				$group= get_entity($redgroupid);
				echo "<div class='me_div_as_td tcell_icon'>";
				$icon_red = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				));
				echo $icon_red;echo "</div>";
			}
			if(count($redgroupids))
				echo "<br><br>".$delete;
				echo "</div>";

			echo "<div class='me_div_as_td' style='vertical-align:top;'>";
			foreach($greengroupids as $greengroupid)
			{
			$group= get_entity($greengroupid);
				echo "<div class='me_div_as_td tcell_icon'>";
				$icon_green = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				));
				echo $icon_green;echo "</div>";
			}
			echo "</div>";

echo "<div class='me_div_as_td'>";
echo elgg_view_entity_icon($user,'tiny')."&nbsp;</div><div class='me_div_as_td'>";
    echo $user->name;echo "</div>";
	echo "<div class='me_div_as_td'>";
    $start_ts = time();
    $day = 60*60*24;
    $week = 7*$day;
    $month = 31*$day;
    $end_ts = $start_ts+6*$month;
    elgg_load_library('elgg:event_calendar');
    $count = event_calendar_get_events_for_user_between2($start_ts,$end_ts,true,0,0,$user->guid);
    echo $count;
    echo "</div>";
	    
    $MemberFields       = explode(",",elgg_get_plugin_setting('MemberField', 'members_extend'));
    foreach($MemberFields as $MemberField){
        echo "<div class ='me_div_as_td' >".$user->$MemberField."</div>";
    }			
			
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}

?>
