<!-- spotwork_optimization
<?php
global $CONFIG;
$path = $CONFIG->wwwroot.'mod/vazco_tools/vendors/';
?>
<script src="<?php echo $path;?>swfobject.js" type="text/javascript"></script>
<script src="<?php echo $path;?>jquery.tools.min.js" type="text/javascript"></script>


<script type="text/javascript">
  function vazco_myproject_deletePic(name, id ){
      container = "#edit_image_" + name;
      picture =  "#edit_pic_"+name;

      html = "<input type=\"hidden\" name=\"delete_" + name + "\" value = \"yes\" />";
      input = "#edit_input_"+name;
      
      $(container).fadeOut("" , function(){
        
        $(picture).html(html);
        $(input).removeClass('nodisplay');
        $(container).fadeIn();
      });
  }
</script>
 -->
