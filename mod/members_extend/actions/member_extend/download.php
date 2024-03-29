<?php
//system_message("hello...");
$users=elgg_get_entities(array('types'=>'user','limit'=>0)); //issue 50

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
$sheet = $objPHPExcel->getActiveSheet();
$sheet->SetCellValue('A1', 'Username');
$sheet->SetCellValue('B1', 'Name');
$sheet->SetCellValue('C1', 'E-mail');
$sheet->SetCellValue('D1', 'Join Date');
$sheet->SetCellValue('E1', $headers);

$i = 1;
foreach ($users as $user)
{
	$i++;
	$objPHPExcel->setActiveSheetIndex(0);
	$sheet->SetCellValue('A'.$i, $user->username);
	$sheet->getColumnDimension('A')->setAutoSize(true);
	$sheet->SetCellValue('B'.$i, $user->name);
	$sheet->getColumnDimension('B')->setAutoSize(true);
	$sheet->SetCellValue('C'.$i, $user->email);
	$sheet->getColumnDimension('C')->setAutoSize(true);
	$sheet->SetCellValue('D'.$i, date('d M Y', $user->time_created));
	$sheet->getColumnDimension('D')->setAutoSize(true);
	$sugested_groupids = unserialize($user->suggestedgroupids);
	$j='E';
	
	foreach($sugested_groupids as $suggested_groupid)
	{
		$sheet->SetCellValue($j.$i,$suggested_groupid);
		$sheet->getColumnDimension($j)->setAutoSize(true);
		$j++;
	}
}


$sheet->getColumnDimension("A")->setAutoSize(true);
$sheet->setTitle('Sample');



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

$file_path = $xlsf_url."/member_download.xlsx";
 $objWriter->save($file_path);


header("Content-Disposition: attachment; filename=\"Sample.xlsx\"");
			header('Content-Encoding: UTF-8');
			//header("Content-Type: text/csv; charset=UTF-16LE");
			//header("Content-Type: text/csv; charset=iso-8859-1");
			header("Content-Type: application/vnd.ms-excel charset=UTF-8; encoding=UTF-8");
			echo file_get_contents($xlsf_url."/member_download.xlsx");

		exit;

?>