<?php
/**
 * Map navigation
 *
 * @package MembersMap
 */

if (elgg_is_logged_in()) {
    $tabs = array(
            'newest' => array(
                    'title' => elgg_echo('membersmap:label:all'),
                    'url' => "membersmap/all",
                    'selected' => $vars['selected'] == 'all',
            ),
            'online' => array(
                    'title' => elgg_echo('membersmap:label:online'),
                    'url' => "membersmap/online",
                    'selected' => $vars['selected'] == 'online',
            ),
            'friends' => array(
                    'title' => elgg_echo('membersmap:label:friends'),
                    'url' => "membersmap/friends",
                    'selected' => $vars['selected'] == 'friends',
            ),    
    );

    echo elgg_view('navigation/tabs', array('tabs' => $tabs));
}
