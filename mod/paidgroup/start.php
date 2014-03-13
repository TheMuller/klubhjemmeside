<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'paidgroup_init');

function paidgroup_init() {
	$base_dir = elgg_get_plugins_path() . 'paidgroup/actions/';
	
    
    elgg_extend_view('forms/groups/edit','input/paidgroup');
    elgg_register_event_handler('update', 'all', 'group_save');
    elgg_register_event_handler('create', 'all', 'group_save');

    elgg_register_event_handler('pagesetup', 'system', 'paidgroup_menus');
    elgg_register_action("groups/join", elgg_get_plugins_path() ."paidgroup/actions/join.php");
    elgg_register_plugin_hook_handler('cron','daily', 'paidgroup_cron');
   // elgg_extend_view('group/default', 'paidgroup/default', 101);
    elgg_extend_view('groups/sidebar/my_status', 'paidgroup/sidebar', 500);
    elgg_register_event_handler("leave", "group", 'handle_group_leave');
    elgg_register_plugin_hook_handler('output:before', 'page', 'paidgroup_manage_unpaid_members');
    elgg_register_event_handler('login','user','paidgroup_login_redirect');
    elgg_register_plugin_hook_handler('forward', 'system', 'paidgroup_hook_forward_system');
    elgg_register_page_handler('paidgroup', 'paidgroup_page_handler');
    elgg_register_page_handler('groups', 'paidgroup_groups_page_handler');
    elgg_extend_view('user/default', 'paidgroup/userdefault', 101);
    elgg_register_simplecache_view("css/paidgroup/paidgroup");
    elgg_register_css("paidgroup.paidgroup", elgg_get_simplecache_url("css", "paidgroup/paidgroup"));
 }






    /**
     * Save categories to object upon save / edit
     *
     */
    function group_save($event, $object_type, $group) {
    	if ($group instanceof ElggGroup) {
            $group->group_paid_flag=get_input('group_paid_flag','');
            $group->group_paid_price=get_input('group_paid_price','');
            $group->group_period_type =get_input('group_period_type','');
            $group->group_price_type = get_input('group_price_type','');
            //system_message("new end date is ".get_input('group_paid_MembershipEnd',''));
            if( $group->group_paid_MembershipStart != get_input('group_paid_MembershipStart','') or
               $group->group_paid_MembershipEnd != get_input('group_paid_MembershipEnd','')
               ){
                $members =  $group->getMembers(0,0,false);
                foreach($members as $member){
                    $last_dates = unserialize($member->last_dates);
                    $last_date = $last_dates[$group->guid];
                    
                    if($last_date and $last_date !=''){
                       // system_message($last_date);
                        $last_dates[$group->guid] = get_input('group_paid_MembershipEnd','');
                        $member->last_dates = serialize($last_dates);
                    }
                    notify_user($member->getGUID(), $group->getOwnerGUID(), elgg_echo('paidgroup:datechanged:email:subject'), elgg_echo('paidgroup:datechanged:email:body',array($member->name,$group->name,get_input('group_paid_MembershipStart',''),get_input('group_paid_MembershipEnd',''))));
                }
            }
            $group->group_paid_LockedPeriod=get_input('group_paid_LockedPeriod','');
            $group->group_paid_MembershipStart=get_input('group_paid_MembershipStart','');
            $group->group_paid_MembershipEnd=get_input('group_paid_MembershipEnd','');
    	}
    	return true;
    }
    function handle_group_leave($event,$type, $params) {
        
        if(!empty($params) && is_array($params)){
            
            if(array_key_exists("group", $params) && array_key_exists("user", $params)){
                $group = $params["group"];
                $user = $params["user"];
                
                if(($group instanceof ElggGroup) && ($user instanceof ElggUser) && ($group->group_paid_flag =='yes')){
                    $last_dates = unserialize($user->last_dates);
                    if ($last_dates[$group->guid]){
                        $last_dates[$group->guid] = '';
                        $user->last_dates = serialize($last_dates);
                    }
                }
            }
        }
    }


    function paidgroup_menus() {
        
        // Get the page owner entity
        
        if (elgg_get_context() == 'group_profile') {
            $group = elgg_get_page_owner_entity();
            $user = elgg_get_logged_in_user_entity();
            if ($group->isMember($user) and ($group->getOwnerGUID() != $user->guid) and ($group->group_paid_flag == 'yes')) {

                    // leave
                    $url = elgg_get_site_url() . "action/groups/leave?group_guid={$group->getGUID()}";
                    $url = elgg_add_action_tokens_to_url($url);
                    $actions[$url] = 'groups:leave';
                    elgg_register_menu_item('title', array(
                                                           'name' => 'groups:leave',
                                                           'text' => elgg_echo('groups:leave'),
                                                           'href' => $url,
                                                           "confirm" => elgg_echo("paidgroup:membership:leave:confirm"),
                                                           'link_class' => 'elgg-button elgg-button-action',
                                                           ));
                
            }
            
            
        }
     }

    function paidgroup_cron($hook, $entity_type, $returnvalue, $params){
        $ia = elgg_set_ignore_access(true);
        $options = array(
                         'limit' =>0,
                         'type' => 'group',
                         'metadata_name_value_pairs'=>array("name" => "group_paid_flag", "value" => 'yes'),
                         );

        $CurrentGroups= elgg_get_entities($options);
        foreach($CurrentGroups as $grp){
            if ($grp->group_paid_flag == 'yes'){
                $debugtext .= "<br>".$grp->name;
                $members = $grp->getMembers (0,0,false);
                foreach ( $members as  $member){
                    $last_dates = unserialize($member->last_dates);
                    $last_date = $last_dates[$grp->guid];
                    if($last_date and $last_date !=''){
                        $delta =  ceil((strtotime($last_date)- time())/(24*60*60)) ;
                        $debugtext .="<br>".$member->name."(".$member->guid.") ".$delta;

                        if($delta  == 14){
                            $debugtext .=" reminder message sent.";
                            if($grp->group_period_type =='duration'){
                                $email_body = elgg_echo( "paidgroup:lock:membership:will:expire:email:body",array($member->name,$grp->name,$last_date));
                            }else{
                                $email_body = elgg_echo( "paidgroup:date:membership:will:expire:email:body",array($member->name,$grp->name,$last_date));
                            }
                            notify_user($member->getGUID(), $grp->getOwnerGUID(),  elgg_echo('paidgroup:membership:will:expire:email:subject'),$email_body);
                        }elseif($delta  < 1){
                            $debugtext .=" expired message sent.";
                            notify_user($member->getGUID(), $grp->getOwnerGUID(),elgg_echo('paidgroup:membership:expired:email:subject'), elgg_echo('paidgroup:membership:expired:email:body',array($member->name,$grp->name)));
                            $last_dates[$grp->guid] = '';
                            $member->last_dates = serialize($last_dates);
                        }
                    }
                }
            }
        }

        elgg_set_ignore_access($ia);
        return $returnvalue . $resulttext;
    }



