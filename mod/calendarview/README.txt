******* Calendar Monthly View Plugin *******

This plugin displays in monthly view all events submitted in Event Calendar plugin 
(https://github.com/kevinjardine/Elgg-Event-Calendar) offering also month navigation.

Plugin offers 3 monthly views:
1. All events
2. My events
3. Events of my friends

A new menu item is added in elgg menu bar as "Calendar". 

In case you want to delete menu item "Event calendar" of event_calendar plugin then do following steps:
1. Uncomment at start.php the line 22 (//elgg_unregister_menu_item('site', event_calendar);) 
2. In administration plugins list put it after event_calendar

 
