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
$created_time = elgg_get_plugin_setting('created_time');

echo "<div class='me_div_as_td' style='vertical-align:middle;'>";
echo elgg_view_entity_icon($user,'tiny')."&nbsp;</div>";
echo "<div class='me_div_as_td'>".$user->name;echo "</div><div class='me_div_as_td' style='width:90px;'>";
	$sugested_groupids = unserialize($user->suggestedgroupids);
    $options = array(
                    'type' => 'group',
                    'relationship' => 'member',
                    'relationship_guid' => $user->guid,
                    'inverse_relationship' => false,
                    );
    $groups = elgg_get_entities_from_relationship($options);
    $last_dates = unserialize($user->last_dates);

    foreach($groups as $grp)
    {
		  if(in_array($grp->guid,$sugested_groupids))
        {
            $greengroupids[]=$grp->guid;
        }
	}
	
$yellowgroupids = array_diff($sugested_groupids, $greengroupids);
foreach($yellowgroupids as $groupid){
	$groups[] = get_entity($groupid);
}

	
    foreach($groups as $key=>$group)
    {	
		
		if ( end(array_keys($groups) ) == $key ) {
			$border = 'border-bottom:0px solid;';
		} else {
			$border = 'border-bottom:1px solid;';
		}
		echo "<div style='height:40px;$border border-collapse:collapse;border-spacing: 0;'>";
				echo "<div class='tcell_icon $addcolor' style='width: inherit;'>";
				$icon_yellow = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				));echo "</div>";
				echo $icon_yellow."</div>";
	}
	

			echo "</div>"; 
			echo "<div class='me_div_as_td' style='vertical-align: middle;;width:70px;'>";

			foreach($groups as $key=>$group){
				if ( end(array_keys($groups) ) == $key ) {
					$border = 'border-bottom:0px solid;';
				} else {
					$border = 'border-bottom:1px solid;';
				}
				if(!$group->isMember($user)){
					$status = 'pending';
				}elseif(in_array($group->guid,$sugested_groupids)){
						$status = "active";
							if($last_dates and ($group->group_paid_flag =='yes')){
								$last_date = $last_dates[$group->guid];
								if(!$last_date or $last_date ==''){
									$status  = "expired";
									//continue;
								}
							}
					}else{
						$status = "wrong";
					}
				
					echo "<div style='height:40px;$border border-collapse: collapse;border-spacing: 0;'>";
					if($status == 'wrong'){
						$myurl_delete .="?user_guid=".$user->guid."&group_guid=".$group->guid;
						$myurl_delete=elgg_add_action_tokens_to_url($myurl_delete);
						$delete = elgg_view('output/url', array(
											'href' => $myurl_delete,
											'text' => '',
											//'type' => 'button',
											'class' => 'elgg-icon elgg-icon-delete-alt',
									));					
						echo elgg_echo('members:memberships:status:'.$status).$delete;
					}elseif($status == 'pending'){
						$myurl_approve .="?user_guid=".$user->guid."&group_guid=".$group->guid;
						$myurl_approve=elgg_add_action_tokens_to_url($myurl_approve);
						$approve = elgg_view('output/url', array(
									'href' => $myurl_approve,
									'text' => '',
									//'type' => 'button',
									'class' => 'elgg-icon elgg-icon-checkmark',
								));
						echo elgg_echo('members:memberships:status:'.$status).$approve;
					}else{
						echo elgg_echo('members:memberships:status:'.$status);
					}
					
				
					echo "</div>";
			}
			echo "</div>"; 

			echo "<div class='me_div_as_td' style='vertical-align: middle;'>";
			foreach($groups as $key=>$group){
				if ( end(array_keys($groups) ) == $key ) {
					$border = 'border-bottom:0px solid;';
				} else {
					$border = 'border-bottom:1px solid;';
				}
				echo "<div style='vertical-align: middle;text-align:center;height:40px; $border border-collapse: collapse;border-spacing: 0;'>".date('d M y', $group->time_created)."</div>";
			}
			echo "</div>";

			echo"<div class='me_div_as_td' style='width:70px;'>";
			foreach($groups as $key=>$group){
				if ( end(array_keys($groups) ) == $key ) {
					$border = 'border-bottom:0px solid;';
				} else {
					$border = 'border-bottom:1px solid;';
				}
				echo "<div style='vertical-align: middle;height:40px;$border border-collapse: collapse;border-spacing: 0;'>".date('d M y', $group->last_dates)."</div>";
			}
			echo "</div>";
			
			echo"<div class='me_div_as_td'>";
			foreach($groups as $key=>$group){
				if ( end(array_keys($groups) ) == $key ) {
					$border = 'border-bottom:0px solid;';
				} else {
					$border = 'border-bottom:1px solid;';
				}			
				echo "<div style='vertical-align: middle;height:40px;$border border-collapse: collapse;border-spacing:0px;'>".date('d M y', $group->time_created)."</div>";
			}
			echo "</div>";
			
	if($created_time == '1'){
		echo"<div class='me_div_as_td' style='width:70px;'>".date('d M y', $user->time_created)."</div>";
	}
    
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
	echo "<div class='me_div_as_td'>";
	echo   elgg_view('output/url', array(
                                  'text' => "",
                                  'title' => elgg_echo('mail'),
                                  'href' => elgg_get_site_url()."messages/compose?send_to=".$user->guid,
                                  'class' => "elgg-icon elgg-icon-mail-alt",
                                  ))."</div>";		
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}

?>
