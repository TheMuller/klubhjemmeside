<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');

//the page owner
$owner = get_user($vars['entity']->owner_guid);

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
	$num = 4;
}		

// load list of bought items
$options_bought = array(
	'type' => 'object',
	'subtype' => 'agorasales',
	'limit' => $num,
	'metadata_name_value_pairs' => array(
		array('name' => 'txn_buyer_guid','value' => $owner->guid,'operand' => '='), 
	),   
	//'order_by_metadata' => array(
	//		array( 'name' => 'txn_buyer_guid', 'direction' => 'DESC' ),
	//),	
);
$items_bought = elgg_get_entities_from_metadata($options_bought);
		
$item_guid = 0;
if (is_array($items_bought) && sizeof($items_bought) > 0) {
	
	echo '<h3>'.elgg_echo("agora:widget:items_bought").'</h3>';
	echo '<ul class="elgg-list">';	
	foreach($items_bought as $item) {
		$post = get_entity($item->txn_vguid);
	
		if ($post && $item_guid != $post->guid) {
			echo "<li class=\"pvs\">";
			$agora_title = elgg_view('output/url', array(
				'href' => "agora/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
				'text' => '<h4>'.$post->title.'</h4>',
			));
			$agora_img = elgg_view('output/url', array(
				'href' => "agora/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
				'text' => elgg_view('agora/thumbnail', array('classfdguid' => $post->guid, 'size' => 'small')),
			));		
			$agora_date = '<p>'.$item->txn_date.'</p>';
			echo elgg_view_image_block($agora_img, $agora_title.$agora_date);			
			echo "</li>";
			
			$item_guid = $post->guid;
		}
	}
	echo "</ul>";
}

// load list of sold items
$options_sold = array(
	'type' => 'object',
	'subtype' => 'agorasales',
	'limit' => $num,
	'container_guid' => $owner->guid,
);
$items_sold = elgg_get_entities($options_sold);
		
if (is_array($items_sold) && sizeof($items_sold) > 0) {
	
	echo '<h3>'.elgg_echo("agora:widget:items_sold").'</h3>';
	echo '<ul class="elgg-list">';	
	foreach($items_sold as $item) {
		$post = get_entity($item->txn_vguid);
	
		if ($post) {
			echo "<li class=\"pvs\">";
			$agora_title = elgg_view('output/url', array(
				'href' => "agora/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
				'text' => '<h4>'.$post->title.'</h4>',
			));
			$agora_img = elgg_view('output/url', array(
				'href' => "agora/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
				'text' => elgg_view('agora/thumbnail', array('classfdguid' => $post->guid, 'size' => 'small')),
			));		
			$agora_date = '<p>'.$item->txn_date.'</p>';
			echo elgg_view_image_block($agora_img, $agora_title.$agora_date);			
			echo "</li>";
		}
	}
	echo "</ul>";
}
