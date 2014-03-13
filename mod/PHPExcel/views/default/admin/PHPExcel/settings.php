
<?php
    $step = get_input('step','1');
    
    if($step =='1'){
        echo "<form action='".elgg_get_site_url()."admin/PHPExcel/settings?step=2' method='post' enctype='multipart/form-data'>";
        echo "<input type='file' name='upload'><br>";
        $groups = elgg_get_entities(array('type'=>'group',));
        
        foreach($groups as $group){
            $grouparr[$group->guid]=$group->name;
        }
        echo elgg_view('input/dropdown',
                       array(
                             'name' => 'group_guid',
                             'options_values' => $grouparr,
                             
                             )
                       );
        
        echo "<br><input type='submit' value='submit'>";
        echo "</form>";
        
        
        
    }elseif($step =='3'){
        echo "sucesss...";
    }
    else{
        $group_guid =  get_input('group_guid','');
        //echo $group_guid;
        $group = get_entity($group_guid);
        //$user_guid= elgg_get_logged_in_user_entity();
        echo $user_guid;
        set_include_path(elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/');
        //echo elgg_get_plugins_path() . 'members_extend/vendors/PHPExcleReader/index.php';
        include elgg_get_plugins_path() . 'PHPExcel/vendors/PHPExcleReader/Classes/PHPExcel/IOFactory.php';
        
        if($_FILES['upload']['error']>0)
        {
            register_error('Error');
        }
        else
        {
            //echo "else";
            $info = pathinfo($_FILES['upload']['name']);
            //var_dump($info)."/";
            $ext = $info['extension'];
            //echo $ext;
            $newName = "projectTest".".".$ext;
            //echo "<br>";
            //echo $newName;
            global $CONFIG;
            $target =$CONFIG->dataroot.$newName;
            //echo $target;
            move_uploaded_file( $_FILES['upload']['tmp_name'], $target);
            
            $inputFileName = './'.$newName;  // File to read
            
            try {
                $objPHPExcel = PHPExcel_IOFactory::load($target);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($target,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
            
            
            //echo '<hr />';
            
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            //echo "afetr..";
            //print_r($sheetData);
            
            foreach ($sheetData as $data)
            {
                
                $user = get_user_by_username($data[A]);
                //echo $user->username;
                
                if ($user instanceof ElggUser)
                {
                    //echo "User Exist...";
                    
                    if(is_group_member($group_guid,$user->guid)){
                        
                        //echo "yes";
                        
                    }
                    else
                    {
                        //echo "<td>";
                        //echo "no";
                        //echo "</td>";
                        
                        echo elgg_view_entity($user);
                        join_group($group_guid,$user->guid);
                    }
                }
                else
                {
                    
                    
                    $not_users[]=$data[A];
                }
                
                
            }
            
            
            /*require_once '$base/excel_reader2.php';
             $data = new Spreadsheet_Excel_Reader($newName);
             
             echo $data->dump(true,true);
             
             echo file_get_contents($target.$newname); */
            
            
        }
        
        echo elgg_view("output/url",
                       array('href' => elgg_get_site_url().'admin/PHPExcel/settings?step=3','text' => elgg_echo('submit'),
                             'class' => 'elgg-button elgg-button-delete',));
        echo "<hr>";
        foreach ($not_users as $not_user)
        {
            echo $not_user;
            echo "<br>";
        }
        
    }
    ?>
