<?php

	$danish = array(
		
		// special access level
		'LOGGED_OUT' => "Brugere der er logget ud",
		'access:admin_only' => "Kun admins",
		
		// admin menu items
		'admin:widgets' => "Widgets",
		'admin:widgets:manage' => "Kontrolpanel",
		'admin:widgets:manage:index' => "Kontrolpanel forside",
		'admin:statistics:widgets' => "Widget Brug",
		
		// widget edit wrapper
		'widget_manager:widgets:edit:custom_title' => "Brugerdefineret titel",
		'widget_manager:widgets:edit:custom_url' => "Brugerdefineret titel link",
		'widget_manager:widgets:edit:hide_header' => "Skjul titel bjælke",
		'widget_manager:widgets:edit:custom_class' => "Brugerdefineret CSS klasse",
		'widget_manager:widgets:edit:disable_widget_content_style' => "Ingen widget stil",
			
		// group
		'widget_manager:groups:enable_widget_manager' => "Aktivet kontrolpanel for widgets",
	
		// admin settings
		'widget_manager:settings:index' => "Forside",
		'widget_manager:settings:group' => "Gruppe",
		
		'widget_manager:settings:custom_index' => "Brug Widget kontrolpanel brugerdefineret forside?",
		'widget_manager:settings:custom_index:non_loggedin' => "Kun for besøgende",
		'widget_manager:settings:custom_index:loggedin' => "Kun for brugere logget ind",
		'widget_manager:settings:custom_index:all' => "For alle brugere",
	
		'widget_manager:settings:widget_layout' => "Vælg et widget layout",
		'widget_manager:settings:widget_layout:33|33|33' => "Standard layout (33% pr. kolonne)",
		'widget_manager:settings:widget_layout:50|25|25' => "Bred venstre kolonne (50%, 25%, 25%)",
		'widget_manager:settings:widget_layout:25|50|25' => "Bred midter kolonne (25%, 50%, 25%)",
		'widget_manager:settings:widget_layout:25|25|50' => "Bred højre kolonne (25%, 25%, 50%)",
		'widget_manager:settings:widget_layout:75|25' => "To kolonner (75%, 25%)",
		'widget_manager:settings:widget_layout:60|40' => "To kolonner (60%, 40%)",
		'widget_manager:settings:widget_layout:50|50' => "To kolonner (50%, 50%)",
		'widget_manager:settings:widget_layout:40|60' => "To kolonner (40%, 60%)",
		'widget_manager:settings:widget_layout:25|75' => "To kolonner (25%, 75%)",
		
		'widget_manager:settings:index_top_row' => "Vis et felt øverst på forsiden",
		'widget_manager:settings:index_top_row:none' => "Ingen øverste felt",
		'widget_manager:settings:index_top_row:full_row' => "Fuld bredde for øverste felt",
		'widget_manager:settings:index_top_row:two_column_left' => "To kolonner justeret mod venstre",
		
		'widget_manager:settings:disable_free_html_filter' => "Inaktiver HTML filtrering for åben HTML widgets på forsiden (KUN ADMINS)",
		
		'widget_manager:settings:group:enable' => "Aktiver Widget kontrolpanel for grupper",
		'widget_manager:settings:group:option_default_enabled' => "Widget kontrolpanel for grupper som standard aktiveret",
		'widget_manager:settings:group:option_admin_only' => "Kun administratorer kan aktivere gruppe widgets",

		'widget_manager:settings:multi_dashboard' => "Multi instrumentpanel",
		'widget_manager:settings:multi_dashboard:enable' => "Aktiver multi instrumentpanelet",

		// views
		// settings
		'widget_manager:forms:settings:no_widgets' => "Ingen widgets til gængelig",
		'widget_manager:forms:settings:can_add' => "Kan tilføjes",
		'widget_manager:forms:settings:hide' => "skjul",

		// lightbox
		'widget_manager:button:add' => "Tilføj widget",
		'widget_manager:widgets:lightbox:title:dashboard' => "Tilføj widgets til dit personlige instrumentpanel",
		'widget_manager:widgets:lightbox:title:profile' => "Tilføj widgets til din offentlige profil",
		'widget_manager:widgets:lightbox:title:index' => "Tilføj widgets til forsiden",
		'widget_manager:widgets:lightbox:title:groups' => "Tilføj widgets til gruppe profilen",
		'widget_manager:widgets:lightbox:title:admin' => "Tilføj widgets til admin instrumentpanel",
		
		// multi dashboard
		'widget_manager:multi_dashboard:add' => "Nyt faneblad",
		'widget_manager:multi_dashboard:extras' => "Tilføj som faneblad på instrumentpanel",
		
		// multi dashboard - edit
		'widget_manager:multi_dashboard:new' => "Opret et nyt instrumentpanel",
		'widget_manager:multi_dashboard:edit' => "Ændre instrumentpanel: %s",
		
		'widget_manager:multi_dashboard:types:title' => "Vælg et instrumentpanel type",
		'widget_manager:multi_dashboard:types:widgets' => "Widgets",
		'widget_manager:multi_dashboard:types:iframe' => "iFrame",
		
		'widget_manager:multi_dashboard:num_columns:title' => "Antal af kolonner",
		'widget_manager:multi_dashboard:iframe_url:title' => "iFrame URL",
		'widget_manager:multi_dashboard:iframe_url:description' => "OBS: være sikker på at URL starter med http:// or https://. Ikke alle sider supporter er brugen af iFrames",
		'widget_manager:multi_dashboard:iframe_height:title' => "iFrame højde",
		
		'widget_manager:multi_dashboard:required' => "Punkter markeret med * er obligatoriske",
		
		// actions
		// manage
		'widget_manager:action:manage:error:context' => "Ugyldig sammenhæng for at gemme widget konfiguration",
		'widget_manager:action:manage:error:save_setting' => "Fejl: Kunne ikke gemme indstillingerne %s for widget %s",
		'widget_manager:action:manage:success' => "Widget konfiguration er gemt",
		
		// multi dashboard - edit
		'widget_manager:actions:multi_dashboard:edit:error:input' => "Ugyldigt input, vælg venligst en titel",
		'widget_manager:actions:multi_dashboard:edit:success' => "Nyt/ændring af instrumentpanel er hermed gemt",
		
		// multi dashboard - delete
		'widget_manager:actions:multi_dashboard:delete:error:delete' => "Ikke muligt at fjerne instrumentpanel %s",
		'widget_manager:actions:multi_dashboard:delete:success' => "Instrumentpanel %s hermed slettet",
		
		// multi dashboard - drop
		'widget_manager:actions:multi_dashboard:drop:success' => "Widget er hermed flyttet til nye instrumentpanel",
		
		// multi dashboard - reorder
		'widget_manager:actions:multi_dashboard:reorder:error:order' => "Vælg venligst en ny rækkefølge",
		'widget_manager:actions:multi_dashboard:reorder:success' => "Ny instrumentpanel rækkefølge gemt",
		
		// widgets
		'widget_manager:widgets:edit:advanced' => "Avanceret",
		'widget_manager:widgets:fix' => "Ændre denne widget på instrumentpanel/profil",
			
		// index_login
		'widget_manager:widgets:index_login:description' => "Vis en login boks",
		'widget_manager:widgets:index_login:welcome' => "<b>%s</b> velkommen til <b>%s</b>",
		
		// index_members
		'widget_manager:widgets:index_members:name' => "Medlemmer",
		'widget_manager:widgets:index_members:description' => "Vis medlemmerne på din side",
		'widget_manager:widgets:index_members:user_icon' => "Skal brugeren have et profil billede",
		'widget_manager:widgets:index_members:no_result' => "Ingen brugere fundet",
		
		// index_memebers_online
		'widget_manager:widgets:index_members_online:name' => "Online medlemmer",
		'widget_manager:widgets:index_members_online:description' => "Vis online medlemmerne på din side",
		'widget_manager:widgets:index_members_online:member_count' => "Hvor mange medlemmer skal der vises",
		'widget_manager:widgets:index_members_online:user_icon' => "Skal brugerne have et profil billede",
		'widget_manager:widgets:index_members_online:no_result' => "Ingen brugere fundet",
		
		// index_file
		'widget_manager:widgets:index_file:description' => "Vis seneste filer på din hjemmeside",
		
		// index_pages
		'widget_manager:widgets:index_pages:description' => "Vis seneste sider på din hjemmeside",
		
		// index_bookmarks
		'widget_manager:widgets:index_bookmarks:description' => "Vis seneste bogmærker på din hjemmeside",
		
		// index_activity
		'widget_manager:widgets:index_activity:description' => "Vis seneste aktiviteter på din hjemmeside",
	
		// image_slider
		'widget_manager:widgets:image_slider:name' => "Billede Slider",
		'widget_manager:widgets:image_slider:description' => "Vis en billede slider",
		'widget_manager:widgets:image_slider:slider_type' => "Slider type",
		'widget_manager:widgets:image_slider:slider_type:s3slider' => "s3Slider",
		'widget_manager:widgets:image_slider:slider_type:flexslider' => "FlexSlider",
		'widget_manager:widgets:image_slider:seconds_per_slide' => "Sekunder pr slide",
		'widget_manager:widgets:image_slider:slider_height' => "Højde på slides (pixels)",
		'widget_manager:widgets:image_slider:overlay_color' => "Tekst baggrundsfarve (4690d6)",
		'widget_manager:widgets:image_slider:title' => "Slide",
		'widget_manager:widgets:image_slider:label:url' => "Billede url",
		'widget_manager:widgets:image_slider:label:text' => "Tekst",
		'widget_manager:widgets:image_slider:label:link' => "Link",
		'widget_manager:widgets:image_slider:label:direction' => "Retning",
		'widget_manager:widgets:image_slider:direction:top' => "Top",
		'widget_manager:widgets:image_slider:direction:right' => "Højre",
		'widget_manager:widgets:image_slider:direction:bottom' => "Bund",
		'widget_manager:widgets:image_slider:direction:left' => "Venstre",
	);
	add_translation("da", $danish);

	$twitter_search = array(
		// twitter_search
		'widgets:twitter_search:name' => "Twitter søgning",
		'widgets:twitter_search:description' => "Vis en brugerdefineret søgning fra Twitter",
		
		'widgets:twitter_search:query' => "Søgeforespørgsel",
		'widgets:twitter_search:query:help' => "prøv nogle avancerede forespørgsler",
		'widgets:twitter_search:title' => "Widget titel (valgbart)",
		'widgets:twitter_search:subtitle' => "Widget undertitel (valgbart)",
		'widgets:twitter_search:height' => "Widget højde (pixels)",
		'widgets:twitter_search:background' => "Sæt som brugerdefineret baggrundsfarve (4690d6)",
		'widgets:twitter_search:not_configured' => "Denne widget er endnu ikke konfigureret",
	);
	add_translation("da", $twitter_search);
	
	$content_by_tag = array(
		// content_by_tag
		'widgets:content_by_tag:name' => "Indhold ved tag",
		'widgets:content_by_tag:description' => "Find indhold ved en tag",
		
		'widgets:content_by_tag:owner_guids' => "Hvem skal skrive elementer",
		'widgets:content_by_tag:entities' => "Hvilke enheder skal vises",
		'widgets:content_by_tag:tags' => "Tag(s) (komma separeret)",
		'widgets:content_by_tag:tags_option' => "Hvordan tag(sene) skal bruges",
		'widgets:content_by_tag:tags_option:and' => "OG",
		'widgets:content_by_tag:tags_option:or' => "ELLER",
		'widgets:content_by_tag:display_option' => "Hvordan skal indholdet vises",
		'widgets:content_by_tag:display_option:normal' => "Normalt",
		'widgets:content_by_tag:display_option:slim' => "Slank (pr line)",
		'widgets:content_by_tag:highlight_first' => "Antal af oplyste elementer (kun ved slank)",
	);
	add_translation("da", $content_by_tag);
	
	$rss = array(
		// RSS widget (based on SimplePie)
		'widgets:rss:title' => "RSS Feeds",
		'widgets:rss:description' => "Vis en RSS feed (baseret på SimplePie)",
		'widgets:rss:error:notset' => "Ingen RSS Feed URL leveret",
		
		'widgets:rss:settings:rss_count' => "Antal af feeds der skal vises",
		'widgets:rss:settings:rssfeed' => "URL af RSS feeden",
		'widgets:rss:settings:show_feed_title' => "Vis feed titel",
		'widgets:rss:settings:excerpt' => "Vis et uddrag",
		'widgets:rss:settings:show_item_icon' => "Vis element ikon (hvis til gængelig)",
		'widgets:rss:settings:post_date' => "Vis oprettelses datoen",
		'widgets:rss:settings:post_date:option:friendly' => "Vis korrekt dato",
		'widgets:rss:settings:post_date:option:date' => "Vis dato",
	);
	add_translation("da", $rss);
	
	$group_files = array(
		// Files widget
		'widgets:group_files:description' => "Vis seneste gruppe filer",
	);
	add_translation("da", $group_files);
	
	$free_html = array(
		// Free HTML
		'widgets:free_html:title' => "Åben HTML",
		'widgets:free_html:description' => "Udfyld dit indhold i HTML",
		'widgets:free_html:settings:html_content' => "Lever venligst HTML'en til visning",
		'widgets:free_html:no_content' => "Denne widget er endnu ikke konfigureret",
		
	);
	add_translation("da", $free_html);
	
	$tagcloud = array(
		'widgets:tagcloud:description' => "Vis en tagcloud baseret på all indhold på hjemmesiden, i gruppen eller fra brugeren",
		'widgets:tagcloud:no_data' => "Ingen data til gængelig til visning i tagclouden",
	);
	add_translation("da", $tagcloud);
	
	$entity_statistics = array(
		// entity_statistics widget
		"widgets:entity_statistics:title" => "Statistikker",
		"widgets:entity_statistics:description" => "Vis sidens statistikker",
		"widgets:entity_statistics:settings:selected_entities" => "Vælg de statistikker, som du ønsker at vise",
	
	);
	add_translation("da", $entity_statistics);
	
	$messages = array(
		// messages widget
		"widgets:messages:description" => "Viser dine seneste beskeder",
		"widgets:messages:not_logged_in" => "Du skal være logget ind for at bruge denne widget",
		"widgets:messages:settings:only_unread" => "Vis kun ulæste beskeder",
	);
	add_translation("da", $messages);
	