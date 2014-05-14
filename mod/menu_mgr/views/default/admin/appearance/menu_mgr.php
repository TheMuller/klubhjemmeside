<?php
/**
* menu_mgr plugin settings
**/
function prepareTableRawData_4childmenu($item,$pk,$ak)
{	

$visibility=array(
	'1'=>'Admins',
	'2'=>'Users logged in',
	'3'=>'Public',
);
    $rawdata .= "<td style='max-width:20px; !important' clear='both'>&nbsp;|-></td>";
	$rawdata .= "<td></td>";
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
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$pk.'][childs]['.$ak.'][priority]',
		'value' =>$item[priority],
		'style'=>'width: 45px; height: 20px; background: transparent;',
	)
)."</td>";
	$rawdata .= "<td style='width:105px;text-align: right;' colspan='2'>".elgg_view('output/url', 
		array(
			'class' => 'elgg-icon elgg-icon-delete-alt',	
			'href' => '',
			'onClick' => 'removeInput(this);return false;',
			)
	)."</td>";
	

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
    $rawdata .= "<td style='max-width:20px; !important' clear='both'>'&nbsp;|&nbsp;</td>";
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
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name' => 'material['.$ak.'][priority]',
		'value' =>$item[priority],
		'style'=>'width: 45px; height: 20px; background: transparent;',
	)
)."</td>";
	$rawdata .= "<td width='98px'>".elgg_view('output/url', 
		array(
			'href' => '',
			'text' => elgg_echo('menu_mgr:add_sub'),
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

$supplycontent .= "<table><tr bgcolor='ADA0B1' id='hiddenmaterial' style='display:none;' >".prepareTableRawData_4supply(array('type'=>'2','visibility'=>'','name'=>'Menu Name','url'=>'Url','priority'=>'50'),'JOBID')."</tr></table>";

$supplycontent .= "<table><tr bgcolor='DEDDDD' id='child_hidden' style='display:none;' >".prepareTableRawData_4childmenu(array('type'=>'2','visibility'=>'','name'=>'Menu Name','url'=>'Url','priority'=>'100'),'PID','JOBID')."</tr></table>";
$supplycontent .= "<form action='".elgg_get_site_url()."admin/appearance/menu_mgr' method='post' enctype='multipart/form-data'>";
    $material =  $_POST['material'];
	
	$site = elgg_get_site_entity();
	if($material){
	//$material = '';
$site->material = serialize($material);
//var_dump($material);    

}else{
$material = unserialize($site->material);
}

	$supplycontent .= "<font color='white'><table style='border: 2px solid black; width:95%;'>
	<tr bgcolor='79757A' color='white'>
		
		<td style='border: 2px solid black;width:150px;'>&nbsp;&nbsp;&nbsp;&nbsp;".elgg_echo('menu_mgr:admin:header:menu_type')."</td>
		<td style='border: 2px solid black;width:140px;'>".elgg_echo('menu_mgr:admin:header:menu_access')."</td>
		<td style='border: 2px solid black;width:280px;'>".elgg_echo('menu_mgr:admin:header:menu_text')."</td>
		<td style='border: 2px solid black;width:240px;'>".elgg_echo('menu_mgr:admin:header:menu_url')."</td>
		<td style='border: 2px solid black;width:60px;'>".elgg_echo('menu_mgr:admin:header:priority')."</td>
		<td style='border: 2px solid black;width:120px;'>".elgg_echo('menu_mgr:admin:header:actions')."</td>
	</tr></table></font> ";
$supplycontent .= "<table><tbody id='menu_mgr_tbody'>";
$ak=0;
	foreach($material as $item){
		if($item[name]){
			$child_count = count($item[childs]);
		 $supplycontent .= "<tr bgcolor='#C4BEC4' id='$ak' childs='$child_count' style='border-bottom: 2px solid white;'>".prepareTableRawData_4supply($item,$ak)."</tr>";
		} 
		if(is_array($item[childs])){
			$jk=0;
			foreach($item[childs] as $itemc){
				$supplycontent .= "<tr bgcolor='DEDDDD' pid='$ak' style='border-bottom: 2px solid white;'>".prepareTableRawData_4childmenu($itemc,$ak,$jk)."</tr>";
				$jk++;
			}
		}
		$ak++;
	}
	

$supplycontent .= "</tbody></table >\n\n";
$supplycontent .= "<br><br><input type='submit' value='submit'>&nbsp;";
$supplycontent .= elgg_view('output/url', array('href' => '','text' => elgg_echo('menu_mgr:add_menu'),'class' => 'elgg-button elgg-button-submit','onClick'=>'addInput();return false;'));
$supplycontent .= "</form>";


echo elgg_view_module("info", elgg_echo('admin:appearance:menu_mgr'), $supplycontent);
echo elgg_echo('menu_mgr:note');
?>
<script type="text/javascript">
function addInput(){
	      var hiddenraw = document.getElementById('hiddenmaterial');
		  var visibleraw = hiddenraw.cloneNode(true);
		  var menu_mgr_tbody = document.getElementById('menu_mgr_tbody');
		  kids = menu_mgr_tbody.childNodes.length;
		  visibleraw.setAttribute("id",kids);
		  visibleraw.setAttribute("childs",0);
		  visibleraw.removeAttribute("style",0);

		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids);		  
		  menu_mgr_tbody.appendChild(visibleraw);
}
function addChild(referenceNode){
	      var hiddenchild = document.getElementById('child_hidden');
		  var visibleraw = hiddenchild.cloneNode(true);
		  visibleraw.removeAttribute("id",0);
		  
		  visibleraw.removeAttribute("style",0);
		  kids = referenceNode.getAttribute("childs");
	
		  var pid = referenceNode.getAttribute("id");
		  visibleraw.setAttribute("pid",pid);
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/PID/g,pid);
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids);		  
		  referenceNode.parentNode.insertBefore(visibleraw, referenceNode.nextSibling);
		  referenceNode.setAttribute("childs",parseInt(kids)+1);
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