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
    elgg_register_simplecache_view("css/paidgroup/paidgroup");
    elgg_register_css("paidgroup.paidgroup", elgg_get_simplecache_url("css", "paidgroup/paidgroup"));
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'paidgroup_groups_entity_menu_setup');
 }






    /**
     * Save categories to object upon save / edit
     *
     */
function paidgroup_groups_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'groups') {
		return $return;
	}
	$users = $entity->getMembers();
	if($entity->group_paid_flag =='yes'){
		foreach($users as $key=>$user){
		    if ($user->isadmin() or ($entity->owner_guid ==$user->guid) ) continue;
			$last_dates = unserialize($user->last_dates);
            $last_date = $last_dates[$entity->guid];
            if(!$last_date or $last_date ==''){
				unset($users[$key]);
            }
        } 
    }
	$num_members = count($users);
	$members_string = elgg_echo('groups:member');
	$options = array(
		'name' => 'members',
		'text' => $num_members . ' ' . $members_string,
		'href' => false,
		'priority' => 200,
	);
	$return[] = ElggMenuItem::factory($options);
	return $return;
}
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
function paidgroup_groups_handle_members_page($guid) {

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!$group || !elgg_instanceof($group, 'group')) {
		forward();
	}

	group_gatekeeper();
	$active = get_input('active','yes');
	$title = elgg_echo('groups:members:title', array($group->name));
	if(($active == 'yes') ){	
	echo  elgg_register_menu_item('title', array(
								'name' => 'group:inActive',
								'href' => 'groups/members/'.$group->guid."?active=no",
								'text' => elgg_echo('paidgroup:inactive') ,
								'class' => 'elgg-button elgg-button-submit',
							));
	}
	else{	
	echo  elgg_register_menu_item('title', array(
								'name' => 'group:inActive',
								'href' => 'groups/members/'.$group->guid."?active=yes",
								'text' => elgg_echo('paidgroup:active') ,
								'class' => 'elgg-button elgg-button-submit',
							));	
	}


	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('groups:members'));

	$db_prefix = elgg_get_config('dbprefix');
	$options =array(
		'relationship' => 'member',
		'relationship_guid' => $group->guid,
		'inverse_relationship' => true,
		'type' => 'user',
		'limit' => 20,
		'joins' => array("JOIN {$db_prefix}users_entity u ON e.guid=u.guid"),
		'order_by' => 'u.name ASC',
	);
	$entities = elgg_get_entities_from_relationship($options);
	
	foreach($entities as $key=>$entity){
		$entityactive = true;
		if (!$entity->isadmin() and ($group->owner_guid !=$entity->guid) ){
			$last_dates = unserialize($entity->last_dates);
			$last_date = $last_dates[$group->guid];
			if(!$last_date or $last_date ==''){
				$entityactive = false;	
			}
		}
		if(($active == 'no') and ($entityactive==true)){	
			unset($entities[$key]);		
		}
		elseif(($active == 'yes') and ($entityactive==false)){	
			unset($entities[$key]);		
		}
	}
	$content .= elgg_view_entity_list($entities,$options);

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}	
    function paidgroup_groups_page_handler($segments, $handle) {
        $pages_dir = dirname(__FILE__) . '/pages';
        
        switch ($segments[0]) {
            case 'all':
			$type = get_input("list_type","list");
                if($type =="list"){
                    elgg_register_menu_item('title', array('name' => 'toggle_view','href' => 'groups/all/?list_type=gallery','text' => elgg_echo('gallery') ,'link_class' => 'elgg-button elgg-button-action',));
                }
                else {
                    elgg_register_menu_item('title', array('name' => 'toggle_view','href' => 'groups/all','text' => elgg_echo('list') ,'link_class' => 'elgg-button elgg-button-action',));
                    elgg_load_css("paidgroup.paidgroup");
                }
                paidgroup_groups_handle_all_page($type);
                break;
			case 'members':
				paidgroup_groups_handle_members_page($segments[1]);
			break;
            default:
                return call_user_func("groups_page_handler", $segments, $handle);//sachin
        }
        return true;
    }

function paidgroup_groups_inactive_group(array $options = array(),$func='elgg_get_entities'){
global $inactive;
	$user = elgg_get_logged_in_user_entity();
	$options['count'] = false;$options['limit'] = 0;$options['offset'] =0; 
	$groups = elgg_get_entities_from_relationship($options);
	$last_dates = unserialize($user->last_dates);
	foreach($groups as $group){
		if($last_dates and ($group->group_paid_flag =='yes')){
			$last_date = $last_dates[$group->guid];
			if(!$last_date or $last_date ==''){
				$inactivegroups[]=$group;
			}
		}
	}
	$inactive = $inactivegroups;
	return $inactive;
}
function paidgroup_groups_handle_all_page($type,array $inactivegroups =array(),$inactive){
global $inactive;
paidgroup_groups_inactive_group();
	// all groups doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('groups'));
    
	if (elgg_get_plugin_setting('limited_groups', 'groups') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}
    if(count($inactive)){$selected_tab = get_input('filter', 'inactive');}
	else{$selected_tab = get_input('filter', 'newest');}
	switch ($selected_tab) {
		case 'popular':
		$option = array('type' => 'group',
		'relationship' => 'member',
		'inverse_relationship' => false,
		'full_view' => false,
		'list_type' =>$type,                                                                        
         );
			if($type == 'gallery'){
				$option['item_class']='group-gallery-item ';
				$option['gallery_class']= 'clearfix';
				$option['paid_view'] = true;
			}else{
				$option['paid_view'] = false;		
			}
			$content = elgg_list_entities_from_relationship_count($option);
		
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
		case 'inactive':
				$user = elgg_get_logged_in_user_entity();	
				$options = array(
							'type' => 'group',
							'relationship' => 'member',
							'relationship_guid' => $user->guid,
							'inverse_relationship' => false,
							'full_view' => false,
							'list_type' =>$type,
							
							);
					if($type == 'gallery'){
						$option['paid_view'] = true;
						$option['item_class']='group-gallery-item ';
						$option['gallery_class']= 'clearfix';
						$option['full_view'] = true;
					}else{
						$option['paid_view'] = false;
$option['full_view'] = false;						
					}
				$content = elgg_list_entities($option,'paidgroup_groups_inactive_group','elgg_view_entity_list');
			
				if (!$content) {
					$content = elgg_echo('No inActive Groups');
				}
			break;
		case 'newest':
		default:
			$option = array('type' => 'group',
			'full_view' => false,
			'list_type' =>$type,
			);
			if($type == 'gallery'){
				$option['item_class']='group-gallery-item ';
				$option['gallery_class']= 'clearfix';
				$option['paid_view'] = true;
			}else{
				$option['paid_view'] = false;		
			}
			
			$content = elgg_list_entities($option);
			if (!$content) {
				$content = elgg_echo('groups:none');
			}
			break;
	}
    if($type == 'gallery'){
				$filter = elgg_view('groups/groupgallery_sort_menu', array('selected' => $selected_tab));
			}else{
				$filter = elgg_view('groups/group_sort_menu', array('selected' => $selected_tab));
			}
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
            //echo "w".$count;
        }
        elgg_set_ignore_access($ia);
        return $count;

}
