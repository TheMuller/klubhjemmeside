<?php
/**
 * Elgg image_slider plugin settings.
 *
 * @package ElggLogRotate
 */
 global $CONFIG;
$files = glob($CONFIG->dataroot."image_slider/".get_input('image',''));
foreach($files as $file)
{
      unlink($CONFIG->dataroot."image_slider/".basename($file));	
}
?>

