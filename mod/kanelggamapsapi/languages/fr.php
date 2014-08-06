<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */

$language = array(

	'kanelggamapsapi:menu' => 'Carte',
    'kanelggamapsapi:search:radius:meters' => 'distance à la ronde en mètres',
    'kanelggamapsapi:search:radius:km' => 'distance à la ronde en km',
    'kanelggamapsapi:search:radius:miles' => 'distance à la ronde en miles',
    'kanelggamapsapi:search:meters' => 'm',
    'kanelggamapsapi:search:km' => 'km',
    'kanelggamapsapi:search:miles' => 'miles', 
    'kanelggamapsapi:all' => 'Global Map',
    'kanelggamapsapi:members' => 'Membres',
    'kanelggamapsapi:groups' => 'Groupes',
    'kanelggamapsapi:agora' => 'Petites Annonces',

    // settings
    'kanelggamapsapi:settings:google_maps' => 'Paramètres Google Maps',
    'kanelggamapsapi:settings:google_api_key' => 'Renseigner la clé Google API',
    'kanelggamapsapi:settings:google_api_key:clickhere' => 'Rejoindre <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">https://developers.google.com/maps/documentation/javascript/tutorial#api_key</a> poiur obtenir votre "Google API key". <br />(<strong>NB : </strong> la clé de l\'API n\'est PAS OBLIGATOIRE. La clé est nécessaire uniquement pour gérer les statistiques de votre API ou si vous utilisez un compte API payant.)',
    'kanelggamapsapi:settings:defaultzoom' => 'Zoom de la carte par défaut',     
    'kanelggamapsapi:settings:defaultzoom:note' => 'Indiquer le niveau de zomm (valeur numérique)', 
    'kanelggamapsapi:settings:map_width' => 'Largeur de la carte',
    'kanelggamapsapi:settings:map_width:how' => 'Valeur numérique (ex : 500) ou % (ex : 100%)',
    'kanelggamapsapi:settings:map_height' => 'Hauteur de la carte',
    'kanelggamapsapi:settings:map_height:how' => 'Valeur numérique (ex : 500)', 
	'kanelggamapsapi:settings:defaultlocation' => 'Adresse de localisation par défaut',     
    'kanelggamapsapi:settings:defaultlocation:note' => 'Indiquer une adresse correcte (adresse postale ou code postal ou commune ou pays. Ex : 67000 Strasbourg, France)', 
    'kanelggamapsapi:settings:defaultzoom:note' => 'Indiquer un niveau de zoom avec une valeur numérique.',    
    'kanelggamapsapi:settings:cluster' => 'Utiliser les paramètres Google Maps de regroupement des  marqueurs', 
    'kanelggamapsapi:settings:cluster:no' => 'Non', 
    'kanelggamapsapi:settings:cluster:yes' => 'Oui', 
    'kanelggamapsapi:settings:cluster:note' => 'Choisir Oui pour regrouper, sur la carte, les marqueurs aux alentours.', 
    'kanelggamapsapi:settings:no' => 'Non', 
    'kanelggamapsapi:settings:yes' => 'Oui',    
    'kanelggamapsapi:settings:unitmeas' => 'Unité de mesure de distance', 
    'kanelggamapsapi:settings:unitmeas:meters' => 'Mètres', 
    'kanelggamapsapi:settings:unitmeas:km' => 'Kilomètres', 
    'kanelggamapsapi:settings:unitmeas:miles' => 'Miles',
    'kanelggamapsapi:settings:unitmeas:note' => 'Choisir l\'unité de mesure utilisée pour la recherche.',  
    
    'kanelggamapsapi:settings:maponmenu' => 'Activer la recherche sur tous les objets géolocalisés cartographiés',
    'kanelggamapsapi:settings:maponmenu:note' => 'Choisir Oui pour activer la recherche sur tous les types d\'objets géolocalisés cartographiés',
    'kanelggamapsapi:settings:entities:notenabled' => 'Aucun des plugins qui utilise la cartographie n\'est activé.',
    'kanelggamapsapi:settings:entities' => 'Choisir les objets à cartographier',
    'kanelggamapsapi:settings:membersmap' => 'Cartographier les Membres',
    'kanelggamapsapi:settings:membersmap:note' => 'Choisir Oui pour cartographier les Membres du site.',
    'kanelggamapsapi:settings:groupsmap' => 'Cartographier les Groupes',
    'kanelggamapsapi:settings:groupsmap:note' => 'Choisir Oui pour cartographier les Groupes du site',
	'kanelggamapsapi:settings:agora' => 'Cartographier les Petites Annonces',
    'kanelggamapsapi:settings:agora:note' => 'Choisir Oui pour cartographier les Petites Annonces du site',
    'kanelggamapsapi:settings:gm_init' => 'Mise en route de la cartographie',
    'kanelggamapsapi:settings:gm_init:note' => 'Choisir les paramètres ci-dessous pour indiquer les objets à cartographier quand la carte est chargée la première fois. Assurez-vous que les objets et leur nombre n\'engendrent aucune surcharge qui ralentirait le fontionnement du site.',
    'kanelggamapsapi:settings:gm_default_loc' => 'Lacalisation par défaut',
    'kanelggamapsapi:settings:gm_default_loc:note' => 'Choisir un lieu par défaut pour permettre aux visiteurs d\'effectuer leur première recherche ou pour renseigner par défaut l\'emplacement.',
    'kanelggamapsapi:settings:gm_distance' => 'Distance à la ronde',
    'kanelggamapsapi:settings:gm_distance:note' => 'Choisir la distance à la ronde (km). Valeur numérique.',    
    'kanelggamapsapi:settings:gm_entities_no' => 'Nombre d\'objets',
    'kanelggamapsapi:settings:gm_entities_no:note' => 'Choisir le nombre de chaque objet à afficher. Valeur numérique. Indiquer 0 pour nombre illimité (déconseillé).',
	'admin:settings:kanelggamapsapi' => 'Kanelgga Maps API',
	'kanelggamapsapi:settings:save:ok' => 'Paramètres correctement enregistrés',
	'kanelggamapsapi:settings:tabs:general_options' => 'General Maps Options',
	'kanelggamapsapi:settings:tabs:global_options' => 'Global Map Options',
	'kanelggamapsapi:settings:gm_cluster' => 'Utiliser la fonction cartographique de regroupement', 
    'kanelggamapsapi:settings:gm_cluster:note' => 'Choisir Oui pour regrouper, sur la carte, les marqueurs aux alentours. Si cette fonction est désactivée, un tableau récapitulatif attenant vous permettra d\'afficher ou de masquer les objets', 
    
    //search 
    'kanelggamapsapi:search' => 'Recherche par emplacement',
    'kanelggamapsapi:search:location' => 'emplacement',
    'kanelggamapsapi:search:radius' => 'distance à la ronde en mètres',
    'kanelggamapsapi:search:radius:meters' => 'distance à la ronde en mètres',
    'kanelggamapsapi:search:radius:km' => 'distance à la ronde en km',
    'kanelggamapsapi:search:radius:miles' => 'distance à la ronde en miles',
    'kanelggamapsapi:search:meters' => 'm',
    'kanelggamapsapi:search:km' => 'km',
    'kanelggamapsapi:search:miles' => 'miles',    
    'kanelggamapsapi:search:showradius' => 'Afficher l\'aire de recherche',
    'kanelggamapsapi:search:submit' => 'Recherche',
    'kanelggamapsapi:searchnearby' => 'Recherche aux alentours',
    'kanelggamapsapi:mylocationsis' => 'Mon emplacement est : ',
    'kanelggamapsapi:searchbyname' => 'Recherche par nom',
    'kanelggamapsapi:search:name' => 'nom',
    'kanelggamapsapi:search:searchname' => 'Recherche pour %s et alentours',
    'kanelggamapsapi:search:usernotfound' => 'Aucun objet trouvé',
    'kanelggamapsapi:search:usersfound' => 'Objets trouvés',
    'kanelggamapsapi:search:around' => 'Objets trouvés aux alentours en lien avec des membres',
    'kanelggamapsapi:showhideentities' => 'Afficher / Masquer les objets',
);

add_translation('fr', $language);
