<?php
/**
 * Members navigation
 */
 	$myurl= elgg_get_site_url()."action/member/download";
	$myurl = elgg_add_action_tokens_to_url($myurl);
	$created_time = elgg_get_plugin_setting('created_time');
$tabs = array(
	'newest' => array(
		'text' => elgg_echo('members:label:newest'),
		'href' => "members/newest",
		'selected' => $vars['selected'] == 'newest',
	),
	'popular' => array(
		'text' => elgg_echo('members:label:popular'),
		'href' => "members/popular",
		'selected' => $vars['selected'] == 'popular',
	),
	'online' => array(
		'text' => elgg_echo('members:label:online'),
		'href' => "members/online",
		'selected' => $vars['selected'] == 'online',
	),
	

);
$user= get_entity($_SESSION['user']->guid);
if($user){
	if($user->isAdmin() ){
        if(($vars['selected'] == 'newest') or ($vars['selected'] == 'popular') or ($vars['selected'] == 'online'))
		{
		    $MemberFieldLabels  = explode(",",elgg_get_plugin_setting('MemberFieldLabel', 'members_extend'));
			$MemberFields  = explode(",",elgg_get_plugin_setting('MemberField', 'members_extend'));
			$orderby = get_input('orderby','');	
			$sorting = get_input('sorting','');
			$sorting_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
	
			if($orderby == 'username'){
				$opacity = 1;
				if ($sorting == 'DESC'){
					$sorting_path = "<img src='{$sorting_path}sort_down_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
					$newsorting='ASC';
				}else{
					$sorting_path = "<img src='{$sorting_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
					$newsorting='DESC';
				}
			}else{
				$opacity =0.3;
				$sorting_path = "<img src='{$sorting_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
				$newsorting='DESC';
			}
		
			echo "<li id='table_header' class ='me_div_as_th' style='display:none;'> <div class ='me_div_as_td' >Msg's</div><div class ='me_div_as_td' > ".elgg_echo('members:suggested_group')."</div><div class ='me_div_as_td' >".elgg_echo('members:not_suggested_group')."</div><div class ='me_div_as_td' >".elgg_echo('members:member_group')."</div><div class ='me_div_as_td' >".elgg_echo('members:image')."</div>";
			if($created_time == '1'){echo "<div class ='me_div_as_td' >".elgg_echo('members:join_date')."</div>";}
			echo "<div class ='me_div_as_td' >".elgg_echo('members:name')."&nbsp;&nbsp;".
				elgg_echo('').
                elgg_view('output/url',array('text' => $sorting_path,'href' => "members"
                                                      ."?orderby=username"
                                                      ."&sorting="
                                                      .$newsorting,
                                                  //    'is_action' => TRUE,
													  )).
			"</div><div class ='me_div_as_td' >".elgg_echo('event_calendar:paged:column:event')."</div>";
				
			foreach($MemberFieldLabels as $key=>$MemberFieldLabel){
				$sorting_path = elgg_get_site_url()."mod/event_calendar_extend/graphics/";
				if($orderby == $MemberFields[$key]){
				$opacity = 1;
					if ($sorting == 'DESC'){
						$sorting_path = "<img src='{$sorting_path}sort_down_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
						$newsorting='ASC';
					}else{
						$sorting_path = "<img src='{$sorting_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
						$newsorting='DESC';
					}
				}else{
					$opacity =0.3;
					$sorting_path = "<img src='{$sorting_path}sort_up_green.png' style='height:20px; width:20px; opacity:$opacity;'></img>";
					$newsorting='DESC';
				}
	
				echo "<div class ='me_div_as_td' >$MemberFieldLabel"."&nbsp;&nbsp;".
				elgg_echo('').
                elgg_view('output/url',array('text' => $sorting_path,'href' => "members"
                                                      ."?orderby=".$MemberFields[$key]
                                                      ."&sorting="
                                                      .$newsorting,
                                                   //   'is_action' => TRUE,
													  ))."</div>";
			}
			echo "</li>";
		}
?>
<script type="text/javascript">
function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}

function on_select_sorting(field,sorting){
     var newurl =  updateQueryStringParameter(window.location.href,'orderby',field);
	 if(sorting !=''){
		newurl =  updateQueryStringParameter(newurl,'sorting',sorting);
	 }
	 window.location = newurl;
}
$(document).ready(function() {
    var node = document.getElementById('table_header');
    if($(".me_ul_as_table").length){
        $(".me_ul_as_table").prepend($("#table_header"));
        $('#table_header').show();
    }
});
</script>
<?php
		$tabs = array(
		'newest' => array(
		'text' => elgg_echo('members:label:newest'),
		'href' => "members/newest",
		'selected' => $vars['selected'] == 'newest',
	),
	'popular' => array(
		'text' => elgg_echo('members:label:popular'),
		'href' => "members/popular",
		'selected' => $vars['selected'] == 'popular',
	),
	'online' => array(
		'text' => elgg_echo('members:label:online'),
		'href' => "members/online",
		'selected' => $vars['selected'] == 'online',
	),
	'unvalidated' =>  array(
				'text' => elgg_echo('admin:users:unvalidated'),
				'href' => "members/unvalidated",
				'selected' => $vars['selected'] == 'unvalidated',
	),
	'xlupload' => array(
            'text' => elgg_echo('members:xl_upload'),
            'href' => "members/upload",
            'priority' =>1000
    ),
	'xldownload' => array(
            'text' => elgg_echo('members:xl_download'),
            'href' => $myurl,
            'priority' =>1000
    ),
		);

	}
}
    
foreach($tabs as $name => $tab){
    $tab["name"] = $name;
    elgg_register_menu_item("projecttabs", $tab);
	
}
echo elgg_view_menu('projecttabs', array("sort_by" => "priority", "style" => "padding:0;",'class' => 'elgg-menu-filter',));
        
echo "<br><br>";