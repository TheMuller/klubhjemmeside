<style>
.elgg-index-photo 
{
border: 1px solid #ccc;
box-shadow: 0px 5px 2px #808080;
border-top-left-radius: 15px; 
border-top-right-radius: 15px; 
-webkit-border-top-right-radius: 15px; 
-webkit-bordertop-left-radius: 15px;
-moz-border-top-left-radius: 15px;	
-moz-border-top-right-radius: 15px;
}
</style>
<?php


//$projects = elgg_get_entities_from_metadata($options); 
   
$groups = elgg_get_entities_from_metadata(array(
	'metadata_name' => 'featured_group',
	'metadata_value' => 'yes',
	'types' => 'group',
	'limit' => 10,
));


if(count($groups) ==0)
{
	echo "There are no featured group.";
}

$count = 0;
foreach($groups as  $group)
{
	$count++;

	$member_count = $group->getMembers(0, 0, TRUE);
	$icon = elgg_view_entity_icon($group, 'large', array(
		'img_class' => 'elgg-index-photo',
		'width' => '100%',
		'height'=>'230px',
		'max-width'=>'700px',
		));
	$events  = elgg_get_entities(array(
		'limit' =>3,
		'type' => 'object',
		'subtype' => 'project',
		'owner_guid'=>$group->guid,
		));
	
	
	$projecturl = $group->getURL();
	$user_guid = elgg_get_logged_in_user_guid ();

	$title = $group->name;
	$daysleft = "<strong style='font-size:18px;color:green;'>Event : </strong><strong style='color:white;'>".$events[0]->title."</strong>";
	$bgurl =  elgg_get_site_url()."mod/project/graphics/bg_view_campaign.png";
	
	
	
echo <<<___HTML
<div id='project_tools_indexgroup_div_$count' style='display : none;max-width:702px;'>
		$icon
<div style="position:static;bottom:190px; width:100%; max-width:702px; border-bottom-right-radius:15px;border-bottom-left-radius:15px;
            background-color:black;opacity:0.8;filter:alpha(opacity=80); height:67px;">
 
 <div class="elgg-col" style="margin-left:20px;margin-top:5px;">
    <h2 style="color:white;" >
          <b> $title</b>
    </h2>
    <div class="clearfix">
		<table>	<tr>
			<td style="padding-right:10px;">
				<strong style="font-size:18px;color:green;">$member_count</strong><strong style="color:white;">$nbsp member</strong>
			</p></td>
			<td width="1px" bgcolor="#FFFFFF" ></td>
			<td style="padding-left:10px;">
				$daysleft
			<td >	<a href="$projecturl">
					<span style="right:30px; height:30px; width:137px; position:absolute; bottom:10px; background: url($bgurl);">
					</span>	</a>
			</td>
		</tr></table>
	</div>
</div>
 
 </div>	
</div>
___HTML;
}


echo <<<___HTML
<script type='text/javascript'>
var gcount=$count;
var gstep=1;
function slidegroup(){
	for(var i=1;i<=gcount;i++)
	{
		if(i == gstep){
			$('#project_tools_indexgroup_div_'+i).show();
		}
		else{
			$('#project_tools_indexgroup_div_'+i).hide();
		}
	}
	if (gstep<gcount)
	gstep++
	else
	gstep=1
	setTimeout('slidegroup()',5000)
}
slidegroup()
</script>
___HTML;






?>
