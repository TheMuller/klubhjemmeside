<?php
/**
$xml->docAuthor('Klubhjemmeside.dk');
$xml->docTitle('Klubhjemmeside.dk');
$xml->docCompany('Klubhjemmeside.dk');
$xml->docManager('Klubhjemmeside.dk');
$sheet->writeString(1,1,' � o � Aa � Ae � o � aa � ae	Row_1 Col_1');
**/
	$fname='MyXls_2012_12_15_A.xls';
	include("excelwriter.inc.php");
	$excel=new ExcelWriter($fname);
	if($excel==false)	
		echo $excel->error;
	$myArr=array("OrderID"," Name","Username","Email","Phone","Type-A","Type-B � o � Aa � Ae � o � aa � ae");
		$excel->writeLine($myArr);
	$myArr=array("92","� o � Aa � Ae � o � aa � ae","kenneth","khm@kemster.com","","2","0");
		$excel->writeLine($myArr);
	$myArr=array("92","� o � Aa � Ae � o � aa � ae","kenneth","khm@kemster.com","","2","0");
		$excel->writeLine($myArr);
	$myArr=array("92","� o � Aa � Ae � o � aa � ae","kenneth","khm@kemster.com","","2","0");
		$excel->writeLine($myArr);
	$excel->close();
		echo "Data write --> $fname OK";
?>
<!--
OrderID 	 Name 	 Username 	 Email 	 Phone	Type A	Type B
"92","Kenneth","kenneth","khm@kemster.com","-","2","0"
-->