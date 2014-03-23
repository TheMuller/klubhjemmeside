<?php

	$danish = array(
//view all order
    'event_calendar:orderid' => 'ordre-id',
    'event_calendar:eventtitle' => 'aktiviteter',
    'event_calendar:attendee' => 'deltager',
    'event_calendar:amount' => 'beløb',
    'awaitingapproval' =>'afventer godkendelse',
//````````````````````````````````````````
//			..._extend/	en.php
//:DC:	language texts!
	'event_calendar:ticketsmax' => 'Du har nu købt de maks. antal billetter du kan købe. Du kan ikke købe flere!',
	'event_calendar:widget_created' => "Oprettet den: ",
	'event_calendar:prev_to' => "Tidligere billet ordre: ",
	'event_calendar:prev_to_1' => 'Billet ordre: ',
	'event_calendar:ticket:list' => 'Vælg billetter du vil købe',
	'event_calendar:cancel_ticket' => 'Annuller',
	'event_calendar:cancel_ticket_title' => 'Annuller alle dine billetter for denne ordre (Type ',
	'event_calendar:show_past' => 'Gamle events',

    'event_calendar:show_upcoming' => 'Events',
    'event_calendar:show_regular' => 'Faste tilbud',
	'event_calendar:listing_title:all' => "Alle events",
	'event_calendar:listing_title:open' => "Gratis events",
	'event_calendar:listing_title:mine' => "Min kalender",
	'event_calendar:listing_title:friends' => "Kollegaers' kalendere",
    'event_calendar:listing_title:upcoming' => "kommende aktiviteter",
    'event_calendar:listing_title:regular' => "Faste tilbud",
    'event_calendar:ticket:reorder' => 'Genstart betaling',
//:DC:	:END:
//`

	'event_calendar:make_request_title:payment' => 'Betal <b>%s %s</b> for at deltage',
	'event_calendar:request:awaiting_approval' => 'Venter på godkendelse',
	'event_calendar:request:closedfuture'=> 'Luk for flere tilmeldinger',
	'event_calendar:excel' => 'Download som excel ark',
	'event_calendar:settings:payment:merchantnumber' => 'ePay mechant nummer',
	'event_calendar:settings:payment:md5secret' => 'MD5 secret key',
	
	'event_calendar:payment:accepted' => 'Din betaling er modtaget',
    'event_calendar:payment:accepted_detail' => '<p>Din betaling er hermed godkendt.</p><p><b>Bestil Henvisning: </b>%s</p><p><b>Transaction ID: </b> %s </p>',
	'event_calendar:payment:accepted:mailsent' => '<p>Din betaling er accepteret, og en ordrebekræftelses mail er sendt til din mailadresse!</p>',
			
    'event_calendar:payment:declined' => 'betaling afvist!',
    'event_calendar:payment:declined_detail' => 'Desværre, blev betalingen ikke godkendt',
                    
	'event_calendar:settings:currency:title' => "Valutaer for betalingsaktiviteter skal vises som (f.eks. USD, DKK, GBP..)",

	'event_calendar:personal_manage:closedfuture_no_list'=> 'Lukket for tilmeldinger (vente liste slettes)',
	'event_calendar:personal_manage:closedfuture_keep_list'=> 'Lukket for tilmeldinger (vente liste beholdes)',
	
	'event_calendar:returnto' => 'Tilbage til aktivitet',
	
	
	'event_calendar:denied:subject' => 'Beklager, du er ikke tilmeldt aktiviteten',
	'event_calendar:denied:message' => 'Aktiviteten "%s" er nu lukket for tilmeldinger, og du er desværre ikke tilmeldt arrangementet. Vi håber, at det lykkes for dig næste gang. Mvh. Vingesuset.',

	'event_calendar:event:status' => 'Tilmelding status',
	'event_calendar:event:status:closed' => 'Din tilmelding skal godkendes af administrator',
	'event_calendar:event:status:closedfuture_keep_list' => 'Lukket for tilmeldinger',
	'event_calendar:event:status:closedfuture_no_list' => 'Lukket for tilmeldinger',
	'event_calendar:event:status:open' => 'Åben tilmelding (du tilmeldes automatisk arrangementet)',
	'event_calendar:event:status:private' => 'Privat arrangementet',

	'event_calendar:ticket:type' => 'Billet:',
	'event_calendar:ticket:amount' => 'Pris:',
	'event_calendar:ticket:spots' => 'Antal:',
	'event_calendar:ticket:spots:max' => 'Max. loft:',
	'event_calendar:ticket:spots:sold' => 'Solgte:',
	'event_calendar:ticket:spots:left' => 'tilbage',
	'event_calendar:ticket:spots:total' => 'Total:',
	'event_calendar:ticket:list' => 'Vælg billetter',
	'event_calendar:ticket:buynow' => 'Betal',
	'event_calendar:ticket:problem' => 'Der opstået desværre en fejl i billetter systemet. Prøv venligst igen.',
	'event_calendar:ticket:soldout' => ' <b>Udsolgt!</b>',
	'event_calendar:tickets:allsoldout' => 'Alle billetter er udsolgt',
	'event_calendar:ticket:notfree' => 'Dette event er ikke gratis, du skal vælge en af billetterne.',
	'event_calendar:ticket:free:closed:success' => 'Din tilmelding er nu registreret og skal godkendes af administratoren, og du modtager snart en bekræftelsesmail.',
	'event_calendar:ticket:free:open:success' => 'Tillykke! Din gratis ordre er accepteret!',
	'event_calendar:make_request_title:free' => 'Dette er en gratis aktivitet - Tilmeld dig her',
	
	'awaitingpayment' => 'Venter på betaling',
	'processing' => 'Bliver behandlet',
	'accepted' => 'Billet købet er godkendt',

	'event_calendar:doublecheck' => 'Godkend venligst din bestilling.',
	'event_calendar:review_order_menu_title' => 'Event bestillinger',

	'event_calendar:view_orders' => 'Billetbestillinger for %s',
    'event_calendar:view_all_orders' => 'Se alle bestillinger',
	'event_calendar:order:created:subject' => 'Ordre bekræftelse: Din ordre til aktiviteten \'%s\' er hermed registreret.',
	'event_calendar:order:created:message' => 'Vi bekræfter hermed at have modtaget din billetordre for <b>%s</b>
<p>Ordre id: %s</p>
<p>Transfer id: %s</p>
<p>Medarbejder ID: %s</p>
<p>Dato: %s</p>
<p>Sted: %s</p>

<b>Billet(-terne) indeholder</b> %s

Total pris: %s',

	'event_calendar:order:accepted:subject' => 'Billetbekræftelse: Din billetbestilling til aktiviteten \'%s\' er hermed godkendt.',
	'event_calendar:order:accepted:message' => 'Vi bekræfter hermed billetterne til <b>%s</b> er reserveret til dig
<p>Ordre id: %s</p>
<p>Transfer id: %s</p>
<p>Medarbejder ID: %s</p>
<p>Dato: %s</p>
<p>Sted: %s</p>

<p><b>Billet(-terne) indeholder</b></p>  %s
<p>Total: %s</p>',

	'event_calendar:order:declined:subject' => 'Din billetbestilling til \'%s\' er hermed afvist.',
	'event_calendar:order:declined:message' => 'Din billetordre til <b>%s</b>, med ordre id %s, er blevet afvist. Din betaling vil hermed blive annulleret, og alle din betalingskort oplysninger slettes.',

	'event_calendar:order:free:created:subject' => 'Ordre bekræftelse: Din ordre til aktiviteten \'%s\' er hermed registreret.',
	'event_calendar:order:free:created:message' => '<p>Vi bekræfter hermed at have modtaget din billetordre (%s) til <b>%s</b>.</p> <br/>',

	'event_calendar:attendees:export:header' => "OrdreID \t Navn \t Brugernavn \t Email \t Telefon\t",

	);
					
	add_translation("da",$danish);

?>