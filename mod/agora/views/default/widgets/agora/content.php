<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');

// set the default timezone to use
date_default_timezone_set('UTC');

// the page owner
// modified to be compatible with widget manager
$owner = get_entity($vars['entity']->owner_guid);
if (elgg_instanceof($owner, 'user')) {
	$url = "agora/owner/{$owner->username}";
} else {
	$url = "agora/group/{$owner->guid}/all";
}

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
	$num = 4;
}		
	

$options = array(
	'type'=>'object',
	'subtype'=>'agora', 
	'container_guid' => $vars['entity']->owner_guid,
	'limit'=>$num,
	'full_view' => false,
	'pagination' => false,
	'size' => 'small'
);


if (elgg_instanceof($owner, 'user')) {
	$posts = elgg_get_entities($options);	
	if (is_array($posts) && sizeof($posts) > 0) {
		$content =  '<ul class="elgg-list">';	
		
		foreach($posts as $post) {
			$content .=  "<li class=\"pvs\">";
			$category = "<strong>" . elgg_echo('agora:category') . ":</strong> " . elgg_echo(agora_get_cat_name_settings($post->category));
			$comments_count = $post->countComments();
			$text = elgg_echo("comments") . " ($comments_count)";
			$comments_link = elgg_view('output/url', array(
				'href' => $post->getURL() . '#agora-comments',
				'text' => $text,
			));
			$agora_img = elgg_view('output/url', array(
				'href' => "agora/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
				'text' => elgg_view('agora/thumbnail', array('classfdguid' => $post->guid, 'size' => 'small')),
			));

			$subtitle = "{$category}";
			if ($post->price) {
				$adprice = get_agora_currency_sign($post->currency).' '.$post->price;
				$subtitle .= '<br/><strong>'.elgg_echo('agora:price') . ":</strong> {$adprice}";
			}
			$subtitle .= "<br>{$author_text} {$date} {$comments_link}";
			$params = array('entity' => $post,'subtitle' => $subtitle);
			$params = $params + $vars;
			$list_body = elgg_view('object/elements/summary', $params);
			$content .= elgg_view_image_block($agora_img, $list_body);
			$content .= "</li>";
		}
				
		$content .= "</ul>";
	}	
} else {
	elgg_push_context('widgets');
	$content = elgg_list_entities($options);
	elgg_pop_context();	
}


if (!$content) {
	$content = '<p>' . elgg_echo('agora:none') . '</p>';
}

echo $content;

$more_link = elgg_view('output/url', array(
	'href' => $url,
	'text' => elgg_echo("agora:widget:viewall"),
	'is_trusted' => true,
));
echo "<span class=\"elgg-widget-more\">$more_link</span>";

	
/* obs
$posts = elgg_get_entities(array(
	'type'=>'object',
	'subtype'=>'agora', 
	'container_guid' => $vars['entity']->owner_guid,
	'limit'=>$num
));

	
// display the posts, if there are any
if (is_array($posts) && sizeof($posts) > 0) {
	echo '<ul class="elgg-list">';	
	
	foreach($posts as $post) {
		echo "<li class=\"pvs\">";
		$category = "<strong>" . elgg_echo('agora:category') . ":</strong> " . elgg_echo(agora_get_cat_name_settings($post->category));
		$comments_count = $post->countComments();
		$text = elgg_echo("comments") . " ($comments_count)";
		$comments_link = elgg_view('output/url', array(
			'href' => $post->getURL() . '#agora-comments',
			'text' => $text,
		));
		$agora_img = elgg_view('output/url', array(
			'href' => "agora/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
			'text' => elgg_view('agora/thumbnail', array('classfdguid' => $post->guid, 'size' => 'small')),
		));

		$subtitle = "{$category}";
		if ($post->price) {
			$adprice = get_agora_currency_sign($post->currency).' '.$post->price;
			$subtitle .= '<br/><strong>'.elgg_echo('agora:price') . ":</strong> {$adprice}";
		}
		$subtitle .= "<br>{$author_text} {$date} {$comments_link}";
		$params = array(
			'entity' => $post,
			'subtitle' => $subtitle,
		);
		$params = $params + $vars;
		$list_body = elgg_view('object/elements/summary', $params);
		echo elgg_view_image_block($agora_img, $list_body);
		echo "</li>";
	}
			
	echo "</ul>";
	
	$more_link = elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo("agora:widget:viewall"),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";	
}

*/
