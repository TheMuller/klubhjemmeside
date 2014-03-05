<?php
/**
* Groups plugin settings
**/
?>
<style>
.Group0{width:99%;height:30px;float:left;margin-bottom:-10px;}
.Group1{width:40%;height:30px;float:left;margin-bottom:-10px;}
.Group2{width:59%;height:40px;float:left;margin-bottom:-10px;}
.Group3{width:26%;height:40px;float:left;margin-bottom:2px;}
.Group2SCR{overflow:auto;height:150px;width:90%;;height:40px;}
.Clear1{height:0px;clear:both;}
</style>
<?php

////////////////////////////////////////////////////////////////////////////////////////////////////
    if (!isset($vars['entity']->groups_payment_mode)){	//:DC:
        $vars['entity']->groups_payment_mode = 3;
    }
    echo '<div class="Group1">';
    echo elgg_echo('groups:groups:payment:mode');
    $GroupsStyles=array(
                        '1'=>'Local Test',
                        '2'=>'DIBS Test',
                        '3'=>'DIBS Live',
                        );
    echo '</div>';
    echo '<div class="Group2">';
    echo elgg_view('input/dropdown',
                   array(
                         'name' => 'params[groups_payment_mode]',
                         'options_values' => $GroupsStyles,
                         'value' => $vars['entity']->groups_payment_mode,
                         )
                   );
    echo '</div>';
    echo '<div class="Clear1"></div>';

////////////////////////////////////////////////////////////////////////////////////////////////////
if (!isset($vars['entity']->groups_access_style)){	//:DC:
	$vars['entity']->groups_access_style = 1;
}
echo '<div class="Group1">';
echo elgg_echo('groups:groups:access:style');
$GroupsStyles=array(
	'1'=>'Open-Access',
	'2'=>'Group-Membership',
	'3'=>'Group-Paid$',
);
echo '</div>';
echo '<div class="Group2">';
echo elgg_view('input/dropdown',
	array(
		'name' => 'params[groups_access_style]',
		'options_values' => $GroupsStyles,
		'value' => $vars['entity']->groups_access_style,
	)
);
echo '</div>';
echo '<div class="Clear1"></div>';

////////////////////////////////////////////////////////////////////////////////////////////////////
/**if (!isset($vars['entity']->groups_access_admin_approve)){	//:DC:
	$vars['entity']->groups_access_admin_approve = 'no';
}
echo '<div class="Group1">';
echo elgg_echo('groups:groups:access:adminapprove');
echo '</div>';
echo '<div class="Group2">';
echo elgg_view('input/dropdown',
	array(
		'name' => 'params[groups_access_adminapprove]',
		'options_values' => array(
			'no' => elgg_echo('option:no'),
			'yes' => elgg_echo('option:yes'),
		),
		'value' => $vars['entity']->groups_access_adminapprove,
	)
);
echo '</div>';
echo '<div class="Clear1"></div>';
**/
////////////////////////////////////////////////////////////////////////////////////////////////////
/**if (!isset($vars['entity']->groups_access_admin_email)){	//:DC:
	$vars['entity']->groups_access_admin_email = 'no';
}
echo '<div class="Group1">';
echo elgg_echo('groups:groups:access:adminemail');
echo '</div>';
echo '<div class="Group2">';
echo elgg_view('input/dropdown',
	array(
		'name' => 'params[groups_access_adminemail]',
		'options_values' => array(
			'no' => elgg_echo('option:no'),
			'yes' => elgg_echo('option:yes'),
		),
		'value' => $vars['entity']->groups_access_adminemail,
	)
);
echo '</div>';
echo '<div class="Clear1"></div>';
**/
////////////////////////////////////////////////////////////////////////////////
if (!isset($vars['entity']->groups_currency)){	//:DC:
	$vars['entity']->groups_currency = 'DKK';
}
echo '<div class="Group1">';
echo elgg_echo('groups_currency');
$CurrOptions=array(
	'DKK'=>' DKK ',
);
echo '</div>';
echo '<div class="Group2">';
echo elgg_view('input/dropdown',
	array(
		'name'=>'params[groups_currency]',
		'value' => $groups_currency,
		'options_values' => $CurrOptions,
	)
);
echo '</div>';
echo '<div class="Clear1"></div>';

