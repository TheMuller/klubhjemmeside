<?php
$myurl_approve= elgg_get_site_url()."action/member/approve";
$myurl_delete= elgg_get_site_url()."action/member/delete";

/**
 * Elgg user display
 *
 * @uses $vars['entity'] ElggUser entity
 * @uses $vars['size']   Size of the icon
 */
 
$msg = elgg_get_site_url()."mod/PHPExcel/msg_icon.png";
if($vars['admin_view']   == true){
$user = $vars['entity'];
$myurl_approve .="?user_guid=".$user->guid;
	$myurl_approve=elgg_add_action_tokens_to_url($myurl_approve);
	$myurl_delete .="?user_guid=".$user->guid;
	$myurl_delete=elgg_add_action_tokens_to_url($myurl_delete);
$approve = elgg_view('output/url', array(
				'href' => $myurl_approve,
				'text' => "Approve",
				'type' => 'button',
			));
	$delete = elgg_view('output/url', array(
				'href' => $myurl_delete,
				'text' => "Remove",
				'type' => 'button',
			));
echo "<div class='me_div_as_td'><img src=".$msg." height='30px' width='35px'></div>";
echo "<div class='me_div_as_td' style='vertical-align:top;'>";
	$sugested_groupids = unserialize($user->suggestedgroupids);
    $options = array(
                    'type' => 'group',
                    'relationship' => 'member',
                    'relationship_guid' => $user->guid,
                    'inverse_relationship' => false,
                    );
    $groups = elgg_get_entities_from_relationship($options);
    $last_dates = unserialize($user->last_dates);
    foreach($groups as $group)
    {
        if($last_dates and ($group->group_paid_flag =='yes')){
            $last_date = $last_dates[$group->guid];
            if(!$last_date or $last_date ==''){
                
                //continue;
            }
        }
		//echo $group->guid;
        if(in_array($group->guid,$sugested_groupids))
        {
            $greengroupids[]=$group->guid;
        }
        else {
            $redgroupids[]=$group->guid;
        }
    }
	//echo "suggested";var_dump($sugested_groupids);
    //echo "green";var_dump($greengroupids);
    //echo "red";var_dump($redgroupids);
   
    $yellowgroupids = array_diff($sugested_groupids, $greengroupids);
    //echo "yellow";var_dump($yellowgroupids);
  
    
			//echo "<table align='center'><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			//$redgroupids = unserialize($user->redgroupids);
			foreach($yellowgroupids as $yellowgroupid)
			{
			$group= get_entity($yellowgroupid);
				echo "<div class='me_div_as_td tcell_yellow'>";
				//echo  "<b>".$group->name."_</b>";
				$icon_yellow = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon_yellow;echo "</div>";
			
			}echo "<br><br>".$approve;
			
			echo "</div>";
			echo "<div class='me_div_as_td' style='vertical-align:top;'>";
			foreach($redgroupids as $redgroupid)
			{
			$group= get_entity($redgroupid);
				echo "<div class='me_div_as_td tcell_red'>";
				//echo  "<b>".$group->name."_</b>";
				$icon_red = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon_red;echo "</div>";
			}echo "<br><br>".$delete;
			echo "</div>";
			
			
			echo "<div class='me_div_as_td' style='vertical-align:top;'>";
			foreach($greengroupids as $greengroupid)
			{
			$group= get_entity($greengroupid);
				echo "<div class='me_div_as_td tcell_green'>";
				//echo  "<b>".$group->name."_</b>";
				$icon_green = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon_green;echo "</div>";
			}
			echo "</div>";
echo "<div class='me_div_as_td'>";
echo elgg_view_entity_icon($user,'tiny')."&nbsp;</div><div class='me_div_as_td'>";
    echo $user->name;echo "</div>";
	echo "<div class='me_div_as_td'>5</div>";
	echo "<div class='me_div_as_td'>10</div>";
	echo "<div class='me_div_as_td'>Address</div>";
	echo "<div class='me_div_as_td'>Zipcode</div>";
	echo "<div class='me_div_as_td'>City</div>";
	echo "<div class='me_div_as_td'>Phone</div>";
	echo "<div class='me_div_as_td'>Email</div>";
	//echo "</table>";
	
	
	
	
			
			
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}

?>
