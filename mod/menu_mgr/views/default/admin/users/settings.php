<?php
/**
* menu_mgr plugin settings
**/
function prepareTableRawData_4childmenu($item,$pk,$ak)
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
    $rawdata .= "<td style='max-width:20px; !important' clear='both'>&nbsp;|-></td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
                   array(
                         'name' => 'material['.$pk.'][childs]['.$ak.'][type]',
                         'options_values' => $menu_type,
                         'value'=>$item[type],
						 'style'=>'width: 130px; height: 30px; background: transparent;',
                         )
                   )."</td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
	array(
		'name' => 'material['.$pk.'][childs]['.$ak.'][visibility]',
		'options_values' => $visibility,
		'value' => $item[visibility],
		'style'=>'width: 130px; height: 30px; background: transparent;',
	)
)."</td>";
	$rawdata .= "<td style='max-width:130px;'>".elgg_view('input/text',
	array(
		'name' => 'material['.$pk.'][childs]['.$ak.'][name]',
		'value' =>$item[name],
		'style'=>'width: 250px; height: 20px; background: transparent;',
	)
)."</td>";		
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$pk.'][childs]['.$ak.'][url]',
		'value' =>$item[url],
		'style'=>'width: 210px; height: 20px; background: transparent;',
	)
)."</td>";

	$rawdata .= "<td style='width:105px;'>".elgg_view('output/url', 
		array(
			'class' => 'elgg-icon elgg-icon-delete-alt',	
			'href' => '',
			'onClick' => 'removeInput(this);return false;',
			)
	)."</td><td></td>";
	

    return $rawdata;
}
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
    $rawdata .= "<td style='max-width:20px; !important' clear='both'>&nbsp;|&nbsp;</td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
                   array(
                         'name' => 'material['.$ak.'][type]',
                         'options_values' => $menu_type,
                         'value'=>$item[type],
						 'style'=>'width: 130px; height: 30px; background: transparent;',
                         )
                   )."</td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
	array(
		'name' => 'material['.$ak.'][visibility]',
		'options_values' => $visibility,
		'value' => $item[visibility],
		'style'=>'width: 130px; height: 30px; background: transparent;',
	)
)."</td>";
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$ak.'][name]',
		'value' =>$item[name],
		'style'=>'width: 250px; height: 20px; background: transparent;',
	)
)."</td>";		
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$ak.'][url]',
		'value' =>$item[url],
		'style'=>'width: 210px; height: 20px; background: transparent;',
	)
)."</td>";
	$rawdata .= "<td width='105px'>".elgg_view('output/url', 
		array(
			'href' => '',
			'text' => elgg_echo('Add Sub'),
			'class' => 'elgg-button elgg-button-submit',
			'onClick' => 'addChild(this.parentNode.parentNode);return false;',
			'style' => 'height:30px;',
			)
	)."</td>";
	$rawdata .= "<td>".elgg_view('output/url', 
		array(
			'class' => 'elgg-icon elgg-icon-delete-alt',	
			'href' => '',
			'onClick' => 'removeInput(this);return false;',
			)
	)."</td>";
	

    return $rawdata;
}

$supplycontent .= "<table><tr bgcolor='DFDB6B' id='hiddenmaterial' style='display:none;' >".prepareTableRawData_4supply(array('type'=>'2','visibility'=>'','name'=>'Menu Name','url'=>'Url'),'JOBID')."</tr></table>";

$supplycontent .= "<table style='border-bottom: 1px solid red;'><tr bgcolor='DEDDDD' id='child_hidden' style='display:none;' >".prepareTableRawData_4childmenu(array('type'=>'2','visibility'=>'','name'=>'Menu Name','url'=>'Url'),'PID','JOBID')."</tr></table>";
$supplycontent .= "<form action='".elgg_get_site_url()."admin/users/settings' method='post' enctype='multipart/form-data'>";
    $material =  $_POST['material'];
	
	$site = elgg_get_site_entity();
	if($material){
	//$material = '';
$site->material = serialize($material);
//var_dump($material);    

}else{
$material = unserialize($site->material);
}

	$supplycontent .= "<table style='border: 2px solid black; width:90%'>
	<tr>
		
		<td style='border: 2px solid black;width:150px;'>&nbsp;&nbsp;&nbsp;&nbsp;Menu Type</td>
		<td style='border: 2px solid black;width:140px;'>Menu Access</td>
		<td style='border: 2px solid black;width:280px;'>Menu Text</td>
		<td style='border: 2px solid black;width:230px;'>Menu Url</td>
		<td style='border: 2px solid black;width:130px;'>Actions</td>
	</tr></table>";
$supplycontent .= "<table><tbody id='menu_mgr_tbody'>";
$ak=0;
	foreach($material as $item){
		if($item[name]){
			$child_count = count($item[childs]);
		 $supplycontent .= "<tr bgcolor='DFDB6B' id='$ak' childs='$child_count' style='border-bottom: 2px solid white;'>".prepareTableRawData_4supply($item,$ak)."</tr>";
		} 
		if(is_array($item[childs])){
			$jk=0;
			foreach($item[childs] as $itemc){
				$supplycontent .= "<tr bgcolor='DEDDDD' style='border-bottom: 2px solid white;'>".prepareTableRawData_4childmenu($itemc,$ak,$jk)."</tr>";
				$jk++;
			}
		}
		$ak++;
	}
	

$supplycontent .= "</tbody></table >\n\n";
$supplycontent .= "<br><br><input type='submit' value='submit'>";
$supplycontent .= elgg_view('output/url', array('href' => '','text' => elgg_echo('Add Menu'),'class' => 'elgg-button elgg-button-submit','onClick'=>'addInput();return false;'));
$supplycontent .= "</form>";


echo elgg_view_module("info", elgg_echo('Menu Manager'), $supplycontent);

?>
<script type="text/javascript">

var counter = 1;
var limit = 20;
var child_counter = 1;
var child_limit = 10;



function addInput(){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {          
	      var hiddenraw = document.getElementById('hiddenmaterial');
		  var visibleraw = hiddenraw.cloneNode(true);
		  var menu_mgr_tbody = document.getElementById('menu_mgr_tbody');
		  kids = menu_mgr_tbody.childNodes.length;
		  visibleraw.setAttribute("id",kids);
		  visibleraw.setAttribute("childs",0);
		  visibleraw.removeAttribute("style",0);

		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids);		  
		  menu_mgr_tbody.appendChild(visibleraw);
          counter++;
     }
}
function addChild(referenceNode){
          
	      var hiddenchild = document.getElementById('child_hidden');
		  var visibleraw = hiddenchild.cloneNode(true);
		  visibleraw.removeAttribute("id",0);
		  visibleraw.removeAttribute("style",0);
		  visibleraw.setAttribute('style','right:70px;');
		  kids = referenceNode.getAttribute("childs");

		  var pid = referenceNode.getAttribute("id");
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/PID/g,pid);
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids);		  
		  referenceNode.parentNode.insertBefore(visibleraw, referenceNode.nextSibling);
          child_counter++;

}
function removeInput(referenceNode){
	if(confirm('Are you sure')){
		 var gfather = referenceNode.parentNode.parentNode;
		 var grandgrandfather = gfather.parentNode
		  grandgrandfather.removeChild(gfather);
	}	
}


</script>