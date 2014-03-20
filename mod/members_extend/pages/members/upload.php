<?php
global $CONFIG;
$site = elgg_get_site_entity();
set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');
include elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';

if(empty($_FILES['upload']))
{
    $file = elgg_view('input/file', array('name' => "upload", 'is_trusted' => true    ));
        
    $file .= elgg_view('input/submit', array('value' => 'Upload Now' ));
    $content = elgg_view('input/form', array(
                                           'bgcolor' => "red",
                                           'body' => $file,
                                           'enctype' => 'multipart/form-data',
                                           'action' => 'members/upload'
                                           ));
}
else if($_FILES['upload']['error']>0)
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
$content .="success";
}

$params = array(
                    'content' => elgg_view('members/nav', array('selected' => $vars['page'])).$content,
                    'sidebar' => elgg_view('members/sidebar'),
                    'title' => $title . " ($num_members)",
                    'filter_override' => false,
                    );

$body = elgg_view_layout('one_column', $params);

    
echo elgg_view_page($title, $body);
?>
