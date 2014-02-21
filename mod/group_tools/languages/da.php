<?php

	$danish = array(
	
		// general
		'group_tools:decline' => "Afvis",
		'group_tools:revoke' => "Aktiver",
		'group_tools:add_users' => "Tilføj brugere",
		'group_tools:in' => "ind",
		'group_tools:remove' => "Fjern",
		'group_tools:clear_selection' => "Fjern tilvalgte",
		'group_tools:all_members' => "Alle medlemmer",
		'group_tools:explain' => "Forklaring",
		
		'group_tools:default:access:group' => "Kun for gruppemedlemmer",
			
		'group_tools:joinrequest:already' => "Aktiver medlems anmodning",
		'group_tools:joinrequest:already:tooltip' => "Du har allerede anmodet om at blive en del af denne gruppe, klik her for at gensende denne anmodning",
		
		// menu
		'group_tools:menu:mail' => "Mail medlemmer",
		'group_tools:menu:invitations' => "Styr invitationer",
		
		// plugin settings
		'group_tools:settings:invite:title' => "Indstillinger gruppe invitation",
		'group_tools:settings:management:title' => "Generelle gruppe indstillinger",
		'group_tools:settings:default_access:title' => "Standard gruppe adgang",
	
		'group_tools:settings:admin_create' => "Begræns oprettelsen af grupper til administratorer",
		'group_tools:settings:admin_create:description' => "Det vil ikke være muligt for en almindelig bruger at oprette grupper ved at sætte den til 'Ja'.",
		
		'group_tools:settings:admin_transfer' => "Tillad overførsel af gruppe ejer",
		'group_tools:settings:admin_transfer:admin' => "Kun administror",
		'group_tools:settings:admin_transfer:owner' => "Gruppe ejere og administratorer",
		
		'group_tools:settings:multiple_admin' => "Tillad flere gruppe administratorer",
		
		'group_tools:settings:invite' => "Tillad invitation af alle medlemmer (ikke kun venner)",
		'group_tools:settings:invite_email' => "Tillad invitation af alle brugere ved email adresse",
		'group_tools:settings:invite_csv' => "Tillad invitation af alle brugere ved CSV-fil",
	
		'group_tools:settings:mail' => "Tillad gruppe mail (giv gruppe administrator tilladelse til at sende en mail til alle gruppemedlemmer)",
		
		'group_tools:settings:listing' => "Standard fane til gruppe lister",
		
		'group_tools:settings:default_access' => "Hvad burde være standard adgangen til indholdet i grupperne for denne side",
		'group_tools:settings:default_access:disclaimer' => "<b>DISCLAIMER:</b> dette virker ikke, medmindre du har <a href='https://github.com/Elgg/Elgg/pull/253' target='_blank'>https://github.com/Elgg/Elgg/pull/253</a> tildelt din Elgg installation.",
				
		'group_tools:settings:search_index' => "Tillad indeksering af lukkede gruppe for søgemaskiner",
		'group_tools:settings:auto_notification' => "Automatisk aktivering af gruppe notifikation ved gruppe tilmelding",
		'group_tools:settings:auto_join' => "Automatisk gruppe tilmelding",
		'group_tools:settings:auto_join:description' => "Nye brugere bliver automatisk tilmeldt følgende grupper",
		
		// group invite message
		'group_tools:groups:invite:body' => "Hej %s,

%s har inviteret dig til at tilmelde dig gruppen: '%s'.
%s

Klik på nedenstående link for at se dine invitationer:
%s",
	
		// group add message
		'group_tools:groups:invite:add:subject' => "Du er blevet tilmeldt gruppen %s",
		'group_tools:groups:invite:add:body' => "Hej %s,
	
%s har tilmeldt dig gruppen %s.
%s

For at se gruppen kan du klikke på linket
%s",
		// group invite by email
		'group_tools:groups:invite:email:subject' => "Du er blevet inviteret til gruppen %s",
		'group_tools:groups:invite:email:body' => "Hej,

%s har inviteret dig til at tilmelde dig gruppen: %s på %s.
%s

Hvis du ikke har en konto på %s kan du registrere dig her
%s

Hvis du allerede har en konto eller efter din registrering, kan du klikke på følgende link for at acceptere invitationen
%s

Du kan også gå til menuknappen 'Grupper' og derefter vælge menuknappen 'Gruppe invitationer' og skrive følgende kode:
%s",
		// group transfer notification
		'group_tools:notify:transfer:subject' => "Administrationen af gruppen %s er nu tildelt dig",
		'group_tools:notify:transfer:message' => "Hej %s,
		
%s har tildelt dig ansvaret som ny administrator for gruppen %s.

Klik på nedenstående link for at se gruppen:
%s",
		
		// group edit tabbed
		'group_tools:group:edit:profile' => "Gruppe profil / værktøjer",
		'group_tools:group:edit:other' => "Andre funktioner",

		// admin transfer - form
		'group_tools:admin_transfer:title' => "Overfør ejerskabet af denne gruppe",
		'group_tools:admin_transfer:transfer' => "Overfør gruppe ejerskabet til",
		'group_tools:admin_transfer:myself' => "Mig selv",
		'group_tools:admin_transfer:submit' => "Øverfør",
		'group_tools:admin_transfer:no_users' => "Ingen medlemmer eller venner du kan overføre til.",
		'group_tools:admin_transfer:confirm' => "Er du sikker på, at du vil øverføre ejerskabet? - Kan ikke fortrydes",
		
		// auto join form
		'group_tools:auto_join:title' => "Auto tilmelding funktioner",
		'group_tools:auto_join:add' => "%sTilføj denne gruppe%s til auto tilmelding grupper. Dette betyder, at nye brugere automatisk bliver tilmeldt denne gruppe ved registrering.",
		'group_tools:auto_join:remove' => "%sFjern denne gruppe%s fra auto tilmelding grupper. Dette betyder, at nye brugere ikke længere automatisk bliver tilmeldt denne gruppe ved registrering.",
		'group_tools:auto_join:fix' => "For at tilmelde alle hjemmesidens medlemmer et medlem af denne gruppe, venligst %sklik her%s.",
		
		// group admins
		'group_tools:multiple_admin:group_admins' => "Gruppe admins",
		'group_tools:multiple_admin:profile_actions:remove' => "Fjern gruppe admin",
		'group_tools:multiple_admin:profile_actions:add' => "Tilføj gruppe admin",
	
		'group_tools:multiple_admin:group_tool_option' => "Aktiver gruppe admins til at vælge andre gruppe admins",

		// cleanup options
		'group_tools:cleanup:title' => "Gruppe sidekolonne oprydning",
		'group_tools:cleanup:description' => "Ryd sidekolonne for gruppen. Dette vil ikke have nogen effekt for gruppe administratorer.",
		'group_tools:cleanup:owner_block' => "Begræns ejer blokken",
		'group_tools:cleanup:owner_block:explain' => "Ejer blokken kan findes i toppen af side kolonnen, nogle ekstra links kan laves i dette område (f.eks.: RSS links).",
		'group_tools:cleanup:actions' => "Vil du tillade at give brugere lov til at blive medlem af denne gruppe",
		'group_tools:cleanup:actions:explain' => "Afhængig af din gruppe indstillinger, kan brugere blive direkte medlem af gruppen eller anmode om det.",
		'group_tools:cleanup:menu' => "Skjul side menu elementer",
		'group_tools:cleanup:menu:explain' => "Skjul menu links til de forskellige gruppe værktøjer. Brugerne vil kun have adgang til gruppe værktøjer ved at bruge gruppe widgets.",
		'group_tools:cleanup:members' => "Skjul gruppe medlemmer",
		'group_tools:cleanup:members:explain' => "På gruppe profilen er der en liste af gruppe medlemmer i den oplyste sektion. Du kan vælge at skjule denne liste.",
		'group_tools:cleanup:search' => "Skjul søgning i gruppen",
		'group_tools:cleanup:search:explain' => "På gruppe profilen er der en søgeboks. Du kan vælge at skjule denne.",
		'group_tools:cleanup:featured' => "Vis udvalgte gruppe i sideklonnen",
		'group_tools:cleanup:featured:explain' => "Du kan vælge at vise en liste af udvalgte grupper i den oplyste sektion på gruppe profilen",
		'group_tools:cleanup:featured_sorting' => "Hvordan udvalgte grupper skal sorteres",
		'group_tools:cleanup:featured_sorting:time_created' => "Nyeste først",
		'group_tools:cleanup:featured_sorting:alphabetical' => "Alfabetisk",

		// group default access
		'group_tools:default_access:title' => "Standard gruppe adgang",
		'group_tools:default_access:description' => "Her kan du kontrollere hvad standard adgangen af nyt indhold i din gruppe skal være.",
		
		// group notification
		'group_tools:notifications:title' => "Gruppe notifikationer",
		'group_tools:notifications:description' => "Denne gruppe har %s medlemmer, og af disse har %s aktiveret notifikationer på aktiviteter for denne gruppe. Nedenunder kan du ændre dette for alle medlemmer af denne gruppe.",
		'group_tools:notifications:disclaimer' => "Med store grupper kan dette tage noget tid.",
		'group_tools:notifications:enable' => "Aktiver notifikationer for alle",
		'group_tools:notifications:disable' => "Deaktiver notifikationer for alle",
		
		// group profile widgets
		'group_tools:profile_widgets:title' => "Vis gruppe profil widgets til brugere der ikke er medlem",
		'group_tools:profile_widgets:description' => "Dette er en lukket gruppe. Som standard vises ingen widgets til de brugere der ikke er medlem. Du kan ændre den indstilling her.",
		'group_tools:profile_widgets:option' => "Tillad brugere der ikke er medlem af se widgets på gruppe profil siden:",
		
		// group mail
		'group_tools:mail:message:from' => "Fra gruppe",
		
		'group_tools:mail:title' => "Send en mail til gruppe medlemmer",
		'group_tools:mail:form:recipients' => "Antal af modtagere",
		'group_tools:mail:form:members:selection' => "Vælg individuelle medlemmer",
		
		'group_tools:mail:form:title' => "Emne felt",
		'group_tools:mail:form:description' => "Beskrivelse",
	
		'group_tools:mail:form:js:members' => "Vælg venligst mindst et medlem, som du ønsker at sende en mail til",
		'group_tools:mail:form:js:description' => "Skriv venligst en besked",
		
		// group invite
		'group_tools:groups:invite:title' => "Inviter brugere til denne gruppe",
		'group_tools:groups:invite' => "Inviter brugere",
		
		'group_tools:group:invite:friends:select_all' => "Vælg alle venner",
		'group_tools:group:invite:friends:deselect_all' => "Fravælg alle venner",
		
		'group_tools:group:invite:users' => "Find bruger(-ere)",
		'group_tools:group:invite:users:description' => "Skriv et navn eller brugernavn på en bruger og vælg ham/hende fra listen",
		'group_tools:group:invite:users:all' => "Inviter alle hjemmesidens medlemmer til denne gruppe",
		
		'group_tools:group:invite:email' => "Inviter ved e-mail adresse",
		'group_tools:group:invite:email:description' => "Udfyld en gyldig e-mail address og vælg den fra listen",
		
		'group_tools:group:invite:csv' => "Inviter ved upload af en CSV-fil",
		'group_tools:group:invite:csv:description' => "Du kan uploade en CSV fil med brugere, som du vil invitere.<br />Formatet i CSV filen skal være: Deres navn;e-mail adresse. Der skal ikke være en titel linje.",
		
		'group_tools:group:invite:text' => "Personlig besked (valgbart)",
		'group_tools:group:invite:add:confirm' => "Er du sikker på, at du ønsker at tilføje disse brugere med det samme?",
		
		'group_tools:group:invite:resend' => "Gensend invitationer til brugere, som allerede har modtaget en invitation",

		'group_tools:groups:invitation:code:title' => "Gruppe invitationer ved e-mail",
		'group_tools:groups:invitation:code:description' => "Hvis du har modtaget en invitation for at tilmelde dig en gruppe via mail, kan du indsætte invitationskoden her, for at acceptere invitationen. Hvis du klikker på linket i invitations mailen, så bliver koden automatisk udfyldt for dig.",

		// group membership requests
		'group_tools:groups:membershipreq:requests' => "Medlemsskabs anmodninger",
		'group_tools:groups:membershipreq:invitations' => "Udestående invitationer",
		'group_tools:groups:membershipreq:invitations:none' => "Ingen udestående invitationer",
		'group_tools:groups:membershipreq:invitations:revoke:confirm' => "Er du sikker på, at du vil gensende denne invitation?",
	
		// group invitations
		'group_tools:group:invitations:request' => "Udestående medlemsskabs anmodninger",
		'group_tools:group:invitations:request:revoke:confirm' => "Er du sikker på, at du vil gensende denne anmodning?",
		'group_tools:group:invitations:request:non_found' => "Der er ingen udestående medlemsskabs anmodninger lige nu",
	
		// group listing
		'group_tools:groups:sorting:alphabetical' => "Alfabetisk",
		'group_tools:groups:sorting:open' => "Åbne grupper",
		'group_tools:groups:sorting:closed' => "Lukkede grupper",
	
		// actions
		'group_tools:action:error:input' => "Et af felterne er udfyldt forkert",
		'group_tools:action:error:entities' => "De givne GUIDs har ikke resulteret i korrekte entities",
		'group_tools:action:error:entity' => "Den givne GUID har ikke resulteret i en korrekte entity",
		'group_tools:action:error:edit' => "Du har ikke adgang til den givne entity",
		'group_tools:action:error:save' => "Der skete en fejl, da indstillingerne skulle gemmes",
		'group_tools:action:success' => "Indstillingerne er hermed gemt",
	
		// admin transfer - action
		'group_tools:action:admin_transfer:error:access' => "Du har ikke tilladelse til at overføre ejerskabet af denne gruppe",
		'group_tools:action:admin_transfer:error:self' => "Du kan ikke overføre ejerskabet til dig selv, du er allerede ejeren",
		'group_tools:action:admin_transfer:error:save' => "En ukendt fejl er opstået, da gruppen skulle gemmes. Prøv venligst igen",
		'group_tools:action:admin_transfer:success' => "Gruppe ejerskabet er hermed overflyttet til %s",
		
		// group admins - action
		'group_tools:action:toggle_admin:error:group' => "Den givne udfyldelse resulterer ikke i en gruppe, du kan ikke ændre denne gruppe eller du er ikke et medlem",
		'group_tools:action:toggle_admin:error:remove' => "En ukendt fejl er opstået, da brugeren skulle fjernes som gruppe administrator",
		'group_tools:action:toggle_admin:error:add' => "En ukendt fejl er opstået, da brugeren skulle tildeles rollen som gruppe administrator",
		'group_tools:action:toggle_admin:success:remove' => "Brugeren er hermed fjernet som gruppe administrator",
		'group_tools:action:toggle_admin:success:add' => "Brugeren er hermed tilføjet som gruppe administrator",
		
		// group mail - action
		'group_tools:action:mail:success' => "Beskeden er hermed sendt",
	
		// group - invite - action
		'group_tools:action:invite:error:invite'=> "Ingen brugere blev inviteret (%s allerede inviteret, %s allerede medlem)",
		'group_tools:action:invite:error:add'=> "Ingen brugere blev tilføjet (%s allerede inviteret, %s allerede medlem)",
		'group_tools:action:invite:success:invite'=> "Hermed inviteret %s brugere (%s allerede inviteret, %s allerede medlem)",
		'group_tools:action:invite:success:add'=> "Hermed tilføjet %s brugere (%s allerede inviteret, %s allerede medlem)",
		
		// group - invite - accept e-mail
		'group_tools:action:groups:email_invitation:error:input' => "Udfyld venligst med en invitationskode",
		'group_tools:action:groups:email_invitation:error:code' => "Invitationskoden er ikke længere gyldig",
		'group_tools:action:groups:email_invitation:error:join' => "En ukendt fejl er opstået, da du skulle tilmeldes gruppen %s, måske er du allerede medlem",
		'group_tools:action:groups:email_invitation:success' => "Du er hermed tilmeldt gruppen",
		
		// group toggle auto join
		'group_tools:action:toggle_auto_join:error:save' => "En fejl opstået, da de nye indstillinger skulle gemmes",
		'group_tools:action:toggle_auto_join:success' => "De nye indstillinger er hermed gemt",
		
		// group fix auto_join
		'group_tools:action:fix_auto_join:success' => "Gruppe medlemsskabet ordnet: %s nye medlemmer, %s var allerede medlemmer og %s fejl",
		
		// group cleanup
		'group_tools:actions:cleanup:success' => "Oprydnings indstillingerne er hermed gemt",
		
		// group default access
		'group_tools:actions:default_access:success' => "Standard adgangen for gruppen er hermed gemt",
		
		// group notifications
		'group_tools:action:notifications:error:toggle' => "Ugyldig flytte handling",
		'group_tools:action:notifications:success:disable' => "Du har hermed deaktiveret notifikationer for alle medlemmer",
		'group_tools:action:notifications:success:enable' => "Du har hermed aktiveret notifikationer for alle medlemmer",
	
		// Widgets
		// Group River Widget
		'widgets:group_river_widget:title' => "Gruppe aktivitet",
	    'widgets:group_river_widget:description' => "Viser aktiviteten af en gruppe i denne widget",

	    'widgets:group_river_widget:edit:num_display' => "Antallet af aktiviteter",
		'widgets:group_river_widget:edit:group' => "Vælg en gruppe",
		'widgets:group_river_widget:edit:no_groups' => "Du skal være medlem af mindst 1 gruppe for at kunne bruge denne widget",

		'widgets:group_river_widget:view:not_configured' => "Denne widget er endnu ikke indstillet korrekt",

		'widgets:group_river_widget:view:more' => "Aktiviteter i gruppe '%s'",
		'widgets:group_river_widget:view:noactivity' => "Vi kunne ikke finde nogle aktiviteter.",
		
		// Group Members
		'widgets:group_members:title' => "Gruppe medlemmer",
  		'widgets:group_members:description' => "Vis medlemmerne i denne gruppe",

  		'widgets:group_members:edit:num_display' => "Hvor mange medlemmer at vise",
  		'widgets:group_members:view:no_members' => "Ingen gruppe medlemmer fundet",
  		
  		// Group Invitations
		'widgets:group_invitations:title' => "Gruppe invitationer",
	  	'widgets:group_invitations:description' => "Viser udestående gruppe invitationer for den valgte bruger",
	  	
	  	// Discussion
		"widgets:discussion:settings:group_only" => "Vis kun diskussioner fra grupper, som du er medlem af",
  		'widgets:discussion:more' => "Vis flere diskussioner",
  		"widgets:discussion:description" => "Vis de seneste diskussioner",
  		
		// Forum topic widget
		'widgets:group_forum_topics:description' => "Vis de seneste diskussioner",
		
		// index_groups
		'widgets:index_groups:description' => "Vis de seneste grupper på din hjemmeside",
		'widgets:index_groups:show_members' => "Vis antal medlemmer",
		'widgets:index_groups:featured' => "Vis kun udvalgte grupper",
		
		// Featured Groups
		'widgets:featured_groups:description' => "Viser en vilkårlig liste af udvalgte grupper",
	  	'widgets:featured_groups:edit:show_random_group' => "Vis en tilfældig liste af grupper",
	  	
		// group_news widget
		"widgets:group_news:title" => "Gruppe nyheder", 
		"widgets:group_news:description" => "Vis de seneste 5 blogs fra de forskellige grupper", 
		"widgets:group_news:no_projects" => "Ingen grupper er oprettet", 
		"widgets:group_news:no_news" => "Ingen blogs for denne gruppe", 
		"widgets:group_news:settings:project" => "Gruppe", 
		"widgets:group_news:settings:no_project" => "Vælg en gruppe",
		"widgets:group_news:settings:blog_count" => "Max. antal grupper",
		"widgets:group_news:settings:group_icon_size" => "Gruppe ikon størrelse",
		"widgets:group_news:settings:group_icon_size:small" => "Lille",
		"widgets:group_news:settings:group_icon_size:medium" => "Medium",
		
	);
	
	add_translation("da", $danish);
  	