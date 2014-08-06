<?php
/**
 * Elgg Agora Classifieds plugin
 * @package agora
 */

elgg_load_library('elgg:agora');

// load list of bought items
$options = array(
	'type' => 'object',
	'subtype' => 'agorasales',
	'limit' => 0,
);

$agores = elgg_get_entities($options);

if (is_array($agores) && sizeof($agores) > 0) {
	echo '<ul class="elgg-list">';	
	foreach($agores as $item) {
		$post = get_entity($item->txn_vguid);
	
		$buyer = get_user($item->txn_buyer_guid);
		$seller = get_user($item->container_guid);
		
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
			$agora_details = '<p>';
			$agora_details .= '&nbsp;&nbsp;<strong>'.elgg_echo('agora:settings:transactions:date').'</strong>: '.$item->txn_date;
			$agora_details .= '&nbsp;&nbsp;<strong>'.elgg_echo('agora:settings:transactions:seller').'</strong>: <a href="'.elgg_get_site_url().'profile/'.$seller->username.'">'.$seller->username.'</a>';
			$agora_details .= '&nbsp;&nbsp;<strong>'.elgg_echo('agora:settings:transactions:buyer').'</strong>: <a href="'.elgg_get_site_url().'profile/'.$buyer->username.'">'.$buyer->username.'</a>';
			$agora_details .= '</p>';
			echo elgg_view_image_block($agora_img, $agora_title.$agora_details);
			echo "</li>";
		}
	}
	echo "</ul>";
}
else {
	echo elgg_echo("agora:settings:transactions:none");
}

unset($agores);
