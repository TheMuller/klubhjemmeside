<?php
global $CONFIG;
$field = $vars;
$entity = $field['entity'];
$name = $field['name'];
//only one image
$title = $field['title'];
if($field['required']==1){
	$title = "<span class='required'>*</span>".$title;
}
$fieldName = "field_" . $field['name'];
$field['class'] = $field['class'] . " " . $fieldName;
$subtitle = $field['subtitle'];
$size = "medium";
//test if image exist
if ($entity){
	$file = "tools/" . $entity->guid . "/" . $field['name'] . "_" . $size . ".jpg";
	$owner_guid = $entity->owner_guid;
	if(!vazco_tools::fileExists($file, $owner_guid)){
		$pic = false;
	}
	else{
		$pic = elgg_view('vazco_newsletter/vazco_tools/output/icon',array('name' => $field['name'] , 'entity'=>$entity,'size'=>$size));
	}
}else{
	$pic = false;
}

if($pic){
	 
	$pic = "<img src=\"{$pic}\"/>";
	$jsName = "'" . $field['name'] . "'";
	$jsId = isset($field['internalid']) ? "'" . $field['internalid'] . "'":$jsName;
	$field_str = elgg_view("input/{$field['type']}", $field);
	$pic .=  "<p class='delete_link'><a href=\"#\" onClick=\"javascript:return vazco_myproject_deletePic_{$name}(" . $jsName ."," . $jsId .")\"> " . elgg_echo("vazco_tools:image:delete") . "</a></p>";
}

$fieldContent =  elgg_view("input/{$field['type']}", $field);
$jsContent = str_replace("'",'"',$fieldContent);
?>

<div id="edit_image_<?php echo $field['name'] ?>" class="edit_image">
<div class='<?php echo $fieldName ?>'><label><?php echo $title ?></label></div>
<?php if ($subtitle){?>
<div class='subtitle'><?php echo $subtitle ?></div>
<?php } ?>
<br />
<div id="edit_pic_<?php echo $field['name'] ?>">
	<?php echo $pic ?>
</div>
<div id="edit_input_<?php echo $field['name'] ?>" class="<?php echo $pic?"nodisplay":"" ?>">
<div id="multi_image_input_list_<?php echo $name ?>">
	<?php echo $fieldContent ?>
</div>
</div>

</div>

<script type="text/javascript">
  function vazco_myproject_deletePic_<?php echo $name ?>(name){
      container =  "#edit_pic_<?php echo $field['name']; ?>";
      fields =  "#edit_input_<?php echo $field['name'] ?>";
      html = '<?php echo $jsContent ?>';
      $(container).fadeOut("" , function(){
        $(fields).fadeIn();
      });
	return false;
  }
</script>

