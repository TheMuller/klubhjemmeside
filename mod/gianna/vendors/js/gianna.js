// we just need to attach a click event listener to provoke iPhone/iPod/iPad's hover event
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
    $(".elgg-page").click(function(){
        // 
    });
}

