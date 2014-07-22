<?php
$user_guid = get_input('user_guid');
$group_guid = get_input('group_guid');

leave_group($group_guid, $user_guid);
?>