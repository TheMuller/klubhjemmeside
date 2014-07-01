******* MembersMap Plugin *******

Elgg map plugin for showing community members in Google Maps, based on "location" field offering multiple search options.

== Contents ==
1. Features
2. Installation
3. ToDo

== 1. Features ==
- Based on Google Geocoding API
- Elgg caching of users location
- Use of MarkerClusterer for improving map view when a large number of users are on map
- When multiple markers are located at the same or nearby location, they are splitted so they are clickable
- Non registered users can see only users with public location
- Registered users can see all users, online users and friends
- Search for members based on a given address and radius
- Search for nearby members based on radius
- Search for members on map by name and their nearby members (optional)
- Option to show search area
- Display members of group on map, if this option is enabled on group
- Widget for displaying location map on user's profile
- Compatible with Profile Manager plugin (default 'location' field is required)
- Visit user's profile from map
- Option to select marker in settings
- Option to add "Map of Members" tab at Elgg Members page (domain/members)
- Option to show/hide "Map of Members" item on site menu
- Option to select unit of measurement for distance searching (meters, kilometers or miles)
- Tool for batch geolocation of members already exists on Elgg site
- Multiple configuration options about google maps
- English, Greek, Italian, Spanish and German language files

== 2. Installation ==
Requires: Elgg 1.8 or higher

1. Upload kanelggamapsapi in "/mod/" elgg folder and activate it. In "Administration/Configure/Settings/Kanelgga Maps API" you must configure basic map options
2. Upload membersmap in "/mod/" elgg folder and activate it
3. In "Administration/Configure/Settings/Map of Members", run once 'Batch Users Geolocation' for geolocate current users
4. In "Administration/Configure/Settings/Map of Members" you can configure several map options
5. If you wish to add "Map of Members" tab at Elgg Members page, then you should place Membersmap plugin after Members plugin in Administration/Configure/Plugins
6. If using Profile Manager, in the Profile Manager settings, import default fields. Delete fields you don't want but leave location field.
7. Ensure that images at 'mod/membersmap/graphics' and 'mod/kanelggamapsapi/graphics' are readable from web server

== 3. ToDo ==
- autocomplete in search (souloupoma js)
- improve performance for large number of users
- option to show only no of users by country



