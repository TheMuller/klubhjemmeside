<?php

$options = array('type' => 'group',);
$visibility=array(
	'1'=>'Name',
	'2'=>'Mobile Phone',
	'3'=>'Location',
);				 
    $groups = elgg_get_entities($options);
	foreach($groups as $group)
    {
	$myarr[$group->name] = $group->guid;
	}
echo elgg_view('input/checkboxes', array(
            'options' =>$myarr,   
            'align' => 'horizontal',
			'value' => $_SESSION['member_extend_selected_groups'],
			'name' => 'selected_groups',
        ));
echo elgg_view('input/text',
	array(
		'name'=> 'search',
		'value' =>'ajay',
		'style'=>'width: 150px; height: 50%;float:left;',
		
	)
);
echo elgg_view('input/dropdown',
	array(
		'name' => 'type',
		'options_values' => $visibility,
		'value' => $item[visibility],
		'style'=>'width: 90px; height: 50%;',
	)
);
	
echo elgg_view('input/submit', array('name'=>'submit','value'=>elgg_echo('event_calendar:submit')));
echo $_GET['search'];

