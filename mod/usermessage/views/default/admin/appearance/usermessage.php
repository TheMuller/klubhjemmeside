<?php
/**
* usermessage plugin settings
**/
function prepareTableRawData_4message($item,$ak)
{	

$visibility = array(
	'1'=>'This session',
	'2'=>'Next login',
);

$active = array(
	'1'=>'Yes',
	'2'=>'No',
);

	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'msg_data['.$ak.'][name]',
		'value' =>$item[name],
		'style'=>'width: 410px; height: 20px; background: transparent;',
	)
)."</td>";	
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'msg_data['.$ak.'][url]',
		'value' =>$item[url],
		'style'=>'width: 320px; height: 20px; background: transparent;',
	)
)."</td>";
	/* $rawdata .= "<td>".elgg_view('input/dropdown',
	array(
		'name' => 'msg_data['.$ak.'][visibility]',
		'options_values' => $visibility,
		'value' => $item[visibility],
		'style'=>'width: 140px; height: 30px; background: transparent;',
	)
)."</td>"; */
	$rawdata .= "<td>".elgg_view('input/dropdown',
		array(
			'name' => 'msg_data['.$ak.'][active]',
			'options_values' => $active,
			'value' => $item[active],
			'style'=>'width: 110px; height: 30px; background: transparent;',
		)
	)."</td>";
	$rawdata .= "<td style='width:74px;'>".elgg_view('output/url', 
		array(
			'class' => 'elgg-icon elgg-icon-delete-alt',	
			'href' => '',
			'onClick' => 'removeInput(this);return false;',
			)
	)."</td>";
	

    return $rawdata;
}

$supplycontent .= "<table><tr bgcolor='ADA0B1' id='hiddenmaterial' style='display:none;' >".prepareTableRawData_4message(array('type'=>'2','visibility'=>'','name'=>'Msg Here','url'=>'Url','priority'=>'50'),'JOBID')."</tr></table>";

$supplycontent .= "<form action='".elgg_get_site_url()."admin/appearance/usermessage' method='post' enctype='multipart/form-data'>";
    $msg_data =  $_POST['msg_data'];
	$site = elgg_get_site_entity();
	if($msg_data){
		$site->msg_data = serialize(msg_data);
	}else{
		$msg_data = unserialize($site->msg_data);
	}

	$supplycontent .= "<font color='white'><table style='border: 2px solid black; width:938px;'>
	<tr bgcolor='79757A' color='white'>
		
		<td style='border: 2px solid black;width:300px;'>&nbsp;&nbsp;&nbsp;&nbsp;".elgg_echo('Message')."</td>
		<td style='border: 2px solid black;width:240px;'>".elgg_echo('Where')."</td>
		<!--<td style='border: 2px solid black;width:115px;'>".elgg_echo('When')."</td>--!>
		<td style='border: 2px solid black;width:80px;'>".elgg_echo('Active')."</td>
		<td style='border: 2px solid black;width:50px;'>".elgg_echo('Action')."</td>
	</tr></table></font> ";
$supplycontent .= "<table><tbody id='user_message_tbody'>";
$ak=0;
	foreach($msg_data as $item){
		if($item[name]){
			$child_count = count($item[childs]);
		 $supplycontent .= "<tr bgcolor='#C4BEC4' id='$ak' childs='$child_count' style='border-bottom: 2px solid white;'>".prepareTableRawData_4message($item,$ak)."</tr>";
		} 
		$ak++;
	}
	

$supplycontent .= "</tbody></table >\n\n";
$supplycontent .= "<br><br><input type='submit' value='submit'>&nbsp;";
echo "<div style='position:absolute; right:0px;margin-right:70px;'>".elgg_view('output/url', array('href' => '','text' => elgg_echo('Add New Message'),'class' => 'elgg-button elgg-button-submit','onClick'=>'addInput();return false;'))."</div>";
$supplycontent .= "</form>";


echo elgg_view_module("info", elgg_echo('admin:appearance:usermessage'), $supplycontent);
?>
<script type="text/javascript">
function addInput(){
	      var hiddenraw = document.getElementById('hiddenmaterial');
		  var visibleraw = hiddenraw.cloneNode(true);
		  var user_message_tbody = document.getElementById('user_message_tbody');
		  kids = user_message_tbody.childNodes.length;
		  visibleraw.setAttribute("id",kids);
		  visibleraw.setAttribute("childs",0);
		  visibleraw.removeAttribute("style",0);

		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids);		  
		  user_message_tbody.appendChild(visibleraw);
}
function removeInput(referenceNode){
	if(confirm('Are you sure')){
		 var the_tr = referenceNode.parentNode.parentNode;
		 var the_id = the_tr.getAttribute("id");
		 var the_tbody = the_tr.parentNode;
		 var all_tr = the_tbody.getElementsByTagName('tr');
		 if(the_id){
		 //I am parent
			for(var kk=0;kk<all_tr.length;kk++){
				if(all_tr[kk].getAttribute("pid") == the_id){
					the_tbody.removeChild(all_tr[kk]);
					kk--;
				}
			}
		}else{
		 //I am child
		 var the_pid = the_tr.getAttribute("pid");
		 	for(var kk=0;kk<all_tr.length;kk++){
				if(all_tr[kk].getAttribute("id") == the_pid){
					var childs = all_tr[kk].getAttribute("childs");
					all_tr[kk].setAttribute("childs",parseInt(childs)-1);
				}
			}
		 }
		  the_tbody.removeChild(the_tr);
	}	
}
</script>