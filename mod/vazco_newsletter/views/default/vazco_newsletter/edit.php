<?php //ł ?><?php
	//calls a template edit form view providing it with apropriate data from (...)/models.model.php
	//then the template triggers (...)/actions/edit.php thanks to this line here:
	//$actionUrl = $CONFIG->wwwroot.'action/vazco_newsletter/edit'; 
	//and this line in start.php:
	//register_action("vazco_newsletter/edit",false, $CONFIG->pluginspath . "vazco_newsletter/actions/edit.php");
	

	global $CONFIG;
	$entity_guid = $vars['guid'];	
	$entity = get_entity($entity_guid);
	//$entity passed to function to determine whether new owner should be set(when edit==false)
	$fieldArray = vazco_newsletter::reviewEditFormArray($entity);
	$actionUrl = $CONFIG->wwwroot.'action/newsletter/edit';

?>

<div class="contentWrapper">
<?php 
	//use a template form for editing and adding new entities
	echo elgg_view('vazco_newsletter/vazco_tools/forms/edit',   
		array(
			'fieldArray' => $fieldArray,
			'actionUrl' => $actionUrl,
			'formName' => 'vazco_newsletter_edit',
		)
	);
?>
</div>