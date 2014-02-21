<?php
/**
 * Join a group
 *
 * Three states:
 * open group so user joins
 * closed group so request sent to group owner
 * closed group with invite so user joins
 * 
 * @package ElggGroups
 */
gatekeeper();


$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$group_guid = get_input('group_guid');
$ia = elgg_set_ignore_access(true);
$user = get_entity($user_guid);

// access bypass for getting invisible group

$group = get_entity($group_guid);

elgg_set_ignore_access($ia);
if (($user instanceof ElggUser) && ($group instanceof ElggGroup))
	{
		if ($group->group_paid_flag == 'yes')	//:DC:
		{
            if(check_entity_relationship($user_guid, 'membership_request', $group_guid))
                system_message(elgg_echo("Already requested.."));
            else{
                if($group->group_period_type =='dates'){
                    $now = strtotime("now");
                    $grptime = strtotime($group->group_paid_MembershipEnd);
                    if(($grptime - $now) < 86400){//3600 X 24
                        system_message( "Group membership is blocked,since it will expire in 24 hour ");
                    }else{
                        forward(elgg_get_site_url() ."mod/paidgroup/join_payment_handler_block_2_x1_LOCAL.php?GroupGuid=".$group_guid);
                    }
                }else{
                    forward(elgg_get_site_url() ."mod/paidgroup/join_payment_handler_block_2_x1_LOCAL.php?GroupGuid=".$group_guid);
                }
            }
		}else{
			include elgg_get_plugins_path() ."groups/actions/groups/membership/join.php";
		}
    }
?>