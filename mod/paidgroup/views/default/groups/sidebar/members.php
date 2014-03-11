<?php
/**
 * Group members sidebar
 *
 * @package ElggGroups
 *
 * @uses $vars['entity'] Group entity
 * @uses $vars['limit']  The number of members to display
 */

$limit = elgg_extract('limit', $vars, 14);
$group = $vars['entity'];
$all_link = elgg_view('output/url', array(
	'href' => 'groups/members/' . $group->guid,
	'text' => elgg_echo('groups:members:more'),
	'is_trusted' => true,
));
 $options =    array(
          'relationship' => 'member',
          'relationship_guid' => $group->guid,
          'inverse_relationship' => true,
          'type' => 'user',
          'limit' => $limit,
          'list_type' => 'gallery',
          'gallery_class' => 'elgg-gallery-users',
          'pagination' => false
                     );
$users = elgg_get_entities_from_relationship($options);

foreach($users as $user){
    if($group->owner_guid == $user->guid){
        $users2[]=$user;
        continue;
    }
    
    $last_dates = unserialize($user->last_dates);
    
    $last_date = $last_dates[$group->guid];
    if(!$last_date or $last_date ==''){
        continue;
    }
    $users2[]=$user;
}
$body =  elgg_view_entity_list($users2,$options);
$body .= "<div class='center mts'>$all_link</div>";
echo elgg_view_module('aside', elgg_echo('groups:members'), $body);
