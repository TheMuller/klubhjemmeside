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
		
$posts = elgg_get_entities(array('type'=>'object','subtype'=>'agora', 'owner_guid' => $owner->guid, 'limit'=>$num));

	
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
	echo "<div class=\"contentWrapper\"><a href=\"" . elgg_get_site_url() . "agora/owner/" . $owner->username . "\">" . elgg_echo("agora:widget:viewall") . "</a></div>";

}

