<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

class Agora extends ElggObject {
    const SUBTYPE = "agora";
    
    protected $meta_defaults = array(
        "title" 		=> NULL,
        "description" 	=> NULL,
        "price" 		=> NULL,
        "currency" 		=> NULL,
        "image" 		=> NULL,
        "category"   	=> NULL,
        "terms" 		=> NULL,
        "howmany" 		=> NULL,
        "location" 		=> NULL,
        "tags"          => NULL,
        "comments_on"	=> NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
}
