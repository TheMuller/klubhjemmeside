<?php
/**
 * Page edit form body
 *
 * @package ElggPages
 */

$variables = elgg_get_config('info_pages');
foreach ($variables as $name => $type) {
?>
<div>
	<label><?php echo elgg_echo("info_pages:$name") ?></label>
	<?php
		if ($type != 'longtext') {
			echo '<br />';
		}
	?>
	<?php 
	if($type != 'checkbox'){
		echo elgg_view("input/$type", array(
				'name' => $name,
				'value' => $vars[$name],
			));
	} else {
		echo elgg_view("input/$type", array(
				'name' => $name,
				'checked' => $vars[$name] == 'on' ? true : false,
			));
	}
	?>
</div>
<?php
}
    
    $options = array(
                     'types' => 'object',
                     'subtypes' => 'info_page',
                     'full_view' => false,
                     );
	$group = elgg_get_page_owner_entity();
    
	if($group instanceof ELGGGroup){
        $options['container_guid']=$group->guid;
    }
    
	$a[0] = elgg_echo('info_pages:noparent');
	
	$pages = elgg_get_entities_from_metadata($options);
	
	foreach($pages as $page){
		//try to group the levels
		if(!($group instanceof ELGGGroup)){
            $entity = get_entity($page->container_guid);
            if($entity instanceof ELGGGroup)continue;
        }
			if(!isset($a[$page->guid])){
				if($page->parent_guid){
					$parent = get_entity($page->parent_guid);
					if(!$parent->parent_guid && $page->guid != $vars['guid']){
						
					$a[$parent->guid] = '-' . $parent->title;
					$a[$page->guid] = '--'. $page->title;
					}
				} else {
					$a[$page->guid] = '-' . $page->title;
				}
			}
	
	}
	
	
		

	//give option to change the parent
	echo elgg_view('input/dropdown', array(
		'name' => 'parent_guid',
		'value' => $vars['parent_guid'],
		'options_values' => $a,
	));

echo '<div class="elgg-foot">';
if ($vars['guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'page_guid',
		'value' => $vars['guid'],
	));
}
echo elgg_view('input/hidden', array(
	'name' => 'container_guid',
	'value' => $vars['container_guid'],
));


echo elgg_view('input/submit', array('value' => elgg_echo('save')));

echo '</div>';
