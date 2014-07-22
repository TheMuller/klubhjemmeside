<?php
$user_guid = get_input('user_guid');
$group_guid = get_input('group_guid');

$user = get_entity($user_guid);
$group = get_entity($group_guid);

$last_dates = unserialize($user->last_dates);

		if (!$last_dates[$group_guid] || $last_dates[$group_guid] =='')
		{
			$last_dates[$group_guid] = date('Y-m-d H:i');
		}
		$group= get_entity($group_guid);
    
		if($group->group_period_type =='duration'){
			$cmd= "+".$group->group_paid_LockedPeriod." month";
			$last_dates[$group_guid] = date('Y-m-d H:i',strtotime($cmd,strtotime($last_dates[$group_guid])));
		}else{
				$last_dates[$group_guid] = $group->group_paid_MembershipEnd;
			}
		$user->last_dates =$last_dates;
		join_group($group_guid, $user_guid);
		$user->save();
?>