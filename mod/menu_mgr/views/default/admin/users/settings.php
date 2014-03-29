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
						 'style'=>'width: 120px; height: 50%;',
                         )
                   )."</td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
	array(
		'name' => 'material['.$ak.'][visibility]',
		'options_values' => $visibility,
		'value' => $item[visibility],
		'style'=>'width: 120px; height: 50%;',
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
		'style'=>'width: 250px; height: 90%;',
	)
)."</td>";

    return $rawdata;
}

$supplycontent .= "<tr id='hiddenmaterial' style='display:none;' >".prepareTableRawData_4supply(array('type'=>'','visibility'=>'','name'=>'invi','url'=>''),'JOBID')."</tr>";
$supplycontent .= "<form action='".elgg_get_site_url()."admin/users/settings' method='post' enctype='multipart/form-data'>";
    $material =  get_input('material','');
	$site = elgg_get_site_entity();
$site->material = serialize($material);
var_dump($material);    
$found=0;
	foreach($material as $ak=>$item){
		if($item[name]){
		 $found=true;
		 $supplycontent .= "<tr >".prepareTableRawData_4supply($item,$ak)."</tr>";
		} 
	}
	  $supplycontent .= "<tr>".prepareTableRawData_4supply(array('type'=>'2','visibility'=>'','name'=>'visi','url'=>''),2)."</tr>";
if(!$found)
  $supplycontent .= "<tr>".prepareTableRawData_4supply(array('type'=>'','visibility'=>'','name'=>'visi','url'=>''),0)."</tr>";
$supplycontent .= "</table >\n\n";
$supplycontent .= "<br><br><input type='submit' value='submit'>";
        $supplycontent .= "</form>";
$supplycontent .= elgg_view('output/url', array('href' => '','text' => elgg_echo('add more item'),'class' => 'elgg-button elgg-button-submit','onClick'=>'addInput();return false;'));

	echo "<table border=1 style='border: 2px solid black; width:94%'>
	<tr>
		<td style='border: 2px solid black;'>Menu Type</td>
		<td style='border: 2px solid black;'>Menu Access</td>
		<td style='border: 2px solid black;'>Menu Text</td>
		<td style='border: 2px solid black;'>Menu Url</td>
	</tr>";
$supplycontent .= "</table>";
////////////////////////////////////////////////////////////////////////////////
if (!isset($vars['entity']->groups_merchant_number)){	//:DC:
	$vars['entity']->groups_merchant_number = '';
}

$supplycontent .= '<div class="Group1">';
$supplycontent .= elgg_echo('groups_merchant_number');
$supplycontent .= '</div>';
$supplycontent .= '<div class="Group2">';

$supplycontent .= elgg_view('input/text',
	array(
		'name'=>'params[groups_merchant_number]',
		'value' => $vars['entity']->groups_merchant_number,
	)
);
$supplycontent .= '</div>';
$supplycontent .= '<div class="Clear1"></div>';

echo elgg_view_module("info", elgg_echo('Event supply'), $supplycontent);

?>
<script type="text/javascript">

var counter = 1;
var limit = 20;

function addTask(){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {          
	      var hiddenraw = document.getElementById('hiddentask');
		  var visibleraw = hiddenraw.cloneNode(true);
		  visibleraw.removeAttribute("style",0);
		  var parent = hiddenraw.parentNode;
		  kids = parent.childNodes.length;
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids-2);
		  parent.appendChild(visibleraw);
          counter++;
     }
}

function addSlot(j,parent){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {          
	      var hiddenraw = document.getElementById('hiddenslot');
		  var visibleraw = hiddenraw.cloneNode(true);
		  visibleraw.removeAttribute("style",0);
		  visibleraw.removeAttribute("id",0);
		  //var parent = hiddenraw.parentNode;
		  var table = parent.childNodes[0];
		  kids = table.childNodes[0].childNodes.length;
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,j);
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/SLOTID/g,kids);
		  table.appendChild(visibleraw);
          counter++;
     }
}

function addTask(){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {          
	      var hiddenraw = document.getElementById('hiddentask');
		  var visibleraw = hiddenraw.cloneNode(true);
		  visibleraw.removeAttribute("style",0);
		  var parent = hiddenraw.parentNode;
		  kids = parent.childNodes.length;
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids-1);
		  parent.appendChild(visibleraw);
          counter++;
     }
}

function addInput(){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {          
	      var hiddenraw = document.getElementById('hiddenmaterial');
		  var visibleraw = hiddenraw.cloneNode(true);
		  visibleraw.removeAttribute("id",0);
		  visibleraw.removeAttribute("style",0);
		  var parent = hiddenraw.parentNode;
		  kids = parent.childNodes.length;
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids-1);		  
		  parent.appendChild(visibleraw);
          counter++;
     }
}
function removeInput(div){
		 var parent = div.parentNode;
		  parent.removeChild(div);	  
}

function IsInteger(input){
    return parseInt(input) === Number(input) ;
}
function IsNumeric(input){
    return (input - 0) == input && input.length > 0  ;
}

function validateInputs(){
    var result = true;
    var alertstr = '';
   var donationTarget = document.getElementById('donationTarget'); 
   if(!IsNumeric(donationTarget.value)) {
    alertstr += "\nDonation must be number";
	result = false;
   }
   if(donationTarget.value <0) {
    alertstr += "\nDonation must be Positive value";
	result = false;
   }
 /*  
   var VolunteerTarget = document.getElementById('VolunteerTarget'); 
   if(!IsInteger(VolunteerTarget.value)) {
		alertstr += "\nVolunteers can not be"+VolunteerTarget.value;
		result = false;
   }
   if(VolunteerTarget.value <0) {
    alertstr += "\nVolunteers must be Positive value";
	result = false;
   }
*/
   
   var quantities=document.getElementsByName("quantitys[]");
   
	 for (var i = 1; i < quantities.length; i++) { // 0 is hiddenraw
		var value = quantities[i].value;
		  if(value && !IsNumeric(value)) {
			alertstr += "\n"+value+" is not number. quantity must be number.";
			result = false;
		   }
		   if(value <0) {
			alertstr += "\n"+value+" is nagative. quantity must be +ve number.";
			result = false;
		   }	
	}
   if(alertstr)
   alert(alertstr);

   
return result;
}

$('input.datepicker').live('focusin', function() {
    $(this).datepicker();
});
</script>