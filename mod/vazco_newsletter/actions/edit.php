<?php //ł ?><?php 
//determines the type and subtype of the object that should be saved in database
//in this case it will be ElggObject and 'newsletter'
//calls a template action that saves the object in the database 
//if you want to be redirected to a certain url set $redirectUrl. 
//Setting $redirectUrl it to null will execute entity->getUrl();
//Setting ajax  to true  executes the code under the template call . 

	
	global $CONFIG;
	/* Individual section */

	gatekeeper();
	$entity = null;
	$entity_guid = get_input('guid');//MUST BE NAMED GUID!!!
		
	// edit
	if ($entity_guid) {
		$entity = get_entity($entity_guid);
	}
	
	/* Common section*/
	 //TODO
	
	$fieldArray = vazco_newsletter::reviewEditFormArray($entity);
	
	/*
	 * Form name is used to create unique translations for action. It has to be the same as the form name set in form. 
	 * The translations that are created are:
	 * 
	 * formName:saved
	 * formName:notsaved
	 * */
	
	
	$formName = 'vazco_newsletter_edit';
	$redirectUrl = null;// will cause to redirect to $entity->getUrl 
	$ajax = false;//set to true to execute code at the bottom
	//you can use condition array to check relations between fields in entity
	//this is how its done in event calendar:
/*	$conditionArray = array(
										array (	
												name=>"vazco_event_calendar::checkEndAfterStart",
												param_array=>array($date1,$date2,$time1,$time2),
												error=>elgg_echo("{$formName}:endafterstart")
											  ),
										array (	
												name=>"vazco_event_calendar::checkEndTimeWithoutStartTime",
												param_array=>array($time1,$time2),
												error=>elgg_echo("{$formName}:endtimewithoutstarttime")
											  ),
									);*/
	//
	

	
	//create entity here. Edit action template serves every entity, so choose it's type here. 
	if(!$entity_guid)
		$entity = new ElggObject();

	
	
	elgg_view("vazco_newsletter/vazco_tools/actions/edit",
		array(
			'fieldArray' => $fieldArray,
			'formName' => $formName,
			'redirectUrl' => $redirectUrl,
			'entity' => $entity,
			'subtype' => 'newsletter',
			'access' => ACCESS_PUBLIC,//this should be changed to the value from 
			'riverCreateView' => 'river/object/vazco_newsletter/create',
			'riverEditView' => 'river/object/vazco_newsletter/edit',
			'ajax' => $ajax,
			//array of arrays containing : function name, array of function parameters, error msg
			//'conditionArray' => 	$conditionArray,
		)
	);
	
	
	//if ajax set to true there is no redirection and following code is run after entity was saved:
    //$entity_id = vazco_tools::getLastEntity();
	//$entity = get_entity($event_id);
	//$container = get_entity($entity->container_guid);
	//forward($entity->getUrl());
	
?>