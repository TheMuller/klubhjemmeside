<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use 

$title = elgg_extract('title', $vars, '');
$category = elgg_extract('category', $vars, '');
$desc = elgg_extract('description', $vars, '');
$price = elgg_extract('price', $vars, 0);
$howmany = elgg_extract('howmany', $vars, 0);
$location = elgg_extract('location', $vars, 0);
$currency = elgg_extract('currency', $vars, 0);
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

$answers_yesno = array('Yes', 'No');

if (empty($currency))   {
    $currency = trim(elgg_get_plugin_setting('default_currency', 'agora'));
}

if (!$location) {
	$user = elgg_get_logged_in_user_entity();
	if ($user->location) $location = $user->location;
}

// get currency list
$CurrOptions = get_agora_currency_list();

$comments_input = elgg_view('input/dropdown', array(
	'name' => 'comments_on',
	'id' => 'agora_comments_on',
	'value' => elgg_extract('comments_on', $vars, ''),
	'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));

// check who can post for retrieving paypal account
$whocanpost = trim(elgg_get_plugin_setting('agora_uploaders', 'agora'));
if ($whocanpost === 'allmembers')   {
    $paypal_tip = '<span style="margin-right:20px;color:red;">'.elgg_echo('agora:add:price:note:importantall').'</span>';
}
else if ($whocanpost === 'admins')   {
    $paypal_tip = '<span style="margin-right:20px;">'.elgg_echo('agora:add:price:note:importantadmin').'</span>';
}

?>
<script type="text/javascript">
function acceptTerms() {
	error = 0;
	if(!(document.agoraForm.accept_terms.checked) && (error==0)) {		
		alert('<?php echo elgg_echo('agora:terms:accept:error'); ?>');
		document.agoraForm.accept_terms.focus();
		error = 1;		
	}
	if(error == 0) {
		document.agoraForm.submit();	
	}
}
</script>

<p><?php echo elgg_echo('agora:add:requiredfields'); ?></p>
<div>
    <label><?php echo elgg_echo('agora:add:title'); ?></label> <span style="color:red;">(*)</span>
    <span class='custom_fields_more_info' id='more_info_title'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_title'>
        <?php echo elgg_echo('agora:add:title:note'); ?>
    </span>
    <br /><?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>

<div>
    <label><?php echo elgg_echo('agora:add:category'); ?></label>:
    <span class='custom_fields_more_info' id='more_info_category'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_category'>
        <?php echo elgg_echo('agora:add:category:note'); ?>
    </span>
    <?php echo elgg_view('input/dropdown', array('name' => 'category', 'id'=>'category', 'options_values'=>agora_settings('categories'), 'value' => $category)); ?>
</div>

<div>
    <label><?php echo elgg_echo('agora:add:price'); ?></label>:
    <span class='custom_fields_more_info' id='more_info_price'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_price'>
        <?php echo elgg_echo('agora:add:price:note'); ?>
    </span>
    <?php echo elgg_view('input/text', array('name' => 'price', 'value' => $price, 'class' => 'short')); ?>
    <?php echo $paypal_tip; ?>
</div>

<div>
    <label><?php echo elgg_echo('agora:add:currency'); ?></label>:
    <?php echo elgg_view('input/dropdown', array('name' => 'currency', 'value' => $currency, 'options_values' => $CurrOptions)); ?> 
</div> 

<div>
    <label><?php echo elgg_echo('agora:add:howmany'); ?></label>:
    <span class='custom_fields_more_info' id='more_info_howmany'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_howmany'>
        <?php echo elgg_echo('agora:add:howmany:note'); ?>
    </span>
    <?php echo elgg_view('input/text', array('name' => 'howmany', 'value' => $howmany, 'class' => 'short')); ?>
</div>

<?php if (is_geolocation_enabled()) {  ?>
<div>
    <label><?php echo elgg_echo('agora:add:location'); ?></label>
    <span class='custom_fields_more_info' id='more_info_location'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_location'>
        <?php echo elgg_echo('agora:add:location:note'); ?>
    </span>
    <br /><?php echo elgg_view('input/text', array('name' => 'location', 'value' => $location)); ?>
</div>
<?php }  ?>

<div>
    <label><?php echo elgg_echo('agora:add:description'); ?></label>
    <span class='custom_fields_more_info' id='more_info_description'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_description'>
        <?php echo elgg_echo('agora:add:description:note'); ?>
    </span>
    <?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>

<div>
    <label><?php echo elgg_echo('agora:add:image'); ?></label>
    <span class='custom_fields_more_info' id='more_info_image'></span>
    <span class='custom_fields_more_info_text' id='text_more_info_image'>
        <?php echo elgg_echo('agora:add:image:note'); ?>
    </span>    
    <?php echo elgg_view('input/file', array('name' => 'upload')); ?>
</div>

<div>
    <label><?php echo elgg_echo('agora:add:tags'); ?></label>
    <?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>

<div>
    <label for="agora_comments_on"><?php echo elgg_echo('comments'); ?></label>
    <?php echo $comments_input; ?>
</div>

<div>
    <label><?php echo elgg_echo('access'); ?></label><br />
    <?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>


<?php
if (check_if_admin_terms_classifieds())	{
// Terms checkbox and link
$termslink = elgg_view('output/url', array(
			'href' => "mod/agora/terms.php",
			'text' => elgg_echo('agora:terms:title'),
			'class' => "elgg-lightbox",
			));
$termsaccept = sprintf(elgg_echo("agora:terms:accept"),$termslink);
?>
<div>
	<input type='checkbox' name='accept_terms'><label><?php echo $termsaccept; ?></label>
</div>
<?php
}
?>

<div class="elgg-foot">
<?php

    if ($guid) {
            echo elgg_view('input/hidden', array('name' => 'agora_guid', 'value' => $guid));
    }
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('agora:add:submit')));
?>
</div>
