<?php

$options = array('type' => 'group',);
$MemberFieldLabels  = explode(",",elgg_get_plugin_setting('MemberFieldLabel', 'members_extend'));
$MemberFields  = explode(",",elgg_get_plugin_setting('MemberField', 'members_extend'));
$search_fields = array_merge(array("name"=>"Name"),array_combine($MemberFields,$MemberFieldLabels));
$user = elgg_get_logged_in_user_entity();    

			
	if(!$user->isAdmin()){
		$options['owner_guid'] = $user->guid;
	}
	$groups = elgg_get_entities($options);
	foreach($groups as $group){
		$my_groups[$group->name] = $group->guid;
	}
echo "<div style='padding: 5px;overflow: scroll;overflow-x: scroll;overflow-y: hidden;width: 900px;max-height: 30px;white-space: nowrap;'>";
echo elgg_view('input/checkboxes', array(
            'options' =>$my_groups,   
            'align' => 'horizontal',
			'value' => $_SESSION['member_extend_selected_groups'],
			'name' => 'selected_groups',
        ));
		echo "</div>";
echo elgg_view('input/text',
	array(
		'name'=> 'searchquery',
		'value' =>$_SESSION['searchquery'],
		'style'=>'width: 150px;',
		
	)
);
echo elgg_view('input/dropdown',
	array(
		'name' => 'searchfield',
		'options_values' => $search_fields,
		'value' => $_SESSION['searchfield'],
		'style'=>'width: 150px;height:33px;float:left;',
	)
);
echo elgg_view('input/submit', array('name'=>'submit','value'=>elgg_echo('search')));
echo $_GET['search'];

