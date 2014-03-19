<?php
/**
 * Members index
 *
 */
$site = elgg_get_site_entity();
//$suggestedgroupids = unserialize($site->suggestedgroupids);
//var_dump($suggestedgroupids);
$base = elgg_get_plugins_path() . 'members_extend/pages/members';
$num_members = get_number_users();

$title = elgg_echo('members');

$options = array('type' => 'user', 'full_view' => false);
if(elgg_is_admin_logged_in())$options['admin_view'] = true;
switch ($vars['page']) {
	case 'popular':
		$options['relationship'] = 'friend';
		$options['inverse_relationship'] = false;
		$content = elgg_list_entities_from_relationship_count($options);
		break;
	case 'online':
		$content = get_online_users();
		break;
		
	case 'unvalidated':
		$user= get_entity($_SESSION['user']->guid);
		if($user){
			if($user->isAdmin()){
				$content = elgg_view_form('uservalidationbyadmin/bulk_action', array(
				'id' => 'uservalidationbyadmin-form',
				'action' => 'action/uservalidationbyadmin/bulk_action'
				));
			}}
			break;
	case 'newest':
	/*case 'xl upload':
		require_once "$base/upload.php";*/
	default:
		$content = elgg_list_entities($options);
		break;
}

$params = array(
	'content' => elgg_view('members/nav', array('selected' => $vars['page'])).$content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $title . " ($num_members)",
	'filter_override' => false,
);
if(elgg_is_admin_logged_in())
$body = elgg_view_layout('one_column', $params);
else
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
