<?php
global $CONFIG;
$site = elgg_get_site_entity();
set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');
include elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';

if($_FILES['upload']['error']>0)
{
	register_error('Error');
}
else
{
	$info = pathinfo($_FILES['upload']['name']);
	$ext = $info['extension'];
	$newName = "member_upload".".".$ext;
	$target =$CONFIG->dataroot.$newName;
	move_uploaded_file( $_FILES['upload']['tmp_name'], $target);
	$inputFileName = './'.$newName;  // File to read

	try {
		$objPHPExcel = PHPExcel_IOFactory::load($target);
		} 
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($target,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

	echo "<pre>";
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

	//print_r($sheetData);

	foreach ($sheetData as $data)
	{

		$user = get_user_by_username($data[A]);
		unset($sugested_groupids);
		for($i='B';$i<='Z';$i++)
		{

			if($data[$i]!='')
			{
				$sugested_groupids[] = $data[$i];
			}
		}
		
		if ($user instanceof ElggUser)
		{
			//echo "User Exist...";
			$user->suggestedgroupids = serialize($sugested_groupids);
		}
		else
		{
			//echo "User Not Exist...";
			$suggestedgroupids = unserialize($site->suggestedgroupids);
			$suggestedgroupids[$data[A]] = $sugested_groupids;
			$site->suggestedgroupids = serialize($suggestedgroupids);
		}
	
	}

}

?>
