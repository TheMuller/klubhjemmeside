<?php
/**
 * PaidGroup languages
 *
 * @package ElggPaidGroup
 */

$danish = array(
'groups:paid' => "Betalings Gruppe",
                 'groups:groups:access:style' => "Side Adgangsniveau",
                 'groups_currency' => "Valuta",
                 'groups_merchant_number' => " DIBS merchant number",
                 'groups_md5secret' => "DIBS md5 secret",
                 'paidgroup:membership:lastdate' => "Dit medlemsskab udl�ber den %s",
                 'paidgroup:membership:warning' =>  "Dette er en betalingsgruppe",
                 'paidgroup:membership:expired:warning'=> "Dit medlemsskab er udl�bet",
                 'paidgroup:membership:leave:confirm' => "Er du sikker p�, at du vil forlade gruppen? Du skal betale for et nyt medlemsskab, hvis du �nsker at blive gruppemedlem igen",

                 'paidgroup:field:group_paid_flag'=> "Skal det v�re et betalt medlemsskab?",
                 'paidgroup:field:group_period_type'=> "Periode type",
                 'paidgroup:field:group_paid_LockedPeriod'=> "Medlemsskabs perioden i m�neder",
                 'paidgroup:field:group_paid_MembershipStart'=> "Medlemsskabets start dato",
                 'paidgroup:field:group_paid_MembershipEnd'=> "Medlemsskabets slut dato",
                 'paidgroup:field:group_paid_price'=> "Pris for medlemsskabet",

                 'paidgroup:field:group_period_type:value:duration'=> "M�nedsperiode",
                 'paidgroup:field:group_period_type:value:dates'=> "Datoer",
                 'paidgroup:field:group_price_type:value:dailyprice'=> "Dags pris",
                 'paidgroup:field:group_price_type:value:fixedprice'=> "Fast pris",
                 'paidgroup:field:warning_activemember'=> "Der er %s aktive medlemmer. En �ndring i prisen vil ikke p�virke dem. Men �ndringer i datoer vil send en information til medlemmerne via email.",

//Email : membership will expire
                 'paidgroup:membership:will:expire:email:subject'=> "Dit medlemsskab udl�ber snart",
                 'paidgroup:lock:membership:will:expire:email:body' => "Hej %s,
Dit medlemsskab for gruppen:%s udl�ber den %s.",
                 'paidgroup:date:membership:will:expire:email:body' => "Hej %s,
Dit medlemsskab for gruppen: %s kommer til at udl�be den %s.",
//Email :  membership is expired
                 'paidgroup:membership:expired:email:subject'=> "Dit medlemsskab er nu udl�bet..",
                 'paidgroup:membership:expired:email:body' => "Hej %s,
Dit medlemsskab for gruppen: %s udl�ber i dag.",
//Email:  membership is expired                 
                 'paidgroup:datechanged:email:subject'=> "Dato for dit medlemsskab er �ndret",
                 'paidgroup:datechanged:email:body' => "Hej %s,
Der er har v�ret en �ndring i datoops�tningen for gruppen: %s.
Nu er Start datoen sat til den %s, og Slut datoen til den %s.",

//Email:  Payment Received
                 'paidgroup:invoice:email:subject'=> "Modtaget din betaling",
                 'paidgroup:invoice:email:body' => "Hej %s,
Vi har modtaget din betaling for gruppen: %s.
Tak for din tilmelding. God forn�jelse med medlemsskabet.",
                 
);

add_translation("da", $danish);