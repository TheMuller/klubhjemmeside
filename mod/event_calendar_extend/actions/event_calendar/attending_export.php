<?php
elgg_load_library('elgg:event_calendar');
$event_guid=get_input('event_guid');
$event=get_entity($event_guid);
////////////////////////////////////////////////////////////////////////////////////////////////////
if($event_guid)
	{
		$orders=event_calendar_get_accepted_orders($event_guid,999999,0,false);
		function cleanData(&$str)
			{
				$str=preg_replace("/\t/"."\\t".$str);
				$str=preg_replace("/\r?\n/"."\\n".$str);
				if(strstr($str.'"'))
					$str='"' . str_replace('"'.'""'.$str) . '"';
			}
		////////////////////////////////////////////////////////////////////////////////////////////////////
		$site_url=elgg_get_site_url();
		$data_url=$CONFIG->dataroot;
		//	C:/xampp/htdocs/_atensci.us_kenneth/
		//		mod/event_calendar_extend/
		//		vendors/excelwriter.inc.php
////////////////////////////////////////////////////////////////////////////////////////////////////
$LibrFil='excelwriter.inc.php';
include($LibrFil);
		global $CONFIG;
			$xlsf_url=$CONFIG->dataroot;
			$xlsf_fil='EXPORT_XLS_EVENT_LIST_'.$event_guid.".XLS";
			$xlsf_out=$xlsf_url.$xlsf_fil;
			if(file_exists($xlsf_fil))
				unlink($xlsf_fil);
////////////////////////////////////////////////////////////////////////////////////////////////////
$ExcelFileOut=new ExcelWriter($xlsf_out);
if($ExcelFileOut==false)
	echo $ExcelFileOut->error;
////////////////////////////////////////////////////////////////////////////////////////////////////
		//header("Content-Disposition: attachment; filename=\"$xlsf_fil\"");
		//header('Content-Encoding: UTF-8');
		//header("Content-Type: application/vnd.ms-excel charset=UTF-8; encoding=UTF-8");
		//	utf8 bom
		//$XLS_File.="\xEF\xBB\xBF";
		//echo "\xEF\xBB\xBF";
		//file_put_contents($xlsf_out,"\xEF\xBB\xBF");
		//$BOM=chr(255).chr(254).mb_convert_encoding($tmp,'UTF-16LE','UTF-8');
		//file_put_contents($xlsf_out,$BOM);
		////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
		$flag_Header=false;
		$topX='';
		$iSpots=0;
		$XLS_File='';
		foreach($orders as $row)
			{
				$iSpots++;
				if(!$flag_Header)
					{
						$HddrTxt=array("OrderID","Name","UserName","Email","Phone");
						for($iSpots=1; $iSpots <=5; $iSpots++)
						{
							$ticket_type_var="ticket_option_type_" . $iSpots;
							$HddrTxt[]=
								$event->$ticket_type_var
									? utf8_decode($event->$ticket_type_var)
						//			? $event->$ticket_type_var
						//			? mb_convert_encoding($event->$ticket_type_var,'UTF-16LE','UTF-8')
									: ''
							;
						}	
						$ExcelFileOut->writeLine($HddrTxt);
						$flag_Header=true;
					}//if(!$flag_Header)
				$user=get_entity($row->getOwnerGuid());
				$phoneno=$user->phone_number ? $user->phone_number : '-';
				//
				unset($DataTxt);
					$DataTxt[]=$row->guid;
					$DataTxt[]=$user->name;
					$DataTxt[]=$user->username;
					$DataTxt[]=$user->email;
					$DataTxt[]=$phoneno;
				//
				for($iSpots=1; $iSpots <=5; $iSpots++)
					{
						$ticket_spots_var="ticket_spots_".$iSpots;
						$DataTxt[]=$row->$ticket_spots_var
									? $row->$ticket_spots_var
									: ''
						;
					}//for($iSpots=1; $iSpots <=5; $iSpots++)
				$ExcelFileOut->writeLine($DataTxt);
			}//foreach($orders as $row)
			////////////////////////////////////////////////////////////////////////////////////////////////////
			$ExcelFileOut->close();
			header("Content-Disposition: attachment; filename=\"$xlsf_fil\"");
			header('Content-Encoding: UTF-8');
			//header("Content-Type: text/csv; charset=UTF-16LE");
			//header("Content-Type: text/csv; charset=iso-8859-1");
			header("Content-Type: application/vnd.ms-excel charset=UTF-8; encoding=UTF-8");
			echo file_get_contents($xlsf_out);
		////////////////////////////////////////////////////////////////////////////////////////////////////
		exit;
		////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////



?>