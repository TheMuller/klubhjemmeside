<?php
/*
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 * 
 */


elgg_register_event_handler('init', 'system', 'Ads_init');

function Ads_init() {
        elgg_extend_view('css/admin', 'Ads/admin');

        $header_ads = elgg_get_plugin_setting('showads_header','Ads');
        $sidebar_ads = elgg_get_plugin_setting('showads_sidebar','Ads');
        $sidebar_alt_ads = elgg_get_plugin_setting('showads_sidebar_alt','Ads');
        $footer_ads = elgg_get_plugin_setting('showads_footer','Ads');
        $widget_ads = elgg_get_plugin_setting('showads_widget','Ads');
        
        $river_ads = elgg_get_plugin_setting('showads_river','Ads');
        $river_header_ads = elgg_get_plugin_setting('showads_river_header','Ads');
        $river_sidebar_ads = elgg_get_plugin_setting('showads_river_sidebar','Ads');
        $river_sidebar_alt_ads=elgg_get_plugin_setting('showads_river_sidebar_alt','Ads');

        elgg_extend_view('css/elgg', 'Ads/css');
        $ads_rotate = elgg_get_simplecache_url('js', 'ads_rotate');
        elgg_register_simplecache_view('js/ads_rotate');
        elgg_register_js('elgg.ads_rotation', $ads_rotate);
        elgg_load_js('elgg.ads_rotation');
        if (($widget_ads == yes)) {
        elgg_register_widget_type('Ads', elgg_echo('Ads:sponsor'), elgg_echo('Ads:widget:description'));
        }
        if (((elgg_get_context() != 'activity') or (!elgg_is_active_plugin('river_activity_3C'))) ){
 	    if (($header_ads == yes)){
            elgg_extend_view('page/layouts/content/header', 'page/elements/ads-header','1');
            }
            if (($sidebar_ads == yes)) {
            elgg_extend_view('page/elements/sidebar', 'page/elements/ads-sidebar','700');
            }
            if (($sidebar_alt_ads == yes)) {
            elgg_extend_view('page/elements/sidebar_alt', 'page/elements/ads-sidebar-alt','750');
            }
        }else if ($river_ads == yes){
            if (($header_ads == yes) and ($river_header_ads == yes)){
            elgg_extend_view('page/layouts/content/header', 'page/elements/ads-header','1');
            }
            if (($sidebar_ads == yes) and ($river_sidebar_ads == yes)) {
            elgg_extend_view('page/elements/sidebar', 'page/elements/ads-sidebar','700');
            }
            if (($sidebar_alt_ads == yes) and ($river_sidebar_alt_ads == yes)) {
            elgg_extend_view('page/elements/sidebar_alt', 'page/elements/ads-sidebar-alt','750');
            }
        }
        
            if ($footer_ads == yes){
            elgg_extend_view('page/elements/footer', 'page/elements/ads-footer', '701');
            }
}
