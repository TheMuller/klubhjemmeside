 <script type="text/javascript">
$(function() {
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
$('#btnclick').click(function() {
$('#testdiv').show();
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
})
})
</script>
<?php
/**
 * Elgg image_slider plugin settings.
 *
 * @package Elggimage_slider
 */
global $CONFIG;
echo "<div  style=' border: 1px solid #CC0;padding-top: 20px;padding-bottom: 4px;padding-left: 4px;'>
<b><u>Upload Image:</u></b><br><br>";
echo "<form action='".elgg_get_site_url()."admin/appearance/settings' method='post' enctype='multipart/form-data'>";

echo "<input type='file' name='upload'>&nbsp;&nbsp;";

	if (($_FILES["upload"]["type"] == "image/gif") 
	|| ($_FILES["upload"]["type"] == "image/jpeg")
	|| ($_FILES["upload"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/png")){
		if($_FILES['upload']['error']>0){
            register_error('Error');echo "Error: " . $_FILES["upload"]["error"] . "<br>";
        }else{
				$info = pathinfo($_FILES['upload']['name']);
				$ext = ".".$info['extension'];
				$target = $CONFIG->dataroot."image_slider/" .$_FILES["upload"]["name"];
				move_uploaded_file($_FILES["upload"]["tmp_name"], $target);
				echo "<div id='testdiv'><br><br><b><u> File Description : </u></b>";
				echo "<br>File Name : ".$_FILES["upload"]["name"];
				echo "<br>Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : " . $_FILES["upload"]["type"];
				echo "<br>Stored in &nbsp; : " . $target;
				echo "</div>";
			}
		}else{
				echo "<div id='testdiv'><br>Invalid file<br> Your File Extension muust be .PNG, .jpg, .jpeg or .gif</div>";
			}
        echo "<br><br><input type='submit' value='submit' id='btnclick'>";
        echo "</form>";	

echo "<br><hr style='width:40%;float:left;'><br> <b style='padding-left:2cm;'>Availabal Images In Directory</b> <br><hr style='width:40%;float:left;'>";
$files = glob($CONFIG->dataroot."image_slider/*");
foreach($files as $file){
	    echo "<br>";
		echo elgg_view('output/url', array(
				'href' => elgg_add_action_tokens_to_url(elgg_get_site_url().'action/image_slider/delete?image='.basename($file)),
				'is_trusted' => true,
				'text' => elgg_echo('delete'),
				'type' => 'button',				
			));
		echo "&nbsp;&nbsp;".basename($file);	
}
?>
<br>
</div>	
