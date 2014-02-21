<?php

/*
 * Satheesh PM, BARC Mumbai
 * www.satheesh.anushaktinagar.net
 */
    
//Layout
    echo "<div class='admin_settings'>".elgg_echo('sitecron:info').'</div>';
    echo "<h3>".elgg_echo('sitecron:dropvalidation')."</h3>";
    echo "<div class='admin_settings'>".elgg_echo('sitecron:validation')." : ";
    echo elgg_view('input/dropdown', array(
            'name' => 'params[validation]',
            'options_values' => array(
                    'yes' => elgg_echo('sitecron:yes'),
                    'no' => elgg_echo('sitecron:no'),
            ),
            'value' => $vars['entity']->validation,
            ));

    echo "<br />".elgg_echo('sitecron:droptime')." : ";
    echo elgg_view('input/dropdown', array(
            'name' => 'params[droptime]',
            'options_values' => array(
                    '-7 days' => elgg_echo('sitecron:7days'),
                    '-15 days' => elgg_echo('sitecron:15days'),
                    '-1 month' => elgg_echo('sitecron:1month'),
            ),
            'value' => $vars['entity']->droptime,
            ));

    echo "</div>";

    echo "<h3>".elgg_echo('sitecron:loginreminder')."</h3>";
    echo "<div class='admin_settings'>".elgg_echo('sitecron:reminder')." : ";
    echo elgg_view('input/dropdown', array(
            'name' => 'params[reminder]',
            'options_values' => array(
                    'yes' => elgg_echo('sitecron:yes'),
                    'no' => elgg_echo('sitecron:no'),
            ),
            'value' => $vars['entity']->reminder,
            ));

    echo "<br />".elgg_echo('sitecron:remindertime')." : ";
    echo elgg_view('input/dropdown', array(
            'name' => 'params[logintime]',
            'options_values' => array(
                    '-1 month' => elgg_echo('sitecron:1month'),
                    '-2 months' => elgg_echo('sitecron:2month'),
                    '-3 months' => elgg_echo('sitecron:3month'),
                    '-30 years' => elgg_echo('sitecron:30year'),
            ),
            'value' => $vars['entity']->logintime,
            ));
    echo "<br />".elgg_echo('sitecron:counter')." : ";
    echo elgg_view('input/text', array(
            'name' => 'params[counter]',
            'value' => $vars['entity']->counter,
            ));
    echo "</div>";