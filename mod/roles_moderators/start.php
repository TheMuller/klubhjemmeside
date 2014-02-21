<?php

/**
 * 
 * Moderators for Roles plugin
 * 
 *
 * @author Andras Szepeshazi
 * @copyright Arck Interactive, LLC 2012
 * @link http://www.arckinteractive.com/
 */

elgg_register_event_handler('init', 'system', 'roles_moderators_init');

function roles_moderators_init() {

	elgg_register_plugin_hook_handler('roles:config', 'role', 'roles_moderators_config', 700);
}


function roles_moderators_config($hook_name, $entity_type, $return_value, $params) {

	$roles = array(

		'moderator' => array(
			
			'title' => 'roles_moderators:role:title',
			
			'extends' => array(ADMIN_ROLE),

			'permissions' => array(
				
				'pages' => array(
					'regexp(/^admin\/((?!administer_utilities\/reportedcontent).)*$/)' => array('rule' => 'deny')
				),
				
				'menus' => array(

					'topbar::administration' => array('rule' => 'deny'),
					
					'site' => array(
						'rule' => 'extend',
						'menu_item' => array(
							'name' => 'reported_content',
							'text' => 'Reported Content',
							'href' => 'admin/administer_utilities/reportedcontent'
						)
					)
				),

				'actions' => array(
					'regexp(/^admin\/((?!user\/ban|user\/unban).)*$/)' => array('rule' => 'deny')
				),

				'views' => array(
					
					'admin/sidebar' => array('rule' => 'deny'),
					
					'roles/settings/account/role' => array(
						'rule' => 'replace',
						'view_replacement' => array(
					 		'location' => 'mod/roles_moderators/views/override/',
	 					),
					),
				)
			)
		)
	);

	if (!is_array($return_value)) {
		return $roles;
	} else {
		return array_merge($return_value, $roles);
	}
}

?>