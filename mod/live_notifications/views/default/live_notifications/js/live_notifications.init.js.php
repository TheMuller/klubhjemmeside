
//**<script type="text/javascript">**//
$(document).ready(function () {

    $("#live_notifications").hide();                           
    
    $('#live_notifications_loader').show();	
    $("#live_notifications_result").load("<?php echo $vars['url']; ?>live_notifications/ajax",function(){
        $('#live_notifications_loader').hide(); // remove the loading gif
    }); 

    $("#live_notifications_link").click(function(){ 
        $("#live_notifications").toggle($('#live_notifications').css('display') == 'none');
        var num = parseInt($("#count_unread_notifications").html());
        if(num>0){
            elgg.action('live_notifications/read_all', function(response) {

            });
        }
        $("#count_unread_notifications").html(0);
        $("#count_unread_notifications").hide(); 
        $('.elgg-icon-live_notifications').addClass("elgg-icon-live_notifications-selected");
        return false;   
    });

    //Interval update counter: 10 second(10000)
   setInterval(function() {
        elgg.action('live_notifications/refresh_count', function(response) {
            var num = parseInt($("#count_unread_notifications").html());
            if(response.output>num){
                $("#count_unread_notifications").html(response.output);
                $("#count_unread_notifications").show();
                $('#live_notifications_loader').show(); 
                $("#live_notifications_result").load("<?php echo $vars['url']; ?>live_notifications/ajax",function(){
                    $('#live_notifications_loader').hide(); // remove the loading gif
                    elgg.system_message('<?php echo elgg_echo('live_notifications:new_notification'); ?>');
                });  
            }
            else{
                $("#count_unread_notifications").hide();                
            }
        });
    }, 15000);
    
    $(document).click(function(event) { 
        if($(event.target).parents().index($('#live_notifications')) == -1) {
            if($('#live_notifications').is(":visible")) {
                $('#live_notifications').hide();
                $('.elgg-icon-live_notifications').removeClass("elgg-icon-live_notifications-selected");
                $('.notifications_content_item').removeClass("new_notification");                
            }
        }        
    });
	

});

