<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

class Interest extends ElggObject {
    const SUBTYPE = "agorainterest";
    
    protected $meta_defaults = array(
        "int_ad_guid" 		=> NULL,
        "int_buyer_guid"   	=> NULL,
        "int_date" 		=> NULL,    // date of interest
        "int_status" 	=> NULL,    // interest status (interested, accepted, rejected)
        "int_message_guid" 		=> NULL,	// message guid
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
}
