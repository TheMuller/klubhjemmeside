<?php
/**
 * Show map based on search of members by name and nearby users
 *
 * @package MembersMap
 */
?>

<?php
    // access check for closed groups
    group_gatekeeper();

    $users = $vars['user'];
    $usersfound = $vars['usersfound'];
    $mapwidth = $vars['mapwidth'];
    $mapheight = $vars['mapheight'];
    $defaultlocation = $vars['defaultlocation'];
    $defaultzoom = $vars['defaultzoom'];
    $radius = $vars['radius'];
    $name = $vars['name'];
    $defaultcoords = $vars['defaultcoords'];
    $clustering = $vars['clustering'];
    $clustering_zoom = $vars['clustering_zoom'];

    // load google maps js
    elgg_load_js('kmpbasicjs');
    elgg_load_js('kmpplaceholderjs');
    elgg_load_js('kmpgmap1');
    elgg_load_js('kmpgmap2');
    elgg_load_js('kmpgmap3');
    elgg_load_js('kmpgmap4');
    elgg_load_js('kmpomsjs');
?>

<script type="text/javascript"><!--
    var gm = google.maps;    
    $(document).ready(function(){

        infowindow = new google.maps.InfoWindow();
        var myLatlng = new google.maps.LatLng('.$defaultcoords.');
        var mapOptions = {
            zoom: <?php echo $defaultzoom;?>,
            center: myLatlng,
            mapTypeId: gm.MapTypeId.ROADMAP
        }
        var map = new gm.Map(document.getElementById("map"), mapOptions);
        var markerBounds = new google.maps.LatLngBounds();
        var geocoder = new google.maps.Geocoder();

        var convertunit = '<?php echo get_unit_of_measurement();?>';
        if (isNaN(convertunit)) convertunit = 1; // set meters as default unit of measurement
        
        var radius = '<?php echo $radius;?>';
        if (isNaN(radius)) radius = 30000; // set default radius
        radius = radius * convertunit; // convert regarding unit of measurement

        var showradius = document.getElementById('showradius');
        showradius.checked = true;    // by default show radius 

            //////////////////// Spiderfier feature start ////////////////////
            var iw = new gm.InfoWindow();
            var oms = new OverlappingMarkerSpiderfier(map,{markersWontMove: true, markersWontHide: true, keepSpiderfied: true});

            oms.addListener('click', function(marker) {
              iw.setContent(marker.desc);
              iw.open(map, marker);
            });
            //////////////////// Spiderfier feature end ////////////////////
            
        showusersfound(geocoder, radius, showradius, markerBounds, map, 1, oms);
    });

    var www1;
    var www2;

    // search area
    function codeAddress(givenaddr) {
        codeAddressExtend(givenaddr,<?php echo $defaultzoom;?>,'<?php echo elgg_get_site_url();?>','<?php echo $defaultlocation;?>','<?php echo elgg_echo("membersmap:map:2");?>', 1, <?php echo get_unit_of_measurement();?>, '<?php echo get_unit_of_measurement_string_simple();?>');
    }
    
    function showusersfound(geocoder, radius, showradius, markerBounds, map, showradius, oms) {
<?php
    foreach ($usersfound as $u)  {
        if (!isset($u->location) || !$u->location) {
            //do nothing
        }
        else    {
            if ($u->getLatitude() && $u->getLongitude())  {
                // remove single and double quotes from username
				$namecleared = remove_shits($u->name);
				
				$entity_description = getEntityDescription($u->briefdescription);
				$entity_location = remove_shits($u->location);	
				$icon = getEntityIcon($u);
				$entity_title = getEntityTitle($u, $namecleared); 
				$entity_img = getEntityImg($u, $namecleared);	
				
?> 
                var myLatlng = new google.maps.LatLng(<?php echo $u->getLatitude();?>,<?php echo $u->getLongitude();?>);
                map.setCenter(myLatlng);
                var marker = new google.maps.Marker({
                  map: map,
                  position: myLatlng,
                  icon: '<?php echo elgg_get_site_url();?>mod/membersmap/graphics/members.png'
                });
                markerBounds.extend(myLatlng);
                map.fitBounds(markerBounds);
                
                www1 = <?php echo $u->getLatitude();?>;
                www2 = <?php echo $u->getLongitude();?>;

                google.maps.event.addListener(marker, 'click', function() {
                  infowindow.setContent('<?php echo '<div class="infowindow">'.$entity_img.' '.$entity_title.'<br/>'.$entity_location.'<br/>'.$entity_description.'</div>';?>');
                  infowindow.open(map, this);
                });   
                oms.addMarker(marker);  // Spiderfier feature

                if (showradius==1) {   // show circle only at search "members by name" section
                    // Add a Circle overlay to the map.
                    var circle = new google.maps.Circle({
                      map: map,
                      radius: parseInt(radius),
                      fillColor: 'yellow',
                      fillOpacity: 0.15
                    });
                    // Bind circle and marker
                    circle.bindTo('center', marker, 'position');
                }

                codeMember('<?php echo $u->location;?>', map, geocoder, radius, showradius, markerBounds, oms);
<?php
            }
        }
    }
?> 
    } // end of showusersfound
    
    function showusers(geocoder, radius, showradius, markerBounds, map, oms) {
        var ddd;
        var markers = [];
<?php
    foreach ($users as $u)  {
        if (!isset($u->location) || !$u->location) {
            //do nothing
        }
        else    {
            if ($u->getLatitude() && $u->getLongitude())  {
                // remove single and double quotes from username
				$namecleared = remove_shits($u->name);
				
				$entity_description = getEntityDescription($u->briefdescription);
				$entity_location = remove_shits($u->location);	
				$icon = getEntityIcon($u);
				$entity_title = getEntityTitle($u, $namecleared); 
				$entity_img = getEntityImg($u, $namecleared);	           
?> 
                if (radius>=0) ddd = calcDistance(www1, www2, <?php echo $u->getLatitude();?>, <?php echo $u->getLongitude();?>);
                if (ddd <= radius || radius<0)   {
                    var myLatlng = new google.maps.LatLng(<?php echo $u->getLatitude();?>,<?php echo $u->getLongitude();?>);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: myLatlng,
                        title: '<?php echo $namecleared;?>',
                        icon: '<?php echo $icon;?>'
                    });                
                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.setContent('<?php echo '<div class="infowindow">'.$entity_img.' '.$entity_title.'<br/>'.$entity_location.'<br/>'.$entity_description.'</div>';?>');
                      infowindow.open(map, this);
                    });  
                    oms.addMarker(marker);  // Spiderfier feature
                    markers.push(marker);

                    if (!showradius.checked)    {
                        markerBounds.extend(myLatlng);
                        map.fitBounds(markerBounds);                    
                    } 
                } 
