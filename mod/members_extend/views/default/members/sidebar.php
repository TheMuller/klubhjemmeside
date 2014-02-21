<?php
/**
 * Members sidebar
 */
 
//if admin, add a box for user adding
$user = get_entity($_SESSION['user']->guid);
if($user){
	if($user->isadmin()){
		$body = elgg_view('output/url', array('href'=>'/members/newuser', 'text'=>elgg_echo('adduser'), 'class'=> 'elgg-button elgg-button-submit'));
		
		echo elgg_view_module('aside', elgg_echo('adduser'), $body);
	}
}

// Tag search
$params = array(
	'method' => 'get',
	'action' => elgg_get_site_url() . 'members/search/tag',
	'disable_security' => true,
);

$body = elgg_view_form('members/tag_search', $params);

echo elgg_view_module('aside', elgg_echo('members:searchtag'), $body);

// name search
$params = array(
	'method' => 'get',
	'action' => elgg_get_site_url() . 'members/search/name',
	'disable_security' => true,
);
$body = elgg_view_form('members/name_search', $params);

echo elgg_view_module('aside', elgg_echo('members:searchname'), $body);