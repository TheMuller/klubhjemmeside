<?php
/**
 * INFO Pages languages
 *
 * @package Info Pages
 */

$danish = array(

	/**
	 * Menu items and titles
	 */

	'info_pages' => "Infosider",
	'info_pages:more' => "mere..",
	'info_pages:add' => "Tilføj side",

	'info_pages:edit' => "Ændre indholdet til infosidernes forside",
	'info_pages:delete' => "Slet denne side",

	
	/**
	 * Form fields
	 */

	'info_pages:title' => 'Info side overskrift',
	'info_pages:description' => 'Info side beskrivelse',
	'info_pages:tags' => 'Tags',
	'info_pages:menu_show' => 'Vis i menu',
	'info_pages:access_id' => 'Hvem skal kunne se informationen?',
	
	'info_pages:metadescription' => 'Meta beskrivelse',
	'info_pages:metakeywords' => 'Meta nøgleord',
	'info_pages:path' => 'Stien i browseren - ' . elgg_get_site_url() . 'ip/',

	/**
	 * Status and error messages
	 */
	'info_pages:noaccess' => 'Du har ikke adgang til infosiden',
	'info_pages:cantedit' => 'Du kan ikke ændre denne infoside',
	'info_pages:saved' => 'Siden er hermed gemt',
	'info_pages:notsaved' => 'Siden kunne desværre ikke gemmes. Prøv venligst igen senere.',
	'info_pages:error:no_title' => 'Du skal vælge en overskrift til infosiden.',
	'info_pages:delete:success' => 'Siden er hermed slettet.',
	'info_pages:delete:failure' => 'Siden kunne desværre ikke slettes. Prøv venligst igen senere..',
	'info_pages:delete:failure:subpages' => 'Kunne ikke slette infosiden, fordi det er en underside. Hvis du ønsker at slette den, så skal du flytte undersiden til et andet sted i menuen.',
	
	/**
	 * Sidebar items
	 */
	'info_pages:sidebar:this' => "Denne infoside",
	'info_pages:sidebar:children' => "Undersider",
	'info_pages:sidebar:parent' => "Overliggende side",

	'info_pages:newchild' => "Opret en underside",
	'info_pages:create_page' => "Opret side",
	'info_pages:backtoparent' => "Tilbage til '%s'",
	
	/**
	 * Order of pages
	 */
	'info_pages:order:up' => "Flyt op",
	'info_pages:order:down' => "flyt ned",
);

add_translation("da", $danish);