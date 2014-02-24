<?php
/**
 * Save background
 */

$background = get_input('selected');
$result = elgg_set_plugin_setting('background', $background, 'gianna');


forward(REFERER);

exit;
