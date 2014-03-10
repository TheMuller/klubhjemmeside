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
/* tooltip basic link styles */
  .tooltip:link,
  .tooltip:visited {
    position:absolute;
    text-decoration:underline;
  }
  .tooltip:hover {
    text-decoration:none; /* remove underline on tooltip text */
  }

  /* tooltip body text */
  .tooltip:hover:before {
    display:inline;
    background:#eee;
    background:-webkit-gradient(linear, 0 0, 0 100%, from(rgba(255,205,205,0.9)), to(rgba(228,230,230,0.9)));
    background:-moz-linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    background:-o-linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    background:linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    content:attr(data-tooltip); /* this link attribute contains tooltip text */
    position:absolute;
    font-size:0.9em;
    color:rgba(51,51,51,0.9);
    bottom:20px;/* ensure link text is visible under tooltip */
    right:-60px;  /* align both tooltip and link right edges */
    width:9em;  /* a reasonable width to wrap tooltip text */
    text-align:center;
    padding:4px;
    border:2px solid rgba(204,153,153,0.9);
    -webkit-border-radius:6px;
       -moz-border-radius:6px;
        -ms-border-radius:6px;
         -o-border-radius:6px;
            border-radius:6px;
    -webkit-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
       -moz-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
        -ms-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
         -o-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
            box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
  }

  /* styles shared by both triangles */
  .tooltip:hover span:before,
  .tooltip:hover span:after {
    content:"";
    position:relative;
    border-style:solid;
  }
  /* outer triangle: for border */
  .tooltip:hover span:before {
  position:absolute;
    bottom:5px; /* value = tooltip:hover:before (border-width*2)+1 */
    right:10px; /* controls horizontal position */
    border-width:16px 16px 0; /* top, right-left, bottom */
    border-color:rgba(204,153,153,0.9) transparent; /* top/bottom, right-left (lazy becasue bottom is 0) */
  }

  /* inner triangle: for fill */
  .tooltip:hover span:after {
  position:absolute;
    bottom:8px; /* value = tooltip:before (border-width*2) */
    right:12px; /* above 'right' value + 2 */
    border-width:14px 14px 0; /* 2 less than above */
    border-color:rgba(225,238,238,0.95) transparent; /* tweak opacity by eye/eyedropper to obscure outer triangle colour */
  }
  
  
/* tooltip1 basic link styles */
  .tooltip1:link,
  .tooltip1:visited {
    position:absolute;
    text-decoration:underline;
  }
  .tooltip1:hover {
    text-decoration:none; /* remove underline on tooltip1 text */
  }

  /* tooltip1 body text */
  .tooltip1:hover:before {
    display:inline;
    background:#eee;
    background:-webkit-gradient(linear, 0 0, 0 100%, from(rgba(255,205,205,0.9)), to(rgba(228,230,230,0.9)));
    background:-moz-linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    background:-o-linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    background:linear-gradient(rgba(255,205,205,0.9), rgba(228,230,230,0.9));
    content:attr(data-tooltip1); /* this link attribute contains tooltip1 text */
    position:absolute;
    font-size:0.9em;
    color:rgba(51,51,51,0.9);
    top:-39px;/* ensure link text is visible under tooltip1 */
    right:-80px;  /* align both tooltip1 and link right edges */
    width:9em;  /* a reasonable width to wrap tooltip1 text */
    text-align:center;
    padding:4px;
    border:2px solid rgba(204,153,153,0.9);
    -webkit-border-radius:6px;
       -moz-border-radius:6px;
        -ms-border-radius:6px;
         -o-border-radius:6px;
            border-radius:6px;
    -webkit-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
       -moz-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
        -ms-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
         -o-box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
            box-shadow:-2px -2px 2px rgba(20,20,20,0.4);
  }

  /* styles shared by both triangles */
  .tooltip1:hover span:before,
  .tooltip1:hover span:after {
    content:"";
    position:relative;
    border-style:solid;
  }
  /* outer triangle: for border */
  .tooltip1:hover span:before {
  position:absolute;
    top:-8px; /* value = tooltip1:hover:before (border-width*2)+1 */
    right:-14px; /* controls horizontal position */
    border-width:16px 16px 0; /* top, right-left, bottom */
    border-color:rgba(204,153,153,0.9) transparent; /* top/bottom, right-left (lazy becasue bottom is 0) */
  }

  /* inner triangle: for fill */
  .tooltip1:hover span:after {
  position:absolute;
    top:-8px; /* value = tooltip1:before (border-width*2) */
    right:-12px; /* above 'right' value + 2 */
    border-width:14px 14px 0; /* 2 less than above */
    border-color:rgba(225,238,238,0.95) transparent; /* tweak opacity by eye/eyedropper to obscure outer triangle colour */
  }
.group-gallery-item  {
    float: left;
background:white   ;
    margin-right :8px;
    margin-left :8px;
    margin-bottom :15px;
width:225px;
height:200px;
    box-shadow: 6px 8px 3px #808080;
    border: 5px;

    -webkit-border: 5px;
    -moz-border: 5px;
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
height:40px;
background:#000;
    color:gray;
    border: 5px;
    border: 5px;
    -webkit-border: 5px;
    -moz-border: 5px;
}
.group-gallery-item-header {
	//font-weight:bold;
	font-size-adjust: 0.58;
	color:gray;
    height:20px;
    background:#000000;
    border: 5px;
    border: 5px;
    -webkit-border: 5px;
    -moz-border: 5px;
}
.joinButton {
    text-decoration: none;
	//background-color:#44c767;
	background-color:#fffff;
	-moz-border-radius-topright:28px;
	-webkit-border-radius-topright:28px;
	border: 10px;
	//border:1px solid #18ab29;
border-left:1px solid #ffffff;
//border-bottom:0px solid #000000;
display:inline-block;
cursor:pointer;
color:#ffffff;
	font-family:arial;
	font-size:16px;
padding:3px 7px;
    width :auto;
height:10px;
	
	text-shadow:0px 1px 0px #2f6627;
}
.joinButton:hover {
    text-decoration:none;
	background-color:#5cbf2a;
}
.joinButton:active {
position:absolute;
top:1px;
}
</style>