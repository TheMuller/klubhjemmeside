<?php
//system_message("hello...");
$users=elgg_get_entities(array('types'=>'user'));

global $CONFIG;
			$xlsf_url=$CONFIG->dataroot;
//	system_message($xlsf_url);		

set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/Writer/');
set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');


	
////////////////////////////////////////////////////////////////////////////////////////////////////
include 'PHPExcel.php';
include elgg_get_plugins_path().'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';
/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

$headers = "Suggested Group's";
$objPHPExcel = new PHPExcel();

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Username');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', $headers);
//$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'E-mail');
$i = 1;
foreach ($users as $user)
{

	
	$i++;
	$objPHPExcel->setActiveSheetIndex(0);
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $user->username);
	//$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $sugested_groupids);
	//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $user->email);
	
	$sugested_groupids = unserialize($user->suggestedgroupids);
	$j='B';
	
	foreach($sugested_groupids as $suggested_groupid)
	{
		$objPHPExcel->getActiveSheet()->SetCellValue($j.$i,$suggested_groupid);
		$j++;
	}
}

$sheet = $objPHPExcel->getActiveSheet();
$sheet->getColumnDimension("A")->setAutoSize(true);
$sheet->getColumnDimension("B")->setAutoSize(true);
$sheet->getColumnDimension("C")->setAutoSize(true);
$sheet->getStyle("A1:B1")->applyFromArray(array("font" => array( "bold" => true)));
$objPHPExcel->getActiveSheet()->setTitle('Simple111');



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

$file_path = $xlsf_url."/xyz.xlsx";
 $objWriter->save($file_path);


header("Content-Disposition: attachment; filename=\"Sample.xlsx\"");
			header('Content-Encoding: UTF-8');
			//header("Content-Type: text/csv; charset=UTF-16LE");
			//header("Content-Type: text/csv; charset=iso-8859-1");
			header("Content-Type: application/vnd.ms-excel charset=UTF-8; encoding=UTF-8");
			echo file_get_contents($xlsf_url."/xyz.xlsx");

		exit;

?>