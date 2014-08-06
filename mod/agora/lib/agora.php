<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

//add classifieds form parameters
function agora_prepare_form_vars($classfd = null) {

	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'entity' => $classfd,
		'price' => 0,
		'currency' => '',
		'category' => '',
		'howmany' => '',
		'location' => '',
		'climage' => '',
		'guid' => null,
		'comments_on' => NULL,
	); 
	
	if ($classfd) {
		foreach (array_keys($values) as $field) {
			if (isset($classfd->$field)) {
					$values[$field] = $classfd->$field;
			}
		}
	}

	if (elgg_is_sticky_form('agora')) {
            $sticky_values = elgg_get_sticky_values('agora');
            foreach ($sticky_values as $key => $value) {
                $values[$key] = $value;
            }
	}

	elgg_clear_sticky_form('agora');

	return $values;
}

// check if user can post classifieds
function check_if_user_can_post_classifieds($user = null) {
    $whocanpost = trim(elgg_get_plugin_setting('agora_uploaders', 'agora'));
    
    if (elgg_is_logged_in())    {
        if ($whocanpost === 'allmembers')   {
            return true;
        }
        else if ($whocanpost === 'admins')   {
            if (!$user) $user = elgg_get_logged_in_user_entity();
            if ($user->isAdmin()) {
                return true;
            } 
        }
    }
    
    return false;
}
  
function get_agora_currency_list() {
    // Currencies list according paypal api
    $CurrOptions = array(
        'AUD'=>'Australian Dollar',
        'BRL'=>'Brazilian Real',
        'CAD'=>'Canadian Dollar',
        'CZK'=>'Czech Koruna',
        'DKK'=>'Danish Krone',
        'EUR'=>'Euro',
        'HKD'=>'Hong Kong Dollar',
        'HUF'=>'Hungarian Forint',
        'ILS'=>'Israeli New Sheqel',
        'JPY'=>'Japanese Yen',
        'MYR'=>'Malaysian Ringgit',
        'MXN'=>'Mexican Peso',
        'NOK'=>'Norwegian Krone',
        'NZD'=>'New Zealand Dollar',
        'PHP'=>'Philippine Peso',
        'PLN'=>'Polish Zloty',
        'GBP'=>'Pound Sterling',
        'SGD'=>'Singapore Dollar',
        'SEK'=>'Swedish Krona',
        'CHF'=>'Swiss Franc',
        'TWD'=>'Taiwan New Dollar',
        'THB'=>'Thai Baht',
        'TRY'=>'Turkish Lira',
        'USD'=>'U.S. Dollar',
    );
    
    return $CurrOptions;
}

function get_agora_currency_sign($currency_code) {
    switch ($currency_code) {
        case "AUD":
            return "$";
            break;  
        case "BRL":
            return "R$";
            break;  
        case "CAD":
            return "$";
            break;  
        case "CZK":
            return "Kč";
            break;  
        case "DKK":
            return "kr";
            break;  
        case "EUR":
            return "€";
            break;  
        case "HKD":
            return "$";
            break;  
        case "HUF":
            return "Ft";
            break;  
        case "ILS":
            return "₪";
            break; 
        case "JPY":
            return "¥";
            break; 
        case "MYR":
            return "RM";
            break; 
        case "MXN":
            return "$";
            break; 
        case "NOK":
            return "kr";
            break;         
        case "NZD":
            return "$";
            break;   
        case "PHP":
            return "₱";
            break;   
        case "PLN":
            return "zł";
            break;   
        case "GBP":
            return "£";
            break;   
        case "SGD":
            return "$";
            break;   
        case "SEK":
            return "kr";
            break;   
        case "CHF":
            return "CHF";
            break;   
        case "TWD":
            return "NT$";
            break;   
        case "THB":
            return "฿";
            break;   
        case "TRY":
            return "TRY";
            break;   
        case "USD":
            return "$";
            break;           
        default:
            return "$";
    }   
}

// Get settings parameters
function agora_settings($name ='categories', $null = true){
	$type = elgg_get_plugin_setting($name,'agora');
	$fields = explode(",", $type);
	if($null){
		$field_values[NULL] = elgg_echo('agora:add:category:select');
	}
	foreach ($fields as $val){
		$key = elgg_get_friendly_title($val);
		if($key){
			$field_values[$key] = $val;
		}
	}
	return $field_values;
}

// Get category title
function agora_get_cat_name_settings($catname = null, $linked = false){
	$type = elgg_get_plugin_setting('categories','agora');
	$fields = explode(",", $type);
	foreach ($fields as $val){
		$key = elgg_get_friendly_title($val);
		if($key == $catname){
			if ($linked)	{
				$page = 'agora/all/';
				return '<a class="elgg-menu-item" href="'.elgg_get_site_url().$page.$key.'" title="">'.$val.'</a>';
			}
			else
				return $val;
		}
	}
	return null;
}

// check if admin has set terms of use
function check_if_admin_terms_classifieds() {
    $terms_of_use = trim(elgg_get_plugin_setting('terms_of_use', 'agora'));
    
	if (!empty($terms_of_use) && $terms_of_use !=null)   {
		return true;
	}
	
    return false;
}

// check if members can send private message to seller
function check_if_members_can_send_private_message() {
    $send_message = trim(elgg_get_plugin_setting('send_message', 'agora'));
    
    if ($send_message === 'yes')   {
		return true;
	}
	
    return false;
}

// check if geolocation is enabled
function is_geolocation_enabled() {
    $ads_geolocation = trim(elgg_get_plugin_setting('ads_geolocation', 'agora'));
    
    if ($ads_geolocation === 'yes')   {
		return true;
	}
	
    return false;
}

// get ad user interest status
function get_ad_user_interest_status($status) {
        
    if ($status === AGORA_INTEREST_ACCEPTED)   {
		return '<span style="color:green;">('.elgg_echo('agora:interest:accepted').')</span>';
	}
	else if ($status === AGORA_INTEREST_REJECTED)   {
		return '<span style="color:red;">('.elgg_echo('agora:interest:rejected').')</span>';
	}
	
    return '';
}
