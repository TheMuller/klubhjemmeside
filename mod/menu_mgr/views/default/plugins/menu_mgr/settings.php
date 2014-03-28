<?php
/**
* Groups plugin settings
**/
?>
<style>
.Group0{width:99%;height:30px;float:left;margin-bottom:-10px;}
.Group1{width:40%;height:30px;float:left;margin-bottom:-10px;}
.Group2{width:59%;height:40px;float:left;margin-bottom:-10px;}
.Group3{width:26%;height:40px;float:left;margin-bottom:2px;}
.Group2SCR{overflow:auto;height:150px;width:90%;;height:40px;}
.Clear1{height:0px;clear:both;}
</style>
<?php

////////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////
function prepareTableRawData_4supply($item,$ak)
{	
$menu_type=array(
    '1'=>'Topbar',
    '2'=>'Site menu',
    '3'=>'Side menu',
); 
$visibility=array(
	'1'=>'Public',
	'2'=>'Users logged in',
	'3'=>'Admins',
);
    
	$rawdata .= "<td>".elgg_view('input/dropdown',
                   array(
                         'name' => 'material['.$ak.'][name]',
                         'options_values' => $menu_type,
                         'value'=>$item[name],
						 'style'=>'width: 120px; height: 50%;',
                         )
                   )."</td>";
	$rawdata .= "<td>".elgg_view('input/dropdown',
	array(
		'name' => 'material['.$ak.'][name]',
		'options_values' => $visibility,
		'value' => $item[name],
		'style'=>'width: 120px; height: 50%;',
	)
)."</td>";
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name'=> 'material['.$ak.'][name]',
		'value' =>$item[name],
		'style'=>'width: 250px; height: 50%;',
	)
)."</td>";		
	$rawdata .= "<td>".elgg_view('input/text',
	array(
		'name'=> 'material['.$ak.'][name]',
		'value' =>$item[name],
		'style'=>'width: 250px; height: 90%;',
	)
)."</td>";
    return $rawdata;
}
//$supplycontent .= "\n<table id='dynamictable4' class='hovertable'><thead><tr><th>&nbsp&nbspItem</th><th>Unit</th><th>Quantity</th></tr></thead>";
$supplycontent .= "<tr id='hiddenmaterial' style='display:none;' >".prepareTableRawData_4supply(array('name'=>'','unit'=>'','quantity'=>'',),'JOBID')."</tr>";

$material = unserialize($var['entity']->material);
$found=0;
	foreach($material as $ak=>$item){
		//if($item[name]){
		 ///$found=true;
		 $supplycontent .= "<tr >".prepareTableRawData_4supply($item,$ak)."</tr>";
		//} 
	}
if(!$found)
  $supplycontent .= "<tr>".prepareTableRawData_4supply(array('name'=>'rice','unit'=>'kilogram','quantity'=>'5'),0)."</tr>";
$supplycontent .= "</table >\n\n";
$supplycontent .= elgg_view('output/url', array('href' => '','text' => elgg_echo('add more item'),'class' => 'elgg-button elgg-button-submit','onClick'=>'addInput();return false;'));

	echo "<table border=1 style='border: 2px solid black; width:94%'>
	<tr>
		<td style='border: 2px solid black;'>Menu Type</td>
		<td style='border: 2px solid black;'>Menu Access</td>
		<td style='border: 2px solid black;'>Menu Text</td>
		<td style='border: 2px solid black;'>Menu Url</td>
	</tr>";
$supplycontent .= "</table>";
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
		  visibleraw.innerHTML = visibleraw.innerHTML.replace(/JOBID/g,kids-1);
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