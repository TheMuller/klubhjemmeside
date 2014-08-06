<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

elgg_load_library('elgg:agora');
elgg_load_js('lightbox');
elgg_load_css('lightbox');

// check if user can post classifieds
if (check_if_user_can_post_classifieds()) { 

    $title = elgg_echo('agora:add');
    elgg_push_breadcrumb($title);

    // build sidebar 
    $sidebar = '';

    // create form
    if (check_if_admin_terms_classifieds())	
		$form_vars = array('name' => 'agoraForm', 'js' => 'onsubmit="acceptTerms();return false;"', 'enctype' => 'multipart/form-data');
	else
		$form_vars = array('name' => 'agoraForm', 'enctype' => 'multipart/form-data');
    
    $vars = agora_prepare_form_vars();
    $content = elgg_view_form('agora/add', $form_vars, $vars);

    $body = elgg_view_layout('content', array(
        'content' => $content,
        'title' => $title,
        'sidebar' => $sidebar,
        'filter' => '',
    ));

    echo elgg_view_page($title, $body);
} 
else    {  
    register_error(elgg_echo('agora:add:noaccessforpost'));  
    forward(REFERER);    
}



