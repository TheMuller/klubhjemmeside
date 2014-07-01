<?php

if(elgg_is_active_plugin("kanelggamapsapi")){
// load kanelgga maps api libraries
	elgg_load_library('elgg:kanelggamapsapi');  
	elgg_load_library('elgg:kanelggamapsapigeocoder'); 
    
    elgg_load_js('kmpbasicjs');
    elgg_load_js('kmpgmap1');
    
    $zoom = $vars['zoom'];
    $location = $vars['location'];
    
    if(!isset($zoom)){
        $zoom = get_map_zoom();
    } 
    if(!isset($location)){
        $location = CUSTOM_DEFAULT_COORDS;
    }  
    
?>

<div id="map_canvas" style="overflow:hidden; width:100%; height:250px"></div>
<script type='text/javascript'>
    // Delayed load is required, or elgg page continually reloads
    $(document).ready(function () { initialize();  });
    var geocoder = new google.maps.Geocoder();
    function getAddress(address, callback) {
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                callback(results[0].geometry.location);
            } 
        });
    }	
    function initialize() {
        getAddress("<?php echo $location;?>", function(defaultLocation) {
            var map = new google.maps.Map(document.getElementById("map_canvas"),{ 
                center: defaultLocation,
                zoom: <?php echo $zoom;?>, 
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });                       
            var myLatlng = new google.maps.LatLng(<?php echo $location;?>);
            var marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                icon: '<?php echo elgg_get_site_url();?>mod/membersmap/graphics/<?php echo get_marker_icon('membersmap');?>'
            });                        
        });
    };
</script>

<?php 
}
else
{
	register_error(elgg_echo("membersmap:settings:kanelggamapsapi:notenabled"));
}	    
?>
