<?php
/**
 * Members index
 *
 */

function compare_users($usera, $userb)
{
    $orderby = get_input('orderby','name');
    return strcmp($usera->$orderby,$userb->$orderby);
}
	$luser = elgg_get_logged_in_user_entity();
	$_SESSION['member_exten_owner'] = false;
	$options = array(
				'type' => 'group',
				'relationship' => 'membership_request',
				'relationship_guid' => $luser->guid,
				'inverse_relationship' => false,
				);
	if(!$luser->isAdmin()){
		$options['owner_guid'] = $luser->guid;
		$status_options = $gowner_status_options;
	}else{
		$status_options = array_merge($gowner_status_options,$admin_status_options);
	}
	
	$rgroups = elgg_get_entities($options);
	foreach($rgroups as $group){
		if($luser->guid == $group->owner_guid){$_SESSION['member_exten_owner'] = true;break;}
	}   
function member_extend_get_users(array $options = array(),$func='elgg_get_entities'){
    $countopt = $options['count'];
    $limitopt = $options['limit'];
    $offsetopt = $options['offset'];
     if(!$_SESSION[$options['sobj']]){
        $options['count'] = false;$options['limit'] = 0;$options['offset'] =0;
        $_SESSION[$options['sobj']] = $options['func']($options);
     }
    if($_SESSION['member_extend_selected_groups_changed'] or empty($_SESSION[$options['sobj']."ASC"])){
        $_SESSION['member_extend_selected_groups_changed'] = false;
        unset($_SESSION[$options['sobj']."ASC"]);
		$all_grp = $_SESSION['member_extend_selected_groups']; 
		$luser = elgg_get_logged_in_user_entity();
		//echo "to".$_SESSION['member_exten_owner'];
		if(!$luser->isAdmin() AND $_SESSION['member_exten_owner'] != true AND empty($all_grp)){
		//echo "general";
			$_SESSION[$options['sobj']."ASC"] = $_SESSION[$options['sobj']];
		}else{
			if(empty($all_grp)){
				$all_grp = array();
				$goptions = array('type' => 'group',);
				if(!$luser->isAdmin() ){
				   $goptions['owner_guid'] = $luser->guid;
				}
				$groups = elgg_get_entities($goptions);
				
				foreach($groups as $grp){
				   $all_grp[] = $grp->guid;
				}
				//var_dump($all_grp);
			   // $_SESSION[$options['sobj']."ASC"] = $_SESSION[$options['sobj']];
			}
			//echo "<br>".$_SESSION['member_extend_group_status']."<br>";
			foreach($_SESSION[$options['sobj']] as $key=>$user){
				//echo $user->name."/";
					$found = false;
					foreach($all_grp as $group_guid){
						$group = get_entity($group_guid);
						if(($group instanceof Elgggroup) and $group->isMember($user)){
							if($last_dates and ($group->group_paid_flag =='yes')){
								$last_date = $last_dates[$group->guid];
								if(!$last_date or $last_date =='')continue;// TBD:remove line
							}
							$found = true;break;
						}
						if(!$luser->isAdmin()){//TBD: this is to decide user
							$ia = elgg_set_ignore_access(true);
							if($_SESSION['member_extend_group_status'] == 'invited' OR $_SESSION['member_extend_group_status'] == ''){//echo "-in-invited";
								if(check_entity_relationship($group->guid, 'invited', $user->guid)){
									//echo "forund";
									$found = true;break;
									
								}
							}
							if($_SESSION['member_extend_group_status'] == 'w4_approval' OR $_SESSION['member_extend_group_status'] == ''){//echo "-in-w4 app";
								if(check_entity_relationship($user->guid, 'membership_request', $group->guid)){//echo "found";
									$found = true;break;
								}
							}
							elgg_set_ignore_access($ia);
						}
					}

					if($found){
						$_SESSION[$options['sobj']."ASC"][]=$user;
					}
			}
		}
       if(!empty($_SESSION['searchquery'])){
           foreach($_SESSION[$options['sobj']."ASC"] as $key=>$user){

                if(strpos($user->$_SESSION['searchfield'],$_SESSION['searchquery'])    === FALSE){
                    unset($_SESSION[$options['sobj']."ASC"][$key]);
                }
           }
       }
	   if($_SESSION['member_extend_group_status']){
			foreach($_SESSION[$options['sobj']."ASC"] as $key=>$user){
				$sugested_groupids = unserialize($user->suggestedgroupids);
				unset($groups);
				$all_na = true;
				if($_SESSION['member_extend_group_status'] =='w2_join'){
				   foreach($sugested_groupids as $sugested_groupid){
						$group = get_entity($sugested_groupid);
						if(!$group->isMember($user) AND $group->group_paid_flag != 'yes')$all_na = false;
				   }
				}elseif($_SESSION['member_extend_group_status'] =='w4_payment'){
					foreach($sugested_groupids as $sugested_groupid){
						$group = get_entity($sugested_groupid);
						if(!$group->isMember($user) AND $group->group_paid_flag == 'yes')$all_na = false;
				   }
				}elseif($_SESSION['member_extend_group_status'] =='w4_approval'){
							$roptions = array(
							'type' => 'group',
							'relationship' => 'membership_request',
							'relationship_guid' => $user->guid,
							'inverse_relationship' => false,
							
							);
							if(!$luser->isAdmin() ){
				   $roptions['owner_guid'] = $luser->guid;
				}
					$rgroups = elgg_get_entities_from_relationship($roptions);
					if(count($rgroups)){
						$all_na = false;
					}
					/* foreach($sugested_groupids as $sugested_groupid){
						$group = get_entity($sugested_groupid);
						if(!$group->isMember($user) AND check_entity_relationship($user->guid, 'membership_request', $group->guid))$all_na = false;
				   } */
				}elseif($_SESSION['member_extend_group_status'] =='invited'){
						$ioptions = array(
				'type' => 'group',
				'relationship' => 'invited',
				'relationship_guid' => $user->guid,
				'inverse_relationship' => true,
				
				);
					if(!$luser->isAdmin() ){
				   $ioptions['owner_guid'] = $luser->guid;
				}
					$igroups = elgg_get_entities_from_relationship($ioptions);
					if(count($igroups)){
						$all_na = false;
					}
		
		
					/* foreach($sugested_groupids as $sugested_groupid){
						$group = get_entity($sugested_groupid);
						if(!$group->isMember($user) AND check_entity_relationship($group->guid, 'invited',$user->guid ))$all_na = false;
				   } */
				}else{
				    $myoptions = array('type' => 'group',
                                       'relationship' => 'member',
                                       'relationship_guid' => $user->guid,
                                       'inverse_relationship' => false,
                                       );
				
				     $groups = elgg_get_entities_from_relationship($myoptions);
					 foreach($groups as $group){
					    if($group instanceof Elgggroup){
				  	       $status = member_extend_get_group_status($group,$user,$sugested_groupids);
				           if($status != 'n/a')$all_na = false;
					    }
				     }
				}
				if($all_na){
					unset($_SESSION[$options['sobj']."ASC"][$key]);
				}
			}
	   }
       usort($_SESSION[$options['sobj']."ASC"],'compare_users');
    }
    $sorting = get_input('sorting','ASC');
    if($countopt) {
         return count($_SESSION[$options['sobj']."ASC"]);
    }
    else {
        if($sorting == 'DESC') {
            $count = count($_SESSION[$options['sobj']."ASC"]);
            if($count > ($offsetopt+$limitopt)){ $offsetopt = $count-$offsetopt- $limitopt;}
            else {$limitopt=$count-$offsetopt;$offsetopt=0;}
            return array_reverse(array_slice($_SESSION[$options['sobj']."ASC"],$offsetopt,$limitopt));
        }else
         return array_slice($_SESSION[$options['sobj'].$sorting],$offsetopt,$limitopt);
    }
}

