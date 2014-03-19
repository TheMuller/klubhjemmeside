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
.tcell_blue
{
	width:auto;
    float:left;
    padding:0px;
	border:2px solid;
	border-color:blue;
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
echo "<table width='auto'>";
echo "<tr>
<td width='40px'><img src=".$msg." height='30px' width='35px'>&nbsp;</td>&nbsp;";
echo "<td><table width='200px'><tr>";
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
                $user_inactive = false;//inactive member, so skip
                continue;
            }
        }
		echo $group->guid;
        if(in_array($group->guid,$sugested_groupids))
        {
            $greengroupids[]=$group->guid;
        }
        else {
            $redgroupids[]=$group->guid;
        }
    }
    var_dump($greengroupids);
    var_dump($redgroupids);
   
    $yellowgroupids = array_diff($sugested_groupids, $greengroupids);
    var_dump($yellowgroupids);
  
    
			//echo "<table align='center'><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			//$redgroupids = unserialize($user->redgroupids);
			foreach($redgroupids as $redgroupid)
			{
			$group= get_entity($redgroupid);
				echo "<td class='tcell_red'>";
				//echo  "<b>".$group->name."_</b>";
				$icon = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon;echo "</td>";
			}
			echo "</tr></table></td>";
echo "<td width='40px'>";
echo elgg_view_entity_icon($user,'tiny')."&nbsp;</td><td width='120px'>&nbsp;";
    echo $user->name;echo "</td>";
	echo "<td width='50px'>5</td>";
	echo "<td width='50px'>10</td>";
	echo "<td width='150px'>Address</td>";
	echo "<td width='65px'>Zipcode</td>";
	echo "<td width='65px'>City</td>";
	echo "<td width='95px'>Phone</td>";
	echo "<td width='100px'>Email</td>";
	echo "</table>";
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}

?>
