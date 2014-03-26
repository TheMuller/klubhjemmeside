<?php

$options = array('type' => 'group',);
				 
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
echo elgg_view('input/submit', array('name'=>'submit','value'=>elgg_echo('event_calendar:submit')));

