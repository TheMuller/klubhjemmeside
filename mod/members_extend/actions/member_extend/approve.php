<?php
//system_message("hello...");
$user_guid = get_input('user_guid');



$user = get_entity($user_guid);

$last_dates = unserialize($user->last_dates);
system_message($user->name);
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
                $user_inactive = false;//inactive member, so skip
                continue;
            }
        }
		//echo $group->guid;
        if(in_array($group->guid,$sugested_groupids))
        {
            $greengroupids[]=$group->guid;
        }
        else {
            $redgroupids[]=$group->guid;
        }
    }
	//echo "suggested";var_dump($sugested_groupids);
    //echo "green";var_dump($greengroupids);
    //echo "red";var_dump($redgroupids);
   //system_message($redgroupids);
    $yellowgroupids = array_diff($sugested_groupids, $greengroupids);
	system_message($yellowgroupids);
foreach($yellowgroupids as $yellowgroupid)
{
		if (!$last_dates[$yellowgroupid] || $last_dates[$yellowgroupid] =='')
		{
			$last_dates[$yellowgroupid] = date('Y-m-d H:i');
		}
		$group= get_entity($yellowgroupid);
    
		if($group->group_period_type =='duration'){
			$cmd= "+".$group->group_paid_LockedPeriod." month";
			$last_dates[$yellowgroupid] = date('Y-m-d H:i',strtotime($cmd,strtotime($last_dates[$group_guid])));
		}else{
				$last_dates[$yellowgroupid] = $group->group_paid_MembershipEnd;
			}
    $user->last_dates =$last_dates;
    $user->save();
			join_group($yellowgroupid, $user_guid);
			}
	
?>