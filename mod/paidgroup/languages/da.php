<?php
/**
 * PaidGroup languages
 *
 * @package ElggPaidGroup
 */

$danish = array(
'inactive' => "InAktive",
'groups:paid' => "Betalings Gruppe",
				 'paidgroup:forced_gallery:header' => 'Vælg Gruppe (Premium)',
				 'paidgroup:need_approval' => 'skal godkendes',
				 'paidgroup:approval_is_not_needed' => 'Godkendelsen er ikke nødvendigt',
				 'paidgroup:member' => 'medlem',
				 'paidgroup:join' => 'Deltag',
				 'paidgroup:gallery' => 'Galleri',
				 'paidgroup:list' => 'Liste',		
				 'paidgroup:no_inactive' => 'Ingen inaktive grupper',				 
				 'paidgroup:inactive' => "InAktive",
				 'paidgroup:active' => 'Aktive',
                 'groups:groups:access:style' => "Side Adgangsniveau",
                 'groups:groups:payment:mode' => "Betalingsmetode",
                 'groups_currency' => "Valuta",
                 'groups_merchant_number' => " DIBS merchant number",
                 'groups_md5secret' => "DIBS md5 secret",
                 'paidgroup:membership:lastdate' => "Dit medlemsskab udløber den %s",
                 'paidgroup:membership:warning' =>  "Dette er en betalingsgruppe",
                 'paidgroup:membership:expired:warning'=> "Dit medlemsskab er udløbet",
                 'paidgroup:membership:leave:confirm' => "Er du sikker på, at du vil forlade gruppen? Du skal betale for et nyt medlemsskab, hvis du ønsker at blive gruppemedlem igen",

                 'paidgroup:field:group_paid_flag'=> "Skal det være et betalt medlemsskab?",
                 'paidgroup:field:group_period_type'=> "Periode type",
                 'paidgroup:field:group_paid_LockedPeriod'=> "Medlemsskabs perioden i måneder",
                 'paidgroup:field:group_paid_MembershipStart'=> "Medlemsskabets start dato",
                 'paidgroup:field:group_paid_MembershipEnd'=> "Medlemsskabets slut dato",
                 'paidgroup:field:group_paid_price'=> "Pris for medlemsskabet",

                 'paidgroup:field:group_period_type:value:duration'=> "Månedsperiode",
                 'paidgroup:field:group_period_type:value:dates'=> "Datoer",
                 'paidgroup:field:group_price_type:value:dailyprice'=> "Dags pris",
                 'paidgroup:field:group_price_type:value:fixedprice'=> "Fast pris",
                 'paidgroup:field:warning_activemember'=> "Der er %s aktive medlemmer. En ændring i prisen vil ikke påvirke dem. Men ændringer i datoer vil send en information til medlemmerne via email.",

//Email : membership will expire
                 'paidgroup:membership:will:expire:email:subject'=> "Dit medlemsskab udløber snart",
                 'paidgroup:lock:membership:will:expire:email:body' => "Hej %s,
Vi vil gerne gøre dig opmærksom på, at dit medlemsskab for gruppen '%s' udløber den %s.
Du kan forlænge dit abonnement ved at logge på i dag, eller så snart dit abonnement er udløbet.",
                 'paidgroup:date:membership:will:expire:email:body' => "Hej %s,
Dit medlemsskab for gruppen: %s kommer til at udløbe den %s.",
//Email :  membership is expired
                 'paidgroup:membership:expired:email:subject'=> "Dit medlemsskab er nu udløbet..",
                 'paidgroup:membership:expired:email:body' => "Hej %s,
Dit medlemsskab for gruppen: %s udløber i dag.",
//Email:  membership is expired                 
                 'paidgroup:datechanged:email:subject'=> "Dato for dit medlemsskab er ændret",
                 'paidgroup:datechanged:email:body' => "Hej %s,
Der er har været en ændring i datoopsætningen for gruppen: %s.
Nu er Start datoen sat til den %s, og Slut datoen til den %s.",

//Email:  Payment Received
                 'paidgroup:invoice:email:subject'=> "Modtaget din betaling",
                 'paidgroup:invoice:email:body' => "Hej %s,
Vi har modtaget din betaling for gruppen: %s.
Tak for din tilmelding. God fornøjelse med medlemsskabet.",
                 
);

add_translation("da", $danish);