
<?php
	//global $_SESSION;
	$group_guid =  get_input('group_guid','');
    $step = get_input('step','1');
    
    if($step =='1'){
        echo "<form action='".elgg_get_site_url()."admin/users/addtogroup?step=2' method='post' enctype='multipart/form-data'>";
        echo "<input type='file' name='upload'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "Choose group: ";
        $groups = elgg_get_entities(array('type'=>'group','limit'=>0));//issue 42
        
        foreach($groups as $group){
            $grouparr[$group->guid]=$group->name;
        }
        echo elgg_view('input/dropdown',
                       array(
                             'name' => 'group_guid',
                             'options_values' => $grouparr,
                             
                             )
                       );
        
        echo "<br><br><input type='submit' value='submit'>";
        echo "</form>";
        
        $durl = elgg_get_site_url()."mod/PHPExcel/Sample_File.xlsx";
	$here = "<strong><font color='blue'>Here</font></strong>";
	echo "<hr><br>Download Sample File ";
	echo elgg_view("output/url", 
	array("text" => elgg_echo($here."..."), "href" => "$durl",));
	
        
    }elseif($step =='3'){
		echo "<hr width='50%' align='left'>Following Persons succesfully joined the group ";
		$groups = elgg_get_entities(array('type'=>'group',));
			foreach($groups as $group)
			{
				$grouparr[$group->guid]=$group->name;
				if($group->guid == $group_guid)
				echo  "<b>".$group->name."</b>";
			}
			echo " ...<hr width='50%' align='left'>";
        foreach($_SESSION['not_member'] as $Data)
		{
			$user = get_user_by_username($Data);
			if(join_group($group_guid,$user->guid)){
				$sugested_groupids = unserialize($user->suggestedgroupids);
				if(!in_array($group_guid,$sugested_groupids))
				{
					$sugested_groupids[]=floatval($group_guid);
				}
				$user->suggestedgroupids = serialize($sugested_groupids);
				/* $group = get_entity($group_guid);
				if ($group->group_paid_flag == 'yes')	//:DC:
				{
					$last_dates = unserialize($user->last_dates);
					if($group->group_period_type =='duration'){
						$cmd= "+".$group->group_paid_LockedPeriod." month";
						$last_dates[$group_guid] = date('Y-m-d H:i',strtotime($cmd,strtotime($last_dates[$group_guid])));
					}else{
						$last_dates[$group_guid] = $group->group_paid_MembershipEnd;
						}
					$user->last_dates = serialize($last_dates);
				} */
				$user->save();
			}			
			//echo $Data;
			echo "<b>".$Data."</b><br>";
		}
	}
    else{

        $group = get_entity($group_guid);
        set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');
        include elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';
        if($_FILES['upload']['error']>0)
        {
            register_error('Error');
        }
        else
        {
			unset($_SESSION['not_member']);
            $info = pathinfo($_FILES['upload']['name']);
            $ext = $info['extension'];
            $newName = "Add_to_Group".".".$ext;
            global $CONFIG;
            $target =$CONFIG->dataroot.$newName;
            move_uploaded_file( $_FILES['upload']['tmp_name'], $target);
            
            $inputFileName = './'.$newName;  // File to read
            try 
			{
                $objPHPExcel = PHPExcel_IOFactory::load($target);
            }
			catch(Exception $e) 
			{
                die('Error loading file "'.pathinfo($target,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
			$objPHPExcel->getActiveSheet()->removeRow(1,1);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheetData as $data)
            {
				$user = get_user_by_username($data[A]);	
                if ($user instanceof ElggUser)
                {
                    if(is_group_member($group_guid,$user->guid))
					{
                        //echo "yes";
                    }
                    else
                    {
                        echo elgg_view_entity($user);
                        $_SESSION['not_member'][]=$data[A];
					}
                }
                else
                {                   
                    $not_users[]=$data[A];
                }   
            }
        }
		if(count($_SESSION['not_member']))
        echo elgg_view("output/url",
                       array('href' => elgg_get_site_url().'admin/users/addtogroup?step=3&group_guid='.$group_guid,'text' => elgg_echo('submit'),
                             'class' => 'elgg-button elgg-button-delete',));
		
		if(count($not_users))
		{
        echo "<hr width='40%' align='left'>";
		echo "<p style='padding-left:1cm'><b>Following User's Are Not Member Of This Site</b></p>";echo "<hr width='40%' align='left'>";
		}
        foreach ($not_users as $not_user)
        {	
            echo $not_user;
            echo "<br>";
        }
    }
?>