/**
////////////////////////////////////////////////////////////////////////////////
if (!isset($vars['entity']->groups_categories)){	//:DC:
	$vars['entity']->groups_categories = '';
}
echo '<div class="Group1">';
echo elgg_echo('groups_categories');
echo '<div class="Clear1"></div>';
$CategoriesOptions=array(
	''=>'',
	'1'=>' AAAA ',
);
//	explode
echo '</div>';
echo '<div class="Group0">';
echo '<br>';
echo '<div class="Group2SCR" style="overflow:auto;height:150px;width:125%;border:dotted #00F 0px;"';
for($iC=1;$iC<=33;$iC++)
{
	echo elgg_view('input/text',
		array(
			'name'=>'params[groups_categories]',
			'value' => $CategoriesOptions[$iC],
			'class'=>"Group3"
		)
	);
}
echo '</div>';
echo '</div>';
echo '<div class="Clear1"></div>';
**/

////////////////////////////////////////////////////////////////////////////////
if (!isset($vars['entity']->groups_merchant_number)){	//:DC:
	$vars['entity']->groups_merchant_number = '';
}
    
echo '<div class="Group1">';
echo elgg_echo('groups_merchant_number');
echo '</div>';
echo '<div class="Group2">';

echo elgg_view('input/text',
	array(
		'name'=>'params[groups_merchant_number]',
		'value' => $vars['entity']->groups_merchant_number,
	)
);
echo '</div>';
echo '<div class="Clear1"></div>';

////////////////////////////////////////////////////////////////////////////////
if (!isset($vars['entity']->groups_md5secret)){	//:DC:
	$vars['entity']->groups_md5secret = '';
}
echo '<div class="Group1">';
echo elgg_echo('groups_md5secret');
echo '</div>';
echo '<div class="Group2">';
echo elgg_view('input/text',
	array(
		'name'=>'params[groups_md5secret]',
		'value' => $vars['entity']->groups_md5secret,
	)
);
echo '</div>';
echo '<div class="Clear1"></div>';

////////////////////////////////////////////////////////////////////////////////////////////////////
    $showopengrps= $vars['entity']->showopengrps;
    $showclosegrps= $vars['entity']->showclosegrps;
    $showpaidgrps= $vars['entity']->showpaidgrps;
    
    echo "<br><div style='border:1px dashed;'> <label>Types of groups to be shown in Group gallery</label><br>";
    
    echo "Open :";
    echo "<input type='hidden' name='params[showopengrps]' value='0'/>";
    if($showopengrps =='1')
    echo "<input type='checkbox' name='params[showopengrps]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[showopengrps]' value='1' />";
    
    
    echo "&nbsp&nbsp&nbsp&nbspClosed :";
    echo "<input type='hidden' name='params[showclosegrps]' value='0'/>";
    if($showclosegrps =='1')
    echo "<input type='checkbox' name='params[showclosegrps]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[showclosegrps]' value='1' />";
    
    echo "&nbsp&nbsp&nbsp&nbspPaid :";
    echo "<input type='hidden' name='params[showpaidgrps]' value='0'/>";
    if($showpaidgrps =='1')
    echo "<input type='checkbox' name='params[showpaidgrps]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[showpaidgrps]' value='1' />";
    echo "</div>";
    $groupforce_open_paid= $vars['entity']->groupforce_open_paid;
    $groupforce_open_unpaid= $vars['entity']->groupforce_open_unpaid;
    
    $groupforce_close_paid= $vars['entity']->groupforce_close_paid;
    $groupforce_close_unpaid= $vars['entity']->groupforce_close_unpaid;
    
   
    echo "<br><br><div style='border:1px dashed;'> <label>Force Group gallery if user is not member of this..</label><br>";
    
    echo "Open  Paid :";
    echo "<input type='hidden' name='params[groupforce_open_paid]' value='0'/>";
    if($groupforce_open_paid =='1')
    echo "<input type='checkbox' name='params[groupforce_open_paid]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[groupforce_open_paid]' value='1' />";
    
    
    echo "&nbsp&nbsp&nbsp&nbspOpen unpaid :";
    echo "<input type='hidden' name='params[groupforce_open_unpaid]' value='0'/>";
    if($groupforce_open_unpaid =='1')
    echo "<input type='checkbox' name='params[groupforce_open_unpaid]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[groupforce_open_unpaid]' value='1' />";
    
    echo "&nbsp&nbsp&nbsp&nbspClosed Paid :";
    echo "<input type='hidden' name='params[groupforce_close_paid]' value='0'/>";
    if($groupforce_close_paid =='1')
    echo "<input type='checkbox' name='params[groupforce_close_paid]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[groupforce_close_paid]' value='1' />";

    
    echo "&nbsp&nbsp&nbsp&nbspClosed  Unpaid :";
    echo "<input type='hidden' name='params[groupforce_close_unpaid]' value='0'/>";
    if($groupforce_close_unpaid =='1')
    echo "<input type='checkbox' name='params[groupforce_close_unpaid]' value='1' checked/>";
    else
    echo "<input type='checkbox' name='params[groupforce_close_unpaid]' value='1' />";
    echo "</div>";
?>