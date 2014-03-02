<?php
/**
 * Metatags
 *
 * @package info pages
 */

$page = $vars['entity'];
$subtype = get_subtype_from_id($page->subtype);

if($subtype == 'info_page'){
	?>
<meta name="description" content="<?php echo $page->metadescription;?>" />
<meta name="keywords" content="<?php echo $page->metakeywords; ?>" />   
    
    <?php
}