<?php

	$danish = array(
	
		/**
		 * Menu items and titles
		 */
	
			'poll' => "Afstemning",
            'polls:add' => "Ny afstemning",
			'polls' => "Afstemninger",
			'polls:votes' => "stemmer",
			'polls:user' => "%s's afstemning",
			'polls:group_polls' => "Gruppe afstemninger",
			'polls:group_polls:listing:title' => "%s's afstemninger",
			'polls:user:friends' => "%s's venners' afstemning",
			'polls:your' => "dine afstemninger",
			'polls:not_me' => "%s's afstemninger",
			'polls:posttitle' => "%s's afstemninger: %s",
			'polls:friends' => "Venners' afstemninger",
			'polls:not_me_friends' => "%s's ven's afstemninger",
			'polls:yourfriends' => "Dine venners' seneste afstemninger",
			'polls:everyone' => "Alle sidens afstemninger",
			'polls:read' => "L�s afstemning",
			'polls:addpost' => "Opret en afstemning",
			'polls:editpost' => "�ndre en afstemning: %s",
			'polls:edit' => "�ndre en afstemning",
			'polls:text' => "Aftemning tekst",
			'polls:strapline' => "%s",
			'item:object:poll' => 'Afstemninger',
			'item:object:poll_choice' => "Aftemnings valgmuligheder",
			'polls:question' => "Aftemnings sp�rgsm�l",
			'polls:responses' => "Svar valgmuligheder",
			'polls:results' => "[+] Vis resultater",
			'polls:show_results' => "Vis resultater",
			'polls:show_poll' => "Vis afstemning",
			'polls:add_choice' => "Tilf�j svarmulighed",
			'polls:delete_choice' => "Slet denne svarmulighed",
			'polls:settings:group:title' => "Gruppe afstemninger",
			'polls:settings:group_polls_default' => "Ja, aktiver som standard",
			'polls:settings:group_polls_not_default' => "Ja, deaktiver som standard",
			'polls:settings:no' => "Nej",
			'polls:settings:group_profile_display:title' => "Hvis gruppe afstemninger er aktiveret, hvor skal afstemningernes indhold s� vises p� gruppe profilen?",
			'polls:settings:group_profile_display_option:left' => "venstre",
			'polls:settings:group_profile_display_option:right' => "h�jre",
			'polls:settings:group_profile_display_option:none' => "ingen",
			'polls:settings:group_access:title' => "Hvis gruppe afstemninger er aktiveret, hvem skal s� have lov til at oprette afstemninger?",
			'polls:settings:group_access:admins' => "Kun gruppe ejere og administratorer",
			'polls:settings:group_access:members' => "Ethvert gruppe medlem",
			'polls:settings:front_page:title' => "Administratorer kan lave en afstemning p� forsiden (kr�ver layout support)",
			'polls:none' => "Ingen afstemninger fundet.",
			'polls:permission_error' => "Du har ikke tilladelse til at �ndre denne afstemning.",
			'polls:vote' => "Stem",
			'polls:login' => "Log venligst ind, hvis du �nsker at stemme.",
			'group:polls:empty' => "Ingen afstemninger",
			'polls:settings:site_access:title' => "Hvem kan oprette afstemninger for hele siden?",
			'polls:settings:site_access:admins' => "Kun administratorer",
			'polls:settings:site_access:all' => "Ethver medlem",
			'polls:can_not_create' => "Du har ikke tilladelse til at oprette afstemninger.",
			'polls:front_page_label' => "Placer denne afstemning p� forsiden.",
		/**
	     * poll widget
	     **/
			'polls:latest_widget_title' => "Seneste afstemninger p� siden",
			'polls:latest_widget_description' => "Vis de seneste afstemninger.",
			'polls:my_widget_title' => "Mine afstemninger",
			'polls:my_widget_description' => "Denne widget kan vise dine afstemninger.",
			'polls:widget:label:displaynum' => "Hvor mange afstemninger �nsker du at vise?",
			'polls:individual' => "Seneste afstemning",
			'poll_individual_group:widget:description' => "Vis den seneste afstemning for denne gruppe.",
			'poll_individual:widget:description' => "Vis din seneste afstemning",
			'polls:widget:no_polls' => "Der er endnu ingen afstemninger p� %s.",
			'polls:widget:nonefound' => "Ingen afstemninger fundet.",
			'polls:widget:think' => "Lad %s vide hvad du t�nker!",
			'polls:enable_polls' => "Aktiver afstemninger",
			'polls:group_identifier' => "(i %s)",
			'polls:noun_response' => "svar",
			'polls:noun_responses' => "svar",
	        'polls:settings:yes' => "ja",
			'polls:settings:no' => "nej",
			
         /**
	     * poll river
	     **/
	        'polls:settings:create_in_river:title' => "Vis afstemning oprettelse i aktivitets str�mmen",
			'polls:settings:vote_in_river:title' => "Vis afstemning stemme i aktivitets str�mmen",
			'river:create:object:poll' => '%s har oprettet en afstemning %s',
			'river:vote:object:poll' => '%s stemt i afstemningen %s',
			'river:comment:object:poll' => '%s har kommenteret i afstemningen %s',
		/**
		 * Status messages
		 */
	
			'polls:added' => "Din afstemning er oprettet.",
			'polls:edited' => "Din afstemning er gemt.",
			'polls:responded' => "Tak for dit svar, din stemme er hermed registreret.",
			'polls:deleted' => "Din afstemning er hermed slettet.",
			'polls:totalvotes' => "Antal af stemmer: ",
			'polls:voted' => "Din stemme er afgivet for denne afstemning. Tak for din stemme.",
			
	
		/**
		 * Error messages
		 */
	
			'polls:save:failure' => "Din afstemning kunne desv�rre ikke gemmes. Pr�v venligst igen senere.",
			'polls:blank' => "Beklager: du skal udfylde b�de sp�rgsm�l og svar f�r du kan f� oprettet din afstemning.",
			'polls:novote' => "Beklager: du skal v�lge et svar for at afgive din stemme.",
			'polls:notfound' => "Beklager: vi kunne ikke finde den bestemte afstemning.",
			'polls:nonefound' => "Ingen afstemninger er fundet for %s",
			'polls:notdeleted' => "Beklager: vi kunne ikke slette denne afstemning."
	);
					
	add_translation("da",$danish);

?>