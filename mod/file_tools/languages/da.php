<?php

	$danish = array(
		'file_tools' => "Fil Værktøj",
	
		'file_tools:file:actions' => 'Funktioner',
	
		'file_tools:list:sort:type' => 'Type',
		'file_tools:list:sort:time_created' => 'Oprettelses tidspunkt',
		'file_tools:list:sort:asc' => 'Stigende',
		'file_tools:list:sort:desc' => 'Faldende',
	
		// object name
		'item:object:folder' => "Fil Mappe",
	
		// menu items
		'file_tools:menu:mine' => "Dine mapper",
		'file_tools:menu:user' => "%s's mapper",
		'file_tools:menu:group' => "Gruppe fil mapper",
		
		// group tool option
		'file_tools:group_tool_option:structure_management' => "Tillad styring af mapper af medlemmer",
		
		// views
	
		// object
		'file_tools:object:files' => "%s fil(er) i denne mappe",
		'file_tools:object:no_files' => "Ingen filer i denne mappe",
	
		// input - folder select
		'file_tools:input:folder_select:main' => "Hoved mappe",
	
		// list
		'file_tools:list:title' => "Liste fil mapper",
		
		'file_tools:list:folder:main' => "Hoved mappe",
		'file_tools:list:files:none' => "Ingen filer fundet i denne mappe",
		'file_tools:list:select_all' => 'Vælg alle',
		'file_tools:list:deselect_all' => 'Fravælg alle',
		'file_tools:list:download_selected' => 'Download valgte',
		'file_tools:list:delete_selected' => 'Slet valgte',
		'file_tools:list:alert:not_all_deleted' => 'Ikke alle filer kunne slettes',
		'file_tools:list:alert:none_selected' => 'Ingen valgte filer',
		
	
		'file_tools:list:tree:info' => "Vidst du?",
		'file_tools:list:tree:info:1' => "Du kan 'drag and droppe' filer i mapperne for at organisere dem!",
		'file_tools:list:tree:info:2' => "Du dobbeltklikke på enhver mappen for at udvide alle af dens undermapper!",
		'file_tools:list:tree:info:3' => "Du kan sortere mapperne ved at trække dem til deres nye placering i mappestrukturen!",
		'file_tools:list:tree:info:4' => "Du kan flytte hel mappe strukturer!",
		'file_tools:list:tree:info:5' => "Hvis du sletter en mappe, så kan du vælge at slette alle filer der i!",
		'file_tools:list:tree:info:6' => "Når du sletter en mappe, så sletter du også alle underliggende mapper!",
		'file_tools:list:tree:info:7' => "Denne besked er i vilkårlig rækkefølge!",
		'file_tools:list:tree:info:8' => "Når du flytter en mappe, men ikke dens filer, så vil filerne ende i hoved mappen!",
		'file_tools:list:tree:info:9' => "En ny mappen kan blive placeret direkte i den korrekte undermappe!",
		'file_tools:list:tree:info:10' => "Når en fil uploades eller redigeres kan du vælge i hvilken mappe den skal ligge!",
		'file_tools:list:tree:info:11' => "Det er kun muligt at trække filerne i listevisningen, ikke i galleri visningen!",
		'file_tools:list:tree:info:12' => "Du kan redigere adgangsniveauet på alle undermapper og faktisk også på alle filer i mappen!",
	
		'file_tools:list:files:options:sort_title' => 'Sorter',
		'file_tools:list:files:options:view_title' => 'Vis',
	
		'file_tools:usersettings:time' => 'Tidsvisning',
		'file_tools:usersettings:time:description' => 'Skift måden filerne og mapperne bliver vist ',
		'file_tools:usersettings:time:default' => 'Standard tidsvisning',
		'file_tools:usersettings:time:date' => 'Dato',
		'file_tools:usersettings:time:days' => 'Dage siden',
		
		// new/edit
		'file_tools:new:title' => "Ny filmappe",
		'file_tools:edit:title' => "Ændre filmappe",
		'file_tools:forms:edit:title' => "Titel",
		'file_tools:forms:edit:description' => "Beskrivelse",
		'file_tools:forms:edit:parent' => "Vælg ovenliggende mappe",
		'file_tools:forms:edit:change_children_access' => "Opdater adgangsniveau på alle underliggende mapper",
		'file_tools:forms:edit:change_files_access' => "Opdater adgangsniveau på alle filer i denne mappe (og alle markerede undermapper)",
		'file_tools:forms:browse' => 'Søg..',
		'file_tools:forms:empty_queue' => 'Tom kø',
	
		'file_tools:folder:delete:confirm_files' => "Ønsker du at slette alle filer i de underliggende mapper",
	
		// actions
		// edit
		'file_tools:action:edit:error:input' => "Forkert oprettelse/ændring af filmappe",
		'file_tools:action:edit:error:owner' => "Kunne ikke finde ejeren af filmappen",
		'file_tools:action:edit:error:folder' => "Ingen mappe at oprette/ændre",
		'file_tools:action:edit:error:parent_guid' => "Ugyldig overliggende mappe, den overliggende mappe kan ikke være mappen i sig selv",
		'file_tools:action:edit:error:save' => "Ukendt fejl opstod under gemning af filmappen",
		'file_tools:action:edit:success' => "Filmappen er hermed oprettet/ændret",
	
		'file_tools:action:move:parent_error' => "Kan ikke lægge mappen ind i sig selv.",
		
		// delete
		'file_tools:actions:delete:error:input' => "Ugyldigt input til sletning af filmappe",
		'file_tools:actions:delete:error:entity' => "Den givne GUID kunne ikke findes",
		'file_tools:actions:delete:error:subtype' => "Den givne GUID er ikke en filmappe",
		'file_tools:actions:delete:error:delete' => "En ukendt fejl opstod under sletning af filmappen",
		'file_tools:actions:delete:success' => "Filmappen er hermed slettet",
	
		'file_tools:upload:new' => 'Upload zip fil',
		'file_tools:upload:form:choose' => 'Vælg fil',
		'file_tools:upload:form:info' => 'Klik Søg for at uploade (flere) filer',
		'file_tools:upload:form:zip:info' => "Du kan uploade en zip fil. Den vil derefter blive udfoldet og hver fil vil derefter blive importeret. Samt hvis du har mapper i din zip fil, så vil filerne importeret i hver sin respektive mappe. Fil typer der ikke er tilladte bliver sprunget over.",
	
		//errors
		'file_tools:error:pageowner' => 'Fejl i at finde ejeren til siden.',
		'file_tools:error:nofilesextracted' => 'Der var ikke ingen gyldig filtyper.',
		'file_tools:error:cantopenfile' => 'Zip fil kunne ikke blive åbnet (tjek om den valgte fil er en .zip fil).',
		'file_tools:error:nozipfilefound' => 'Uploadet fil er ikke en .zip fil.',
		'file_tools:error:nofilefound' => 'Vælg en fil til upload.',
	
		//messages
		'file_tools:error:fileuploadsuccess' => 'Zip filen er hermed uploadet og udfoldet korrekt.',
		
		// move
		'file_tools:action:move:success:file' => "Filen er hermed flyttet",
		'file_tools:action:move:success:folder' => "Filmappen er hermed flyttet",
		
		// buld delete
		'file_tools:action:bulk_delete:success:files' => "Hermed fjernet %s filer",
		'file_tools:action:bulk_delete:error:files' => "Der opstod en fejl under fjernelse af nogle af filerne",
		'file_tools:action:bulk_delete:success:folders' => "Herned fjernet %s mapperne",
		'file_tools:action:bulk_delete:error:folders' => "Der opstod en fejl under fjernelse af nogle af mapperne",

		// reorder
		'file_tools:action:folder:reorder:success' => "Hermed sorteret filmappe(-rne)",
		
		//settings
		'file_tools:settings:allowed_extensions' => 'Tilladte udvidelser (komma separeret)',
		'file_tools:settings:user_folder_structure' => 'Brug mappe struktur',
		'file_tools:settings:sort:default' => 'Standard mappe sorterings valgmuligheder',
	
		'file:type:application' => 'Application',
		'file:type:text' => 'Tekst',

		// widgets
		// file tree
		'widgets:file_tree:title' => "Mapper",
		'widgets:file_tree:description' => "Vis din filmapper",
		
		'widgets:file_tree:edit:select' => "Vælg hvilke mapper der skal vises",
		'widgets:file_tree:edit:show_content' => "Vælg indholdet af mappe(-rne)",
		'widgets:file_tree:no_folders' => "Ingen mappe konfigureret",
		'widgets:file_tree:no_files' => "Ingen filer konfigureret",
		'widgets:file_tree:more' => "Flere filmapper",
	
		'widget:file:edit:show_only_featured' => 'Vis kun udvalgte filer',
		
		'widget:file_tools:show_file' => 'Udvælg fil (widget)',
		'widget:file_tools:hide_file' => 'Fravælg fil',
	
		'widgets:file_tools:more_files' => 'Flere filer',
		
		// Group files
		'widgets:group_files:description' => "Vis de seneste gruppefiler",
		
		// index_file
		'widgets:index_file:description' => "Vis de seneste filer i dit netværk",
	
	);
	
	add_translation("da", $danish);
	