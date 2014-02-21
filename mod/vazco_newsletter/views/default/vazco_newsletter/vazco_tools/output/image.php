<?php
  global $CONFIG;
  $entity = $vars['entity'];
  $field = $vars['field'];
  
 //only one image
  $title = $field['title'];
  if($field['required']==1){
    $title = "<span class='required'>*</span>".$title;
  }
  $fieldName = "field_" . $field['name'];
  $field['class'] = $field['class'] . " " . $fieldName;
  $size = "medium";
  //test if image exist
  $file = "tools/" . $entity->guid . "/" . $field['name'] . "_" . $size . ".jpg";
  $owner_guid = $entity->owner_guid;
  if(!vazco_tools::fileExists($file, $owner_guid)){
    $pic = false;
  }
  else{
    $pic = elgg_view('vazco_newsletter/vazco_tools/output/icon',array('name' => $field['name'] , 'entity'=>$entity,'size'=>$size));
  }

  
  if($pic){
     
    $pic = "<img src=\"{$pic}\"/>";
    $jsName = "'" . $field['name'] . "'";
    $jsId = isset($field['internalid']) ? "'" . $field['internalid'] . "'":$jsName;
    $pic .=  "<p class='delete_link'><a href=\"javascript:void()\" onClick=\"vazco_myproject_deletePic(" . $jsName ."," . $jsId .")\"> " . elgg_echo("vazco_tools:image:delete") . "</a></p>";
  }
 
  $fieldContent =  elgg_view("input/{$field['type']}", $field);

?>

 <div id="edit_image_<?php echo $field['name'] ?>" class="edit_image" >
   <p class='<?php echo $fieldName ?>'><label><?php echo $title ?></label></p><br/>
   <div id="edit_pic_<?php echo $field['name'] ?>" >
    <?php echo $pic ?>
   </div>
    <div id="edit_input_<?php echo $field['name'] ?>" class="<?php echo $pic?"nodisplay":"" ?>" >
   <?php echo $fieldContent ?>
   </div>
 
 </div>


