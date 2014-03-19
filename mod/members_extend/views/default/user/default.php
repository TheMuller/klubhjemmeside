 <style type="text/css">

.tcell
{
	width:auto;
    float:left;
    padding:0px;
	border:0px solid;
	border-color:black;
	padding-bottom:0cm;
}
.tcell_red
{
	width:auto;
    float:left;
    padding:0px;
	border:2px solid;
	border-color:red;
}
.tcell_green
{
	width:auto;
    float:left;
    padding:0px;
	border:2px solid;
	border-color:green;
}
.tcell_yellow
{
	width:auto;
    float:left;
    padding:0px;
	border:2px solid;
	border-color:yellow;
}
.tcell_large
{
     width:110px;
    float:left;
    padding:2px;
	height:10px;
}

/* tr:nth-child(even) {background: #CCC}
tr:nth-child(odd) {background: #FFF} */

   </style>
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
//echo $msg;
/* echo "<div class='thead' style='margin-left:6cm;'>
<div class='thead'><img src='.$msg.'></div>
<div class='thead'>Wrong Group</div>
<div class='thead'>User Image</div>
<div class='thead'>Name</div>
<div class='thead'>User Name</div>
<div class='thead'></div>
</div>";
echo "<br><br>"; */
if($vars['admin_view']   == true){
$user = $vars['entity'];
echo "<table width='1000px'>";
echo "<tr>
<td width='40px'><img src=".$msg." height='30px' width='35px'>&nbsp;</td>&nbsp;";
echo "<td width='150px'><table width='auto'><tr>";
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
			foreach($redgroupids as $redgroupid)
			{
			$group= get_entity($redgroupid);
				echo "<td width='30px' class='tcell_red'>";
				//echo  "<b>".$group->name."_</b>";
				$icon_red = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon_red;echo "</td>";
			}
			echo "</tr></table></td>";
			echo "<td  width='150px'><table width='auto'><tr>";
			foreach($yellowgroupids as $yellowgroupid)
			{
			$group= get_entity($yellowgroupid);
				echo "<td width='30px' class='tcell_yellow'>";
				//echo  "<b>".$group->name."_</b>";
				$icon_yellow = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon_yellow;echo "</td>";
			
			}
			echo "</tr></table></td>";
			echo "<td width='150px'><table width='auto'><tr>";
			foreach($greengroupids as $greengroupid)
			{
			$group= get_entity($greengroupid);
				echo "<td width='30px' class='tcell_green'>";
				//echo  "<b>".$group->name."_</b>";
				$icon_green = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon_green;echo "</td>";
			}
			echo "</tr></table></td>";
echo "<td width='40px'>";
echo elgg_view_entity_icon($user,'tiny')."&nbsp;</td><td width='120px'>";
    echo $user->name;echo "</td>";
	echo "<td width='50px'>5</td>";
	echo "<td width='50px'>10</td>";
	echo "<td width='150px'>Address</td>";
	echo "<td width='65px'>Zipcode</td>";
	echo "<td width='65px'>City</td>";
	echo "<td width='95px'>Phone</td>";
	echo "<td width='100px'>Email</td></tr><tr><td>";
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
	echo $approve.$delete."</td></tr>";
	echo "</table>";
	
	
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}

?>
