<?php
  global $CONFIG;
  $entity = $vars['entity'];
  $field = $vars['field'];
  $limit = (int)$field['limit'] > 0 ? (int) $field['limit'] : 5;
  $size = $vars['size'] ?  $vars['size'] : "medium";
  
 
  $title = $field['title'];
  if($field['required']==1){
    $title = "<span class='required'>*</span>".$title;
  }
  $default =  elgg_view("input/{$field['type']}", $field);
  $name = $field['name'];
  for($i = 1 ; $i < $limit ; $i++){

      $field['name'] = $name . "_" . $i;
      $field['internalname'] = $name . "_" . $i;

      $file = "tools/" . $entity->guid . "/" .  $field['name'] . "_" . $size . ".jpg";
	$owner_guid = $entity->owner_guid;
      if(vazco_tools::fileExists($file, $owner_guid)){
        $pics[$i] = elgg_view('vazco_tools/output/icon',array('name' => $field['name'] , 'entity'=>$entity,'size'=>$size));
        $field_str = elgg_view("input/{$field['type']}", $field);
        $jsFields[$i] = str_replace("'",'"',$field_str);
      }
      else{
		$field_str = elgg_view("input/{$field['type']}", $field);
		$fields[] =  $field_str;//str_replace("'",'"',$field);
      }
  }
  ?>

<div id="multi_image_<?php echo $name ?>" class="edit_image">
  <p><label><?php echo $title ?></label></p>
  <?php
  
    foreach($pics as $key => $pic){
       echo "<div id='multi_image_" . $name . "_pic_" . $key . "'>";
       echo "<img src='" . $pic . "'/>";
       echo "<p class='delete_link'><a href=\"javascript:void()\" onClick=\"vazco_myproject_deletePic_" . $name . "('" . $key . "')\"> " . elgg_echo("delete") . "</a></p>";
       echo "</div>";

    }
    ?>
  <div id="multi_image_input_list_<?php echo $name ?>">
    <?php
    foreach($fields as $field){
      echo $field;
    }
    ?>
  </div>
  

</div>

<script type="text/javascript">
  function vazco_myproject_deletePic_<?php echo $name ?>(name){
   
      container =  "#multi_image_<?php echo $name ?>_pic_" + name;

      fields =  "#multi_image_input_list_<?php echo $name ?>";
      var inputs = new Array();
      <?php foreach ($jsFields as $key => $field){ ?>
      inputs['<?php echo $key ?>'] = '<?php echo $field ?>';
      <?php  } ?>
      html = inputs[name];

      
      deleteInput = "<input type=\"hidden\" name=\"delete_<?php echo $name ?>_" + name + "\" value = \"yes\" />";

      $(container).fadeOut("" , function(){
        $(fields).append(html);
        $(fields).append(deleteInput);
      });
  
  }
</script>


