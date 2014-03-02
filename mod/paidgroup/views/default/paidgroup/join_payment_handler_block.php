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
                continue; //skip this since I am inactive
            }
        }
        if(!$my_group_guids)$my_group_guids =$mygroup->guid;
        else $my_group_guids .=",".$mygroup->guid;
    }
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
     elgg_set_ignore_access($ia);
//``````````````````````````````````````````````````````````````````````````````````````````````````
////////////////////////////////////////////////////////////////////////////////////////////////////
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
?>
</div>
<style>
.group-gallery-item  {
    float: left;
background:white   ;
    margin-right :8px;
    margin-left :8px;
    margin-bottom :15px;
width:225px;
height:200px;
    box-shadow: 0px 5px 2px #808080;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
}


.group-gallery-item-img {
width:225px;
height:150px;
position:relative;
}
.group-gallery-item-img p {
position:absolute;
top: 5px;
left:5px;
opacity:0;
    word-wrap:break-word;
width:225px;
    height:155px;
overflow:hidden;
}
.group-gallery-item-img:hover img{
opacity:.2;
}
.group-gallery-item-img:hover p {
opacity:1;
    
}
.group-gallery-item-footer {
height:27px;
background:#3287c4;
    
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
}
.group-gallery-item-header {
    height:27px;
    background:#3287c4;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
}
.joinButton {
    text-decoration: none;
	background-color:#44c767;
	-moz-border-radius-topright:28px;
	-webkit-border-radius-topright:28px;
	border-top-right-radius: 10px;
border:1px solid #18ab29;
display:inline-block;
cursor:pointer;
color:#ffffff;
	font-family:arial;
	font-size:17px;
padding:6px 10px;
    width :auto;
height:15px;
	
	text-shadow:0px 1px 0px #2f6627;
}
.joinButton:hover {
    text-decoration:none;
	background-color:#5cbf2a;
}
.joinButton:active {
position:relative;
top:1px;
}
</style>