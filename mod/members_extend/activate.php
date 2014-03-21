<?php
/**
 * Register the ElggWire class for the object/thewire subtype
 */



$MemberField = elgg_get_plugin_setting('MemberField', 'members_extend');
if (!$MemberField) {
    elgg_set_plugin_setting('MemberField', "mobile,location",'members_extend');
     elgg_set_plugin_setting('MemberFieldLabel', "Mobile phone,Location",'members_extend');

}