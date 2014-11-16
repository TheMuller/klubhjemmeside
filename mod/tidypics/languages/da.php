<?php
/**
* Elgg tidypics plugin danish language pack
*
*/


$danish = array(
// hack for core bug
	'untitled' => "uden titel",

// Menu items and titles
	'image' => "Billede",
	'images' => "Billeder",
	'caption' => "Beskrivelse",
	'photos' => "Fotos",
	'album' => "Fotoalbum",
	'albums' => "Fotoalbums",
	'tidypics:disabled' => 'Deaktiveret',
	'tidypics:enabled' => 'Aktiveret',
	'admin:settings:photos' => 'Tidypics',

	'photos:add' => "Opret album",
	'images:upload' => "Upload fotos",

	'album:slideshow' => "Se slideshow",
	'album:yours' => "Dine fotoalbums",
	'album:yours:friends' => "Dine venners fotoalbums",
	'album:user' => "%s's fotoalbums",
	'album:friends' => "%s's venners fotoalbum",
	'album:all' => "Alle fotoalbums",
	'album:group' => "Gruppe fotoalbum",
	'item:object:image' => "Fotos",
	'item:object:album' => "Album",
	'tidypics:uploading:images' => "Vent venligst, uploader billeder",
	'tidypics:enablephotos' => 'Aktiver gruppe fotoalbum',
	'tidypics:editprops' => 'Rediger billede',
	'tidypics:mostcommented' => 'Mest kommenterede billeder',
	'tidypics:mostcommentedthismonth' => 'Mest kommenterede i denne m�ned',
	'tidypics:mostcommentedtoday' => 'Mest kommenterede i dag',
	'tidypics:mostviewed' => 'Mest sete billeder',
	'tidypics:mostvieweddashboard' => 'Mest sete instrumentpanel',
	'tidypics:mostviewedthisyear' => 'Mest sete i �r',
	'tidypics:mostviewedthismonth' => 'Mest sete i denne m�ned',
	'tidypics:mostviewedlastmonth' => 'Mest sete sidste m�ned',
	'tidypics:mostviewedtoday' => 'Mest sete i dag',
	'tidypics:recentlyviewed' => 'Senest viste billeder',
	'tidypics:recentlycommented' => 'Senest kommenterede billeder',
	'tidypics:mostrecent' => 'Seneste billeder',
	'tidypics:yourmostviewed' => 'Dine mest sete billeder',
	'tidypics:yourmostrecent' => 'Dine seneste billeder',
	'tidypics:friendmostviewed' => "%s's mest sete billeder",
	'tidypics:friendmostrecent' => "%s's seneste billeder ",
	'tidypics:highestrated' => "H�jest bed�mte billeder",
	'tidypics:views' => "%s visninger",
	'tidypics:viewsbyowner' => "af %s brugere (ikke inklusive dig selv)",
	'tidypics:viewsbyothers' => "(%s af dig)",
	'tidypics:administration' => 'Tidypics administration',
	'tidypics:stats' => 'Statistik',
	'tidypics:nophotosingroup' => 'Denne gruppe har ikke nogen fotos endnu',
	'tidypics:upgrade' => 'Opgrader',
	'tidypics:sort' => 'Sort�r %s album',
	'tidypics:none' => 'Ingen fotoalbums',

//settings
	'tidypics:settings' => 'Indstillinger',
	'tidypics:settings:main' => 'Prim�re indstillinger',
	'tidypics:settings:image_lib' => "Fotoarkiv",
	'tidypics:settings:thumbnail' => "Oprettelse af thumbnail",
	'tidypics:settings:help' => "Hj�lp",
	'tidypics:settings:download_link' => "Vis download link",
	'tidypics:settings:tagging' => "Tillad foto tagging",
	'tidypics:settings:photo_ratings' => "Tillad ratings af foto (kr�ver rate plugin af Miguel Montes eller anden kompatibel plugin)",
	'tidypics:settings:exif' => "Vis EXIF data",
	'tidypics:settings:view_count' => "Vis visningst�ller",
	'tidypics:settings:uploader' => "Brug Flash uploader",
	'tidypics:settings:grp_perm_override' => "Giv gruppens medlemmer fuld adgang til gruppe-album",
	'tidypics:settings:maxfilesize' => "Maksimal billedst�rrelse i megabytes (MB):",
	'tidypics:settings:quota' => "Tildelt brugerplads (MB) - 0 betyder, ingen plads",
	'tidypics:settings:watermark' => "Indtast teksten til vandm�rke",
	'tidypics:settings:im_path' => "Angiv stien til ImageMagick kommandoer",
	'tidypics:settings:img_river_view' => "Hvor mange poster p� aktivitetssiden for hvert parti uploadede billeder",
	'tidypics:settings:album_river_view' => "Vis albumcover eller et s�t af fotos for nye albums",
	'tidypics:settings:largesize' => "St�rrelse p� billede",
	'tidypics:settings:smallsize' => "Tumbnailst�rrelse p� album",
	'tidypics:settings:tinysize' => "Thumbnailst�rrelse p� billede",
	'tidypics:settings:sizes:instructs' => 'Du skal m�ske tilpasse CSS, hvis du �ndrer standard st�rrelserne',
	'tidypics:settings:im_id' => "Billed ID",
	'tidypics:settings:heading:img_lib' => "Image Library indstillinger",
	'tidypics:settings:heading:main' => "Vigtige Indstillinger",
	'tidypics:settings:heading:river' => "Indstillinger for aktivitetssiden",
	'tidypics:settings:heading:sizes' => "Thumbnail st�rrelse",
	'tidypics:settings:heading:groups' => "Gruppe indstillinger",
	'tidypics:option:all' => 'Alle',
	'tidypics:option:none' => 'Ingen',
	'tidypics:option:cover' => 'Cover',
	'tidypics:option:set' => 'S�t',

// server analysis
	'tidypics:server_info' => 'Server Information',
	'tidypics:server_info:gd_desc' => 'Elgg kr�ver GD extension indl�st',
	'tidypics:server_info:exec_desc' => 'Kr�ves til ImageMagick command line',
	'tidypics:server_info:memory_limit_desc' => '�ges ved at �ndre memory_limit',
	'tidypics:server_info:peak_usage_desc' => 'Dette er omtrent minimum per side',
	'tidypics:server_info:upload_max_filesize_desc' => 'Max st�rrelse p� et uploaded billede',
	'tidypics:server_info:post_max_size_desc' => 'Max post st�rrelse = sum af billeder + html form',
	'tidypics:server_info:max_input_time_desc' => 'Tid som script venter p� at et upload afsluttes',
	'tidypics:server_info:max_execution_time_desc' => 'Max tid et script vil k�re',
	'tidypics:server_info:use_only_cookies_desc' => 'Cookie only sessions kan have indflydelse p� Flash uploaderen',

	'tidypics:server_info:php_version' => 'PHP Version',
	'tidypics:server_info:memory_limit' => 'Hukommelse tilg�ndelig for PHP',
	'tidypics:server_info:peak_usage' => 'Hukommelse brugt til at loade denne side',
	'tidypics:server_info:upload_max_filesize' => 'Max fil upload st�rrelse',
	'tidypics:server_info:post_max_size' => 'Max post st�rrelse',
	'tidypics:server_info:max_input_time' => 'Max input tid',
	'tidypics:server_info:max_execution_time' => 'Max eksekverings tid',
	'tidypics:server_info:use_only_cookies' => 'Cookie only sessions',

	'tidypics:server_config' => 'Server konfiguration',
	'tidypics:server_configuration_doc' => 'Server konfigurations dokumentation',

// ImageMagick test
	'tidypics:lib_tools:testing' =>
'Tidypics skal kende placeringen af ??ImageMagick eksekverbare filer, hvis du har valgt det som billedbibliotek. Din hosting tjeneste b�r kunne oplyse dig om dette. Du kan teste om placeringen er korrekt herunder. Hvis stien er korrekt, vil det fremg� hvilken version af ImageMagick, der er installeret p� din server.',

// thumbnail tool
	'tidypics:thumbnail_tool' => 'Thumbnail oprettelse',
	'tidypics:thumbnail_tool_blurb' =>
'Denne side giver dig mulighed for at oprette thumbnails for billeder, hvis oprettelse mislykkedes under upload. Du kan opleve problemer med thumbnails, hvis dit billedbibliotek ikke er konfigureret korrekt, eller hvis der ikke er nok hukommelse til GD-biblioteket til at indl�se og �ndre st�rrelsen p� et billede. Hvis dine brugere har oplevet problemer med thumbnail oprettelse og du har rettet din konfiguration, kan du pr�ve at genoprette disse thumbnails. Find den unikke identifikator af fotoet og indtast den herunder (det er tallet, der st�r sidst i URL\'en, n�r du f�r vist et billede).',
	'tidypics:thumbnail_tool:unknown_image' => 'Kunne ikke hente det originale billede',
	'tidypics:thumbnail_tool:invalid_image_info' => 'Der opstod en fejl under indhentning af information om billedet',
	'tidypics:thumbnail_tool:create_failed' => 'Kunne ikke oprette thumbnails',
	'tidypics:thumbnail_tool:created' => 'Thumbnails oprettet.',

//actions
	'album:create' => "Opret nyt album",
	'album:add' => "Tilf�j nyt album",
	'album:addpix' => "F�j fotos til album",
	'album:edit' => "Rediger album",
	'album:delete' => "Slet album",
	'album:sort' => "Sort�r",
	'image:edit' => "Rediger billede",
	'image:delete' => "Slet billede",
	'image:download' => "Download billede",

//forms
	'album:title' => "Titel",
	'album:desc' => "Beskrivelse",
	'album:tags' => "Tags",
	'album:cover' => "Brug dette billede som albumcover",
	'album:cover_link' => 'Brug som cover',
	'tidypics:title:quota' => 'Plads',
	'tidypics:quota' => "Plads forbrug:",
	'tidypics:uploader:choose' => "V�lg fotos",
	'tidypics:uploader:upload' => "Upload fotos",
	'tidypics:uploader:describe' => "Beskriv fotos",
	'tidypics:uploader:filedesc' => 'Billedfiler (jpeg, png, gif)',
	'tidypics:uploader:instructs' => 'Med tre nemme trin kan du tilf�je fotos i dit album ved hj�lp af denne uploader: v�lg, upload og beskriv fotos. Der er et %s MB maximum per foto. Hvis du ikke har Flash, er der ogs� en <a href="%s">standard uploader</a> til r�dighed.',
	'tidypics:uploader:basic' => 'Du kan uploade op til 10 fotos ad gangen (%s MB maksimum per foto)',
	'tidypics:sort:instruct' => 'Sort�r fotos i albummet ved hj�lp af drag and drop. Klik derefter p� knappen Gem.',
	'tidypics:sort:no_images' => 'Der er ingen billeder at sort�re. Upload billeder via linket herover.',

// albums
	'album:num' => '%s fotos',

//views
	'image:total' => "Billeder i album:",
	'image:by' => "Billede tilf�jet af",
	'album:by' => "Album oprettet af",
	'album:created:on' => "Oprettet",
	'image:none' => "Ingen billeder tilf�jet endnu.",
	'image:back' => "Forrige",
	'image:next' => "N�ste",
	'image:index' => "%u af %u",

// tagging
	'tidypics:taginstruct' => 'V�lg et omr�de p� billedet, som du �nsker at tagge eller %s',
	'tidypics:finish_tagging' => 'Annuller tagging',
	'tidypics:tagthisphoto' => 'Tag dette foto',
	'tidypics:actiontag' => 'Tag',
	'tidypics:actioncancel' => 'Annuller',
	'tidypics:inthisphoto' => 'I dette foto',
	'tidypics:usertag' => "Foto tagget til bruger %s",
	'tidypics:phototagging:success' => 'Foto tag blev tilf�jet',
	'tidypics:phototagging:error' => 'Uventet fejl opstod ved tagging',

	'tidypics:phototagging:delete:success' => 'Foto tag er blevet fjernet',
	'tidypics:phototagging:delete:error' => 'Uventet fejl opstod ved fjernelse af tag.',
	'tidypics:phototagging:delete:confirm' => 'Fjern dette tag?',



	'tidypics:tag:subject' => "Du er blevet tagget i et foto",
	'tidypics:tag:body' => "Du er blevet tagget i fotoet %s af %s.

Fotoet kan ses her: %s",


//rss
	'tidypics:posted' => 'postede et foto',

//widgets
	'tidypics:widget:albums' => "Fotoalbum",
	'tidypics:widget:album_descr' => "Vis dine fotoalbums",
	'tidypics:widget:num_albums' => "Antal albums der skal vises",
	'tidypics:widget:latest' => "Seneste fotos",
	'tidypics:widget:latest_descr' => "Vis dine seneste fotos",
	'tidypics:widget:num_latest' => "Antal billeder der skal vises",
	'album:more' => "Se alle albums",

//river
	'river:create:object:image' => "%s tilf�jede fotoet %s",
	'image:river:created' => "%s f�jede et foto til albummet %s",
	'image:river:created:multiple' => "%s f�jede %u fotos til albummet %s",
	'image:river:item' => "et foto",
	'image:river:annotate' => "en kommentar til fotoet",
	'image:river:tagged' => "%s taggede %s i fotoet %s",
	'image:river:tagged:unknown' => "%s taggede %s i et foto",
	'river:create:object:album' => "%s oprettede et nyt fotoalbum %s",
	'album:river:group' => "i gruppen",
	'album:river:item' => "et album",
	'album:river:annotate' => "en kommentar til fotoalbummet",
	'river:comment:object:image' => '%s kommenterede p� fotoet %s',
	'river:comment:object:album' => '%s kommenterede p� albummet %s',

//notifications
	'tidypics:newalbum_subject' => 'Nyt fotoalbum',
	'tidypics:newalbum' => '%s oprettede et nyt fotoalbum',
	'tidypics:updatealbum' => "%s uploadede nye fotos til albummet %s",

//  Status messages
	'tidypics:upl_success' => "Billedet er uploadet med succes",
	'image:saved' => "Billedet blev gemt",
	'images:saved' => "Alle billeder er gemt",
	'image:deleted' => "Billedet blev slettet",
	'image:delete:confirm' => "�nsker du at slette dette billede?",
	'images:edited' => "Billedet er blevet opdateret",
	'album:edited' => "Albummet er blevet opdateret",
	'album:saved' => "Albummet blev gemt",
	'album:deleted' => "Albummet er blevet slettet",
	'album:delete:confirm' => "�nsker du at slette dette album?",
	'album:created' => "Dit nye album er oprettet",
	'album:save_cover_image' => 'Cover billede gemt.',
	'tidypics:settings:save:ok' => 'Tidypics indstillingerne er gemt',
	'tidypics:album:sorted' => 'Albummet %s er sorteret',
	'tidypics:album:could_not_sort' => 'Kunne ikke sortere albummet %s. Tjek om der er billeder i albummet og pr�v igen.',
	'tidypics:upgrade:success' => 'Tidypics blev opgraderet med succes',

//Error messages
	'tidypics:baduploadform' => "There was an error with the upload form",
	'tidypics:partialuploadfailure' => "Der opstod en fejl under uploadingen af billeder (%s af %s billeder)",
	'tidypics:completeuploadfailure' => "Upload af billede mislykkedes",
	'tidypics:exceedpostlimit' => "Alt for mange store billeder p� �n gang - fors�g evt. at overf�re f�rre eller mindre billeder",
	'tidypics:noimages' => "Ingen billeder udvalgt til upload",
	'tidypics:image_mem' => "Billedet er for stort",
	'tidypics:image_pixels' => "Billedet har for mange pixels",
	'tidypics:unk_error' => "Ukendt fejl opstod under upload",
	'tidypics:save_error' => "Ukendt fejl opstod, da billedet skulle gemmes p� serveren",
	'tidypics:not_image' => "Type af billede kan ikke genkendes",
	'tidypics:deletefailed' => "Dit billede kunne ikke slettes",
	'tidypics:deleted' => "Slettet med succes.",
	'tidypics:nosettings' => "Administratoren af webstedet, har ikke foretaget justeringer for fotoalbum",
	'tidypics:exceed_quota' => "Din tildelte plads er opbrugt!",
	'tidypics:cannot_upload_exceeds_quota' => 'Image not uploaded. File size exceeds available quota.',

	'album:none' => "Ingen albums oprettet endnu",
	'album:uploadfailed' => "Dit album kunne ikke gemmes",
	'album:deletefailed' => "Dit album kunne ikke slettes",
	'album:blank' => "Giv venligst dette album en titel",
	'album:invalid_album' => 'Ugyldigt album',
	'album:cannot_save_cover_image' => 'Cover billedet kunne ikke gemmes',

	'image:downloadfailed' => "Beklager, dette billede er ikke tilg�ngeligt.",
	'images:notedited' => "Ikke alle billeder blev opdateret",
	'image:blank' => 'Giv venligst billedet en titel.',
	'image:error' => 'Billedet kunne ikke gemmes.',

	'tidypics:upgrade:failed' => "Opgraderingen af Tidypics mislykkedes",
);

add_translation("da", $danish);