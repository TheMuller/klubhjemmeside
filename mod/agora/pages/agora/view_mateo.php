<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

// Load fancybox
elgg_load_js('lightbox');
elgg_load_css('lightbox');
	
//get entity
$classf = get_entity(get_input('guid'));

if ($classf) {
	
if (!$classf) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

// check if print preview
$print = get_input('view');

$page_owner = elgg_get_page_owner_entity();
$crumbs_title = $page_owner->name;
if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "agora/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "agora/owner/$page_owner->username");
}

$title = $classf->title; 
elgg_push_breadcrumb($title);


$content = elgg_view_entity($classf, array('full_view' => true));
if ($classf->comments_on != 'Off') {
    $content .= elgg_view_comments($classf);
}     
} else {
			
	// Display the 'post not found' page instead
	$content = elgg_view_title(elgg_echo("agora:notfoundtext"));
	//$title = elgg_echo("agora:notfound");
}

$sidebar = '';
    
// show ad sales on sidebar if any only for classifieds owner
if (elgg_is_logged_in()) {
	
    $user = elgg_get_logged_in_user_entity();
    
    if ($user && $user->guid==$classf->owner_guid) {
		// set ignore access for loading all entries
		$ia = elgg_get_ignore_access();
		elgg_set_ignore_access(true);
				
        // load list buyers
        $options = array(
            'type' => 'object',
            'subtype' => 'agorasales',
            'limit' => 0,
            'metadata_name_value_pairs' => array(
                array('name' => 'txn_vguid','value' => $classf->guid,'operand' => '='), 
            ),   
        );

		$buyerslist = elgg_get_entities_from_metadata($options); 
        if ($buyerslist)	{
			$sidebar .= '<div style="font-size:90%;">';
			$sidebar .= '<h3>'.elgg_echo('agora:sales').'</h3>';			
			foreach ($buyerslist as $b) {
				//$sidebar .= $b->agora_guid.' - '.$b->user_guid.' - '.$b->txn_date.'<br/>';
				$buyer = get_user($b->txn_buyer_guid);
				$sidebar .= '<p><a href="'.elgg_get_site_url().'profile/'.$buyer->username.'">'.$buyer->username.'</a> - '.$b->txn_date;
				$sidebar .= '<br/>'.elgg_echo('agora:transactionid').': '.$b->txn_id.'</p>';
			}
			$sidebar .= '</div>'; 
		}
        
        // load list users interested
        $options_int = array(
            'type' => 'object',
            'subtype' => 'agorainterest',
            'limit' => 0,
            'metadata_name_value_pairs' => array(
                array('name' => 'int_ad_guid','value' => $classf->guid,'operand' => '='), 
            ),   
        );

        $interestlist = elgg_get_entities_from_metadata($options_int); 
        if ($interestlist)	{
						
			foreach ($interestlist as $b) {
				$read_message = elgg_view('output/url', array(
					'href' => elgg_get_site_url().'messages/read/'.$b->int_message_guid,
					'text' => elgg_echo('agora:interest:read_message'),
					'is_trusted' => true,
				));			
				
				$set_status_buttons = '';
				// show buttons only if status is not accepted or rejected and also if there are available products
				if ($b->int_status == AGORA_INTEREST_INTEREST && ($classf->howmany>0 || !is_numeric($classf->howmany))) {   
					$vars = array('interest_guid' => $b->guid);
					// set accepted form
					$form_vars_set_accepted = array('name' => 'set_accepted', 'enctype' => 'multipart/form-data');
					$set_accepted_form = elgg_view_form('agora/set_accepted', $form_vars_set_accepted, $vars);		
					$set_accepted_button = '<div>'.$set_accepted_form.'</div>';				
					// set rejected form
					$form_vars_set_rejected = array('name' => 'set_rejected', 'enctype' => 'multipart/form-data');
					$set_rejected_form = elgg_view_form('agora/set_rejected', $form_vars_set_rejected, $vars);		
					$set_rejected_button = '<div>'.$set_rejected_form.'</div>';		
					
					$set_status_buttons .= '<div class="interest_forms">'.$set_accepted_button.$set_rejected_button.'</div>';
					
					$potential = get_user($b->int_buyer_guid);
					$sidebar_interest .= '<div class="interest_unit">';
					$sidebar_interest .= '<a href="'.elgg_get_site_url().'profile/'.$potential->username.'">'.$potential->username.'</a> - '.$b->int_date.'<br />'.$read_message.' '.get_ad_user_interest_status($b->int_status);
					$sidebar_interest .= $set_status_buttons;
					$sidebar_interest .= '</div>';					
				}		


			}
			
			if ($sidebar_interest) {
				$sidebar .= '<div id="sidebar_interest"><h3>'.elgg_echo('agora:interests').'</h3>'.$sidebar_interest.'</div>';  
			}
		}
		// restore ignore access
		elgg_set_ignore_access($ia);
		
    }
    else { // check if this user has set interest for this add and display log
        // load list users interested
        $options_int = array(
            'type' => 'object',
            'subtype' => 'agorainterest',
            'limit' => 0,
            'metadata_name_value_pairs' => array(
                array('name' => 'int_ad_guid','value' => $classf->guid,'operand' => '='), 
            ),   
        );

        $interestlist = elgg_get_entities_from_metadata($options_int); 
        if ($interestlist)	{
			$sidebar .= '<div id="sidebar_interest">';
			$sidebar .= '<h4>'.elgg_echo('agora:interest:myinterest').'</h4>';
			foreach ($interestlist as $b) {
				$sidebar .= $b->int_date.'<br />';
			}
			$sidebar .= '</div>';  		
		}
	}
}

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