<?php
            }
        }
    }
        
    if ($clustering)    {
?> 
        var markerCluster = new MarkerClusterer(map, markers, {
          maxZoom: <?php echo $clustering_zoom;?>
        });         
<?php
    }
    
    // release array to help memory
    unset($users);
    unset($usersfound);
?> 
        
        //set map to default zoom
        var listener = google.maps.event.addListener(map, "idle", function() { 
            
          if (map.getZoom() > <?php echo $defaultzoom;?>) map.setZoom(<?php echo $defaultzoom;?>); 
          google.maps.event.removeListener(listener); 
        });
    } // end of showusers   
  
//--></script>

<div id="map" style="width:<?php echo $mapwidth; ?>; height:<?php echo $mapheight; ?>;"></div>

<div id="parent">
    <img src="<?php echo elgg_get_site_url();?>mod/membersmap/graphics/members.png" width="32" height="37" alt="<?php echo elgg_echo('membersmap:search:usersfound'); ?>"/>
    <span><?php echo elgg_echo('membersmap:search:usersfound'); ?></span>
</div>
<div id="parent">
    <img src="<?php echo elgg_get_site_url();?>mod/membersmap/graphics/<?php echo get_marker_icon('membersmap');?>" width="32" height="37" alt="<?php echo elgg_echo('membersmap:search:around', array($name)); ?>"/>
    <span><?php echo elgg_echo('membersmap:search:around', array($name)); ?></span>
</div>

