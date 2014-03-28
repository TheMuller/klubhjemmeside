<?php
/**
 * Members index
 *
 */
function member_extend_get_users(array $options = array(),$func='elgg_get_entities'){
    $countopt = $options['count'];
    $limitopt = $options['limit'];
    $offsetopt = $options['offset'];
     if(!$_SESSION[$options['sobj']]){
        $options['count'] = false;$options['limit'] = 0;$options['offset'] =0;
        $_SESSION[$options['sobj']] = $options['func']($options);
        if(!empty($_SESSION['member_extend_selected_groups'])){
            foreach($_SESSION[$options['sobj']] as $key=>$user){
                $found = false;
                foreach($_SESSION['member_extend_selected_groups'] as $group_guid){
                    $group = get_entity($group_guid);
                    if($group->isMember($user)){
                        if($last_dates and ($group->group_paid_flag =='yes')){
                            $last_date = $last_dates[$group->guid];
                            if(!$last_date or $last_date =='')continue;
                        }
                        $found = true;break;
                    }
                }
                if(!$found)unset($_SESSION[$options['sobj']][$key]);
            }
        }
     }
    if($countopt) {
        return count($_SESSION[$options['sobj']]);
    }
    else {
        return array_slice($_SESSION[$options['sobj']],$offsetopt,$limitopt);
    }
}

/*$user = elgg_get_logged_in_user_entity();
echo $user->suggestedgroupids."/";
$site = elgg_get_site_entity();
$suggestedgroupids = unserialize($site->suggestedgroupids);
		foreach($suggestedgroupids as $key=>$suggestedgroupid){
		echo $key;
		var_dump($suggestedgroupid);
		}*/
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

if(elgg_is_admin_logged_in())$options['admin_view'] = true;
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
	(($vars['page'] == 'newest') or ($vars['page'] == 'popular') or ($vars['page'] == 'online')))
		{
	$group_list .= elgg_view_form('members/selected_groups',array());
	}
	$params = array(
	'content' => elgg_view('members/nav', array('selected' => $vars['page'])).$group_list.$content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $title . " ($num_members)",
	'filter_override' => false,
);
if(elgg_is_admin_logged_in())
$body = elgg_view_layout('one_column', $params);
else
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

?>

<style type="text/css">

.me_ul_as_table {
display:table;
    border-collapse: collapse;
    border-spacing: 0;
width:100%;
margin:0px;padding:0px;
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
