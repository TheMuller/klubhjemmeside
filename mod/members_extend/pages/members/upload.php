<?php
global $CONFIG;
$site = elgg_get_site_entity();
set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');
include elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';

if(empty($_FILES['upload']))
{
    $file .= "Select XL File with format ->  (username,groupid1,groupid2,groupid3.... [First Row For Header])";
    $file .= elgg_view('input/file', array('name' => "upload", 'is_trusted' => true    ));
        
    $file .= elgg_view('input/submit', array('value' => 'Upload Now' ));
    $content = elgg_view('input/form', array(
                                           'bgcolor' => "red",
                                           'body' => $file,
                                           'enctype' => 'multipart/form-data',
                                           'action' => 'members/upload'
                                           ));
    $title = "Upload XL";
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
$suggestedgroupids = unserialize($site->suggestedgroupids);
	foreach ($sheetData as $data)
	{

		$user = get_user_by_username($data[A]);
		unset($sugested_groupids);
		for($i='B';$i<='Z';$i++)
		{

			if($data[$i]!='')
			{
				$group= get_entity($data[$i]);
				if ($group instanceof ElggGroup)
					$sugested_groupids[] = $data[$i];
				else
					$wrong_group[] = $data[$i];
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
			$sitesuggestedgroupids[$data[A]] = $sugested_groupids;
		}
	
	}
	$site->suggestedgroupids = serialize($sitesuggestedgroupids);
	
	$content .="Success...";
	if(count($wrong_group))
	{
	$content .= "<br><hr width='35%' align='left'><font style='padding-left:5%'>Following Group Id's Does Not Exists</font><hr width='35%' align='left'>";
	}
	foreach($wrong_group as $wrong_groups){
		$content .= $wrong_groups."<br>";
	}
	if(count($sitesuggestedgroupids))
	{
	$content .= "<hr width='80%' align='left'><font style='padding-left:5%'>Following User's Does Not Exists (When they will Ragistered in future We will Show their Suggested Group's)<font><hr width='80%' align='left'>";
	}
	foreach($sitesuggestedgroupids as $key=>$sitesuggestedgroupid){
		$content .= $key."<br>";
	}

}

$params = array(
                    'content' => elgg_view('members/nav', array('selected' => $vars['page'])).$content,
                    'sidebar' => elgg_view('members/sidebar'),
                    'title' => $title ,
                    'filter_override' => false,
                    );

$body = elgg_view_layout('one_column', $params);

echo elgg_view_page($title, $body);
?>
