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
	system_message($user);
	foreach($redgroupids as $redgroupid)
			{
				$group= get_entity($redgroupid);
				//$user = get_user_by_username($userID);
				//$group->leave($user);
				leave_group($redgroupid, $user->guid);
				//remove_object_from_group($redgroupid,$user_guid);

	}
?>