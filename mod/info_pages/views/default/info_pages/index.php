<?php
/**
 * Group pages
 *
 * @package ElggPages
 */

$pages = elgg_get_entities_from_metadata(array(
	'types' => 'object',
	'subtypes' => 'info_page',
	'full_view' => false,
	'order_by_metadata' =>	array('name' => 'orderno', 'direction' => ASC, 'as' => integer)

	));

$page = $pages[0];

//echo elgg_view_title($page->title);

echo $page->description;

if(elgg_is_admin_logged_in()){
	if($page){
		echo elgg_view('output/url', array ('href' => 'info_pages/edit/' . $page->guid,
				'text' => elgg_echo('info_pages:edit'),
				'class' => 'elgg-button elgg-button-action',));
	} else {
		echo elgg_view('output/url', array ('href' => 'info_pages/add/' . $_SESSION['user']->guid,
				'text' => elgg_echo('info_pages:add'),
				'class' => 'elgg-button elgg-button-action',));
	}
}

echo '<p></p>';
