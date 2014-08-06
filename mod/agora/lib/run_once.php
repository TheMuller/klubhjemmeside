<?php
/**
 * Elgg Agora Classifieds plugin
 * @package Agora
 */

function agora_manager_run_once_subtypes()	{
    add_subtype('object', Agora::SUBTYPE, "agora");
    add_subtype('object', Sales::SUBTYPE, "agorasales");
    add_subtype('object', Interest::SUBTYPE, "agorainterest");
}
