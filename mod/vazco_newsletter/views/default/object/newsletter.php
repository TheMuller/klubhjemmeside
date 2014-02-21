<?php //ł ?><?php
//manages the view of object with subtype:  newsletter
//if in full view - calls the elgg_view("vazco_newsletter/fullview"  
//else ,depending on settings, calls 
//	elgg_view("vazco_newsletter/galleryview) or 
//	elgg_view("vazco_newsletter/listingview) 

	if ($vars['full']) {
		echo elgg_view("vazco_newsletter/fullview",$vars);
	} else {
		if (get_input('search_viewtype') == "gallery") {
			echo elgg_view('vazco_newsletter/galleryview',$vars); 				
		} else {
			echo elgg_view("vazco_newsletter/listingview",$vars);
		}
	}
?>