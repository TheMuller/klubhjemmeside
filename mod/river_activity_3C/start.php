<?php
	/*
	 * 3 Column River Acitivity
	 *
	 * @package ElggRiverDash
	 * Full Creadit goes to ELGG Core Team for creating a beautiful social networking script
	 *
         * Modified by Satheesh PM, BARC, Mumbai, India..
         * http://satheesh.anushaktinagar.net
         *
	 * @author ColdTrick IT Solutions
	 * @copyright Coldtrick IT Solutions 2009
	 * @link http://www.coldtrick.com/
	 * @version 1.0
         *
         */

elgg_register_event_handler('init', 'system', 'river_activity_3C_init');

function river_activity_3C_init() {
elgg_extend_view('css/elgg', 'river_activity_3C/css');

if (elgg_is_logged_in() && elgg_get_context() == 'activity'){
//Loading Ads Rotator Script
elgg_register_js('jquery.jshowoff.min', 'mod/river_activity_3C/views/default/js/jquery.jshowoff.min.js', 'head');
elgg_load_js('jquery.jshowoff.min');

//Showing Site Status
if (elgg_get_plugin_setting('show_status','river_activity_3C') == yes){
elgg_extend_view('page/elements/sidebar', 'page/elements/site_status','700');
}

//Showing Horoscope
if (elgg_get_plugin_setting('show_horoscope','river_activity_3C') == yes){
elgg_extend_view('page/elements/sidebar', 'page/elements/horoscope','710');
}

//Shows New Groups
if ((elgg_get_plugin_setting('show_latest_group','river_activity_3C') == yes)&&(elgg_is_active_plugin('groups'))){
elgg_extend_view('page/elements/sidebar', 'page/elements/newgroups','740');
}

//Shows Featured Groups
if ((elgg_get_plugin_setting('show_featured_group','river_activity_3C') == yes) &&(elgg_is_active_plugin('groups'))) {
elgg_extend_view('page/elements/sidebar', 'page/elements/featuredgroup','750');
}

//Shows Group Memberships
if ((elgg_get_plugin_setting('show_group_membership','river_activity_3C') == yes) &&(elgg_is_active_plugin('groups'))){
elgg_extend_view('page/elements/sidebar', 'page/elements/groupmembership','760');
}

//Shows Bookmarks
if ((elgg_get_plugin_setting('show_bookmark','river_activity_3C') == yes) && (elgg_is_active_plugin('bookmarks'))){
elgg_extend_view('page/elements/sidebar', 'page/elements/bookmark','770');
}

//Shows Blogs
if ((elgg_get_plugin_setting('show_blog','river_activity_3C') == yes) && (elgg_is_active_plugin('blog'))){
elgg_extend_view('page/elements/sidebar', 'page/elements/blogs','780');
}

//Shows Files
if ((elgg_get_plugin_setting('show_file','river_activity_3C') == yes) && (elgg_is_active_plugin('file'))){
elgg_extend_view('page/elements/sidebar', 'page/elements/files','790');
}

//Shows Top Pages
if ((elgg_get_plugin_setting('show_page','river_activity_3C') == yes) && (elgg_is_active_plugin('pages'))){
elgg_extend_view('page/elements/sidebar', 'page/elements/pages','800');
}




//Shows Avatar and Links
if (elgg_get_plugin_setting('show_profile','river_activity_3C') == yes){
elgg_extend_view('page/elements/sidebar_alt', 'page/elements/profile','700');
}

//Shows Online Members
if ((elgg_get_plugin_setting('show_online_members','river_activity_3C') == yes) && (elgg_is_active_plugin('members'))){
elgg_extend_view('page/elements/sidebar_alt', 'page/elements/online','710');
}

//Shows newest Members
if ((elgg_get_plugin_setting('show_recent_members','river_activity_3C') == yes) && (elgg_is_active_plugin('members'))){
elgg_extend_view('page/elements/sidebar_alt', 'page/elements/newestmembers','730');
}

//Shows Friends
if ((elgg_get_plugin_setting('show_friends','river_activity_3C') == yes) && (elgg_is_active_plugin('members'))){
elgg_extend_view('page/elements/sidebar_alt', 'page/elements/friends','725');
}

//Shows Online Friends
if ((elgg_get_plugin_setting('show_friends_online','river_activity_3C') == yes) && (elgg_is_active_plugin('members'))){
elgg_extend_view('page/elements/sidebar_alt', 'page/elements/friends_online','720');
}

//Shows Birthdays 
if ((elgg_get_plugin_setting('show_birthday','river_activity_3C') == yes) && (elgg_is_active_plugin('profile_manager'))){
elgg_extend_view('page/elements/sidebar_alt', 'page/elements/birthdays','740');
}

if (elgg_get_plugin_setting('show_system_messages', 'river_activity_3C') == 'yes'){
elgg_extend_view('page/layouts/content/header', 'page/elements/site_message','100');
}

if ((elgg_get_plugin_setting('show_wire', 'river_activity_3C') == 'yes') && (elgg_is_active_plugin('thewire'))){
elgg_extend_view('page/layouts/content/header', 'page/elements/wire','200');
}


elgg_extend_view('page/elements/sidebar_alt', 'page/elements/youmayknow','760');
}
else if (elgg_is_logged_in() && (elgg_get_plugin_setting('extend_sitemsg','river_activity_3C') == yes)){
    elgg_register_js('jquery.jshowoff.min', 'mod/river_activity_3C/views/default/js/jquery.jshowoff.min.js', 'head');
    elgg_load_js('jquery.jshowoff.min');
    elgg_extend_view('page/elements/sidebar', 'page/elements/site_message','700');
}
}

?>