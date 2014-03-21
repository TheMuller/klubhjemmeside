<?php
/**
 * Elgg log rotator plugin settings.
 *
 * @package ElggLogRotate
 */


$MemberField =   $vars['entity']->MemberField;
$MemberFieldLabel =   $vars['entity']->MemberFieldLabel;

if (!$MemberField) {
  $MemberField = "mobile,location";
  $MemberFieldLabel = "Mobile phone,Location";
}
?>


<div  style=' border: 1px solid #CC0;padding-top: 20px;padding-bottom: 4px;padding-left: 4px;'>
<b>Member fields</b><br><br>
<div  style=' border: 1px solid #CCC;padding-top: 20px;padding-bottom: 4px;padding-left: 4px;'>
	<?php
	    echo elgg_echo('name (comma separated)');

		echo elgg_view('input/text', array('name' => 'params[MemberField]','value' => $MemberField, ));
        echo elgg_echo('Labels (comma separated)');
		echo elgg_view('input/text', array('name' => 'params[MemberFieldLabel]','value' => $MemberFieldLabel, ));
	


?>
<br>
</div>	
