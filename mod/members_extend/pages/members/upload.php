<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<?php
set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');
//echo elgg_get_plugins_path() . 'members_extend/vendors/PHPExcleReader/index.php';
include elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';

	if($_FILES['upload']['error']>0)
{
register_error('Error');
}
else
{
echo "else";
$info = pathinfo($_FILES['upload']['name']);
var_dump($info)."/";
$ext = $info['extension'];
echo $ext;
$newName = "projectTest".".".$ext;
echo "<br>";
echo $newName;
global $CONFIG;
$target =$CONFIG->dataroot.$newName;
echo $target;
move_uploaded_file( $_FILES['upload']['tmp_name'], $target);

$inputFileName = './'.$newName;  // File to read

try {
	$objPHPExcel = PHPExcel_IOFactory::load($target);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($target,PATHINFO_BASENAME).'": '.$e->getMessage());
}


echo '<hr />';
echo "<pre>";
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
echo "afetr..";
print_r($sheetData);

//$group_guid = $group->getGUID();
foreach ($sheetData as $data)
{
	echo $data[A];
	$user = get_user_by_username($data[A]);
	if ($user instanceof ElggUser)
	{
		echo "User Exist...";
		 $options = array(
                          'type' => 'group',
                          'relationship' => 'member',
                          'relationship_guid' => $user->guid,
                          'inverse_relationship' => false,
                          );
		$groups = elgg_get_entities_from_relationship($options); 
		unset($sugested_groupids);
		unset($redgroupids);
		for($i='B';$i<='Z';$i++)
		{
			//echo $data[$i];
		
			if($data[$i]!='')
			{
				$sugested_groupids[] = $data[$i];
			}
		
		}
		var_dump($sugested_groupids);
		foreach($groups as $group)
		{
		echo $group->guid;	
			if(!in_array($group->guid,$sugested_groupids))
			{
				$redgroupids[]=$group->guid;
			ECHO "not IN";
				
			}
			else 
			echo "in";
		}
		var_dump($redgroupids);
		$user->redgroupids=serialize($redgroupids);
	}
	else
	{
		echo "User Not Exist...";
	}
	
	
}

/*require_once '$base/excel_reader2.php';
$data = new Spreadsheet_Excel_Reader($newName);

echo $data->dump(true,true); 

echo file_get_contents($target.$newname); */


}

?>
<body>
</html>