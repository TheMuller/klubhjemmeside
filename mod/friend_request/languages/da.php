<?php
	$danish = array(
		'friend_request' => "Venneanmodning",
		'friend_request:menu' => "Venneanmodninger",
		'friend_request:title' => "Venneanmodninger for: %s",
	
		'friend_request:new' => "Ny venneanmodning",
		
		'friend_request:friend:add:pending' => "Venneanmodning i gang",
		
		'friend_request:newfriend:subject' => "%s vil gerne være din ven!",
		'friend_request:newfriend:body' => "%s vil gerne være din ven! Men de venter på dig for at godkende anmodningen... Så log ind nu, så du kan godkende anmodningen.

Se dine venneanmodning (Være sikker på, at du er logget ind på hjemmesiden inden du klikker på linket, eller bliver du henvist på forsiden.):

%s

(Du kan ikke svare på denne mail.)",
		
		// Actions
		// Add request
		'friend_request:add:failure' => "Beklager, pga. en system fejl kunne vi ikke afvikle din forspørgsel. Prøv venligst igen senere.",
		'friend_request:add:successful' => "Du har afsendt en venneanmodning til %s. De skal godkende din request inden de kan vises på din venneliste.",
		'friend_request:add:exists' => "Du har allerede sendt en venneanmodning til %s.",
		
		// Approve request
		'friend_request:approve' => "Godkend",
		'friend_request:approve:successful' => "%s er nu en ven",
		'friend_request:approve:fail' => "Der er desværre opstået en fejl ved oprettelsen af vennerelationen med %s",
	
		// Decline request
		'friend_request:decline' => "Afvis",
		'friend_request:decline:subject' => "%s har afvist din venneanmodning",
		'friend_request:decline:message' => "Kære %s,

%s har afvist din venneanmodning.",
		'friend_request:decline:success' => "Venneanmodning hermed afvist",
		'friend_request:decline:fail' => "Der er desværre opstået en fejl ved afvisningen af venneanmodningen, prøv venligst igen senere",
		
		// Revoke request
		'friend_request:revoke' => "Tilbagekald",
		'friend_request:revoke:success' => "Venneanmodningen er hermed tilbagekaldt",
		'friend_request:revoke:fail' => "Der er desværre opstået en fejl ved tilbagekaldningen af venneanmodningen, prøv venligst igen senere",
	
		// Views
		// Received
		'friend_request:received:title' => "Venneanmodningen der venter",
		'friend_request:received:none' => "Der er ingen venneanmodninger der venter på din godkendelse",

		// Sent
		'friend_request:sent:title' => "Afsendte venneanmodninger",
		'friend_request:sent:none' => "Der er ingen venneanmodninger der afsendt af dig, og venter på godkendelse",
	);
					
	add_translation("da", $danish);
?>