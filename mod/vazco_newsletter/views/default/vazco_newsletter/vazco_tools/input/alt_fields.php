<div class='altcontent_wrapper'>
	<?php 
		$fieldArray = $vars['fields'];
		$altId = $fieldArray['altId'];
		$selectedTab = get_input("altfield_{$altId}");
	?>
	<div id="elgg_horizontal_tabbed_nav" class='alternative'>
	    <ul>
	    	<?php 
	    	//display tabs
	    	$i=0;
	    	$firstTab = false;
	    	if (!$selectedTab)
	    		$firstTab = true;
	    	foreach($fieldArray['labels'] as $tab => $fields){
	    		$class = "";
	    		if ($firstTab || $selectedTab == $tab){
	    			if (!$selectedTab){
	    				$selectedTab = $tab;
	    			}
	    			$firstTab = false;
	    			$class=" class='selected'";
	    		}
	        	echo "<li id='{$tab}'{$class}><a href='javascript: selectAltTab{$altId}(\"{$tab}\");' title='{$tab}'>".elgg_echo('vazco_tools:alt:'.$tab)."</a></li>\n";
	        }
	    	?>
	    </ul>
	</div>
	<div class='altcontent'>
		<input type='hidden' value='<?php echo $selectedTab;?>' name='altfield_<?php echo $altId;?>' id='altfield_<?php echo $altId;?>'/>
	<?php 
		$fistTab = true;
		foreach ($fieldArray['labels'] as $tab => $fields){
			$hidden = " class='hidden'";
			if ($fistTab){
				$fistTab = false;
				$hidden = "";
			}

			echo "<div id='{$tab}_altcontent'{$hidden}>";
			foreach ($fields as $currField){
				$content = vazco_tools::generateFieldContent($currField, $counter, "vazco_newsletter/vazco_tools/input");
				echo $content;
			}
			echo "</div>";
		}
	?>
	</div>
	<script language="javascript" type="text/javascript">
	    function selectAltTab<?php echo $altId;?>(selectedTab) {
		    if (!$('#'+selectedTab).hasClass('selected')){
		        <?php
				foreach($fieldArray['labels'] as $tab => $fields){
					echo "if ($('#{$tab}').hasClass('selected')){";
					echo "\$('#{$tab}_altcontent').animate({height: \"toggle\",opacity: \"toggle\"});\n";
					echo "}";
					echo "\$('#{$tab}').removeClass('selected');\n";
		        }
		        ?>
				$('#'+selectedTab+'_altcontent').animate({height: "toggle",opacity: "toggle"});
				$('#'+selectedTab).addClass('selected');
				
				$('#altfield_<?php echo $altId?>').val(selectedTab);
		    }
	    }
	</script>
</div>