<?php
/**
 * INFO Pages languages
 *
 * @package Info Pages
 */

$english = array(

	/**
	 * Menu items and titles
	 */

	'info_pages' => "Info Pages",
	'info_pages:more' => "more..",
	'info_pages:add' => "Add page",

	'info_pages:edit' => "Edit this page",
	'info_pages:delete' => "Delete this page",

	
	/**
	 * Form fields
	 */

	'info_pages:title' => 'Info Page title',
	'info_pages:description' => 'Info Page text',
	'info_pages:tags' => 'Tags',
	'info_pages:menu_show' => 'Show in menu',
	'info_pages:access_id' => 'Access',
	
	'info_pages:metadescription' => 'Meta description',
	'info_pages:metakeywords' => 'Meta keywords',
	'info_pages:path' => 'Browser path - ' . elgg_get_site_url() . 'ip/',

	/**
	 * Status and error messages
	 */
	'info_pages:noaccess' => 'No access to page',
	'info_pages:cantedit' => 'You cannot edit this page',
	'info_pages:saved' => 'Page saved',
	'info_pages:notsaved' => 'Page could not be saved',
	'info_pages:error:no_title' => 'You must specify a title for this page.',
	'info_pages:delete:success' => 'The page was successfully deleted.',
	'info_pages:delete:failure' => 'The page could not be deleted.',
	'info_pages:delete:failure:subpages' => 'Cannot delete the item, because of subpages. If you want to delete, you have to move the subpages to another place in the menu.',
	
	/**
	 * Sidebar items
	 */
	'info_pages:sidebar:this' => "This page",
	'info_pages:sidebar:children' => "Sub-pages",
	'info_pages:sidebar:parent' => "Parent",

	'info_pages:newchild' => "Create a sub-page",
	'info_pages:backtoparent' => "Back to '%s'",
	
	/**
	 * Order of pages
	 */
	'info_pages:order:up' => "Move up",
	'info_pages:order:down' => "Move down",
	'info_pages:noparent' => 'No Parent',
);

add_translation("en", $english);