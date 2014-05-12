<?php
/**
* menu_mgr plugin settings
**/

////////////////////////////////////////////////////////////////////////////////////////////////////
function prepareTableRawData_4supply($item,$ak)
{	
$menu_type=array(
    '1'=>'Topbar',
    '2'=>'Site menu',
    '3'=>'Side menu',
); 
$visibility=array(
	'1'=>'Admins',
	'2'=>'Users logged in',
	'3'=>'Public',
);
    
	$rawdata .= "<td>".elgg_view('input/dropdown',
                   array(
                         'name' => 'material['.$ak.'][type]',
                         'options_values' => $menu_type,
                         'value'=>$item[type],
						 'style'=>'width: 130px; height: 50%;',
                         )
                   )."</td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
	array(
		'name' => 'material['.$ak.'][visibility]',
		'options_values' => $visibility,
		'value' => $item[visibility],
		'style'=>'width: 130px; height: 50%;',
	)
)."</td>";
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$ak.'][name]',
		'value' =>$item[name],
		'style'=>'width: 250px; height: 50%;',
	)
)."</td>";		
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$ak.'][url]',
		'value' =>$item[url],
		'style'=>'width: 260px; height: 90%;',
	)
)."</td>";

    return $rawdata;
}

$supplycontent .= "<table><tr id='hiddenmaterial' style='display:none;' >".prepareTableRawData_4supply(array('type'=>'2','visibility'=>'','name'=>'invim','url'=>''),'JOBID')."</tr></table>";
$supplycontent .= "<form action='".elgg_get_site_url()."admin/users/settings' method='post' enctype='multipart/form-data'>";
    $material =  $_POST['material'];
	//$material = '';
	$site = elgg_get_site_entity();
	if($material){
	
$site->material = serialize($material);
//var_dump($material);    
}else{
$material = unserialize($site->material);
}
	$supplycontent .= "<table style='border: 2px solid black; width:80%'>
	<tr>
		<td style='border: 2px solid black;width:120px;'>Menu Type</td>
		<td style='border: 2px solid black;width:120px;'>Menu Access</td>
		<td style='border: 2px solid black;width:250px;'>Menu Text</td>
		<td style='border: 2px solid black;width:250px;'>Menu Url</td>
	</tr></table>";
$supplycontent .= "<table><tbody id='menu_mgr_tbody'>";
$ak=0;
	foreach($material as $item){
		if($item[name]){
		 $supplycontent .= "<tr >".prepareTableRawData_4supply($item,$ak)."</tr>";
		} 
		$ak++;
	}
	

$supplycontent .= "</tbody></table >\n\n";
$supplycontent .= "<br><br><input type='submit' value='submit'>";
$supplycontent .= elgg_view('output/url', array('href' => '','text' => elgg_echo('add more item'),'class' => 'elgg-button elgg-button-submit','onClick'=>'addInput();return false;'));
$supplycontent .= "</form>";


echo elgg_view_module("info", elgg_echo('Menu Manager'), $supplycontent);

?>
<script type="text/javascript">

var counter = 1;
var limit = 20;



function addInput(){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {          
	      var hiddenraw = document.getElementById('hiddenmaterial');
		  var visibleraw = hiddenraw.cloneNode(true);
		  visibleraw.removeAttribute("id",0);
		  visibleraw.removeAttribute("style",0);
		  var menu_mgr_tbody = document.getElementById('menu_mgr_tbody');
		  kids = menu_mgr_tbody.childNodes.length;
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids);		  
		  menu_mgr_tbody.appendChild(visibleraw);
          counter++;
     }
}
function removeInput(div){
		 var parent = div.parentNode;
		  parent.removeChild(div);	  
}


</script>