<?php
/**
 * View for page object
 *
 * @package ElggPages
 *
 * @uses $vars['entity']    The page object
 * @uses $vars['full_view'] Whether to display the full view
 * @uses $vars['revision']  This parameter not supported by elgg_view_entity()
 */


$full = elgg_extract('full_view', $vars, FALSE);
$page = elgg_extract('entity', $vars, FALSE);

if (!$page) {
	return TRUE;
}


$date = elgg_view_friendly_time($page->time_created);
$tags = elgg_view('output/tags', array('tags' => $page->tags));


$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'info_pages',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));


if ($full) {
	$body = elgg_view('output/longtext', array('value' => $page->description));

	$params = array(
		'entity' => $page,
		'metadata' => $metadata,
		'tags' => $tags,
		'title' =>false
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'entity' => $page,
		'title' => false,
		'summary' => $summary,
		'body' => $body,
	));

} else {
	// brief view

	$excerpt = elgg_get_excerpt($page->description);

	$params = array(
		'entity' => $page,
		'metadata' => $metadata,
		'tags' => $tags,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($page_icon, $list_body);
	
	$sub_pages = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'info_page',
		'metadata_name_value_pairs' => array('name' => 'parent_guid','value' => $page->guid,  'operand' => '='),
		'order_by_metadata' =>	array('name' => 'sub_orderno', 'direction' => ASC, 'as' => integer)
	));
	
	foreach($sub_pages as $sub_page){
		$excerpt = elgg_get_excerpt($sub_page->description);
		
		$metadata = elgg_view_menu('entity', array(
			'entity' => $sub_page,
			'handler' => 'info_pages',
			'sort_by' => 'priority',
			'class' => 'elgg-menu-hz',
		));

	
		$params = array(
			'entity' => $sub_page,
			'metadata' => $metadata,
			'content' => $excerpt,
		);
		$params = $params + $vars;
		$list_body = elgg_view('object/elements/summary', $params);
	
		echo elgg_view_image_block(null, $list_body, array('class'=>'subpage'));
		
			//another foreach for sub level 3
			$sub_sub_pages = elgg_get_entities_from_metadata(array(
				'types' => 'object',
				'subtypes' => 'info_page',
				'metadata_name_value_pairs' => array('name' => 'parent_guid','value' => $sub_page->guid,  'operand' => '='),
				'order_by_metadata' =>	array('name' => 'sub_orderno', 'direction' => ASC, 'as' => integer)
			));
		
			foreach($sub_sub_pages as $sub_page){
				$excerpt = elgg_get_excerpt($sub_page->description);
				
				$metadata = elgg_view_menu('entity', array(
					'entity' => $sub_page,
					'handler' => 'info_pages',
					'sort_by' => 'priority',
					'class' => 'elgg-menu-hz',
				));
		
			
				$params = array(
					'entity' => $sub_page,
					'metadata' => $metadata,
					'content' => $excerpt,
				);
				$params = $params + $vars;
				$list_body = elgg_view('object/elements/summary', $params);
			
				echo elgg_view_image_block(null, $list_body, array('class'=>'sub_subpage'));
			}
	
	}
	
}