$base = elgg_get_plugins_path() . 'members_extend/pages/members';
$num_members = get_number_users();

$title = elgg_echo('members');

$dbprefix = elgg_get_config("dbprefix");
$options = array('type' => 'user',
                 'full_view' => false,
                 'pagination'=>true,
                 'limit'=>10,//sachin tbc
                 'list_class'=> 'me_ul_as_table',
                 'item_class' =>'me_li_as_tr');
$orderby = get_input('orderby','');
if($orderby =='name'){
$options['joins'] = array("JOIN " . $dbprefix . "users_entity u ON e.guid=u.guid");
$options["order_by"] = "u.name ";
}elseif($orderby !=''){

$options['joins'][]  = "JOIN {$dbprefix}metadata $orderby ON e.guid = {$orderby}.entity_guid";
 $options['joins'][]  = "JOIN {$dbprefix}metastrings {$orderby}_name on {$orderby}.name_id={$orderby}_name.id";
 $options['joins'][]  = "JOIN {$dbprefix}metastrings {$orderby}_value on {$orderby}.value_id={$orderby}_value.id";
 $options["order_by"] = "{$orderby}_name.string ";
}

$sorting = get_input('sorting','');
$options["order_by"] .= $sorting;
	

if(elgg_is_admin_logged_in() OR $_SESSION['member_exten_owner'] == true)$options['admin_view'] = true;
//$options['admin_view'] = true;

