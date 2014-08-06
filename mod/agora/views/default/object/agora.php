<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');

global $CONFIG;

$full = elgg_extract('full_view', $vars, FALSE);
$classifieds = elgg_extract('entity', $vars, FALSE);

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$classifieds) { 
    return;
}

$owner = $classifieds->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'small');
$tu = $classifieds->time_updated;

// check if this user has bought this ad
$options = array(
	'type' => 'object',
	'subtype' => 'agorasales',
	'limit' => 0,
	'metadata_name_value_pairs' => array(
		array('name' => 'txn_vguid','value' => $classifieds->guid, 'operand' => '='),
		array('name' => 'txn_buyer_guid', 'value' => elgg_get_logged_in_user_entity()->guid, 'operand' => '='),
	),
	'metadata_name_value_pairs_operator' => 'AND',
);

$getbuyers = elgg_get_entities_from_metadata($options);
$message_to_buyer = '';
if (!$getbuyers) { 
    $isbuyer = false;
}
else    {
    $isbuyer = true; 
    $message_to_buyer = elgg_echo('agora:messagetobuyer');
}

// check who can post for retrieving paypal account
$whocanpost = trim(elgg_get_plugin_setting('agora_uploaders', 'agora'));
if ($whocanpost === 'allmembers')   {
    $vowner = get_user($classifieds->owner_guid);
    $paypal_acount = $vowner->email;
}
else if ($whocanpost === 'admins')   {
    $paypal_acount = trim(elgg_get_plugin_setting('paypal_account', 'agora'));
}

// check if use sandbox paypal account
$usesandbox = trim(elgg_get_plugin_setting('usesandbox', 'agora'));
if ($usesandbox === 'yes')   {
    $sandbox = 'data-env="sandbox"';
}
else {
    $sandbox = '';
}

// set sold out icon
$status = '';

if (is_numeric($classifieds->howmany) && $classifieds->howmany == 0) {
	$status = '<img src="'.elgg_get_site_url() . 'mod/agora/graphics/soldout.png" width="100" height="76" alt="" class="soldout" />';
}

// paypal button
if (elgg_is_logged_in())    {
	if ($isbuyer)	{
		$buybuttton = $status;
		$buybuttton .= '<div class="bought">'.$message_to_buyer.'</div>';
		$gallerybutton = '<div class="bought">'.$message_to_buyer.'</div>';
	}
	else if ($classifieds->price && $paypal_acount && empty($status)) { // place condition for paypal (admin or user account)
        $buybuttton = '
                <script src="'.$CONFIG->url.'/mod/agora/assets/paypal-button.min.js?merchant='.$paypal_acount.'"
                    data-button="buynow" 
                    data-name="'.$classifieds->title.'" 
                    data-number="'.$classifieds->guid.'-'.elgg_get_logged_in_user_entity()->guid.'-'.$classifieds->container_guid.'" 
                    data-quantity="1" 
                    data-amount="'.$classifieds->price.'" 
                    data-currency="'.$classifieds->currency.'"
                    data-return="'.elgg_get_site_url().'agora/view/'.$classifieds->guid.'"
                    data-callback="'.elgg_get_site_url().'agora/ipn/"
                    '.$sandbox.'
                ></script>
        ';
        $gallerybutton = $buybuttton;
    } 
    else    {
        $buybuttton = $status;
        $gallerybutton = '&nbsp;';
    }
}
else {
	$buybuttton = $status;
	$gallerybutton = '&nbsp;';
}

