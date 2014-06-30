<?php
/**
 * Elgg log rotator plugin settings.
 *
 * @package ElggLogRotate
 */


$MemberField =   $vars['entity']->MemberField;
$MemberFieldLabel =   $vars['entity']->MemberFieldLabel;
$created_time = $vars['entity']->created_time;
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
		echo elgg_echo('members:join_date');
		echo "<input type='hidden' name='params[created_time]' value='0'/>";
		if($created_time =='1')
			echo "<input type='checkbox' name='params[created_time]' value='1' checked/>";
		else
			echo "<input type='checkbox' name='params[created_time]' value='1' />";

?>
<br>
</div>	