switch ($vars['page']) {
	case 'popular':
		$options['relationship'] = 'friend';
		$options['inverse_relationship'] = false;
        $options['func'] = "elgg_get_entities_from_relationship_count";
        $options['sobj'] = "mxuserslist_p";
        $content = elgg_list_entities($options,'member_extend_get_users','elgg_view_entity_list');
		break;
	case 'online':
			global $CONFIG;

		$time = time() - 600;
	$options['joins'] = array("join {$CONFIG->dbprefix}users_entity u on e.guid = u.guid");
					$options['wheres'] = array("u.last_action >= {$time}");
			$options['order_by'] = "u.last_action desc";
			
		//$content = get_online_users();
		//$content = elgg_list_entities($options,'member_extend_get_online_users','elgg_view_entity_list');
        $options['func'] = "elgg_get_entities";
        $options['sobj'] = "mxuserslist_o";
        $content = elgg_list_entities($options,'member_extend_get_users','elgg_view_entity_list');
		break;
		
	case 'unvalidated':
		$user= get_entity($_SESSION['user']->guid);
		if($user){
			if($user->isAdmin()){
				$content = elgg_view_form('members/bulk_action', array(
				'id' => 'uservalidationbyadmin-form',
				'action' => 'action/uservalidationbyadmin/bulk_action'
				));
			}}
			break;
	case 'newest':
	/*case 'xl upload':
		require_once "$base/upload.php";*/
	default:
        $options['func'] = "elgg_get_entities";
        $options['sobj'] = "mxuserslist";
		$content = elgg_list_entities($options,'member_extend_get_users','elgg_view_entity_list');
		break;
}
		
	if(elgg_is_admin_logged_in() and 
	(($vars['page'] == 'newest') or ($vars['page'] == 'popular') or ($vars['page'] == 'online')) OR $_SESSION['member_exten_owner'] == true)
		{
	$group_list .= elgg_view_form('members/selected_groups',array());
	}
	$params = array(
	'content' => elgg_view('members/nav', array('selected' => $vars['page'])).$group_list.$content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $title . " ($num_members)",
	'filter_override' => false,
);
if(elgg_is_admin_logged_in() OR $_SESSION['member_exten_owner'] == true)
$body = elgg_view_layout('one_column', $params);
else
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

?>

<style type="text/css">

.me_ul_as_table {
	//display:table;
    border-collapse: collapse;
    border-spacing: 0;
	width:auto;
	margin:0px;
	padding:0px;
	overflow-x: scroll !important;
	overflow-y: hidden !important;
}

.me_li_as_tr {
	display: table-row;
}

.me_ul_as_table .dm_li_as_tr:nth-child(even){
    background-color:#ffffff  ;
}
.me_ul_as_table .dm_li_as_tr:nth-child(odd){
    background-color:#e5e5e5;
}

.me_div_as_th
{
	background-color:gray;
	font-size:16px;
	font-weight:bold;
	display:table-row;
    //text-align:center;
	border: 1px solid #000000;
   // vertical-align: middle;
}

.me_div_as_td
{
	display:table-cell;
    text-align:center;
	border: 1px solid #000000;
    vertical-align: middle;
}
.tcell_icon
{
	border: 0px solid #000000;
	float:left;
}
.tcell_blue
{
	float:left;
	border:2px solid;
	border-color:blue;	
}
.tcell_red
{
	display:table-cell;
	float:left;
	border:2px solid;
	border-color:red;	
}
.tcell_green
{
	display:table-cell;
	float:left;
	border:2px solid;
	border-color:green;
}
.tcell_yellow
{
	display:table-cell;
	float:left;
	border:2px solid;
	border-color:yellow;
}

</style>
