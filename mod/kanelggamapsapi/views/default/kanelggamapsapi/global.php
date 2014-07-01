<?php
/**
 * Elgg kanelggamapsapi plugin
 * @package KanelggaMapsApi 
 */
 
    // access check for closed groups
    group_gatekeeper();

    $users = $vars['user'];
    $mapwidth = $vars['mapwidth'];
    $mapheight = $vars['mapheight'];
    $defaultlocation = $vars['defaultlocation'];
    $defaultzoom = $vars['defaultzoom'];
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
	var markers_user = [];
	var markers_group = [];
	var markers_agora = [];     
	var map;
    $(document).ready(function(){

            infowindow = new google.maps.InfoWindow();
            var myLatlng = new google.maps.LatLng(<?php echo $defaultcoords;?>);
            var mapOptions = {
                zoom: <?php echo $defaultzoom;?>,
                center: myLatlng,
                mapTypeId: gm.MapTypeId.ROADMAP
            }
            //var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            map = new gm.Map(document.getElementById("map"), mapOptions);
            var markerBounds = new google.maps.LatLngBounds();
            var geocoder = new google.maps.Geocoder();
        
            //////////////////// Spiderfier feature start ////////////////////
            var iw = new gm.InfoWindow();
            var oms = new OverlappingMarkerSpiderfier(map,{markersWontMove: true, markersWontHide: true, keepSpiderfied: true});

            oms.addListener('click', function(marker) {
              iw.setContent(marker.desc);
              iw.open(map, marker);
            });
            //////////////////// Spiderfier feature end ////////////////////
            
			$('#chbx_user').click(function() {
				if ($(this).is(':checked'))
					showOverlays(markers_user);
				else
					clearOverlays(markers_user);
			});	 
			$('#chbx_group').click(function() {
				if ($(this).is(':checked'))
					showOverlays(markers_group);
				else
					clearOverlays(markers_group);
			});	
			$('#chbx_agora').click(function() {
				if ($(this).is(':checked'))
					showOverlays(markers_agora);
				else
					clearOverlays(markers_agora);
			});				

            showusers(geocoder, -1, 0, markerBounds, map, 0, 0,oms); 
    });
    
    // search area
    function codeAddress(givenaddr) {
        codeAddressExtend(givenaddr,<?php echo $defaultzoom;?>,'<?php echo elgg_get_site_url();?>','<?php echo $defaultlocation;?>','<?php echo elgg_echo("membersmap:map:2");?>', 0, <?php echo get_unit_of_measurement('membersmap');?>, '<?php echo get_unit_of_measurement_string_simple('membersmap');?>');
    } 
    
	function clearOverlays(arrMarkers) {
	  if (arrMarkers) {
		for( var i = 0, n = arrMarkers.length; i < n; ++i ) {
		  arrMarkers[i].setMap(null);
		}
	  }
	}    
	
	function showOverlays(arrMarkers) {
	  if (arrMarkers) {
		for( var i = 0, n = arrMarkers.length; i < n; ++i ) {
		  arrMarkers[i].setMap(map);
		}
	  }
	}	
	
    function showusers(geocoder, radius, showradius, markerBounds, map, www1, www2, oms) {
        var ddd;
        var markers = [];

        //alert(www1+','+www2);
<?php
    foreach ($users as $u)  {
        if (!isset($u->location) || !$u->location) {
            //do nothing
        }
        else    {
			if ($u->getLatitude() && $u->getLongitude())  {
				if (elgg_instanceof($u, 'user')) {     
					$namecleared = remove_shits($u->name);
					$entity_description = getEntityDescription($u->briefdescription);
					$entity_location = remove_shits($u->location);		
				}  
				else if (elgg_instanceof($u, 'group')) {     
					$namecleared = remove_shits($u->name);
					$entity_description = '';
					$entity_location = remove_shits($u->grouplocation);		
				}   
				else if (elgg_instanceof($u, 'object', 'agora')) {     
					$namecleared = remove_shits($u->title);
					$entity_description = getEntityDescription($u->description);
					$entity_location = remove_shits($u->location);
				}   
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
                    //markers.push(marker);
                     
					<?php if (elgg_instanceof($u, 'user')) {?> markers_user.push(marker); <?php } ?>
					<?php if (elgg_instanceof($u, 'group')) {?> markers_group.push(marker); <?php } ?>
					<?php if (elgg_instanceof($u, 'object', 'agora')) {?> markers_agora.push(marker); <?php } ?>

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
		var array1 = markers_user;
		var array2 = array1.concat(markers_group);
		var array3 = array2.concat(markers_agora);
        var markerCluster = new MarkerClusterer(map, array3, {
          maxZoom: <?php echo $clustering_zoom;?>
        });        
<?php
    }

	// release array to help memory
    unset($users);
?>        
    } // end of showusers
  
  //--></script>

<div id="map" style="width:<?php echo $mapwidth; ?>; height:<?php echo $mapheight; ?>;"></div>




