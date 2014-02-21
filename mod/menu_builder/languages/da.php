<?php

	$danish = array(
	
		/**
		 * Menu items and titles
		 */
	
		'menu_builder' => "Menu Panel",
		'LOGGED_OUT' => "Besøgende",
		
		// item
		'item:object:menu_builder_menu_item' => "Menu Panel punkt",
	
		// views
		// edit
		'menu_builder:edit_mode:off' => "Vis status",
		'menu_builder:edit_mode:on' => "Ændre status",
		'menu_builder:edit_mode:add' => "Klik her for at tilføje et nyt menu punkt",
	
		'menu_builder:toggle_context' => "Skift til de enkelte menuvisninger",
		'menu_builder:toggle_context:normal_user' => "Viser menuen som ikke-admin bruger",
		'menu_builder:toggle_context:logged_out' => "Viser menuen for besøgende",
		'menu_builder:toggle_context:all' => "Viser alle menu punkter",
		'menu_builder:toggle_context:default' => "Viser menuen som admin",
				
		// add
		'menu_builder:add:title' => "Tilføj nyt menu punkt",
		'menu_builder:add:form:title' => "Titel",
		'menu_builder:add:form:url' => "URL",
		'menu_builder:add:form:parent' => "Overliggende menu punkt",
		'menu_builder:add:form:parent:toplevel' => "Topniveau menu punkt",
		'menu_builder:add:form:access' => "Hvem skal kunne se menu punktet?",
		'menu_builder:add:access:admin_only' => "Kun admins",
	
		// actions
		'menu_builder:actions:edit:error:input' => "Forkert input til oprettelse/ændring af menu punkt",
		'menu_builder:actions:edit:error:entity' => "Den givne GUID kunne ikke findes",
		'menu_builder:actions:edit:error:subtype' => "Den givne GUID er ikke et menu punkt",
		'menu_builder:actions:edit:error:create' => "Fejl: Der opstod en fejl under oprettelsen af menu punktet, prøv venligst igen",
		'menu_builder:actions:edit:error:parent' => "Du kan ikke flytte menupunktet, fordi det har underliggende menupunkter. Fjern venligst dem først.",
		'menu_builder:actions:edit:error:save' => "Fejl: En ukendt fejl er opstået, prøv venligst igen",
		'menu_builder:actions:edit:success' => "Menupunktet er hermed oprettet/ændret",
	
		'menu_builder:actions:delete:success' => "Menupunktet er hermed slettet",
		
	);
					
	add_translation("da",$danish);
