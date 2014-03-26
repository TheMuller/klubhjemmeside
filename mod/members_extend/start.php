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
        foreach($site->suggested_guids[$user->username] as $guid){
            $group = get_entity($guid);
            $msg_text.= $group->name.",";
            if (!$last_dates[$guid] || $last_dates[$guid] =='')
            {
                $last_dates[$guid] = date('Y-m-d H:i');
            }
            
            if($group->group_period_type =='duration'){
                $cmd= "+".$group->group_paid_LockedPeriod." month";
                $last_dates[$guid] = date('Y-m-d H:i',strtotime($cmd,strtotime($last_dates[$group_guid])));
            }else{
                $last_dates[$guid] = $group->group_paid_MembershipEnd;
            }
            $user->last_dates =$last_dates;
            $user->save();
            join_group($guid, $user->guid);
            $site->suggested_guids[$user->username] ='';
        }
        if($msg_text)system_message("You are member of ".$msg_text);
        
        return true;
    }