function paidgroup_manage_unpaid_members($hook, $type, $value, $params) {

        
    $user = elgg_get_logged_in_user_entity ();
    $group= elgg_get_page_owner_entity();//any entity, not just  group
 
    if($user  instanceof  ElggUser and $user->isAdmin() )return;//

    if($group instanceof ElggGroup and $group->group_paid_flag =='yes'){
        //ok so $group is really a group
        if($user  instanceof  ElggUser){
            $last_dates = unserialize($user->last_dates);
            if($last_dates){
                $last_date = $last_dates[$group->guid];
                if($last_date and $last_date !=''){
                    //$value['body'] = "You membership will expire on".$last_date.$value['body'];
                    return $value;
                }
            }
        }
        if($group->isMember($user)) $warning = elgg_echo("paidgroup:membership:expired:warning");
        else $warning = elgg_echo("paidgroup:membership:warning");
        $url = elgg_get_site_url() . "action/groups/join?group_guid={$group->getGUID()}";
        $url = elgg_add_action_tokens_to_url($url);
        $value['body'] = "<div style='height:32px;background:#F5F5F5;border: 1px solid rgba(0, 0, 0, 0.1);'><div style='float:right;'>".$warning."&nbsp&nbsp".
                        elgg_view("output/url", array( "href" => $url, "text" => elgg_echo('Join'), "is_trusted" => true,"class" => "elgg-button elgg-button-submit"))."</div></div>".
                        elgg_view('groups/profile/summary', array("entity"=>$group,"full_view"=>true,));
        return $value;
    }
    
    if($user  instanceof  ElggUser){
        $Groups_Access_Style=elgg_get_plugin_setting('groups_access_style','paidgroup');
        if($Groups_Access_Style == 3){
            $ia = elgg_set_ignore_access(true);
            
            $options  = array('type' => 'group','count' => true,);

            $Counter = elgg_get_entities_from_metadata($options);
            
            if($Counter >0){
                $options['relationship'] = 'member';
                $options['relationship_guid'] = $user->guid;
                $options['inverse_relationship']=false;
                $Counter = elgg_get_entities_from_relationship($options);
            
                if(!$Counter){
                   // echo "not a member of any group ";
                    $value['body'] = elgg_view ( 'paidgroup/join_payment_handler_block');
                }
                else {
                   // echo "member  in some group / ";
                    $options['count'] = false;
                    $mgroups = elgg_get_entities_from_relationship($options);
                    $last_dates = unserialize($user->last_dates);
                    $user_inactive = true;
                    $is_member_of_open_paid = false;
                    $is_member_of_open_unpaid = false;
                    $is_member_of_close_paid = false;
                    $is_member_of_close_unpaid = false;
                    
                        foreach($mgroups as $mgroup){
                                if($last_dates and ($mgroup->group_paid_flag =='yes')){
                                    $last_date = $last_dates[$mgroup->guid];
                                    if(!$last_date or $last_date ==''){
                                        $user_inactive = false;//inactive member, so skip
                                     //   echo "inactive  in  ".$mgroup->name;
                                        continue;
                                    }
                                }
                           // echo $mgroup->membership." ".$mgroup->name." ,";
                                if($mgroup->membership == ACCESS_PRIVATE){
                                    if($mgroup->group_paid_flag =='yes') $is_member_of_close_paid = true;
                                    else $is_member_of_close_unpaid = true;
                                }else{
                                    if($mgroup->group_paid_flag =='yes') $is_member_of_open_paid = true;
                                    else $is_member_of_open_unpaid = true;
                            
                                }
                        
                        }
                    
                    
                    
                            $groupforce_open_paid = elgg_get_plugin_setting('groupforce_open_paid','paidgroup');
                            $groupforce_open_unpaid = elgg_get_plugin_setting('groupforce_open_unpaid','paidgroup');
                            $groupforce_close_paid = elgg_get_plugin_setting('groupforce_close_paid','paidgroup');
                            $groupforce_close_unpaid = elgg_get_plugin_setting('groupforce_close_unpaid','paidgroup');
                           // echo "/setting is ".$groupforce_open_paid." ".$groupforce_open_unpaid." ". $groupforce_close_paid ." ".$groupforce_close_unpaid. " / ";
                            
                           // echo "/situation is ";
                           // if($is_member_of_open_paid) echo "1"; else echo "0";
                           // if($is_member_of_open_unpaid) echo "1"; else echo "0";
                           // if($is_member_of_close_paid) echo "1"; else echo "0";
                           // if($is_member_of_close_unpaid) echo "1"; else echo "0";
                           // echo  " / ";
                            if($groupforce_open_paid !='1' and $groupforce_open_unpaid !='1' and $groupforce_close_paid !='1' and $groupforce_close_unpaid !='1'){
                                //let him go,its admins mistake. so give benifit of doubt since poor fellow is atlist a member of soe group
                             //   echo "letting go since admin not checked anything";
                            }
                            elseif(($groupforce_open_paid =='1' and $is_member_of_open_paid) or
                                   ($groupforce_open_unpaid =='1' and $is_member_of_open_unpaid) or
                                   ($groupforce_close_paid =='1' and $is_member_of_close_paid) or
                                   ($groupforce_close_unpaid =='1' and $is_member_of_close_unpaid)
                                ){
                                    // let him go, as per admins wish
                                 //  echo "letting go since meeting criteria";
                            }else{
                               // echo "forcing gallery since  not meeting criteria";
                                $value['body'] = elgg_view ( 'paidgroup/join_payment_handler_block');
                                }
                        
                    

                    
                    }
                
                return $value;
            }
            elgg_set_ignore_access($ia);
        }//if $Groups_Access_Style
    }//user instance
}