$owner_link = elgg_view('output/url', array(
	'href' => "agora/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($classifieds->time_created);

//only display if there are commments
if ($classifieds->comments_on != 'Off') {
    $comments_count = $classifieds->countComments();
    //only display if there are commments
    if ($comments_count != 0) {
        $text = elgg_echo("comments") . " ($comments_count)";
        $comments_link = elgg_view('output/url', array(
            'href' => $classifieds->getURL() . '#agora-comments',
            'text' => $text,
            'is_trusted' => true,
        ));
    } else {
        $comments_link = '';
    }
} else {
    $comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'agora',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link";

if ($full && !elgg_in_context('gallery')) {
    $params = array(
            'entity' => $classifieds,
            'title' => false,
            'metadata' => $metadata,
            'subtitle' => $subtitle,
    );
    $params = $params + $vars;
    $summary = elgg_view('object/elements/summary', $params);

    $body = '';
    $body .= '<div class="agorabody elgg-image-block clearfix">';
    $body .= '<div class="elgg-image">';
	$body .= elgg_view('output/url', array(
		'href' => elgg_get_site_url() . "mod/agora/viewimage.php?classfdguid={$classifieds->guid}",
		'text' => elgg_view('agora/thumbnail', array('classfdguid' => $classifieds->guid, 'size' => 'large', 'tu' => $tu)),
		'class' => 'elgg-lightbox',
	));    
	$body .= '</div>';
    $body .= '<div class="elgg-body">';
    $body .= '<div class="elgg-content">';
    //$body .= '<div class="agoraprint">'.$buybuttton.'</div>';
    if ($classifieds->price) {
        $body .= '<div class="list_features"><strong>'.elgg_echo('agora:price') . '</strong>: '.get_agora_currency_sign($classifieds->currency).' '.$classifieds->price.'</div>';
    }  
    if ($classifieds->category) {
        $body .= '<div class="list_features"><strong>'.elgg_echo('agora:category') . '</strong>: '.agora_get_cat_name_settings($classifieds->category, true).'</div>';
    } 	
	if (is_geolocation_enabled() && $classifieds->location) {
		$clocation = elgg_view('output/url', array(
			'href' => elgg_get_site_url() . "agora/map?guid={$classifieds->guid}",
			'text' => $classifieds->location,
		));		
		$body .= '<div class="list_features"><strong>'.elgg_echo('agora:location') . '</strong>: '.$clocation.'</div>';
    }     
	if (is_numeric($classifieds->howmany)) {
		$body .= '<div class="list_features"><strong>'.elgg_echo('agora:howmany') . '</strong>: '.$classifieds->howmany.'</div>';
    }     
	$body .= '</div>';
	$body .= '</div>';
	
	// be interested form
    if (elgg_is_logged_in() && elgg_is_active_plugin("messages") && check_if_members_can_send_private_message() && empty($status))	{
		$form_params = array(
			'id' => 'interested-in-form',
			'class' => 'hidden mtl',
		);
		$body_params = array(
			'classified_guid' => $classifieds->guid, 
			'recipient_guid' => $classifieds->owner_guid, 
			'subject' => elgg_echo("agora:be_interested:ad_message_subject", array($classifieds->title)),
		);
		$interest_form = elgg_view_form('agora/be_interested', $form_params, $body_params);
		$from_user = get_user($message->fromId);
		
		$pmbutton = elgg_view('output/url', array(
			'name' => 'reply',
			'class' => 'elgg-button elgg-button-action',
			'rel' => 'toggle',
			'href' => '#interested-in-form',
			'text' => elgg_echo('agora:be_interested'),
		));		
					
		$body .= '<div class="pm">'.$pmbutton.'</div>';
		$body .= $interest_form;
	}
    
    if ($classifieds->description) {
        $body .= '<div class="desc">'.$classifieds->description.'</div>';
    }  
    else {	
		$body .= '<div class="desc">&nbsp;</div>';
    }  
    $body .= '</div>';

    echo elgg_view('object/elements/full', array(
            'entity' => $classifieds,
            'icon' => $owner_icon,
            'summary' => $summary,
            'body' => $body,
    ));
    
} 
elseif (elgg_in_context('gallery')) {
	$galleryhref = elgg_get_site_url().'agora/view/'.$classifieds->guid.'/'. elgg_get_friendly_title($classifieds->title);
	echo '<div class="agora-gallery-item">';
	echo '<a href="'.$galleryhref.'"><h3>'.$classifieds->title.'</h3></a>';
	echo '<a href="'.$galleryhref.'">'.elgg_view('agora/thumbnail', array('classfdguid' => $classifieds->guid, 'size' => 'medium', 'tu' => $tu)).'</a>';
	echo '<p class="gallery-date">'.$owner_link.' '.$date.'</p>';
	echo '<div class="gallery-view">';
    if ($classifieds->category) {
		echo '<strong>'.elgg_echo('agora:category') . '</strong>: '.agora_get_cat_name_settings($classifieds->category, true).'<br />';
    } 	
	if ($classifieds->price) { 
		echo '<strong>'.elgg_echo('agora:price') . '</strong>: '.get_agora_currency_sign($classifieds->currency).' '.$classifieds->price.'<br />';
		echo $gallerybutton;
	}
	echo '</div>';
	echo '</div>';
}
else {
	// we want small thumb on group views
	$page_owner = elgg_get_page_owner_entity();
	if (elgg_instanceof($page_owner, 'group'))  
		$thumbsize = 'small';
	else
		$thumbsize = 'medium';
	
    // brief view
    $classfd_img = elgg_view('output/url', array(
        'href' => "agora/view/{$classifieds->guid}/" . elgg_get_friendly_title($classifieds->title),
        'text' => elgg_view('agora/thumbnail', array('classfdguid' => $classifieds->guid, 'size' => $thumbsize, 'tu' => $tu)),
    ));
                        
    $display_text = $url;

	//$content = '<div class="agoraprint">'.$buybuttton.'</div>';
    if ($classifieds->price) {
		$content .= '<div class="list_features"><strong>'.elgg_echo('agora:price') . '</strong>: '.get_agora_currency_sign($classifieds->currency).' '.$classifieds->price.'</div>';
    }     
	if ($classifieds->category) {
		$content .= '<div class="list_features"><strong>'.elgg_echo('agora:category') . '</strong>: '.agora_get_cat_name_settings($classifieds->category, true).'</div>';
    } 
	if (is_geolocation_enabled() && $classifieds->location) {
		$clocation = elgg_view('output/url', array(
			'href' => elgg_get_site_url() . "agora/map?guid={$classifieds->guid}",
			'text' => $classifieds->location,
		));		
		$content .= '<div class="list_features"><strong>'.elgg_echo('agora:location') . '</strong>: '.$clocation.'</div>';
    }      
 
	if (is_numeric($classifieds->howmany)) {
		$content .= '<div class="list_features"><strong>'.elgg_echo('agora:howmany') . '</strong>: '.$classifieds->howmany.'</div>';
    }     
    
    //$content .= $excerpt;
    $params = array(
            'entity' => $classifieds,
            'metadata' => $metadata,
            'subtitle' => $subtitle,
            'content' => $content,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($classfd_img, $body);
    
}
