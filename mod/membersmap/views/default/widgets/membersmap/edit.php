<?php
/**
 * Show map based on search of all members
 *
 * @package MembersMap
 */


$zoom = elgg_view('input/dropdown', array(
    'name' => 'params[zoom]',
    'value' => $vars['entity']->zoom,
    'options' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15)
));


?>

<div>
    <?php echo elgg_echo('membersmap:zoom'); ?>:
    <?php echo $zoom; ?>
</div>