function paidgroup_login_redirect($event, $type, $user) {
    if($user && $user->last_login == 0) {
            // do something here
    }
    $Groups_Access_Style=elgg_get_plugin_setting('groups_access_style','paidgroup');
    if($Groups_Access_Style == 2){
        $options  = array(
                          'type' => 'group',
                          'relationship' => 'member',
                          'relationship_guid' => $user->guid,
                          'inverse_relationship' => false,
                          'count' => true,
                          );
        $Counter = elgg_get_entities_from_relationship($options);
        
        if(!$Counter)  {
            global $SESSION;
            $SESSION['forward_link'] = "paidgroup/joinpayment/";
        }
    }
    return true;
}
    
function paidgroup_hook_forward_system($hook, $type, $returnvalue, $params) {
        $url = $_SESSION['forward_link'];
        if(!empty($url )) {
            $_SESSION['forward_link'] = '';
            return elgg_get_site_url() .$url ;
        }
    }
    function paidgroup_groups_page_handler($segments, $handle) {
        $pages_dir = dirname(__FILE__) . '/pages';
        
        switch ($segments[0]) {
            case 'all':
                if(get_input("list_type","list") =="list"){
                    elgg_register_menu_item('title', array('name' => 'project:invite','href' => 'groups/all/?list_type=gallery','text' => elgg_echo('gallery') ,'link_class' => 'elgg-button elgg-button-action',));
                    elgg_load_library('elgg:groups');
                 groups_handle_all_page();
                }
                else {
                    elgg_register_menu_item('title', array('name' => 'project:invite','href' => 'groups/all','text' => elgg_echo('list') ,'link_class' => 'elgg-button elgg-button-action',));
                    elgg_load_css("paidgroup.paidgroup");
                    paidgroup_groups_handle_all_page();
                }
                
                break;
            default:
                return call_user_func("groups_page_handler", $segments, $handle);//sachin
        }
        return true;
    }


