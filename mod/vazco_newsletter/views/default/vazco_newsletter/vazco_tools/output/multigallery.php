<?php 
//this view is used to display multiimages in a gallery

$entity = $vars['entity'];
$fieldName = $vars['name'];
$size = $vars['size'];
if (!$size){
	$size = 'medium';
}
$fieldArray = $vars['fieldArray'];
$pics = vazco_tools::getMultigalleryPictures($fieldArray, $fieldName, $entity, $size, 'mod/vazco_newsletter/views/default/vazco_newsletter/vazco_tools/output');


?>
<div class="tools-imagegallery">
	<?php foreach ($pics as $key => $pic){
			//check wether image exists
			$title = $fieldName.'_'.$key;
			$file = "tools/" . $entity->guid . "/" .  $title . "_" . $size . ".jpg";
			if (vazco_tools::fileExists($file, $entity->owner_guid)){
		?>
		<div class="image">
			<a class="colorbox" href="<?php echo $pic['orig'];?>"><img src="<?php echo $pic['img'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"></img></a>
		</div>
	<?php }
	}
	?>
	<div class="clearfloat"></div>
</div>