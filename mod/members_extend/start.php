<?php
/**
 * Members plugin intialization
 */

elgg_register_event_handler('init', 'system', 'members_extend_init');


/**
 * Initialize page handler and site menu item
 */
function members_extend_init() {
	elgg_register_page_handler('members', 'members_extend_page_handler');
	$action_path = elgg_get_plugins_path().'members_extend/actions/member_extend';
//elgg_register_action("member/upload", "$action_path/upload.php");
	elgg_register_action("member/download", "$action_path/download.php");
	elgg_register_action("member/approve", "$action_path/approve.php");
	elgg_register_action("member/delete", "$action_path/delete.php");
	elgg_register_action("members/selected_groups", "$action_path/selected_groups.php");
	elgg_register_action("members/selected_status", "$action_path/selected_status.php");
    elgg_register_event_handler('login','user','check_first_login');
}

/**
 * Members page handler
 *
 * @param array $page url segments
 * @return bool
 */
function members_extend_page_handler($page) {
include elgg_get_plugins_path().members_extend/actions/member_extend/download.php;
	$base = elgg_get_plugins_path() . 'members_extend/pages/members';

	if (!isset($page[0])) {
		$page[0] = 'newest';
	}

	$vars = array();
	$vars['page'] = $page[0];

	if ($page[0] == 'search') {
		$vars['search_type'] = $page[1];
		require_once "$base/search.php";
	} elseif( $page[0] == 'newuser') {
		require_once "$base/new.php";
	}elseif( $page[0] == 'upload') {

		require_once "$base/upload.php";
	} else {
	 
   
		require_once "$base/index.php";
	}
	return true;
}
   function check_first_login($login_event, $user_type, $user) {
        $site = elgg_get_site_entity();
        $last_dates = unserialize($user->last_dates);
       
       if($user && $user->last_login == 0) {
        $ia = elgg_set_ignore_access(true);
		$suggestedgroupids = unserialize($site->suggestedgroupids);
        foreach($suggestedgroupids[$user->username] as $guid){
            $group = get_entity($guid);
            $msg_text.= $group->name.",";

            if($group->group_period_type =='duration'){
			 $last_dates[$guid] = date('Y-m-d H:i');///first login so must be empty
                $cmd= "+".$group->group_paid_LockedPeriod." month";
                $last_dates[$guid] = date('Y-m-d H:i',strtotime($cmd,strtotime($last_dates[$guid])));
            }else{
                $last_dates[$guid] = $group->group_paid_MembershipEnd;
            }
            $user->last_dates =serialize($last_dates);
            join_group($guid, $user->guid);
            $user->suggestedgroupids = serialize($suggestedgroupids[$user->username]);
            $user->save();
           // unset($suggestedgroupids[$user->username]);     //TBD dont know why
           // $site->suggestedgroupids =serialize($suggestedgroupids);
        }
       elgg_set_ignore_access($ia);
        if($msg_text)system_message("You are member of ".$msg_text);
       }
        return true;
    } 
function member_extend_get_group_status($group,$user,$sugested_groupids){
	$last_dates = unserialize($user->last_dates);
	if(!($group instanceof Elgggroup)){
			return 'n/a';
	}
	$luser = elgg_get_logged_in_user_entity();
	if(!$group->isMember($user)){
		 if(check_entity_relationship($user->guid, 'membership_request', $group->guid)){
			$status = 'w4_approval';
		 }elseif(check_entity_relationship($group->guid, 'invited', $user->guid)){
				$status = "invited";
		 }elseif($group->group_paid_flag == 'yes'){
				$status = "w4_payment";
		 }else{$status = 'w2_join';}
		 
	}elseif(!$luser->isAdmin() OR in_array($group->guid,$sugested_groupids)){
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
	
	if(!$_SESSION['member_extend_group_status'])return $status;
	elseif (empty($_SESSION['member_extend_group_status']))return $status;
	elseif($_SESSION['member_extend_group_status'] != $status)return 'n/a';
	else return $status;
	
}