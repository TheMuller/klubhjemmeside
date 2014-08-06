<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');
if (elgg_is_active_plugin("kanelggamapsapi")){
	elgg_load_library('elgg:kanelggamapsapi');  
	elgg_load_library('elgg:kanelggamapsapigeocoder'); 
} 

// check if user can post classifieds
if (check_if_user_can_post_classifieds()) { 
    
    // Get variables
    $title = get_input("title");
    $desc = get_input("description");
    $price = get_input("price");
    $howmany = get_input("howmany");
    $location = get_input("location");
    $currency = get_input("currency");
    $category = get_input("category");
    $tags = get_input("tags");
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('agora_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    $comments_on = get_input("comments_on");

    elgg_make_sticky_form('agora');

    if (!$title) {
        register_error(elgg_echo('agora:save:missing_title'));
        forward(REFERER);
    }
/*    
    if (!$category) {
        register_error(elgg_echo('agora:save:missing_category'));
        forward(REFERER);
    }    
*/
    if ($price && !is_numeric($price)) {
        register_error(elgg_echo('agora:save:price_not_numeric'));
        forward(REFERER);
    }  
    
	if ($howmany && !is_numeric($howmany)) {
        register_error(elgg_echo('agora:save:howmany_not_numeric'));
        forward(REFERER);
    }  
    
    // check whether this is a new object or an edit
    $new_classified = true;
    if ($guid > 0) {
            $new_classified = false;
    }

    if ($guid == 0) {
        $classfd = new ElggObject;
        $classfd->subtype = "agora";
        $classfd->container_guid = $container_guid;
        $new = true;
        // if no title on new upload, grab filename
        if (empty($title)) {
                $title = elgg_echo('agora:add:missing_title');
        }        
    } else {
        $classfd = get_entity($guid);
        if (!$classfd->canEdit()) {
            system_message(elgg_echo('agora:save:failed'));
            forward(REFERRER);
        }
        if (!$title) {
                // user blanked title, but we need one
                $title = $classfd->title;
        }    
    }
    
    $tagarray = string_to_tag_array($tags);

    $classfd->title = $title;
    $classfd->description = $desc;
    $classfd->access_id = $access_id;
    $classfd->price = $price;
    $classfd->howmany = $howmany;
    $classfd->location = $location;
    $classfd->currency = $currency;
    $classfd->category = $category;
    $classfd->tags = $tagarray;
    $classfd->comments_on = $comments_on;
    
    // Set its owner to the current user
    $classfd->owner_guid = elgg_get_logged_in_user_guid();

	// Check if image uploaded
	if ($_FILES["upload"]["error"] != 4) {
		$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
		$temp = explode(".", $_FILES["upload"]["name"]);
		$extension = end($temp);
		if (((	$_FILES["upload"]["type"] == "image/gif") 
			|| ($_FILES["upload"]["type"] == "image/jpeg") 
			|| ($_FILES["upload"]["type"] == "image/jpg")
			|| ($_FILES["upload"]["type"] == "image/pjpeg") 
			|| ($_FILES["upload"]["type"] == "image/x-png") 
			|| ($_FILES["upload"]["type"] == "image/png"))
			&& (in_array($extension, $allowedExts))	)	 {
/*
			switch($_FILES["upload"]["error"]){
				case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
					register_error(elgg_echo('agora:add:image:fileerror1'));
					forward(REFERER);
				  break;
				case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
					register_error(elgg_echo('agora:add:image:fileerror2'));
					forward(REFERER);
				  break;
				case 3: //uploaded file was only partially uploaded
					register_error(elgg_echo('agora:add:image:fileerror3'));
					forward(REFERER);
				  break;

			}
*/ 
		}
		else
		{
			register_error(elgg_echo('agora:add:image:invalidfiletype'));  
			forward(REFERER); 
		} 
	}
	
    if ($classfd->save()) {
        
		// save ad coords location and if kanelggamapsapi is enabled
		if (elgg_is_active_plugin("kanelggamapsapi")){
			if ($location) {
				$ccc = save_object_coords($location, $classfd, 'kanelggamapsapi');
			}
		}
	        
		// Check if image uploaded
        if ((isset($_FILES['upload']['name'])) && (substr_count($_FILES['upload']['type'],'image/'))) {
            $prefix = "agora/".$classfd->guid;

            $filehandler = new ElggFile();
            $filehandler->owner_guid = $classfd->owner_guid;
            $filehandler->setFilename($prefix . ".jpg");
            $filehandler->open("write");
            $filehandler->write(get_uploaded_file('upload'));
            $filehandler->close();

            $thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),25,25, true);
            $thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),40,40, true);
            $thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),153,153, true);
            $thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),200,200, false);

            if ($thumbtiny) {
                $thumb = new ElggFile();
                $thumb->owner_guid = $classfd->owner_guid;
                $thumb->setMimeType('image/jpeg');

                $thumb->setFilename($prefix."tiny.jpg");
                $thumb->open("write");
                $thumb->write($thumbtiny);
                $thumb->close();

                $thumb->setFilename($prefix."small.jpg");
                $thumb->open("write");
                $thumb->write($thumbsmall);
                $thumb->close();

                $thumb->setFilename($prefix."medium.jpg");
                $thumb->open("write");
                $thumb->write($thumbmedium);
                $thumb->close();

                $thumb->setFilename($prefix."large.jpg");
                $thumb->open("write");
                $thumb->write($thumblarge);
                $thumb->close();
            }
        }         
        
        elgg_clear_sticky_form('agora');

        system_message(elgg_echo('agora:save:success'));

        //add to river only if new
        if ($new) {
            add_to_river('river/object/agora/create','create', elgg_get_logged_in_user_guid(), $classfd->getGUID());
        }

        forward($classfd->getURL());
    } else {
        register_error(elgg_echo('agora:save:failed'));
        forward("agora");
    }

} 
else    {  
    register_error(elgg_echo('agora:add:noaccessforpost'));  
    forward(REFERER);    
}
