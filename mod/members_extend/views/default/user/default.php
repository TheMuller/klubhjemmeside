 <style type="text/css">
.trow
{
    overflow:auto;
    width:100%;
}
.thead
{
	font-weight:bold;
}
.tcell
{
	width:auto;
    float:left;
    padding:0px;
	border:2px solid;
	border-color:red;
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
     width:180px;
    float:left;
    padding:5px;
	height:10px;
}
.outer
{
	height: auto;
	min-height: 80px; 
}
/* ".array(
		'class' => 'elgg-button elgg-button-delete float-alt',
	).">"; */
   </style>
<?php
/**
 * Elgg user display
 *
 * @uses $vars['entity'] ElggUser entity
 * @uses $vars['size']   Size of the icon
 */


if($vars['admin_view']   == true){
$user = $vars['entity'];
echo "<div class='outer'>";
echo "<div class='trow'><div class='tcell'>&nbsp;";
echo elgg_view_entity_icon($user,'tiny')."</div><div class='tcell_large'>&nbsp;";
    echo $user->name;echo "</div><div>";
	
        $options = array(
                          'type' => 'group',
                          'relationship' => 'member',
                          'relationship_guid' => $user->guid,
                          'inverse_relationship' => false,
                          );
		$groups = elgg_get_entities_from_relationship($options);
			//echo "<table align='center'><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			foreach($groups as $group)
			{
				echo "<div class='tcell'>";
				//echo  "<b>".$group->name."_</b>";
				$icon = elgg_view_entity_icon($group, 'tiny', array(
				'img_class' => 'elgg-index-photo',
				//'width' => '700px',
				//'height'=>'230px',
				));
				echo $icon;echo "</div>";
			}
			echo "</div>";
echo "</div>";
}else{
    include elgg_get_root_path() ."views/default/user/default.php";
}
?>
