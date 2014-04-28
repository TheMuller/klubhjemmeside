<?php elgg_load_css("paidgroup.paidgroup"); ?>

<h2>Select (Premium) Group</h2>
<div style='min-height:400px'>
<?php

	$Groups_Access_Style=elgg_get_plugin_setting('groups_access_style','paidgroup');
	
    $options = array(
                    'list_type'=>'gallery',
                    'item_class'=>'group-gallery-item ',
                    'gallery_class'=> 'clearfix',
                    'limit' =>8,
                    'pagination'=>$vars[pagination],
                    'type' => 'group',
                    'full_view' => false,
                    'paid_view' => true,
                    );
    $user = elgg_get_logged_in_user_entity();

    $my_groups = $user->getGroups();
    $last_dates = unserialize($user->last_dates);
    foreach($my_groups as $mygroup){
        if($mygroup->group_paid_flag =='yes'   ){
            $last_date = $last_dates[$mygroup->guid];
            if(!$last_date or $last_date ==''){
				if(!$my_inactive_guids)$my_inactive_guids =$mygroup->guid;
				else $my_inactive_guids .=",".$mygroup->guid;
				continue; //skip this since I am inactive
            }
        }
        if(!$my_group_guids)$my_group_guids =$mygroup->guid;
        else $my_group_guids .=",".$mygroup->guid;
    }
	$view_type = get_input('view_type','');
	if($view_type == 'inactive' or $view_type == ''){
		echo "<div align='right' style='margin-right:1cm;'>";

		//else echo "No inactive";
		if(count($my_inactive_guids)){
			echo elgg_view("output/url", array( "href" => '?view_type=all', "text" => elgg_echo('all'), "is_trusted" => true,"class" => "elgg-button elgg-button-submit"));echo "</div><br>";
			$options['wheres'][] = "e.guid  IN (".$my_inactive_guids.")";
		    $ia = elgg_set_ignore_access(true);
			echo elgg_list_entities_from_metadata($options);			
		}else{
			if($view_type == 'inactive'){
					echo elgg_view("output/url", array( "href" => '?view_type=all', "text" => elgg_echo('all'), "is_trusted" => true,"class" => "elgg-button elgg-button-submit"));echo "</div><br>";
			echo "no inactive";
			}else{
				$view_type = 'all';
			}
			
		}
		
	}
	if($view_type == 'all'){
	echo "<div align='right' style='margin-right:1cm;'>";
		echo elgg_view("output/url", array( "href" => '?view_type=inactive', "text" => elgg_echo('paidgroup:inactive'), "is_trusted" => true,"class" => "elgg-button elgg-button-submit",'alignment' =>
'horizontal'));echo "</div><br>";
	
     if($my_group_guids){ //exclude groups which I already joined, (and active if paid).
      //  $options['joins'][]= "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid";
       // $options['wheres'][] = "e.guid NOT IN (select guid_two from {$CONFIG->dbprefix}entity_relationships  where relationship = 'member' AND guid_one = ".$user_guid.")";
        $options['wheres'][] = "e.guid NOT IN (".$my_group_guids.")";
        
    }
 	$options['joins'][]  = "JOIN {$CONFIG->dbprefix}metadata membership on e.guid=membership.entity_guid";
	$options['joins'][]  = "JOIN {$CONFIG->dbprefix}metastrings membership_name on membership.name_id=membership_name.id";
	$options['joins'][]  = "JOIN {$CONFIG->dbprefix}metastrings membership_value on membership.value_id=membership_value.id";
	$options['joins'][]  = "JOIN {$CONFIG->dbprefix}metadata gpflg on e.guid=gpflg.entity_guid";
	$options['joins'][]  = "JOIN {$CONFIG->dbprefix}metastrings gpflg_name on gpflg.name_id=gpflg_name.id";
	$options['joins'][]  = "JOIN {$CONFIG->dbprefix}metastrings gpflg_value on gpflg.value_id=gpflg_value.id";
	$options['wheres'][] = "membership_name.string='membership'";
	$options['wheres'][] = "gpflg_name.string='group_paid_flag'";
    
    $showopengrps = elgg_get_plugin_setting('showopengrps','paidgroup');
    $showclosegrps = elgg_get_plugin_setting('showclosegrps','paidgroup');
    $showpaidgrps = elgg_get_plugin_setting('showpaidgrps','paidgroup');
   // echo $showopengrps." ".$showclosegrps." ".$showpaidgrps;
    $newwhereclause = '';
    if($showpaidgrps){
        $newwhereclause .="gpflg_value.string = 'yes'";
        $jflag = " OR ";
    }else{
        $newwhereclause .="gpflg_value.string != 'yes'";
        $jflag = " AND ";
    }
 
    //if still confusion persist , we can work on accessid or visibility.
    if(($showopengrps == 1) and ($showclosegrps != 1)){
        $newwhereclause .= $jflag."membership_value.string=".ACCESS_PUBLIC;
    }elseif(($showopengrps != 1) and ($showclosegrps == 1)){
        $newwhereclause .= $jflag."membership_value.string=".ACCESS_PRIVATE;
    }elseif(($showopengrps == 1) and ($showclosegrps == 1)){
        if($showpaidgrps){
            $newwhereclause ="";
        }
    }
	$options['wheres'][] = $newwhereclause;
    // echo elgg_list_entities($options,'elgg_get_entities','paid_group_viewer');
    $ia = elgg_set_ignore_access(true);
   
    echo elgg_list_entities_from_metadata($options);	
    }
     elgg_set_ignore_access($ia);
//``````````````````````````````````````````````````````````````````````````````````````````````````
////////////////////////////////////////////////////////////////////////////////////////////////////
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
?>
</div>
