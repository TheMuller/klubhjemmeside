<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');

// Get category
$selected_category = get_input('category');
if ($selected_category == 'all') {
	$category = '';
} elseif ($selected_category == '') {
	$category = '';
	$selected_category = 'all';
} else {
	$category = $selected_category;
}

$options = array(
	'type' => 'object',
	'subtype' => 'agora',
	'limit' => 10,
	'full_view' => false,
	'view_toggle_type' => false 
);

elgg_pop_breadcrumb();
if (!empty($category)) {
	elgg_push_breadcrumb(elgg_echo('agora'), "agora/all");
	elgg_push_breadcrumb(agora_get_cat_name_settings($category));
	$options['metadata_name'] = "category";
	$options['metadata_value'] = $selected_category;
	$content = elgg_list_entities_from_metadata($options);		
	$title = elgg_echo('agora').': '.agora_get_cat_name_settings($category);
}
else  {
	elgg_push_breadcrumb(elgg_echo('agora'));
	$content = elgg_list_entities($options);
	$title = elgg_echo('agora');
}

// check if user can post classifieds
if (check_if_user_can_post_classifieds())   {
    elgg_register_title_button();
}


if (!$content) {
	$content = elgg_echo('agora:none');
} 
 
$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('agora/sidebar', array('selected' => $vars['page'])),
	'filter_override' => elgg_view('agora/nav', array('selected' => $vars['page'])),
));

echo elgg_view_page($title, $body);










