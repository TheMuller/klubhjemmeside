<?php
/**
 * Friend widget display view
 *
 */

// owner of the widget
$owner = $vars['entity']->getOwnerEntity();

// the number of friends to display
$num = (int) $vars['entity']->num_display;

// get the correct size
$size = $vars['entity']->icon_size;

if (elgg_instanceof($owner, 'user')) {
	$html = $owner->listFriends('', $num, array(
		'size' => $size,
		'list_type' => 'gallery',
		'pagination' => false
	));
	if ($html) {
		echo $html;
		
		$url = "friendsgallery/" . elgg_get_page_owner_entity()->username;
		$more_link = elgg_view('output/url', array(
			'href' => $url,
			'text' => elgg_echo('friends:gallery'),
			'is_trusted' => true,
		));
		echo "<span class=\"elgg-widget-more\">$more_link</span>";
	}
}