function paidgroup_groups_handle_all_page(){
    
	// all groups doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('groups'));
    
	if (elgg_get_plugin_setting('limited_groups', 'groups') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}
    
	$selected_tab = get_input('filter', 'newest');
	switch ($selected_tab) {
		case 'popular':
			$content = elgg_list_entities_from_relationship_count(array(
                                                                        'type' => 'group',
                                                                        'relationship' => 'member',
                                                                        'inverse_relationship' => false,
                                                                        'full_view' => false,
                                                                        'paid_view' => true,
                                                                        'list_type' =>"gallery",
                                                                        'item_class'=>'group-gallery-item ',
                                                                        'gallery_class'=> 'clearfix',
                                                                        ));
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
		case 'discussion':
			$content = elgg_list_entities(array(
                                                'type' => 'object',
                                                'subtype' => 'groupforumtopic',
                                                'order_by' => 'e.last_action desc',
                                                'limit' => 40,
                                                'full_view' => false,
                                                ));
			if (!$content) {
				$content = elgg_echo('discussion:none');
			}
			break;
		case 'newest':
		default:
			$content = elgg_list_entities(array(
                                                'type' => 'group',
                                                'full_view' => false,
                                                'paid_view' => true,
                                                'list_type' =>"gallery",
                                                'item_class'=>'group-gallery-item ',
                                                'gallery_class'=> 'clearfix',
                                                ));
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
	}
    
	$filter = elgg_view('groups/groupgallery_sort_menu', array('selected' => $selected_tab));
    
	$sidebar = elgg_view('groups/sidebar/find');
	$sidebar .= elgg_view('groups/sidebar/featured');
    
	$params = array(
                    'content' => $content,
                    'sidebar' => $sidebar,
                    'filter' => $filter,
                    );
	$body = elgg_view_layout('content', $params);
    
	echo elgg_view_page(elgg_echo('groups:all'), $body);
}

function paidgroup_page_handler($segments) {
    switch($segments[0]) {
        case 'upload': {
            $body = elgg_view ( 'paidgroup/upload');
            echo elgg_view_page($title,$body);
            return true;
        }
		case 'joinpayment': {
            $body = elgg_view ( 'paidgroup/join_payment_handler_block');
            echo elgg_view_page($title,$body);
            return true;
        }

    }
    return false;
}
    

function group_get_getActiveMembers($group){
        $options =    array(
                            'relationship' => 'member',
                            'relationship_guid' => $group->guid,
                            'inverse_relationship' => true,
                            'type' => 'user',
                            );
        $ia = elgg_set_ignore_access(true);
        $users = elgg_get_entities_from_relationship($options);
        $count =0;
        foreach($users as $user){
            if($group->owner_guid == $user->guid){
                $count++;
                continue;
            }
            
            $last_dates = unserialize($user->last_dates);
            
            $last_date = $last_dates[$group->guid];
            if(!$last_date or $last_date ==''){
                continue;
            }
            $count++;
            echo "w".$count;
        }
        elgg_set_ignore_access($ia);
        return $count;

}
