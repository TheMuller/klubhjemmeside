<?php
/*
    Satheesh PM, BARC Mumbai
    www.satheesh.anushaktinagar.net
*/ 
/*

Title:		jShowOff: a jQuery Content Rotator Plugin
Author:		Erik Kallevig
Version:	0.1.2
License: 	Dual licensed under the MIT and GPL licenses.

*/

echo elgg_view('js/jquery.jshowoff');

?>

elgg.provide('elgg.ads_rotation');
elgg.ads_rotation.init = function(){$(document).ready(function(){ 

        $('#ads-header').jshowoff({
        
        changeSpeed:800,    //Speed of transition in milliseconds.
        speed:60000,        //Time each slide is shown in milliseconds.
        animatePause:true,  //Whether to use 'Pause' animation text when pausing.
        autoPlay:true,      //Whether to start playing immediately.
        controls:true,      //Whether to create & display controls (Play/Pause, Previous, Next).
        links:true,         //Whether to create & display numeric links to each slide.
        hoverPause:true,    //Whether to pause on hover.
        effect:'slideLeft', //Type of transition effect: 'fade', 'slideLeft' or 'none'.
        controlText:{ play:'Play', pause:'Pause', previous:'Previous', next:'Next' }    //Text to use for controls (Play/Pause, Previous, Next).

        });

        $('#ads-sidebar').jshowoff({

        changeSpeed:800,    //Speed of transition in milliseconds.
        speed:10000,        //Time each slide is shown in milliseconds.
        animatePause:true,  //Whether to use 'Pause' animation text when pausing.
        autoPlay:true,      //Whether to start playing immediately.
        controls:false,     //Whether to create & display controls (Play/Pause, Previous, Next).
        links:false,        //Whether to create & display numeric links to each slide.
        hoverPause:true,    //Whether to pause on hover.
        effect:'fade',      //Type of transition effect: 'fade', 'slideLeft' or 'none'.
        controlText:{ play:'Play', pause:'Pause', previous:'Previous', next:'Next' }    //Text to use for controls (Play/Pause, Previous, Next).

        });

        $('#ads-sidebar-alt').jshowoff({

        changeSpeed:800,    //Speed of transition in milliseconds.
        speed:10000,        //Time each slide is shown in milliseconds.
        animatePause:true,  //Whether to use 'Pause' animation text when pausing.
        autoPlay:true,      //Whether to start playing immediately.
        controls:false,     //Whether to create & display controls (Play/Pause, Previous, Next).
        links:false,        //Whether to create & display numeric links to each slide.
        hoverPause:true,    //Whether to pause on hover.
        effect:'fade',      //Type of transition effect: 'fade', 'slideLeft' or 'none'.
        controlText:{ play:'Play', pause:'Pause', previous:'Previous', next:'Next' }    //Text to use for controls (Play/Pause, Previous, Next).

        });

        $('#ads-footer').jshowoff({

        changeSpeed:800,    //Speed of transition in milliseconds.
        speed:60000,        //Time each slide is shown in milliseconds.
        animatePause:true,  //Whether to use 'Pause' animation text when pausing.
        autoPlay:true,      //Whether to start playing immediately.
        controls:false,     //Whether to create & display controls (Play/Pause, Previous, Next).
        links:false,        //Whether to create & display numeric links to each slide.
        hoverPause:true,    //Whether to pause on hover.
        effect:'fade',      //Type of transition effect: 'fade', 'slideLeft' or 'none'.
        controlText:{ play:'Play', pause:'Pause', previous:'Previous', next:'Next' }    //Text to use for controls (Play/Pause, Previous, Next).

        });

        
        $('#ads-widget').jshowoff({

        changeSpeed:800,    //Speed of transition in milliseconds.
        speed:60000,        //Time each slide is shown in milliseconds.
        animatePause:true,  //Whether to use 'Pause' animation text when pausing.
        autoPlay:true,      //Whether to start playing immediately.
        controls:false,     //Whether to create & display controls (Play/Pause, Previous, Next).
        links:false,        //Whether to create & display numeric links to each slide.
        hoverPause:true,    //Whether to pause on hover.
        effect:'fade',      //Type of transition effect: 'fade', 'slideLeft' or 'none'.
        controlText:{ play:'Play', pause:'Pause', previous:'Previous', next:'Next' }    //Text to use for controls (Play/Pause, Previous, Next).

        });
        
        
        
    });
}
elgg.register_hook_handler('init', 'system', elgg.ads_rotation.init);
